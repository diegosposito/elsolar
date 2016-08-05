<?php

/**
 * ExpedientesDerivaciones form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ExpedientesDerivacionesBibliotecaForm extends BaseExpedientesDerivacionesForm
{
  public function configure()
  { 	  	
    unset(
      $this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['leido'], $this['activo']
    );  

    // Se define el esquema del form
	$this->widgetSchema['idderivacion'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idderivacionanterior'] = new sfWidgetFormInputHidden();    
    $this->widgetSchema['idexpediente'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['idareaorigen'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['idareadestino'] = new sfWidgetFormInputHidden();
 	
 	$this->widgetSchema['aprobado'] =  new sfWidgetFormChoice(array(
 		'expanded' => true,
  		'choices'   => array( '0' => 'No', '1' => 'Si'),
  		'default'   => '0'
	));
 	$this->widgetSchema->setDefault('aprobado', '1');

    $this->widgetSchema['nrolector'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nro. lector:</b></p>'), array('size' =>'6'));
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Observaciones:</b></p>'), array('rows' => '5', 'cols' => '75'));
	
  	// Se define los labels
  	$this->widgetSchema->setLabel('aprobado', '<p align="left"><b>Aprobado?:</b></p>');

  	$this->validatorSchema->setOption('allow_extra_fields',true);  	
  }
}
