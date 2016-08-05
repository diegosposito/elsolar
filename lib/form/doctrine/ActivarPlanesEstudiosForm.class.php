<?php

/**
 * PlanesEstudios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ActivarPlanesEstudiosForm extends BasePlanesEstudiosForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by'], $this['idcarrera'], $this['nombre'], $this['version'], $this['letra'], $this['cantidadmaterias'], $this['cantidadgenericas'], $this['cantidadoptativas'], $this['cantidadextracurriculares'], $this['cantidadseminarios'], $this['cantidadidiomas'], $this['duracionnumerica'], $this['duracionteorica'], $this['vigenciaminima'], $this['horastotales'], $this['topecreditocursado'], $this['topecreditoregularidades'], $this['nroresolucion'], $this['fechaaprobacion'], $this['idestadoplan']);
	  	
  	$this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre:</p>'), array('size' => '10'));
	$this->widgetSchema['version'] = new sfWidgetFormInput(array('label' => '<p align="left">Versión actual:</p>'), array('value' => '1', 'size' => '4'));
	$this->widgetSchema['letra'] = new sfWidgetFormInput(array('label' => '<p align="left">Letra:</p>'), array('size' => '4'));
	
 	
	$this->validatorSchema['nroresolucion']->setMessage('required', 'Requerido'); 
	$this->validatorSchema['fechaaprobacion']->setMessage('required', 'Requerido');		
  }
}
