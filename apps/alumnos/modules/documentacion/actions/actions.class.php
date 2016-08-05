<?php

/**
 * documentacion actions.
 *
 * @package    sig
 * @subpackage documentacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentacionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->documentacions = Doctrine_Core::getTable('Documentacion')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DocumentacionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DocumentacionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($documentacion = Doctrine_Core::getTable('Documentacion')->find(array($request->getParameter('iddocumentacion'))), sprintf('Object documentacion does not exist (%s).', $request->getParameter('iddocumentacion')));
    $this->form = new DocumentacionForm($documentacion);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($documentacion = Doctrine_Core::getTable('Documentacion')->find(array($request->getParameter('iddocumentacion'))), sprintf('Object documentacion does not exist (%s).', $request->getParameter('iddocumentacion')));
    $this->form = new DocumentacionForm($documentacion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($documentacion = Doctrine_Core::getTable('Documentacion')->find(array($request->getParameter('iddocumentacion'))), sprintf('Object documentacion does not exist (%s).', $request->getParameter('iddocumentacion')));
    $documentacion->delete();

    $this->redirect('documentacion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $documentacion = $form->save();

      $this->redirect('documentacion/edit?iddocumentacion='.$documentacion->getIddocumentacion());
    }
  }
}
