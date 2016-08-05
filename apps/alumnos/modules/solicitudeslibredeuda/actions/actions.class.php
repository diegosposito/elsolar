<?php

/**
 * solicitudeslibredeuda actions.
 *
 * @package    sig
 * @subpackage solicitudeslibredeuda
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class solicitudeslibredeudaActions extends sfActions
{
  public function executeCerrarmultiple(sfWebRequest $request){
	$mensaje = "";
	$resultado = 0;
	$solicitudes_seleccionadas = $request->getParameter('case');
	
	if(count($solicitudes_seleccionadas) > 0) {
		foreach ($solicitudes_seleccionadas as $solicitud) {
			$oSolicitud = Doctrine_Core::getTable('SolicitudesLibredeuda')->find($solicitud);
				
			$oSolicitud->setIdestadosolicitud(3);
			$oSolicitud->save();
		}
	} else {
		$resultado = 1;
	}
		
	if ($resultado == 1) {
		$mensaje = "No se ha seleccionado ninguna solicitud.\n";
	} else {
		$mensaje = "Se han cerrado ".count($solicitudes_seleccionadas)." solicitudes correctamente.\n";
	}
	echo $mensaje;

	return sfView::NONE;
  }
		
  public function executeCerrar(sfWebRequest $request)
  {
	$oSolicitud = Doctrine_Core::getTable('SolicitudesLibredeuda')->find($request->getParameter('id'));
	
	$oSolicitud->setIdestadosolicitud(3);
	$oSolicitud->save();
	
	$mensaje = "Se han cerrado la solicitud correctamente.\n";
	
	echo $mensaje;

	return sfView::NONE;
  }
		
  public function executeGuardar(sfWebRequest $request)
  {
  	$arregloSolicitud = $request->getParameter('solicitudes_libredeuda');
  	 
  	$oSolicitud = Doctrine_Core::getTable('SolicitudesLibredeuda')->find($request->getParameter('id'));
  	
	$oSolicitud->setObservaciones($arregloSolicitud['observaciones']);
	$oSolicitud->setIdestadosolicitud(2);
	$oSolicitud->save();
	
	// Remitente
	$oUsuarioDestino = Doctrine_Core::getTable('sfGuardUser')->find($oSolicitud->getIdusuariodestino()); 
	$remitente = $oUsuarioDestino->getEmailAddress(); 
	      		
	// Destinatario
	$oUsuarioOrigen = Doctrine_Core::getTable('sfGuardUser')->find($oSolicitud->getIdusuarioorigen());
	$destinatario = $oUsuarioOrigen->getEmailAddress();

	// Alumno
	$oAlumno = $oSolicitud->getAlumnos();
	
	$msj = '
En respuesta a la solicitud de libre deuda sobre el estado del alumno '.$oAlumno->getPersonas().', '.$oAlumno->getPersonas()->getTiposDocumentos().': '.$oAlumno->getPersonas()->getNrodoc().', de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'.
IdAlumno: '.$oAlumno->getIdalumno().'
Observaciones: '.$arregloSolicitud['observaciones'];
	
	$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
	
	$resultado = $this->getMailer()->composeAndSend(
		 $remitente,
		 $destinatario,
		 'RESPUESTA: Solicitud de Libre Deuda: '. $oAlumno->getPersonas(),
		 $mensajeEmail
	);
		
	$this->redirect('solicitudeslibredeuda/index');
  }
		
  public function executeResponder(sfWebRequest $request)
  {
  	$this->solicitud = Doctrine_Core::getTable('SolicitudesLibredeuda')->find($request->getParameter('id'));
	
	$this->form = new SolicitudesLibredeudaForm($this->solicitud);
  }
		
  public function executeIndex(sfWebRequest $request)
  {
  	$idusuario = sfContext::getInstance()->getUser()->getGuardUser()->getId();

  	$this->estado = $request->getParameter('estado',1);
  	if($this->estado) {
  		$w = 'a.idestadosolicitud !=3';
  	} else {
  		$w = 'a.idestadosolicitud =3';
  	}  	  	
    $q = Doctrine_Core::getTable('SolicitudesLibredeuda')
      ->createQuery('a')
      ->where('a.idusuariodestino = ?',$idusuario)
      ->andWhere($w)
      ->orderBy('a.id DESC');
    
    $this->pager = new sfDoctrinePager(
    		'SolicitudesLibredeuda',
    		50
    );
    $this->pager->setQuery($q);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->solicitudes_libredeuda = Doctrine_Core::getTable('SolicitudesLibredeuda')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->solicitudes_libredeuda);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SolicitudesLibredeudaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SolicitudesLibredeudaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($solicitudes_libredeuda = Doctrine_Core::getTable('SolicitudesLibredeuda')->find(array($request->getParameter('id'))), sprintf('Object solicitudes_libredeuda does not exist (%s).', $request->getParameter('id')));
    $this->form = new SolicitudesLibredeudaForm($solicitudes_libredeuda);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($solicitudes_libredeuda = Doctrine_Core::getTable('SolicitudesLibredeuda')->find(array($request->getParameter('id'))), sprintf('Object solicitudes_libredeuda does not exist (%s).', $request->getParameter('id')));
    $this->form = new SolicitudesLibredeudaForm($solicitudes_libredeuda);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($solicitudes_libredeuda = Doctrine_Core::getTable('SolicitudesLibredeuda')->find(array($request->getParameter('id'))), sprintf('Object solicitudes_libredeuda does not exist (%s).', $request->getParameter('id')));
    $solicitudes_libredeuda->delete();

    $this->redirect('solicitudeslibredeuda/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $solicitudes_libredeuda = $form->save();

      $this->redirect('solicitudeslibredeuda/edit?id='.$solicitudes_libredeuda->getId());
    }
  }
}
