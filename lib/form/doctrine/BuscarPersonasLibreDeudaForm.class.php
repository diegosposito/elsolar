<?php
class BuscarPersonasLibreDeudaForm extends sfForm
{  
  public function configure()
  {         
	$this->widgetSchema['apellido'] = new sfWidgetFormInput();
	$this->widgetSchema['dni'] = new sfWidgetFormInput();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('apellido', '<p align="left">Apellido y/o nombre:</p>');
 	$this->widgetSchema->setLabel('dni', '<p align="left">Nro. de Documento:</p>');
 	
 	// Se define los validadores 
	$this->setValidators(array(
		'apellido'    => new sfValidatorString(),
		'dni'    => new sfValidatorString(),	
		'referer' 	 => new sfValidatorString(array('required' => false)),
	));
  }
}
