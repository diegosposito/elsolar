<?php

/**
 * impresiones actions.
 *
 * @package    sig
 * @subpackage impresiones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class impresionesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executeGenerarconstanciaalumnoregular(sfWebRequest $request)	{
	
  }
  
  public function executeImprimirconstanciaalumnoregular(sfWebRequest $request)
  {
	setlocale(LC_ALL,"es_ES");
  	// Asigna las distintas variables
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	$fecha = strftime("%A %d de %B de %Y");

  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	$oPersona = $oAlumno->getPersonas();
	$oPlanEstudio = $oAlumno->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();
  	$oSede = Doctrine_Core::getTable('Sedes')->find($idsede);
  	
  	// Crea una instancia de la clase de FPDF
	$pdf = new PDF();
	
	// Asigna el titulo de la planilla
	$titulo = "CONSTANCIA DE ALUMNO REGULAR";
	// Configura el auto-salto de pagina
	$pdf->SetAutoPageBreak(1 , 10);
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);	
	$pdf->SetFont('Times','',12);
	$pdf->SetX(35);
	// Define un alias para el número de páginas del documento pdf
	$pdf->AliasNbPages();
	if($oPersona->getIdsexo()==1){
		$alumno ="alumno";
		$interesado="del interesado";
	}else{
		$alumno ="alumna";
		$interesado="de la interesada";
	}

	// Muestra el lugar y la fecha de emision de la constancia
	$pdf->Cell(0,10,$oSede->getCiudades().", ". $fecha,0,0,'R');
	// Inserta un salto de linea
	$pdf->Ln(15);
	// Muestra el texto del primer parrafo de la constancia
	$carrera = strtr(strtoupper($oCarrera),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
	//$pdf->Justify("CONSTE que ".$oPersona.", ".$oPersona->getTiposDocumentos()." Nº ".$oPersona->getNrodoc().", cursa regularmente en la carrera ".strtoupper($oCarrera)." que se dicta en esta Universidad.".str_repeat(" ",20)."\n",170,5);
	$pdf->MultiCell(190, 0, "CONSTE que ".$oPersona.", ".$oPersona->getTiposDocumentos()." Nº ".$oPersona->getNumerodoc().", cursa regularmente en la carrera ".$carrera." que se dicta en esta Universidad.".str_repeat(" ",20)."\n", '', 'J');
	// Inserta un salto de linea
	$pdf->Ln(5);
	// Muestra el texto del segundo parrafo de la constancia
	//$pdf->Justify("Se extiende la presente constancia, a pedido ".$interesado." y para ser presentada ante las autoridades que lo requieran en la ciudad de ".$oSede->getCiudades().".\n",170,5);
	$pdf->MultiCell(190, 0, "Se extiende la presente constancia, a pedido ".$interesado." y para ser presentada ante las autoridades que lo requieran en la ciudad de ".$oSede->getCiudades().".\n", '', 'J');

	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->Pie($idsede,1);
	// Guarda o envía el documento pdf
	$pdf->Output('constancia-alumno-regular.pdf','I');
	// Termina el documento
	$pdf->Close();  
	// Para el proceso de symfony
  	throw new sfStopException(); 	
  }  
    
  // Controla el formulario de Acta Volante
  public function executeVerificaractavolante(sfWebRequest $request)
  {
  	$this->mesas =array();
  	$this->mensaje ="";
  	$this->catedra = "";
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	// Crea el formulario y asigna los valores por defecto
  	$this->form = new ImprimirActaVolanteForm(array(
		'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
	));	
  	
  	if ($request->isMethod('post'))	{
		// Se asigna el idcatedra
		$this->catedra = Doctrine::getTable('Catedras')->find($request->getParameter("idcatedra"));

		// Busca todos las actas volantes para dicho detalle plan
		$this->mesas = $this->catedra->obtenerMesasExamenes(MESASCERRADAS);

		if(count($this->mesas) == 0){
  			$this->mensaje = "No hay mesas de examenes.";
  		}
	}
  }  

  public function executeImprimiractavolante(sfWebRequest $request)
  {
	// Asigna las distintas variables
	$oMesaExamen = Doctrine_Core::getTable('MesasExamenes')->find($request->getParameter("idmesaexamen"));
	$oCatedra = $oMesaExamen->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();
	$oCondicion = $oMesaExamen->getCondicionesMesas();
  	$designaciones = $oMesaExamen->obtenerDesignaciones(0);
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	$bucles = 3;

	// Crea una instancia de la clase de PDF
	$pdf = new ActaVolante();

	// Asigna el titulo de la planilla
	$titulo= "ACTA VOLANTE DE EXÁMENES";
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
	// Agrega el esquema grafico del acta volante
	$pdf->EsquemaActaVolante($bucles);
	$pdf->SetXY(35,41);
	$pdf->Cell(150,3, $oMateriaPlan->getIdmateriaplan()." - ".$oMateriaPlan,0,0,'L');
	$pdf->SetXY(11,46);
	$pdf->Cell(65,5,"ACTA DE EXÁMENES DE ALUMNOS: ".$oCondicion,0,1,'L');
	$pdf->SetXY(155,46);
	$pdf->Cell(45,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(11,50);
  	$arr = explode('-', $oMesaExamen->getFecha());
  	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];	
	$pdf->Cell(65,5,"FECHA: ".$fecha,0,1,'L');
	$pdf->SetXY(105,50);
	$pdf->Cell(50,5,"LIBRO: ".$oMesaExamen->getLibrosActas(),0,1,'L');
	$pdf->SetXY(155,50);
	$pdf->Cell(45,5,"FOLIO: ".$oMesaExamen->getFolio(),0,1,'L');
	// Muestra la lista de Alumnos
	$resultado = $oMesaExamen->obtenerInscriptos(); 
  	foreach ($resultado as $item){
		$alumnos[$item->getIdalumno()] = Doctrine_Core::getTable('Alumnos')->find($item->getIdalumno());
	}
	
	$total = count($alumnos);
	$y = 64;
	$contador = 1;
	foreach($alumnos as $alumno) {
		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(11,$y);
		$pdf->Cell(6,7,$contador,0,1,'C');
		$pdf->SetXY(17,$y);
		$pdf->Cell(23,7,$alumno->getLegajo(),0,1,'C');	
		$pdf->SetXY(40,$y);
		$pdf->Cell(23,7,$alumno->getPersonas()->getTiposDocumentos()." ".$alumno->getPersonas()->getNumeroDoc(),0,1,'C');
		$pdf->SetXY(62.5,$y);
		
		$nombre = $alumno->getPersonas();
		if(strlen($nombre) < 30) {
			$pdf->Cell(70.5,7,$nombre,0,1,'L');
		}else{
			$pdf->Cell(70.5,7,substr($nombre,0, 29),0,1,'L');
		}	
		$y = $y + 7;
		$pdf->Line(10,$y,200,$y);
		$contador++;
	}
	// Muestra los totales
	$pdf->SetXY(154.5,$y);
	$pdf->Cell(22,5,"Total Alumnos:",0,1,'L');
	$pdf->SetXY(154.5,$y+5);
	$pdf->Cell(22,5,"Total Aprobados:",0,1,'L');
	$pdf->SetXY(154.5,$y+10);
	$pdf->Cell(22,5,"Total Aplazados:",0,1,'L');
	$pdf->SetXY(154.5,$y+16);
	$pdf->Cell(22,5,"Total Ausentes:",0,1,'L');
	
	//Muestra las Firmas
	$x = 10;
	$contador = 1;
	$pdf->SetFont('Times','',9);
	while ($contador <= $bucles) {
		$pdf->SetXY($x,$y);
		$pdf->Cell(48.5,5,"Firma:",0,1,'C');
		$x = $x + 48.5;
		$contador++;
	}
	
	// Muestra los profesores
	$pdf->SetXY(10,$y+16.5);
	$pdf->MultiCell(48.5,3,$designaciones[0]->getProfesores()->getPersonas(),0,'C',0);
	$pdf->SetXY(10,$y+20);
	$pdf->Cell(48.5,5,"Presidente",0,1,'C');
	$pdf->SetXY(58.5,$y+16.5);
	$pdf->MultiCell(48.5,3,$designaciones[1]->getProfesores()->getPersonas(),0,'C',0);
	$pdf->SetXY(58.5,$y+20);
	$pdf->Cell(48.5,5,"Vocal",0,1,'C');
	$pdf->SetXY(107,$y+16.5);
	$pdf->MultiCell(48.5,3,$designaciones[2]->getProfesores()->getPersonas(),0,'C',0);
	$pdf->SetXY(107,$y+20);
	$pdf->Cell(48.5,5,"Vocal",0,1,'C');
	// Linea horizontal que separa los totales
	$pdf->Line(155.5,$y+5,200,$y+5);
	$pdf->Line(155.5,$y+10,200,$y+10);
	$pdf->Line(155.5,$y+22,200,$y+22);
	$pdf->Line(10,$y+16,200,$y+16);
	$pdf->Line(10,$y+25,155.5,$y+25);
	//Asigna el ancho de la linea
	$pdf->SetLineWidth(1);
	// Linea horizontal que separa el final del listado
	$pdf->Line(11,$y,199,$y);
	//Asigna el ancho de la linea
	$pdf->SetLineWidth(0);
	// Linea vertical que separa el Nro de renglon y el Legajo
	$pdf->Line(17,60,17,$y);
	
	// Lineas verticales que marca las columnas de la planilla
	$pdf->Line(40,60,40,$y);
	$pdf->Line(62.5,60,62.5,$y);
	$pdf->Line(133,60,133,$y);
	$pdf->Line(155.5,60,155.5,$y+25);
	$pdf->Line(178,60,178,$y+22);
	// Lineas verticales que dividen las firmas
	$pdf->Line(58.5,$y,58.5,$y+25);
	$pdf->Line(107,$y,107,$y+25);
	
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->Pie($idsede,1);
	// Guarda o envía el documento pdf
	$pdf->Output('acta-volante.pdf','I');
	// Termina el documento
	$pdf->Close();
	// Para el proceso de symfony
  	throw new sfStopException(); 
  }  
  
  // Controla el formulario de Planilla de Asistencia
  public function executeVerificarplanillaasistencia(sfWebRequest $request)
  {
  	$this->mensaje ="";
  	//$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
	$idarea = sfContext::getInstance()->getUser()->getProfile()->getIdarea(); 
  	// Crea el formulario y asigna los valores por defecto
  	$this->form = new ImprimirPlanillaForm(array(
		'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
	));	
	$this->tipos = array(1 => 'Planilla de Asistencia común', 2 =>'Planilla de Asistencia con Firmas', 3 =>'Planilla de Trabajos Practicos', 4 =>'Planilla de Regularidades');
	$this->form->setWidget('tipo', new sfWidgetFormChoice(array('label' => '<p align="left">Tipo:</p>', 'choices'  => $this->tipos, 'expanded' => true, 'default' => 1)));
  	
  	if ($request->isMethod('post'))	{
		// Obtiene la catedra
		$oCatedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter("idcatedra"));
		// Obtiene la materiaplan
		$oMateriaPlan = $oCatedra->getMateriasPlanes();
		// Busca todos los alumnos cursando esa materia
		if ($request->getParameter("idplanestudio")==168) {
			$resultado = Doctrine_Core::getTable('AluMat')->getAlumnosCursandoPre($request->getParameter("idcomision"));
		} else {
			$resultado = Doctrine_Core::getTable('AluMat')->getAlumnosCursando($request->getParameter("idcomision"));
		}

  		if(count($resultado)>0){
			switch ($request->getParameter("tipo")) {
		    	case 1:
		        	$this->executeImprimirplanillaasistencia($request, $resultado);
		    		break;
		    	case 2:
		    		$request->setParameter("tipo", "asistencia");
		        	$this->executeImprimirplanillagenerica($request, $resultado);	
		        	break;
		    	case 3:
		    		$request->setParameter("tipo", "informe");
					$this->executeImprimirplanillatp($request, $resultado);	
		    		break;
		    	case 4:
		    		$request->setParameter("tipo", "informe");
					$this->executeImprimirplanillaregularidades($request, $resultado);	
		    		break;
			}		
  		}else{
  			$this->mensaje = "No hay inscriptos.";
  		}
	}
  }

  public function executeEstadoalumnosegunmateria(sfWebRequest $request)
  {
  	$this->mensaje ="";
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	// Crea el formulario y asigna los valores por defecto
  	$this->form = new ImprimirEstadoForm(array(
		'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
	));	
	
  	if ($request->isMethod('post'))	{

  		// Obtiene materia
		$this->nombre_materia = Doctrine_Core::getTable('Catedras')->getMateriaPorCatedra($request->getParameter("idcatedra"));
		
        //Obtiene alumnos cursando catedra seleccionada e informacion de correlatividades
		$this->alumnos = Doctrine_Core::getTable('Alumnos')->alumnosCursandoMateriasCorrelativas($request->getParameter("idcatedra"), date("Y-m-d", strtotime($request->getParameter("fecha"))));
		
		$this->oCarrera = Doctrine_Core::getTable('Carreras')->find($request->getParameter("idplanestudio"));
        
    }
  }   

  public function executeImprimirplanillaasistencia($request, $alumnos)
  {
	$arregloDias = array('L' => 'Lunes', 'M' => 'Martes', 'I' => 'Miercoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sabado', 'D' => 'Domingo');
  	// Asigna las distintas variables
	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter("idcomision"));
	$oCatedra = $oComision->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();

	$asignaciones_clases = Doctrine_Core::getTable('AsignacionesClases')->obtenerHorariosComisionCiclo($request->getParameter("idcomision"));

	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
	$bucles = 5;

	// Crea el objeto pdf
	$pdf = new PlanillaAsistencia();
	
	// Asigna el titulo de la planilla
	$titulo= "REGISTRO DE TEMAS Y ASISTENCIA";
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
	// Agrega el esquema grafico de la planilla
	$pdf->EsquemaPlanillaAsistencia1eraHoja($bucles);
	// Se cargan las variables de la cabecera
	$pdf->SetXY(11,41);
	$pdf->MultiCell(60,3, $oCatedra->getIdmateriaplan()." - ".$oCatedra->getMateriasPlanes(),0,'C',0);
	// Muestra el Curso, la Comisión y las Horas Semanales
	$pdf->SetXY(11,55);
	$pdf->Cell(65,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(11,59);
	$pdf->Cell(65,5,"COMISIÓN: ".$oComision->getNombre(),0,1,'L');
	$pdf->SetXY(11,63);
	$pdf->Cell(65,5,"HS. SEMANALES: ". $oMateriaPlan->getCargahorariasemanal(),0,1,'L');
	$pdf->SetXY(11,67);
	if (count($asignaciones_clases)>0){
		$horario = "HORARIO: ";
		foreach ($asignaciones_clases as $asignacion) {
			$horario .= $arregloDias[$asignacion->getDia()]." ".date("H:i",strtotime($asignacion->getHoraInicio()))." - ".date("H:i",strtotime($asignacion->getHorafin()))."\n";
		}
		$pdf->MultiCell(60,2,$horario,0,'L',0);		
	}

	/////////////////////////////////////////////////////////////////////////
	// CUERPO PAGINA
	/////////////////////////////////////////////////////////////////////////
	$total = count($alumnos);
	$y = 114;
	$contador = 1;
	foreach($alumnos as $alumno){	
		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(11,$y);
		$pdf->Cell(6,7,$contador,0,1,'C');
		$pdf->SetXY(17,$y);
		$nombreAlumno = $alumno->getPersonas();
		if (strlen($nombreAlumno) <= 30) {
			$pdf->Cell(54,7,$nombreAlumno,0,1,'L');
		}elseif ((strlen($nombreAlumno) > 30) and (strlen($nombreAlumno) <= 37)) {
			$pdf->SetFont('Times','',8);
			$pdf->Cell(54,7,$nombreAlumno,0,1,'L');
			$pdf->SetFont('Times','',9);
		} else {
			$pdf->SetFont('Times','',8);
			$pdf->Cell(54,7,substr($nombreAlumno,0,33),0,1,'L');
			$pdf->SetFont('Times','',9);
		}
			
		$y = $y + 7;
		$pdf->Line(10,$y,200,$y);
		if($pdf->PageNo()>1){
			$aux=5;
			$pdf->Line(17,$aux,17,$y);
			// Lineas verticales que marca las columnas de la planilla
			$pdf->Line(70,$aux,70,$y);
			$pdf->Line(95,$aux,95,$y);
			$pdf->Line(120,$aux,120,$y);
			$pdf->Line(145,$aux,145,$y);
			$pdf->Line(170,$aux,170,$y);
			$pdf->Line(195,$aux,195,$y);
		}else{
			$aux=36;
			$pdf->Line(17,110,17,$y);
		}
		// Pasos a seguir si tiene que continuar en otra pagina
		if ($y > 280){
		  	// Agrega el Pie al Documento
			$pdf->Pie($idsede,1);
			// Agrega el Esquema Grafico de la segunda pagina
			$pdf->EsquemaPlanillaAsistencia2daHoja($bucles);
			// Reinicia el valor para la nueva página
			$y=9;
		}
		$contador++;
	}
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->Pie($idsede,1);
	// Guarda o envía el documento pdf
	$pdf->Output('planilla-asistencia.pdf','I');
	// Termina el documento
	$pdf->Close();
  	// Para el proceso de symfony
  	throw new sfStopException(); 
  }  

  public function executeImprimirplanillagenerica($request, $alumnos)
  {
	// Asigna las distintas variables
	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter("idcomision"));
	$oCatedra = $oComision->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();
	$oEstadoMateria = Doctrine_Core::getTable('EstadosMateria')->find(1);
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
	$tipo = $request->getParameter("tipo");
	$bucles = 5;
	$fechaactual = date('Y-m-d');
	
	// Crea una instancia de la clase de PDF
	$pdf = new PlanillaGenerica();

	// Verifica que tipo fue elegido
	if ($tipo == "parcial"){
		// Asigna el titulo de la planilla
		$titulo= "PLANILLA DE EXAMEN PARCIAL";
	} else {
		// Asigna el titulo de la planilla
		$titulo= "PLANILLA DE ASISTENCIA";
	}	
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
	// Agrega el esquema grafico de la planilla
	$pdf->EsquemaPlanillaGenerica1eraHoja($bucles, $tipo);
	// Se cargan las variables de la cabecera
	$pdf->SetFont('Times','',9);
	$pdf->SetXY(11,41);
	$pdf->MultiCell(60,3, $oCatedra->getIdmateriaplan()." - ".$oCatedra->getMateriasPlanes(),0,'C',0);	
	// Muestra el Curso, la Comisión y el Estado de los alumnos
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(11,53);
	$pdf->Cell(60,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(11,57);
	$pdf->Cell(60,5,"COMISIÓN: ".$oComision->getNombre(),0,1,'L');
	$pdf->SetXY(11,61);
	$pdf->Cell(60,5,"ALUMNOS: ". $oEstadoMateria,0,1,'L');	
	/////////////////////////////////////////////////////////////////////////
	// CUERPO PAGINA
	/////////////////////////////////////////////////////////////////////////
	$alumnosConDocumentacion = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerAlumnosConDocumentacion($request->getParameter("idcomision"));

	$total = count($alumnos);
	$y = 69;
	$contador = 1;
	$total = 50;
	foreach($alumnos as $alumno){
		////////////////////////////////////////////////
		// CONTROL LIBREDEUDA	
		$this->administracion = new Administracion();
		// debo verificar si son cursos o preuniversitario para no controlar en esos casos el libredeuda
		$this->pe = Doctrine_Core::getTable('PlanesEstudios')->find($alumno->getIdplanestudio());
		$idtc= $this->pe->getCarreras()->getIdtipocarrera();
	
		if($idtc==2 || $idtc==6){
			$fechalibredeuda=$fechaactual;
		} else {
			$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($alumno->getIdalumno(),$alumno->getPersonas()->getNrodoc());
		}
		
		if(($fechalibredeuda >= $fechaactual) && !(is_array($fechalibredeuda))) {
			$this->estadolibredeuda = true;
		} else {
			$this->estadolibredeuda = false;
		}

		////////////////////////////////////////////////
		// CONTROL DOCUMENTACION		
		$this->documentacionhabilitada = false;
		if (in_array($alumno->getIdalumno(), array_keys($alumnosConDocumentacion))) {
			$this->documentacionhabilitada = true;
		}

		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(11,$y);
		$pdf->Cell(6,7,$contador,0,1,'C');
		$pdf->SetXY(17,$y);
		$pdf->Cell(18,7,$alumno->getLegajo(),0,1,'C');
		$pdf->SetXY(35,$y);
		$pdf->Cell(85,7,$alumno->getPersonas(),0,1,'L');
		if (!$this->estadolibredeuda) {
			$pdf->SetXY(120,$y);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(80,7,"Inhabilitado por Reglamento Nº7 - Art. 8",0,1,'C');
			$pdf->SetFont('Times','',9);
		} 
		/*****if (!$this->documentacionhabilitada) {
			$pdf->SetXY(120,$y);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(80,7,"Inhabilitado por Ordenanza CSU Nº3 - Art. 2",0,1,'C');
			$pdf->SetFont('Times','',9);
		}*/		
		
		$y = $y + 7;
		$pdf->Line(10,$y,200,$y);
		if($pdf->PageNo()>1){
			// Lineas verticales que marca las columnas de la planilla
			$pdf->Line(17,5,17,$y);
			$pdf->Line(35,5,35,$y);
			$pdf->Line(120,5,120,$y);
			if($tipo == "parcial") {
				$pdf->Line(175,5,175,$y);
			}	
		}
		// Pasos a seguir si tiene que continuar en otra pagina
		if ($y > 275){
			// Agrega el Pie al Documento
			$pdf->Pie($idsede,1);
			// Agrega el Esquema Grafico de la segunda pagina
			$pdf->EsquemaPlanillaGenerica2daHoja($bucles, $tipo);			
			// Reinicia el valor para la nueva página
			$y=9;
		}
		$contador++;
	}
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->Pie($idsede,1);
	// Guarda o envía el documento pdf
	$pdf->Output('planilla-generica.pdf','I');
	// Termina el documento
	$pdf->Close();    
  	// Para el proceso de symfony
 	throw new sfStopException(); 
  }
  
  public function executeImprimirplanillatp($request, $alumnos)
  {  
	// Asigna las distintas variables
	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter("idcomision"));
	$oCatedra = $oComision->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();	
	$oEstadoMateria = Doctrine_Core::getTable('EstadosMateria')->find(1);
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	$tipo = $request->getParameter("tipo");
	$bucles = 5;

	// Crea una instancia de la clase de PDF
	$pdf = new PlanillaTP('P','mm','Legal');

	// Toma las variables de la pagina anterior
	if ($tipo == "parcial"){
		// Asigna el titulo de la planilla
		$titulo= "PLANILLA DE EXAMEN PARCIAL";
	} else {
		// Asigna el titulo de la planilla
		$titulo= "INFORME DE CATEDRA";
	}	
	// Agrega la Cabecera al documento
	$pdf->CabeceraApaisada($oFacultad,$oCarrera,$titulo);
	// Agrega el esquema grafico de la planilla
	$pdf->EsquemaPlanillaTP1eraHoja($bucles);	
	$pdf->SetFont('Times','',9);
	$pdf->SetXY(6,41);
	$pdf->MultiCell(65,3, $oCatedra->getIdmateriaplan()." - ".$oCatedra->getMateriasPlanes(),0,'C',0);
	// Muestra el Curso, la Comisión y el Estado de los alumnos
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(6,50);
	$pdf->Cell(65,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(6,54);
	$pdf->Cell(65,5,"COMISIÓN: ".$oComision->getNombre(),0,1,'L');
	$pdf->SetXY(6,58);
	$pdf->Cell(65,5,"ALUMNOS: ". $oEstadoMateria,0,1,'L');	
	/////////////////////////////////////////////////////////////////////////
	// CUERPO PAGINA
	/////////////////////////////////////////////////////////////////////////		
	$total = count($alumnos);
	$y = 66;
	$contador = 1;
	foreach($alumnos as $alumno){
		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(6,$y);
		$pdf->Cell(6,7,$contador,0,1,'C');
		$pdf->SetXY(12,$y);
		$nombreAlumno = $alumno->getPersonas();
		if (strlen($nombreAlumno) <= 30) {
			$pdf->Cell(85,7,$nombreAlumno,0,1,'L');
		} elseif ((strlen($nombreAlumno) > 30) and (strlen($nombreAlumno) <= 38)) {
			$pdf->SetFont('Times','',8);
			$pdf->Cell(85,7,$nombreAlumno,0,1,'L');
			$pdf->SetFont('Times','',9);
		} else {
			$pdf->Cell(85,7,substr($nombreAlumno, 0, 32),0,1,'L');
			//$pdf->SetFont('Times','',8);
			//$pdf->MultiCell(85,7,$nombreAlumno,0,1,'L');
			//$pdf->SetFont('Times','',9);
		}
		$y = $y + 7;
		
		$pdf->Line(5,$y,350,$y);

		if($pdf->PageNo()>1){
			// Lineas verticales que marca las columnas de la planilla
			$pdf->Line(12,5,12,188);
			$pdf->Line(70,5,70,188);
			$pdf->Line(95,5,95,188);
			$pdf->Line(120,5,120,188);
			$pdf->Line(145,5,145,188);
			$pdf->Line(175,5,175,188);
			$pdf->Line(195,5,195,188);
			$pdf->Line(225,5,225,188);
			$pdf->Line(250,5,250,188);
		}
		// Pasos a seguir si tiene que continuar en otra pagina
		if ($y > 180) {
			// Agrega el Pie al Documento
			$pdf->PieApaisada($idsede);
			// Agrega el Esquema Grafico de la segunda pagina
			$pdf->EsquemaPlanillaTP2daHoja($bucles);			
			// Reinicia el valor para la nueva página
			$y=9;
		}
		$contador++;
	}
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->PieApaisada($idsede);
	// Guarda o envía el documento pdf
	$pdf->Output('planilla-asistencia.pdf','I');
	// Termina el documento
	$pdf->Close();
  	// Para el proceso de symfony
 	throw new sfStopException(); 
  }
  
  public function executeImprimirplanillaregularidades($request, $alumnos)
  {  
	// Asigna las distintas variables
	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter("idcomision"));
	$oCatedra = $oComision->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();	
	$oEstadoMateria = Doctrine_Core::getTable('EstadosMateria')->find(1);
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	$tipo = $request->getParameter("tipo");
	$bucles = 5;

	// Crea una instancia de la clase de PDF
	$pdf = new PlanillaTP('P','mm','Legal');

	// Toma las variables de la pagina anterior
	if ($tipo == "parcial"){
		// Asigna el titulo de la planilla
		$titulo= "PLANILLA DE REGULARIDADES";
	} else {
		// Asigna el titulo de la planilla
		$titulo= "INFORME DE CATEDRA";
	}	
	// Agrega la Cabecera al documento
	$pdf->CabeceraApaisada($oFacultad,$oCarrera,$titulo);
	// Agrega el esquema grafico de la planilla
	$pdf->EsquemaPlanillaRegularidades($bucles);	
	$pdf->SetFont('Times','',9);
	$pdf->SetXY(6,41);
	$pdf->MultiCell(65,3, $oCatedra->getIdmateriaplan()." - ".$oCatedra->getMateriasPlanes(),0,'C',0);
	// Muestra el Curso, la Comisión y el Estado de los alumnos
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(6,50);
	$pdf->Cell(65,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(6,54);
	$pdf->Cell(65,5,"COMISIÓN: ".$oComision->getNombre(),0,1,'L');
	$pdf->SetXY(6,58);
	$pdf->Cell(65,5,"ALUMNOS: ". $oEstadoMateria,0,1,'L');	
	/////////////////////////////////////////////////////////////////////////
	// CUERPO PAGINA
	/////////////////////////////////////////////////////////////////////////		
	$total = count($alumnos);
	$y = 66;
	$contador = 1;
	foreach($alumnos as $alumno){
		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(6,$y);
		$pdf->Cell(6,7,$contador,0,1,'C');
		$pdf->SetXY(12,$y);
		$nombreAlumno = $alumno->getPersonas();
		if (strlen($nombreAlumno) <= 30) {
			$pdf->Cell(85,7,$nombreAlumno,0,1,'L');
		} elseif ((strlen($nombreAlumno) > 30) and (strlen($nombreAlumno) <= 38)) {
			$pdf->SetFont('Times','',8);
			$pdf->Cell(85,7,$nombreAlumno,0,1,'L');
			$pdf->SetFont('Times','',9);
		} else {
			$pdf->Cell(85,7,substr($nombreAlumno, 0, 32),0,1,'L');
			//$pdf->SetFont('Times','',8);
			//$pdf->MultiCell(85,7,$nombreAlumno,0,1,'L');
			//$pdf->SetFont('Times','',9);
		}
		$y = $y + 7;
		
		$pdf->Line(5,$y,350,$y);

		if($pdf->PageNo()>1){
			// Lineas verticales que marca las columnas de la planilla
			$pdf->Line(12,5,12,188);
			$pdf->Line(70,5,70,188);
			$pdf->Line(95,5,95,188);
			$pdf->Line(120,5,120,188);
			$pdf->Line(145,5,145,188);
			$pdf->Line(175,5,175,188);
			$pdf->Line(195,5,195,188);
			$pdf->Line(225,5,225,188);
			$pdf->Line(250,5,250,188);
		}
		// Pasos a seguir si tiene que continuar en otra pagina
		if ($y > 180) {
			// Agrega el Pie al Documento
			$pdf->PieApaisada($idsede);
			// Agrega el Esquema Grafico de la segunda pagina
			$pdf->EsquemaPlanillaRegularidades2daHoja($bucles);			
			// Reinicia el valor para la nueva página
			$y=9;
		}
		$contador++;
	}
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->PieApaisada($idsede);
	// Guarda o envía el documento pdf
	$pdf->Output('planilla-asistencia.pdf','I');
	// Termina el documento
	$pdf->Close();
  	// Para el proceso de symfony
 	throw new sfStopException(); 
  }

  // Controla el formulario de Planilla de Examen Parcial
  public function executeVerificarplanillaparcial(sfWebRequest $request)
  {
  	$this->mensaje ="";
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	// Crea el formulario y asigna los valores por defecto
  	$this->form = new ImprimirPlanillaForm(array(
		'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
	));	
	$this->tipos = array(1 => 'Planilla de Examen Parcial común', 2 =>'Planilla de Examen Parcial con Firmas (Obligatorio)', 3 =>'Planilla de Examen Sin Parciales');
	$this->form->setWidget('tipo', new sfWidgetFormChoice(array('label' => '<p align="left">Tipo:</p>', 'choices'  => $this->tipos, 'expanded' => true, 'default' => 1)));
  	
  	if ($request->isMethod('post')) {
		// Busca todos los alumnos cursando esa materia
		$resultado = Doctrine_Core::getTable('AluMat')->getAlumnosCursando($request->getParameter("idcomision"));
	
  		if(count($resultado)>0) {
			switch ($request->getParameter("tipo")) {
		    	case 1:
		    		$this->executeImprimirplanillaexamenparcial($request, $resultado);
		    		break;
		    	case 2:
		    		$request->setParameter("tipo","parcial");
					$this->executeImprimirplanillagenerica($request, $resultado);
		        	break;
		    	case 3:
		    		$this->executeImprimirplanillaexamensinparcial($request, $resultado);	
		    		break;
			}		
  		}else{
  			$this->mensaje = "No hay inscriptos.";
  		}
	}
  }  
  
  public function executeImprimirplanillaexamenparcial($request, $alumnos)
  {
	// Asigna las distintas variables
	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter("idcomision"));
	$oCatedra = $oComision->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();	 	
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
	$bucles = 5;
	
	// Crea una instancia de la clase de PDF
	$pdf = new PlanillaParcial();
	// Asigna el titulo de la planilla
	$titulo= "PLANILLA DE EXAMEN PARCIAL";
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
	// Agrega el esquema grafico de la planilla
	$pdf->EsquemaPlanillaParcial1eraHoja($bucles);	
	$pdf->SetFont('Times','',9);
	$pdf->SetXY(11,41);
	$pdf->MultiCell(65,3, $oCatedra->getIdmateriaplan()." - ".$oCatedra->getMateriasPlanes(),0,'C',0);
	// Muestra el Curso y la Comisión
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(11,50);
	$pdf->Cell(65,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(11,54);
	$pdf->Cell(65,5,"COMISIÓN: ".$oComision->getNombre(),0,1,'L');
	$pdf->SetXY(11,58);
	$pdf->Cell(65,5,"HS. SEMANALES: ".$oCatedra->getMateriasPlanes()->getCargahorariasemanal(),0,1,'L');
	/////////////////////////////////////////////////////////////////////////
	// CUERPO PAGINA
	/////////////////////////////////////////////////////////////////////////		
	// Muestra la lista de Alumnos
	$total = count($alumnos);
	$y = 66;
	$contador = 1;
	// Valor de la altura de comienzo de página a partir de la segunda página
	$aux =5;
	foreach ($alumnos as $alumno) {
		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(11,$y);
		$pdf->Cell(7,7,$contador,0,1,'C');
		$pdf->SetXY(18,$y);
		$nombre = $alumno->getPersonas();
		if(strlen($nombre) < 30) {
			$pdf->Cell(62,7,$nombre,0,1,'L');
		}else{
			$pdf->Cell(62,7,substr($nombre,0, 29),0,1,'L');
		}	
		$y = $y + 7;
		$pdf->Line(10,$y,200,$y);
		
		if($pdf->PageNo()>1){
			// Asigna el ancho a la linea
			$pdf->SetLineWidth(0);
	
			// Linea vertical que separa el Nro de renglon y el Nombre
			$pdf->Line(17,$aux,17,$y);
			// Lineas verticales que marca las columnas de la planilla
			$pdf->Line(80,$aux,80,$y);
			$pdf->Line(100,$aux,100,$y);
			$pdf->Line(120,$aux,120,$y);
			$pdf->Line(140,$aux,140,$y);
			$pdf->Line(160,$aux,160,$y);
			$pdf->Line(180,$aux,180,$y);
		}
		// Pasos a seguir si tiene que continuar en otra pagina
		if ($y > 280){
			// Agrega el Pie al Documento
			$pdf->Pie($idsede,1);
			// Agrega el Esquema Grafico de la segunda pagina
			$pdf->EsquemaPlanillaParcial2daHoja($aux);	
			// Reinicia el valor para la nueva página
			$y=9;
		}
		$contador++;
	}
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->Pie($idsede,1);
	// Guarda o envía el documento pdf
	$pdf->Output('planilla-parcial.pdf','I');
	// Termina el documento
	$pdf->Close();
  	// Para el proceso de symfony
  	throw new sfStopException(); 
  }  
  
  public function executeImprimirplanillaexamensinparcial($request, $alumnos)
  {
	// Asigna las distintas variables
	$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter("idcomision"));
	$oCatedra = $oComision->getCatedras();
	$oMateriaPlan = $oCatedra->getMateriasPlanes();
	$oPlanEstudio = $oMateriaPlan->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();	 	
	$oEstadoMateria = Doctrine_Core::getTable('EstadosMateria')->find(1);
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
	$bucles = 5;
	
	// Crea una instancia de la clase de PDF
	$pdf = new PlanillaSinParcial();

	// Asigna el titulo de la planilla
	$titulo= "PLANILLA DE EXAMEN PARCIAL";
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
	// Agrega el esquema grafico de la planilla
	$pdf->EsquemaPlanillaSinParcial1eraHoja($bucles);
	$pdf->SetFont('Times','',9);
	$pdf->SetXY(11,41);
	$pdf->MultiCell(65,3, $oCatedra->getIdmateriaplan()." - ".$oCatedra->getMateriasPlanes(),0,'C',0);
	// Muestra el Curso y la Comisión
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(11,50);
	$pdf->Cell(65,5,"CURSO: ".$oMateriaPlan->getAnodecursada(),0,1,'L');
	$pdf->SetXY(11,54);
	$pdf->Cell(65,5,"COMISIÓN: ".$oComision->getNombre(),0,1,'L');
	$pdf->SetXY(11,58);
	$pdf->Cell(65,5,"HS. SEMANALES: ".$oCatedra->getMateriasPlanes()->getCargahorariasemanal(),0,1,'L');
	/////////////////////////////////////////////////////////////////////////
	// CUERPO PAGINA
	/////////////////////////////////////////////////////////////////////////		
	// Muestra la lista de Alumnos
	$total = count($alumnos);
	$y = 66;
	$contador = 1;
	// Valor de la altura de comienzo de página a partir de la segunda página
	$aux =5;
	foreach($alumnos as $alumno) {
		$pdf->SetLineWidth(0);
		$pdf->SetFont('Times','',9);
		$pdf->SetXY(11,$y);
		$pdf->Cell(7,7,$contador,0,1,'C');
		$pdf->SetXY(18,$y);
		$nombre = $alumno->getPersonas();
		if(strlen($nombre) < 30) {
			$pdf->Cell(62,7,$nombre,0,1,'L');
		}else{
			$pdf->Cell(62,7,substr($nombre,0, 29),0,1,'L');
		}	
		$y = $y + 7;
		$pdf->Line(10,$y,200,$y);
		
		if($pdf->PageNo()>1){
			// Asigna el ancho a la linea
			$pdf->SetLineWidth(0);
	
			// Linea vertical que separa el Nro de renglon y el Nombre
			$pdf->Line(17,$aux,17,$y);
			// Lineas verticales que marca las columnas de la planilla
			$pdf->Line(160,$aux,160,$y);
			$pdf->Line(180,$aux,180,$y);
		}
		// Pasos a seguir si tiene que continuar en otra pagina
		if ($y > 280){
			// Agrega el Pie al Documento
			$pdf->Pie($idsede,1);
			// Agrega el Esquema Grafico de la segunda pagina
			$pdf->EsquemaPlanillaSinParcial2daHoja($aux);				
			// Reinicia el valor para la nueva página
			$y=9;
		}
		$contador++;
	}
	/////////////////////////////////////////////////////////////////////////
	// PIE PAGINA
	/////////////////////////////////////////////////////////////////////////
	// Agrega el Pie al Documento
	$pdf->Pie($idsede,1);
	// Guarda o envía el documento pdf
	$pdf->Output('planilla-examen-parcial.pdf','I');
	// Termina el documento
	$pdf->Close();
  	// Para el proceso de symfony
  	throw new sfStopException(); 
  }  
}
