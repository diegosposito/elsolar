<?php

/**
 * inscripciones actions.
 *
 * @package    sig
 * @subpackage inscripciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inscripcionesActions extends sfActions
{
	// Controlar los horarios de la comision que se desea inscribir
	public function executeControlarhorarios(sfWebRequest $request)
	{
		// Arreglos
		$arrDias = array('L' => 'Lunes', 'M' => 'Martes', 'I' => 'Miercoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sabado', 'D' => 'Domingo');
		$arrAsignaciones = array();
		$arrResultado = array();
	
		// Busca el alumno
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->comision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));
		$idcomision = 0;
		$mensajea = "";
		$mensajeb = "";
	
		// Obtiene el nombre de la comision a inscribir
		$mensajeb .= $this->comision->getCatedras()->getMateriasPlanes()."\n";
		// Obtiene las comisiones inscriptas
		$comisionesinscriptas = $this->alumno->obtenerMateriasInscripto();
		// Recorre las comisiones inscriptas
		foreach ($comisionesinscriptas as $comisioninscripta) {
			// Controla los horarios de las comisiones inscriptas con la que se desea inscribir
			$resultado = $this->comision->controlarHorarios($comisioninscripta->getIdcomision());
			// Si hay superposiciones horarias
			if(count($resultado)>0) {
				foreach($resultado as $item) {
					// Obtiene las asignaciones de clases en las que hay superposiciones horarios
					$asiga = Doctrine_Core::getTable('AsignacionesClases')->find($item['idinscripto']);
					$asigb = Doctrine_Core::getTable('AsignacionesClases')->find($item['idnoinscripto']);
					// Si la comision no existe
					if ($asiga->getIdcomision()!=$idcomision) {
						$mensajea .= $asiga->getComisiones()->getCatedras()->getMateriasPlanes()."\n";
						$idcomision = $asiga->getIdcomision();
					}
					// Si la asignacion de clase no existe
					if (!in_array($item['idnoinscripto'], $arrAsignaciones)) {
						array_push($arrAsignaciones, $item['idnoinscripto']);
						$mensajeb .=  "     (".$arrDias[$asigb->getDia()]." ".$asigb->getHorainicio()."-".$asigb->getHorafin().")<br>";
					}
					$mensajea .=  "     (".$arrDias[$asiga->getDia()]." ".$asiga->getHorainicio()."-".$asiga->getHorafin().")<br>";
				}
			}
		}
		$arrResultado['inscripta'] = $mensajea;
		$arrResultado['noinscripta'] = $mensajeb;
		echo json_encode($arrResultado);
			
		return sfView::NONE;
	}
	
	public function executeSolicitarlibredeuda(sfWebRequest $request) {
		// Obtener la fecha actual
		$hoy = date('Y-m-d');
				
		// Busca el alumno
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		if ($request->getParameter('tipo')==1) {
			$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('id'));
			$tipo = 'INSCRIPCION PARA CURSAR';
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
			'Solicitud de Libre Deuda: '. $oAlumno->getPersonas(),
			$mensajeEmail
	);
	
	foreach ($usuariosDestino as $k=>$v) {
		$oSolicitudLibredeuda = new SolicitudesLibredeuda();
		$oSolicitudLibredeuda->setIdusuarioorigen($this->getUser()->getGuardUser()->getId());
		$oSolicitudLibredeuda->setIdusuariodestino($k);
		$oSolicitudLibredeuda->setIdalumno($oAlumno->getIdalumno());
		$oSolicitudLibredeuda->setIdestadosolicitud(1);
		$oSolicitudLibredeuda->setMensaje($msj);
		$oSolicitudLibredeuda->setFecha($hoy);
		$oSolicitudLibredeuda->save();
	}
			
	if ($resultado) {
		echo "Se ha enviado correctamente la Solicitud de libre deuda.";
	} else {
		echo "No se ha podido enviar la Solicitud de libre deuda.\nCompruebe que las cuenta de correo remitente o destinataria funcionen correctamente.\n"."REMITENTE: ".$remitente."- DESTINATARIO:".$destinatario;
	}
	
	return sfView::NONE;
	}
		
	//////////////////////////////////////////////////////////////////////////////////
	/////// INSCRIPCIONES A MATERIAS
	//////////////////////////////////////////////////////////////////////////////////		
	public function executeEliminarinscripcionmateria(sfWebRequest $request)	{
		$oComision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$oAluMat = Doctrine_Core::getTable('AluMat')->getUltimoEstadoPre($oAlumno->getIdpersona(), $oComision->getIdcatedra());
		$fechaActual = date("Y-m-d");
	
		if ($oAluMat) {
			if($oAluMat->getIdestadomateria()==1) {
				// Se actualiza el estado Erroneo
				$oAluMat->setFecha($fechaActual);
				$oAluMat->setFechavencimiento($fechaActual);
				$oAluMat->setIdestadomateria(11);
				$oAluMat->save();
	
				// Destinatario
				$destinatario = $this->getUser()->getGuardUser()->getEmailAddress();
				// Remitente
				$remitente = "sistemas@ucu.edu.ar";
				
				$msj = 'Se confirma que el alumno '.$oAlumno->getPersonas().', '.$oAlumno->getPersonas()->getTiposDocumentos().': '.$oAlumno->getPersonas()->getNrodoc().' se ha sido eliminado correctamente a la materia.
		IdAlumno: '.$oAlumno->getIdalumno().'
		Operación: Eliminación a Materia
		Materia: '.$oComision->getCatedras()->getMateriasPlanes()->getMaterias().'
		Fecha de eliminación: '.date('d-m-Y H:i:s');
				
				$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
				
				$resul = $this->getMailer()->composeAndSend(
						$remitente,
						$destinatario,
						'SAO - Confirmación de eliminación a Materia: '. $oAlumno->getPersonas(),
						$mensajeEmail
				);
								
				echo "Se ha eliminado correctamente a la materia.\n";
			} else {
				echo "No se ha podido eliminar a la materia.\n";
			}
		} else {
			echo "No se ha podido eliminar a la materia.\n";
		}
		return sfView::NONE;
	}
	
	public function executeInscribirmateria(sfWebRequest $request){
		// Busca el alumno
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	
		$control_anios_aprobados = true;
	
		// solo para controles de años completos aprobados
		$cicloMayor2011 = Doctrine_Core::getTable('CiclosLectivos')->getAlumnoTieneCicloLectivoMayor2011($this->alumno->getIdalumno());
	
		////////////////////////////////////////////////
		// CONTROL SOLO PARA ARQUITECTURA DE AÑOS APROBADOS COMPLETOS
		if(($this->alumno->getIdplanestudio()==18 || $this->alumno->getIdplanestudio()==19) && $cicloMayor2011) {
			$comision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));
			$idmateriaplan = $comision->getCatedras()->getMateriasPlanes()->getIdmateriaplan();
	
			$control_anios_aprobados = Doctrine_Core::getTable('Correlatividades')->controlAnioCompleto($this->alumno->getIdalumno(), $this->alumno->getIdplanestudio(), $idmateriaplan);
	
			if (!$control_anios_aprobados)
				$resultado = 4;
		}
	
		// Si es un superadmin se quita este control (se creo un usuario para secretario academico con privilegio)
		if($this->getUser()->isSuperAdmin()) $control_anios_aprobados = true;
			
		// Inscribe el alumno a la materia
		if ($control_anios_aprobados) // solo es falso si falla el control en arquitectura
			$resultado = $this->alumno->inscribirMateria($request->getParameter('idcomision'));
	
		// Muestra un mensaje de acuerdo a resultado
		switch ($resultado) {
			case 1:
				echo "Se ha inscripto correctamente a la materia.\n";
				break;
			case 2:
				echo "El alumno ya se encuentra inscripto o regular a dicha materia.\n";
				break;
			case 3:
				echo "Se ha superado la capacidad maxima de la comisión.\n";
				break;
			case 4:
				echo "El alumno no tiene los años completos previos aprobados para cursar esta materia.\n";
				break;
		}
		
		if($resultado == 1) {
			$this->comision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));
			// Destinatario
			$destinatario = $this->getUser()->getGuardUser()->getEmailAddress();
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
				
			$msj = 'Se confirma que el alumno '.$this->alumno->getPersonas().', '.$this->alumno->getPersonas()->getTiposDocumentos().': '.$this->alumno->getPersonas()->getNrodoc().' se ha inscripto correctamente a la materia.
		IdAlumno: '.$this->alumno->getIdalumno().'
		Operación: Inscripción a Materia
		Materia: '.$this->comision->getCatedras()->getMateriasPlanes()->getMaterias().'
		Fecha de inscripción: '.date('d-m-Y H:i:s');
				
			$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
				
			$resul = $this->getMailer()->composeAndSend(
					$remitente,
					$destinatario,
					'SAO - Confirmación de inscripción a Materia: '. $this->alumno->getPersonas(),
					$mensajeEmail
			);
		}
		
		return sfView::NONE;
	}
	
	public function executeObtenermateriascursar(sfWebRequest $request) {
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->idsede = $this->alumno->getIdsede();
	
		$this->materiashabilitadas = array();
	
		////////////////////////////////////////////////
		// CONTROL DE PERIODO DE INSCRIPCION
		// Se debe verificar si esta en periodo de inscripcion
		$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());
	
		// Obtener la fecha actual
		$hoy = date('Y-m-d');
		$fechaactual = date('Y-m-d');
				
		////////////////////////////////////////////////
		// CONTROL DE ULTIMA SOLICITUD DE LIBRE DEUDA		
		$oSolicitudLibreDeuda = $this->alumno->obtenerUltimaSolicitudLibredeuda();
		// Controla que no se haya solicitado otro libredeuda en ese mismo dia
		$this->solicitudpermitida = true;
		if ($oSolicitudLibreDeuda) {
			if ($oSolicitudLibreDeuda->getFecha()==$hoy) {
				$this->solicitudpermitida = false;
			}
		}
			
		$fechas = $oCalendario->obtenerFechasPorTipo(4);
		// Controla que la fecha actual este dentro de un periodo de inscripcion
		$this->periodohabilitado = false;
		$this->periododecursada = 0;
		foreach ($fechas as $fecha) {
			if(strtotime($hoy) >= strtotime($fecha->getInicio()) && strtotime($hoy) <= strtotime($fecha->getFin())) {
				$this->periodohabilitado = true;
				$periodos = Doctrine_Core::getTable('PeriodosCursadas')->findByIdfecha($fecha->getIdfecha());
				foreach ($periodos as $periodo) {
					$this->periododecursada = $periodo->getPeriododecursada();
				}
			}
		}
	
		// Controla que el alumno haya presentada la documentacion obligatoria
		// Aqui se tendria que verificar segun la carrera el requicito de titulo secundario o titulo de grado!!!!
		$this->documentacionhabilitada = false;
		$idtipocarrera = $this->alumno->getPlanesEstudios()->getCarreras()->getIdtipocarrera();
		$certtittramite = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),8);
		
		if ($idtipocarrera==8) {
			$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
			if(($certtittramite==1) or ($fotocopialegtitulogrado==1)) {
				$this->documentacionhabilitada = true;
			}
		}elseif ($idtipocarrera==10) {
			$fotocopialegtitulopregrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),37);
			$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
			if (($fotocopialegtitulopregrado==1) or ($fotocopialegtitulogrado ==1)) {
				$this->documentacionhabilitada = true;
			}			
		} else {
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			if(($certtittramite==1) or ($fotocopialegtitulo==1) or ($idtipocarrera==6)) {
				$this->documentacionhabilitada = true;
			}
		}
				
		////////////////////////////////////////////////
		// CONTROL LIBREDEUDA
		$this->administracion = new Administracion(); 
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc());
		if($fechalibredeuda >= date('Y-m-d') and !is_array($fechalibredeuda)) {
			$this->estadolibredeuda = true;
		} else {
			$this->estadolibredeuda = false;
		}
	
		////////////////////////////////////////////////
		// CONTROLES ADICIONALES
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		$this->estadodocumentacion = true;
		$this->entregaencuesta = true;
		if ($oCarreraSede) {
			// CONTROL DE DOCUMENTACION //
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			
			if ($oCarreraSede->getPlazocerttittramite()!="" and $fotocopialegtitulo==0) {
				$fechacert = date('Y-m-d', strtotime($this->alumno->getFechacerttittramite()));
				$plazocert = intval($oCarreraSede->getPlazocerttittramite());
				$fechavencimiento= date('Y-m-d', strtotime("$fechacert + $plazocert days"));
				if ($fechavencimiento < $hoy){
					$this->estadodocumentacion = false;
				}
			}
			// CONTROL DE ENTREGA DE ENCUESTAS //
			if ($oCarreraSede->getEntregaencuesta()==1) {
				$oEncuesta = Doctrine_Core::getTable('Encuestas')->obtenerUltimaEncuesta($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
				if ($oEncuesta) {
					$oEntrega = $this->alumno->obtenerUltimaEncuestaEntregada($oEncuesta->getIdencuesta());
					if(!$oEntrega){
						$this->entregaencuesta = false;
					}
				}
			}
		}		
		
		////////////////////////////////////////////////
		// CONTROL ACTIVACION CICLO LECTIVO
		$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdCicloLectivoActual();
		$this->activo = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($idcicloactual, $request->getParameter('idalumno'));
	
		///////////////////////////////////////////////////
		// CHEQUEAR EL CONTENIDO DE LOS SIGUIENTES METODOS
		///////////////////////////////////////////////////
		$this->materias = $this->alumno->obtenerMateriasHabilitadas('C', 'R');

		foreach ($this->materias as $materiahabilitada) {
			if (($materiahabilitada['anodecursada']!=0) and (($materiahabilitada['periododecursada']==$this->periododecursada) || ($materiahabilitada['periododecursada']==0))) {
				$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
	
				// Si no esta activa y es una materia generia debe buscar las materias optativas que la contienen
				if ($oCatedra->getActiva()==0 and $materiahabilitada['generica']==4) {
					$materiasOptativas = $oCatedra->getMateriasPlanes()->obtenerMateriasComponentes();
					foreach ($materiasOptativas as $matopt) {
						$oMateriaOptativa = Doctrine_Core::getTable('MateriasPlanes')->find($matopt['idmateriaplan']);
						$oCatedraOptativa = $oMateriaOptativa->obtenerCatedra($oCatedra->getIdsede());
							
						$tieneAprobada = Doctrine::getTable('AluMat')->tieneAprobado($this->alumno->getIdalumno(),$matopt['idmateriaplan']);
						if ($oCatedraOptativa->getActiva()==1 and !$tieneAprobada){
							$this->materiashabilitadas[$oCatedraOptativa->getIdcatedra()] = $oCatedraOptativa;
						}
					}
				} else {
					if($this->idsede == $oCatedra->getIdsede()) {
						$this->materiashabilitadas[$oCatedra->getIdcatedra()] = $oCatedra;
					}
				}
			}
		}		
		
		$this->materiasinscriptas = $this->alumno->obtenerMateriasInscripto();
	}
	
	public function executeInscribirmateriascursar(sfWebRequest $request) {
		$this->mensaje = "";
	
		$this->form = new BuscarCarrerasActivasAlumnosForm();
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	/////// INSCRIPCIONES A MATERIAS DEL PREUNIVERSITARIO
	//////////////////////////////////////////////////////////////////////////////////
	public function executeObtenermateriaspreuniversitario(sfWebRequest $request){
		$this->idalumno = $request->getParameter('idalumno');
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($this->idalumno);

		$this->materiaspre = array();
		$this->materias = array();
		$this->materiashabilitadas = array();
		$this->materiasinscriptas = array();
		$this->idalumnos = array();
			
		////////////////////////////////////////////////
		// CONTROL DE PERIODO DE INSCRIPCION
		// Se debe verificar si esta en periodo de inscripcion
		$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());

		// Obtener la fecha actual
		$hoy = date('Y-m-d');
		
		$fechas = $oCalendario->obtenerFechasPorTipo(4);
		$this->habilitado = false;
		foreach ($fechas as $fecha) {
			if(strtotime($hoy) > strtotime($fecha->getInicio()) && strtotime($hoy) < strtotime($fecha->getFin())) {
				$this->habilitado = true;
			}
		}
			
		////////////////////////////////////////////////
		// CONTROL ACTIVACION CICLO LECTIVO		
		$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdCicloLectivoActual();
		$this->activo = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($idcicloactual, $this->idalumno);

		if ($this->activo) {
			// busco la persona para verificar si esta inscripto en el preuniversitario
			$idpersona = $this->alumno->getIdpersona();
			$oAlumnos = Doctrine_Core::getTable('Alumnos')->findByIdpersona($idpersona);
			foreach($oAlumnos as $alumno) {
				$arrCarreras= array();
				array_push($arrCarreras, $alumno->getIdplanestudio());
			}
			// si el alumno no esta inscripto al preuniversitario se debe agregar
			if(!in_array(168,$arrCarreras)) {
				// se debe crear al alumno
				// primero en SAO (base datos alumnos servidor 195)

				$nuevoalumno= new Alumnos();
				$nuevoalumno->setIdpersona($idpersona);
				$nuevoalumno->setIdplanestudio(168);
				$nuevoalumno->setIdciclolectivo($idcicloactual);
				$nuevoalumno->setIdsede($this->getUser()->getProfile()->getIdsede());
				$nuevoalumno->save();

				// luego de dar de alta en SAO se debe dar de alta en SIG (base datos UCU servidor 196 )
				/////////////////////////////////////////////////////
				//conexion webservice alumnos
				$soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
				$soapclient->setCredentials("root", "sistemas2009");

				// llamamos la función implementada en el webservices
				$resultadoSoap = $soapclient->call('actualizaralumno',
					array('idalumno' => NULL,
						'idpersona' => $idpersona,
						'idplanestudio' => 168,
						'fechaingreso' => '2014-12-10',
						'ingreso' => '2015',
						'legajo' => $nuevoalumno->getIdalumno(),
						'fotografia' => NULL,
						'fotocopiadni' => NULL,
						'fotocopialegtitulo' => NULL,
						'certtittramite' => NULL,
						'certalureg' => NULL,
						'derechoevaluacion' => NULL,
						'experiencialaboral' => NULL,
						'pagomatricula' => NULL,
						'bancarizacion' => NULL,
						'titulorevalido' => NULL,
						'tramiteresidencia' => NULL,
						'radiografiatorax' => NULL,
						'electrocardiograma' => NULL,
						'ergonomia' => NULL,
						'planillamedica' => NULL,
						'planillabucodental' => NULL,
						'activo' => NULL,
						'idestadoalumno' => NULL,
						'codadministracion' => NULL)
				);

				$this->alu = unserialize(base64_decode($resultadoSoap));

				if(($this->alu == "1E") || ($this->alumno == "2E")) {
					// enviar email avisando
					$resultado = "Webservice:Se encuentra repetida o no existe.";
				}
			}

			// Obtiene las materias habilitadas para cursar
			$this->alumnopre = Doctrine_Core::getTable('Alumnos')->buscarAlumno($idpersona, 168);

			$this->materiaspre = $this->alumnopre->obtenerMateriasHabilitadasPreuniversitario();
			foreach ($this->materiaspre as $materiaprehabilitada) {
				$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($materiaprehabilitada['idmateriaplan']);
				$this->materiashabilitadas[$materiaprehabilitada['idmateriaplan']] = $oMateriaPlan;
				$this->idalumnos[$materiaprehabilitada['idmateriaplan']] = $this->alumnopre->getIdalumno();
			}
			
			$this->materias = $this->alumno->obtenerMateriasHabilitadas('C', 'R');
			foreach ($this->materias as $materiahabilitada) {
				if ($materiahabilitada['anodecursada']==0) {
					$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($materiahabilitada['idmateriaplan']);
					$this->materiashabilitadas[$materiahabilitada['idmateriaplan']] = $oMateriaPlan;
					$this->idalumnos[$materiahabilitada['idmateriaplan']] = $this->alumno->getIdalumno();
				}
			}

			$this->materiasinscriptas = $this->alumno->obtenerMateriasInscriptoPreuniversitario();
			if($this->alumno->getIdsede()==1) $this->habilitado=true; else $this->habilitado=false;
		}
	}
		
	public function executeInscribirmateriaspreuniversitario(sfWebRequest $request) {
		$this->mensaje = "";
	
		$this->form = new BuscarCarrerasActivasAlumnosForm();
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	/////// INSCRIPCIONES A MESAS DE EXAMENES
	//////////////////////////////////////////////////////////////////////////////////
	public function executeEliminarinscripcionexamen(sfWebRequest $request)	{
		// Obtiene el objecto Examenes
		$oExamen = Doctrine_Core::getTable('Examenes')->getExamen($request->getParameter('idalumno'), $request->getParameter('idmesaexamen'));
		// Si existe el objeto lo elimina
		if($oExamen->delete()) {
			// Destinatario
			$destinatario = $this->getUser()->getGuardUser()->getEmailAddress();
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
				
			$msj = 'Se confirma que el alumno '.$oExamen->getAlumnos()->getPersonas().', '.$oExamen->getAlumnos()->getPersonas()->getTiposDocumentos().': '.$oExamen->getAlumnos()->getPersonas()->getNrodoc().' se ha sido eliminado correctamente a la mesa de examen.
		IdExamen: '.$oExamen->getIdexamen().'
		IdAlumno: '.$oExamen->getAlumnos()->getIdalumno().'
		Operación: Eliminación a Mesa de Examen
		IdMesaExamen: '.$oExamen->getIdmesaexamen().'				
		Materia: '.$oExamen->getMesasExamenes()->getCatedras()->getMateriasPlanes()->getMaterias().'
		Tipo: '.$oExamen->getMesasExamenes()->mesaexamen->getCondicionesMesas().'				
		Fecha: '.$oExamen->getMesasExamenes()->getFecha().' - '.$oExamen->getMesasExamenes()->getHora().'
		Fecha de eliminación: '.date('d-m-Y H:i:s');
				
				
			$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
				
			$resul = $this->getMailer()->composeAndSend(
					$remitente,
					$destinatario,
					'SAO - Confirmación de eliminación a Mesa de Examén: '. $oExamen->getAlumnos()->getPersonas(),
					$mensajeEmail
			);
						
			echo "Se ha eliminado correctamente a la mesa de examen.\n";
		} else {
			echo "No se ha podido eliminar a la mesa de examen.\n";
		}
		return sfView::NONE;
	}
	
	public function executeInscribirexamen(sfWebRequest $request)	{
		// Busca el alumno
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		// Busca la mesa de examen
		$this->mesaexamen = Doctrine_Core::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
		// Inscribe el alumno a la mesa
		$resultado = $this->alumno->inscribirMesaExamen($this->mesaexamen->getIdmesaexamen());
		// Muestra un mensaje de acuerdo a resultado
		if($resultado == 0) {
			echo "Se ha inscripto correctamente a la mesa de examen.\n";
		} elseif ($resultado == 1) {
			echo "El alumno ya se encuentra inscripto a dicha mesa de examen o regular a la materia.\n";
		} elseif ($resultado == 2) {
			echo "El cupo de inscriptos a la mesa de examen ha sido alcanzado.\n";
		} elseif ($resultado == 3) {
			echo "El alumno estuvo ausente en la ultima mesa de examen.\n";
		} elseif ($resultado == 4) {
			echo "El alumno ya se encuentra inscripto a la materia en el mismo turno.\n";			
		} else {
			//Controla que la mesa de examen no sea anterior al Ciclo lectivo del alumno
			echo "La mesa de examen es anterior al Ciclo Lectivo del alumno.\n";
		}
		
		if($resultado == 0) {
			// Obtiene el objecto Examenes
			$oExamen = Doctrine_Core::getTable('Examenes')->getExamen($request->getParameter('idalumno'), $request->getParameter('idmesaexamen'));
				
			// Destinatario
			$destinatario = $this->getUser()->getGuardUser()->getEmailAddress();
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
			
			$msj = 'Se confirma que el alumno '.$this->alumno->getPersonas().', '.$this->alumno->getPersonas()->getTiposDocumentos().': '.$this->alumno->getPersonas()->getNrodoc().' se ha inscripto correctamente a la mesa de examen.
		IdExamen: '.$oExamen->getIdexamen().'
		IdAlumno: '.$this->alumno->getIdalumno().'
		Operación: Inscripción a Mesa de Examen
		IdMesaExamen: '.$this->mesaexamen->getIdmesaexamen().'				
		Materia: '.$this->mesaexamen->getCatedras()->getMateriasPlanes()->getMaterias().'
		Tipo: '.$this->mesaexamen->getCondicionesMesas().' 
		Fecha: '.$this->mesaexamen->getFecha().' - '.$this->mesaexamen->getHora().'
		Fecha de inscripción: '.date('d-m-Y H:i:s');
			
			$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
			
			$resul = $this->getMailer()->composeAndSend(
					$remitente,
					$destinatario,
					'SAO - Confirmación de inscripción a Mesa de Examén: '. $this->alumno->getPersonas(),
					$mensajeEmail
			);			
		}
		return sfView::NONE;
	}
	
	public function executeObtenermateriasaprobar(sfWebRequest $request) {
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));		
		$this->idsede = $this->alumno->getIdsede();
	
		$this->mesasdisponibles = array();
		
		// Obtener la fecha actual
		$hoy = date('Y-m-d');
				
		////////////////////////////////////////////////
		// CONTROL DE ULTIMA SOLICITUD DE LIBRE DEUDA		
		$oSolicitudLibreDeuda = $this->alumno->obtenerUltimaSolicitudLibredeuda();
		// Controla que no se haya solicitado otro libredeuda en ese mismo dia
		$this->solicitudpermitida = true;
		if ($oSolicitudLibreDeuda) {
			if ($oSolicitudLibreDeuda->getFecha()==$hoy) {
				$this->solicitudpermitida = false;
			}
		}

		////////////////////////////////////////////////
		// CONTROL DE PERIODO DE INSCRIPCION
		// Se debe verificar si esta en periodo de inscripcion
		$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());
		
		$fechas = $oCalendario->obtenerFechasPorTipo(5);
		// Controla que la fecha actual este dentro de un periodo de inscripcion
		$this->periodohabilitado = false;
		foreach ($fechas as $fecha) {
			if(strtotime($hoy) >= strtotime($fecha->getInicio()) && strtotime($hoy) <= strtotime($fecha->getFin())) {
				$this->periodohabilitado = true;
			}
		}
		// Controla que el alumno haya presentada la documentacion obligatoria
		// Aqui se tendria que verificar segun la carrera el requicito de titulo secundario o titulo de grado!!!!
		$this->documentacionhabilitada = false;
		$idtipocarrera = $this->alumno->getPlanesEstudios()->getCarreras()->getIdtipocarrera(); 
		$certtittramite = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),8);
		
		if ($idtipocarrera==8) {
			$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
			if(($certtittramite==1) or ($fotocopialegtitulogrado==1)) {
				$this->documentacionhabilitada = true;
			}
		}elseif ($idtipocarrera==10) {
			$fotocopialegtitulopregrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),37);
			$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
			if (($fotocopialegtitulopregrado==1) or ($fotocopialegtitulogrado ==1)) {
				$this->documentacionhabilitada = true;
			}			
		} else {
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			if(($certtittramite==1) or ($fotocopialegtitulo==1) or ($idtipocarrera==6)) {
				$this->documentacionhabilitada = true;
			}
		}

		////////////////////////////////////////////////
		// CONTROL LIBREDEUDA
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc());
	
		if($fechalibredeuda >= date('Y-m-d') and !is_array($fechalibredeuda)) {
			$this->estadolibredeuda = true;
		} else {
			$this->estadolibredeuda = false;
		}

		////////////////////////////////////////////////
		// CONTROLES ADICIONALES
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		$this->estadodocumentacion = true;
		$this->entregaencuesta = true;
		if ($oCarreraSede) {
			// CONTROL DE DOCUMENTACION //
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			
			if ($oCarreraSede->getPlazocerttittramite()!="" and $fotocopialegtitulo==0) {
				$fechacert = date('Y-m-d', strtotime($this->alumno->getFechacerttittramite()));
				$plazocert = intval($oCarreraSede->getPlazocerttittramite());
		
				$fechavencimiento= date('Y-m-d', strtotime("$fechacert + $plazocert days"));
				if ($fechavencimiento < $fechaactual){
					$this->estadodocumentacion = false;
				}
			}
		
			// CONTROL DE ENTREGA DE ENCUESTAS //
			if ($oCarreraSede->getEntregaencuesta()==1) {
				$oEncuesta = Doctrine_Core::getTable('Encuestas')->obtenerUltimaEncuesta($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
				if ($oEncuesta) {
					$oEntrega = $this->alumno->obtenerUltimaEncuestaEntregada($oEncuesta->getIdencuesta());
					if(!$oEntrega){
						$this->entregaencuesta = false;
					}
				}
			}
		}
				
		////////////////////////////////////////////////
		// CONTROL ACTIVACION CICLO LECTIVO
		$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdCicloLectivoActual();
		$this->activo = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($idcicloactual, $request->getParameter('idalumno'));
		
		////////////////////////////////////////////////
		// CONTROL DE BORRADO A MESA DE EXAMEN
		if ($oCarreraSede->getPlazoborradoexamen()) {
			$this->plazoborrado = $oCarreraSede->getPlazoborradoexamen();
		} else {
			$this->plazoborrado = 0;
		}
		
		$this->fechaactual = date('Y-m-d');

		////////////////////////////////////////////////
		// MESAS DE EXAMENES HABILITADAS DE TIPO REGULAR
		// el uso del metodo de autogestion para Rosario es solo hasta fines de 2014
		$this->materiasregulares = $this->alumno->obtenerMateriasHabilitadas('R','R');
		
		$materiahabilitada = "";
		foreach ($this->materiasregulares as $materiahabilitada) {
			$oAluMat = Doctrine_Core::getTable('AluMat')->getUltimoEstado($this->alumno->getIdalumno(),$materiahabilitada['idcatedra']);
			if ($oAluMat and $oAluMat->getIdestadomateria()==3 and $oAluMat->getFechavencimiento() >= date('Y-m-d')) {				
				$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
		
				foreach ($oCatedra->obtenerMesasExamenes(MESASPUBLICADAS) as $mesapublicada) {
					if ($mesapublicada->getIdcondicion() ==TIPOMESAREGULAR) {
						$this->mesasdisponibles[$mesapublicada->getIdmesaexamen()] = $mesapublicada;
					}
				}
			}
		}
		////////////////////////////////////////////////
		// MESAS DE EXAMENES HABILITADAS DE TIPO LIBRE
		$this->materiaslibres = $this->alumno->obtenerMateriasHabilitadas('R','L');
		$materiahabilitada = "";
		foreach ($this->materiaslibres as $materiahabilitada) {
			$oAluMat = Doctrine_Core::getTable('AluMat')->getUltimoEstado($this->alumno->getIdalumno(),$materiahabilitada['idcatedra']);
			if ((!$oAluMat or $oAluMat->getIdestadomateria()!=3) or ($oAluMat and $oAluMat->getIdestadomateria()==3 and $oAluMat->getFechavencimiento() < date('Y-m-d'))) {
				$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
	
				foreach ($oCatedra->obtenerMesasExamenes(MESASPUBLICADAS) as $mesapublicada) {
					if ($mesapublicada->getIdcondicion() == TIPOMESALIBRE) {
						$this->mesasdisponibles[$mesapublicada->getIdmesaexamen()] = $mesapublicada;
					}
				}
			}
		}

		////////////////////////////////////////////////
		$this->mesasinscriptas = $this->alumno->obtenerMesasInscripto();
	}
	
	public function executeInscribirmateriasrendir(sfWebRequest $request) {
		$this->mensaje = "";
	
		$this->form = new BuscarCarrerasActivasAlumnosForm();
	}	
}