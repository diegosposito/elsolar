<?php

/**
 * Comisiones form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ComisionesForm extends BaseComisionesForm
{
  public function configure()
  {
	unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );
	$arregloTurnos = array('M' => 'Mañana', 'T' => 'Tarde', 'N' => 'Noche');
	
	$this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nombre:</b></p>'), array('size' => '10', 'readonly' => 'readonly'));
	$this->widgetSchema['descripcion'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Descripción:</b></p>'), array('size' => '10'));
	$this->widgetSchema['capacidad'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Capacidad:</b></p>'), array('size' => '2'));
	$this->widgetSchema['letrainicio'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Letra de inicio:</b></p>'), array('size' => '1'));
	$this->widgetSchema['letrafin'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Letra de fin:</b></p>'), array('size' => '1'));
	$this->widgetSchema['turno'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Turno:</b></p>', 'choices' => $arregloTurnos));
	//$this->widgetSchema['idcatedra'] = new sfWidgetFormInputHidden();
 	// Se define los labels
 	$this->widgetSchema->setLabel('idcatedra', '<p align="left"><b>Materia:</b></p>');	
  	$this->widgetSchema->setLabel('inscripcionhabilitada', '<p align="left"><b>¿Inscripción habilitada?</b></p>');
  	$this->widgetSchema->setLabel('idestadocomision', '<p align="left"><b>Estado:</b></p>');	   
  }
}
