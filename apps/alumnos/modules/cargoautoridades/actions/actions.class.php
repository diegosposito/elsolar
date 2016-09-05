<?php

/**
 * cargoautoridades actions.
 *
 * @package    sig
 * @subpackage cargoautoridades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cargoautoridadesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cargo_autoridadess = Doctrine_Core::getTable('CargoAutoridades')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->cargo_autoridades = Doctrine_Core::getTable('CargoAutoridades')->find(array($request->getParameter('idcargoautoridad')));
    $this->forward404Unless($this->cargo_autoridades);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CargoAutoridadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CargoAutoridadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cargo_autoridades = Doctrine_Core::getTable('CargoAutoridades')->find(array($request->getParameter('idcargoautoridad'))), sprintf('Object cargo_autoridades does not exist (%s).', $request->getParameter('idcargoautoridad')));
    $this->form = new CargoAutoridadesForm($cargo_autoridades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cargo_autoridades = Doctrine_Core::getTable('CargoAutoridades')->find(array($request->getParameter('idcargoautoridad'))), sprintf('Object cargo_autoridades does not exist (%s).', $request->getParameter('idcargoautoridad')));
    $this->form = new CargoAutoridadesForm($cargo_autoridades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cargo_autoridades = Doctrine_Core::getTable('CargoAutoridades')->find(array($request->getParameter('idcargoautoridad'))), sprintf('Object cargo_autoridades does not exist (%s).', $request->getParameter('idcargoautoridad')));
    $cargo_autoridades->delete();

    $this->redirect('cargoautoridades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cargo_autoridades = $form->save();

      $this->redirect('cargoautoridades/edit?idcargoautoridad='.$cargo_autoridades->getIdcargoautoridad());
    }
  }
}
