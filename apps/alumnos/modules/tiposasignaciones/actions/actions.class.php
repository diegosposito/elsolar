<?php

/**
 * tiposasignaciones actions.
 *
 * @package    sig
 * @subpackage tiposasignaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposasignacionesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_asignacioness = Doctrine_Core::getTable('TiposAsignaciones')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposAsignacionesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposAsignacionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_asignaciones = Doctrine_Core::getTable('TiposAsignaciones')->find(array($request->getParameter('idtipoasignacion'))), sprintf('Object tipos_asignaciones does not exist (%s).', $request->getParameter('idtipoasignacion')));
    $this->form = new TiposAsignacionesForm($tipos_asignaciones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_asignaciones = Doctrine_Core::getTable('TiposAsignaciones')->find(array($request->getParameter('idtipoasignacion'))), sprintf('Object tipos_asignaciones does not exist (%s).', $request->getParameter('idtipoasignacion')));
    $this->form = new TiposAsignacionesForm($tipos_asignaciones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_asignaciones = Doctrine_Core::getTable('TiposAsignaciones')->find(array($request->getParameter('idtipoasignacion'))), sprintf('Object tipos_asignaciones does not exist (%s).', $request->getParameter('idtipoasignacion')));
    $tipos_asignaciones->delete();

    $this->redirect('tiposasignaciones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_asignaciones = $form->save();

      $this->redirect('tiposasignaciones/edit?idtipoasignacion='.$tipos_asignaciones->getIdtipoasignacion());
    }
  }
}
