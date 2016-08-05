<?php

/**
 * DesignacionesMesas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesMesasForm extends BaseDesignacionesMesasForm
{
  public function configure()
  {
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	$arr = array(1, 2, 6);
  	foreach($planesestudios as $planestudio){
  		$carrera = $planestudio->getCarreras();
  		if (!in_array($oCarrera->getIdtipocarrera(), $arr)) {
  			$arregloCarreras[$planestudio->getIdcarrera()] = $carrera->getNombrereducido().' - '.$planestudio->getNombre(); 
		}
	}  	
	asort($arregloCarreras);	

	// Se define el esquema del form
  	$this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('label' => '<p align="left">Carrera:</p>', 'choices' => $arregloCarreras));
  	$this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	$this->widgetSchema['idmesaexamen'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	$this->widgetSchema['idtipodesignacionmesa'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'TiposDesignacionesMesas',
		'add_empty' => false
	));
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);		
 	// Se define los labels
 	$this->widgetSchema->setLabel('idcatedra', '<p align="left">Materia:</p>');
 	$this->widgetSchema->setLabel('idmesaexamen', '<p align="left">Mesa de Examen:</p>');
 	$this->widgetSchema->setLabel('idtipodesignacionmesa', '<p align="left">Carácter:</p>');
	
 	// Se define los validadores 
	$this->setValidators(array(
		'idcarrera'    => new sfValidatorString(),
		'idcatedra'    => new sfValidatorString(),
	));
	 	
	$this->validatorSchema['idcarrera']->setMessage('required', 'Requerido'); 
	$this->validatorSchema['idcatedra']->setMessage('required', 'Requerido');	
  }
}
