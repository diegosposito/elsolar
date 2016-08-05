<?php

/**
 * FechasCalendario form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FechasCalendarioForm extends BaseFechasCalendarioForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);  	
	
	// Se define el esquema del form
	$this->widgetSchema['idcalendario'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['descripcion'] = new sfWidgetFormInput(array('label' => '<p align="left">Descripción:</p>'), array('size' =>'50'));
	$this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left">Inicio:</p>'), array('size' =>'10'));	
	$this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left">Fin:</p>'), array('size' =>'10'));

 	// Se define los labels
	$this->widgetSchema->setLabel('idtipo', '<p align="left">Tipo:</p>');
  }
}