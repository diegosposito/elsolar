<?php

/**
 * edificios actions.
 *
 * @package    sig
 * @subpackage edificios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class edificiosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {      
    $this->idsede = $request->getParameter('idsede');
    $this->sede = Doctrine_Core::getTable('Sedes')->find($this->idsede);
  	if($this->idsede){
	  	$this->edificioss = Doctrine_Core::getTable('Edificios')
	      ->createQuery('a')
	      ->where('a.idsede = ?', $this->idsede)
	      ->execute();
    } else {
	  	$this->aulass = Doctrine_Core::getTable('Edificios')
	      ->createQuery('a')
	      ->execute();
    }           
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idsede = $request->getParameter('idsede');
    $this->form = new EdificiosForm();
    
    $this->form->setDefault('idsede', $this->idsede);      
  }

  public function executeCreate(sfWebRequest $request)
  {
  	$this->idsede = $request->getParameter('idsede');
  	
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EdificiosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($edificios = Doctrine_Core::getTable('Edificios')->find(array($request->getParameter('idedificio'))), sprintf('Object edificios does not exist (%s).', $request->getParameter('idedificio')));
    $this->form = new EdificiosForm($edificios);
    
    $this->idsede = $edificios->getIdsede();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($edificios = Doctrine_Core::getTable('Edificios')->find(array($request->getParameter('idedificio'))), sprintf('Object edificios does not exist (%s).', $request->getParameter('idedificio')));
    $this->form = new EdificiosForm($edificios);

    $this->processForm($request, $this->form);
    
    $this->idsede = $edificios->getIdsede();

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($edificios = Doctrine_Core::getTable('Edificios')->find(array($request->getParameter('idedificio'))), sprintf('Object edificios does not exist (%s).', $request->getParameter('idedificio')));
    $edificios->delete();

    $this->redirect('edificios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $edificios = $form->save();

      $this->redirect('edificios/edit?idedificio='.$edificios->getIdedificio());
    }
  }
}
