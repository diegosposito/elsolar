<?php

/**
 * EncuestasAlumnos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EncuestasAlumnosForm extends BaseEncuestasAlumnosForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	 
  	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['idencuesta'] = new sfWidgetFormDoctrineChoice(array(
  			'expanded' => false,
  			'multiple' => false,
  			'model' => 'Encuestas',
  			'label' => '<p align="left"><b>Encuesta:</b></p>',
  			'add_empty' => false
  	));  	
  	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha de entrega:</b></p>'), array('size' =>'10'));
  }
}
