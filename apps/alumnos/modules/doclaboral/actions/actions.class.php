<?php

/**
 * doclaboral actions.
 *
 * @package    sig
 * @subpackage doclaboral
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class doclaboralActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->doc_laborals = Doctrine_Core::getTable('DocLaboral')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DocLaboralForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DocLaboralForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($doc_laboral = Doctrine_Core::getTable('DocLaboral')->find(array($request->getParameter('iddoclaboral'))), sprintf('Object doc_laboral does not exist (%s).', $request->getParameter('iddoclaboral')));
    $this->form = new DocLaboralForm($doc_laboral);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($doc_laboral = Doctrine_Core::getTable('DocLaboral')->find(array($request->getParameter('iddoclaboral'))), sprintf('Object doc_laboral does not exist (%s).', $request->getParameter('iddoclaboral')));
    $this->form = new DocLaboralForm($doc_laboral);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($doc_laboral = Doctrine_Core::getTable('DocLaboral')->find(array($request->getParameter('iddoclaboral'))), sprintf('Object doc_laboral does not exist (%s).', $request->getParameter('iddoclaboral')));
    $doc_laboral->delete();

    $this->redirect('doclaboral/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $doc_laboral = $form->save();

      $this->redirect('doclaboral/edit?iddoclaboral='.$doc_laboral->getIddoclaboral());
    }
  }
}
