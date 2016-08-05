<?php

/**
 * EquivalenciasAlumnos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EquivalenciasAlumnosForm extends BaseEquivalenciasAlumnosForm
{
  public function configure()
  {
  	// remove unwanted fields
  	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	// Se define el esquema del form
  	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha:</p>'), array('size' =>'10'));
  	$this->widgetSchema['fecharesolucion'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de resolución:</p>'), array('size' =>'10'));
  	$this->widgetSchema['nroresolucion'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro. de resolución:</p>'), array('size' =>'10'));
  	$this->widgetSchema['observaciones'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Observaciones:</p>'), array('rows' => '2', 'cols' => '75'));
  	$this->widgetSchema['cantidadprogramas'] = new sfWidgetFormInput(array('label' => '<p align="left">Cant. de prog. presentados:</p>'), array('size' =>'10'));
  	
  	$this->widgetSchema['tipopago'] =  new sfWidgetFormChoice(array(
  			'expanded' => false,
  			'choices'   => array( '1' => 'Total', '2' => 'Parcial'),
  			'default'   => '1'
  	));
  	$this->widgetSchema['nrorecibo1'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nro. recibo:</b></p>'), array('size' =>'6'));
  	$this->widgetSchema['nrorecibo2'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nro. recibo:</b></p>'), array('size' =>'6'));
  	 
  	// Se define los labels
  	$this->widgetSchema->setLabel('tipopago', '<p align="left"><b>Tipo Pago:</b></p>');  	
  }
}
