<?php

/**
 * Solicitudes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RespuestasForm extends BaseSolicitudesForm
{
  public function configure()
  {
  	//remove unwanted fields
	unset($this['is_active'], $this['descripcion'], $this['idsede'], $this['idcarrera'], $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by'], $this['idusuario']);
	
 	$this->setDefault('resuelta', false);
	 
    $this->widgetSchema['respuesta'] = new sfWidgetFormTextareaFCKEditor(
		array(
			'width' => 550,
			'height' => 250,
			'tool' => 'Default', // name of a configured toolbar
			'config'=> 'fckeditor/fckconfig.js' // points to web/js/myfckconfig.js
		)
	);  	

 	// Se define los labels
	$this->widgetSchema->setLabel('resuelta', '<p align="left">Resuelta?</p>');
	$this->widgetSchema->setLabel('respuesta', '<p align="left">Respuesta:</p>');
  }
}