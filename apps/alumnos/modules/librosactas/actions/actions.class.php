<?php

/**
 * librosactas actions.
 *
 * @package    sig
 * @subpackage librosactas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class librosactasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->libros_actass = Doctrine_Core::getTable('LibrosActas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LibrosActasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LibrosActasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($libros_actas = Doctrine_Core::getTable('LibrosActas')->find(array($request->getParameter('idlibroacta'))), sprintf('Object libros_actas does not exist (%s).', $request->getParameter('idlibroacta')));
    $this->form = new LibrosActasForm($libros_actas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($libros_actas = Doctrine_Core::getTable('LibrosActas')->find(array($request->getParameter('idlibroacta'))), sprintf('Object libros_actas does not exist (%s).', $request->getParameter('idlibroacta')));
    $this->form = new LibrosActasForm($libros_actas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($libros_actas = Doctrine_Core::getTable('LibrosActas')->find(array($request->getParameter('idlibroacta'))), sprintf('Object libros_actas does not exist (%s).', $request->getParameter('idlibroacta')));
    $libros_actas->delete();

    $this->redirect('librosactas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $libros_actas = $form->save();

      $this->redirect('librosactas/edit?idlibroacta='.$libros_actas->getIdlibroacta());
    }
  }
}
