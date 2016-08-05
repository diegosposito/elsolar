<?php

/**
 * calendarios actions.
 *
 * @package    sig
 * @subpackage calendarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendariosActions extends sfActions
{
  public function executeActivar(sfWebRequest $request) {
	$oCalendario = Doctrine_Core::getTable('Calendarios')->find($request->getParameter('idcalendario'));
	$oCalendario->setActivo($request->getParameter('activo'));
	$oCalendario->save();
		
    $this->redirect('calendarios/index');
  }
	
  public function executeVer(sfWebRequest $request)
  {
    $this->fechass = Doctrine_Core::getTable('FechasCalendario')
      ->createQuery('a')
      ->where('idcalendario='.$request->getParameter('idcalendario'))
      ->execute();
    $this->calendario = Doctrine_Core::getTable('Calendarios')->find($request->getParameter('idcalendario'));
  }

  public function executeIndex(sfWebRequest $request)
  {
 	$arreglo = "";
  	$oUsuario = $this->getUser()->getGuardUser();
 	$oPerfil = $oUsuario->getProfile();
    $oAreas = new Areas(); 	
    
   	$facultades = $oAreas->obtenerFacultadesPorArea($oPerfil->getIdarea());
  	foreach($facultades as $facultad){
		$arreglo .= $facultad->idfacultad.", "; 
	}
	$arregloFacultades = substr($arreglo, 0, strlen($arreglo)-2);
	  	   	  	
  	$this->calendarioss = Doctrine_Core::getTable('Calendarios')
      ->createQuery('a')
      ->where('idsede='.$oPerfil->getIdsede())
      ->andWhere('idfacultad IN ( '.$arregloFacultades.' )')
      ->execute();
  }
  
  public function executeNew(sfWebRequest $request)
  {
 	$oUsuario = $this->getUser()->getGuardUser();
 	$oPerfil = $oUsuario->getProfile();
   	
  	$this->form = new CalendariosForm();
    $this->form->setDefault('idsede', $oPerfil->getIdsede());
    $oArea = Doctrine_Core::getTable('Areas')->find($oPerfil->getIdarea());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CalendariosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($calendarios = Doctrine_Core::getTable('Calendarios')->find(array($request->getParameter('idcalendario'))), sprintf('Object calendarios does not exist (%s).', $request->getParameter('idcalendario')));
    $this->form = new CalendariosForm($calendarios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($calendarios = Doctrine_Core::getTable('Calendarios')->find(array($request->getParameter('idcalendario'))), sprintf('Object calendarios does not exist (%s).', $request->getParameter('idcalendario')));
    $this->form = new CalendariosForm($calendarios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($calendarios = Doctrine_Core::getTable('Calendarios')->find(array($request->getParameter('idcalendario'))), sprintf('Object calendarios does not exist (%s).', $request->getParameter('idcalendario')));
    $calendarios->delete();

    $this->redirect('calendarios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $calendarios = $form->save();

      $this->redirect('calendarios/index');
    }
  }
}
