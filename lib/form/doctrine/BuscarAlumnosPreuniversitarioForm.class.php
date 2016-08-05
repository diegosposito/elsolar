<?php
class BuscarAlumnosPreuniversitarioForm extends sfForm
{
  protected static $tiposcriterios = array(1 => "Apellido", 2 => "Nro. Documento");
  
  public function configure()
  {        	
	$idarea = sfContext::getInstance()->getUser()->getProfile()->getIdarea();
  	$planesestudios = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($idarea);
  	$arr = array(1, 2); // se filtra los cursos y carreras no clasificadas
  	foreach($planesestudios as $planestudio){
		$arregloCarreras[$planestudio->getIdcarrera()] = $planestudio->getNombrecarrera(); 
  	}  	
	asort($arregloCarreras);	

  	$ciclos = Doctrine_Core::getTable('CiclosLectivos')->obtenerCiclosLectivosActivos();
  	foreach($ciclos as $ciclo){
  		$arregloCiclos[$ciclo->getId()] = $ciclo->getCiclo(); 
	}  	
	arsort($arregloCiclos);	
	
  	// Se define el esquema del form
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('choices' => $arregloCarreras));
	$this->widgetSchema['tipocriterio'] = new sfWidgetFormSelect(array('choices' => self::$tiposcriterios));
	$this->widgetSchema['criterio'] = new sfWidgetFormInput();
	$this->widgetSchema['idciclolectivo'] = new sfWidgetFormSelect(array('choices' => $arregloCiclos));
    
 	// Se define los labels
 	$this->widgetSchema->setLabel('idplanestudio', '<p align="left">Carrera:</p>');
 	$this->widgetSchema->setLabel('tipocriterio', '<p align="left">Buscar en:</p>');
 	$this->widgetSchema->setLabel('criterio', '<p align="left"></p>');
	$this->widgetSchema->setLabel('idciclolectivo', '<p align="left">Ciclo lectivo:</p>');
	 	
 	// Se define los validadores 
	$this->setValidators(array(
		'tipocriterio' => new sfValidatorString(),	
		'criterio'     => new sfValidatorString(array('required' => false)),
	));
 
	$this->widgetSchema->setNameFormat('buscar[%s]');

	$this->validatorSchema->setOption('allow_extra_fields',true); 	
  }
}
