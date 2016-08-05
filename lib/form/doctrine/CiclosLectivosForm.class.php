<?php

/**
 * CiclosLectivos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CiclosLectivosForm extends BaseCiclosLectivosForm
{
  public function configure()
  {
  	unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );
    
  	$this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha inicio:</b></p>'), array('size' =>'10'));
  	$this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha fin:</b></p>'), array('size' =>'10'));
  
  	$this->widgetSchema->setLabel('ciclo', '<p align="left"><b>Ciclo:</b></p>');
  	$this->widgetSchema->setLabel('activo', '<p align="left"><b>Activo?:</b></p>');
  }
}
