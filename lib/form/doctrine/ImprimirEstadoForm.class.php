<?php
class ImprimirEstadoForm extends sfForm
{
	        
  public function configure()
  {         
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	foreach ($carreras as $carrera) {
  		$oCarrera = Doctrine_Core::getTable('Carreras')->find($carrera->idcarrera);
  		if (($oCarrera->getIdtipocarrera()==3) or ($oCarrera->getIdtipocarrera()==4) or ($oCarrera->getIdtipocarrera()==6)) {
  			$planes = $oCarrera->obtenerPlanesEstudiosActivos();
  			foreach($planes as $plan) {
  				$arregloPlanes[$plan['idplanestudio']] = $oCarrera->getNombrereducido().' - '.$plan['nombre'];
  			}
  		}
  	}
	asort($arregloPlanes);
	// Se define el esquema del form
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => $arregloPlanes));
  	$this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha:</b></p>'), array('size' =>'8'));
    $this->widgetSchema['referer'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();

	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);	
 	// Se define los labels
	$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Carrera:</p>');
 	$this->widgetSchema->setLabel('idcatedra', '<p align="left">Materia:</p>');
 	$this->widgetSchema->setLabel('fecha', '<p align="left">Fecha máxima:</p>');
 	
 	// Se define los validadores 
	$this->setValidators(array(
		'idcarrera'    => new sfValidatorString(),
		'idplanestudio'    => new sfValidatorString(),
		'idcatedra'    => new sfValidatorString(),	
		'referer' 	 => new sfValidatorString(array('required' => false)),
	));	
  }
}
