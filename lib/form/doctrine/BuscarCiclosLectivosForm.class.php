<?php
class BuscarCiclosLectivosForm extends sfForm
{
  public function configure()
  {
	$arregloInformes = array( 1 => 'Listado de Aspirantes por Carrera',  4 => 'Listado de Aspirantes para Seguro', 5 => 'Planilla de Asistencia Pre-Universitario' , 6 => 'Planilla de TP Pre-Universitario', 7 => 'Planilla de Evaluacion Pre-Universitario por Fecha', 8 => 'Planilla de Evaluacion Pre-Universitario por Carrera', 9 => 'Planilla de Aspirantes (Excel)', 10 => 'Listado de Inscriptos a Curso Anticipado');

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
