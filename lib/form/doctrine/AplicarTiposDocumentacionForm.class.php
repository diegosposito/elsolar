<?php

/**
 * AplicarTiposDocumentacionForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AplicarTiposDocumentacionForm extends sfForm
{
  public function configure()
  {
	$this->widgetSchema['idtipodocumentacion'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left"><b>Tipos de Documentación:</b></p>',
		'expanded' => false,
		'multiple' => false,
		'model' => 'TiposDocumentacion', 
		'add_empty' => false
	));
  }
}
