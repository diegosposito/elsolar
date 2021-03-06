<?php

/**
 * Planilla Generica
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class PlanillaGenerica extends PDF 
{
  //********** Funcion Esquema Planilla Generica*************
  public function EsquemaPlanillaGenerica1eraHoja($bucles,$tipo)
  {  
  	//	ESQUEMA GRÁFICO
	// Define un alias para el número de páginas del documento pdf
	$this->AliasNbPages();
	// Asigna el ancho a las lineas verticales
	$this->SetLineWidth(0);
	// Linea vertical que divide los datos de la asignatura con las firmas
	$this->Line(70,36,70,66);
	// Lineas verticales que marca las columnas de la planilla
	$this->Line(17,66,17,284);
	$this->Line(35,66,35,284);
	$this->Line(120,66,120,284);
	if($tipo == "parcial") {
		$this->Line(175,66,175,284);
	}	
	// Linea horizontal que separa la Asignatura
	$this->Line(10,53,70,53);
	// Linea horizontal que separa la Fecha
	$this->Line(10,70,200,70);
	// Asigna el ancho a la linea
	$this->SetLineWidth(1);
	// Linea horizontal que separa la cabecera del listado
	$this->Line(11,66,199,66);
	
	// ESQUEMA DE CONTENIDO
	// Muestra la Asignatura
	$this->SetFont('Times','',10);
	$this->SetXY(11,36.5);
	$this->Cell(65,5,"MATERIA:",0,1,'L');
	$this->SetXY(72,37);
	$this->Cell(65,5,"PROFESORES:",0,1,'L');
	$this->SetXY(80,43);
	$this->MultiCell(75,3,"________________________________________",0,'C',0);
	$this->SetXY(80,48);
	$this->MultiCell(75,3,"________________________________________",0,'C',0);
	$this->SetXY(80,53);
	$this->MultiCell(75,3,"________________________________________",0,'C',0);

	// Agregar la fecha de generacion
	$this->SetXY(70,60);
	$fechaactual = date('d/m/Y');
	$this->Cell(20,5,"Generado el: ".$fechaactual,0,1,'L');
		
	$this->SetXY(155,60);
	$this->Cell(20,5,"Fecha: ____/____/________",0,1,'L');
	
	// Muestra la cabecera de la lista
	$this->SetFont('Times','',9);
	$this->SetXY(11,66);
	$this->Cell(6,5,"Nro.",0,1,'C');
	$this->SetXY(17,66);
	$this->Cell(18,5,"LEGAJO",0,1,'C');
	$this->SetXY(35,66);
	$this->Cell(85,5,"ALUMNOS",0,1,'C');
	if($tipo == "parcial") {
		$this->SetXY(120,66);
		$this->Cell(55,5,"FIRMA",0,1,'C');
		$this->SetXY(175,66);
		$this->Cell(25,5,"CALIFICACIÓN",0,1,'C');
	} else {
		$this->SetXY(120,66);
		$this->Cell(85,5,"FIRMA",0,1,'C');
	}  	
  }

  //********** Funcion Esquema Planilla Generica*************
  public function EsquemaPlanillaGenerica2daHoja($bucles, $tipo)
  {
	// Agrega una nueva pagina
	$this->AddPage('P');
	// Asigna el ancho a la linea
	$this->SetLineWidth(1);
	// Linea horizontal que separa las Fechas y la cabecera del listado
	$this->Line(11,9.5,199,9.5);
	// Muestra la cabecera de la lista
	$this->SetFont('Times','',9);
	$this->SetXY(11,3);
	$this->Cell(6,9,"Nro.",0,1,'C');
	$this->SetXY(17,3);
	$this->Cell(18,9,"LEGAJO",0,1,'C');
	$this->SetXY(35,3);
	$this->Cell(85,9,"ALUMNOS",0,1,'C');
	if($tipo == "parcial") {
		$this->SetXY(120,3);
		$this->Cell(55,9,"FIRMA",0,1,'C');
		$this->SetXY(175,3);
		$this->Cell(25,9,"CALIFICACIÓN",0,1,'C');
	} else {
		$this->SetXY(120,3);
		$this->Cell(85,9,"FIRMA",0,1,'C');
	}	
  }  
}