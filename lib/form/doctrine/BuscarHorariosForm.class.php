<?php
class BuscarHorariosForm extends sfForm
{	        
  public function configure()
  {        
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	foreach($planesestudios as $planestudio){
		$arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre(); 
	}  
	
	// Se define el esquema del form
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left">Plan de estudios:</p>', 'choices' => $arregloCarreras));
	$this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idcomision'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idciclolectivo'] = new sfWidgetFormDoctrineChoice(array(
		'model'     => 'CiclosLectivos',
		'order_by' => array('ciclo', 'desc'),			
		'add_empty' => false,
	));	
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);			
 	// Se define los labels
	$this->widgetSchema->setLabel('idcatedra', '<p align="left">Catedra:</p>');
	$this->widgetSchema->setLabel('idcomision', '<p align="left">Comisión:</p>');
	$this->widgetSchema->setLabel('idciclolectivo', '<p align="left">Ciclo lectivo:</p>');
  }
}
