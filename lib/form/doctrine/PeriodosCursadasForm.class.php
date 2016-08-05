<?php

/**
 * PeriodosCursadas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PeriodosCursadasForm extends BasePeriodosCursadasForm
{
  public function configure()
  {
  	$arregloPeriodo = array(1 => 'Primer Cuatrimestre', 2 => 'Segundo Cuatrimestre');
  	
  	// remove unwanted fields
  	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	// Se define el esquema del form
  	$this->widgetSchema['idfecha'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['periododecursada'] = new sfWidgetFormChoice(array('label' => '<p align="left"><b>Periodo de cursada:</b></p>', 'choices' => $arregloPeriodo, 'expanded' => true, 'default' => 0));
  }
}
