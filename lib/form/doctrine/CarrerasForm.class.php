<?php

/**
 * Carreras form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CarrerasForm extends BaseCarrerasForm
{
  public function configure()
  {
  	unset( $this['fechacreacion'], $this['letra'], $this['updated_at'], $this['created_at']);  	
  	
	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre*:</p>'), array('size' => '75'));
	$this->widgetSchema['nombrereducido'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre reducido*:</p>'), array('size' => '50'));
	//$this->widgetSchema['letra'] = new sfWidgetFormInput(array('label' => '<p align="left">Letra:</p>'), array('size' => '4'));
	$this->widgetSchema['termino'] = new sfWidgetFormInput(array('label' => '<p align="left">Duración (Plazo en meses)*:</p>'), array('size' => '4'));
	$this->widgetSchema['nroresolucion'] = new sfWidgetFormInput(array('label' => '<p align="left">Res. Ministerial vigente*:</p>'), array('size' => '8'));  	
	$this->widgetSchema['nroresolucionhcd'] = new sfWidgetFormInput(array('label' => '<p align="left">Res. HCD de creación:</p>'), array('size' => '8'));
	$this->widgetSchema['nroresolucioncsu'] = new sfWidgetFormInput(array('label' => '<p align="left">Res. CSU de creación*:</p>'), array('size' => '8'));
	$this->widgetSchema['nroresolucionconeau'] = new sfWidgetFormInput(array('label' => '<p align="left">Res. CONEAU:</p>'), array('size' => '8'));
	$this->widgetSchema['nroexpediente'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro. expediente ministerial:</p>'), array('size' => '8'));
  	//$this->widgetSchema['fechacreacion'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de creación*:</p>'), array('size' =>'10'));
  	$this->widgetSchema['anioinicio'] = new sfWidgetFormInput(array('label' => '<p align="left">Año de Inicio:</p>'), array('size' => '4'));

 	// Se define los labels
	$this->widgetSchema->setLabel('idfacultad', '<p align="left">Facultad*:</p>');
	$this->widgetSchema->setLabel('titulo', '<p align="left">Título*:</p>');
	$this->widgetSchema->setLabel('idtipocarrera', '<p align="left">Tipo*:</p>');
	$this->widgetSchema->setLabel('idmodalidad', '<p align="left">Modalidad*:</p>');
	$this->widgetSchema->setLabel('idestadocarrera', '<p align="left">Estado*:</p>');

	// Se define los validators 
	$this->validatorSchema['nombre'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['nombrereducido'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['idfacultad']->setMessage('required', 'Requerido');
	$this->validatorSchema['idtipocarrera']->setMessage('required', 'Requerido');
	$this->validatorSchema['idmodalidad']->setMessage('required', 'Requerido');
	$this->validatorSchema['termino'] = new sfValidatorInteger(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['nroresolucioncsu'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['nroresolucion'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['idestadocarrera']->setMessage('required', 'Requerido');
	//$this->validatorSchema['fechacreacion'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
  }
}
