<?php

/**
 * Horarios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HorariosForm extends BaseHorariosForm
{
  public function configure()
  {
  	   unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']);
    
        $this->widgetSchema->setLabel('idpersona', '<p align="left">Persona:</p>');
 	    $this->widgetSchema->setLabel('tiporegistro', '<p align="left">Tipo de registro:</p>');

  }
}
