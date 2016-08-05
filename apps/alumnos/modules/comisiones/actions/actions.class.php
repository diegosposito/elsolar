<?php

/**
 * comisiones actions.
 *
 * @package    sig
 * @subpackage comisiones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comisionesActions extends sfActions
{
	public function executeObtenernombre(sfWebRequest $request)
	{
    	$oComision = Doctrine_Core::getTable('Comisiones')
	    	->createQuery('c')
	    	->where('c.idcatedra = ?', $request->getParameter('idcatedra'))
	    	->orderBy('c.idcomision DESC')
	    	->fetchOne();
	    	
	    	if ($oComision) {
	    		$cadena = explode("-",$oComision->getNombre());
	    		$i = $cadena[2] + 1;    		
	    	} else {
	    		$i = 1;
	    	}
	
	    	$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
	    	
		echo 'C-'.$oCatedra->getMateriasPlanes()->getIdmateria().'-'.$i;   
		 
		return sfView::NONE;
	}
		
  public function executeObtenerfechas(sfWebRequest $request)
  {
  	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));

  	$this->fechas = $oComision->obtenerFechas();
  }
  
  public function executeActivar(sfWebRequest $request)
  {
    $oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));
    $oComision->setActivo($request->getParameter('activo'));
    $oComision->save();
        
    $this->redirect('comisiones/index?idplanestudio='.$this->getUser()->getAttribute('idplanestudio').'&idsede='.$this->getUser()->getAttribute('idsede'));
  }
  	
  public function executeCrear(sfWebRequest $request)
  {  
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$catedras = $oPlanEstudio->obtenerCatedras($request->getParameter('idsede'));
	
	$materias_planes = Doctrine_Core::getTable('MateriasPlanes')->findByIdplanestudio($request->getParameter('idplanestudio'));

	foreach($materias_planes as $materia) {
		$oCatedra = $materia->obtenerCatedra($request->getParameter('idsede')); 
		if ($oCatedra) { 
			// Crea las comisiones
			for ($i = 1; $i <= $request->getParameter('cantidad'); $i++) {
				$oComision = new Comisiones();
				$oComision->setNombre('C-'.$oCatedra->getMateriasPlanes()->getIdmateria().'--'.$i);
				$oComision->setDescripcion('Comisión '.$i);
				$oComision->setIdcatedra($oCatedra->getIdcatedra());
				$oComision->setInscripcionhabilitada($request->getParameter('inscripcionhabilitada'));
				$oComision->setCapacidad($request->getParameter('capacidad'));
				$oComision->setTurno($request->getParameter('turno'));
				$oComision->setIdestadocomision(1);
				$oComision->save();
			}
		}
	}
	
	$resultado = "Se ha generado correctamente las comisiones.";  	
  	
  	echo $resultado;
	
	return sfView::NONE;
  }
	
  public function executeGenerar(sfWebRequest $request)
  {
  	$this->form = new GenerarComisionesForm();
  }
    
  public function executeBuscar(sfWebRequest $request)
  {
  	$this->form = new BuscarComisionesForm();
  }

  public function executeIndex(sfWebRequest $request)
  {
	$this->idplanestudio = $request->getParameter('idplanestudio');
	$this->idsede = $request->getParameter('idsede');
	
	$this->planestudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
	$this->sede = Doctrine_Core::getTable('Sedes')->find($this->idsede);
	$catedras = $this->planestudio->obtenerCatedras($this->idsede);
	$this->cantidadCatedras = count($catedras);
	$i = 0;
	foreach($catedras as $catedra) {
		$cantidad = count($catedra->obtenerComisiones());
		$i = $i + $cantidad;
	}
	$this->cantidadComisiones = $i;
	
	$this->getUser()->setAttribute('idplanestudio', $this->idplanestudio);
	$this->getUser()->setAttribute('idsede', $this->idsede);
	
    $q = Doctrine_Core::getTable('Comisiones')
      ->createQuery('co')
      ->innerJoin('co.Catedras ca ON co.idcatedra = ca.idcatedra')
      ->innerJoin('ca.MateriasPlanes mp ON ca.idmateriaplan = mp.idmateriaplan')
      ->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
      ->where('ca.idsede = ?', $this->idsede)
      ->andWhere('mp.idplanestudio = ?', $this->idplanestudio)
      ->orderBy('ma.nombre ASC');

     $this->pager = new sfDoctrinePager(
      'Comisiones',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();         
  }

  public function executeNew(sfWebRequest $request)
  {	    
    $this->idcatedra = $request->getParameter('idcatedra');
    $this->idplanestudio = $request->getParameter('idplanestudio');
    
	$this->catedras = Doctrine_Query::create()
		->select('ca.*, ma.nombre as nombre, mp.anodecursada AS curso')
		->from('Catedras ca')
		->innerJoin('ca.MateriasPlanes mp ON ca.idmateriaplan = mp.idmateriaplan')
		->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
		->where('mp.idplanestudio = ?', $request->getParameter('idplanestudio'))
		->andWhere('ca.idsede = ?', $this->getUser()->getAttribute('idsede'))
		->orderBy('ma.nombre ASC')
		->groupBy('ca.idcatedra')
		->execute();			

  	$this->form = new ComisionesForm();
  	
  }

  public function executeCreate(sfWebRequest $request)
  {
  	$arregloComisiones = $request->getParameter('comisiones');
  	$this->idcatedra = $arregloComisiones['idcatedra'];
  	$this->idplanestudio = $request->getParameter('idplanestudio');

  	$this->catedras = Doctrine_Query::create()
	  	->select('ca.*, ma.nombre as nombre, mp.anodecursada AS curso')
	  	->from('Catedras ca')
	  	->innerJoin('ca.MateriasPlanes mp ON ca.idmateriaplan = mp.idmateriaplan')
	  	->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
	  	->where('mp.idplanestudio = ?', $request->getParameter('idplanestudio'))
	  	->andWhere('ca.idsede = ?', $this->getUser()->getAttribute('idsede'))
	  	->orderBy('ma.nombre ASC')
	  	->groupBy('ca.idcatedra')
	  	->execute();
  	
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ComisionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  	$this->idcomision = $request->getParameter('idcomision');
  	$this->idplanestudio = $request->getParameter('idplanestudio');
	$oComision = Doctrine_Core::getTable('Comisiones')->find($this->idcomision);
	$this->idcatedra = $oComision->getIdcatedra();
	
  	$this->catedras = Doctrine_Query::create()
		->select('ca.*, ma.nombre as nombre, mp.anodecursada AS curso')
		->from('Catedras ca')
		->innerJoin('ca.MateriasPlanes mp ON ca.idmateriaplan = mp.idmateriaplan')
		->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
		->where('mp.idplanestudio = ?', $request->getParameter('idplanestudio'))
		->andWhere('ca.idsede = ?', $this->getUser()->getAttribute('idsede'))
		->orderBy('ma.nombre ASC')
		->groupBy('ca.idcatedra')
		->execute();	
		    
  	$this->forward404Unless($comisiones = Doctrine_Core::getTable('Comisiones')->find(array($request->getParameter('idcomision'))), sprintf('Object comisiones does not exist (%s).', $request->getParameter('idcomision')));
    $this->form = new ComisionesForm($comisiones); 
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($comisiones = Doctrine_Core::getTable('Comisiones')->find(array($request->getParameter('idcomision'))), sprintf('Object comisiones does not exist (%s).', $request->getParameter('idcomision')));
    $this->form = new ComisionesForm($comisiones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($comisiones = Doctrine_Core::getTable('Comisiones')->find(array($request->getParameter('idcomision'))), sprintf('Object comisiones does not exist (%s).', $request->getParameter('idcomision')));
    
    //$comisiones = Doctrine_Core::getTable('Comisiones')->findByIdcatedra($comisiones->getIdcatedra());
    
    $comisiones->delete();

    $this->redirect('comisiones/index?idplanestudio='.$this->getUser()->getAttribute('idplanestudio').'&idsede='.$this->getUser()->getAttribute('idsede'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $comisiones = $form->save();
      
      $this->idplanestudio = $request->getParameter('idplanestudio');
      
      $this->redirect('comisiones/edit?idcomision='.$comisiones->getIdcomision().'&idplanestudio='.$this->idplanestudio);
    }
  }
}
