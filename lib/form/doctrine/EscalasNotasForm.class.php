<?php

/**
 * EscalasNotas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EscalasNotasForm extends BaseEscalasNotasForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre:</p>'), array('size' => '75'));
  
 	// Se define los labels
	$this->widgetSchema->setLabel('activo', '<p align="left">Activo?:</p>');
  }
}
