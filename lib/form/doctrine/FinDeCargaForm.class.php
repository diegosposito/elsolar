<?php

/**
 * DesignacionesProfForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FinDeCargaForm extends sfForm
{
  public function configure()
  {
    
    $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
    $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
    
    $facultades = Doctrine_Core::getTable('AreasCarrera')->obtenerFacultadesPorArea($idarea);
    foreach($facultades as $facultad){
          $arregloFacultades[$facultad->getIdfacultad()] = $facultad->getNombre(); 
    } 
    asort($arregloFacultades);
  
  
    // Se define el esquema del form
    $this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Facultad:</b></p>', 'choices' => $arregloFacultades));
    $this->widgetSchema['fechadesde'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Desde:</b></p>'), array('size' =>'10'));
    $this->widgetSchema['fechahasta'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Hasta:</b></p>'), array('size' =>'10'));
  
    // Se define los valores por defecto 
    $this->widgetSchema['idsede'] = new sfWidgetFormInputHidden(); 
    $this->widgetSchema->setDefault('idsede', $idsede); 
    $this->widgetSchema['idarea'] = new sfWidgetFormInputHidden(); 
    $this->widgetSchema->setDefault('idarea', $idarea);
  
    // Se define los labels
    $this->widgetSchema->setLabel('idfacultad', '<p align="left"><b>Facultad:</b></p>');
  
    // Se define los validadores 
    $this->setValidators(array(
      'idfacultad'    => new sfValidatorString(),
    ));
  
    $this->validatorSchema['idfacultad']->setMessage('required', 'Requerido'); 
  
    $this->validatorSchema->setOption('allow_extra_fields',true);       
  }
}
