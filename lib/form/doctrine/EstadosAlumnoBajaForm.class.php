<?php

/**
 * EstadosAlumnoBaja form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EstadosAlumnoBajaForm extends BaseEstadosAlumnoHistorialForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
	  	
	// Se define el esquema del form
	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de informe:</p>'), array('size' =>'10'));
	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idbaja'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idestadoalumno'] = new sfWidgetFormInputHidden();

 	$this->widgetSchema['tiposolicitud'] =  new sfWidgetFormChoice(array(
 			'expanded' => false,
 			'choices'   => array( 'O' => 'Oficio', 'S' => 'Solicitada'),
 			'default'   => 'O'
 	)); 	
 	
 	$this->widgetSchema['tipobaja'] =  new sfWidgetFormChoice(array(
 			'expanded' => false,
 			'choices'   => array( 'P' => 'Parcial', 'T' => 'Total'),
 			'default'   => 'T'
 	)); 		
	$this->widgetSchema['idmotivo'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => true,
		'multiple' => true,
		'model' => 'Motivos',
		'add_empty' => false
	));
	$this->widgetSchema['otromotivo'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Especificar:</p>'), array('rows' => '2', 'cols' => '75'));
	$this->widgetSchema['fechabaja'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha efectiva de baja:</p>'), array('size' =>'10'));
	$this->widgetSchema['areatelefonofijo'] = new sfWidgetFormInput(array('label' => '<p align="left">Teléfono:</p>'), array('size' =>'5'));
	$this->widgetSchema['nrotelefonofijo'] = new sfWidgetFormInput(array('label' => '<p align="left">Teléfono:</p>'), array('size' =>'10'));
	$this->widgetSchema['areatelefonomovil'] = new sfWidgetFormInput(array('label' => '<p align="left">Celular:</p>'), array('size' =>'5'));
	$this->widgetSchema['nrotelefonomovil'] = new sfWidgetFormInput(array('label' => '<p align="left">Celular:</p>'), array('size' =>'10'));
	$this->widgetSchema['email'] = new sfWidgetFormInput(array('label' => '<p align="left">E-mail:</p>'), array('size' =>'40'));
 	
	// Se define los labels
	$this->widgetSchema->setLabel('tipobaja', '<p align="left">Tipo de baja:</p>');
	$this->widgetSchema->setLabel('tiposolicitud', '<p align="left">Tipo de solicitud:</p>');
	$this->widgetSchema->setLabel('idmotivo', '<p align="left">Motivos:</p>');
  }
}
