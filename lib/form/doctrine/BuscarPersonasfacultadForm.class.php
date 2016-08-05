<?php
class BuscarPersonasfacultadForm extends sfForm
{  
  public function configure()
  {         
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
        if ($idarea>0) 	$facultades = Doctrine_Core::getTable('AreasCarrera')->obtenerFacultadesPorArea($idarea);
	foreach($facultades as $facultad){
		$arregloCarreras[$facultad->getIdfacultad()] = $facultad->getNombre(); 
	}
    $tiposdocumentos = Doctrine_Core::getTable('TiposDocumentos')
      ->createQuery('a')
      ->execute();
	foreach($tiposdocumentos as $tipodoc){
		$arregloTiposDocumentos[$tipodoc->getIdtipodoc()] = $tipodoc->getDescripcion()."(".$tipodoc->getPaises()->getAbreviacion().")"; 
	}	
	// Se define el esquema del form
  	$this->widgetSchema['carrera'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
  	$this->widgetSchema['tipodocumento'] = new sfWidgetFormSelect(array('choices' => $arregloTiposDocumentos));
	$this->widgetSchema['nrodocumento'] = new sfWidgetFormInput();
	$this->widgetSchema['referer'] = new sfWidgetFormInputHidden();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('carrera', '<p align="left">Facultad:</p>');
 	$this->widgetSchema->setLabel('tipodocumento', '<p align="left">Tipo de Documento:</p>');
 	$this->widgetSchema->setLabel('nrodocumento', '<p align="left">Nro. de Documento:</p>');
 	
 	// Se define los validadores 
	$this->setValidators(array(
		'carrera'    => new sfValidatorString(),
		'tipodocumento'    => new sfValidatorString(),	
		'nrodocumento'   => new sfValidatorString(),
		'referer' 	 => new sfValidatorString(array('required' => false)),
	));
  }
}
