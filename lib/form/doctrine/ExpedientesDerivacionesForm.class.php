<?php

/**
 * ExpedientesDerivaciones form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ExpedientesDerivacionesForm extends BaseExpedientesDerivacionesForm
{
  public function configure()
  {
    unset(
      $this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['leido'], $this['activo']
    );  
  	
    $this->widgetSchema['idexpediente'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['idareaorigen'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idareadestino'] =  new sfWidgetFormChoice(array(
 		'expanded' => false,
  		'choices'   => array()
	));
	
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Observaciones:</b></p>'), array('rows' => '5', 'cols' => '75'));
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idareadestino', '<p align="left"><b>Area destino:</b></p>');
	
  }
}
