<?php

/**
 * Documentacion form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentacionForm extends BaseDocumentacionForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);

  	$this->widgetSchema['orden'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Orden:</b></p>'), array('size' => '4'));
  	
  	$this->widgetSchema->setLabel('descripcion', '<p align="left"><b>Descripción:</b></p>');
  	$this->widgetSchema->setLabel('idtipodocumentacion', '<p align="left"><b>Tipo:</b></p>');
  	$this->widgetSchema->setLabel('activo', '<p align="left"><b>Activo?:</b></p>');
  }
}
