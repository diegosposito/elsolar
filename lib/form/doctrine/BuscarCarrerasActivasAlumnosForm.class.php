<?php
class BuscarCarrerasActivasAlumnosForm extends sfForm
{   
  public function configure()
  {        

	$idarea = sfContext::getInstance()->getUser()->getProfile()->getIdarea(); 
  	$nrodoc = sfContext::getInstance()->getUser()->getProfile()->getNrodoc(); 
  	
  	$carreras = Doctrine_Core::getTable('Personas')->obtenerCarrerasActivasPersona($nrodoc);
  	foreach($carreras as $carrera){
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($carrera->getIdalumno());
		$oEstados=$oAlumno->obtenerUltimoEstado();
		$vestadoalumno =0;
		foreach($oEstados as $estado){
			if($estado>0) $vestadoalumno = $estado;
		};

		if($vestadoalumno==1) $arregloCarreras[$carrera->getIdalumno()] = $carrera->getNombrereducido(); 
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
