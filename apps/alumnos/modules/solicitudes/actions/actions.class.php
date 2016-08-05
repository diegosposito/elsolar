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
  public function executeIndex(sfWebRequest $request)
  {
	// obtener identificador de datos a mostrar -> resueltas = 1   no resueltas = 0 
	$this->resuelta = ($request->getParameter('resuelta')) ? $request->getParameter('resuelta') : 0 ; 
	$this->solicitudess = Doctrine_Core::getTable('Solicitudes')->obtenerSolicitudes($this->getUser()->getProfile()->getIdarea(), $this->getUser()->getProfile()->getIdsede(),$this->resuelta);
  }

  public function executeNew(sfWebRequest $request)
  {
  }

  public function executeCreate(sfWebRequest $request)
  {
    /*$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SolicitudesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $this->descripcion = $solicitudes->getDescripcion();
    $this->form = new RespuestasForm($solicitudes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $this->form = new RespuestasForm($solicitudes);

    $this->processForm($request, $this->form);

    

    
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    /*$request->checkCSRFProtection();

    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $solicitudes->delete();

    $this->redirect('solicitudes/index');*/
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $solicitudes = $form->save();

         $alumno = new Alumnos();
         $usuario=$alumno->obtenerDatosUsuario($solicitudes->getIdUsuario());
         $inicio=strpos($usuario[0],'('); 
         $fin=strpos($usuario[0],')');          
         $cantidad=$fin-$inicio-1;
         $inicio=$inicio+1;
         $email=substr($usuario[0],$inicio, $cantidad);
            //echo $email.'*'.$inicio.'-'.$cantidad.'-'.$usuario[0]; die;
				$message = $this->getMailer()->compose();
				$cid = $message->embed(Swift_Image::fromPath('images/Imagen-Entorno-Virtual-Alumnos.jpg'));
				$message->setSubject('UCU - Sistema de Alumnos On-line: Respuestas a Consultas');
				$message->setTo($email);
				$message->setFrom(array('info@ucu.edu.ar' => 'UCU - Informes'));

    			$html = '
				<p align="center">**************************************************************************************<br>				********************* NO RESPONDER ESTE CORREO *********************<br>
				**************************************************************************************</p>
				<b>'.$usuario[0].'</b>, te han respondido a la consulta <br>				 realizada en el Sistema de Alumnos On-line de la <b>Universidad de Concepción <br>				del Uruguay</b>.<br> 
				Si queres ver la respuesta, ingresa al link siguiente: 
				<br><br>
				 <b>http://alumnos.ucu.edu.ar/autogestion.php/solicitudes</b> <br><br>
				<br>
				<p align="center"><img src="'. $cid.'" alt="UCU - Respuestas" /></p>';
    			
    			$message->setBody($html, 'text/html');

    			$this->getMailer()->send($message);	            
      
      $this->redirect('solicitudes/index');
    }
  }
}
