<?php

/**
 * estadosalumno actions.
 *
 * @package    sig
 * @subpackage estadosalumno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadosalumnoActions extends sfActions
{ 	

  	
  public function executeImprimirbaja(sfWebRequest $request)
  {
  	setlocale(LC_ALL,"es_ES");
  
  	$arrayMeses = array('01' =>'enero','02' =>'febrero','03' =>'marzo','04' =>'abril','05' =>'mayo','06' =>'junio','07' =>'julio','08' =>'agosto','09' =>'septiembre','10' =>'octubre','11' =>'noviembre','12' =>'diciembre');
  
  	$oBaja = Doctrine::getTable('BajasAlumnos')->find($request->getParameter('idbaja'));
  	$oCarrera = $oBaja->getAlumnos()->getPlanesEstudios()->getCarreras();
  	
  	$fechab = explode("-",$oBaja->getFechabaja());
  	$fechabaja = intval($fechab[2]).' de '.$arrayMeses[$fechab[1]].' de '.$fechab[0];
  	
  	$fechas = explode("-",$oBaja->getFecha());
  	$fechasolicitud = intval($fechas[2]).' de '.$arrayMeses[$fechas[1]].' de '.$fechas[0];
  	 
  	# Tipo de Baja: P=Parcial T=Total  	
  	if ($oBaja->getTipobaja()=="P") {
  		$tipobaja = "PARCIAL";
  		$mensaje = "De mi mayor consideración:<blockquote>Me dirijo a Ud. para solicitar mi baja de las siguientes asignaturas correspondientes a la carrera de ".$oCarrera." :</blockquote>"; 
  	} else {
  		$tipobaja = "DEFINITIVA";
  		$mensaje = "De mi mayor consideración:<blockquote>Me dirijo a Ud. para solicitar mi baja definitiva de la carrera dee ".$oCarrera." :</blockquote>";
  	}
  	
  	$oAlumno = $oBaja->getAlumnos();
  	$oPersona = $oAlumno->getPersonas();
  	$oPlanEstudio = $oAlumno->getPlanesEstudios();
  	$oCarrera = $oPlanEstudio->getCarreras();
  	$oFacultad = $oCarrera->getFacultades();
  	
  	$oDesignacionDecano = Doctrine_Core::getTable('DesignacionesEmpleados')->obtenerAutoridad($oCarrera->getIdcarrera(), 4, $oAlumno->getIdsede());
  	$oDecano = $oDesignacionDecano->getEmpleados()->getPersonas(); 
  	$motivos = $oBaja->obtenerMotivosPorBaja();
  	$materias = $oBaja->obtenerMateriasPorBaja();
  	 
  	////////////////////////////////////////////////
  	// CONTROL LIBREDEUDA
  	$this->administracion = new Administracion();
  	$fechald = $this->administracion->obtenerlibredeudaalumno($oAlumno->getIdalumno(),$oAlumno->getPersonas()->getNrodoc());
  	if(!is_array($fechald)) {
	 	$fechal = explode("-",$fechald);
 		$fechalibredeuda = intval($fechal[2]).' de '.$arrayMeses[$fechal[1]].' de '.$fechal[0];
  	} else {
  		$fechalibredeuda = "";
  	}
  	  	 	
  	if($oDecano->getIdsexo()==1) {
  		$decano ="Sr. DECANO ";
  	} else {
  		$decano ="Sra. DECANA ";
  	}  	
  
  	$oContacto = $oPersona->getContacto();
  
  	$areatelefonofijo = $oContacto->getTelefonofijocar();
  	$telefonofijo = $oContacto->getTelefonofijonum();
  	$areatelefonomovil = $oContacto->getCelularcar();
  	$telefonomovil = $oContacto->getCelularnum();
  
  	if($oContacto->getEmail()){
  		$email = $oContacto->getEmail();
  	} else {
  		$email = "";
  	}
  
  	// Crea una instancia de la clase de FPDF
  	$pdf = new PDF();
  	$pdf->setPrintHeader(false);
  	$pdf->setPrintFooter(false);
  
  	// Asigna el titulo de la planilla
  	$titulo = "SOLICITUD DE BAJA ".$tipobaja;
  	// Configura el auto-salto de pagina
  	$pdf->SetAutoPageBreak(1 , 10);
  	// Agrega la Cabecera al documento
  	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
  	$pdf->SetFont('Times','',10);
  	
  	// Define un alias para el número de páginas del documento pdf
  	$pdf->AliasNbPages();
  	 
  	$html= '<div style="text-align: right;margin-left: 80px;"><span
		style="font-family: Times New Roman,Times,serif;">CONCEPCIÓN DEL URUGUAY, '.$fechasolicitud.'</span><br>
		</div>';
  
  	$html .= '
		<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
  		<tr>
			<td colspan="2">'.$decano.'DE LA <br>'.strtoupper($oFacultad).'<br>'.$oDesignacionDecano['titulo'].' '.$oDecano.'</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>	
		<tr>
			<td colspan="2">'.$mensaje.'</td>
		</tr>	
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" cellpadding="2" >
					<tr>
						<td align="center" width="90%">ASIGNATURA</td>
						<td align="center" width="10%">AÑO</td>
					</tr>								

		';
  	if(count($materias)>0) {
		foreach ($materias as $materia) {
			$html .='
				<tr>
					<td width="90%">'.$materia->getMateriasPlanes().'</td>
					<td align="center" width="10%">'.$materia->getMateriasPlanes()->getAnodecursada().'</td>
				</tr>				
			';			
		}  
  	} else {
  		$html .= '<tr><td colspan="2">No existen materias seleccionadas.</td></tr>';
  	}
	$html .= '
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">Última fecha registrada de asistencia a clases o exámenes: '.$fechabaja.'</td>
		</tr>
		<tr>
			<td colspan="2">Fecha de libre deuda: '.$fechalibredeuda.'</td>
		</tr>					
		<tr>
			<td></td>
			<td></td>
		</tr>			
		<tr>
			<td colspan="2">Motivan la presente solicitud causas de índole:</td>
		</tr>
		<tr>
			<td colspan="2">			
		';
	if(count($motivos)>0) {
		foreach ($motivos as $motivo) {	
			$html .= '- '.$motivo->getMotivos().'<br>';
		}
	}
	$html .= '- Especificar: ';
	if ($oBaja->getOtromotivo()){
		$html .= $oBaja->getOtromotivo();
	} else {
		$html .= '-----';
	}
	$html .= '
			</td>
		</tr>		
		<tr>
			<td colspan="2"></td>
		</tr>					
		<tr>
			<td colspan="2">Sin otro particular, saludo a Ud. muy Atte.</td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>			
		<tr>
			<td colspan="2">
				<table width="100%" border="0" cellpadding="2" >
					<tr>
						<td width="16%">Fecha:</td>
						<td>'.$fechasolicitud.'</td>
					</tr>						
					<tr>
						<td>Teléfono:</td>
						<td>'.$areatelefonofijo.'-'.$telefonofijo.'</td>
					</tr>	
					<tr>
						<td>Celular:</td>
						<td>'.$areatelefonomovil.'-'.$telefonomovil.'</td>
					</tr>								
					<tr>
						<td>Correo electrónico:</td>
						<td>'.$email.'</td>
					</tr>														
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>			
		<tr>
			<td colspan="2">
				<table width="100%" border="0" cellpadding="2" >
					<tr>
						<td width="50%" align="center">__________________________________________________</td>
						<td align="center">'.$oPersona.'</td>
					</tr>						
					<tr>
						<td align="center">FIRMA</td>
						<td align="center">ACLARACIÓN</td>
					</tr>															
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2">Visto, pase copia al Departamento de Desarrollo Humano y Bienestar Estudiantil, y original a Administración Central, para su toma de razón, y proceder a su baja definitiva, luego archívese.</td>
		</tr>																
		</table>
		';
		
  	$pdf->writeHTML($html, true, false, true, false, '');
  
  	// output
  	$pdf->Output('solicitud-baja.pdf', 'I');
  
  	// Stop symfony process
  	throw new sfStopException();
  }
    
  public function executeObteneralumnos(sfWebRequest $request)
  {
    $this->idplanestudio = $request->getParameter('idplanestudio');
    $this->idestado = $request->getParameter('idestado');

    if($request->getParameter('inicio')) {
    	$arr = explode('-', $request->getParameter('inicio'));
		$inicio = $arr[2]."-".$arr[1]."-".$arr[0];    	
    	$this->inicio = $request->getParameter('inicio');
    } else {
    	$this->inicio = '2000-01-01';
    }
        
    if($request->getParameter('fin')) {
		$arr = explode('-', $request->getParameter('fin'));
  		$fin = $arr[2]."-".$arr[1]."-".$arr[0];    	
    	$this->fin = $request->getParameter('fin');
    } else {
    	$this->fin = date('Y-m-d');
    }
  	
    $this->planestudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
    $this->estado = Doctrine_Core::getTable('EstadosAlumno')->find($this->idestado);
    $this->alumnos = Doctrine_Core::getTable('EstadosAlumno')->obtenerAlumnosPorEstado($this->idplanestudio, $this->idestado, $inicio, $fin);
  }	
  
  // Guarda el egreso del alumno
  public function executeGuardaryenviaregreso(sfWebRequest $request) 
  { 
  	$arregloEstadosAlumnos = $request->getParameter('estados_alumno_historial'); 

	// Guarda la informacion de la asignacion
	$oEstadoAlumno = new EstadosAlumnoHistorial();
  	$oEstadoAlumno->setIdalumno($arregloEstadosAlumnos['idalumno']);
	$oEstadoAlumno->setIdestadoalumno($arregloEstadosAlumnos['idestadoalumno']);
	$arr = explode('-', $arregloEstadosAlumnos['fecha']);
	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
	$anioBaja = $arr[2];
	$oEstadoAlumno->setFecha($fecha);
	$oEstadoAlumno->setObservaciones($arregloEstadosAlumnos['observaciones']);
	$oEstadoAlumno->save();
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arregloEstadosAlumnos['idalumno']);
	$oPersona = $oAlumno->getPersonas();

	if($anioBaja >=  2014) {
		$asunto = "SAO - Solicitud de Egreso";
		
		$observaciones = ($arregloEstadosAlumnos['observaciones'] ? $arregloEstadosAlumnos['observaciones'] : "Sin Observaciones.");
		
		// LOS MAILS NO ESTAN CONFIGURADOS EN TABLAS POR LO QUE SE AGREGO MANUALMENTE
		if(($oAlumno->getIdsede()==1) or ($oAlumno->getIdsede()==2) or ($oAlumno->getIdsede()==3)) {
			$destinatario = array('administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos' ,'auditoriaacademica@ucu.edu.ar' => 'Auditoria Academica','academica@ucu.edu.ar' => 'Secretaria Academica'  ,'informatica@ucu.edu.ar' => 'Departamento Informatica' );
		} else { //otras sedes
			$destinatario = array('auxiliarcontable@aelf.edu.ar' => 'AELF - Administracion Alumnos' ,'auditoriaacademica@ucu.edu.ar' => 'Auditoria Academica','academica@ucu.edu.ar' => 'Secretaria Academica'  ,'informatica@ucu.edu.ar' => 'Departamento Informatica' );
		}

		$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
		$mensaje = '
			**************************************************************************************
			**************************************************************************************
			Se solicita el egreso sobre del alumno '.$oAlumno->getPersonas().'
			Idalumno: '.$oAlumno->getIdalumno().'
			Carrera: '.$oAlumno->getPlanesEstudios()->getCarreras().'
			Sede: '.$oAlumno->getSedes().' 
			Observaciones: '.$observaciones.'
			**************************************************************************************
			**************************************************************************************';
			
		$resultado = $this->getMailer()->composeAndSend(
				$remitente,
				$destinatario,
				$asunto,
				$mensaje
		);
	}
	
   	echo "Se ha guardado correctamente el estado.";
   	
	return sfView::NONE;
  }
  

  // Guarda el enmienda del alumno
  public function executeGuardarenmienda(sfWebRequest $request) 
  { 
  	$arregloEstadosAlumnos = $request->getParameter('estados_alumno_historial'); 

	// Guarda la informacion de la asignacion
	$oEstadoAlumno = new EstadosAlumnoHistorial();
  	$oEstadoAlumno->setIdalumno($arregloEstadosAlumnos['idalumno']);
	$oEstadoAlumno->setIdestadoalumno($arregloEstadosAlumnos['idestadoalumno']);
	$arr = explode('-', $arregloEstadosAlumnos['fecha']);
	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
	$oEstadoAlumno->setFecha($fecha);
	$oEstadoAlumno->setObservaciones($arregloEstadosAlumnos['observaciones']);
	$oEstadoAlumno->save();
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arrEstadosAlumnos['idalumno']);
	
   	echo "Se ha guardado correctamente el estado.";
   	
	return sfView::NONE;
  }

  // Guarda el alta del alumno
  public function executeGuardaralta(sfWebRequest $request) 
  { 
  	$arrEstadosAlumnos = $request->getParameter('estados_alumno_historial'); 

	// Guarda la informacion de la asignacion
	$oEstadoAlumno = new EstadosAlumnoHistorial();
  	$oEstadoAlumno->setIdalumno($arrEstadosAlumnos['idalumno']);
	$oEstadoAlumno->setIdestadoalumno(1);
	$arr = explode('-', $arrEstadosAlumnos['fecha']);
	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
	$oEstadoAlumno->setFecha($fecha);
	$oEstadoAlumno->setObservaciones($arrEstadosAlumnos['observaciones']);
	$oEstadoAlumno->save();
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arrEstadosAlumnos['idalumno']);
	
   	echo "Se ha guardado correctamente el estado.";
   	
	return sfView::NONE;
  }

  // Guarda la baja del alumno
  public function executeGuardaryenviarbaja(sfWebRequest $request) 
  { 
  	$arrTiposSolicitudes = array( 'O' => 'Oficio', 'S' => 'Solicitada');
  	$arrTiposBajas = array( 'P' => 'Parcial', 'T' => 'Total');
  	
  	$arrEstadosAlumnos = $request->getParameter('estados_alumno_historial'); 

	$arr = explode('-', $arrEstadosAlumnos['fecha']);
	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
	$arr = explode('-', $arrEstadosAlumnos['fechabaja']);
	$anioBaja = $arr[2];
	// Guarda los cambios en los datos de contacto
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arrEstadosAlumnos['idalumno']);
	$oPersona = $oAlumno->getPersonas();
	
	$fechabaja = $arr[2]."-".$arr[1]."-".$arr[0];
	if($arrEstadosAlumnos['tipobaja']=="T") {
	  	// Guarda la informacion del cambio de estado
		$oEstadoAlumno = new EstadosAlumnoHistorial();
  		$oEstadoAlumno->setIdalumno($arrEstadosAlumnos['idalumno']);
		$oEstadoAlumno->setIdestadoalumno($arrEstadosAlumnos['idestadoalumno']);
		$oEstadoAlumno->setFecha($fechabaja);
		//$oEstadoAlumno->setObservaciones($arrEstadosAlumnos['observaciones']);
		$oEstadoAlumno->save();
		
		if ($oPersona->existeUsuario()) {
			$oProfile = $oPersona->existeUsuario();
			$oUsuario = Doctrine_Core::getTable('sfGuardUser')->find($oProfile->getSfGuardUserId());
			$oUsuario->setIsActive(0);
			$oUsuario->save();
		}
	}

	$oContacto = $oPersona->getContacto();
	if (!$oContacto) {
		$oContacto = new Contactos();
		$oContacto->setIdpersona($oPersona->getIdpersona());
	}
	$oContacto->setTelefonofijocar($arrEstadosAlumnos['areatelefonofijo']);
	$oContacto->setTelefonofijonum($arrEstadosAlumnos['nrotelefonofijo']);
	$oContacto->setCelularcar($arrEstadosAlumnos['areatelefonomovil']);
	$oContacto->setCelularnum($arrEstadosAlumnos['nrotelefonomovil']);
	$oContacto->setEmail($arrEstadosAlumnos['email']);
	$oContacto->save();
	
	// Guarda la baja de los alumnos
	$oBaja = new BajasAlumnos();
	$oBaja->setIdalumno($arrEstadosAlumnos['idalumno']);
	$oBaja->setTiposolicitud($arrEstadosAlumnos['tiposolicitud']);
	$oBaja->setTipobaja($arrEstadosAlumnos['tipobaja']);
	$oBaja->setFecha($fecha);
	$oBaja->setFechabaja($fechabaja);
	$oBaja->setOtromotivo($arrEstadosAlumnos['otromotivo']);
	$oBaja->save();
	
	$arr2 = explode('-', substr($oBaja->getCreatedAt(),0,10));
	$fecharegistro = $arr2[2]."-".$arr2[1]."-".$arr2[0];
	
	// Guarda los motivos seleccionados de la baja
	$motivos_seleccionadas = $arrEstadosAlumnos['idmotivo'];
	if (count($motivos_seleccionadas) > 0) {
	  	foreach ($motivos_seleccionadas as $k =>$v) {
			$oMotivosBajas = new MotivosBajas();
			$oMotivosBajas->setIdbaja($oBaja->getIdbaja());
			$oMotivosBajas->setIdmotivo($v);
			$oMotivosBajas->save();
		}
	}
	// Guarda los cambios los estados de los alumnos en las materias
	$materias_seleccionadas = $request->getParameter('case');
	if(count($materias_seleccionadas) > 0) {
		foreach ($materias_seleccionadas as $materia) {
			// Obtener la comision
			$oComision = Doctrine_Core::getTable('Comisiones')->find($materia);
			$oAluMat = new AluMat();
			$oAluMat->setIdalumno($arrEstadosAlumnos['idalumno']);
			$oAluMat->setIdestadomateria(4);
			$oAluMat->setFecha($fechabaja);
			$oAluMat->setFechavencimiento($fechabaja);
			$oAluMat->setIdcomision($oComision->getIdcomision());
			$oAluMat->setIdcatedra($oComision->getIdcatedra());
			$oAluMat->setIdmateria($oComision->getCatedras()->getMateriasPlanes()->getIdmateria());
			$oAluMat->save();
			
			$oMateriaBaja = new MateriasBajas();
			$oMateriaBaja->setIdbaja($oBaja->getIdbaja());
			$oMateriaBaja->setIdmateriaplan($oComision->getCatedras()->getMateriasPlanes()->getIdmateriaplan());
			$oMateriaBaja->save();
		}
	}
	if($anioBaja >=  2014) {
		$asunto = "SAO - Solicitud de Baja: ".$oAlumno->getPersonas()." (".$oAlumno->getIdalumno().")";
		$oPersona = $oAlumno->getPersonas();
		$oContacto = $oPersona->getContacto();
		
		$areatelefonofijo = $oContacto->getTelefonofijocar();
		$telefonofijo = $oContacto->getTelefonofijonum();
		$areatelefonomovil = $oContacto->getCelularcar();
		$telefonomovil = $oContacto->getCelularnum();
		
		if($oContacto->getEmail()){
			$email = $oContacto->getEmail();
		} else {
			$email = "";
		}
				
		// LOS MAILS NO ESTAN CONFIGURADOS EN TABLAS POR LO QUE SE AGREGO MANUALMENTE
		if($oAlumno->getIdsede()==1) { // SEDE CENTRAL
			$destinatario = array('contaduriageneral@aelf.edu.ar' => 'AELF - Contaduria General', 'administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos', 'bienestarestudiantil@ucu.edu.ar' => 'UCU - Bienestar Estudiantil', 'biblioteca@ucu.edu.ar' => 'UCU - Biblioteca Central', 'auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica' );
		} elseif ($oAlumno->getIdsede()==4) { // CENTRO REGIONAL ROSARIO
			$destinatario = array('contaduriageneral@aelf.edu.ar' => 'AELF - Contaduria General', 'auxiliarcontable@aelf.edu.ar' => 'AELF - Administracion', 'administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos', 'bienestarestudiantil@ucu.edu.ar' => 'UCU - Bienestar Estudiantil', 'auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica', 'administracioncrr@ucu.edu.ar' => 'Centro Regional Rosario');
		} elseif ($oAlumno->getIdsede()==2) { // CENTRO REGIONAL GUALEGUAYCHU
			$destinatario = array('contaduriageneral@aelf.edu.ar' => 'AELF - Contaduria General', 'auxiliarcontable@aelf.edu.ar' => 'AELF - Administracion', 'administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos', 'bienestarestudiantil@ucu.edu.ar' => 'UCU - Bienestar Estudiantil', 'auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica', 'administraciongchu@ucu.edu.ar' => 'Centro Regional Gualeguaychu');
		} elseif ($oAlumno->getIdsede()==5) { // CENTRO REGIONAL SANTA FE
			$destinatario = array('contaduriageneral@aelf.edu.ar' => 'AELF - Contaduria General', 'auxiliarcontable@aelf.edu.ar' => 'AELF - Administracion', 'administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos', 'bienestarestudiantil@ucu.edu.ar' => 'UCU - Bienestar Estudiantil', 'auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica', 'administracioncrsf@ucu.edu.ar' => 'Centro Regional Santa Fe');
		} else { // OTRAS SEDES
			$destinatario = array('contaduriageneral@aelf.edu.ar' => 'AELF - Contaduria General', 'auxiliarcontable@aelf.edu.ar' => 'AELF - Administracion', 'administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos', 'bienestarestudiantil@ucu.edu.ar' => 'UCU - Bienestar Estudiantil', 'auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica');
		}
		$remitente = $this->getUser()->getGuardUser()->getEmailAddress();  	
		
		$motivosbaja = $oBaja->obtenerMotivosPorBaja();
		
		$motivos = '';
		if(count($motivosbaja)>0) {
			foreach ($motivosbaja as $motivo) {
				$motivos .= '- '.$motivo->getMotivos().' ';
			}
		} else {
			$motivos = '-----';
		} 
		$otro_motivo = '';
		if ($oBaja->getOtromotivo()){
			$otro_motivo = $oBaja->getOtromotivo();
		} else {
			$otro_motivo = '-----';
		}		
				
	 	$mensaje = '
			**************************************************************************************
			**************************************************************************************
			
			Se solicita la baja del alumno '.$oAlumno->getPersonas().' ('.$oAlumno->getIdalumno().'), de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'
			Tipo de solicitud: '.$arrTiposSolicitudes[$arrEstadosAlumnos['tiposolicitud']].'
			Tipo de baja: '.$arrTiposBajas[$arrEstadosAlumnos['tipobaja']].'				
			Fecha efectiva de baja: '.$fechabaja.'
			Fecha de informe: '.$fecha.'
			Fecha de registro: '.$fecharegistro.'
		    Motivos: '.$motivos.'
		    Especificar: '.$otro_motivo.'
			Sede: '.$oAlumno->getSedes().'
			Ciclo Lectivo: '.$oAlumno->getCiclosLectivos().'
			E-mail: '.$email.'
			Telefono: '.$areatelefonofijo.'-'.$telefonofijo.'
			Celular: '.$areatelefonomovil.'-'.$telefonomovil.'					
			**************************************************************************************
			**************************************************************************************';
			 
		$resultado = $this->getMailer()->composeAndSend(
			  $remitente,
			  $destinatario,
			  $asunto,
			  $mensaje
		);	
		$resultado=true;
		if ($resultado) {
			$enviado = $oBaja->getIdbaja();
		} else {
			$enviado = 0;
		}
	} else {
		$enviado = $oBaja->getIdbaja();
	}	
	
	echo $enviado;

	return sfView::NONE;
  }  
	
  // Guarda el cambio de estado
  public function executeGuardaryenviar(sfWebRequest $request) 
  { 
  	$arregloEstadosAlumnos = $request->getParameter('estados_alumno_historial'); 

	// Guarda la informacion de la asignacion
	$oEstadoAlumno = new EstadosAlumnoHistorial();
  	$oEstadoAlumno->setIdalumno($arregloEstadosAlumnos['idalumno']);
	$oEstadoAlumno->setIdestadoalumno($arregloEstadosAlumnos['idestadoalumno']);
	$arr = explode('-', $arregloEstadosAlumnos['fecha']);
	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
	$oEstadoAlumno->setFecha($fecha);
	$oEstadoAlumno->setObservaciones($arregloEstadosAlumnos['observaciones']);
	$oEstadoAlumno->save();
	// Obtener el alumno
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arregloEstadosAlumnos['idalumno']);
	
	$asunto = "SAO - Solicitud de Fin de Cursada";
	$estado = "Fin de Cursada";
	
	$observaciones = ($arregloEstadosAlumnos['observaciones'] ? $arregloEstadosAlumnos['observaciones'] : "Sin Observaciones.");
	
	// LOS MAILS NO ESTAN CONFIGURADOS EN TABLAS POR LO QUE SE AGREGO MANUALMENTE
	if(($oAlumno->getIdsede()==1) or ($oAlumno->getIdsede()==2) or ($oAlumno->getIdsede()==3)) { 
		$destinatario = array('administracionalumnos@aelf.edu.ar' => 'AELF - Administracion Alumnos' ,'auditoriaacademica@ucu.edu.ar' => 'Auditoria Academica','academica@ucu.edu.ar' => 'Secretaria Academica'  ,'informatica@ucu.edu.ar' => 'Departamento Informatica' );		
		//$destinatario = array('webmaster@ucu.edu.ar' => 'AELF - Administracion Alumnos' );
	} else { //otras sedes
		$destinatario = array('auxiliarcontable@aelf.edu.ar' => 'AELF - Administracion Alumnos' ,'auditoriaacademica@ucu.edu.ar' => 'Auditoria Academica','academica@ucu.edu.ar' => 'Secretaria Academica'  ,'informatica@ucu.edu.ar' => 'Departamento Informatica' );
		//$destinatario = array('webmaster@ucu.edu.ar' => 'AELF - Administracion Alumnos' );
	}
	
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();  	
 	$mensaje = '
		**************************************************************************************
		**************************************************************************************
		Se solicita '.$estado.' sobre del alumno '.$oAlumno->getPersonas().'
		cuyo idalumno='.$oAlumno->getIdalumno().', de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'
		Observaciones: '.$observaciones.'
		**************************************************************************************
		**************************************************************************************';
		 
	$resultado = $this->getMailer()->composeAndSend(
		  $remitente,
		  $destinatario,
		  $asunto,
		  $mensaje
	);
	
   	echo "Se ha guardado correctamente el estado.";
   	
	return sfView::NONE;
  }
  
  public function executeBuscar(sfWebRequest $request) 
  {
	
  }
  
  // Busca los alumnos segun estado
  public function executeBuscarestado(sfWebRequest $request)
  {
  	$this->form = new BuscarEstadosForm();
  }
  
  public function executeVerbaja(sfWebRequest $request)
  {
  	$this->baja = Doctrine_Core::getTable('BajasAlumnos')->find($request->getParameter('idbaja'));
  	$this->alumno = $this->baja->getAlumnos();
  	$this->persona = $this->alumno->getPersonas();
  	
  	//Tipo de Solicitud: O=Oficio S=Solicitada
  	if ($this->baja->getTiposolicitud()=="O") {
  		$this->tiposolicitud = "Oficio";
  	} else {
  		$this->tiposolicitud = "Solicitada";
  	} 
  	//Tipo de Baja: P=Parcial T=Total
  	if ($this->baja->getTipobaja()=="P") {
  		$this->tipobaja = "Parcial";
  	} else {
  		$this->tipobaja = "Total";
  	}
  	$this->contacto = $this->alumno->getPersonas()->getContacto();
  	$this->motivos = $this->baja->obtenerMotivosPorBaja();
  	$this->materias = $this->baja->obtenerMateriasPorBaja();
  }
  
  public function executeRegistraregreso(sfWebRequest $request)
  {
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
    $mesa = $this->alumno->obtenerUltimoMesaAprobada();
   	
   	if ($mesa['fecha']) {
   		$arr = explode('-', $mesa['fecha']);
   		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
   	} else {
   		$fecha = date('d-m-Y');
   	}
    
  	$this->form = new EstadosAlumnoHistorialForm();
    $this->form->setDefault('idalumno', $request->getParameter('idalumno'));
    $this->form->setDefault('fecha', $fecha);
    $this->form->setDefault('idestadoalumno', 3);
  }

  public function executeRegistrarenmienda(sfWebRequest $request)
  {
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
    $mesa = $this->alumno->obtenerUltimoMesaAprobada();
   	
   	if ($mesa['fecha']) {
   		$arr = explode('-', $mesa['fecha']);
   		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
   	} else {
   		$fecha = date('d-m-Y');
   	}
    
  	$this->form = new EstadosAlumnoHistorialForm();
    $this->form->setDefault('idalumno', $request->getParameter('idalumno'));
    $this->form->setDefault('fecha', $fecha);
    $this->form->setDefault('idestadoalumno', 6);
  }

  public function executeRegistraralta(sfWebRequest $request)
  {
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));

    $fecha = date('d-m-Y');

    
    $this->form = new EstadosAlumnoHistorialForm();
    $this->form->setDefault('idalumno', $request->getParameter('idalumno'));
    $this->form->setDefault('fecha', $fecha);
    $this->form->setDefault('idestadoalumno', 1);
  }
    
  public function executeSolicitarbaja(sfWebRequest $request)
  {
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
    $oAluMat = Doctrine_Core::getTable('AluMat')->getUltimaFecha($request->getParameter('idalumno'));
    if ($oAluMat) {
    	$arr = explode('-', $oAluMat->fecha);
    	$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
    	$this->ultimafecha = $fecha;
    } else {
    	$this->ultimafecha = "-";
    }
    // CONTROL LIBREDEUDA //
    $this->administracion = new Administracion();
    
    $fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc());
    
    if(!is_array($fechalibredeuda)) {
    	$this->fechalibredeuda = date('Y-m-d',strtotime('-1 month', strtotime($fechalibredeuda)));
    } else {
    	$this->fechalibredeuda = "";
    }
    $this->materiasinscriptas = $this->alumno->obtenerMateriasInscripto();
    $oContacto = $this->alumno->getPersonas()->getContacto();
  	$this->form = new EstadosAlumnoBajaForm();
    $this->form->setDefault('idalumno', $request->getParameter('idalumno'));
    $this->form->setDefault('idestadoalumno', 2);
    $this->form->setDefault('fecha', date('d-m-Y'));
    //$this->form->setDefault('fechabaja', date('d-m-Y'));
    if ($oContacto) {
    	$this->form->setDefault('areatelefonofijo', $oContacto->getTelefonofijocar());
    	$this->form->setDefault('nrotelefonofijo', $oContacto->getTelefonofijonum());
    	$this->form->setDefault('areatelefonomovil', $oContacto->getCelularcar());
    	$this->form->setDefault('nrotelefonomovil', $oContacto->getCelularnum());
    	$this->form->setDefault('email', $oContacto->getEmail());    	
    } else {
    	$this->form->setDefault('areatelefonofijo', "");
    	$this->form->setDefault('nrotelefonofijo', "");
    	$this->form->setDefault('areatelefonomovil', "");
    	$this->form->setDefault('nrotelefonomovil', "");
    	$this->form->setDefault('email', "");
    }
  }
  
  public function executeSolicitaraniodegracia(sfWebRequest $request)
  {
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
    
  	$this->form = new EstadosAlumnoHistorialForm();
    $this->form->setDefault('idalumno', $request->getParameter('idalumno'));
    $this->form->setDefault('idestadoalumno', 5);
  }
    
  public function executeSolicitarfindecursada(sfWebRequest $request)
  {
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
    
  	$this->form = new EstadosAlumnoHistorialForm();
    $this->form->setDefault('idalumno', $request->getParameter('idalumno'));
    $this->form->setDefault('idestadoalumno', 4);
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->planestudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
    $this->ultimoestado = $this->alumno->obtenerUltimoEstado();
    $this->contacto = $this->alumno->getPersonas()->getContacto();
    	
  	$this->estados_alumnos = Doctrine_Core::getTable('EstadosAlumnoHistorial')
      ->createQuery('a')
      ->select('*')
	  ->where('idalumno = '.$request->getParameter('idalumno'))
	  ->orderBy('fecha DESC, id DESC')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EstadosAlumnoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EstadosAlumnoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estados_alumno = Doctrine_Core::getTable('EstadosAlumno')->find(array($request->getParameter('idestadoalumno'))), sprintf('Object estados_alumno does not exist (%s).', $request->getParameter('idestadoalumno')));
    $this->form = new EstadosAlumnoForm($estados_alumno);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estados_alumno = Doctrine_Core::getTable('EstadosAlumno')->find(array($request->getParameter('idestadoalumno'))), sprintf('Object estados_alumno does not exist (%s).', $request->getParameter('idestadoalumno')));
    $this->form = new EstadosAlumnoForm($estados_alumno);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($estados_alumno = Doctrine_Core::getTable('EstadosAlumno')->find(array($request->getParameter('idestadoalumno'))), sprintf('Object estados_alumno does not exist (%s).', $request->getParameter('idestadoalumno')));
    $estados_alumno->delete();

    $this->redirect('estadosalumno/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $estados_alumno = $form->save();

      $this->redirect('estadosalumno/edit?idestadoalumno='.$estados_alumno->getIdestadoalumno());
    }
  }
}
