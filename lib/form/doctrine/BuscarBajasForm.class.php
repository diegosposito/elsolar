<?php
class BuscarBajasForm extends sfForm
{
  public function configure()
  {  	 
	$sedes = Doctrine_Core::getTable('Sedes')->findAll();
	$arregloSedes[0] = "----TODOS----";
	foreach($sedes as $sede){
		$arregloSedes[$sede->getIdsede()] = $sede->getNombre();
	}
	asort($arregloSedes);
	
	$facultades = Doctrine_Core::getTable('Facultades')->findAll();
	$arregloFacultades[0] = "----TODOS----";
	foreach($facultades as $facultad){
		$arregloFacultades[$facultad->getIdfacultad()] = $facultad->getNombre();
	}
	asort($arregloFacultades);
	
	$arregloOrdenCampo = array('s.nombre' => 'Sede','f.nombre' => 'Facultad','c.nombre' => 'Carrera','ea.fecha' => 'Fecha de baja');
	$arregloOrdenMetodo = array('ASC' => 'ASC','DESC' => 'DESC');
	
	// Se define el esquema del form
	$this->widgetSchema['idsede'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Sede:</b></p>', 'choices' => $arregloSedes));
	$this->widgetSchema['idfacultad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Facultad:</b></p>', 'choices' => $arregloFacultades));
	$this->widgetSchema['idplanestudio'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Carrera:</b></p>','choices' => array(0 => '----TODOS----')));
	
	$this->widgetSchema['ordencampo'] = new sfWidgetFormSelect(array('label' => '<p align="left">Ordenar por:</p>', 'choices' => $arregloOrdenCampo));
	$this->widgetSchema['ordenmetodo'] = new sfWidgetFormSelect(array('label' => '<p align="left">Ordenar por:</p>', 'choices' => $arregloOrdenMetodo));
	
  }
}
