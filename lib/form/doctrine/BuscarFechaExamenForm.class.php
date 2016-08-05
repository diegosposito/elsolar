<?php
class BuscarFechaExamenForm extends sfForm
{	        
  public function configure()
  {        
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	foreach($carreras as $carrera){
		$arregloCarreras[$carrera->getIdcarrera()] = $carrera->getNombrereducido();  
	}  	  	
	// Se define el esquema del form
  	$this->widgetSchema['carrera'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
	
 	// Se define los labels
	$this->widgetSchema->setLabel('carrera', '<p align="left">Carrera:</p>');

 	// Se define los validadores 
	$this->setValidators(array(
		'carrera'    => new sfValidatorString()
	)); 
  }
}