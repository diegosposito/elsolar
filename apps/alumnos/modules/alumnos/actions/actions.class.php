<?php

/**
 * alumnos actions.
 *
 * @package    sig
 * @subpackage alumnos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alumnosActions extends sfActions
{
  public function executeConstanciageneral(sfWebRequest $request) {
  }
	
  public function executeConfeccionconstanciageneral(sfWebRequest $request) {
  	// Busca la persona
  	$this->idpersona = $request->getParameter('idpersona');
  	$this->persona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
  	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	$this->facultad = $this->alumno->getPlanesEstudios()->getCarreras()->getFacultades();
  
  	$this->datosanalitico = $this->alumno->obtenerDatosAnalitico();
  	$this->fechaF = $this->fechaFormateada($this->persona['fechanac']);
  	$this->idp = $this->idpersona;
  }
  
  public function executeObtenernotas(sfWebRequest $request) {
	$this->analitico = "";
	$this->materias = array();
	$this->extracurriculares = array();	
  	// Busca la persona
	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	
	$this->analitico = $this->alumno->obtenerAnalitico($request->getParameter('tipo'));
	foreach($this->analitico as $materia) {
		if($materia['idtipomateria']==5) {
			$this->extracurriculares[$materia['idme']] = $materia;
		} else {
			$this->materias[$materia['idme']] = $materia;
		}
	}	
  }
  	
  public function executeSolicitarlibredeuda(sfWebRequest $request) {	
  	// Obtener la fecha actual
  	$hoy = date('Y-m-d');
  	 
  	// Busca el alumno
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	$carrera = $oAlumno->getPlanesEstudios()->getCarreras();
	
  	if ($request->getParameter('tipo')==1) {
  		$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('id'));
  		$tipo = 'INSCRIPCION PARA CURSAR';
  		$texto = $oMateriaPlan->getIdmateriaplan().'- '.$oMateriaPlan;
  		$otro = '';
  	} elseif ($request->getParameter('tipo')==3) {
  		$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('id'));
  		$tipo = 'INSCRIPCION PARA PROMOCIONAR';
  		$texto = $oMateriaPlan->getIdmateriaplan().'- '.$oMateriaPlan;
  		$otro = '';
   	} else {
  		$oMesaExamen = Doctrine_Core::getTable('MesasExamenes')->find($request->getParameter('id'));
  		$tipo = 'INSCRIPCION PARA RENDIR';
  		$texto = $oMesaExamen->getIdmesaexamen().'- '.$oMesaExamen->getCatedras()->getMateriasPlanes();
  		$otro = 'Tipo: '.$oMesaExamen->getCondicionesMesas().' - Fecha: '.$oMesaExamen->getFecha().' - '.$oMesaExamen->getHora();
  	}
  	$usuariosDestino = Doctrine_Core::getTable('EmpleadosSede')->obtenerUsuarios($oAlumno->getIdsede(), 6);
  	$destinatario = array_values($usuariosDestino);

	// Remitente
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();  	

	$msj = '
Se solicita libre deuda sobre el estado del alumno '.$oAlumno->getPersonas().', '.$oAlumno->getPersonas()->getTiposDocumentos().': '.$oAlumno->getPersonas()->getNrodoc().', de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'.
IdAlumno: '.$oAlumno->getIdalumno().'
Operacion: '.$tipo.'
Carrera: '.$carrera.'		
Materia: '.$texto.'
E-mail: '.$remitente.'	
'.$otro;

	
 	$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';

$resultado = $this->getMailer()->composeAndSend(
  $remitente,
  $destinatario,
  'Solicitud de Libre Deuda: '.$oAlumno->getPersonas().' - '.$carrera,
  $mensajeEmail
);

	foreach ($usuariosDestino as $k=>$v) {
		if ($k!=0) {
			$oSolicitudLibredeuda = new SolicitudesLibredeuda();
			$oSolicitudLibredeuda->setIdusuarioorigen($this->getUser()->getGuardUser()->getId());
			$oSolicitudLibredeuda->setIdusuariodestino($k);
			$oSolicitudLibredeuda->setIdalumno($oAlumno->getIdalumno());
			$oSolicitudLibredeuda->setIdestadosolicitud(1);
			$oSolicitudLibredeuda->setMensaje($msj);
			$oSolicitudLibredeuda->setFecha($hoy);
			$oSolicitudLibredeuda->save();
		}
	}
 	 
	if ($resultado) {
		echo "Se ha enviado correctamente la Solicitud de libre deuda.";
	} else {
		echo "No se ha podido enviar la Solicitud de libre deuda.\nCompruebe que las cuenta de correo remitente o destinataria funcionen correctamente."."REMITENTE: ".$remitente."- DESTINATARIO:".$destinatario;
	}
    
	return sfView::NONE;
  }
  
  public function executeSolicitarlibredeudamultiple(sfWebRequest $request) {
  	// Busca el alumno
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));  	
 
	$materias_seleccionadas = $request->getParameter('case');
	$comisiones_seleccionadas = $request->getParameter('comisiones');
	$texto = '';
	$tipo = 'Operacion: INSCRIPCION PARA CURSAR';
	$otro = '';
  		
  	if(count($materias_seleccionadas) > 0) {
  		foreach ($materias_seleccionadas as $materiaplan) {
  			$idcomision = $comisiones_seleccionadas[$materiaplan];
  			$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($materiaplan);
  				
  			$texto .= 'Materia: '.$oMateriaPlan->getIdmateriaplan().'- '.$oMateriaPlan.'<br>';
  		}
  				
  		$usuariosDestino = Doctrine_Core::getTable('EmpleadosSede')->obtenerUsuarios($oAlumno->getIdsede(), 6);
  		$destinatario = array_values($usuariosDestino);

	  	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
	  	$mensaje = '
	  	**************************************************************************************<br>
	  	*******************************NO RESPONDER A ESTE MESNAJE****************************<br>
	  
	  	Se solicita libre deuda sobre el estado del alumno '.$oAlumno->getPersonas()->getNombre().' '.$oAlumno->getPersonas()->getApellido().', '.$oAlumno->getPersonas()->getTiposDocumentos().': '.$oAlumno->getPersonas()->getNrodoc().', de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'.<br>
	  	IdAlumno: '.$oAlumno->getIdalumno().'- Sede: '.$oAlumno->getIdsede().'<br>
	  	'.$tipo.'<br>
	  	'.$texto.'<br>
	  	'.$otro.'<br>
	  	**************************************************************************************<br>
	  	**************************************************************************************';
	  	
	  	$message = $this->getMailer()->compose
	  	(
	  			$remitente,
	  			$destinatario,
	  			'Solicitud de Libre Deuda: '. $oAlumno->getPersonas(),
	  			'<html>'.$mensaje.'</html>'
	  	)
	  	->setContentType('text/html')
	  	->addPart($mensaje, 'text/plain');
	  	
	  	$resultado = $this->getMailer()->send($message);
	  	  	
	  	foreach ($usuariosDestino as $k=>$v) {
		  	$oSolicitudLibredeuda = new SolicitudesLibredeuda();
		  	$oSolicitudLibredeuda->setIdusuarioorigen($this->getUser()->getGuardUser()->getId());
		  	$oSolicitudLibredeuda->setIdusuariodestino($k);
		  	$oSolicitudLibredeuda->setIdalumno($oAlumno->getIdalumno());
		  	$oSolicitudLibredeuda->setIdestadosolicitud(1);
		  	$oSolicitudLibredeuda->setMensaje($msj);
		  	$oSolicitudLibredeuda->save();	  	
	  	}
	  	if ($resultado) {
	  		echo "Se ha enviado correctamente la Solicitud de libre deuda.";
	  	} else {
	  		echo "No se ha podido enviar la Solicitud de libre deuda.\nCompruebe que las cuenta de correo remitente o destinataria funcionen correctamente.";
	  	}
	} else {
		echo "No se ha seleccionado ninguna materia.\n";
	}   
  	return sfView::NONE;
  }  

  public function executeImprimiranaliticoparcial(sfWebRequest $request) {
	
	setlocale(LC_ALL,"es_ES");
  	// Asigna las distintas variables
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	$fecha = strftime("%A %d de %B de %Y");
 
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
  	$oPersona = $oAlumno->getPersonas();
	$oPlanEstudio = $oAlumno->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();
  	$oSede = Doctrine_Core::getTable('Sedes')->find($idsede);
  	
  	// Crea una instancia de la clase de FPDF
	$pdf = new PDF();
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);	
	// Asigna el titulo de la planilla
	if($request->getParameter('tipo')>1){
		$titulo = "CERTIFICADO ANALITICO";
	} else {
		$titulo = "CERTIFICADO ANALITICO PARCIAL";	
	}
	// Configura el auto-salto de pagina
	$pdf->SetAutoPageBreak(1 , 10);
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, "", $titulo);	
	$pdf->SetFont('Times','',10);
	$pdf->SetX(35);
	// Define un alias para el número de páginas del documento pdf
	$pdf->AliasNbPages();
	$pdf->SetXY(10,37);
	$pdf->MultiCell(190, 0, $request->getParameter('encabezado'), '', 'J');
	$inicioy = $pdf->GetY();

	// ***************** CUERPO *****************
	// Asigna el ancho a las lineas verticales
	$pdf->SetLineWidth(0);
	// Linea horizontal que separa las Fechas
	$pdf->Line(10,$inicioy,200,$inicioy);
	// Asigna el ancho a la linea
	//$pdf->SetLineWidth(1);
	// Linea horizontal que separa las Fechas y la cabecera del listado
	$pdf->Line(10,$inicioy+5,200,$inicioy+5);

	// Muestra la cabecera de la lista
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(10,$inicioy);
	$pdf->Cell(16,5,"Fecha",0,1,'C');
	$pdf->SetXY(26,$inicioy);
	$pdf->Cell(108,5,'Asignatura',0,1,'C');
	$pdf->SetXY(134,$inicioy);
	$pdf->Cell(39,5,"Calificación",0,1,'C');
	$pdf->SetXY(173,$inicioy);
	$pdf->Cell(17,5,"Libro",0,1,'C');
	$pdf->SetXY(190,$inicioy);
	$pdf->Cell(10,5,"Folio",0,1,'C');

	//obtengo detalles de materias de analitico
	$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));

	$analitico = $alumno->obtenerAnalitico($request->getParameter('tipo'));
	$extracurriculares = array();
	$materias = array();
	// Agrupar las materias extracurriculares
	foreach($analitico as $materia) {
		if($materia['idtipomateria']==5) {
			$extracurriculares[$materia['idme']] = $materia;
		} else {
			$materias[$materia['idme']] = $materia;
		}
	}
	$materias_seleccionadas = $request->getParameter('case');
	$arrYears = array (1 => "Primer año", 2 => "Segundo año", 3 => "Tercer año", 4 => "Cuarto año",  5 => "Quinto año", 6 => "Sexto año");

	$y = $pdf->GetY();
	$anioactual = 0;
	$i=0;
	$sumatoria = 0;
	$canti = 0;
	$cantiextra = 0;
	$cantiequi = 0;
     
    foreach($materias as $analit){ 
		if ($request->getParameter('cantmaterias') == $i) {
			// Agrega el Pie al documento
			$pdf->Pie($alumno->getIdsede(),1);
			$pdf->SetFont('Times','',10);		
			// Agrega la Cabecera al documento
			$pdf->Cabecera($oFacultad, $oCarrera, $titulo);	
			$i=0;
			$y = 7;
		} 

    	if (in_array($analit['idme'], $materias_seleccionadas)) {
    	    if ($anioactual != $analit['anodecursada']) { 
				$anioactual = $analit['anodecursada']; 
	    	
				$pdf->SetXY(15,$y);
				$pdf->Cell(16,1,$arrYears[$anioactual],0,1,'L');	
				// Asigna el ancho a la linea
				$pdf->SetLineWidth(1);			   
				// Linea horizontal que separa las Fechas
				$pdf->Line(10,$y,200,$y);
				// Linea horizontal que separa las Fechas y la cabecera del listado
				$pdf->Line(10,$y+5,200,$y+5);			
				$y=$y+5; 	
    		}    		
			$pdf->SetXY(10,$y);
			$arr = explode('-', $analit['fecha']);
			$fecha = $arr[2]."-".$arr[1]."-".$arr[0];			
			$pdf->Cell(16,1,$fecha,0,1,'C');
			if(strlen($analit['nombre'])>80) {    
				$pdf->SetXY(26,$y);
				$pdf->MultiCell(108, 0, $analit['nombre'], '', 'L');
				$yy = 5;
        	} else{
				$pdf->SetXY(26,$y);
				$pdf->Cell(108,1,$analit['nombre'],0,1,'L');
				$yy = 0;      		
        	}  			
			$pdf->SetXY(134,$y);
			
			if ($analit['nota']==null or $analit['nota']=="") {
				if ($analit['calif']==null or $analit['calif']=="") {

					if($analit['idtipoexamen']==4){
					    if($analit['folio']==0){
						$timestamp = strtotime($analit['fecha']);
						$nota = 'Equivalencia';
						} else {
						$timestamp = strtotime($analit['fecha']);
						$arreglo = explode("/", $analit['folio']);
						if(count($arreglo)==3){
							$nota = 'Aprobada por Res. C.S.U del '.$analit['folio'];
						} else {
							$nota = 'Aprobada por Res. C.S.U Nro. '.$analit['folio'];
						}
						}
					} else {
						$nota = $analit['idtipoexamen']."-";
					}

				} else {
					$nota = number_format(str_replace(",",".",$analit['calif']),2, ",", "");
					$nota = $this->getCalificacionLetras($nota);
				}
			} else {
				if($analit['nota']=="U" ){ 
					$canti=$canti-1;
					$nota = "(Ausente)";
				} else { 
					$nota = number_format(str_replace(",",".",$analit['nota']),2, ",", "");
					$nota = $nota." (".$this->getCalificacionLetras($nota).")";
				}
			}
			if(strlen($nota)>22) {
				$pdf->SetXY(130,$y+1);
				$pdf->SetFont('Times','',7);
				$pdf->Cell(43,0,$nota,0,0,'C');
				$pdf->SetFont('Times','',10);
			} else {
				$pdf->SetFont('Times','',10);
				$pdf->Cell(39,0,$nota,0,1,'C');
			}
			
			$pdf->SetXY(173,$y);
			
			if($analit['idtipoexamen']<>4){
			$pdf->Cell(17,0,($analit['libro']==null or $analit['libro']=="")?$analit['libroacta']:$analit['libro'],0,1,'C');
			}
			$pdf->SetXY(190,$y);
			if($analit['folio']>0 and $analit['idtipoexamen']<>4) $pdf->Cell(10,0,"".$analit['folio'],0,1,'C');
			$y=$y+5+$yy;
			$i++;
			
			if ($analit['calif']!="" || $analit['calif']!=0 ) {
				$valor=str_replace(",",".",$analit['calif']);
				if($analit['idtipomateria']!=5){
					$sumatoria+=$valor; 
					$canti++;				
				}
			} else {
				$cantiequi++;
			}   			
	    }
	}
	///////////////////////////////
	// Materias Extracurriculares
	///////////////////////////////
	$extracurricularesSeleccionadas =0;
	if(count($extracurriculares) > 0) {
		foreach($extracurriculares as $extra) {
			if (in_array($extra['idmp'], $materias_seleccionadas)) {
				$cantiextra++;
				if ($extracurricularesSeleccionadas==0){
					// Agrega el Pie al documento
					$pdf->Pie($alumno->getIdsede(),1);
					$pdf->SetFont('Times','',10);
					//$pdf->AddPage();
					// Agrega la Cabecera al documento
					$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
	
					$y = 5;
					// Se agrega el texto para las extracurriculares
					$pdf->Ln();
					$pdf->MultiCell(190, 0, $request->getParameter('textoextracurriculares'), '', 'J');
						
					$inicioy = $pdf->GetY();
					// ***************** CUERPO *****************
					// Asigna el ancho a las lineas verticales
					$pdf->SetLineWidth(0);
						
					$y = $pdf->GetY();
					$extracurricularesSeleccionadas=1;
				}
				$pdf->SetXY(10,$y);
				$arr = explode('-', $extra['fecha']);
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
				$pdf->Cell(16,1,$fecha,0,1,'C');

				if(strlen($extra['nombre'])>80) {
					$pdf->SetXY(31,$y);
					$pdf->MultiCell(105, 0, $extra['nombre'], '', 'L');
					$yy = 5;
				} else{
					$pdf->SetXY(31,$y);
					$pdf->Cell(100,1,$extra['nombre'],0,1,'L');
					$yy = 0;
				}
	
				$pdf->SetXY(134,$y);
					
				if ($extra['nota']==null or $extra['nota']=="") {
					
					if ($extra['calif']==null or $extra['calif']=="") {
						if($extra['idtipoexamen']==4){
							if($extra['folio']==0){
								$timestamp = strtotime($extra['fecha']);
								$nota = 'Equivalencia';
							} else {
								$timestamp = strtotime($extra['fecha']);
								$nota = 'Aprobada por Res. C.S.U Nro. '.$extra['folio'];
							}
						} else {
							$nota = $extra['calificacion'];
						}
					} else {
						$nota = number_format(str_replace(",",".",$extra['calif']),2, ",", "");
						$nota = $this->getCalificacionLetras($nota);
					}
									
				} else {
					if(!is_numeric($extra['nota'])) {
						$notatemp = $extra['nota'];
						$nota = $notatemp." (".$this->getCalificacionLetras($notatemp).")";
					} else {
						$notatemp = number_format(str_replace(",",".",$extra['nota']),2, ",", "");
						$nota = $notatemp." (".$this->getCalificacionLetras($notatemp).")";
					}
				}
				if(strlen($nota)>22) {
					$pdf->SetXY(130,$y+1);
					$pdf->SetFont('Times','',7);
					$pdf->Cell(43,0,$nota,0,0,'C');
					$pdf->SetFont('Times','',10);
				} else {
					$pdf->SetFont('Times','',10);
					$pdf->Cell(39,0,$nota,0,1,'C');
				}
				$pdf->SetXY(173,$y);
				if($extra['idtipoexamen']<>4){
					$pdf->Cell(17,0,($extra['libro']==null or $extra['libro']=="")?$extra['libroacta']:$extra['libro'],0,1,'C');
				}				
				$pdf->SetXY(190,$y);
				if($extra['folio']>0 and $extra['idtipoexamen']<>4) $pdf->Cell(10,0,"".$extra['folio'],0,1,'C');
				//$pdf->Line(10,$y,205,$y);
				$y= $y + 5 + $yy;
				$i++;
			}
		}
	}
	///////////////////////////////
		
	// Muestra el promedio
	$promedio = ($canti!=0)?number_format($sumatoria/$canti, 2):"0";
	$pdf->SetXY(170, $y);
	$pdf->Rect(170, $pdf->GetY(), 30, 5);
	$pdf->Cell(30,5,'Promedio: '.$promedio,0,1,'L');
	// Muestra la cantidad de materias
	$pdf->SetX(170);
	$pdf->Rect(170, $pdf->GetY(), 30, 5);
	$pdf->Cell(30,5,'Cantidad: '.$canti,0,1,'L');
	// Muestra la cantidad de materias
	$pdf->SetX(170);
	$pdf->Rect(170, $pdf->GetY(), 30, 5);
	$pdf->Cell(30,5,'Extracurriculares: '.$cantiextra,0,1,'L');
	// Muestra la cantidad de materias
	$pdf->SetX(170);
	$pdf->Rect(170, $pdf->GetY(), 30, 5);
	$pdf->Cell(30,5,'Equivalencias: '.$cantiequi,0,1,'L');
		
	// Se agregan las observaciones
	$pdf->Ln();
	$pdf->SetX(10);
	$pdf->MultiCell(190, 0, "OBSERVACIONES: ".$request->getParameter('observaciones'), '', 'J');

	// Se agrega el primer pie de pagina
	$pdf->Ln();
	$pdf->SetX(10);	
	$pdf->MultiCell(190, 0, $request->getParameter('textopie'), '', 'J');	

	// Agrega el Pie al documento
	$pdf->Pie($alumno->getIdsede(),1);	
	$pdf->Output('analitico.pdf', 'I');
 
	// stop symfony process
	throw new sfStopException();
  	
   	return sfView::NONE;    		         
	}
	
  public function executeImprimiranaliticofinal(sfWebRequest $request) {

    $ruta="/var/www/svnacademico/web/analiticos/";

	if($request->getParameter('accion_boton')=='guardar'){
		// Guardar el encabezado
		$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
		// Si se solicita guardar se guarda y se muestra los el pd
		$fp=fopen($ruta.$alumno->getIdalumno()."_encabezado.txt","w+");
		fwrite($fp,$request->getParameter('encabezado'));
		fclose ($fp);

		// Guardar las observaciones
	    $fp1=fopen($ruta.$alumno->getIdalumno()."_observaciones.txt","w+");
	    fwrite($fp1,$request->getParameter('observaciones'));
	    fclose ($fp1);
	} 

	if($request->getParameter('accion_boton')=='borrar'){
		// Obtener el id de alumno
		$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
		// Elimino archivo de encabezado
		if (file_exists($ruta.$alumno->getIdalumno()."_encabezado.txt")) unlink($ruta.$alumno->getIdalumno()."_encabezado.txt"); 

		// Elimino archivo de observaciones
		if (file_exists($ruta.$alumno->getIdalumno()."_observaciones.txt")) unlink($ruta.$alumno->getIdalumno()."_observaciones.txt"); 
	} 

	setlocale(LC_ALL,"es_ES");
  	// Asigna las distintas variables
	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	$fecha = strftime("%A %d de %B de %Y");
 
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
  	$oPersona = $oAlumno->getPersonas();
	$oPlanEstudio = $oAlumno->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
	$oFacultad = $oCarrera->getFacultades();
  	$oSede = Doctrine_Core::getTable('Sedes')->find($idsede);
  	
  	// Crea una instancia de la clase de FPDF
	$pdf = new PDF();
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	// Asigna el titulo de la planilla
	$titulo = "CERTIFICADO ANALITICO FINAL";
	// Configura el auto-salto de pagina
	$pdf->SetAutoPageBreak(1 , 10);
	// Agrega la Cabecera al documento
	//$pdf->CabeceraOficio($oFacultad, $oCarrera, $titulo);	
	$pdf->CabeceraOficio($oFacultad, "", $titulo);	
	$pdf->SetFont('Times','',10);
	$pdf->SetX(35);
	// Define un alias para el número de páginas del documento pdf
	$pdf->AliasNbPages();
	$pdf->SetXY(10,37);
	$pdf->MultiCell(195, 0, $request->getParameter('encabezado'), '', 'J');
	$inicioy = $pdf->GetY();
	// ***************** CUERPO *****************
	// Asigna el ancho a las lineas verticales
	$pdf->SetLineWidth(0);
	// Linea horizontal que separa las Fechas
	$pdf->Line(10,$inicioy,205,$inicioy);
	// Asigna el ancho a la linea
	//$pdf->SetLineWidth(1);
	// Linea horizontal que separa las Fechas y la cabecera del listado
	$pdf->Line(10,$inicioy+5,205,$inicioy+5);

	// Muestra la cabecera de la lista
	$pdf->SetFont('Times','',10);
	$pdf->SetXY(10,$inicioy);
	$pdf->Cell(16,5,"Fecha",0,1,'C');
	$pdf->SetXY(31,$inicioy);
	$pdf->Cell(112,5,'Asignatura',0,1,'C');
	$pdf->SetXY(143,$inicioy);
	$pdf->Cell(35,5,"Calificación",0,1,'C');
	$pdf->SetXY(178,$inicioy);
	$pdf->Cell(17,5,"Libro",0,1,'C');
	$pdf->SetXY(195,$inicioy);
	$pdf->Cell(10,5,"Folio",0,1,'C');

	//Obtengo detalles de materias de analitico
	$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));

	// ***************** GUARDO ENCABEZADO *****************
	$analitico = $alumno->obtenerAnalitico();
	$extracurriculares = array();
	$materias = array();
	// Agrupar las materias extracurriculares
  	foreach($analitico as $materia) {
		if($materia['idtipomateria']==5) {
			$extracurriculares[$materia['idmp']] = $materia;
		} else {
			$materias[$materia['idmp']] = $materia;
		}
	}
	$materias_seleccionadas = $request->getParameter('case');
	$materias_con_observaciones = $request->getParameter('obs');
	$arrYears = array (1 => "Primer año", 2 => "Segundo año", 3 => "Tercer año", 4 => "Cuarto año",  5 => "Quinto año", 6 => "Sexto año");

	$y = $pdf->GetY();
	$anioactual = 0;
	$i=1;
    foreach($materias as $analit) { 		    	
    	if (in_array($analit['idmp'], $materias_seleccionadas)) {
    	    if ($anioactual != $analit['anodecursada']) { 
				$anioactual = $analit['anodecursada']; 
	    	
				$pdf->SetXY(15,$y);
				$pdf->Cell(16,1,$arrYears[$anioactual],0,1,'L');	
				// Asigna el ancho a la linea
				$pdf->SetLineWidth(1);			   
				// Linea horizontal que separa las Fechas
				$pdf->Line(10,$y,205,$y);
				// Linea horizontal que separa las Fechas y la cabecera del listado
				$pdf->Line(10,$y+5,205,$y+5);			
				$y=$y+5; 	
    		}    		
			$pdf->SetXY(11,$y);
			$arr = explode('-', $analit['fecha']);
			$fecha = $arr[2]."-".$arr[1]."-".$arr[0];			
			$pdf->Cell(22,1,$fecha,0,1,'C');
			if ($materias_con_observaciones[$analit['idmp']]) {
				$nombre = $analit['nombre']." (".$materias_con_observaciones[$analit['idmp']].")";
			} else {
				$nombre = $analit['nombre'];
			}
			
			if(strlen($nombre)>80) {                                                                                                                     
				$pdf->SetXY(31,$y);
				$pdf->MultiCell(112, 0, $nombre, '', 'L');
				$yy = 5;
        	} else{
				$pdf->SetXY(31,$y);
				$pdf->Cell(112,1,$nombre,0,1,'L');
				$yy = 0;
        	}   
        
			$pdf->SetXY(143,$y);
			
			if ($analit['nota']==null || $analit['nota']=="" || substr($analit['nota'],0,1)=="A") {
				if ($analit['calif']==null or $analit['calif']=="") {
					if($analit['idtipoexamen']==4){
					    if($analit['folio']==0){
						$timestamp = strtotime($analit['fecha']);
						$nota = 'Equivalencia';
						} else {
						$timestamp = strtotime($analit['fecha']);
						$arreglo = explode("/", $analit['folio']);
						if(count($arreglo)==3){
							$nota = 'Aprobada por Res. C.S.U del '.$analit['folio'];
						} else {
							$nota = 'Aprobada por Res. C.S.U Nro. '.$analit['folio'];
						}
						}
					} else {
						$nota = $analit['idtipoexamen']."-";
					}
				} else {
					$nota = $analit['calif'];
					$nota = $this->getCalificacionLetras($nota);
				}
			} else {
			 		$notatemp = number_format(str_replace(",",".",$analit['nota']),2, ",", "");
					$nota = $notatemp." (".$this->getCalificacionLetras($notatemp).")";
			}
    		if(strlen($nota)>22) {
				$pdf->SetXY(138,$y+1);
				$pdf->SetFont('Times','',7);
				$pdf->Cell(40,0,$nota,0,0,'C');
				$pdf->SetFont('Times','',10);
			} else {
				$pdf->SetFont('Times','',10);
				$pdf->Cell(35,0,$nota,0,0,'C');
			}

			$pdf->SetXY(178,$y);
		    if($analit['libro']!='Equivalencia'){
			$pdf->Cell(17,0,($analit['libro']==null or $analit['libro']=="")?$analit['libroacta']:$analit['libro'],0,1,'C');
			}
			$pdf->SetXY(195,$y);
			if($analit['folio']>0 and $analit['libro']!='Equivalencia') $pdf->Cell(10,0,"".$analit['folio'],0,1,'C');
			$pdf->Line(10,$y,205,$y);
			$y= $y + 5 + $yy;
			
			if ($request->getParameter('cantmaterias') == $i) {
				// Agrega linea transversal
				if (($y < 340) and (10 < 340 - $y)) {
					// Linea transversal
					$pdf->Line(10,340,205,$y);
				}
				// Agrega el Pie al documento
				$pdf->PieOficio(1);
				$pdf->SetFont('Times','',10);
				// Agrega la Cabecera al documento
				$pdf->CabeceraOficio($oFacultad, $oCarrera, $titulo);
				$i=1;
				$y = 5;
			}			
			$i++;		
	    }
	}
	$pdf->Line(10,$y,205,$y);
	///////////////////////////////
	// Materias Extracurriculares
	///////////////////////////////	
	$extracurricularesSeleccionadas =0;	
	if(count($extracurriculares) > 0) {
		foreach($extracurriculares as $extra) {	
			if (in_array($extra['idmp'], $materias_seleccionadas)) {
				if ($extracurricularesSeleccionadas==0){
					if ($i>25) {
						// Agrega el Pie al documento
						$pdf->PieOficio(1);
						$pdf->SetFont('Times','',10);
						// Agrega la Cabecera al documento
						$pdf->CabeceraOficio($oFacultad, $oCarrera, $titulo);						

						$y = 5;
					}

					// Se agrega el texto para las extracurriculares
					$pdf->Ln();
					$pdf->MultiCell(195, 0, $request->getParameter('textoextracurriculares'), '', 'J');
					
					$inicioy = $pdf->GetY();
					// ***************** CUERPO *****************
					// Asigna el ancho a las lineas verticales
					$pdf->SetLineWidth(0);
					// Linea horizontal que separa las Fechas
					$pdf->Line(10,$inicioy,205,$inicioy);
					// Asigna el ancho a la linea
					//$pdf->SetLineWidth(1);
					// Linea horizontal que separa las Fechas y la cabecera del listado
					$pdf->Line(10,$inicioy+5,205,$inicioy+5);
					
					$y = $pdf->GetY();	
					$extracurricularesSeleccionadas=1;
				}
				$pdf->SetXY(11,$y);
				$arr = explode('-', $extra['fecha']);
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
				$pdf->Cell(22,1,$fecha,0,1,'C');
				if ($materias_con_observaciones[$extra['idmp']]) {
					$nombre = $extra['nombre']." (".$materias_con_observaciones[$extra['idmp']].")";
				} else {
					$nombre = $extra['nombre'];
				}
					
				if(strlen($nombre)>80) {
					$pdf->SetXY(31,$y);
					$pdf->MultiCell(115, 0, $nombre, '', 'L');
					$yy = 5;
				} else{
					$pdf->SetXY(31,$y);
					$pdf->Cell(100,1,$nombre,0,1,'L');
					$yy = 0;
				}
		
				$pdf->SetXY(139,$y);
					
				if ($extra['nota']==null or $extra['nota']=="") {
					if ($extra['calif']==null or $extra['calif']=="") {
						if($extra['idtipoexamen']==4){
							if($extra['folio']==0){
								$timestamp = strtotime($extra['fecha']);
								$nota = 'Equivalencia';
							} else {
								$timestamp = strtotime($extra['fecha']);
								$arreglo = explode("/", $extra['folio']);
								if(count($arreglo)==3){
									$nota = 'Aprobada por Res. C.S.U del '.$extra['folio'];
								} else {
									$nota = 'Aprobada por Res. C.S.U Nro. '.$extra['folio'];
								}
							}
						} else {
							$nota = $extra['calificacion'];
						}
					} else {
						$nota = $extra['calif'];
						$nota = $this->getCalificacionLetras($nota);
					}					

				} else {
					if(!is_numeric($extra['nota'])) {
						$notatemp = $extra['nota'];
						$nota = $notatemp." (".$this->getCalificacionLetras($notatemp).")";
					} else {
				 		$notatemp = number_format(str_replace(",",".",$extra['nota']),2, ",", "");
						$nota = $notatemp." (".$this->getCalificacionLetras($notatemp).")";
					}
				}
				
				if(strlen($nota)>22) {
					$pdf->SetXY(138,$y+1);
					$pdf->SetFont('Times','',7);
					$pdf->Cell(40,0,$nota,0,0,'C');
					$pdf->SetFont('Times','',10);
				} else {
					$pdf->SetFont('Times','',10);
					$pdf->Cell(35,0,$nota,0,0,'C');
				}
								
				$pdf->SetXY(178,$y);
				if($extra['idtipoexamen']<>4){
					$pdf->Cell(17,0,($extra['libro']==null or $extra['libro']=="")?$extra['libroacta']:$extra['libro'],0,1,'C');
				}
				$pdf->SetXY(195,$y);
				if($extra['folio']>0 and $extra['idtipoexamen']<>4) $pdf->Cell(10,0,"".$extra['folio'],0,1,'C');
				$pdf->Line(10,$y,205,$y);
				$y= $y + 5 + $yy;
				$i++;
			}
		}
	}
	///////////////////////////////
	// Se agregan las observaciones
	if($request->getParameter('observaciones')!='') {
		$pdf->Ln();
		//$pdf->SetX(10);
		$pdf->SetXY(10, $y + 2);
		if(trim($request->getParameter('observaciones'))==''){
			$pdf->MultiCell(195, 0, $request->getParameter('observaciones'), '', 'J');			
		} else {
			//$pdf->MultiCell(195, 0, "OBSERVACIONES: ".$request->getParameter('observaciones'), '', 'J');
			$pdf->WriteHTML("OBSERVACIONES: ".$request->getParameter('observaciones'));
		};
		$pdf->Ln(5);
	}

	// Se agrega el primer pie de pagina
	$pdf->SetX(10);	
	$pdf->MultiCell(195, 0, $request->getParameter('textopie1'), '', 'J');	
	$pdf->SetLineWidth(1);	
	$pdf->Ln(8);
	$y = $pdf->GetY() + 10;
	if($request->getParameter('secacademico')!="") {
		// Muestra las autoridades de la Facultad
		$pdf->SetLineWidth(0);	
		$pdf->Line(10,$y,65,$y);
		$pdf->setXY(10,$y);		
		$pdf->MultiCell(55,3,$request->getParameter('secacademico'),0,'C',0);
	}
	if(trim($request->getParameter('director'))!="" ) {
		// Muestra las autoridades de la Facultad
		$pdf->Line(80,$y,135,$y);
		$pdf->setXY(80,$y);
		$pdf->MultiCell(55,3,$request->getParameter('director'),0,'C',0);
	}
	if($request->getParameter('decano')!="") {
		// Muestra las autoridades de la Facultad
		$pdf->Line(146,$y,206,$y);
		$pdf->setXY(144,$y);		
		$pdf->MultiCell(65,3,$request->getParameter('decano'),0,'C',0);
	}
	// Se agrega el segundo pie de pagina
	$pdf->Ln();
	$pdf->SetX(10);	
	$pdf->MultiCell(195, 0, $request->getParameter('textopie2'), '', 'J');	
		
  	$pdf->Ln(8);
	$y = $pdf->GetY() + 10;
	if($request->getParameter('secgeneral')!="") {
		// Muestra las autoridades de la Universidad
		$pdf->Line(10,$y,65,$y);
		$pdf->setXY(10,$y);		
		$pdf->MultiCell(55,3,$request->getParameter('secgeneral'),0,'C',0);
	}

	if($request->getParameter('rector')!="") {
		// Muestra las autoridades de la Universidad
		$pdf->Line(147,$y,205,$y);
		$pdf->setXY(147,$y);		
		$pdf->MultiCell(55,3,$request->getParameter('rector'),0,'C',0);
	}
		
	// Agrega el Pie al documento
	$pdf->PieOficio(1);	
	$pdf->Output('analitico.pdf', 'I');
 
	// stop symfony process
	throw new sfStopException();

   	return sfView::NONE;            
	}	

  public function executeBuscaralumnos(sfWebRequest $request) {
	
  }
  
  public function executeBuscaranaliticoparcial(sfWebRequest $request) {
	
  }
  
  public function executeBuscaranaliticofinal(sfWebRequest $request) {
	
  }
 
  public function executeIndex(sfWebRequest $request)
  {
    $this->alumnoss = Doctrine_Core::getTable('Alumnos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AlumnosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AlumnosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($alumnos = Doctrine_Core::getTable('Alumnos')->find(array($request->getParameter('idalumno'))), sprintf('Object alumnos does not exist (%s).', $request->getParameter('idalumno')));
    $this->form = new AlumnosForm($alumnos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($alumnos = Doctrine_Core::getTable('Alumnos')->find(array($request->getParameter('idalumno'))), sprintf('Object alumnos does not exist (%s).', $request->getParameter('idalumno')));
    $this->form = new AlumnosForm($alumnos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($alumnos = Doctrine_Core::getTable('Alumnos')->find(array($request->getParameter('idalumno'))), sprintf('Object alumnos does not exist (%s).', $request->getParameter('idalumno')));
    $alumnos->delete();

    $this->redirect('alumnos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $alumnos = $form->save();

      $this->redirect('alumnos/edit?idalumno='.$alumnos->getIdalumno());
    }
  }
	
  // Guarda la fotografia de la persona
  public function executeGuardarfotografia(sfWebRequest $request) {
	$oPersona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
	$filename = $oPersona->getNrodoc() . '.jpg';
	$result = file_put_contents( "fotos/".$filename, file_get_contents('php://input') );
	if (!$result) {
		$resultado = "ERROR: No se pudo escribir el archivo $filename, verificar los permisos.\n";
	} else {
		$resultado = "EXITO: Se pudo escribir correctamente el archivo $filename.\n";
	}
	$this->getResponse()->setContent($resultado);
		
	return sfView::NONE;	
  }

  public function executeObteneranaliticoparcial(sfWebRequest $request) {
  	// Busca la persona
  	$this->idpersona = $request->getParameter('idpersona');
  	$this->persona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	$this->facultad = $this->alumno->getPlanesEstudios()->getCarreras()->getFacultades();
	
	$this->datosanalitico = $this->alumno->obtenerDatosAnalitico();
	$this->fechaF = $this->fechaFormateada($this->persona['fechanac']);	
	$this->idp = $this->idpersona;
  }
    
  public function executeObteneranaliticofinal(sfWebRequest $request) {
	$this->analitico="";
	$this->materias = array();
	$this->extracurriculares = array();
  	// Busca la persona
  	$this->idpersona = $request->getParameter('idpersona');
  	$this->persona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	if ($this->alumno->getIdestudioprevio()==0) {
		$this->estudio = Doctrine_Query::create()
			->from('Estudios e')
			->where('e.idpersona = '.$request->getParameter('idpersona'))
			->fetchOne();
	} else {
		$this->estudio = Doctrine_Core::getTable('Estudios')->find($this->alumno->getIdestudioprevio());
	}
	if ($this->estudio) {
		$this->ciudadestudio = Doctrine_Core::getTable('Ciudades')->find($this->estudio->getIdciudad());
		$this->descripcionestudio = $this->estudio->getDescripcion();
		$this->establecimientoestudio = $this->estudio->getEstablecimiento();
		$this->idcategoria = $this->estudio->getIdcategoriatitulo();
		$this->anioegresoestudio = $this->estudio->getAnioegreso();
	} else {
		$this->ciudadestudio = Doctrine_Core::getTable('Ciudades')->find($this->persona->getIdciudadnac());
		$this->descripcionestudio = "    ";
		$this->establecimientoestudio = "    ";
		$this->idcategoria = 4;
		$this->anioegresoestudio = "    ";
	}
	if ($this->idcategoria==3 or $this->idcategoria==4 or $this->idcategoria==5) {
		$art = "de la";
	} else {
		$art = "del";
	}
	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	
	$fechaEgreso = $this->alumno->obtenerFechaEgreso();
	
	if ($fechaEgreso) {
		$this->fechaegreso = $fechaEgreso;
	} else {
		$ultimaMesa = $this->alumno->obtenerUltimoMesaAprobada();
		$this->fechaegreso = $ultimaMesa['fecha'];
	}
	$this->facultad = $this->alumno->getPlanesEstudios()->getCarreras()->getFacultades();

	//Obtener autoridades
	$this->secacademico = Doctrine_Core::getTable('DesignacionesEmpleados')->obtenerAutoridad($this->alumno->getPlanesEstudios()->getIdcarrera(), 3, 1);
	$this->director = Doctrine_Core::getTable('DesignacionesEmpleados')->obtenerAutoridad($this->alumno->getPlanesEstudios()->getIdcarrera(), 19, $this->alumno->getIdsede());
	$this->decano = Doctrine_Core::getTable('DesignacionesEmpleados')->obtenerAutoridad($this->alumno->getPlanesEstudios()->getIdcarrera(), 4, 1);
	$this->secgeneral = Doctrine_Core::getTable('DesignacionesEmpleados')->obtenerAutoridad($this->alumno->getPlanesEstudios()->getIdcarrera(), 2, 1);
	$this->rector = Doctrine_Core::getTable('DesignacionesEmpleados')->obtenerAutoridad($this->alumno->getPlanesEstudios()->getIdcarrera(), 1, 1);
	$this->fechaF = $this->fechaFormateada($this->persona['fechanac']);

	$this->datosanalitico = $this->alumno->obtenerDatosAnalitico();
		
	$ruta="/var/www/svnacademico/web/analiticos/";
	
	$redaccioninicialdecano = "El Decano";
	
	if($this->decano) {
		if($this->decano->Empleados->Personas->getIdsexo()==1){
			$redaccioninicialdecano = "El Decano";
		} else {
			$redaccioninicialdecano = "La Decana";
		}
	}
		
	if (file_exists($ruta.$this->alumno->getIdalumno()."_encabezado.txt")){
			
		$file = fopen($ruta.$this->alumno->getIdalumno()."_encabezado.txt", "r") or exit("Unable to open file!");
		//Output a line of the file until the end is reached
		$this->encabezado = "\n";
		$existe_archivo = false;

		while(!feof($file)) {
			$this->encabezado = $this->encabezado.fgets($file);
			$existe_archivo = true; 
		}
		
		fclose($file);
	} else {
		foreach ($this->datosanalitico as $this->datosanalit) {
			$this->encabezado = $redaccioninicialdecano." de la ".$this->datosanalit['nomfac']." de la Universidad de Concepción del Uruguay, ".(($this->decano)?$this->decano['titulo'].' '.$this->decano->Empleados->Personas->getNombre().' '.$this->decano->Empleados->Personas->getApellido():'').", certifica que ".$this->datosanalit['apellido'].", ".$this->datosanalit['nombre'] .", ".$this->datosanalit['tipodocumento']." Nº ".(($this->datosanalit['numerodoc']!="")?$this->datosanalit['numerodoc']:$this->datosanalit['nrodoc']).", ". $this->persona->descNacido()."".$this->fechaF.", en ".$this->datosanalit['ciudadnac'] .", Provincia de ".$this->datosanalit['provincianac'].", ".$this->datosanalit['paisnac'].", ".$this->persona->descEgresado()." como ".$this->descripcionestudio." ".$art." ".str_replace("\\","", $this->establecimientoestudio)."".((($this->idcategoria!=4) and ($this->idcategoria!=5))?", de ".$this->ciudadestudio.", ".$this->persona->descProvincia()." de ".$this->ciudadestudio->getProvincias().(($this->ciudadestudio->getProvincias()->getPaises()!="Argentina")?", ".$this->ciudadestudio->getProvincias()->getPaises():""):"").", en el año ".$this->anioegresoestudio.", aprobó las asignaturas que con sus respectivas calificaciones abajo se expresan, correspondientes a ".$this->datosanalit['nomcar']." y que habiendo cumplido con los requisitos legales, estatutarios y reglamentarios vigentes en esta Universidad, ha obtenido el título de ".(($this->datosanalit['idsexo']==1)?$this->datosanalit['nombretitulom']:$this->datosanalit['nombretitulof']).", a los ".strftime("%e", strtotime($this->fechaegreso))." días del mes de ".strftime("%B", strtotime($this->fechaegreso))." de ".strftime("%Y", strtotime($this->fechaegreso)).".\n";
		}
	}
		
	$this->analitico = $this->alumno->obtenerAnalitico();
	foreach($this->analitico as $materia) {
		if($materia['idtipomateria']==5) {
			$this->extracurriculares[$materia['idmp']] = $materia;
		} else {
			$this->materias[$materia['idmp']] = $materia;
		}
	}

	$this->idp = $this->idpersona;
  }
	
  public function getCalificacionLetras($var) {                                                                                                                          
	$var=trim($var);
	$decimal="";
	
	if (strpos($var,',')) {
		$vararray = explode (',',$var);
	} else {
		$vararray = explode ('.',$var);
	}

	if (count($vararray)>1) {
		// si no encontro coma es por que es un numero entero
		if (strlen($vararray[1])==1) {
			$decimal= "/".$vararray[1]."0";
		} else {
			$decimal= "/".$vararray[1];
		}
	}
	$entero1 = $vararray[0];
	if ($entero1==1) $entero="Uno";
	if ($entero1==2) $entero="Dos";
	if ($entero1==3) $entero="Tres";
	if ($entero1==4) $entero="Cuatro";
	if ($entero1==5) $entero="Cinco";
	if ($entero1==6) $entero="Seis";
	if ($entero1==7) $entero="Siete";
	if ($entero1==8) $entero="Ocho";
	if ($entero1==9) $entero="Nueve";
	if ($entero1==10) $entero="Diez";
	if ($entero1=='D') $entero="Desaprobado";
	if ($entero1=='A') $entero="Aprobado";
	if ($entero1=='AMB') $entero="Aprobado Muy Bueno";
	if ($entero1=='AD') $entero="Aprobado Distinguido";
	if ($entero1=='U') $entero="Ausente";

	if($decimal=="/00") {
		$decimal = "";
	}
	return $entero.$decimal;
  }
	
  #Power by Diego
  function fechaFormateada($fecha){
	#Declare n compatible arrays
	$month = array('00' => '', '01' => 'enero', '02' => 'febrero', '03' => 'marzo', '04' => 'abril', '05' => 'mayo', '06' => 'junio', '07' => 'julio', '08' => 'agosto', '09' => 'septiembre', '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre');
	$month_execute = "n"; #format for array month
		 
	$month_mini = array(00 =>"",01 =>"ENE", 02 =>"FEB", 03 =>"MAR", 04 =>"ABR", 05 =>"MAY", 06 =>"JUN", 07 =>"JUL", 08 =>"AGO", 09 =>"SEP", 10 =>"OCT", 11 =>"NOV", 12 =>"DIC");#n
	$month_mini_execute = "n"; #format for array month
		 
	#Content array exception print "HOY", position content the name array. Duplicate value and key for optimization in comparative
	$print_hoy = array("month"=>"month", "month_mini"=>"month_mini");
		 
  	$arr = explode('-', $fecha);
	//return " el " . date("d", $time) . " de " . $month[date("m",$time)] . " del ". date("Y",$time) ." ";	
	return " el " . $arr[2] . " de " . $month[$arr[1]] . " de ". $arr[0];
  }
	
  // Guarda la documentacion laboral seleccionada de la persona
  public function executeGuardarestudioprevio(sfWebRequest $request) {
	  	if($request->getParameter('idestudio')) {
  			$oEstudio = Doctrine_Core::getTable('Estudios')->find($request->getParameter('idestudio'));
  		} else {
  			$oEstudio = new Estudios();
  		}
  		$oEstudio->setIdpersona($request->getParameter('idpersona'));
  		$oEstudio->setIdnivelestudio($request->getParameter('nivel'));
  		$oEstudio->setDescripcion($request->getParameter('titulo'));
  		$oEstudio->setIdcategoriatitulo($request->getParameter('categoria'));
  		$oEstudio->setEstablecimiento($request->getParameter('establecimiento'));
  		$oEstudio->setIdciudad($request->getParameter('ciudadestablecimiento'));
  		$arr = explode('-', $request->getParameter('fechaemision'));
  		$oEstudio->setFecha($arr[2]."-".$arr[1]."-".$arr[0]);
		$fechaegreso=($arr[2]."-".$arr[1]."-".$arr[0]);
  		$oEstudio->setDuracion($request->getParameter('duracion'));
  		$oEstudio->setIdunidadtiempo($request->getParameter('unidadtiempo'));
		$oEstudio->setConcluyo($request->getParameter('concluyo'));
		$oEstudio->setContinua($request->getParameter('continua'));
  		$oEstudio->setCantmaterias($request->getParameter('numerototal'));
  		$oEstudio->setCantmatapro($request->getParameter('numeroaprobadas'));
  		$oEstudio->setAnioingreso($request->getParameter('anioingreso'));
  		$oEstudio->setAnioegreso($request->getParameter('anioegreso'));
  		$oEstudio->setPromedio($request->getParameter('promedio'));
  		$oEstudio->save();
			       
	  	echo "El estudio previo ha sido guardado correctamente.";

  		return sfView::NONE;  	
	}
  
	// Elimina la documentacion laboral seleccionada de la persona
	public function executeEliminarestudioprevio(sfWebRequest $request) {
  		$oEstudio = Doctrine_Core::getTable('Estudios')->find($request->getParameter('idestudio'));
  		$oEstudio->delete();
	
  		return sfView::NONE;  	
  	}

	// Modifica el estudio previo seleccionada de la persona
	public function executeModificarestudioprevio(sfWebRequest $request) {

  		$oEstudio = Doctrine_Core::getTable('Estudios')->find($request->getParameter('idestudio'));
  		
  		$resultado['titulo'] = $oEstudio->getDescripcion();
  		$resultado['nivel'] = $oEstudio->getIdnivelestudio();
  		$resultado['categoria'] = $oEstudio->getIdcategoriatitulo();
  		$resultado['establecimiento'] = $oEstudio->getEstablecimiento();
  		$resultado['ciudadestablecimiento'] = $oEstudio->getIdciudad();
  		$oCiudad = Doctrine_Core::getTable('Ciudades')->find($oEstudio->getIdciudad());
  		$resultado['provinciaestablecimiento'] = $oCiudad->getIdprovincia();
  		$oProvincia = Doctrine_Core::getTable('Provincias')->find($oCiudad->getIdprovincia());
  		$resultado['paisestablecimiento'] = $oProvincia->getIdpais();
  		$arr = explode('-', $oEstudio->getFecha());
  		$resultado['fechaemision'] = $arr[1]."-".$arr[2]."-".$arr[0];
  		$resultado['duracion'] = $oEstudio->getDuracion();
  		$resultado['unidadtiempo'] = $oEstudio->getIdunidadtiempo();
  		$resultado['concluyo'] = $oEstudio->getConcluyo();
  		$resultado['continua'] = $oEstudio->getContinua();
  		$resultado['numerototal'] = $oEstudio->getCantmaterias();
  		$resultado['numeroaprobadas'] = $oEstudio->getCantmatapro();
  		$resultado['anioingreso'] = $oEstudio->getAnioingreso();
  		$resultado['anioegreso'] = $oEstudio->getAnioegreso();
  		$resultado['promedio'] = $oEstudio->getPromedio();  
  		
  		echo json_encode($resultado);
	
  		return sfView::NONE;
  	}  	
		
	public function executeGenerarusuario(sfWebRequest $request) {
		// Obtiene la persona
		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));

		// Obtiene el contacto de la persona
		$oContacto = $oPersona->getContacto();
		if($oContacto && ($oContacto->getEmail1() != "")) {
			// Busca si ya se encuentra registrado dicho email
			$oUsuarioPorEmail = Doctrine::getTable('sfGuardUser')->buscarEmail($oContacto->getEmail1());
			$oUsuarioPorDni = Doctrine::getTable('sfGuardUser')->buscarPerfil($oPersona->getIdtipodoc(), $oPersona->getNrodoc());

			if ($oUsuarioPorEmail && ($oUsuarioPorEmail != $oUsuarioPorDni)) {
				//echo "No se ha creado el usuario ".$oContacto->getEmail1()." correctamente. El usuario o email ya se encuentra registrado.";
			$idgu=$oUsuarioPorEmail;

				$oUsuarioActual = Doctrine::getTable('sfGuardUser')->find($idgu);
				$oUsuarioActual->getAlgorithm('sha1');
				$password = $oPersona->getNrodoc();
				$oUsuarioActual->setPassword($password);
				$oUsuarioActual->save();

				$idpr=$oUsuarioActual->getProfile()->getId();
				$oPerfil1 = Doctrine::getTable('Profile')->find($idpr);
				$oPerfil1->setNrodoc($password);
				$oPerfil1->setIdarea(0);
				$oPerfil1->save();

				echo "Se genero nuevamente la contraseña para el usuario ".$oContacto->getEmail1()." , cuya contraseña actual es el DNI";
			} else {
				if (!$oUsuarioPorDni) {
					$oPerfil = new Profile();
					$oUsuario = new sfGuardUser();
					$oGrupo = new sfGuardUserGroup();
			  		$oPermiso = new sfGuardUserPermission();						
				} else {
					$oUsuario = Doctrine::getTable('sfGuardUser')->find($oUsuarioPorDni);
					$oPerfil = $oUsuario->getProfile();
		  			$oGrupo = $oUsuario->obtenerGrupoUsuario();
		  			if (!$oGrupo) $oGrupo= new sfGuardUserGroup();
		  			$oPermiso = $oUsuario->obtenerPermisoUsuario();
		  			if (!$oPermiso) $oPermiso = new sfGuardUserPermission();					
				}
		
				// Guarda la informacion
				$oUsuario->setFirstName($oPersona->getNombre());
				$oUsuario->setLastName($oPersona->getApellido());
				$oUsuario->setEmailAddress($oContacto->getEmail1());
				$oUsuario->setUsername($oContacto->getEmail1());
				$oUsuario->getAlgorithm('sha1');
				$password = $this->executeGenerarpassword(8);
				$oUsuario->setPassword($password);
				$oUsuario->setIsActive(1);
				$oUsuario->setIsSuperAdmin(0);	  				
				$oUsuario->save();
		  		
		  		$oPerfil->setTipodoc($oPersona->getIdtipodoc());
		  		$oPerfil->setNrodoc($oPersona->getNrodoc());  	  		
		  		$oPerfil->setSfGuardUserId($oUsuario->getId());
		  		$oPerfil->save();
			
		  		$oGrupo->setGroupId(3);	  		
				$oGrupo->setUserId($oUsuario->getId());
				$oGrupo->save();

				$oPermiso->setPermissionId(3);
				$oPermiso->setUserId($oUsuario->getId());
				$oPermiso->save();
			
	  			echo "Se ha creado el usuario ".$oUsuario->getUsername()." correctamente.";
      	
	  			// Enviar un correo a biblioteca y administracionalumnos
				$message = $this->getMailer()->compose();
				$cid = $message->embed(Swift_Image::fromPath('images/Imagen-Entorno-Virtual-Alumnos.jpg'));
				$message->setSubject('UCU - Sistema de Alumnos On-line: Solicitud de usuario');
				$message->setTo(array($oUsuario->getEmailAddress() => $oUsuario->getFirstName().' '.$oUsuario->getLastName()));
				$message->setFrom(array('informatica@ucu.edu.ar' => 'UCU - Informes'));

    			$html = '
				<p align="center">**************************************************************************************<br>
				********************* NO RESPONDER ESTE CORREO *********************<br>
				**************************************************************************************</p>
				<b>'.$oUsuario->getFirstName().' '.$oUsuario->getLastName().'</b>, se ha generado un usuario para 
				que puedas utilizar el Sistema de Alumnos On-line de la <b>Universidad de Concepción del Uruguay</b>.<br> 
				A través del mismo, podrás inscribirte a cursar, ver los programas y horarios de las distintas 
				asignaturas y realizar consultas de todo tipo de manera virtual.<br><br>
				
				Tu usuario es: <b>'.$oUsuario->getUsername().'</b><br>
				La contraseña es: <b>'.$password.'</b><br>
				
				Ingresá en el link <b>http://alumnos.ucu.edu.ar/autogestion.php</b> 
				<br><br>
				Una vez que ingreses al Sistema de Alumnos On-line deberás inscribirte a una Comisión de la asignatura Introducción a la Vida Universitaria.
				</b><br><br>
				NOTA: <b>Te recomendamos guardes este correo para conservar tu usuario y contraseñas originales</b>.<br>
				<p align="center"><img src="'. $cid.'" alt="UCU - Ingresantes 2012" /></p>';
    			
    			$message->setBody($html, 'text/html');

    			$this->getMailer()->send($message);	  		  				
  			}
		} else {
			echo "Debe registrar un email en el cuadro de texto E-Mail1, antes de poder generar un usuario.";
		}
		
		return sfView::NONE;		
	}
		
	public function executeGuardardocumentacion(sfWebRequest $request) {
		$idalumno = $request->getParameter('idalumno');

		if($request->getParameter('fechacerttittramite')) {
			$arrFecha = explode('-', $request->getParameter('fechacerttittramite'));
			$fechacerttittramite = $arrFecha[2]."-".$arrFecha[1]."-".$arrFecha[0];		
		} else {
			$fechacerttittramite = "";
		}

		$arr = $request->getParameter('documentacion');
		if(!$arr){
			$arr = array();
		}  			
	  	$documentacion_seleccionadas = array_values($arr);
	  	$documentaciones_alumnos = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionesPorIdalumno($idalumno);

	  	foreach($documentaciones_alumnos as $documentacion_alumno) {
	  		$documentacion_alumno->delete();
	  	}
	  	
	  	foreach($documentacion_seleccionadas as $documentacion) {
  			$oDocumentacionAlumno = new DocumentacionAlumnos();
  			$oDocumentacionAlumno->setIddocumentacion($documentacion);
  			$oDocumentacionAlumno->setIdalumno($idalumno);
  			$oDocumentacionAlumno->setActivo(1);
  			$oDocumentacionAlumno->save();
	  	}	  	
	  	
		// Busca si existe el alumno
	  	$oAlumno = Doctrine::getTable('Alumnos')->find($idalumno);
	  	$oFacultad = Doctrine::getTable('Facultades')->find($oAlumno->getPlanesEstudios()->getCarreras()->getIdFacultad());

	  	if ((count($oFacultad->buscarLegajo($request->getParameter('legajo'),$oAlumno->getIdpersona()))==0) or ($request->getParameter('legajo')=="")) {	
	  		if ($request->getParameter('legajo')=='?') {
				$idarea = $this->getUser()->getProfile()->getIdarea();
				$oAreas = Doctrine::getTable('Areas')->find($idarea);
				if(isset($oAreas)) $letralegajo=$oAreas->getLetralegajo();
				$legajo = $letralegajo.$idalumno;
			} else {
				$legajo=$request->getParameter('legajo');
			}

			// Guarda las opciones seleccionadas
			$oAlumno->setLegajo($legajo);
			$oAlumno->setFechacerttittramite($fechacerttittramite);
			$oAlumno->setIdsede($this->getUser()->getProfile()->getIdsede());		
		  	$oAlumno->save();
		  	
		  	$resultado = "El Aspirante ha sido guardado correctamente.";
	  	} else {
	  		$resultado = "El legajo ya se encuentra registrado.";
	  	}	
	  	echo $resultado;
	  	
		return sfView::NONE;
	}
		
	public function executeGuardarcontacto(sfWebRequest $request) {
  		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
	  	
	  	/////////////////////////////////////////////////////	
	  	// Obtiene el contacto de la persona
		$oContacto = $oPersona->getContacto();
		if(!$oContacto){
			$oContacto = new Contactos();
			$oContacto->setIdpersona($oPersona->getIdpersona());
		}
		// Guarda los datos del contacto
		if ($request->getParameter('ciudadresidencia')){
			$oContacto->setIdciudade($request->getParameter('ciudadresidencia'));
		}
		$oContacto->setCallee($request->getParameter('nombrecalle'));
		$oContacto->setNumeroe($request->getParameter('nrocalle'));
		$oContacto->setBarrioe($request->getParameter('barrio'));
		$oContacto->setEdificioe($request->getParameter('edificio'));
		$oContacto->setPisoe($request->getParameter('piso'));
		$oContacto->setDeptoe($request->getParameter('depto'));
		$oContacto->setTelefonofijocar($request->getParameter('areatelefonofijo'));
		$oContacto->setTelefonofijonum($request->getParameter('nrotelefonofijo'));
		$oContacto->setCelularcar($request->getParameter('areatelefonomovil'));
		$oContacto->setCelularnum($request->getParameter('nrotelefonomovil'));
		$oContacto->setEmail($request->getParameter('email'));
		$oContacto->setEmail1($request->getParameter('email1'));
		$oContacto->save();

		echo "El Aspirante ha sido guardado correctamente.";
	  	  	
	  	return sfView::NONE;
	}	
	
	public function executeGuardarinformacionpersonal(sfWebRequest $request) {
		$numerodoc = $request->getParameter('nrodocumento');
    	$nrodoc = preg_replace("/[^\d]/", "", $numerodoc);		
		$idcicloSeleccionado = $request->getParameter('idciclolectivo');
		$idciclolectivoActual = Doctrine_Core::getTable('CiclosLectivos')->getIdUltimoCicloLectivoActivo();
		
		if ($idcicloSeleccionado == $idciclolectivoActual) {
			$fechaingreso = date('Y-m-d');
		} else {
			$ciclo = Doctrine_Core::getTable('CiclosLectivos')->find($idcicloSeleccionado);
			$fechaingreso = $ciclo->getCiclo().'-01-01';
		}
		
		$arr = explode('-', $request->getParameter('fechanacimiento'));
		$fechanacimiento = $arr[2]."-".$arr[1]."-".$arr[0];
		if ($request->getParameter('internacional')=="on") {
			$internacional = 1;
		} else {
			$internacional = 0;
		}

	  	if($request->getParameter('idpersona')){
			$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
		} else {
			$oPersona = new Personas();
		  	$oPersona->setIdtipodoc($request->getParameter('idtipodocumento'));
		  	$oPersona->setFechaingreso($fechaingreso);
			$oPersona->setNrodoc($nrodoc);
		}
	  	// Guarda los datos personales
	  	$oPersona->setNumerodoc($numerodoc);	  	
	  	$oPersona->setNombre(ucwords(strtolower($request->getParameter('nombre'))));
	  	$oPersona->setApellido(strtoupper($request->getParameter('apellido')));
	  	$oPersona->setIdsexo($request->getParameter('idsexo'));
	  	$oPersona->setEstadocivil($request->getParameter('estadocivil'));
	  	$oPersona->setIdciudadnac($request->getParameter('ciudadnacimiento'));
	  	$oPersona->setFechanac($fechanacimiento);
	  	$oPersona->save();		

	  	/////////////////////////////////////////////////////  	
	  	// Busca si existe la persona sino lo crea
	  	if ($request->getParameter('idalumno')) {	
  			$oAlumno = Doctrine::getTable('Alumnos')->find($request->getParameter('idalumno'));
  		} else {
	  		$oAlumno = new Alumnos();
  			$oAlumno->setIdpersona($oPersona->getIdpersona());
  			$oAlumno->setIdplanestudio($request->getParameter('carrera'));
  			$oAlumno->setFechaingreso(date('Y-m-d'));
  			
  		}
  		if ($oAlumno->getIdciclolectivo()!=$idcicloSeleccionado) {
  			$oCicloSeleccionado = Doctrine::getTable('CiclosLectivos')->find($request->getParameter('idciclolectivo'));
  			$oCicloAnterior = $oAlumno->getCiclosLectivos();
  			$destinatario = array('auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica');
  				
  			$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
  			$mensaje = '
	  	**************************************************************************************<br>
	  	*******************************NO RESPONDER A ESTE MESNAJE****************************<br>
  			
	  	Se modifico el ciclo lectivo del alumno '.$oAlumno->getPersonas()->getNombre().' '.$oAlumno->getPersonas()->getApellido().', '.$oAlumno->getPersonas()->getTiposDocumentos().': '.$oAlumno->getPersonas()->getNrodoc().', de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'.<br>
	  	IdAlumno: '.$oAlumno->getIdalumno().'- Sede: '.$oAlumno->getIdsede().'<br>
	  	Ciclo Lectivo Anterior: '.$oCicloAnterior->getCiclo().'<br>
		Ciclo Lectivo Seleccionado: '.$oCicloSeleccionado->getCiclo().'<br>
	  	**************************************************************************************<br>
	  	**************************************************************************************';
  				
  			$message = $this->getMailer()->compose
  			(
  					$remitente,
  					$destinatario,
  					'SAO - Modificación de Ciclo Lectivo: '. $oAlumno->getPersonas(),
  					'<html>'.$mensaje.'</html>'
  			)
  			->setContentType('text/html')
  			->addPart($mensaje, 'text/plain');
  				
  			$this->getMailer()->send($message);  			
  		}
  		$oAlumno->setIdciclolectivo($request->getParameter('idciclolectivo'));
  		$oAlumno->setIdtipoinscripto($request->getParameter('idtipoinscripto'));
  		$oAlumno->setInternacional($internacional);
		$oAlumno->setActivo(1);
  		$oAlumno->save();

		echo json_encode(array("idpersona"=>$oPersona->getIdpersona(),"idalumno"=>$oAlumno->getIdalumno(),"mensaje"=>"El Aspirante ha sido guardado correctamente."));

		return sfView::NONE;
	}	

	public function executeModificar(sfWebRequest $request)	{	
		// Busca si existe el alumno
		$this->idalumno = $request->getParameter('idalumno');
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($this->idalumno);
		$oPersona = $oAlumno->getPersonas();
		$oPlanEstudio = $oAlumno->getPlanesEstudios();
		$this->carrera = $oPlanEstudio->getCarreras();
		
		$this->form = new InscripcionesAspiranteForm();
		$this->email = 0;
		$this->emailucu = 0;
		$this->activo = 0;
		$this->fechacerttittramite = "";
		
		// Si existe obtiene todos los datos personales y los muestra en pantalla
		$this->form->setDefault('idplanestudio', $request->getParameter('idplanestudio'));
		$this->form->setDefault('idpersona', $oPersona->getIdpersona());
		$this->form->setDefault('idalumno', $this->idalumno);
		$this->form->setDefault('idtipodocumento', $oPersona->getIdtipodoc());		
		$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($oPersona->getIdtipodoc());
		$this->form->setDefault('tipodocumento', $oTipoDocumento->getDescripcion()."(".$oTipoDocumento->getPaises()->getAbreviacion().")");	
		if($oPersona->getNumerodoc()) {
			$this->form->setDefault('nrodocumento', $oPersona->getNumerodoc());
		} else {
			$this->form->setDefault('nrodocumento', $oPersona->getNrodoc());		
		}
		
		$this->form->setDefault('nombre', $oPersona->getNombre());
		$this->form->setDefault('apellido', $oPersona->getApellido());
		$this->form->setDefault('idsexo', $oPersona->getIdsexo());
		$this->form->setDefault('estadocivil', $oPersona->getEstadocivil());
		$this->form->setDefault('idciclolectivo', $oAlumno->getIdciclolectivo());
		$this->idciudadnac = $oPersona->getIdciudadnac();
		$oCiudadNacimiento = Doctrine_Core::getTable('Ciudades')->find($this->idciudadnac);
		$oProvinciaNacimiento = Doctrine_Core::getTable('Provincias')->find($oCiudadNacimiento->getIdprovincia());
		$this->idprovincianac = $oProvinciaNacimiento->getIdprovincia();
		$oPaisNacimiento = Doctrine_Core::getTable('Paises')->find($oProvinciaNacimiento->getIdpais());
		$this->idpaisnac = $oPaisNacimiento->getIdpais();
		$arr = explode('-', $oPersona->getFechanac());
		$this->form->setDefault('fechanacimiento', $arr[2]."-".$arr[1]."-".$arr[0]);

		// Obtiene el contecto de la persona
		$oContacto = $oPersona->getContacto();
		if($oContacto){
			$this->form->setDefault('nombrecalle', $oContacto->getCallee());
			$this->form->setDefault('nrocalle', $oContacto->getNumeroe());
			$this->form->setDefault('barrio', $oContacto->getBarrioe());
			$this->form->setDefault('edificio', $oContacto->getEdificioe());
			$this->form->setDefault('piso', $oContacto->getPisoe());
			$this->form->setDefault('depto', $oContacto->getDeptoe());
			$this->idciudadres = $oContacto->getIdciudade();
			if(($this->idciudadres != 0) && ($this->idciudadres != NULL)) {
				$oCiudadResidencia = Doctrine_Core::getTable('Ciudades')->find($this->idciudadres);
				$oProvinciaResidencia = Doctrine_Core::getTable('Provincias')->find($oCiudadResidencia->getIdprovincia());
				$this->idprovinciares = $oProvinciaResidencia->getIdprovincia();
				$oPaisResidencia = Doctrine_Core::getTable('Paises')->find($oProvinciaResidencia->getIdpais());
				$this->idpaisres = $oPaisResidencia->getIdpais();
			} else {
				$this->idciudadres = 0;
			}
  			$this->form->setDefault('areatelefonofijo', $oContacto->getTelefonofijocar());
			$this->form->setDefault('nrotelefonofijo', $oContacto->getTelefonofijonum());
			$this->form->setDefault('areatelefonomovil', $oContacto->getCelularcar());
			$this->form->setDefault('nrotelefonomovil', $oContacto->getCelularnum());
			$this->form->setDefault('email', $oContacto->getEmail());
			$this->form->setDefault('email1', $oContacto->getEmail1());
			if ($oContacto->getEmail() != NULL) {
				$this->email = 1;
			}	 
			if ($oContacto->getEmail1() != NULL) {
				$this->emailucu = 1;
			} 
			$this->documentacion_alumnos = array();
		  	$this->documentacion_planes = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->obtenerDocumentacionesPlanesPorPlan($oPlanEstudio->getIdplanestudio());
		  	$documentacion_alumnos = Doctrine_Core::getTable('DocumentacionAlumnos')->findByIdalumno($this->idalumno);
  			foreach ($documentacion_alumnos as $documentacion) {
  				$this->documentacion_alumnos[$documentacion->getIddocumentacion()]=$documentacion->getIddocumentacion();
  			}
  			
			$this->form->setDefault('idtipoinscripto', $oAlumno->getIdtipoinscripto());
			$this->fechacerttittramite = "";
			if ($oAlumno->getFechacerttittramite()) {
				$arrCert = explode('-', $oAlumno->getFechacerttittramite());
				$this->fechacerttittramite = $arrCert[2]."-".$arrCert[1]."-".$arrCert[0];				
			}

			$this->form->setDefault('fechacerttittramite', $this->fechacerttittramite);
			$this->form->setDefault('legajo', $oAlumno->getLegajo());
			$this->form->setDefault('internacional', $oAlumno->getInternacional());
			$this->form->setDefault('idalumno', $oAlumno->getIdalumno());
		} else {
			$this->idciudadnac = 0;
			$this->idciudadres = 0;
		}
		$this->setTemplate('inscribir');
	}	

	public function executeImprimirconstanciageneral(sfWebRequest $request) {
	
		setlocale(LC_ALL,"es_ES");
		// Asigna las distintas variables
		$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$fecha = strftime("%A %d de %B de %Y");
	
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
		$oPersona = $oAlumno->getPersonas();
		$oPlanEstudio = $oAlumno->getPlanesEstudios();
		$oCarrera = $oPlanEstudio->getCarreras();
		$oFacultad = $oCarrera->getFacultades();
		$oSede = Doctrine_Core::getTable('Sedes')->find($idsede);
		 
		// Crea una instancia de la clase de FPDF
		$pdf = new PDF();
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		// Asigna el titulo de la planilla
	
		$titulo = "CONSTANCIA GENERAL";
	
		// Configura el auto-salto de pagina
		$pdf->SetAutoPageBreak(1 , 10);
		// Agrega la Cabecera al documento
		$pdf->Cabecera($oFacultad, "", $titulo);
		$pdf->SetFont('Times','',10);
		$pdf->SetX(35);
		// Define un alias para el número de páginas del documento pdf
		$pdf->AliasNbPages();
		$pdf->SetXY(10,30);
		$pdf->MultiCell(190, 0, $request->getParameter('encabezado'), '', 'J');
		$inicioy = $pdf->GetY();
	
		// ***************** CUERPO *****************
		// Asigna el ancho a las lineas verticales
		$pdf->SetLineWidth(0);

		//obtengo detalles de materias de analitico
		$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
	
		// Muestra la cabecera de la lista
		$pdf->SetFont('Times','',12);
		//$pdf->SetXY(10,$inicioy);
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Cell(65,5,"Apellido y Nombre: ".$alumno->getPersonas()->getApellido().', '.$alumno->getPersonas()->getNombre(),0,1,'L');
	
		$pdf->Cell(65,5,"Documento: ".$alumno->getPersonas()->getNumerodoc(),0,1,'L');
	
		$pdf->Cell(65,5,"Carrera: ".$alumno->getPlanesEstudios()->getCarreras(),0,1,'L');
		$pdf->Ln();
	
		$pdf->Cell(65,5,"Situación en esta Institución a la fecha de la presente: ",0,1,'L');
	
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->MultiCell(190, 0, $request->getParameter('observaciones'), '', 'J');
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Cell(165,5,$request->getParameter('lugar').', '.$request->getParameter('fecha'),0,1,'L');
		$pdf->Ln();
		$pdf->Ln();
	
		$pdf->SetX(160);
		$pdf->Cell(165,5,"Firma y Sello",0,1,'L');
		$pdf->Ln();
			
		// Se agrega el primer pie de pagina
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->MultiCell(190, 0, $request->getParameter('textopie'), '', 'J');
	
		// Agrega el Pie al documento
		$pdf->Pie($alumno->getIdsede(),1);
		$pdf->Output('analitico.pdf', 'I');
	
		// stop symfony process
		throw new sfStopException();
		 
		return sfView::NONE;
	}
	
	public function executeBuscar(sfWebRequest $request)
	{
		$this->form = new BuscarAlumnosForm(array(
			'url' => $this->url,
		    'titulo' => $this->titulo,
			'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
		));	

		if ($request->isMethod('post'))	{
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()) {
        		$this->idplanestudio = $this->form->getValue('carrera');
        		$this->tipocriterio = $this->form->getValue('tipocriterio');
        		$this->criterio = $this->form->getValue('criterio');

  				$this->resultado = Doctrine_Core::getTable('Alumnos')->buscarAlumnos($this->tipocriterio, $this->criterio, $this->idplanestudio, $this->tipo, $this->getUser()->getProfile()->getIdsede());			
			}
		}
	}
}
