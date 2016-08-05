<?php
class BuscarEstadosForm extends sfForm
{	        
  public function configure()
  {        
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	$arr = array(1, 2, 6);
  	foreach ($carreras as $carrera) {
  		$oCarrera = Doctrine_Core::getTable('Carreras')->find($carrera->idcarrera);
  		if (!in_array($oCarrera->getIdtipocarrera(), $arr)) {
  			$planes = $oCarrera->obtenerPlanesEstudiosActivos();
  			foreach($planes as $plan) {
  				$arregloPlanes[$plan['idplanestudio']] = $oCarrera->getNombrereducido().' - '.$plan['nombre'];
  			}
  		}
  	}
	asort($arregloPlanes);
	
	// Se define el esquema del form
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left">Plan de estudios:</p>', 'choices' => $arregloPlanes));
	$this->widgetSchema['idestado'] = new sfWidgetFormDoctrineChoice(array(
		'model'     => 'EstadosAlumno',
		'add_empty' => false,
	));
  	$this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Inicio:</b></p>'), array('size' =>'10'));
  	$this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fin:</b></p>'), array('size' =>'10'));
	
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);			
 	// Se define los labels
	$this->widgetSchema->setLabel('idestado', '<p align="left">Estado:</p>');
  }
}
