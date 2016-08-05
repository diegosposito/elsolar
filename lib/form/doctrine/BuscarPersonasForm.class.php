<?php
class BuscarPersonasForm extends sfForm
{  
  public function configure()
  {         
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
        if ($idarea>0) 	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
	foreach($carreras as $carrera){
		$planestudio = $carrera->obtenerPlanEstudioVigente();
		$arregloPlanes[$planestudio['idplanestudio']] = $carrera->getNombrereducido()." - ".$planestudio['nombre']; 
		$arregloFacultades[$carrera->getIdfacultad()] = $carrera->getFacultades()->getNombre();
	}
	
    $tiposdocumentos = Doctrine_Core::getTable('TiposDocumentos')
      ->createQuery('a')
      ->execute();
	foreach($tiposdocumentos as $tipodoc){
		$arregloTiposDocumentos[$tipodoc->getIdtipodoc()] = $tipodoc->getDescripcion()."(".$tipodoc->getPaises()->getAbreviacion().")"; 
	}	
	// Se define el esquema del form
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => $arregloPlanes));
  	$this->widgetSchema['facultad'] = new sfWidgetFormSelect(array('choices' => $arregloFacultades));
  	$this->widgetSchema['idtipodocumento'] = new sfWidgetFormSelect(array('choices' => $arregloTiposDocumentos));
	$this->widgetSchema['nrodocumento'] = new sfWidgetFormInput();
	$this->widgetSchema['referer'] = new sfWidgetFormInputHidden();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Carrera:</p>');
	$this->widgetSchema->setLabel('facultad', '<p align="left">Facultad:</p>');
 	$this->widgetSchema->setLabel('idtipodocumento', '<p align="left">Tipo de Documento:</p>');
 	$this->widgetSchema->setLabel('nrodocumento', '<p align="left">Nro. de Documento:</p>');
 	
 	// Se define los validadores 
	$this->setValidators(array(
		'idplanestudio'    => new sfValidatorString(),
	    'facultad'    => new sfValidatorString(),
		'idtipodocumento'    => new sfValidatorString(),	
		'nrodocumento'   => new sfValidatorString(),
		'referer' 	 => new sfValidatorString(array('required' => false)),
	));
  }
}
