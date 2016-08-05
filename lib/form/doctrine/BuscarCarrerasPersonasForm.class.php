<?php
class BuscarCarrerasPersonasForm extends sfForm
{   
  public function configure()
  {        
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$nrodoc = sfContext::getInstance()->getUser()->getAttribute('nrodoc','');
  	
  	$carreras = Doctrine_Core::getTable('Personas')->obtenerCarrerasPersona($nrodoc);
  	foreach($carreras as $carrera){
		$arregloCarreras[$carrera->getIdalumno()] = $carrera->getNombrereducido(); 
	}  
		  	
	// Se define el esquema del form
  	$this->widgetSchema['idalumno'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
	$this->widgetSchema['referer'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['url'] = new sfWidgetFormInputHidden();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idalumno', '<p align="left">Carrera:</p>');

 	// Se define los validadores 
	$this->setValidators(array(
		'idalumno'    => new sfValidatorString(),
		'url' => new sfValidatorString(array('required' => false)),
		'referer' => new sfValidatorString(array('required' => false)),
	));
  }
}
