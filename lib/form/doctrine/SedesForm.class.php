<?php

/**
 * Sedes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SedesForm extends BaseSedesForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']); 
  	
  	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nombre:</b></p>'), array('size' => '50'));
  	$this->widgetSchema['direccion'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Dirección:</b></p>'), array('size' => '50'));
  	$this->widgetSchema['telefonos'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Telefono:</b></p>'), array('size' => '25'));
  	$this->widgetSchema['email'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>E-mail:</b></p>'), array('size' => '50'));
  	$this->widgetSchema['imgencabezado'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Encabezado:</b></p>'), array('size' => '25'));
  	$this->widgetSchema['imgpie'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Píe:</b></p>'), array('size' => '25'));
  	$this->widgetSchema['idtiposede'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'TiposSedes',
		'add_empty' => false
	));
	  	
  	$this->widgetSchema->setLabel('idtiposede', '<p align="left"><b>Tipo:</b></p>');
  }
}
