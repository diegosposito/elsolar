<?php

/**
 * CarrerasSede form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CarrerasSedeForm extends BaseCarrerasSedeForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	$this->widgetSchema['idcarrera'] = new sfWidgetFormInputHidden();
	
  	$this->widgetSchema['idsede'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'Sedes',
		'label' => '<p align="left"><b>Sede:</b></p>',
		'add_empty' => false
	)); 	  	
  	$this->widgetSchema['plazocerttittramite'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Plazo de entrega de CTT:</b></p>'), array('size' =>'4'));
  	$this->widgetSchema['plazoborradoexamen'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Plazo de borrado a inscripción a examen:</b></p>'), array('size' =>'4'));
  	
	$this->widgetSchema->setLabel('exploratoria', '<p align="left"><b>Exploratoria?:</b></p>');
	$this->widgetSchema->setLabel('entregaencuesta', '<p align="left"><b>Entrega encuesta de alumnos?:</b></p>');
	$this->widgetSchema->setLabel('vigente', '<p align="left"><b>Esta vigente?:</b></p>');
	$this->widgetSchema->setLabel('permiterevalida', '<p align="left"><b>Permite revalida?:</b></p>');
  }
}
