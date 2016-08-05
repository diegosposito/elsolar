<?php

/**
 * resolucionesprofesores actions.
 *
 * @package    sig
 * @subpackage resolucionesprofesores
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resolucionesprofesoresActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->resoluciones_profesoress = Doctrine_Core::getTable('ResolucionesProfesores')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ResolucionesProfesoresForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ResolucionesProfesoresForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($resoluciones_profesores = Doctrine_Core::getTable('ResolucionesProfesores')->find(array($request->getParameter('idresolucionprofesor'))), sprintf('Object resoluciones_profesores does not exist (%s).', $request->getParameter('idresolucionprofesor')));
    $this->form = new ResolucionesProfesoresForm($resoluciones_profesores);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($resoluciones_profesores = Doctrine_Core::getTable('ResolucionesProfesores')->find(array($request->getParameter('idresolucionprofesor'))), sprintf('Object resoluciones_profesores does not exist (%s).', $request->getParameter('idresolucionprofesor')));
    $this->form = new ResolucionesProfesoresForm($resoluciones_profesores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($resoluciones_profesores = Doctrine_Core::getTable('ResolucionesProfesores')->find(array($request->getParameter('idresolucionprofesor'))), sprintf('Object resoluciones_profesores does not exist (%s).', $request->getParameter('idresolucionprofesor')));
    $resoluciones_profesores->delete();

    $this->redirect('resolucionesprofesores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $resoluciones_profesores = $form->save();

      $this->redirect('resolucionesprofesores/edit?idresolucionprofesor='.$resoluciones_profesores->getIdresolucionprofesor());
    }
  }
}
