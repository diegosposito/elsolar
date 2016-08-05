<?php
class CambiarPasswordForm extends sfForm
{
	        
  public function configure()
  {         
	// Se define el esquema del form
	$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
	$this->widgetSchema['nuevapassword'] = new sfWidgetFormInputPassword();
	$this->widgetSchema['renuevapassword'] = new sfWidgetFormInputPassword();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('password', '<p align="left">Password actual:</p>');
 	$this->widgetSchema->setLabel('nuevapassword', '<p align="left">Nueva password:</p>');
 	$this->widgetSchema->setLabel('renuevapassword', '<p align="left">Confirmar nueva password:</p>'); 	
  }
}