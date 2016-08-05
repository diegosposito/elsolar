<?php

/**
 * transicionesmaterias actions.
 *
 * @package    sig
 * @subpackage transicionesmaterias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transicionesmateriasActions extends sfActions
{
  public function executeEliminar(sfWebRequest $request)
  {
    $oTransicionMateria = Doctrine_Core::getTable('TransicionesMaterias')->find($request->getParameter('idtransicionmateria'));
	$idtransicionmateria = $oTransicionMateria->getIdtransicionmateria();
    $oTransicionMateria->delete(); 
	
  	echo json_encode($idtransicionmateria);
	
  	return sfView::NONE;
  }
    
  public function executeIndex(sfWebRequest $request)
  {     
    $this->idtransicionplan = $request->getParameter('idtransicionplan');
    
  	if($this->idtransicionplan){
	  	$q = Doctrine_Core::getTable('TransicionesMaterias')
	      ->createQuery('a')
	      ->where('a.idtransicionplan = ?', $this->idtransicionplan);
    } else {
	  	$q = Doctrine_Core::getTable('TransicionesMaterias')
	      ->createQuery('a');
    }

     $this->pager = new sfDoctrinePager(
      'TransicionesMaterias',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();    
           
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idtransicionplan = $request->getParameter('idtransicionplan');
    $oTransicionPlan = Doctrine_Core::getTable('TransicionesPlanes')->find($this->idtransicionplan);
    $this->idplanorigen = $oTransicionPlan->getIdplanorigen();
	$this->idplandestino = $oTransicionPlan->getIdplandestino();        
  	$this->form = new TransicionesMateriasForm();
  	$this->form->setDefault('idtransicionplan', $this->idtransicionplan);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TransicionesMateriasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  	$this->idtransicionmateria = $request->getParameter('idtransicionmateria');
  	$oTransicionMateria = Doctrine_Core::getTable('TransicionesMaterias')->find($this->idtransicionmateria);
    $oTransicionPlan = $oTransicionMateria->getTransicionesPlanes();
    $this->idtransicionplan = $oTransicionPlan->getIdtransicionplan();
  	//$oTransicionPlan = Doctrine_Core::getTable('TransicionesPlanes')->find($this->idtransicionplan);
    $this->idplanorigen = $oTransicionPlan->getIdplanorigen();
	$this->idplandestino = $oTransicionPlan->getIdplandestino();        
  	
  	$this->forward404Unless($transiciones_materias = Doctrine_Core::getTable('TransicionesMaterias')->find(array($request->getParameter('idtransicionmateria'))), sprintf('Object transiciones_materias does not exist (%s).', $request->getParameter('idtransicionmateria')));
    $this->form = new TransicionesMateriasForm($transiciones_materias);
    //$this->form->setDefault('idtransicionplan', $this->idtransicionplan);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($transiciones_materias = Doctrine_Core::getTable('TransicionesMaterias')->find(array($request->getParameter('idtransicionmateria'))), sprintf('Object transiciones_materias does not exist (%s).', $request->getParameter('idtransicionmateria')));
    $this->form = new TransicionesMateriasForm($transiciones_materias);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($transiciones_materias = Doctrine_Core::getTable('TransicionesMaterias')->find(array($request->getParameter('idtransicionmateria'))), sprintf('Object transiciones_materias does not exist (%s).', $request->getParameter('idtransicionmateria')));
    $transiciones_materias->delete();

    $this->redirect('transicionesmaterias/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $transiciones_materias = $form->save();

      $this->redirect('transicionesmaterias/edit?idtransicionmateria='.$transiciones_materias->getIdtransicionmateria());
    }
  }
}
