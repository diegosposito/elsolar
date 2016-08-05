<?php

/**
 * Edificios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EdificiosForm extends BaseEdificiosForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']); 

  	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['idciudad'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'Ciudades',
		'add_empty' => false
	));
	$this->widgetSchema['idciudad']->addOption('order_by',array('descripcion','asc'));
	$this->widgetSchema['idciudad']->addOption('group_by','descripcion');
	
  	$this->widgetSchema->setLabel('nombre', '<p align="left"><b>Nombre:</b></p>');  	
  	$this->widgetSchema->setLabel('direccion', '<p align="left"><b>Dirección:</b></p>');
  	$this->widgetSchema->setLabel('telefono', '<p align="left"><b>Telefono:</b></p>');
  	$this->widgetSchema->setLabel('idciudad', '<p align="left"><b>Ciudad:</b></p>');
  }
}
