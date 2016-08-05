<?php

/**
 * estudios actions.
 *
 * @package    sig
 * @subpackage estudios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estudiosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->estudioss = Doctrine_Core::getTable('Estudios')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EstudiosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EstudiosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estudios = Doctrine_Core::getTable('Estudios')->find(array($request->getParameter('idestudio'))), sprintf('Object estudios does not exist (%s).', $request->getParameter('idestudio')));
    $this->form = new EstudiosForm($estudios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estudios = Doctrine_Core::getTable('Estudios')->find(array($request->getParameter('idestudio'))), sprintf('Object estudios does not exist (%s).', $request->getParameter('idestudio')));
    $this->form = new EstudiosForm($estudios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($estudios = Doctrine_Core::getTable('Estudios')->find(array($request->getParameter('idestudio'))), sprintf('Object estudios does not exist (%s).', $request->getParameter('idestudio')));
    $estudios->delete();

    $this->redirect('estudios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $estudios = $form->save();

      $this->redirect('estudios/edit?idestudio='.$estudios->getIdestudio());
    }
  }
}
