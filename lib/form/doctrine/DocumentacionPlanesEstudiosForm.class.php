<?php

/**
 * DocumentacionPlanesEstudios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentacionPlanesEstudiosForm extends BaseDocumentacionPlanesEstudiosForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	 
  	$this->widgetSchema->setLabel('idplanestudio', '<p align="left"><b>Carrera:</b></p>');
  	$this->widgetSchema->setLabel('iddocumentacion', '<p align="left"><b>Documentación:</b></p>');
  	$this->widgetSchema->setLabel('activo', '<p align="left"><b>Activo?:</b></p>');  	
  	$this->widgetSchema->setLabel('obligatorio', '<p align="left"><b>Obligatorio?:</b></p>');
  }
}
