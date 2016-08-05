<?php

/**
 * SolicitudesLibredeuda form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SolicitudesLibredeudaForm extends BaseSolicitudesLibredeudaForm
{
  public function configure()
  {
  	//remove unwanted fields
  	unset($this['updated_at'], $this['created_at'],$this['fecha'], $this['hora'], $this['mensaje'], $this['updated_by'], $this['created_by']);
  	 
  	$this->widgetSchema['observaciones'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Observaciones:</p>'), array('size' => '50'));
	
  }
}
