<?php

/**
 * clases actions.
 *
 * @package    sig
 * @subpackage clases
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clasesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->clasess = Doctrine_Core::getTable('Clases')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ClasesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ClasesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($clases = Doctrine_Core::getTable('Clases')->find(array($request->getParameter('idclase'))), sprintf('Object clases does not exist (%s).', $request->getParameter('idclase')));
    $this->form = new ClasesForm($clases);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($clases = Doctrine_Core::getTable('Clases')->find(array($request->getParameter('idclase'))), sprintf('Object clases does not exist (%s).', $request->getParameter('idclase')));
    $this->form = new ClasesForm($clases);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($clases = Doctrine_Core::getTable('Clases')->find(array($request->getParameter('idclase'))), sprintf('Object clases does not exist (%s).', $request->getParameter('idclase')));
    $clases->delete();

    $this->redirect('clases/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $clases = $form->save();

      $this->redirect('clases/edit?idclase='.$clases->getIdclase());
    }
  }
}
