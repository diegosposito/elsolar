<?php

/**
 * DesignacionesProfForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesConsultarPorFacultadForm extends sfForm
{
  public function configure()
  {
    
  
  // Obtener categoria designaciones
  $categoriaDesignaciones = Doctrine_Core::getTable('CategoriaDesignaciones')->findAll(); 
  foreach($categoriaDesignaciones as $cd) {
          $arrCategoriasDesignaciones[$cd['idcategoriadesignacion']] = $cd['descripcion'];
  }

 // obtener facultades
  $facultades = Doctrine_Core::getTable('Facultades')->findAll(); 
  foreach($facultades as $fac) {
          $arrFacultades[$fac['idfacultad']] = $fac['nombre'];
  }  
  asort($arrFacultades); 

  // obtener sedes
  $sedes = Doctrine_Core::getTable('Sedes')->findAll(); 
  foreach($sedes as $sd) {
          $arrSedes[$sd['idsede']] = $sd['nombre'];
  }  
  asort($arrSedes);    

  // Obtener estados designaciones
  $estados_designaciones = Doctrine_Core::getTable('EstadosDesignaciones')->findAll();
   foreach($estados_designaciones as $ed) {
          $arrEstadosDesignaciones[$ed['idestadodesignacion']] = $ed['descripcion'];
    } 

    
  // Se define el esquema del form
  $this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Facultad:</b></p>', 'choices' => $arrFacultades));
  $this->widgetSchema['idsede'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Sede:</b></p>', 'choices' => $arrSedes));
  $this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  //$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Plan de estudios:</b></p>', 'choices' => $arregloPlanes));
  $this->widgetSchema['idestadodesignacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Estado Designaci&oacuten:</b></p>', 'choices' => $arrEstadosDesignaciones));
  $this->widgetSchema['idcategoriadesignacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Categor&iacutea Designaci&oacuten:</b></p>', 'choices' => $arrCategoriasDesignaciones));
  $this->widgetSchema['idtipodesignacion'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  $this->widgetSchema['fechadesde'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Desde:</b></p>'), array('size' =>'10'));
  $this->widgetSchema['fechahasta'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Hasta:</b></p>'), array('size' =>'10'));
  $this->widgetSchema['idpersona'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Profesor:</b></p>', 'choices' => $arrProfesores));
  $this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array()));

  // Se define los valores por defecto 
  
  // Se define los labels
  $this->widgetSchema->setLabel('idtipodesignacion', '<p align="left"><b>Tipo Designaci&oacuten:</b></p>');
  $this->widgetSchema->setLabel('idplanestudio', '<p align="left"><b>Plan de Estudio:</b></p>');
  $this->widgetSchema->setLabel('idcatedra', '<p align="left"><b>Cátedra:</b></p>');
  
  // Se define los validadores 
  $this->setValidators(array(
    'idfacultad'    => new sfValidatorString(),
  ));
  
  $this->validatorSchema['idfacultad']->setMessage('required', 'Requerido'); 
  
  $this->validatorSchema->setOption('allow_extra_fields',true);       
  }
}
