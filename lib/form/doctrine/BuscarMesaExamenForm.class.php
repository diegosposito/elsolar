<?php
class BuscarMesaExamenForm extends sfForm
{	        
  public function configure()
  {        
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
  	//$arr = array(1, 2, 6);
	$arr = array(1, 2);
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
	
	$arregloOrdenCampo = array('me.idmesaexamen' => 'Id','me.fecha' => 'Fecha','ma.nombre' => 'Materia','me.libro' => 'Libro','me.folio' => 'Folio','me.idcondicion' => 'Condicion');	  	
	$arregloOrdenMetodo = array('DESC' => 'DESC','ASC' => 'ASC');
	
	// Se define el esquema del form
  	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left">Plan de estudios:</p>', 'choices' => $arregloPlanes));
	$this->widgetSchema['idestado'] = new sfWidgetFormDoctrineChoice(array(
		'model'     => 'EstadosMesasExamenes',
		'add_empty' => false,
	));
  	$this->widgetSchema['ordencampo'] = new sfWidgetFormSelect(array('label' => '<p align="left">Ordenar por:</p>', 'choices' => $arregloOrdenCampo));
  	$this->widgetSchema['ordenmetodo'] = new sfWidgetFormSelect(array('label' => '<p align="left">Ordenar por:</p>', 'choices' => $arregloOrdenMetodo));
	
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);			
 	// Se define los labels
	$this->widgetSchema->setLabel('idestado', '<p align="left">Estado:</p>');
  }
}
