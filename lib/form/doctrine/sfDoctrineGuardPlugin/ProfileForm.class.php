<?php

/**
 * Profile form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileForm extends PluginProfileForm
{
  public function configure()
  {
 	parent::setup();
  	//  unset($this['perfil'], $this['idarea']);

	$this->useFields(array('tipodoc','nrodoc', 'idarea', 'idsede'));

  	  $this->widgetSchema['tipodoc'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left">Tipo de Documento:</p>', 
		'expanded' => false,
		'multiple' => false,
		'model' => 'TiposDocumentos',
		'add_empty' => false
	));

     $this->widgetSchema['idarea'] = new sfWidgetFormInput(array());	

     $this->widgetSchema['idsede'] = new sfWidgetFormInput(array());  	  
  }
}
