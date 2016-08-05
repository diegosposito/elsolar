<?php
class FacultadesSedesForm extends sfForm
{    
  public function configure()
  {         
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
  	
  	$oAreas = new Areas();
  	$facultades = $oAreas->obtenerFacultadesPorArea($idarea);
  	foreach($facultades as $facultad){
  		$arregloFacultades[$facultad->idfacultad] = $facultad->facultad;
  	}  	
  	
  	// Se define el esquema del form
  	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Facultad:</b></p>', 'choices' => $arregloFacultades));
  	$this->widgetSchema['plazo'] = new sfWidgetFormInput(array('label' => '<p align="left">Plazo en días:</p>'), array('size' =>'2'));

  	// Se define los valores por defecto
  	$this->widgetSchema->setDefault('idsede', $idsede);  	
  }
}
