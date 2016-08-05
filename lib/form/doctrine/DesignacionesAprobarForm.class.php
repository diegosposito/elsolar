<?php

/**
 * DesignacionesProfForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesAprobarForm extends sfForm
{
  public function configure()
  {
    
   	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$sedes = Doctrine_Core::getTable('Sedes')->findAll();
  	
  	foreach($sedes as $sede){
		$arregloSedes[$sede->getIdsede()] = $sede->getNombre(); 
	} 

	$facultades = Doctrine_Core::getTable('Facultades')->findAll();
  	
  	foreach($facultades as $facultad){
		$arregloFacultades[$facultad->getIdfacultad()] = $facultad->getNombre(); 
	}  

  	$carreras = Doctrine_Core::getTable('Carreras')->obtenerCarrerasPorFacultad($idfacultad);
  	foreach ($carreras as $carrera) {
  		$arregloPlanes[$carrera['idplanestudio']] = $carrera['carreraplan'];
  	}

  	$arregloActivo = array(0=>'No activas', 1=> 'Activas');
	
	// Se define el esquema del form
	$this->widgetSchema['idsede'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Sede:</b></p>', 'choices' => $arregloSedes));
	$this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Facultad:</b></p>', 'choices' => $arregloFacultades));
  $this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Carrera:</b></p>', 'choices' => $arregloPlanes));
  $this->widgetSchema['idresolucion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Resolución:</b></p>', 'choices' => ''));
  
	$this->widgetSchema['fechadesde'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Desde:</b></p>'), array('size' =>'10'));
	$this->widgetSchema['fechahasta'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Hasta:</b></p>'), array('size' =>'10'));

	$this->widgetSchema['activo'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Estado:</b></p>', 'choices' => $arregloActivo));
  $this->validatorSchema->setOption('allow_extra_fields',true); 	  	
  }
}
