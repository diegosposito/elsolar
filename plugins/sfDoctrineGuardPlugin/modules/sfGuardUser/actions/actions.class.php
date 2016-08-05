<?php

require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardUserActions extends autoSfGuardUserActions
{
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
      	
        $sf_guard_user = $form->save();
	// si 
	if (!($sf_guard_user->getProfile()->getIdarea()>0)) {
		$sf_guard_user->getProfile()->setIdarea($this->getUser()->getAttribute('id_area'));
		$sf_guard_user->save();
        }

        // verifica que el alumno tenga dni en administracion central, de lo contrario envia mail informando
	//conexion webservice administrativo
	$soapclient = new nusoap_client("http://190.228.68.197:9090/administracion/webservices/personacuenta.php?wsdl");
       
	$soapclient->setCredentials("root", "sistemas2009");

       //llamamos la función implementada en el server.php de la siguiente manera
      $resultado = $soapclient->call('obtenerpersona',array( 'value'=> $sf_guard_user->getProfile()->getNrodoc()));
       
       $this->persona = unserialize(base64_decode($resultado));

	if ($this->persona==NULL) {
	// busco datos del alumno en sistem Alumnos para informar al sector administrativo

		        //$soapclient = new nusoap_client("http://192.168.2.197:9999/sumar.php?wsdl");
		        $soapclient1 = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/personas.php?wsdl");
		
		       //llamamos la función implementada en el server.php de la siguiente manera
	            $resultado1 = $soapclient1->call('obtenerpersona',array( 'value'=> $sf_guard_user->getProfile()->getNrodoc()));
	
	           $this->persona = unserialize(base64_decode($resultado1));

			

	$mensaje= "El alumno ".$this->persona['apellido'].', '.$this->persona['nombre'].", solicita activacion de DNI Administrativo, por favor verificar en que cuenta se deberia asignar el mismo. DNI:".$sf_guard_user->getProfile()->getNrodoc();

	mail(sfConfig::get('app_envio_mail_administracion'), 'Solicitud de alta DNI : '.$this->persona['apellido'].', '.$this->persona['nombre'].'-'.$sf_guard_user->getProfile()->getNrodoc(), $mensaje,"FROM: ingguillermoz@gmail.com\nX-Mailer: PHP");

        }
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $sf_guard_user)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@sf_guard_user_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'sf_guard_user_edit', 'sf_subject' => $sf_guard_user));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
