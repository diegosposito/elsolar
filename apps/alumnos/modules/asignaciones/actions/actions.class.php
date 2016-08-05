<?php

/**
 * asignaciones actions.
 *
 * @package    sig
 * @subpackage asignaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class asignacionesActions extends sfActions
{  	
  public function executeIndex(sfWebRequest $request)
  {
    $this->asignacioness = Doctrine_Core::getTable('Asignaciones')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AsignacionesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AsignacionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($asignaciones = Doctrine_Core::getTable('Asignaciones')->find(array($request->getParameter('idasignacion'))), sprintf('Object asignaciones does not exist (%s).', $request->getParameter('idasignacion')));
    $this->form = new AsignacionesForm($asignaciones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asignaciones = Doctrine_Core::getTable('Asignaciones')->find(array($request->getParameter('idasignacion'))), sprintf('Object asignaciones does not exist (%s).', $request->getParameter('idasignacion')));
    $this->form = new AsignacionesForm($asignaciones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($asignaciones = Doctrine_Core::getTable('Asignaciones')->find(array($request->getParameter('idasignacion'))), sprintf('Object asignaciones does not exist (%s).', $request->getParameter('idasignacion')));
    $asignaciones->delete();

    $this->redirect('asignaciones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $asignaciones = $form->save();

      $this->redirect('asignaciones/edit?idasignacion='.$asignaciones->getIdasignacion());
    }
  }
}
