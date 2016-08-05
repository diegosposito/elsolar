<?php

/**
 * dependencias actions.
 *
 * @package    sig
 * @subpackage dependencias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dependenciasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->dependenciass = Doctrine_Core::getTable('Dependencias')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DependenciasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DependenciasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($dependencias = Doctrine_Core::getTable('Dependencias')->find(array($request->getParameter('iddependencia'))), sprintf('Object dependencias does not exist (%s).', $request->getParameter('iddependencia')));
    $this->form = new DependenciasForm($dependencias);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($dependencias = Doctrine_Core::getTable('Dependencias')->find(array($request->getParameter('iddependencia'))), sprintf('Object dependencias does not exist (%s).', $request->getParameter('iddependencia')));
    $this->form = new DependenciasForm($dependencias);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($dependencias = Doctrine_Core::getTable('Dependencias')->find(array($request->getParameter('iddependencia'))), sprintf('Object dependencias does not exist (%s).', $request->getParameter('iddependencia')));
    $dependencias->delete();

    $this->redirect('dependencias/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $dependencias = $form->save();

      $this->redirect('dependencias/edit?iddependencia='.$dependencias->getIddependencia());
    }
  }
}
