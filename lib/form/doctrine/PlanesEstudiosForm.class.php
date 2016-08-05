<?php

/**
 * PlanesEstudios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlanesEstudiosForm extends BasePlanesEstudiosForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by'], $this['fechafin'], $this['titulo'], $this['idtiporesolucion'], $this['idplananterior'], $this['idtipoplan'], $this['aprobada'], $this['fecha']);
  	
  	$this->disableLocalCSRFProtection();
  	
	$this->widgetSchema['idcarrera'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre*:</p>'), array('size' => '10'));
	$this->widgetSchema['version'] = new sfWidgetFormInput(array('label' => '<p align="left">Versión actual*:</p>'), array('value' => '1', 'size' => '4'));
	$this->widgetSchema['letra'] = new sfWidgetFormInput(array('label' => '<p align="left">Letra:</p>'), array('size' => '4'));
	$this->widgetSchema['cantidadcomunes'] = new sfWidgetFormInput(array('label' => '<p align="left">Obligatorias*:</p>'), array('size' => '4'));
	$this->widgetSchema['cantidadoptativas'] = new sfWidgetFormInput(array('label' => '<p align="left">Optativas*:</p>'), array('size' => '4'));  	
	$this->widgetSchema['cantidadextracurriculares'] = new sfWidgetFormInput(array('label' => '<p align="left">Extracurriculares*:</p>'), array('size' => '4'));
	$this->widgetSchema['cantidadpreuniversitarias'] = new sfWidgetFormInput(array('label' => '<p align="left">Preuniversitarias*:</p>'), array('size' => '4'));
	$this->widgetSchema['cantidadtesinas'] = new sfWidgetFormInput(array('label' => '<p align="left">Tesina*:</p>'), array('size' => '4'));
	$this->widgetSchema['cantidadtpfinal'] = new sfWidgetFormInput(array('label' => '<p align="left">Trabajo final*:</p>'), array('size' => '4'));
	$this->widgetSchema['cantidadmaterias'] = new sfWidgetFormInput(array('label' => '<p align="left">Total Materias:</p>'), array('size' => '4'));
	$this->widgetSchema['duracionnumerica'] = new sfWidgetFormInput(array('label' => '<p align="left">Duración teórica en años*:</p>'), array('size' => '4'));  	
	$this->widgetSchema['horastotales'] = new sfWidgetFormInput(array('label' => '<p align="left">Carga horario total*:</p>'), array('size' => '4'));
	$this->widgetSchema['nroresolucion'] = new sfWidgetFormInput(array('label' => '<p align="left">Res. CSU*:</p>'), array('size' => '15'));
	$this->widgetSchema['fechaaprobacion'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha*:</p>'), array('size' =>'10'));
	$this->widgetSchema['idestadoplan'] = new sfWidgetFormInputHidden();

 	// Se define los labels
	$this->widgetSchema->setLabel('modalidadalumnolibre', '<p align="left">Modalidad de alumno libre:</p>');
	
	// Se define los validators
	$this->validatorSchema['nombre'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['version'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	//$this->validatorSchema['termino'] = new sfValidatorInteger(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['cantidadcomunes'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['cantidadoptativas'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['cantidadextracurriculares'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['cantidadpreuniversitarias'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['cantidadtesinas'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['cantidadtpfinal'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['duracionnumerica'] = new sfValidatorNumber(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['horastotales'] = new sfValidatorInteger(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['nroresolucion'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
	$this->validatorSchema['fechaaprobacion'] = new sfValidatorString(array('required' => true), array('required' => 'Requerido'));
  }
}
