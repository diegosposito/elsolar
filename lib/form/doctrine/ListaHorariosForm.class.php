<?php

/**
 * ListaHorarios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaHorariosForm extends BaseListaHorariosForm
{
   public function configure()
  { 

    unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );
    

	$this->widgetSchema->setLabel('descripcion', '<p align="left">Descripción:</p>');
	$this->widgetSchema->setLabel('activa', '<p align="left">Activa:</p>');

    $this->setValidators(array(
      'descripcion' => new sfValidatorString(array('required' => true), array('required' => 'La descripcion es obligatoria.')),
     
    ));

    $this->validatorSchema->setOption('allow_extra_fields',true); 
 	
  }
}
