<?php

/**
 * modosevaluaciones actions.
 *
 * @package    sig
 * @subpackage modosevaluaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class modosevaluacionesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->modos_evaluacioness = Doctrine_Core::getTable('ModosEvaluaciones')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ModosEvaluacionesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ModosEvaluacionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($modos_evaluaciones = Doctrine_Core::getTable('ModosEvaluaciones')->find(array($request->getParameter('idmodoevaluacion'))), sprintf('Object modos_evaluaciones does not exist (%s).', $request->getParameter('idmodoevaluacion')));
    $this->form = new ModosEvaluacionesForm($modos_evaluaciones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($modos_evaluaciones = Doctrine_Core::getTable('ModosEvaluaciones')->find(array($request->getParameter('idmodoevaluacion'))), sprintf('Object modos_evaluaciones does not exist (%s).', $request->getParameter('idmodoevaluacion')));
    $this->form = new ModosEvaluacionesForm($modos_evaluaciones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($modos_evaluaciones = Doctrine_Core::getTable('ModosEvaluaciones')->find(array($request->getParameter('idmodoevaluacion'))), sprintf('Object modos_evaluaciones does not exist (%s).', $request->getParameter('idmodoevaluacion')));
    $modos_evaluaciones->delete();

    $this->redirect('modosevaluaciones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $modos_evaluaciones = $form->save();

      $this->redirect('modosevaluaciones/edit?idmodoevaluacion='.$modos_evaluaciones->getIdmodoevaluacion());
    }
  }
}
