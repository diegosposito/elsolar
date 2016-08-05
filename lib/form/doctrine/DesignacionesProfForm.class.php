<?php

/**
 * DesignacionesProfForm form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesProfForm extends sfForm
{
  public function configure()
  {
    
    $designacion=''; $iddesignacion=''; $edicion=false;
   	$iddesignacion = $this->getOption('iddesignacion'); 

    if ($iddesignacion<>'' && $iddesignacion>0)
        $edicion=true;
    
    
    if($edicion) // solo si es deicion
    	$designacion = Doctrine_Core::getTable('Designaciones')->obtenerInfoDesignacion($iddesignacion);
    

    $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	foreach($planesestudios as $planestudio){
		$arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getCarreras()->getNombrereducido().' - '.$planestudio->getNombre(); 
	} 

	// Define los tipos de carrera permitidos
	$arr = array (1,2,6);

    $idfacultad = ''; // tomo la primera facultad de la combo
  	$facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
  	
  	foreach($facultades as $facultad){
  		
  		if ($idfacultad=='')
  			$idfacultad= $facultad['idfacultad'];

		$arregloFacultades[$facultad['idfacultad']] = $facultad['nombre']; 
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
	
	$categoriaDesignaciones = Doctrine_Core::getTable('CategoriaDesignaciones')->findAll(); 
	foreach($categoriaDesignaciones as $cd) {
  				$arrCategoriasDesignaciones[$cd['idcategoriadesignacion']] = $cd['descripcion'];
  	}

  	$resoluciones_profesores = Doctrine_Core::getTable('ResolucionesProfesores')->obtenerResolucionesAcademicasxSedeFacultad($idsede, $idfacultad);
  	foreach($resoluciones_profesores as $resoluciones){
		$arregloResoluciones[$resoluciones['idresolucionprofesor']] = $resoluciones['resolucion']; 
	} 

	$dedicaciones = Doctrine_Core::getTable('Dedicaciones')->findAll(); 
	foreach($dedicaciones as $ded) {
  				$arrDedicaciones[$ded['iddedicacion']] = $ded['descripcion'];
  	}
		
	// Se define el esquema del form
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Plan de estudios:</b></p>', 'choices' => $arregloPlanes));
	if ($edicion)
	   $this->widgetSchema['idplanestudio']->setDefault(array($designacion[0]['idplanestudio']));
	
	if ($edicion){

		// Obtengo las catedras
		$catedras = Doctrine_Core::getTable('PlanesEstudios')->obtenerCatedrasPorPlanSede($designacion[0]['idplanestudio'], $idsede);
	    foreach($catedras as $cat){
			$arregloCatedras[$cat['idcatedra']] = $cat['materia']; 
		} 

	   $this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Materia:</b></p>', 'choices' => $arregloCatedras));
	   $this->widgetSchema['idcatedra']->setDefault(array($designacion[0]['idcatedra']));
	
	} else {
	   $this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
    }

	$this->widgetSchema['idcategoriadesignacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Categor&iacutea Designaci&oacuten:</b></p>', 'choices' => $arrCategoriasDesignaciones));
	if ($edicion)
	   $this->widgetSchema['idcategoriadesignacion']->setDefault(array($designacion[0]['idcategoriadesignacion']));

	if ($edicion){
		$designaciones_tipos = Doctrine_Core::getTable('TiposDesignaciones')->getByCategory($designacion[0]['idcategoriadesignacion']);
	
  	    foreach($designaciones_tipos as $tipo_designacion){
		    $arregloDesignacionesTipos[$tipo_designacion['idtipodesignacion']] = $tipo_designacion['descripcion']; 
	    } 
	    $this->widgetSchema['idtipodesignacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Tipo Designaci&oacuten:</b></p>', 'choices' => $arregloDesignacionesTipos));
	    $this->widgetSchema['idtipodesignacion']->setDefault(array($designacion[0]['idtipodesignacion']));
	} else {
		$this->widgetSchema['idtipodesignacion'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	}

	$this->widgetSchema['iddedicacion'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Dedicaci&oacuten:</b></p>', 'choices' => $arrDedicaciones));
	if ($edicion)
	   $this->widgetSchema['iddedicacion']->setDefault(array($designacion[0]['iddedicacion']));

	$this->widgetSchema['fechadesde'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Desde:</b></p>'), array('size' =>'10'));
	if ($edicion)
	   $this->widgetSchema['fechadesde']->setDefault(date("d-m-Y", strtotime($designacion[0]['inicio'])));

	$this->widgetSchema['fechahasta'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha Hasta:</b></p>'), array('size' =>'10'));
	if ($edicion)
	   $this->widgetSchema['fechahasta']->setDefault(date("d-m-Y", strtotime($designacion[0]['fin'])));
    
    $this->widgetSchema['hora'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Carga Horaria:</b></p>'), array('size' =>'6'));
    if ($edicion && $designacion[0]['horas']<>'')
	   $this->widgetSchema['hora']->setDefault(date("H:i", strtotime($designacion[0]['horas'])));

    $this->widgetSchema['adhonorem'] = new sfWidgetFormInputCheckbox();	
    if ($edicion && $designacion[0]['adhonorem'])
    	  $this->widgetSchema['adhonorem']->setDefault('adhonorem', true);

    $this->widgetSchema['licencia'] = new sfWidgetFormInputCheckbox();	
    if ($edicion && $designacion[0]['licencia'])
    	  $this->widgetSchema['licencia']->setDefault('licencia', true);	  	

	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);	

	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Observaciones:</b></p>'));
 	
 	if ($edicion)
 	    $this->widgetSchema->setDefault('observaciones', $designacion[0]['observaciones']);	
 
 	$this->widgetSchema['motivonuevadesignacion'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Motivo Designación:</b></p>'));
 	
 	if ($edicion)
 	    $this->widgetSchema->setDefault('motivonuevadesignacion', $designacion[0]['motivonuevadesignacion']);	

 	// Se define los labels
 	$this->widgetSchema->setLabel('idcatedra', '<p align="left"><b>Materia:</b></p>');
 	$this->widgetSchema->setLabel('idtipodesignacion', '<p align="left"><b>Tipo Designaci&oacuten:</b></p>');
 	$this->widgetSchema->setLabel('adhonorem', '<p align="left">Ad Honorem:</p>');
 	$this->widgetSchema->setLabel('licencia', '<p align="left">En licencia:</p>');

 	// Se define los validadores 
	$this->setValidators(array(
		'idplanestudio'    => new sfValidatorString(),
		'idcatedra'    => new sfValidatorString(),
	));
	
	$this->validatorSchema['idplanestudio']->setMessage('required', 'Requerido'); 
	$this->validatorSchema['idcatedra']->setMessage('required', 'Requerido');
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 

	$this->disableLocalCSRFProtection();	
  }
}
