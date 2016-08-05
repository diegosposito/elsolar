<?php

/**
 * PeriodosCiclos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PeriodosCiclosForm extends BasePeriodosCiclosForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);  

	// Se define el esquema del form
	$this->widgetSchema['idfecha'] = new sfWidgetFormInputHidden();	
	// Se define los labels
	$this->widgetSchema->setLabel('idciclo', '<p align="left"><b>Ciclo lectivo:</b></p>');
  }
}