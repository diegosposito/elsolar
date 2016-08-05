<?php

/**
 * empleadossede actions.
 *
 * @package    sig
 * @subpackage empleadossede
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empleadossedeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->empleados_sedes = Doctrine_Core::getTable('EmpleadosSede')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->empleados_sede = Doctrine_Core::getTable('EmpleadosSede')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->empleados_sede);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EmpleadosSedeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EmpleadosSedeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($empleados_sede = Doctrine_Core::getTable('EmpleadosSede')->find(array($request->getParameter('id'))), sprintf('Object empleados_sede does not exist (%s).', $request->getParameter('id')));
    $this->form = new EmpleadosSedeForm($empleados_sede);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($empleados_sede = Doctrine_Core::getTable('EmpleadosSede')->find(array($request->getParameter('id'))), sprintf('Object empleados_sede does not exist (%s).', $request->getParameter('id')));
    $this->form = new EmpleadosSedeForm($empleados_sede);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($empleados_sede = Doctrine_Core::getTable('EmpleadosSede')->find(array($request->getParameter('id'))), sprintf('Object empleados_sede does not exist (%s).', $request->getParameter('id')));
    $empleados_sede->delete();

    $this->redirect('empleadossede/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $empleados_sede = $form->save();

      $this->redirect('empleadossede/edit?id='.$empleados_sede->getId());
    }
  }
}
