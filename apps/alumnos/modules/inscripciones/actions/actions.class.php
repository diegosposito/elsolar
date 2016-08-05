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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

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
						$mensajeb .=  "     ".$arrDias[$asigb->getDia()]." ".$asigb->getHorainicio()."-".$asigb->getHorafin()."\n";
					}
					$mensajea .=  "     ".$arrDias[$asiga->getDia()]." ".$asiga->getHorainicio()."-".$asiga->getHorafin()."\n";
				}
			}
		}
		$arrResultado['inscripta'] = $mensajea;
		$arrResultado['noinscripta'] = $mensajeb;
		echo json_encode($arrResultado);
			
		return sfView::NONE;
	}
	
	// Ver el historial del alumno en esa catedra
	public function executeVer(sfWebRequest $request)
	{
		$this->setLayout(false);
	
		// Obtiene el historial de examenes de ese alumno
		$this->examenes = Doctrine::getTable('Examenes')->getHistorialExamenes($request->getParameter('idalumno'), $request->getParameter('idcatedra'));
		
		$this->catedra = Doctrine_Core::getTable('Catedras')->find($request->getParameter('idcatedra'));
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->materiaplan = $this->catedra->getMateriasPlanes();
	}
		
	// Eliminar la inscripcion a examen
	public function executeEliminarinscripcionexamen(sfWebRequest $request)	{		 	
		// Obtiene la Mesa de exmamenes
		$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
		// Obtiene el Examene
		$oExamen = Doctrine_Core::getTable('Examenes')->getExamen($request->getParameter('idalumno'), $oMesaExamen->getIdmesaexamen());
		// Obtiene el ultimo estado de alumno en la catedra
		$oAluMat = Doctrine_Core::getTable('AluMat')->getUltimoEstado($request->getParameter('idalumno'),$oMesaExamen->getIdcatedra());
		
		if ($oAluMat) {
			if ($oAluMat->getIdestadomateria()==9) {
				if ($oExamen->getPromedio() >= NOTAAPROBACION) {
					$oAluMat->delete();
				}
			}	
		}
		// Si existe el objeto lo elimina	
		if($oExamen->delete()) {
			// Destinatario
			$oContacto = $oExamen->getAlumnos()->getPersonas()->getContacto();
			$destinatario = $oContacto->getEmail1();
			
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
			
			$msj = 'Se confirma que el alumno '.$oExamen->getAlumnos()->getPersonas().', '.$oExamen->getAlumnos()->getPersonas()->getTiposDocumentos().': '.$oExamen->getAlumnos()->getPersonas()->getNrodoc().' se ha sido eliminado correctamente a la mesa de examen.
		IdExamen: '.$oExamen->getIdexamen().'
		IdAlumno: '.$oExamen->getAlumnos()->getIdalumno().'
		Operación: Eliminación a Mesa de Examen
		IdMesaExamen: '.$oExamen->getIdmesaexamen().'				
		Materia: '.$oExamen->getMesasExamenes()->getCatedras()->getMateriasPlanes()->getMaterias().'
		Tipo: '.$oExamen->getMesasExamenes()->getCondicionesMesas().'				
		Fecha: '.$oExamen->getMesasExamenes()->getFecha().'
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
		
	// Inscribir a examen
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
			echo "El año de ingreso del alumno es posterior a la fecha de la mesa de examen seleccionada.\n";			
		}
		
		if($resultado == 0) {
			// Obtiene el objecto Examenes
			$oExamen = Doctrine_Core::getTable('Examenes')->getExamen($request->getParameter('idalumno'), $request->getParameter('idmesaexamen'));
				
			// Destinatario
			$oContacto = $this->alumno->getPersonas()->getContacto();
			$destinatario = $oContacto->getEmail1();
				
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
				
			$msj = 'Se confirma que el alumno '.$this->alumno->getPersonas().', '.$this->alumno->getPersonas()->getTiposDocumentos().': '.$this->alumno->getPersonas()->getNrodoc().' se ha inscripto correctamente a la mesa de examen.
		IdExamen: '.$oExamen->getIdexamen().'
		IdAlumno: '.$this->alumno->getIdalumno().'
		Operación: Inscripción a Mesa de Examen
		IdMesaExamen: '.$this->mesaexamen->getIdmesaexamen().'				
		Materia: '.$this->mesaexamen->getCatedras()->getMateriasPlanes()->getMaterias().'
		Tipo: '.$this->mesaexamen->getCondicionesMesas().' 
		Fecha: '.$this->mesaexamen->getFecha().'
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
	
	// Eliminar la inscripcion a examen
	public function executeEliminarinscripcionmateria(sfWebRequest $request)	{
		$oAluMat = Doctrine_Core::getTable('AluMat')->find($request->getParameter('id'));
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$oComision = $oAluMat->getComisiones();

		$fechaActual = date("Y-m-d");
		
		if ($oAluMat) {
			if($oAluMat->getIdestadomateria()==1) {
				// Se elimina el estado
				$oAluMat->delete();
								
				echo "Se ha eliminado correctamente a la materia.\n";
			} else {
				echo "No se ha podido eliminar a la materia.\n";
			}
		} else { 
			echo "No se ha podido eliminar a la materia.\n";
		}
		return sfView::NONE;
	}
	
	// Inscribir multiple a materia
	public function executeInscribirmateriamultiple(sfWebRequest $request){
		$msjMaterias = "";
		$mensaje = "";
		$resultado = 0;
		// Busca el alumno
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$materias_seleccionadas = $request->getParameter('case');
		$comisiones_seleccionadas = $request->getParameter('comisiones');

       // solo para controles de años completos aprobados
		$cicloMayor2011 = Doctrine_Core::getTable('CiclosLectivos')->getAlumnoTieneCicloLectivoMayor2011($this->alumno->getIdalumno());
		
		if(count($materias_seleccionadas) > 0) {
			foreach ($materias_seleccionadas as $materiaplan) {
				$idcomision = $comisiones_seleccionadas[$materiaplan];
				$control_anios_aprobados = true;

				// CONTROL SOLO PARA ARQUITECTURA DE AÑOS APROBADOS COMPLETOS
				//***********************************************************
				if(($this->alumno->getIdplanestudio()==18 || $this->alumno->getIdplanestudio()==19) && $cicloMayor2011) {
					$comision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
					$idmateriaplan = $comision->getCatedras()->getMateriasPlanes()->getIdmateriaplan();
				
					$control_anios_aprobados = Doctrine_Core::getTable('Correlatividades')->controlAnioCompleto($this->alumno->getIdalumno(), $this->alumno->getIdplanestudio(), $idmateriaplan);
				
					if (!$control_anios_aprobados)
						$resultado = 4;
				}

				// Inscribe el alumno a la materia
				if ($control_anios_aprobados) // solo es falso si falla el control en arquitectura
					$resultado = $this->alumno->inscribirMateria($idcomision);
				// Muestra un mensaje de acuerdo a resultado
				switch ($resultado) {
					case 1:
						$comision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
						$msjMaterias .= $comision->getCatedras()->getMateriasPlanes()->getMaterias()."\n";
						break;
					case 2:
						$mensaje .= $materiaplan.": El alumno ya se encuentra inscripto o regular a dicha materia.\n";
						break;
					case 3:
						$mensaje .= $materiaplan.": Se ha superado la capacidad maxima de la comisión.\n";
						break;
					case 4:
						$mensaje .= $materiaplan.": El alumno no tiene los años completos previos aprobados para cursar esta materia.\n";
						break;
				}
			}
		} 			
		if ($resultado == 0) {
			$mensaje = "No se ha seleccionado ninguna materia.\n";
		} elseif ($resultado == 1){
			$mensaje = "Se ha inscripto correctamente a la materia.\n";
			
			// Destinatario
			$oContacto = $this->alumno->getPersonas()->getContacto();
			$destinatario = $oContacto->getEmail1();

			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
			
			$msj = 'Se confirma que el alumno '.$this->alumno->getPersonas().', '.$this->alumno->getPersonas()->getTiposDocumentos().': '.$this->alumno->getPersonas()->getNrodoc().' se ha inscripto correctamente a las materias.
		IdAlumno: '.$this->alumno->getIdalumno().'
		Operación: Inscripción multiple a Materias
		Materias: \n'.$msjMaterias.'\n
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
		echo $mensaje;
		
		return sfView::NONE;
	}

	// Inscribir multiple a materia sin informar
	public function executeInscribirmateriamultiplesininformar(sfWebRequest $request){
		$msjMaterias = "";
		$mensaje = "";
		$resultado = 0;
		// Busca el alumno
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$materias_seleccionadas = $request->getParameter('case');
		$comisiones_seleccionadas = $request->getParameter('comisiones');
	
		// solo para controles de años completos aprobados
		$cicloMayor2011 = Doctrine_Core::getTable('CiclosLectivos')->getAlumnoTieneCicloLectivoMayor2011($this->alumno->getIdalumno());
	
		if(count($materias_seleccionadas) > 0) {
			foreach ($materias_seleccionadas as $materiaplan) {
				$idcomision = $comisiones_seleccionadas[$materiaplan];
				$control_anios_aprobados = true;
	
				// CONTROL SOLO PARA ARQUITECTURA DE AÑOS APROBADOS COMPLETOS
				//***********************************************************
				if(($this->alumno->getIdplanestudio()==18 || $this->alumno->getIdplanestudio()==19) && $cicloMayor2011) {
					$comision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
					$idmateriaplan = $comision->getCatedras()->getMateriasPlanes()->getIdmateriaplan();
	
					$control_anios_aprobados = Doctrine_Core::getTable('Correlatividades')->controlAnioCompleto($this->alumno->getIdalumno(), $this->alumno->getIdplanestudio(), $idmateriaplan);
	
					if (!$control_anios_aprobados)
						$resultado = 4;
				}
	
				// Inscribe el alumno a la materia
				if ($control_anios_aprobados) // solo es falso si falla el control en arquitectura
					$resultado = $this->alumno->inscribirMateria($idcomision);
				// Muestra un mensaje de acuerdo a resultado
				switch ($resultado) {
					case 1:
						$comision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
						$msjMaterias .= $comision->getCatedras()->getMateriasPlanes()->getMaterias()."\n";
						break;
					case 2:
						$mensaje .= $materiaplan.": El alumno ya se encuentra inscripto o regular a dicha materia.\n";
						break;
					case 3:
						$mensaje .= $materiaplan.": Se ha superado la capacidad maxima de la comisión.\n";
						break;
					case 4:
						$mensaje .= $materiaplan.": El alumno no tiene los años completos previos aprobados para cursar esta materia.\n";
						break;
				}
			}
		}
		if ($resultado == 0) {
			$mensaje = "No se ha seleccionado ninguna materia.\n";
		} elseif ($resultado == 1){
			$mensaje = "Se ha inscripto correctamente a la materia.\n";
		}
		echo $mensaje;
	
		return sfView::NONE;
	}	
	
	// Inscribir a materia
	public function executeInscribirmateria(sfWebRequest $request){	
		// Busca el alumno		
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
                
		$control_anios_aprobados = true;

		// solo para controles de años completos aprobados
		$cicloMayor2011 = Doctrine_Core::getTable('CiclosLectivos')->getAlumnoTieneCicloLectivoMayor2011($this->alumno->getIdalumno());
		
       	// CONTROL SOLO PARA ARQUITECTURA DE AÑOS APROBADOS COMPLETOS
		//***********************************************************
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
						
		return sfView::NONE;
	}

	public function executeObtenermateriaspreuniversitario(sfWebRequest $request) {       
		$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->alumnopre = Doctrine_Core::getTable('Alumnos')->buscarAlumno($this->alumno->getIdpersona(), 168);
		///////////////////////////////////////////////////
		// CHEQUEAR EL CONTENIDO DE LOS SIGUIENTES METODOS 
		///////////////////////////////////////////////////		
		$this->materiashabilitadas = $this->alumno->obtenerMateriasHabilitadasPreuniversitario();

		$this->materiasinscriptas = $this->alumno->obtenerMateriasInscriptoPreuniversitario();
	}
		
	public function executeObtenermateriascursar(sfWebRequest $request) {     
		$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->alumno->getIdplanestudio());
		$this->controlarhorarios = $oPlanEstudio->controlarHorarios();
		$curso_limite = 10;
		
		$this->fechaactual = date('Y-m-d');
			
		$this->materiashabilitadas = array();
		$this->materiasinscriptas = array();
		
		// CONTROL LIBREDEUDA //
		$this->administracion = new Administracion();
		// debo verificar si son cursos o preuniversitario para no controlar en esos casos el libredeuda
		$this->planesestudios = Doctrine_Core::getTable('PlanesEstudios')->find($this->alumno->getIdplanestudio());
		$idtc= $this->planesestudios->getCarreras()->getIdtipocarrera(); 

		if($idtc==2 || $idtc==6){
			$fechalibredeuda=$this->fechaactual;
		} else {
			$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc()); 
		}

		if(($fechalibredeuda >= $this->fechaactual) && !(is_array($fechalibredeuda))) {
			$this->estadolibredeuda = true; 
		} else {
			$this->estadolibredeuda = false;
		}

		// CONTROLES ADICIONALES //
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		$this->estadodocumentacion = true;
		$this->entregaencuesta = true;
		if ($oCarreraSede) {
			// CONTROL DE DOCUMENTACION //

			// CONTROL DE DOCUMENTACION DE PROFESORADO DE ENSEÑANZA SUPERIOR //
			if ($idtc==10){
				$fotocopialegtitulopregrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),37);
				$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
				if ($fotocopialegtitulopregrado==0 and $fotocopialegtitulogrado ==0) {
					$this->estadodocumentacion = false;
				}
			}		
			
			// CONTROL DE PLAZO DE TITULO EN TRAMITE
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			if ($oCarreraSede->getPlazocerttittramite()!="" and $fotocopialegtitulo==0) {
				$fechacert = date('Y-m-d', strtotime($this->alumno->getFechacerttittramite()));
				$plazocert = intval($oCarreraSede->getPlazocerttittramite());
		
				$fechavencimiento= date('Y-m-d', strtotime("$fechacert + $plazocert days"));
				if ($fechavencimiento < $this->fechaactual){
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
		
		///////////////////////////////////////////////////
		// CHEQUEAR EL CONTENIDO DE LOS SIGUIENTES METODOS 
		///////////////////////////////////////////////////	
		$this->comisiones_con_cupo = $this->planesestudios->obtenerComisionesConCupo($this->idsede);

		$this->materias = $this->alumno->obtenerMateriasHabilitadas('C', 'R');
		
		$this->materiasinscriptas = $this->alumno->obtenerMateriasInscripto();
		
		foreach ($this->materias as $materiahabilitada) {
			$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
			if (!in_array($oCatedra->getIdcatedra(), array_keys($this->materiasinscriptas))) {
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
					if($curso_limite>=$oCatedra->getMateriasPlanes()->getAnodecursada()){
						$this->materiashabilitadas[$oCatedra->getIdcatedra()] = $oCatedra;
					}
				}
			}
		}		
		
	}

	public function executeConsultarmateriasaprobar(sfWebRequest $request) {   
 		$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$fechaactual = date('Y-m-d');
		
		$this->mesascreadas = array();
		$this->mesasdisponibles = array();
		
		// CONTROL LIBREDEUDA //
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc()); 

		if(($fechalibredeuda >= $fechaactual) and (!is_array($fechalibredeuda))) {
			$this->estadolibredeuda = true; 
		} else {
			$this->estadolibredeuda = false;
		}

		$this->detalle_materias = Doctrine_Core::getTable('Correlatividades')->getCorrelativasAlumno($request->getParameter('idalumno'), $this->alumno->getIdplanestudio(), 'R', 'R');
	}

	public function executeObtenermateriasaprobar(sfWebRequest $request) {     
		$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$fechaactual = date('Y-m-d');
		
		$this->mesasdisponibles = array();
		
		// CONTROL LIBREDEUDA //
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($request->getParameter('idalumno'),$this->alumno->getPersonas()->getNrodoc()); 

		if(($fechalibredeuda >= $fechaactual) and (!is_array($fechalibredeuda))) {
			$this->estadolibredeuda = true; 
		} else {
			$this->estadolibredeuda = false;
		}

		// CONTROLES ADICIONALES //
		$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->idsede);
		$this->estadodocumentacion = true;
		if ($oCarreraSede) {
			// CONTROL DE DOCUMENTACION //
			
			// CONTROL DE DOCUMENTACION DE PROFESORADO DE ENSEÑANZA SUPERIOR //
			if ($idtc==10){
				$fotocopialegtitulopregrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),37);
				$fotocopialegtitulogrado = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),22);
				if ($fotocopialegtitulopregrado==0 and $fotocopialegtitulogrado ==0) {
					$this->estadodocumentacion = false;
				}
			}
			// CONTROL DE PLAZO DE TITULO EN TRAMITE
			$fotocopialegtitulo = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionPlanEstudio($this->alumno->getIdalumno(),9);
			if ($oCarreraSede->getPlazocerttittramite()!="" and $fotocopialegtitulo==0) {
				$fechacert = date('Y-m-d', strtotime($this->alumno->getFechacerttittramite()));
				$plazocert = intval($oCarreraSede->getPlazocerttittramite());
			
				$fechavencimiento= date('Y-m-d', strtotime("$fechacert + $plazocert days"));
				if ($fechavencimiento < $fechaactual){
					$this->estadodocumentacion = false;
				}
			}
		}	

		$arrTiposMesas = array(1 => 'R', 2 => 'L', 3 => 'P', 5 =>'E');
		// R SON MESAS DE TIPO REGULAR
		// L SON MESAS DE TIPO LIBRE
		// P SON MESAS DE TIPO PROMOCION
		// E SON MESAS DE TIPO EQUIVALENCIA
		
		foreach ($arrTiposMesas as $k => $v) {
			$this->materiashabilitadas = $this->alumno->obtenerMateriasHabilitadas('R',$v);
			$materiahabilitada = "";
			foreach ($this->materiashabilitadas as $materiahabilitada) {
				$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
				// Si no esta activa y es una materia generia debe buscar las materias optativas que la contienen
				if ($oCatedra->getActiva()==0 and $materiahabilitada['generica']==4) {
					$materiasOptativas = $oCatedra->getMateriasPlanes()->obtenerMateriasComponentes();
					foreach ($materiasOptativas as $matopt) {
						$oMateriaOptativa = Doctrine_Core::getTable('MateriasPlanes')->find($matopt['idmateriaplan']);
						$oCatedraOptativa = $oMateriaOptativa->obtenerCatedra($oCatedra->getIdsede());
							
						$tieneRegular = Doctrine::getTable('AluMat')->tieneRegular($this->alumno->getIdalumno(),$matopt['idmateriaplan']);
						if ($oCatedraOptativa->getActiva()==1 and $tieneRegular==1){
							foreach ($oCatedraOptativa->obtenerMesasExamenesDisponibles() as $mesa) {
								if ($mesa->getIdcondicion() == $k) {
									$this->mesasdisponibles[$mesa->getIdmesaexamen()] = $mesa;
								}
							}
						}
					}
				} else {
					foreach ($oCatedra->obtenerMesasExamenesDisponibles() as $mesa) {
						if ($mesa->getIdcondicion() == $k) {
							$this->mesasdisponibles[$mesa->getIdmesaexamen()] = $mesa;
						}
					}
				}
			}			
		} 
		////////////////////////////////////////////////
		$this->mesasinscriptas = $this->alumno->obtenerMesasInscripto();
	}
	
	public function executeInscribiraspirante(sfWebRequest $request)	{
		$this->form = new InscripcionesAspiranteForm();
		$this->form->setDefault('tipodocumento', $request->getParameter('tipodocumento'));
		$this->form->setDefault('nrodocumento', $request->getParameter('nrodocumento'));
	}		
		
	public function executeInscribirmateriaspreuniversitario(sfWebRequest $request)	{
		$this->form = new BuscarAlumnosPreuniversitarioForm();	

		if ($request->isMethod('post')) {
			$arregloBuscador = $request->getParameter($this->form->getName());
			$this->form->bind($arregloBuscador);

			$this->idplanestudio = $arregloBuscador['idplanestudio'];
        	$this->tipocriterio = $arregloBuscador['tipocriterio'];
        	$this->criterio = $arregloBuscador['criterio'];
        	$this->idciclolectivo = $arregloBuscador['idciclolectivo'];

        	$this->resultado = Doctrine_Core::getTable('Alumnos')->buscarAlumnosPorCiclo($this->tipocriterio, $this->criterio, $this->idplanestudio, $this->idciclolectivo);			
		} else {
			$this->resultado = array();
		}
	}	
		
	public function executeInscribirmateriascursar(sfWebRequest $request)	{
	
	}
	
	public function executeInscribirmateriasrendir(sfWebRequest $request)	{
	
	}	

	public function executeConsultarmateriasrendir(sfWebRequest $request)	{
	
	}
	
	public function executeBuscarpersona(sfWebRequest $request)	{
		$this->form = new BuscarPersonasForm();
	}	
}
