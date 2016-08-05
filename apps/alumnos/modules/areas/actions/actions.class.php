<?php

/**
 * areas actions.
 *
 * @package    sig
 * @subpackage areas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areasActions extends sfActions
{
  public function executeObtenercargos(sfWebRequest $request)
  {
  	$oArea = Doctrine_Core::getTable('Areas')->find($request->getParameter('idarea'));
  	
	$this->cargos = $oArea->obtenerCargos();  	
  }
  	
  public function executeIndex(sfWebRequest $request)
  {
    $this->areass = Doctrine_Core::getTable('Areas')
      ->createQuery('a')
      ->execute();
  }
  
    
  public function executeObtenercarrerasxsede(sfWebRequest $request)
  {
	$oArea = Doctrine_Core::getTable('Areas')->find($request->getParameter('idarea'));
  	
	$this->carreras = $oArea->obtenerCarreras();
  }
  

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AreasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($areas = Doctrine_Core::getTable('Areas')->find(array($request->getParameter('idarea'))), sprintf('Object areas does not exist (%s).', $request->getParameter('idarea')));
    $this->form = new AreasForm($areas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($areas = Doctrine_Core::getTable('Areas')->find(array($request->getParameter('idarea'))), sprintf('Object areas does not exist (%s).', $request->getParameter('idarea')));
    $this->form = new AreasForm($areas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($areas = Doctrine_Core::getTable('Areas')->find(array($request->getParameter('idarea'))), sprintf('Object areas does not exist (%s).', $request->getParameter('idarea')));
    $areas->delete();

    $this->redirect('areas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $areas = $form->save();

      $this->redirect('areas/edit?idarea='.$areas->getIdarea());
    }
  }
}
