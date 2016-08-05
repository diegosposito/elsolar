<?php
class BuscarEstadosCiclosLectivosForm extends sfForm
{
  public function configure()
  {
	$arregloInformes = array( 1 => 'Listado por Carrera');
  	$cicloslectivos = Doctrine_Core::getTable('CiclosLectivos')->obtenerCiclosLectivosActivos();
  	$estadosalumno = Doctrine_Core::getTable('EstadosAlumno')->obtenerEstados();
  	foreach($cicloslectivos as $ciclo){
		$arregloCiclos[$ciclo->getId()] = $ciclo->getCiclo(); 
	}  	  	
  	foreach($estadosalumno as $estados){
		$arregloEstados[$estados->getIdestadoalumno()] = $estados->getDescripcion(); 
	}  	
	// Se define el esquema del form
  	$this->widgetSchema['listado'] = new sfWidgetFormSelect(array('choices' => $arregloInformes));
  	$this->widgetSchema['idciclo'] = new sfWidgetFormSelect(array('choices' => $arregloCiclos));
  	$this->widgetSchema['idestado'] = new sfWidgetFormSelect(array('choices' => $arregloEstados));  	   
 	// Se define los labels
 	$this->widgetSchema->setLabel('listado', '<p align="left">Tipo de Listado:</p>');
 	$this->widgetSchema->setLabel('idciclo', '<p align="left">Ciclo lectivo de baja:</p>');
 	$this->widgetSchema->setLabel('idestado', '<p align="left">Estados de Alumnos:</p>');
  }
}
