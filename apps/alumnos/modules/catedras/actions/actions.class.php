<?php

/**
 * catedras actions.
 *
 * @package    sig
 * @subpackage catedras
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class catedrasActions extends sfActions
{
	public function executeActivar(sfWebRequest $request)
	{
		$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
		if ($oCatedra->getActiva()==1) {
			$oCatedra->setActiva(0);
			$resultado = "La catedra ha sido desactivada.";
		} else {
			$oCatedra->setActiva(1);
			$resultado = "La catedra ha sido activada.";
		}
		$oCatedra->save();
		
		echo $resultado;
	
		return sfView::NONE;
	}
	
  public function executeObtenermesasexamenes(sfWebRequest $request)
  {	
  	$this->mesasexamenes = array();
  	$mesasexamenescreadas = array();
  	$mesasexamenespublicadas = array();
  	$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
  	// Obtener las mesas de examenes para la materia cuyo estado este Pendiente
	$mesasexamenescreadas = $oCatedra->obtenerMesasExamenes(MESASCREADAS);
	foreach($mesasexamenescreadas as $mesa) {
		array_push($this->mesasexamenes, $mesa);
	}
  	// Obtener las mesas de examenes para la materia cuyo estado este Publicada
	$mesasexamenespublicadas = $oCatedra->obtenerMesasExamenes(MESASPUBLICADAS);	
	foreach($mesasexamenespublicadas as $mesa) {
		array_push($this->mesasexamenes, $mesa);
	}	
  }
  
  public function executeObtenermesasexamenespromocion(sfWebRequest $request)
  {	
  	$this->mesasexamenes = array();
  	$mesasexamenes = array();
  	$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
  	// Obtener las mesas de examenes para la catedra
	$mesasexamenes = $oCatedra->obtenerMesasExamenesPromocion();
	foreach($mesasexamenes as $mesa) {
		array_push($this->mesasexamenes, $mesa);
	}
	$this->setTemplate('obtenermesasexamenes');
  }  

  public function executeObtenermesasexamenesautogestion(sfWebRequest $request)
  {	

  	$this->mesasexamenes = array();
  	$mesasexamenes = array();
  	$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
	//$oCatedras->setIdllamado($request->getParameter('idllamado'));
  	// Obtener las mesas de examenes para la catedra
	$mesasexamenes = $oCatedra->obtenerMesasExamenesAutogestion($request->getParameter('idllamado'));
	foreach($mesasexamenes as $mesa) {
		array_push($this->mesasexamenes, $mesa);
	}
	$this->setTemplate('obtenermesasexamenesautogestion');
  }  

  	
  public function executeBuscar(sfWebRequest $request)
  {
  	$this->form = new BuscarCatedrasForm();
  }
	
  public function executeGenerar(sfWebRequest $request)
  {  
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	//$catedras = $oPlanEstudio->obtenerCatedras($request->getParameter('idsede'));
	
	$materias_planes = Doctrine_Core::getTable('MateriasPlanes')->findByIdplanestudio($request->getParameter('idplanestudio'));
		  	
	foreach($materias_planes as $materia) {
		$oCatedra = $materia->obtenerCatedra($request->getParameter('idsede')); 
		if (!$oCatedra) { 
			// Crea la catedra
			$oCatedra = new Catedras();
			$oCatedra->setIdsede($request->getParameter('idsede'));
			$oCatedra->setIdmateriaplan($materia->getIdmateriaplan());
			$oCatedra->setActiva(1);
			$oCatedra->save();
		}
	}
	$resultado = "Se ha generado correctamente las catedras.";  	
  	
  	echo $resultado;
	
	return sfView::NONE;
  }
    
  public function executeObtenercomisiones(sfWebRequest $request)
  {
  	$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
  	$this->comisiones = $oCatedra->obtenerComisiones();
  }
  
  public function executeObtenerllamados(sfWebRequest $request)
  {
  	$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
  	$this->llamados = $oCatedra->obtenerLlamadosAutogestion();
  }
	
  public function executeIndex(sfWebRequest $request)
  {
	$this->idplanestudio = $request->getParameter('idplanestudio');
	$this->idsede = $request->getParameter('idsede');
	
	$this->planestudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
	$this->sede = Doctrine_Core::getTable('Sedes')->find($this->idsede);
	$this->cantidadMaterias = count($this->planestudio->obtenerMaterias(MATERIASNOGENERICAS));
	$this->cantidadCatedras = count($this->planestudio->obtenerCatedras($this->idsede));
	
	$this->getUser()->setAttribute('idplanestudio', $this->idplanestudio);
	$this->getUser()->setAttribute('idsede', $this->idsede);
	
    $q = Doctrine_Core::getTable('Catedras')
      ->createQuery('c')
      ->innerJoin('c.MateriasPlanes m ON c.idmateriaplan = m.idmateriaplan')
      ->where('c.idsede = ?', $this->idsede)
      ->andWhere('m.idplanestudio = ?', $this->idplanestudio)
      ->orderBy('m.orden ASC');

     $this->pager = new sfDoctrinePager(
      'Catedras',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();         
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CatedrasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CatedrasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($catedras = Doctrine_Core::getTable('Catedras')->find(array($request->getParameter('idcatedra'))), sprintf('Object catedras does not exist (%s).', $request->getParameter('idcatedra')));
    $this->form = new CatedrasForm($catedras);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($catedras = Doctrine_Core::getTable('Catedras')->find(array($request->getParameter('idcatedra'))), sprintf('Object catedras does not exist (%s).', $request->getParameter('idcatedra')));
    $this->form = new CatedrasForm($catedras);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($catedras = Doctrine_Core::getTable('Catedras')->find(array($request->getParameter('idcatedra'))), sprintf('Object catedras does not exist (%s).', $request->getParameter('idcatedra')));
    $catedras->delete();

    $this->redirect('catedras/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $catedras = $form->save();

      $this->redirect('catedras/edit?idcatedra='.$catedras->getIdcatedra());
    }
  }
}
