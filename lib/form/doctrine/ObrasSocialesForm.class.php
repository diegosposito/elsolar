<?php

/**
 * ObrasSociales form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ObrasSocialesForm extends BaseObrasSocialesForm
{
  public function configure()
  {

  	    unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );
     
      // Se define los labels
	    $this->widgetSchema->setLabel('denominacion', '<p align="left">Obra Social:</p>');
 	    $this->widgetSchema->setLabel('abreviada', '<p align="left">Nombre Abreviado:</p>');
      $this->widgetSchema->setLabel('fechaaranceltexto', '<p align="left">Aranceles / Texto:</p>');
 	    $this->widgetSchema->setLabel('fechaultimoperiodotexto', '<p align="left">Ultimo Período / Texto:</p>');

 	    $this->widgetSchema['fechaarancel'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Actualización de Aranceles:</b></p>'), array('size' =>'10'));
		  $this->widgetSchema['fechaultimoperiodo'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Ultimo Período Abonado:</b></p>'), array('size' =>'10'));
	
      $arregloEstados = array('1' => 'Habilitada', '0' => 'No Habilitada');
    
      $this->widgetSchema['estado'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Estado:</b></p>', 'choices' => $arregloEstados));
  

      $this->setValidators(array(
        'denominacion' => new sfValidatorString(array('required' => true), array('required' => 'El nombre de la O.Social es obligatorio.')),
        'abreviada' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
        'estado'    => new sfValidatorInteger(array('required' => false)),
        'fechaarancel' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
        'fechaultimoperiodo' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
        'fechaaranceltexto' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
        'fechaultimoperiodotexto' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
        ));

      $this->validatorSchema->setOption('allow_extra_fields',true); 

  }
}
