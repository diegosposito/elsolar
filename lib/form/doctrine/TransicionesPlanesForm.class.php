<?php

/**
 * TransicionesPlanes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TransicionesPlanesForm extends BaseTransicionesPlanesForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	foreach($carreras as $carrera){
		$arregloCarreras[$carrera->getIdcarrera()] = $carrera->getNombrereducido(); 
	}  

	// Se define el esquema del form
	$this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Carrera:</b></p>', 'choices' => $arregloCarreras));
	$this->widgetSchema['idplanorigen'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Plan de estudios (Origen):</b></p>', 'choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idplandestino'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Plan de estudios (Destino):</b></p>', 'choices' => array(0 => '----Seleccione----')));	
  
	$this->widgetSchema['idplanorigen']->setAttribute('disabled', 'disabled');
	$this->widgetSchema['idplandestino']->setAttribute('disabled', 'disabled');
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 	
  }
}
