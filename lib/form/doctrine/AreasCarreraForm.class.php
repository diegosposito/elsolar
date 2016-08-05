<?php

/**
 * AreasCarrera form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreasCarreraForm extends BaseAreasCarreraForm
{
  public function configure()
  {
  	  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	  	$this->widgetSchema['idarea'] = new sfWidgetFormDoctrineChoice(array(
  	  			'expanded' => false,
  	  			'multiple' => false,
  	  			'model' => 'Areas',
  	  			'order_by' => array('descripcion', 'asc'),
  	  			'label' => '<p align="left"><b>Area:</b></p>',
  	  			'add_empty' => false
  	  	));

  	  	$this->widgetSchema['idcarrera'] = new sfWidgetFormDoctrineChoice(array(
  	  			'expanded' => false,
  	  			'multiple' => false,
  	  			'model' => 'Carreras',
  	  			'order_by' => array('nombre', 'asc'),
  	  			'label' => '<p align="left"><b>Carrera:</b></p>',
  	  			'add_empty' => false
  	  	));
  }
}
