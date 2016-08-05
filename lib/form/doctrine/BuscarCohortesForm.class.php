<?php
class BuscarCohortesForm extends sfForm
{
  public function configure()
  {         
	$this->cohortes = array( 2014 => '2014',2007 => '2007',2008 => '2008',2009 => '2009',2010 => '2010',2011 => '2011', 2012 => '2012', 2013 => '2013' );
	$this->informes = array( 1 => 'Listado de Aspirantes por Carrera', 2 => 'Listado de Aspirantes por Comisiones', 3 => 'Planilla Asistencia Preuniversitario', 4 => 'Listado Aspirantes para Seguro' , 5 => 'Planilla de Evaluacion Pre.', 6 => 'Planilla de TP Pre.', 7 => 'Evaluacion x Carrera', 8 => 'Evaluacion Inscriptos x Fecha', 9 => 'Planilla Excel Aspirantes');
	$this->comisiones = array( 0 => 'Todas las Comisiones', 1 => 'Comision 1', 2 => 'Comision 2' , 3 => 'Comision 3' , 4 => 'Comision 4' , 5 => 'Comision 5');
     
	$this->setWidgets(array(
		'Listado'   => new sfWidgetFormSelect(array('choices' => $this->informes)),
		'Cohorte'   => new sfWidgetFormSelect(array('choices' => $this->cohortes)),
		//'Comisiones'   => new sfWidgetFormSelect(array('choices' => $this->comisiones))                   
	));
	 
	 
	$this->setValidators( array( 
	   	'Listado' => new sfValidatorChoice( array( 'required' => true, 'choices'=> array_keys($this->informes))),
		'Cohorte' => new sfValidatorChoice( array( 'required' => true, 'choices'=> array_keys($this->cohortes))),
		//'Comisiones' => new sfValidatorChoice( array( 'required' => true, 'choices'=> array_keys($this->comisiones)))
	));  
  }
}
