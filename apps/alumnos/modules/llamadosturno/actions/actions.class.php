<?php

/**
 * llamadosturno actions.
 *
 * @package    sig
 * @subpackage llamadosturno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class llamadosturnoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->llamados_turnos = Doctrine_Core::getTable('LlamadosTurno')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->fecha = Doctrine_Core::getTable('FechasCalendario')->find($request->getParameter('idfecha'));
    $this->idcalendario = $this->fecha->getIdcalendario();
  	$this->form = new LlamadosTurnoForm();
    $this->form->setDefault('idfecha', $request->getParameter('idfecha'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LlamadosTurnoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  { 	
  	$this->forward404Unless($llamados_turno = Doctrine_Core::getTable('LlamadosTurno')->find(array($request->getParameter('idllamado'))), sprintf('Object llamados_turno does not exist (%s).', $request->getParameter('idllamado')));
    $this->form = new LlamadosTurnoForm($llamados_turno);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($llamados_turno = Doctrine_Core::getTable('LlamadosTurno')->find(array($request->getParameter('idllamado'))), sprintf('Object llamados_turno does not exist (%s).', $request->getParameter('idllamado')));
    $this->form = new LlamadosTurnoForm($llamados_turno);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
  	$mesas = Doctrine_Core::getTable('MesasExamenes')->findByIdllamado($request->getParameter('idllamado'));
  	
  	if (count($mesas) > 0) {
  		$resultado = "No se ha podido eliminar correctamente el llamado a mesa de examen.\n Existen mesas de examenes asociadas a dicho llamado.\n";
  	} else {
  	  	$this->forward404Unless($llamados_turno = Doctrine_Core::getTable('LlamadosTurno')->find(array($request->getParameter('idllamado'))), sprintf('Object llamados_turno does not exist (%s).', $request->getParameter('idllamado')));
  		$llamados_turno->delete();
  		
  		$resultado = "Se ha eliminado correctamente el llamado a mesa de examen.\n";
  	}
	echo $resultado;
	
	return sfView::NONE;	  	
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
  	$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $llamados_turno = $form->save();
      $oFecha = Doctrine_Core::getTable('FechasCalendario')->find($llamados_turno->getIdfecha());
  	  $oCalendario = $oFecha->getCalendarios();   
  	
      $this->redirect('calendarios/ver?idcalendario='.$oCalendario->getIdcalendario());
    }
  }
}
