<?php

/**
 * TiposDocumentacion form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TiposDocumentacionForm extends BaseTiposDocumentacionForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);

  	$arreglo = array('0' => 'Todos', '1' => 'Alumnos argentinos', '2' => 'Alumnos extranjeros');
  	 
  	$this->widgetSchema['orden'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Orden:</b></p>'), array('size' => '4')); 
  	
  	$this->widgetSchema['aplicable'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Aplicable a:</b></p>', 'choices' => $arreglo));
  	$this->widgetSchema->setLabel('nombre', '<p align="left"><b>Descripción:</b></p>');
  	$this->widgetSchema->setLabel('nombrereducido', '<p align="left"><b>Descripción reducida:</b></p>');
  }
}
