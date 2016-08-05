<?php

/**
 * EstadosAlumnoHistorial form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EstadosAlumnoHistorialForm extends BaseEstadosAlumnoHistorialForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
	  	
	// Se define el esquema del form
	/*$this->widgetSchema['idestadoalumno'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'EstadosAlumno',
		'add_empty' => false
	));*/
	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idestadoalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha:</p>'), array('size' =>'10'));
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Observaciones:</p>'), array('size' => '50'));
 	
	// Se define los labels
 	$this->widgetSchema->setLabel('idestadoalumno', '<p align="left">Estado:</p>');
  }
}
