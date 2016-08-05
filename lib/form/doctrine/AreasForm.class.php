<?php

/**
 * Areas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreasForm extends BaseAreasForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	$this->widgetSchema['descripcion'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Descripción:</b></p>'), array('size' => '50'));
  	
  	$this->widgetSchema->setLabel('idtipoarea', '<p align="left"><b>Tipo de area:</b></p>');
  	$this->widgetSchema->setLabel('idareadependiente', '<p align="left"><b>Area dependiente:</b></p>'); 	
  	$this->widgetSchema->setLabel('letralegajo', '<p align="left"><b>Legajo:</b></p>');
  	
  }
}
