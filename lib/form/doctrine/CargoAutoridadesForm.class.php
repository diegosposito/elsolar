<?php

/**
 * CargoAutoridades form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CargoAutoridadesForm extends BaseCargoAutoridadesForm
{
  public function configure()
  {

  	    unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );
        $this->widgetSchema->setLabel('nombre', '<p align="left">Cargo de Autoridad:</p>');

        $this->setValidators(array(
         'idcargoautoridad' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcargoautoridad')), 'empty_value' => $this->getObject()->get('idcargoautoridad'), 'required' => false)),
        'nombre' => new sfValidatorString(array('required' => true), array('required' => 'El nombre del Cargo es obligatorio.')),
        ));
  } 
}
