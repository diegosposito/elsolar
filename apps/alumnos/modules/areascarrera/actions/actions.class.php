<?php

/**
 * areascarrera actions.
 *
 * @package    sig
 * @subpackage areascarrera
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areascarreraActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->areas_carreras = Doctrine_Core::getTable('AreasCarrera')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreasCarreraForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AreasCarreraForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($areas_carrera = Doctrine_Core::getTable('AreasCarrera')->find(array($request->getParameter('id'))), sprintf('Object areas_carrera does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreasCarreraForm($areas_carrera);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($areas_carrera = Doctrine_Core::getTable('AreasCarrera')->find(array($request->getParameter('id'))), sprintf('Object areas_carrera does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreasCarreraForm($areas_carrera);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($areas_carrera = Doctrine_Core::getTable('AreasCarrera')->find(array($request->getParameter('id'))), sprintf('Object areas_carrera does not exist (%s).', $request->getParameter('id')));
    $areas_carrera->delete();

    $this->redirect('areascarrera/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $areas_carrera = $form->save();

      $this->redirect('areascarrera/edit?id='.$areas_carrera->getId());
    }
  }
}
