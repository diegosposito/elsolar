<?php

/**
 * Aulas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AulasForm extends BaseAulasForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']); 
	$arregloPiso = array('PB' => 'Planta Baja', 'SU' => 'Subsuelo', 'PP' => 'Primer Piso', 'SP' => 'Segundo Piso', 'TP' => 'Tercer Piso');
	
  	$this->widgetSchema['idedificio'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nombre:</b></p>'), array('size' => '50'));
  	$this->widgetSchema['ubicacion'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Ubicación:</b></p>'), array('size' => '50'));
  	$this->widgetSchema['piso'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Piso:</b></p>', 'choices' => $arregloPiso));
  	$this->widgetSchema['capacidad'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Capacidad:</b></p>'), array('size' => '2'));
  	$this->widgetSchema['descripcion'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Descripción:</b></p>'), array('size' => '50'));
  	
  	$this->widgetSchema->setLabel('idtipoaula', '<p align="left"><b>Tipo:</b></p>');
  	
  	$this->validatorSchema['capacidad'] = new sfValidatorInteger(array('required' => true), array('required' => '<font color="red">El valor es requerido.</font>'));
  }
}
