<?php

/**
 * Solicitudes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SolicitudesForm extends BaseSolicitudesForm
{
  public function configure()
  {
  	$oPerfil = sfContext::getInstance()->getUser()->getGuardUser()->getProfile();
  	$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());
  	$alumnos = $oPersona->buscarAlumnos();
  	
	foreach($alumnos as $alumno){
		$carrera = $alumno->getPlanesEstudios()->getCarreras();
		$arregloCarreras[$carrera->getIdcarrera()] = $carrera->getNombrereducido(); 
	}
	
  	//remove unwanted fields
	unset($this['is_active'], $this['updated_at'], $this['created_at'],$this['resuelta'], $this['respuesta'], $this['idsede'], $this['idusuario'],$this['updated_by'], $this['created_by']);
	
 	/*$this->widgetSchema['descripcion'] = new sfWidgetFormTextareaFCKEditor(
		array(
			'width' => 550,
			'height' => 250,
			'tool' => 'Default', // name of a configured toolbar
			'config'=> 'fckeditor/fckconfig.js' // points to web/js/myfckconfig.js
		));*/ 
 	$this->widgetSchema['descripcion'] = new sfWidgetFormTextareaTinyMCE(
 			array(
 					'config' => sfConfig::get('app_tiny_mce_simple')
 			)
 	);
 	
  	$this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));

 	// Se define los labels
	$this->widgetSchema->setLabel('idcarrera', '<p align="left">Carrera:</p>');
	$this->widgetSchema->setLabel('descripcion', '<p align="left">Solicitud:</p>');
    }
}
