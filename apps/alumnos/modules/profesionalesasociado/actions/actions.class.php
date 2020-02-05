<?php

/**
 * profesionalesasociado actions.
 *
 * @package    sig
 * @subpackage profesionalesasociado
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesionalesasociadoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->profesionalesasociados = Doctrine_Core::getTable('Profesionalesasociado')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->profesionalesasociado = Doctrine_Core::getTable('Profesionalesasociado')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->profesionalesasociado);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProfesionalesasociadoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProfesionalesasociadoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($profesionalesasociado = Doctrine_Core::getTable('Profesionalesasociado')->find(array($request->getParameter('id'))), sprintf('Object profesionalesasociado does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfesionalesasociadoForm($profesionalesasociado);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($profesionalesasociado = Doctrine_Core::getTable('Profesionalesasociado')->find(array($request->getParameter('id'))), sprintf('Object profesionalesasociado does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfesionalesasociadoForm($profesionalesasociado);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($profesionalesasociado = Doctrine_Core::getTable('Profesionalesasociado')->find(array($request->getParameter('id'))), sprintf('Object profesionalesasociado does not exist (%s).', $request->getParameter('id')));
    $profesionalesasociado->delete();

    $this->redirect('profesionalesasociado/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $profesionalesasociado = $form->save();

      $this->redirect('profesionalesasociado/edit?id='.$profesionalesasociado->getId());
    }
  }
}
