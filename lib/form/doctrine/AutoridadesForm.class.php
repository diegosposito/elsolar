<?php

/**
 * Autoridades form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AutoridadesForm extends BaseAutoridadesForm
{
  public function configure()
  {
  	 unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );

  	$this->setValidators(array(
      'idautoridad'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idautoridad')), 'empty_value' => $this->getObject()->get('idautoridad'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 200, 'required' => true)),
      'idcargoautoridad' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CargoAutoridades'), 'required' => true)),
    ));

    $this->widgetSchema->setLabel('idcargoautoridad', '<p align="left">Cargo de Autoridad:</p>');

     
     

      $this->validatorSchema->setOption('allow_extra_fields',true); 
  }
}
