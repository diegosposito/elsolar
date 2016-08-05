<?php

/**
 * Empleados form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpleadosForm extends BaseEmpleadosForm
{
  public function configure()
  {
    unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']   );
  	
    $this->widgetSchema['idpersona'] = new sfWidgetFormInputHidden();
    
  	$this->widgetSchema->setLabel('legajo', '<p align="left"><b>Legajo:</b></p>');
  	$this->widgetSchema->setLabel('activo', '<p align="left"><b>Activo?:</b></p>');
  }
}
