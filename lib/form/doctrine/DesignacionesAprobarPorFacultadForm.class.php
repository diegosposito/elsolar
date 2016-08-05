<?php

/**
 * DesignacionesProfForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesAprobarPorFacultadForm extends sfForm
{
  public function configure()
  {
    
 // obtener facultades
  $facultades = Doctrine_Core::getTable('Facultades')->findAll(); 
  foreach($facultades as $fac) {
          $arrFacultades[$fac['idfacultad']] = $fac['nombre'];
  }  
  asort($arrFacultades); 

  $sedes = Doctrine_Core::getTable('Sedes')->findAll(); 
  foreach($sedes as $sed) {
          $arrSedes[$sed['idsede']] = $sed['nombre'];
  }  
  asort($arrSedes); 


  // Se define el esquema del form
  $this->widgetSchema['idsede'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Sedes:</b></p>', 'choices' => $arrSedes));
  $this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Facultad:</b></p>', 'choices' => $arrFacultades));
  $this->widgetSchema['fechadesde'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Desde:</b></p>'), array('size' =>'10'));
  $this->widgetSchema['fechahasta'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Hasta:</b></p>'), array('size' =>'10'));
  $this->widgetSchema['observaciones'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Observaciones:</p>'), array('rows' => '6', 'cols' => '75'));

  // Se define los valores por defecto 
  
  
  // Se define los validadores 
  $this->setValidators(array(
    'idfacultad'    => new sfValidatorString(),
    'idsede'    => new sfValidatorString(),
  ));
  
  $this->validatorSchema['idfacultad']->setMessage('required', 'Requerido'); 
  $this->validatorSchema['idsede']->setMessage('required', 'Requerido'); 
  
  $this->validatorSchema->setOption('allow_extra_fields',true);       
  }
}
