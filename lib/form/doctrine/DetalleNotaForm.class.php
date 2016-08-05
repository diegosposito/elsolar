<?php

/**
 * DetalleNota form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetalleNotaForm extends BaseDetalleNotaForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
	$arregloResultado = array('Reprueba' => 'Reprueba', 'Aprueba' => 'Aprueba', 'Promociona' => 'Promociona');
	
	$this->widgetSchema['descripcion'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre:</p>'), array('size' => '50'));
	$this->widgetSchema['resultado'] = new sfWidgetFormSelect(array('label' => '<p align="left">Resultado:</p>', 'choices' => $arregloResultado));
	$this->widgetSchema['valorinferior'] = new sfWidgetFormInput(array('label' => '<p align="left">Valor inferior:</p>'), array('size' => '5'));
	$this->widgetSchema['valorsuperior'] = new sfWidgetFormInput(array('label' => '<p align="left">Valor superior:</p>'), array('size' => '5'));
  	$this->widgetSchema['idescalanota'] = new sfWidgetFormInputHidden();
  
 	// Se define los labels
	$this->widgetSchema->setLabel('activo', '<p align="left">Activo?:</p>');  	
  	
  }
}
