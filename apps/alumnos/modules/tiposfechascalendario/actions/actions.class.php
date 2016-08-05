<?php

/**
 * tiposfechascalendario actions.
 *
 * @package    sig
 * @subpackage tiposfechascalendario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposfechascalendarioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_fechas_calendarios = Doctrine_Core::getTable('TiposFechasCalendario')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposFechasCalendarioForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposFechasCalendarioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_fechas_calendario = Doctrine_Core::getTable('TiposFechasCalendario')->find(array($request->getParameter('idtipo'))), sprintf('Object tipos_fechas_calendario does not exist (%s).', $request->getParameter('idtipo')));
    $this->form = new TiposFechasCalendarioForm($tipos_fechas_calendario);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_fechas_calendario = Doctrine_Core::getTable('TiposFechasCalendario')->find(array($request->getParameter('idtipo'))), sprintf('Object tipos_fechas_calendario does not exist (%s).', $request->getParameter('idtipo')));
    $this->form = new TiposFechasCalendarioForm($tipos_fechas_calendario);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_fechas_calendario = Doctrine_Core::getTable('TiposFechasCalendario')->find(array($request->getParameter('idtipo'))), sprintf('Object tipos_fechas_calendario does not exist (%s).', $request->getParameter('idtipo')));
    $tipos_fechas_calendario->delete();

    $this->redirect('tiposfechascalendario/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_fechas_calendario = $form->save();

      $this->redirect('tiposfechascalendario/edit?idtipo='.$tipos_fechas_calendario->getIdtipo());
    }
  }
}
