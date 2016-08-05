<?php

/**
 * Calendarios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CalendariosForm extends BaseCalendariosForm
{
  public function configure()
  {
    $oAreas = new Areas();
  	$facultades = $oAreas->obtenerFacultadesPorArea(sfContext::getInstance()->getUser()->getAttribute('id_area',''));
	foreach($facultades as $facultad){
		$arregloFacultades[$facultad->idfacultad] = $facultad->facultad; 
	}
  	// remove unwanted fields
	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);

	// Se define el esquema del form
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('choices' => $arregloFacultades));
	$this->widgetSchema['anio'] = new sfWidgetFormInput(array('label' => '<p align="left">Año:</p>'), array('size' =>'4'));	

	$this->setDefault('anio', date('Y'));
 
 	// Se define los labels
	$this->widgetSchema->setLabel('idfacultad', '<p align="left">Facultad:</p>');
	$this->widgetSchema->setLabel('descripcion', '<p align="left">Descripción:</p>');	
	$this->widgetSchema->setLabel('resolucion', '<p align="left">Resolución:</p>');		
	$this->widgetSchema->setLabel('activo', '<p align="left">Activo?:</p>');
  }
}