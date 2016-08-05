<?php

/**
 * fechascalendario actions.
 *
 * @package    sig
 * @subpackage fechascalendario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fechascalendarioActions extends sfActions
{
  public function executeVermesas(sfWebRequest $request)
  {
	$this->mesas = Doctrine_Core::getTable('MesasExamenes')
		->createQuery('m')
		->where('idllamado='.$request->getParameter('idllamado'))
		->execute();
  }
		
  public function executeIndex(sfWebRequest $request)
  {
    $this->fechas_calendarios = Doctrine_Core::getTable('FechasCalendario')
      ->createQuery('a')
      ->where('idfecha='.$request->getParameter('idfecha'))
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idcalendario = $request->getParameter('id');
  	$this->form = new FechasCalendarioForm();
    $this->form->setDefault('idcalendario', $request->getParameter('id'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FechasCalendarioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($fechas_calendario = Doctrine_Core::getTable('FechasCalendario')->find(array($request->getParameter('idfecha'))), sprintf('Object fechas_calendario does not exist (%s).', $request->getParameter('idfecha')));
    $this->idcalendario = $this->idcalendario = $fechas_calendario->getIdcalendario();
    $this->form = new FechasCalendarioForm($fechas_calendario);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($fechas_calendario = Doctrine_Core::getTable('FechasCalendario')->find(array($request->getParameter('idfecha'))), sprintf('Object fechas_calendario does not exist (%s).', $request->getParameter('idfecha')));
    $this->form = new FechasCalendarioForm($fechas_calendario);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($fechas_calendario = Doctrine_Core::getTable('FechasCalendario')->find(array($request->getParameter('idfecha'))), sprintf('Object fechas_calendario does not exist (%s).', $request->getParameter('idfecha')));
    $fechas_calendario->delete();

    $this->redirect('fechascalendario/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fechas_calendario = $form->save();

      $this->redirect('calendarios/ver?idcalendario='.$fechas_calendario->getIdcalendario());
    }
  }


  public function executeGenerarmesas(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    //$this->forward404Unless($fechas_calendario = Doctrine_Core::getTable('FechasCalendario')->find(array($request->getParameter('idfecha'))), sprintf('Object fechas_calendario does not exist (%s).', $request->getParameter('idfecha')));
    //$fechas_calendario->delete();
	$this->redirect('calendarios/index');
   // $this->redirect('fechascalendario/index');
  }

}
