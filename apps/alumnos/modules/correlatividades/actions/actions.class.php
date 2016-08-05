<?php

/**
 * correlatividades actions.
 *
 * @package    sig
 * @subpackage correlatividades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class correlatividadesActions extends sfActions
{
	
  public function executeEliminar(sfWebRequest $request)
  {
  	$oCorrelatividad = Doctrine_Core::getTable('Correlatividades')->find($request->getParameter('idcorrelativa'));

    $oCorrelatividad->delete(); 
	
  	return sfView::NONE;
  }
  

  public function executeAgregar(sfWebRequest $request)
  { 
    $arregloCorrelatividad =$request->getParameter('correlatividades');
    
  	$this->form = new CorrelatividadesForm();
       
  	$this->form->bind($request->getParameter('correlatividades'));
    if ($this->form->isValid()) {
		$correlatividades = $this->form->save();
    } 

    return sfView::NONE;    
  } 
  	
  // Obtiene las materias de un plan de estudios
  public function executeObtenermateriascorrelativas(sfWebRequest $request)	
  {
	$this->idplanestudio = $request->getParameter('idplanestudio');
	$oPlanEstudio 	= Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
  	$this->estado 	= $oPlanEstudio->getIdestadoplan();
  	
	// Obtiene las materias de un plan de estudios				
	$q = Doctrine_Query::create()
		->select('c.*, m.nombre AS nombre, mc.nombre as nombrec')
		->from('Correlatividades c')
		->innerJoin('c.MateriasPlanes mp ON c.idmateriaplan = mp.idmateriaplan')
		->innerJoin('c.MateriasPlanes mpc ON c.idmateriaplanc = mpc.idmateriaplan')
		->innerJoin('mp.Materias m ON mp.idmateria = m.idmateria')
		->innerJoin('mpc.Materias mc ON mpc.idmateria = mc.idmateria')
	  	->where('mp.idplanestudio = '.$this->idplanestudio)
	  	->orderBy('m.nombre ASC');
	
	$this->pager = new sfDoctrinePager(
      'Correlatividades',
      100
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();     	
  }
  	
  public function executeBuscar(sfWebRequest $request)
  {
    $this->form = new BuscarPlanesForm();
  }
  	
  public function executeIndex(sfWebRequest $request)
  {
	$this->idplanestudio = $request->getParameter('idplanestudio');

	$oPlanEstudio 	= Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
  	$this->estado 	= $oPlanEstudio->getIdestadoplan();
	$this->form		= new CorrelatividadesForm();
	//$materias 		= $oPlanEstudio->obtenerMaterias(MATERIASNOGENERICAS);
	$materias 		= $oPlanEstudio->obtenerTodasMaterias();
	
	foreach ($materias as $materia) {
		$arregloMaterias[$materia->idmateriaplan] = $materia->nombre; 
	}
	$this->form->setWidget('idmateriaplan', new sfWidgetFormSelect(array('label' => '<p align="left">Materia:</p>', 'choices' => $arregloMaterias)));
	$this->form->setWidget('idmateriaplanc', new sfWidgetFormSelect(array('label' => '<p align="left">Correlativa:</p>', 'choices' => $arregloMaterias)));     
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CorrelatividadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CorrelatividadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($correlatividades = Doctrine_Core::getTable('Correlatividades')->find(array($request->getParameter('id'))), sprintf('Object correlatividades does not exist (%s).', $request->getParameter('id')));
    $this->form = new CorrelatividadesForm($correlatividades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($correlatividades = Doctrine_Core::getTable('Correlatividades')->find(array($request->getParameter('id'))), sprintf('Object correlatividades does not exist (%s).', $request->getParameter('id')));
    $this->form = new CorrelatividadesForm($correlatividades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($correlatividades = Doctrine_Core::getTable('Correlatividades')->find(array($request->getParameter('id'))), sprintf('Object correlatividades does not exist (%s).', $request->getParameter('id')));
    $correlatividades->delete();

    $this->redirect('correlatividades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $correlatividades = $form->save();

      $this->redirect('correlatividades/edit?id='.$correlatividades->getId());
    }
  }
}
