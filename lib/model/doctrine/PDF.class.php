<?php

/**
 * PDF
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class PDF extends sfTCPDF
{
  public function __construct($orientation = 'L', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = "UTF-8")
  {
    parent::__construct($orientation, $unit, $format, $unicode, $encoding);
  }
  	
 
  //********** Funcion Cabecera*************  
  public function Cabecera($facultad,$carrera,$titulo)
  {
	// Configura el auto-salto de pagina
	$this->SetAutoPageBreak(1, 0);
	// Agrega una nueva página al documento pdf
	$this->AddPage();
	
  	if($this->PageNo()==1){
		// Muestra la imagen del Logo de la UCU
		$this->Image('images/CabeceraSIG-UCU.jpg',10,5,192);
		$this->SetXY(35,7);
		// Establece la fuente: Times Negrita 14
		$this->SetFont('Times','B',13);
		// Asigna el ancho al borde
		$this->SetLineWidth(0);
		// Rectangulo Superior
		$this->Rect(10,5,190,31);
		//Asigna el ancho de la linea
		$this->SetLineWidth(0);
		// Linea horizontal que separa la cabecera y el nombre del documento
		$this->Line(10,30,200,30);
		// Asigna la posicion del eje Y
		$this->SetXY(58,15);
		// Muestra el Nombre de la Facultad
		$this->MultiCell(140,5,$facultad,0,'R');
		// Asigna la posicion del eje Y e X
		$this->SetXY(58,20);
		// Asigna el tamaño de la Fuente
		$this->SetFontSize(12);
		// Muestra la carrera
		$this->MultiCell(140,5,$carrera,0,'R');
		// Asigna la posicion del eje Y
		$this->SetY(28);
		// Muestra el titulo
		$this->Cell(0,10,$titulo,0,1,'C');
	}else{
		// Asigna el ancho al borde
		$this->SetLineWidth(0);
		// Asigna la posicion del eje Y
		$this->SetXY(88,6);
	}
  }   

  //********** Funcion Cabecera Oficio*************
  public function CabeceraOficio($facultad,$carrera,$titulo)
  {
	// Configura el auto-salto de pagina
	$this->SetAutoPageBreak(1 , 0);
	// Agrega una nueva página al documento pdf
	$this->AddPage('P','Legal');

	if($this->PageNo()==1){
		// Muestra la imagen del Logo de la UCU
		$this->Image('images/CabeceraSIG-UCU.jpg',11,5,190);
		$this->SetXY(35,7);
		// Establece la fuente: Times Negrita 13
		$this->SetFont('Times','B',13);
		// Asigna el ancho al borde
		$this->SetLineWidth(0);
		// Rectangulo Superior
		$this->Rect(10,5,195,31);
		//Asigna el ancho de la linea
		$this->SetLineWidth(0);
		// Linea horizontal que separa la cabecera y el nombre del documento
		$this->Line(10,30.5,205,30.5);
		// Asigna la posicion del eje Y
		$this->SetXY(55,15);
		// Muestra el Nombre de la Facultad
		$this->MultiCell(150,5,$facultad,0,'R');
		// Asigna la posicion del eje Y e X
		$this->SetXY(55,20);
		// Asigna el tamaño de la Fuente
		$this->SetFontSize(12);
		// Muestra la carrera
		$this->MultiCell(150,5,$carrera,0,'R');
		// Asigna la posicion del eje Y
		$this->SetY(28.5);
		// Muestra el titulo
		$this->Cell(0,10,$titulo,0,1,'C');
	}else{
		// Asigna el ancho al borde
		$this->SetLineWidth(0);
		// Asigna la posicion del eje Y
		$this->SetXY(88,6);
	}
  }

  //********** Funcion Cabecera Apaisada*************
  public function CabeceraApaisada($facultad,$carrera,$titulo)
  {
	// Configura el auto-salto de pagina
	$this->SetAutoPageBreak(1 , 0);
	// Agrega una nueva página al documento pdf
	$this->AddPage('L');
	
  	if($this->PageNo()==1){
		// Muestra la imagen del Logo de la UCU
		$this->Image('images/CabeceraSIG-UCU2.jpg',6,5,342,25);
		$this->SetXY(35,7);
		// Establece la fuente: Times Negrita 14
		$this->SetFont('Times','B',13);
		// Asigna el ancho al borde
		$this->SetLineWidth(0);
		// Rectangulo Superior
		$this->Rect(5,5,345,31);
		//Asigna el ancho de la linea
		$this->SetLineWidth(0);
		// Linea horizontal que separa la cabecera y el nombre del documento
		$this->Line(5,30.5,350,30.5);
		// Asigna la posicion del eje Y
		$this->SetXY(148,15);
		// Muestra el Nombre de la Facultad
		$this->MultiCell(200,5,$facultad,0,'R');
		// Asigna la posicion del eje Y e X
		$this->SetXY(198,20);
		// Asigna el tamaño de la Fuente
		$this->SetFontSize(12);
		// Muestra la carrera
		$this->MultiCell(150,5,$carrera,0,'R');
		// Asigna la posicion del eje Y
		$this->SetY(28.5);
		// Muestra el titulo
		$this->Cell(0,10,$titulo,0,1,'C');
	}else{
		// Asigna el ancho al borde
		$this->SetLineWidth(0);
		// Asigna la posicion del eje Y
		$this->SetXY(88,6);
	}
  }

  //********** Funcion Pie Apaisada *************
  public function PieApaisada($idsede)
  {
	// Rectangulo Página completa
	$this->Rect(5,5,345,200);
	// Asigna el ancho de la linea
	$this->SetLineWidth(0);
	// Linea horizontal que separa el pie y el documento
	$this->Line(5,188,350,188);

	// Muestra la imagen del Logo de la UCU con direccion dependientdo de parametro
	if ($idsede==1) $imgpie='images/PieSIG-UCU.jpg';
	if ($idsede==2) $imgpie='images/PieSIG-UCU-GCHU.jpg';
	if ($idsede==3) $imgpie='images/PieSIG-UCU-VGUAY.jpg';
	if ($idsede==4) $imgpie='images/PieSIG-UCU-ROS.jpg';
	if ($idsede==5) $imgpie='images/PieSIG-UCU.jpg';
	if ($idsede==6) $imgpie='images/PieSIG-UCU-PAR.jpg';
	if ($idsede==7) $imgpie='images/PieSIG-UCU-GCHU.jpg';
	if ($idsede==8) $imgpie='images/PieSIG-UCU-VEN.jpg';
	//$this->Image($imgpie,79,190,188);	
	$this->Image($imgpie,5,189,345,16);
	
	$this->SetXY(8,-19);

	// Formato del pie de pagina: Times Italic 8
	$this->SetFont('Times','',8);
	 // Muestra el número de página
	$this->Cell(5,0,'Página '.$this->PageNo().'/{nb}',0,0,'L');
  }

  //********** Funcion Pie Oficio *************
  public function PieOficio($idsede)
  {
	// Rectangulo Página completa
	//$this->Rect(10,5,195,346);
	//Asigna el ancho de la linea
	$this->SetLineWidth(0);
	// Linea horizontal que separa el pie y el documento
	$this->Line(10,340,205,340);

	// Muestra la imagen del Logo de la UCU con direccion dependientdo de parametro 
	if ($idsede==1) $imgpie='images/PieSIG-UCU.jpg';
	if ($idsede==2) $imgpie='images/PieSIG-UCU-GCHU.jpg';
	if ($idsede==3) $imgpie='images/PieSIG-UCU-VGUAY.jpg';
	if ($idsede==4) $imgpie='images/PieSIG-UCU-ROS.jpg';
	if ($idsede==5) $imgpie='images/PieSIG-UCU.jpg';
	if ($idsede==6) $imgpie='images/PieSIG-UCU-PAR.jpg';
	if ($idsede==7) $imgpie='images/PieSIG-UCU-GCHU.jpg';
	if ($idsede==8) $imgpie='images/PieSIG-UCU-VEN.jpg';
	$this->Image($imgpie,11,341,188);
	
	$this->SetXY(11,-10);

	// Formato del pie de pagina: Times Italic 8
	$this->SetFont('Times','',8);
	// Muestra el número de página
	//$this->Cell(5,0,'Página '.$this->PageNo().'/{nb}',0,0,'L');
  }
  
  //********** Funcion Pie*************
  public function Pie($idsede, $borde=1)
  {
  	if ($borde==1) {
  		// Rectangulo Página completa
  		$this->Rect(10,5,190,290);
  	}
	//Asigna el ancho de la linea
	$this->SetLineWidth(0);
	// Linea horizontal que separa el pie y el documento
	$this->Line(10,284,200,284);
	
	// Muestra la imagen del Logo de la UCU con direccion dependientdo de parametro 
	if ($idsede==1) $imgpie='images/PieSIG-UCU.jpg';
	if ($idsede==2) $imgpie='images/PieSIG-UCU-GCHU.jpg';
	if ($idsede==3) $imgpie='images/PieSIG-UCU-VGUAY.jpg';
	if ($idsede==4) $imgpie='images/PieSIG-UCU-ROS.jpg';
	if ($idsede==5) $imgpie='images/PieSIG-UCU.jpg';
	if ($idsede==6) $imgpie='images/PieSIG-UCU-PAR.jpg';
	if ($idsede==7) $imgpie='images/PieSIG-UCU-GCHU.jpg';
	if ($idsede==8) $imgpie='images/PieSIG-UCU-VEN.jpg';	
	$this->Image($imgpie,11,285,188);

	$this->SetXY(11,-10);
	
	// Formato del pie de pagina: Times Italic 8
	$this->SetFont('Times','',8);
	// Muestra el número de página
	$this->Cell(5,0,'Página '.$this->PageNo().'/{nb}',0,0,'L');
  }  
	
//********** Funcion Justify *************
function Justify($text,$w,$h)
{
	$tab_paragraphe = explode("\n", $text);
	$nb_paragraphe = count($tab_paragraphe);
	$j=0;

	while ($j<$nb_paragraphe) {
		$paragraphe = $tab_paragraphe[$j];
		$tab_mot = explode(' ', $paragraphe);
		$nb_mot = count($tab_mot);

		// *** Handle strings longer than paragraph width
		$k=0;
		$l=0;
		while ($k<$nb_mot) {

			$len_mot = strlen ($tab_mot[$k]);
			if ($len_mot< ($w-5) ) {
				$tab_mot2[$l] = $tab_mot[$k];
				$l++;	
			} else {
				$m=0;
				$chaine_lettre='';
				while ($m<$len_mot) {
					$lettre = substr($tab_mot[$k], $m, 1);
					$len_chaine_lettre = $this->GetStringWidth($chaine_lettre.$lettre);

					if ($len_chaine_lettre>($w-7)) {
						$tab_mot2[$l] = $chaine_lettre . '-';
						$chaine_lettre = $lettre;
						$l++;
					} else {
						$chaine_lettre .= $lettre;
					}
					$m++;
				}
				if ($chaine_lettre) {
					$tab_mot2[$l] = $chaine_lettre;
					$l++;
				}
			}
			$k++;
		}

		// *** Justified lines
		$nb_mot = count($tab_mot2);
		$i=0;
		$ligne = '';
		while ($i<$nb_mot) {
			$mot = $tab_mot2[$i];
			$len_ligne = $this->GetStringWidth($ligne . ' ' . $mot);
			if ($len_ligne>($w-5)) {
				$len_ligne = $this->GetStringWidth($ligne);
				$nb_carac = strlen ($ligne);
				$ecart = (($w-2) - $len_ligne) / $nb_carac;
				$this->_out(sprintf('BT %.3f Tc ET',$ecart*$this->k));
				$this->MultiCell($w,$h,$ligne);
				$ligne = $mot;
			} else {
				if ($ligne) {
					$ligne .= ' ' . $mot;
				} else {
					$ligne = $mot;
				}
			}
			$i++;
		}
		// *** Last line
		$this->_out('BT 0 Tc ET');
		$this->MultiCell($w,$h,$ligne);
		$tab_mot = '';
		$tab_mot2 = '';
		$j++;
	}
}  
}