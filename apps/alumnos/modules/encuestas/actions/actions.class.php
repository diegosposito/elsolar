<?php

/**
 * encuestas actions.
 *
 * @package    sig
 * @subpackage encuestas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class encuestasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->encuestass = Doctrine_Core::getTable('Encuestas')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->encuestas = Doctrine_Core::getTable('Encuestas')->find(array($request->getParameter('idencuesta')));
    $this->forward404Unless($this->encuestas);
  }

  public function executeNew(sfWebRequest $request)
  {
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	
  	$this->form = new EncuestasForm();
    $this->form->setDefault('idsede', $idsede);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EncuestasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($encuestas = Doctrine_Core::getTable('Encuestas')->find(array($request->getParameter('idencuesta'))), sprintf('Object encuestas does not exist (%s).', $request->getParameter('idencuesta')));
    $this->form = new EncuestasForm($encuestas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($encuestas = Doctrine_Core::getTable('Encuestas')->find(array($request->getParameter('idencuesta'))), sprintf('Object encuestas does not exist (%s).', $request->getParameter('idencuesta')));
    $this->form = new EncuestasForm($encuestas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($encuestas = Doctrine_Core::getTable('Encuestas')->find(array($request->getParameter('idencuesta'))), sprintf('Object encuestas does not exist (%s).', $request->getParameter('idencuesta')));
    $encuestas->delete();

    $this->redirect('encuestas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $encuestas = $form->save();

      $this->redirect('encuestas/edit?idencuesta='.$encuestas->getIdencuesta());
    }
  }
}
