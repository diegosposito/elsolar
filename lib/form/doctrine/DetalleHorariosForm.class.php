<?php

/**
 * DetalleHorarios form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetalleHorariosForm extends BaseDetalleHorariosForm
{
   public function configure()
  {
  		
  		unset( $this['created_at'], $this['orden'], $this['idlistahorarios'], $this['updated_at'], $this['created_by'], $this['updated_by'] );

  		$idlistahorario  = $this->getOption('idlistahorario');
      $es_nuevo  = $this->getOption('nuevo');
  		$activos=true;

  		$profesionales = Doctrine_Core::getTable('Personas')->obtenerProfesionales($activos);
  		foreach($profesionales as $profesional){
  				$arregloProfesionales[$profesional['idpersona']] = $profesional['apellido'].', '.$profesional['nombre']; 
		}  

		$servicios = Doctrine_Core::getTable('Centros')->obtenerCentrosActivos($activos);
  		foreach($servicios as $servicio){
  				$arregloServicios[$servicio['id']] = $servicio['abreviacion']; 
		}	

		$pacientes = Doctrine_Core::getTable('Pacientes')->obtenerPacientesActivos($activos);
  		foreach($pacientes as $paciente){
  				$arregloPacientes[$paciente['id']] = $paciente['apellido'].', '.$paciente['nombre']; 
		}	
		
    $this->widgetSchema['idprofesional'] = new sfWidgetFormSelect(array('choices' => $arregloProfesionales));
    $this->widgetSchema['idcentro'] = new sfWidgetFormSelect(array('choices' => $arregloServicios));

    if($es_nuevo)
        // $this->widgetSchema['idpaciente'] = new sfWidgetFormSelect(array('choices' => $arregloPacientes));
        $this->widgetSchema['idpaciente'] = new sfWidgetFormSelect(array('multiple' => true, 'choices' => $arregloPacientes));
  	  else
        $this->widgetSchema['idpaciente'] = new sfWidgetFormSelect(array('choices' => $arregloPacientes));

      	// Se define los labels
    $this->widgetSchema->setLabel('idprofesional', '<p align="left">Profesional:</p>');

    $this->setValidators(array(
        'nombre' => new sfValidatorString(array('required' => false)),
        'idpaciente' => new sfValidatorString(array('required' => false)),
        'idprofesional' => new sfValidatorString(array('required' => false)),
        'idcentro' => new sfValidatorString(array('required' => false)),
        'hdesde'   => new sfValidatorTime(array('required' => false)),
        'hhasta'   => new sfValidatorTime(array('required' => false)),
        ));
	
 	  $this->validatorSchema->setOption('allow_extra_fields',true); 	 	    
  }
}