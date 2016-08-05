<?php
class BuscarComisionesForm extends sfForm
{	        
  public function configure()
  {        
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	foreach($planesestudios as $planestudio){
		$arregloPlanes[$planestudio->getIdplanestudio()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre().' ('.$planestudio->getIdplanestudio().')';
	}  
	
	// Se define el esquema del form
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left">Plan de estudios:</p>', 'choices' => $arregloPlanes));
	$this->widgetSchema['idciclolectivo'] = new sfWidgetFormDoctrineChoice(array(
		'model'     => 'CiclosLectivos',
		'add_empty' => false,
	));	
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);	
 	// Se define los labels
	$this->widgetSchema->setLabel('idciclolectivo', '<p align="left">Ciclo lectivo:</p>');
  }
}
