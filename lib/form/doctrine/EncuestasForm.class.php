<?php

/**
 * Encuestas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EncuestasForm extends BaseEncuestasForm
{
  public function configure()
  {
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	foreach($planesestudios as $planestudio){
  		if ($planestudio->getCarreras()->getIdtipocarrera()!=6) {
  			$arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre();
  		}
  	}

  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);  

  	// Se define el esquema del form
  	$this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('label' => '<p align="left">Carrera:</p>', 'choices' => $arregloCarreras));
  	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();  	
  	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha limite:</b></p>'), array('size' =>'10'));
  	
  	// Se define los valores por defecto
  	$this->widgetSchema->setDefault('idsede', $idsede);
  	
  	$this->widgetSchema->setLabel('idcarrera', '<p align="left"><b>Carrera:</b></p>');
  	$this->widgetSchema->setLabel('nombre', '<p align="left"><b>Nombre:</b></p>');
  	$this->widgetSchema->setLabel('descripcion', '<p align="left"><b>Descripción:</b></p>');  	
  }
}
