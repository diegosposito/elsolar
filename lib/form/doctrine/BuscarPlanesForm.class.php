<?php
class BuscarPlanesForm extends sfForm
{	        
  public function configure()
  {        
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	foreach($carreras as $carrera){
		$arregloCarreras[$carrera->getIdcarrera()] = $carrera->getNombrereducido();
	}  
	
	// Se define el esquema del form
  	$this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idcarrera', '<p align="left" font-color="#000">Carrera:</p>');
	$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Plan de estudios:</p>');
  }
}
