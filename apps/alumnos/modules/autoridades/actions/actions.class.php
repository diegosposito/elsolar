<?php

/**
 * autoridades actions.
 *
 * @package    sig
 * @subpackage autoridades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class autoridadesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->autoridadess = Doctrine_Core::getTable('Autoridades')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->autoridades = Doctrine_Core::getTable('Autoridades')->find(array($request->getParameter('idautoridad')));
    $this->forward404Unless($this->autoridades);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AutoridadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AutoridadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($autoridades = Doctrine_Core::getTable('Autoridades')->find(array($request->getParameter('idautoridad'))), sprintf('Object autoridades does not exist (%s).', $request->getParameter('idautoridad')));
    $this->form = new AutoridadesForm($autoridades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($autoridades = Doctrine_Core::getTable('Autoridades')->find(array($request->getParameter('idautoridad'))), sprintf('Object autoridades does not exist (%s).', $request->getParameter('idautoridad')));
    $this->form = new AutoridadesForm($autoridades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($autoridades = Doctrine_Core::getTable('Autoridades')->find(array($request->getParameter('idautoridad'))), sprintf('Object autoridades does not exist (%s).', $request->getParameter('idautoridad')));
    $autoridades->delete();

    $this->redirect('autoridades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $autoridades = $form->save();

      $this->redirect('autoridades/edit?idautoridad='.$autoridades->getIdautoridad());
    }
  }
}
