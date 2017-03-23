<?php
class BuscarAlumnosForm extends sfForm
{
  protected static $tiposcriterios = array(1 => "Apellido", 2 => "Nro. Documento");
	        
  public function configure()
  {        
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
  	/*$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea(1);
  	//$arr = array(1, 2, 6);
	$arr = array(1);
  	foreach ($carreras as $carrera) {
  		$oCarrera = Doctrine_Core::getTable('Carreras')->find($carrera->idcarrera);
  		if (!in_array($oCarrera->getIdtipocarrera(), $arr)) {
  			$planes = $oCarrera->obtenerPlanesEstudiosActivos();
  			foreach($planes as $plan) {
  				$arregloPlanes[$plan['idplanestudio']] = $oCarrera->getNombrereducido().' - '.$plan['nombre'];
  			}
  		}
  	}
	asort($arregloPlanes); */
	$arrActivos = array();
	$arrActivos[1] = "Activo";
	$arrActivos[0] = "No Activo";

	
	// Se define el esquema del form
  	//$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => $arregloPlanes));
  	$this->widgetSchema['idactivo'] = new sfWidgetFormSelect(array('choices' => $arrActivos));
	$this->widgetSchema['tipocriterio'] = new sfWidgetFormSelect(array('choices' => self::$tiposcriterios));
	$this->widgetSchema['criterio'] = new sfWidgetFormInput();
	$this->widgetSchema['referer'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['url'] = new sfWidgetFormInputHidden();	
	$this->widgetSchema['titulo'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['tipo'] = new sfWidgetFormInputHidden();
	
 	// Se define los labels
	//$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Carrera:</p>');
	$this->widgetSchema->setLabel('idactivo', '<p align="left">Estado:</p>');
 	$this->widgetSchema->setLabel('tipocriterio', '<p align="left">Buscar en:</p>');
 	$this->widgetSchema->setLabel('criterio', '<p align="left"></p>');

 	// Se define los validadores 
	$this->setValidators(array(
	//	'idplanestudio'    => new sfValidatorString(),
		'tipocriterio'    => new sfValidatorString(),	
		'criterio'    => new sfValidatorString(array('required' => false)),
		'url' => new sfValidatorString(array('required' => false)),
		'referer' => new sfValidatorString(array('required' => false)),
	));
 
	$this->widgetSchema->setNameFormat('buscar[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 	
  }
}
