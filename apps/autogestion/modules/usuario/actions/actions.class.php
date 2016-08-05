<?php

/**
 * usuario actions.
 *
 * @package    sig
 * @subpackage usuario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuarioActions extends sfActions
{ 
  public function executeCambiarpassword(sfWebRequest $request) {
    $this->form = new CambiarPasswordForm();
  }  
  
  public function executeGuardarpassword(sfWebRequest $request) {
	// Busca si existe la persona
	$oUsuario = sfContext::getInstance()->getUser()->getGuardUser();
	
	if($oUsuario->checkPassword($request->getParameter('password'))) {
		if($request->getParameter('nuevapassword') == $request->getParameter('renuevapassword')) {
			if(strlen($request->getParameter('nuevapassword')) >= 8) { 
				$oUsuario->setPassword($request->getParameter('nuevapassword'));
				$oUsuario->save();		
				$resultado = "La password ha sido cambiada correctamente.";		
			} else {
				$resultado = "La longitud de la password ingresada debe ser mayor o igual a 8 caracteres.";
			}
		} else {
			$resultado = "Las passwords ingresadas no concuerdan.";
		}
	} else {
		$resultado = "La password ingresada no es correcta.";
	} 

	echo $resultado;
	
  	return sfView::NONE;  
  }    

  public function executeLogout(sfWebRequest $request){
  	$this->getUser()->setAuthenticated(false);
  	$this->getUser()->getAttributeHolder()->clear();
  	$this->redirect("@homepage");
  }  
}
