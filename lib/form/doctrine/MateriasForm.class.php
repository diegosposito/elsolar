<?php

/**
 * Materias form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MateriasForm extends BaseMateriasForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']
    );
	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre:</p>'), array('size' => '75'));
	$this->widgetSchema['nombrereducido'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre reducido:</p>'), array('size' => '50'));
	$this->widgetSchema['contenidominimo'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Contenido minimo:</p>'), array('size' => '50'));
 	
  } 
}
