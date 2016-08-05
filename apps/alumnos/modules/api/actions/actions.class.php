<?php

/**
 * api actions.
 *
 * @package    sig
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
	
	public function executeEliminarinscripcionexamen(sfWebRequest $request)	{
		// Obtiene el objecto Examenes
		$oExamen = Doctrine_Core::getTable('Examenes')->getExamen($request->getParameter('idalumno'), $request->getParameter('idmesaexamen'));
		// Si existe el objeto lo elimina
		if($oExamen->delete()) {
			// Destinatario
			$destinatario = $request->getParameter('email');
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
				
			$msj = 'Se confirma que el alumno '.$oExamen->getAlumnos()->getPersonas().', '.$oExamen->getAlumnos()->getPersonas()->getTiposDocumentos().': '.$oExamen->getAlumnos()->getPersonas()->getNrodoc().' se ha sido eliminado correctamente a la mesa de examen.
		IdAlumno: '.$oExamen->getAlumnos()->getIdalumno().'
		Operación: Eliminación a Mesa de Examen
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
	
	public function executeInscribirmesa(sfWebRequest $request)	{
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
			// Destinatario
			$destinatario = $request->getParameter('email');
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
			
			$msj = 'Se confirma que el alumno '.$this->alumno->getPersonas().', '.$this->alumno->getPersonas()->getTiposDocumentos().': '.$this->alumno->getPersonas()->getNrodoc().' se ha inscripto correctamente a la mesa de examen.
		IdAlumno: '.$this->alumno->getIdalumno().'
		Operación: Inscripción a Mesa de Examen
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
	
	public function executeObtenermesasrendir(sfWebRequest $request) {
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->idsede = $this->alumno->getIdsede();
		
		$this->mesasdisponibles = array();
		
		// Obtener la fecha actual
		$hoy = date('Y-m-d');
		
		////////////////////////////////////////////////
		// CONTROL DE ULTIMA SOLICITUD DE LIBRE DEUDA
		$oSolicitudLibreDeuda = $this->alumno->obtenerUltimaSolicitudLibredeuda();
		// Controla que no se haya solicitado otro libredeuda en ese mismo dia
		$this->solicitudpermitida = 1;
		if ($oSolicitudLibreDeuda) {
			if ($oSolicitudLibreDeuda->getFecha()==$hoy) {
				$this->solicitudpermitida = 0;
			}
		}
		
		////////////////////////////////////////////////
		// CONTROL DE PERIODO DE INSCRIPCION
		// Se debe verificar si esta en periodo de inscripcion
		$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());
		
		$fechas = $oCalendario->obtenerFechasPorTipo(5);
		// Controla que la fecha actual este dentro de un periodo de inscripcion
		$this->periodohabilitado = 0;
		foreach ($fechas as $fecha) {
			if(strtotime($hoy) >= strtotime($fecha->getInicio()) && strtotime($hoy) <= strtotime($fecha->getFin())) {
				$this->periodohabilitado = 1;
			}
		}
		// Controla que el alumno haya presentada la documentacion obligatoria
		// Aqui se tendria que verificar segun la carrera el requicito de titulo secundario o titulo de grado!!!!
		$this->documentacionhabilitada = 0;
		$idtipocarrera = $this->alumno->getPlanesEstudios()->getCarreras()->getIdtipocarrera();
		$certtittramite = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),8);
		
		if ($idtipocarrera==8 or $idtipocarrera==10) {
			$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
			if(($certtittramite==1) or ($this->alumno->getFotocopialegtitulogrado()==1)) {
				$this->documentacionhabilitada = 1;
			}
		} else {
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			if(($certtittramite==1) or ($fotocopialegtitulo==1)) {
				$this->documentacionhabilitada = 1;
			}
		}
		
		////////////////////////////////////////////////
		// CONTROL LIBREDEUDA
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc());
		
		if($fechalibredeuda >= date('Y-m-d') and !is_array($fechalibredeuda)) {
			$this->estadolibredeuda = 1;
		} else {
			$this->estadolibredeuda = 0;
		}
		
		////////////////////////////////////////////////
		// CONTROLES ADICIONALES
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		$this->estadodocumentacion = 1;
		$this->entregaencuesta = 1;
		if ($oCarreraSede) {
			// CONTROL DE DOCUMENTACION //
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
				
			if ($oCarreraSede->getPlazocerttittramite()!="" and $fotocopialegtitulo==0) {
				$fechacert = date('Y-m-d', strtotime($this->alumno->getFechacerttittramite()));
				$plazocert = intval($oCarreraSede->getPlazocerttittramite());
		
				$fechavencimiento= date('Y-m-d', strtotime("$fechacert + $plazocert days"));
				if ($fechavencimiento < $fechaactual){
					$this->estadodocumentacion = 0;
				}
			}
		
			// CONTROL DE ENTREGA DE ENCUESTAS //
			if ($oCarreraSede->getEntregaencuesta()==1) {
				$oEncuesta = Doctrine_Core::getTable('Encuestas')->obtenerUltimaEncuesta($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
				if ($oEncuesta) {
					$oEntrega = $this->alumno->obtenerUltimaEncuestaEntregada($oEncuesta->getIdencuesta());
					if(!$oEntrega){
						$this->entregaencuesta = 0;
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
	}
	
	public function executeObtenermesasinscriptas(sfWebRequest $request) {
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));		
		$this->idsede = $this->alumno->getIdsede();
	
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		
		////////////////////////////////////////////////
		// CONTROL DE BORRADO A MESA DE EXAMEN
		if ($oCarreraSede->getPlazoborradoexamen()) {
			$this->plazoborrado = $oCarreraSede->getPlazoborradoexamen();
		} else {
			$this->plazoborrado = 0;
		}
		$this->fechaactual = date('Y-m-d');		
		
		$this->mesasinscriptas = $this->alumno->obtenerMesasInscripto();	
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
	
		// Obtener el id_usuario
		$this->id_usuario = Doctrine_Core::getTable('sfGuardUser')->buscarEmail($request->getParameter('email'));
		
		// Remitente
		$remitente = $request->getParameter('email');
			
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
			$oSolicitudLibredeuda->setIdusuarioorigen($this->id_usuario);
			$oSolicitudLibredeuda->setIdusuariodestino($k);
			$oSolicitudLibredeuda->setIdalumno($oAlumno->getIdalumno());
			$oSolicitudLibredeuda->setIdestadosolicitud(1);
			$oSolicitudLibredeuda->setMensaje($msj);
			$oSolicitudLibredeuda->setFecha($hoy);
			$oSolicitudLibredeuda->save();
		}
			
		if ($resultado) {
			$this->mensaje = "Se ha enviado correctamente la Solicitud de libre deuda.";
		} else {
			$this->mensaje = "No se ha podido enviar la Solicitud de libre deuda.\nCompruebe que las cuenta de correo remitente o destinataria funcionen correctamente.\n"."REMITENTE: ".$remitente."- DESTINATARIO:".$destinatario;
		}
	}	
	
	public function executeInscribirmateria(sfWebRequest $request){
		$this->mensaje = "";
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
				$this->mensaje = "Se ha inscripto correctamente a la materia.";
				break;
			case 2:
				$this->mensaje = "El alumno ya se encuentra inscripto o regular a dicha materia.";
				break;
			case 3:
				$this->mensaje = "Se ha superado la capacidad maxima de la comisión.";
				break;
			case 4:
				$this->mensaje = "El alumno no tiene los años completos previos aprobados para cursar esta materia.";
				break;
		}
	
		if($resultado == 1) {
			$this->comision = Doctrine_Core::getTable('Comisiones')->find($request->getParameter('idcomision'));
			// Destinatario
			$destinatario = $request->getParameter('email');
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
	}
		
	public function executeEliminarinscripcionmateria(sfWebRequest $request)	{
		$this->mensaje = "";
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
				$destinatario = $request->getParameter('email');
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
	
				$this->mensaje = "Se ha eliminado correctamente a la materia.";
			} else {
				$this->mensaje = "No se ha podido eliminar a la materia.";
			}
		} else {
			$this->mensaje = "No se ha podido eliminar a la materia.";
		}
	}	
		
	public function executeObtenermateriascursar(sfWebRequest $request) {
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->idsede = $this->alumno->getIdsede();
	
		$this->materiashabilitadas = array();
	
		// Obtener la fecha actual
		$hoy = date('Y-m-d');
		$fechaactual = date('Y-m-d');
	
		////////////////////////////////////////////////
		// CONTROL DE ULTIMA SOLICITUD DE LIBRE DEUDA
		$oSolicitudLibreDeuda = $this->alumno->obtenerUltimaSolicitudLibredeuda();
		// Controla que no se haya solicitado otro libredeuda en ese mismo dia
		$this->solicitudpermitida = 1;
		if ($oSolicitudLibreDeuda) {
			if ($oSolicitudLibreDeuda->getFecha()==$hoy) {
				$this->solicitudpermitida = 0;
			}
		}
			
		////////////////////////////////////////////////
		// CONTROL DE PERIODO DE INSCRIPCION
		// Se debe verificar si esta en periodo de inscripcion
		$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());
		
		$fechas = $oCalendario->obtenerFechasPorTipo(4);
		// Controla que la fecha actual este dentro de un periodo de inscripcion
		$this->periodohabilitado = 0;
		$this->periododecursada = 0;
		foreach ($fechas as $fecha) {
			if(strtotime($hoy) >= strtotime($fecha->getInicio()) && strtotime($hoy) <= strtotime($fecha->getFin())) {
				$this->periodohabilitado = 1;
				$periodos = Doctrine_Core::getTable('PeriodosCursadas')->findByIdfecha($fecha->getIdfecha());
				foreach ($periodos as $periodo) {
					$this->periododecursada = $periodo->getPeriododecursada();
				}
			}
		}
	
		// Controla que el alumno haya presentada la documentacion obligatoria
		// Aqui se tendria que verificar segun la carrera el requicito de titulo secundario o titulo de grado!!!!
		$this->documentacionhabilitada = 0;
		$idtipocarrera = $this->alumno->getPlanesEstudios()->getCarreras()->getIdtipocarrera();
		$certtittramite = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),8);
		
		if ($idtipocarrera==8 or $idtipocarrera==10) {
			$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
			if(($certtittramit==1) or ($fotocopialegtitulogrado==1)) {
				$this->documentacionhabilitada = 1;
			}
		} else {
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			if(($certtittramit==1) or ($fotocopialegtitulo==1)) {
				$this->documentacionhabilitada = 1;
			}
		}
				
		////////////////////////////////////////////////
		// CONTROL LIBREDEUDA
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc());
		if($fechalibredeuda >= date('Y-m-d') and !is_array($fechalibredeuda)) {
			$this->estadolibredeuda = 1;
		} else {
			$this->estadolibredeuda = 0;
		}
	
		////////////////////////////////////////////////
		// CONTROLES ADICIONALES
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		$this->estadodocumentacion = 1;
		$this->entregaencuesta = 1;
		if ($oCarreraSede) {
			// CONTROL DE DOCUMENTACION //
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
				
			if ($oCarreraSede->getPlazocerttittramite()!="" and $fotocopialegtitulo==0) {
				$fechacert = date('Y-m-d', strtotime($this->alumno->getFechacerttittramite()));
				$plazocert = intval($oCarreraSede->getPlazocerttittramite());
				$fechavencimiento= date('Y-m-d', strtotime("$fechacert + $plazocert days"));
				if ($fechavencimiento < $hoy){
					$this->estadodocumentacion = 0;
				}
			}
			// CONTROL DE ENTREGA DE ENCUESTAS //
			if ($oCarreraSede->getEntregaencuesta()==1) {
				$oEncuesta = Doctrine_Core::getTable('Encuestas')->obtenerUltimaEncuesta($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
				if ($oEncuesta) {
					$oEntrega = $this->alumno->obtenerUltimaEncuestaEntregada($oEncuesta->getIdencuesta());
					if(!$oEntrega){
						$this->entregaencuesta = 0;
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
			$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
			if($this->idsede == $oCatedra->getIdsede()) {
				$this->materiashabilitadas[$oCatedra->getIdcatedra()] = $oCatedra;
			}
		}
	}

	public function executeObtenermateriasinscriptas(sfWebRequest $request) {
		// Obtener la fecha actual
		$hoy = date('Y-m-d');
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	
		////////////////////////////////////////////////
		// CONTROL DE PERIODO DE INSCRIPCION
		// Se debe verificar si esta en periodo de inscripcion
		$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());
	
		$fechas = $oCalendario->obtenerFechasPorTipo(4);
		// Controla que la fecha actual este dentro de un periodo de inscripcion
		$this->periodohabilitado = 0;
		$this->periododecursada = 0;
		foreach ($fechas as $fecha) {
			if(strtotime($hoy) >= strtotime($fecha->getInicio()) && strtotime($hoy) <= strtotime($fecha->getFin())) {
				$this->periodohabilitado = 1;
				$periodos = Doctrine_Core::getTable('PeriodosCursadas')->findByIdfecha($fecha->getIdfecha());
				foreach ($periodos as $periodo) {
					$this->periododecursada = $periodo->getPeriododecursada();
				}
			}
		}
	
		$this->materiasinscriptas = $this->alumno->obtenerMateriasInscripto();
	}	
	
  public function executeObteneridusuario(sfWebRequest $request)
  { 	
  	$this->id_usuario = Doctrine_Core::getTable('sfGuardUser')->buscarEmail($request->getParameter('email'));
  	$oProfile = Doctrine_Core::getTable('Profile')->obtenerPerfil($this->id_usuario);
  	$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($oProfile->getTipodoc(), $oProfile->getNrodoc());
	$this->id_persona = $oPersona->getIdpersona();
  }  
  
  public function executeObtenercarrerasinscripto(sfWebRequest $request)
  {
  	$oPersona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
  	$this->carreras_inscripto = $oPersona->getCarrerasinscripto();
  }
  
  public function executeObtenercalendario(sfWebRequest $request)
  {
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	
 	$this->calendario = Doctrine_Core::getTable('Calendarios')
		->createQuery('a')
		->where('idsede='.$oAlumno->getIdsede())
		->andWhere('idfacultad = '.$oAlumno->getPlanesEstudios()->getCarreras()->getIdfacultad())
		->andWhere('activo = 1')
		->orderBy('anio DESC')
		->fetchOne();      

	$this->fechas = Doctrine_Core::getTable('FechasCalendario')
		->createQuery('a')
		->where('idcalendario='.$this->calendario->getIdcalendario())
		->execute();
  }  
  
  public function executeObtenerhistorial(sfWebRequest $request)
  {
  	$this->alu_mats = Doctrine_Core::getTable('AluMat')
  		->createQuery('am')
  		->innerJoin('am.Catedras ca')
  		->innerJoin('ca.MateriasPlanes mp')
  		->innerJoin('mp.Materias ma')
  		->innerJoin('am.Alumnos a')
  		->where('a.idalumno='.$request->getParameter('idalumno'))
  		->andWhere('am.idestadomateria=3 or am.idestadomateria=1 or am.idestadomateria=9')
  		->orderBy('am.idestadomateria DESC')
  		->addOrderBy('mp.anodecursada')
  		->addOrderBy('mp.orden')
  		->execute();  	
  }  	
  
  
  public function executeObtenersolicitudes(sfWebRequest $request)
  {
	// obtener identificador de datos a mostrar -> resueltas = 1   no resueltas = 0
	$this->resuelta = ($request->getParameter('resuelta')) ? $request->getParameter('resuelta') : 0 ;
  	
	$this->solicitudes = Doctrine_Core::getTable('Solicitudes')
		->createQuery('a')
		->where('idusuario = ?' , $request->getParameter('idusuario'))
		->andWhere('resuelta = ?', $this->resuelta)
		->orderBy('created_at DESC')
		->execute();    	
  }

  public function executeObtenersolicitud(sfWebRequest $request)
  {
  	$this->solicitud = Doctrine_Core::getTable('Solicitudes')->find($request->getParameter('idsolicitud'));
  }
  
  public function executeGuardarsolicitud(sfWebRequest $request)
  {
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	 
  	$oSolicitud = new Solicitudes();
  	$oSolicitud->setIdcarrera($oAlumno->getPlanesEstudios()->getIdcarrera());
  	$oSolicitud->setIdusuario($request->getParameter('idusuario'));
  	$oSolicitud->setIdsede($oAlumno->getIdsede());
  	$oSolicitud->setDescripcion($request->getParameter('solicitud'));
  	$oSolicitud->setResuelta(0);
  	$oSolicitud->save();
  	
  	$this->mensaje = "El estudio previo ha sido guardado correctamente.";
  	
  }  
}