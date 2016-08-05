<?php
class BuscarCiclosLectivosAcadForm extends sfForm
{
  public function configure()
  {
  	$arregloInformes = array( 1 => 'Listado de Aspirantes por Carrera');
  	
  	$arregloFormatos = array( 55 => 'Hoja A4',  50 => 'Hoja Carta',  65 => 'Hoja Oficio');
  	
  	$cicloslectivos = Doctrine_Core::getTable('CiclosLectivos')->obtenerCiclosLectivosActivos();
  	foreach($cicloslectivos as $ciclo){
  		$arregloCiclos[$ciclo->getId()] = $ciclo->getCiclo();
  	}

  	// Se define el esquema del form
  	$this->widgetSchema['listado'] = new sfWidgetFormSelect(array('choices' => $arregloInformes));
  	$this->widgetSchema['idciclo'] = new sfWidgetFormSelect(array('choices' => $arregloCiclos));
  	$this->widgetSchema['formatos'] = new sfWidgetFormSelect(array('choices' => $arregloFormatos));
  	 
  	// Se define los labels
  	$this->widgetSchema->setLabel('listado', '<p align="left">Listado:</p>');
  	$this->widgetSchema->setLabel('idciclo', '<p align="left">Ciclo lectivo:</p>');
  	$this->widgetSchema->setLabel('formatos', '<p align="left">Formato de página:</p>');
  }
}
