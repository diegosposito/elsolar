<?php

/**
 * solicitudes actions.
 *
 * @package    sig
 * @subpackage solicitudes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class solicitudesActions extends sfActions
{
	
	public function executeGuardar(sfWebRequest $request)
	{
		// si el usuario es alumno, entonces grabo la persona y facultad 
		if($this->getUser()->hasCredential('alumno')) {
      		$oPerfil = sfContext::getInstance()->getUser()->getGuardUser()->getProfile();
  			$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());
  			$oAlumno = Doctrine_Core::getTable('Alumnos')->buscarAlumno($oPersona->getIdpersona(), $request->getParameter('idcarrera'));
  			$oSolicitud = new Solicitudes();
  			$oSolicitud->setIdCarrera($request->getParameter('idcarrera'));
  			$oSolicitud->setIdSede($oAlumno->getIdsede());
			$oSolicitud->setIdUsuario($this->getUser()->getProfile()->getSfGuardUserId());
			$oSolicitud->setDescripcion($request->getParameter('descripcion'));
			$oSolicitud->setRespuesta(" ");
			$oSolicitud->setResuelta(0);
			
			$oSolicitud->save();
         			
			$alumno = new Alumnos();

		 	$usuario = $alumno->obtenerDatosUsuario($this->getUser()->getProfile()->getSfGuardUserId());

			$inicio = strpos($usuario[0],'('); 
			$fin = strpos($usuario[0],')');          
			$cantidad = $fin-$inicio-1;
			$inicio = $inicio+1;

    		$destinatario = 'ingguillermoz@gmail.com';
   		
    		$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
    		$email_alumno = substr($usuario[0],0, $inicio-1).' - '.$oPerfil->getNrodoc().' - '.substr($usuario[0],$inicio, $cantidad).'(Plan Estudio ID:'.$oAlumno->getIdPlanEstudio().')';
    		
    		$mensajeEmail = '
**************************************************************************************
**************************************************************************************
El alumno '.$email_alumno.', realizo la siguiente consulta: '.$oSolicitud->getDescripcion().'
**************************************************************************************
**************************************************************************************';
    		
    		$resultado = $this->getMailer()->composeAndSend(
    				$remitente,
    				$destinatario,
    				'SAO- Consultas en SAO: '. $oPersona,
    				$mensajeEmail
    		);    		
    		
		}
	
		echo "Se ha enviado correctamente su solicitud.";
		
		return sfView::NONE;	
	}
	
	
  public function executeIndex(sfWebRequest $request)
  {
	// obtener identificador de datos a mostrar -> resueltas = 1   no resueltas = 0 
	$this->resuelta = ($request->getParameter('resuelta')) ? $request->getParameter('resuelta') : 0 ; 
	
  	$this->solicitudess = Doctrine_Core::getTable('Solicitudes')
      ->createQuery('a')
      ->where('idusuario = ?' , $this->getUser()->getProfile()->getSfGuardUserId())
      ->andWhere('resuelta = ?', $this->resuelta)
      ->execute(); 
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->solicitudes);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SolicitudesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SolicitudesForm();
      
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $this->form = new SolicitudesForm($solicitudes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $this->form = new SolicitudesForm($solicitudes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $solicitudes->delete();

    $this->redirect('solicitudes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
 
    if ($form->isValid())
    {
		$solicitudes = $form->save();
      
		// si el usuario es alumno, entonces grabo la persona y facultad 
		if($this->getUser()->hasCredential('alumno')) {
      		$oPerfil = sfContext::getInstance()->getUser()->getGuardUser()->getProfile();
  			$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());
  			$oAlumno = Doctrine_Core::getTable('Alumnos')->buscarAlumno($oPersona->getIdpersona(), $request->getParameter('idcarrera'));
			$solicitudes->setIdSede($oAlumno->getIdsede());
			$solicitudes->setIdUsuario($this->getUser()->getProfile()->getSfGuardUserId());
			$solicitudes->setRespuesta(" ");
			$solicitudes->setResuelta(0);
			$solicitudes->save();
         			
			$alumno = new Alumnos();

		 	$usuario = $alumno->obtenerDatosUsuario($this->getUser()->getProfile()->getSfGuardUserId());

			$inicio = strpos($usuario[0],'('); 
			$fin = strpos($usuario[0],')');          
			$cantidad = $fin-$inicio-1;
			$inicio = $inicio+1;
			$email_alumno = substr($usuario[0],0, $inicio-1).' - '.$oPerfil->getNrodoc().' - '.substr($usuario[0],$inicio, $cantidad).'(Plan Estudio ID:'.$oAlumno->getIdPlanEstudio().')';
			$email = 'ingguillermoz@gmail.com';
			$message = $this->getMailer()->compose();
			$cid = $message->embed(Swift_Image::fromPath('images/Imagen-Entorno-Virtual-Alumnos.jpg'));
			$message->setSubject('UCU - Sistema de Alumnos On-line: Consultas en SAO (Sistema de Alumnos Online)');
			$message->setTo($email);
			$message->setFrom(array('academica@ucu.edu.ar' => 'UCU-SAO Consulta de ALumno'));

    		$html = "El alumno: ".$email_alumno.", realizo la siguiente consulta en Sistema Alumnos Online:".$solicitudes->getDescripcion();
    			
    		$message->setBody($html, 'text/html');

    		$this->getMailer()->send($message);
		}
		$this->redirect('solicitudes/index');
    }
  }
}
