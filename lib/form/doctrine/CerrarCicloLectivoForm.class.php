<?php

/**
 * CicloLectivo form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CerrarCicloLectivoForm extends sfForm
{
  public function configure()
  {
	// Se define el esquema del form
  	$arregloEstados = array(2 => 'Libre', 3 => 'Regular');
	// Consultar Guille, 1 => 'Cursando'
  	
  	$this->widgetSchema['fechacierre'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de Cierre:</p>'), array('size' =>'10'));
  	$this->widgetSchema['fechavencimiento'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de Vencimiento:</p>'), array('size' =>'10'));
  	$this->widgetSchema['idestadomateria'] = new sfWidgetFormSelect(array('choices' => $arregloEstados));
  	$this->widgetSchema['idcomision'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idmesaexamen'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idestadomateria', '<p align="left">Estado:</p>');
	$this->widgetSchema->setLabel('idmesaexamen', '<p align="left">Mesa de Examen:</p>');
	  	
 	// Se define los validadores 
	$this->setValidators(array(
		'fechacierre'    => new sfValidatorString(),
		'fechavencimiento'    => new sfValidatorString()
	)); 
  }
}
