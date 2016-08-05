<?php
class BuscarEgresadosForm extends sfForm
{
  protected static $tiposcriterios = array(1 => "Apellido", 2 => "Nro. Documento");
	        
  public function configure()
  {        
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	$arr = array(1, 2, 6);
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
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => $arregloPlanes));
	$this->widgetSchema['tipocriterio'] = new sfWidgetFormSelect(array('choices' => self::$tiposcriterios));
	$this->widgetSchema['criterio'] = new sfWidgetFormInput();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Carrera:</p>');
 	$this->widgetSchema->setLabel('tipocriterio', '<p align="left">Buscar en:</p>');
 	$this->widgetSchema->setLabel('criterio', '<p align="left"></p>');

 	// Se define los validadores 
	$this->setValidators(array(
		'idplanestudio'    => new sfValidatorString(),
		'tipocriterio'    => new sfValidatorString(),	
		'criterio'    => new sfValidatorString(array('required' => false)),
	));
 
	$this->widgetSchema->setNameFormat('buscar[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 	
  }
}
