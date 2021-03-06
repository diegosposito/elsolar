<?php

/**
 * Planilla Sin Parcial
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here 
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class PlanillaSinParcial extends PDF 
{
  //********** Funcion Esquema Examen Sin Parcial*************
  public function EsquemaPlanillaSinParcial1eraHoja($bucles)
  {  
	//	ESQUEMA GRÁFICO
	// Define un alias para el número de páginas del documento pdf
	$this->AliasNbPages();
	// Linea horizontal que separa la Asignatura
	$this->Line(10,50,80,50);
	// Linea horizontal que separa la Firma de las fechas
	$this->Line(160,56,200,56);
	// Linea horizontal que separa la Fecha
	$this->Line(10,62,200,62);
	//Asigna el ancho de la linea
	$this->SetLineWidth(1);
	// Linea horizontal que separa el encabezado del listado
	$this->Line(11,66,199,66);
	//Asigna el ancho de la linea
	$this->SetLineWidth(0);
	// Linea vertical que separa el Nro de renglon y el Nombre
	$this->Line(17,62,17,284);
	// Lineas verticales que marca las columnas de la planilla
	$this->Line(80,36,80,62);
	$this->Line(160,36,160,284);
	$this->Line(180,56,180,284);
	
	//	ESQUEMA DE CONTENIDO
	// Muestra la Asignatura
	$this->SetFont('Times','',10);
	$this->SetXY(11,36.5);
	$this->Cell(70,5,"MATERIA:",0,1,'L');
	// Muestra los Profesores
	$this->SetFont('Times','',10);
	$this->SetXY(80,36.5);
	$this->Cell(40,5,"PROFESORES:",0,1,'L');
	$this->SetXY(95,41);
	$this->MultiCell(55,3,"______________________________",0,'C',0);
	$this->SetXY(95,45);
	$this->MultiCell(55,3,"______________________________",0,'C',0);
	$this->SetXY(95,49);
	$this->MultiCell(55,3,"______________________________",0,'C',0);
	// Muestra la Firma
	$this->SetFont('Times','',9);
	$this->SetXY(160,34);
	$this->Cell(40,10,"Firma:",0,1,'C');
	//Muestra las Fechas
	$x = 80;
	$contador = 1;
	$this->SetFont('Times','',9);
	while ($contador <= $bucles) {
		$this->SetXY($x,55.5);
	
		if ($x>150) $this->Cell(20,5,"Día:",0,1,'C');
	
		$this->SetXY($x,58);
		if ($x>150) $this->Cell(20,5,"/        /",0,1,'C');
		$x = $x + 20;
		$contador++;
	
	}
	$this->SetXY(178,55.5);
	$this->Cell(24,5,"Día:",0,1,'C');
	$this->SetXY(178,58);
	$this->Cell(24,5,"/        /",0,1,'C');
	// Muestra la cabecera de la lista
	$this->SetFont('Times','',9);
	$this->SetXY(11,59);
	$this->Cell(7,10,"Nro.",0,1,'C');
	$this->SetXY(18,59);
	$this->Cell(62,10,"ALUMNOS",0,1,'C');
	$this->SetXY(160,59);
	$this->Cell(20,10,"Asistencia",0,1,'C');
	$this->SetXY(180,59);
	$this->Cell(20,10,"Situación Final",0,1,'C');  	
  }  

  //********** Funcion Esquema Examen Sin Parcial*************
  public function EsquemaPlanillaSinParcial2daHoja($aux)
  {  
	// Agrega una nueva pagina
	$this->AddPage('P');
	// Asigna el ancho a la linea
	$this->SetLineWidth(1);
	// Linea horizontal que separa las Fechas y la cabecera del listado
	$this->Line(11,9.5,199,9.5);
	
	// Muestra la cabecera de la lista
	$this->SetFont('Times','',9);
	$this->SetXY(11,$aux);
	$this->Cell(7,5,"Nro.",0,1,'C');
	$this->SetXY(18,$aux);
	$this->Cell(62,5,"ALUMNOS",0,1,'C');
	$this->SetXY(160,$aux);
	$this->Cell(20,5,"Asistencia",0,1,'C');
	$this->SetXY(180,$aux);
	$this->Cell(20,5,"Situación Final",0,1,'C');  	
  }  
}