<?php
class BuscarTitulosForm extends sfForm
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
  				$titulos = $plan->obtenerTitulos();
  				foreach($titulos as $titulo) {
  					$arregloTitulos[$titulo['idtitulo']] = $titulo['nombre'];  				
  				} 
  				
  			}
  		}
  	}
	asort($arregloTitulos);
	
	// Se define el esquema del form
  	$this->widgetSchema['idtitulo'] = new sfWidgetFormSelect(array('choices' => $arregloTitulos));
	$this->widgetSchema['tipocriterio'] = new sfWidgetFormSelect(array('choices' => self::$tiposcriterios));
	$this->widgetSchema['criterio'] = new sfWidgetFormInput();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('idtitulo', '<p align="left">Título que solicita:</p>');
 	$this->widgetSchema->setLabel('tipocriterio', '<p align="left">Buscar en:</p>');
 	$this->widgetSchema->setLabel('criterio', '<p align="left"></p>');

 	// Se define los validadores 
	$this->setValidators(array(
		'idtitulo'    => new sfValidatorString(),
		'tipocriterio'    => new sfValidatorString(),	
		'criterio'    => new sfValidatorString(array('required' => false)),
	));
 
	$this->widgetSchema->setNameFormat('buscar[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 	
  }
}
