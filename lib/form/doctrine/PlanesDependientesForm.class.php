<?php

/**
 * PlanesDependientes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlanesDependientesForm extends BasePlanesDependientesForm
{
  public function configure()
  {
	unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'], $this['orden'] );
  	
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	foreach($planesestudios as $planestudio){
		$arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre(); 
	}  	
	asort($arregloCarreras);	
	
	// Se define el esquema del form
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));  	
  	$this->widgetSchema['idplanestudiod'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
  	
 	// Se define los labels
 	$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Plan de estudios:</p>');
 	$this->widgetSchema->setLabel('idplanestudiod', '<p align="left">Plan de estudios dependiente:</p>');  	
  }
}
