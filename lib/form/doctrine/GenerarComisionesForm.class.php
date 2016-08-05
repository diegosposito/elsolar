<?php
class GenerarComisionesForm extends sfForm
{	        
  public function configure()
  {        
  	$arregloSiNo = array(1 => 'No', 2 => 'Si');
  	$arregloTurnos = array('M' => 'Mañana', 'T' => 'Tarde', 'N' => 'Noche');
  	
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	foreach($planesestudios as $planestudio){
		$arregloPlanes[$planestudio->getIdplanestudio()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre().' ('.$planestudio->getIdplanestudio().')';
	}  
	
	// Se define el esquema del form
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left">Plan de estudios:</p>', 'choices' => $arregloPlanes));
	$this->widgetSchema['cantidad'] = new sfWidgetFormInput(array('label' => '<p align="left">Cantidad de comisiones:</p>'), array('size' => '1'));
	$this->widgetSchema['capacidad'] = new sfWidgetFormInput(array('label' => '<p align="left">Capacidad:</p>'), array('size' => '3'));
	$this->widgetSchema['turno'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Turno:</b></p>', 'choices' => $arregloTurnos));
	$this->widgetSchema['inscripcionhabilitada'] = new sfWidgetFormChoice(array('label' => '<p align="left">¿Inscripción habilitada?</p>', 'choices' => $arregloSiNo, 'expanded' => true, 'default' => 1));
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto
	$this->widgetSchema->setDefault('idsede', $idsede);
	$this->widgetSchema->setDefault('cantidad', '1');
	$this->widgetSchema->setDefault('capacidad', '100');
  }
}
