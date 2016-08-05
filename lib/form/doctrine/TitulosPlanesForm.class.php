<?php

/**
 * TitulosPlanes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TitulosPlanesForm extends BaseTitulosPlanesForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);

	$this->widgetSchema['idtitulo'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'Titulos',
		'order_by' => array('nombre', 'asc'),
		'label' => '<p align="left">Título:</p>',
		'add_empty' => false
	)); 	
  	/*
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'PlanesEstudios',
		'label' => '<p align="left">Plan de Estudio:</p>',
		'add_empty' => false
	)); 	
	*/
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormInputHidden();	
	
  	$this->widgetSchema['idmodoegreso'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'ModosEgreso',
  		'label' => '<p align="left">Modo de obtención:</p>',
		'add_empty' => false
	)); 	
	
	$this->widgetSchema['idplanestudio']->setAttribute('style',"width:250px");
	
	$this->widgetSchema['totalcreditoegreso'] = new sfWidgetFormInput(array('label' => '<p align="left">Total de credito:</p>'), array('size' => '4'));
	$this->widgetSchema['sumacredito'] = new sfWidgetFormInput(array('label' => '<p align="left">Suma de credito:</p>'), array('size' => '4'));

 	// Se define los labels
	$this->widgetSchema->setLabel('tieneorientacion', '<p align="left">Orientación:</p>');
	$this->widgetSchema->setLabel('eligeorientacion', '<p align="left">Elige orientación?</p>');	
  }  
}
