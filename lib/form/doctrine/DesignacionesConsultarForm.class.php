<?php

/**
 * DesignacionesProfForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesConsultarForm extends sfForm
{
  public function configure()
  {
    
    $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
    $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
    $planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
    
    $profesores = Doctrine_Core::getTable('Profesores')->obtenerProfesoresPorArea($idarea);
    foreach($profesores as $pf) {
          $arrProfesores[$pf['idpersona']] = $pf['profesor'];
    }

    foreach($planesestudios as $planestudio){
      $arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre(); 
    }  
    $carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
    foreach ($carreras as $carrera) {
      $oCarrera = Doctrine_Core::getTable('Carreras')->find($carrera->idcarrera);
      if (!in_array($oCarrera->getIdtipocarrera(), $arregloCarreras)) {
        $planes = $oCarrera->obtenerPlanesEstudiosActivos();
        foreach($planes as $plan) {
          $arregloPlanes[$plan['idplanestudio']] = $oCarrera->getNombrereducido().' - '.$plan['nombre'];
        }
      }
    }
  asort($arregloPlanes);
  
  $categoriaDesignaciones = Doctrine_Core::getTable('CategoriaDesignaciones')->findAll(); 
  foreach($categoriaDesignaciones as $cd) {
          $arrCategoriasDesignaciones[$cd['idcategoriadesignacion']] = $cd['descripcion'];
    }

  $estados_designaciones = Doctrine_Core::getTable('EstadosDesignaciones')->findAll();
   foreach($estados_designaciones as $ed) {
          $arrEstadosDesignaciones[$ed['idestadodesignacion']] = $ed['descripcion'];
    }   
    
  // Se define el esquema del form
  $this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Plan de estudios:</b></p>', 'choices' => $arregloPlanes));
  $this->widgetSchema['idestadodesignacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Estado Designaci&oacuten:</b></p>', 'choices' => $arrEstadosDesignaciones));
  $this->widgetSchema['idcategoriadesignacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Categor&iacutea Designaci&oacuten:</b></p>', 'choices' => $arrCategoriasDesignaciones));
  $this->widgetSchema['idtipodesignacion'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  $this->widgetSchema['fechadesde'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Desde:</b></p>'), array('size' =>'10'));
  $this->widgetSchema['fechahasta'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Hasta:</b></p>'), array('size' =>'10'));
  $this->widgetSchema['idpersona'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Profesor:</b></p>', 'choices' => $arrProfesores));
  $this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array()));

  // Se define los valores por defecto 
  $this->widgetSchema['idsede'] = new sfWidgetFormInputHidden(); 
  $this->widgetSchema->setDefault('idsede', $idsede); 
  
  // Se define los labels
  $this->widgetSchema->setLabel('idtipodesignacion', '<p align="left"><b>Tipo Designaci&oacuten:</b></p>');
  $this->widgetSchema->setLabel('idcatedra', '<p align="left"><b>Cátedra:</b></p>');
  
  // Se define los validadores 
  $this->setValidators(array(
    'idplanestudio'    => new sfValidatorString(),
  ));
  
  $this->validatorSchema['idplanestudio']->setMessage('required', 'Requerido'); 
  
  $this->validatorSchema->setOption('allow_extra_fields',true);       
  }
}
