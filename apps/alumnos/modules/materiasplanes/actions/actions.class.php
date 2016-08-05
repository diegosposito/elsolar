<?php

/**
 * materiasplanes actions.
 *
 * @package    sig
 * @subpackage materiasplanes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materiasplanesActions extends sfActions
{ 
  public function executeGuardar(sfWebRequest $request)
  {    
  	$arregloMateriasPlanesActuales = array();

  	$arregloDiferencias = array();
  	// Obtiene todas las materias de un plan
  	$materias_planes_actual = Doctrine_Core::getTable('MateriasPlanes')->findByIdplanestudio($request->getParameter('idplanestudio'));
  	foreach($materias_planes_actual as $materia_plan) {
  		$arregloMateriasPlanesActuales[$materia_plan->getIdmateriaplan()] = $materia_plan->getIdmateriaplan();
  	}
  	// Obtiene las materias a guardar en un plan
  	if(!$request->getParameter('materiasplanes')){
  		$arregloMateriasPlanesNuevas = array();  	
  	} else {
  		$arregloMateriasPlanesNuevas = $request->getParameter('materiasplanes');
  	}
  	
	if (count($arregloMateriasPlanesActuales) > 0) {
	  	// Obtiene la diferencia entre las materias que estaban guardadas y las que se deben guardar 
  		$arregloDiferencias = array_diff(array_values($arregloMateriasPlanesActuales), array_values($arregloMateriasPlanesNuevas));

  		foreach ($arregloDiferencias as $materia_plan) {
			// Elimina las materias que ya no estan
  			$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($materia_plan);  			
    		$catedras = Doctrine_Core::getTable('Catedras')->findByIdmateriaplan($oMateriaPlan->getIdmateriaplan());
    		if(count($catedras) > 0) {    
    			foreach ($catedras as $catedra) {
    				$catedra->delete();
    			}
    		}   			
			$oMateriaPlan->delete();
		}
	}		

	// Agrega las materias nuevas
	if ((count($arregloMateriasPlanesNuevas) > 0) or (count($arregloMateriasPlanesNuevas) == 1) and (is_numeric($arregloMateriasPlanesNuevas[0]))) {
		foreach($arregloMateriasPlanesNuevas as $materia_plan) {
			$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($materia_plan);
			$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
			
			if (count($oPlanEstudio->buscarMateria($oMateriaPlan->getIdmateria())) == 0) {
		    	$oNuevoMateriaPlan = new MateriasPlanes();	    
				$oNuevoMateriaPlan = $oMateriaPlan->copy(false); // no deep copy required
				$oNuevoMateriaPlan->setIdplanestudio($request->getParameter('idplanestudio'));
			
				$oNuevoMateriaPlan->save();
			}
		} 
	}
	echo "El elemento se ha creado correctamente.";
	
	return sfView::NONE;
  }
  	 	 
  public function executeObtenermesasexamenes(sfWebRequest $request)
  {
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	
  	$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('idmateriaplan'));
  	$oCatedra = $oMateriaPlan->obtenerCatedra($idsede);
  	// Obtener las mesas de examenes para la materia cuyo estado este Pendiente
	$this->mesasexamenes = $oCatedra->obtenerMesasExamenes(MESASCREADAS);
  }
  	
  // Obtiene las materias optativas de un materia generica
  public function executeObtenermateriasoptativas(sfWebRequest $request)	
  {
	$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('idmateriaplan'));
  	$this->form = new MateriasGenericasForm($oMateriaPlan->getGenerica(), $oMateriaPlan->getIdplanestudio());
	$this->form->setDefault('idmateriaplangenerica',$request->getParameter('idmateriaplan'));
	// Obtiene las materias optativas de un materia generica			
	$this->materiasoptativas = $oMateriaPlan->obtenerMateriasComponentes();
  }

  // Busca las materias por carrera
  public function executeBuscar(sfWebRequest $request)
  {
  	$this->form = new BuscarMateriasPlanForm();
  }
    
  public function executeMigrar(sfWebRequest $request)
  {
    $this->idplandestino = $request->getParameter('idplanestudio');
    $oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplandestino);
    $this->idplanorigen = $oPlanEstudio->getIdplananterior();
	
    $this->materias_origen = Doctrine_Core::getTable('MateriasPlanes')
		->createQuery('a')
		->where('a.idplanestudio = ?', $this->idplanorigen)
		->orderBy('a.orden ASC')
		->execute();  

	$this->materias_destino = Doctrine_Core::getTable('MateriasPlanes')
		->createQuery('a')
		->where('a.idplanestudio = ?', $this->idplandestino)
		->orderBy('a.orden ASC')
		->execute();  		
	
	$this->idcarrera = $oPlanEstudio->getIdcarrera();	      	
  }
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->idplanestudio = $request->getParameter('idplanestudio');
    $this->planestudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
    $this->cargahorariatotal = 0; 
    $this->cantobl = 0;
    $this->cantpre = 0;
    $this->cantopt = 0;
    $this->cantext = 0;
    $this->canttes = 0;
    $this->canttp = 0;
    
    if($this->idplanestudio){
	    $q = Doctrine_Core::getTable('MateriasPlanes')
	      ->createQuery('a')
	      ->where('a.idplanestudio = ?', $this->idplanestudio)
	      ->orderBy('a.orden ASC');    
	    
	    // Calcula las cantidades de materias y horas cargadas
	    foreach ($q->execute() as $mp) {
	    	$this->cargahorariatotal = $this->cargahorariatotal + $mp->cargahorariatotal;
	    	switch ($mp->idtipomateria) {
	    		case 1: // Obligatoria
	    			$this->cantobl++;
	    			break;
	    		case 3: // Preuniversitario
	    			$this->cantpre++;
	    			break;
	    		case 4: // Optativa
	    			$this->cantopt++;
	    			break;
	    		case 5: // Extracurricular
	    			$this->cantext++;
	    			break;
	    		case 6: // Tesina
	    			$this->canttes++;
	    			break;	
	    		case 7: // Trabajo Final
	    			$this->canttp++;
	    			break;	    			    					    			
	    	}
	    }
	    $oCarrera = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
	    $this->idcarrera = $oCarrera->getIdcarrera();	      	
    } else {
	    $q = Doctrine_Core::getTable('MateriasPlanes')
	      ->createQuery('a');
		$this->idcarrera = 0;
    }      
    
    $this->pager = new sfDoctrinePager(
      'MateriasPlanes',
      100
    );
    $this->pager->setQuery($q);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();         
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idplanestudio = $request->getParameter('idplanestudio');
     
  	$this->form = new MateriasPlanesForm();
    $this->form->setDefault('idplanestudio',$request->getParameter('idplanestudio'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MateriasPlanesForm();
  
    $this->processForm($request, $this->form);
    $arrMateriaPlan = $request['materias_planes'];
    $this->idplanestudio = $arrMateriaPlan['idplanestudio'];
    
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($materias_planes = Doctrine_Core::getTable('MateriasPlanes')->find(array($request->getParameter('idmateriaplan'))), sprintf('Object materias_planes does not exist (%s).', $request->getParameter('idmateriaplan')));
    $this->form = new MateriasPlanesForm($materias_planes);
    
    $this->idplanestudio = $materias_planes->getIdplanestudio();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($materias_planes = Doctrine_Core::getTable('MateriasPlanes')->find(array($request->getParameter('idmateriaplan'))), sprintf('Object materias_planes does not exist (%s).', $request->getParameter('idmateriaplan')));
    $this->form = new MateriasPlanesForm($materias_planes);

    $this->processForm($request, $this->form);
    
    $this->idplanestudio = $materias_planes->getIdplanestudio();

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($materias_planes = Doctrine_Core::getTable('MateriasPlanes')->find(array($request->getParameter('idmateriaplan'))), sprintf('Object materias_planes does not exist (%s).', $request->getParameter('idmateriaplan')));
    
    $catedras = Doctrine_Core::getTable('Catedras')->findByIdmateriaplan($materias_planes->getIdmateriaplan());
    if(count($catedras) > 0) {    
    	foreach ($catedras as $catedra) {
    		$catedra->delete();
    	}
    }    
    $materias_planes->delete();
    
    $this->redirect('materiasplanes/index?idplanestudio='.$materias_planes->getIdplanestudio());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {	  	
  	$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
  	
    if ($form->isValid())
    {
    	$materias_planes = $form->save();

    	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($materias_planes->getIdplanestudio());
    	$sedes = Doctrine_Core::getTable('CarrerasSede')->findByIdcarrera($oPlanEstudio->getIdcarrera());       
    	    	
      	$this->redirect('materiasplanes/edit?idmateriaplan='.$materias_planes->getIdmateriaplan());
    }
  }
}
