<?php

/**
 * MesasExamenes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MesasExamenesForm extends BaseMesasExamenesForm
{
  public function configure()
  {
    unset(
      $this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['libro'], $this['folio'], $this['idlibroacta'], $this['idestadomesaexamen'], $this['idtipoexamen']
    );
    
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	//$arr = array(1, 2, 6);
	$arr = array(1,2);
  	foreach($planesestudios as $planestudio){
		$arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre(); 
	}  
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	foreach ($carreras as $carrera) {
  		$oCarrera = Doctrine_Core::getTable('Carreras')->find($carrera->idcarrera);
  		if (!in_array($oCarrera->getIdtipocarrera(), $arr)) {
  			$planes = $oCarrera->obtenerPlanesEstudiosActivos();
  			foreach($planes as $plan) {
  				$arregloPlanes[$plan['idplanestudio']] = $oCarrera->getNombrereducido().' - '.$plan['nombre'];
  			}
  		}
  	}
	asort($arregloPlanes);
		
	// Se define el esquema del form
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Plan de estudios:</b></p>', 'choices' => $arregloPlanes));
	$this->widgetSchema['idmateriaplan'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idcondicion'] = new sfWidgetFormDoctrineChoice(array('expanded' => false, 'multiple' => false, 'model' => 'CondicionesMesas', 'add_empty' => false ));
	$this->widgetSchema['idturno'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idllamado'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha:</b></p>'), array('size' =>'10'));
	$this->widgetSchema['hora'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Hora:</b></p>'), array('size' =>'6'));
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['fechamin'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['fechamax'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);	
 	// Se define los labels
 	$this->widgetSchema->setLabel('idmateriaplan', '<p align="left"><b>Materia:</b></p>');
 	$this->widgetSchema->setLabel('idcondicion', '<p align="left"><b>Condición:</b></p>');
 	$this->widgetSchema->setLabel('idturno', '<p align="left"><b>Turno:</b></p>');
 	$this->widgetSchema->setLabel('idllamado', '<p align="left"><b>Llamado:</b></p>'); 	
 	
 	// Se define los validadores 
	$this->setValidators(array(
		'idplanestudio'    => new sfValidatorString(),
	));
	
	$this->validatorSchema['idplanestudio']->setMessage('required', 'Requerido'); 
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 	  	
  }
}
