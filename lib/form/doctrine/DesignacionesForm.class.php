<?php

/**
 * Designaciones form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesForm extends BaseDesignacionesForm
{
  public function configure()
  {
  		$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  		$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  		$arr = array(1, 2, 6);
  		foreach($planesestudios as $planestudio){
  			$carrera = $planestudio->getCarreras();
  			if (!in_array($oCarrera->getIdtipocarrera(), $arr)) {
  				$arregloCarreras[$planestudio->getIdcarrera()] = $carrera->getNombrereducido().' - '.$planestudio->getNombre(); 
			}
		}  	
		asort($arregloCarreras);	
	
        $this->widgetSchema['idcarrera'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
  	    $this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	    $this->widgetSchema['idprofesor'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	   	$this->widgetSchema['idtipodesignacion'] = new sfWidgetFormDoctrineChoice(array(
			'expanded' => false,
			'multiple' => false,
			'model' => 'TiposDesignaciones',
			'add_empty' => false
		));
  	    $this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left">Inicio:</p>'), array('size' =>'10'));
  	    $this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left">Fin:</p>'), array('size' =>'10'));
  	    $this->widgetSchema['fechaaprobacion'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de Aprobación:</p>'), array('size' =>'10'));

      	// Se define los labels
      	$this->widgetSchema->setLabel('idcarrera', '<p align="left">Carrera:</p>');
	    $this->widgetSchema->setLabel('idcatedra', '<p align="left">Materia:</p>');
 	    $this->widgetSchema->setLabel('idprofesor', '<p align="left">Profesor:</p>');
 	    $this->widgetSchema->setLabel('idtipodesignacion', '<p align="left">Tipo Designación:</p>');
	
 	    $this->validatorSchema->setOption('allow_extra_fields',true); 	 	    
  }
/*  
  public function processValues($values) 
  { 
    $values = parent::processValues($values); 
    $fechainicio = $values["inicio"]["year"]."-".$values["inicio"]["month"]."-".$values["inicio"]["day"];
    $fechafin = $values["fin"]["year"]."-".$values["fin"]["month"]."-".$values["fin"]["day"];
    $fechaaprobacion = $values["fechaaprobacion"]["year"]."-".$values["fechaaprobacion"]["month"]."-".$values["fechaaprobacion"]["day"];
    $values['inicio'] = $fechainicio; 
    $values['fin'] = $fechafin; 
    $values['fechaaprobacion'] = $fechaaprobacion; 
   
    return $values; 
  }
*/
}
