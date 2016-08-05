<?php

/**
 * Noticias form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NoticiasForm extends sfForm
{
  public function configure()
  {  	
    $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	foreach($carreras as $carrera){
		$arregloCarreras[$carrera->getIdcarrera()] = $carrera->getNombrereducido(); 
	}  	
  	$this->widgetSchema['titulo'] = new sfWidgetFormInput(array('label' => '<p align="left">Título:</p>'), array('size' => '60'));
  	$this->widgetSchema['intro'] = new sfWidgetFormTextareaTinyMCE(
		array(
			'config' => sfConfig::get('app_tiny_mce_simple')
		)
	);
  	$this->widgetSchema['descripcion'] = new sfWidgetFormTextareaTinyMCE(
		array(
			'config' => sfConfig::get('app_tiny_mce_simple')
		)
	);
	$this->widgetSchema['is_active'] = new sfWidgetFormInputCheckbox();
	$this->widgetSchema['leer_mas'] = new sfWidgetFormInputCheckbox();
	$this->widgetSchema['privada'] = new sfWidgetFormInputCheckbox();	
  	$this->widgetSchema['carrera'] = new sfWidgetFormSelectMany(array('choices' => $arregloCarreras,'multiple' => true));
	$this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de inicio:</p>'), array('size' =>'10'));	
	$this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de finalización:</p>'), array('size' =>'10'));	
	$this->widgetSchema['orden'] = new sfWidgetFormInput(array('label' => '<p align="left">Orden:</p>'), array('size' => '4'));
	
	$this->widgetSchema['idusuario'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idnoticia'] = new sfWidgetFormInputHidden();
	
	$this->widgetSchema->setLabel('intro', '<p align="left">Intro:</p>');
	$this->widgetSchema->setLabel('descripcion', '<p align="left">Descripción:</p>');
	$this->widgetSchema->setLabel('carrera', '<p align="left">Carrera:</p>');
	$this->widgetSchema->setLabel('leer_mas', '<p align="left">Ver Leer más?:</p>');
	$this->widgetSchema->setLabel('is_active', '<p align="left">Activo?:</p>');
	$this->widgetSchema->setLabel('privada', '<p align="left">Privada?:</p>');
  }
}
