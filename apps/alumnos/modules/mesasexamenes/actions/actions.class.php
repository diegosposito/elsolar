<?php

/**
 * mesasexamenes actions.
 *
 * @package    sig
 * @subpackage mesasexamenes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mesasexamenesActions extends sfActions
{ 
	// Obtiene si se permite la modalidad de alumno libre en dicho Plan de Estudios
	public function executePermitemodalidadlibre(sfWebRequest $request)
	{
		$oPlanEstudio =  Doctrine::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
	
		echo $oPlanEstudio->getModalidadalumnolibre();
	
		return sfView::NONE;
	}
		
	// Guardar la fecha de la mesa de examen
	public function executeGuardarfechaexamen(sfWebRequest $request)
	{
		$arr = explode('-', $request->getParameter('fecha'));
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		$hora = $request->getParameter('hora');
		$fechaactual = date("Y-m-d");				
		$oMesaExamen = Doctrine_Core::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
		$fechaanterior = $oMesaExamen->getFecha();
		$horaanterior = $oMesaExamen->getHora();
		$oMesaExamen->setFecha($fecha);
		$oMesaExamen->setHora($hora);
		$oMesaExamen->save();
		
		// Si la mesa de examen ya se encuentra publicada hay que publicar la noticia
		if (($oMesaExamen->getIdestadomesaexamen()==2) and ($fecha != $fechaanterior)) {
			$materia = $oMesaExamen->getCatedras()->getMateriasPlanes();
			$carrera = $materia->getPlanesEstudios()->getCarreras();
			
			// Crea la noticia
			$oNoticia = new Noticias();
			$oNoticia->setTitulo($materia." - Modificación de fecha de mesa de exámen");
			$oNoticia->setIntro("<p>Se ha modificado la fecha de una mesa de exámen de la materia ".$materia."</p>");
			$oNoticia->setDescripcion("<p>Se ha modificado la fecha de la siguiente mesa de exámen:</p>
					Materia: ".$materia."<br>
					Condición: ".$oMesaExamen->getCondicionesMesas()."<br>
					Fecha: ".$fecha);
			$oNoticia->setInicio($fechaactual);				
			$oNoticia->setFin($fecha);
			$oNoticia->setOrden(1);
			$oNoticia->setLeerMas(1);
			$oNoticia->setIsActive(0);
			$oNoticia->setPrivada(0);
			$oNoticia->setIdusuario($this->getUser()->getGuardUser()->getId());
			$oNoticia->save();
			
			// Asigna la noticia a la carrera
			$oNoticiaCarrera = new NoticiasCarrera();
			$oNoticiaCarrera->setIdnoticia($oNoticia->getId());
			$oNoticiaCarrera->setIdcarrera($carrera->getIdcarrera());
			$oNoticiaCarrera->save();
			$destinatario = array();
			$inscriptos = $oMesaExamen->obtenerInscriptos(1);
			
			foreach ($inscriptos as $inscripto) {
				$oContacto = $inscripto->getAlumnos()->getPersonas()->getContacto();
				$destinatario[$oContacto->getEmail1()] = $inscripto->getAlumnos()->getPersonas();
			}
			// Remitente
			$remitente = "sistemas@ucu.edu.ar";
			
			$msj = 'Se informa que se ha modificado la fecha de la siguiente mesa de exámen: 
		Materia: '.$materia.'
		Condición: '.$oMesaExamen->getCondicionesMesas().'
		Fecha: '.$fecha;
			
			$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
			
			$resultado = $this->getMailer()->composeAndSend(
					$remitente,
					$destinatario,
					'SAO - Modificación de fecha de Mesa de Exámen: '. $materia,
					$mensajeEmail
			);
		}		
		
		echo "Se ha guardado correctamente la mesa de examen.\n";
		
		return sfView::NONE;
	}
		
	// Modificar la fecha de la mesa de examen
	public function executeModificarfechaexamen(sfWebRequest $request)
	{
		$this->mesa = Doctrine_Core::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
		$fecha = explode("-", $this->mesa->getFecha());
		$this->fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];

		$oLlamado =  $this->mesa->getLlamadosTurno();
		
		$arr = explode('-', $oLlamado->getInicio());
		$this->inicio = $arr[2]."-".$arr[1]."-".$arr[0];
		$arr = explode('-', $oLlamado->getFin());
		$this->fin = $arr[2]."-".$arr[1]."-".$arr[0];		
	}
	
  // Anula la mesa de examen
  public function executeRegistrarausente(sfWebRequest $request)
  {
	// Obtengo el examen
	$oExamen = Doctrine::getTable('Examenes')->find($request->getParameter('idexamen'));

	// Guarda los valores en el objeto
	$oExamen->setPromedio($request->getParameter('estado'));
	$oExamen->save();

	echo "Se ha guardado correctamente el examen.\n";

	return sfView::NONE;
  }
		
  // Ver la mesa de examen
  public function executeVerinscriptos(sfWebRequest $request)
  {
	$this->setLayout(false);
  	$this->alumnos = array();
  	$this->notas = array();

	// Obtiene la mesa de examen dependiendo de los parametros ingresados
	$this->mesaexamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));

	$this->materiaplan = $this->mesaexamen->getCatedras()->getMateriasPlanes();
   	$this->materia = $this->materiaplan->getMaterias();
    $this->carrera = $this->materiaplan->getPlanesEstudios()->getCarreras();
    $this->condicion = $this->mesaexamen->getCondicionesMesas();
   	$this->mesa = $this->mesaexamen->getFecha();
   	$this->libro = $this->mesaexamen->getLibrosActas();
   	$this->idlibro = $this->mesaexamen->getIdlibroacta();
   	$this->folio = $this->mesaexamen->getFolio();
   	$this->idmesaexamen = $this->mesaexamen->getIdmesaexamen();
   	$this->idestado = $this->mesaexamen->getIdestadomesaexamen();
   	$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    	
    // Obtiene los inscriptos a una mesa de examen 
	$this->inscriptos = $this->mesaexamen->obtenerInscriptos();
 		
	foreach($this->inscriptos as $inscripto) {
		$this->alumnos[$inscripto->getIdalumno()] = $inscripto->getAlumnos();
		$oExamen = Doctrine::getTable('Examenes')->getExamen($inscripto->getIdalumno(),$this->mesaexamen->getIdmesaexamen());
		$this->notas[$inscripto->getIdalumno()] = $oExamen->getPromedio();
		//$this->notas[$inscripto->getIdalumno()] = $inscripto->getIdalumno() ." - ".$this->mesaexamen->getIdmesaexamen();
	}
  }  
  	
  // Ver la mesa de examen
  public function executeVer(sfWebRequest $request)
  {
  	$this->alumnos = "";
	$this->notaEscrita = "";
	$this->notaOral = "";
	$this->notaPromedio = "";
	// Obtiene la mesa de examen dependiendo de los parametros ingresados
	$this->mesaexamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));

	$this->materiaplan = $this->mesaexamen->getCatedras()->getMateriasPlanes();
   	$this->materia = $this->materiaplan->getMaterias();
    $this->carrera = $this->materiaplan->getPlanesEstudios()->getCarreras();
    $this->condicion = $this->mesaexamen->getCondicionesMesas();
   	$this->mesa = $this->mesaexamen->getFecha();
   	$this->libro = $this->mesaexamen->getLibrosActas();
   	$this->idlibro = $this->mesaexamen->getIdlibroacta();
   	$this->folio = $this->mesaexamen->getFolio();
   	$this->idmesaexamen = $this->mesaexamen->getIdmesaexamen();
   	$this->idestado = $this->mesaexamen->getIdestadomesaexamen();
   	$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    	
    // Obtiene los inscriptos a una mesa de examen 
	$this->inscriptos = $this->mesaexamen->obtenerInscriptos();
 		
	foreach($this->inscriptos as $inscripto) {
		$this->alumnos[$inscripto->getIdalumno()] = $inscripto->getAlumnos();
		$oExamen = Doctrine::getTable('Examenes')->getExamen($inscripto->getIdalumno(),$this->mesaexamen->getIdmesaexamen());
		$this->notaEscrita[$inscripto->getIdAlumno()] = $oExamen->getEscrito();
		$this->notaOral[$inscripto->getIdAlumno()] = $oExamen->getOral();
		$this->notaPromedio[$inscripto->getIdAlumno()] = $oExamen->getPromedio();	
	}
  }  
	
  // Obtener cupo de la mesa de examen
  public function executeObtenercupo(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	if(!$oMesaExamen){
		$resultado = "No existe ninguna mesa de examen";  			
  	}else{
  		$cantidadInscriptos = count($oMesaExamen->obtenerInscriptos());

  		if ($cantidadInscriptos > 25) {
			$resultado = "La mesa creada para promocion ya esta completa.";
  		} else {	
  			$posiblesInscriptos = 25 - $cantidadInscriptos;
			$resultado = "Usted solo podra registrar ". $posiblesInscriptos ." promociones.";
		}
  	}
	echo $resultado;
	
	return sfView::NONE;
  }  

  // Obtener cupo de la mesa de examen
  public function executeObtenercupoautogestion(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	if(!$oMesaExamen){
		$resultado = "No existe ninguna mesa de examen";  			
  	}else{
  		$cantidadInscriptos = count($oMesaExamen->obtenerInscriptos());

  		if ($cantidadInscriptos > 25) {
			$resultado = "La mesa seleccionada ya esta completa.";
  		} else {	
  			$posiblesInscriptos = 25 - $cantidadInscriptos;
			$resultado = "Usted solo podra registrar ". $posiblesInscriptos ." alumnos en esa mesa.";
		}
  	}
	echo $resultado;
	
	return sfView::NONE;
  }  
  	
  // Obtiene las designaciones a la mesa de examen
  public function executeObtenermateriasgenericas(sfWebRequest $request)
  {	
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$this->materiasgenericas = array();
  	$this->alumnosencondiciones = array();
  	// Se obtiene el plan de estudios
	$oPlanEstudio = Doctrine::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	// Se obtiene la catedra
	$materiasgenericas = $oPlanEstudio->obtenerMateriasGenericas();
	if(count($materiasgenericas) > 0) {
		foreach ($materiasgenericas as $materiagenerica) {
			// Busco si existe designacion Presidente Catedra o Asociado
			$oMateriaPlan = Doctrine::getTable('MateriasPlanes')->find($materiagenerica->idmateriaplan);
		
			$this->materiasgenericas[$materiagenerica->idmateriaplan] = $materiagenerica;
			$this->alumnosencondiciones[$materiagenerica->idmateriaplan] = count($oMateriaPlan->obtenerAlumnosEnCondiciones($idsede));
		}
	}
  }
  	
  // Publicar la mesa de examen
  public function executePublicarmesa(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	// Guarda los valores en el objeto
	$oMesaExamen->setIdestadomesaexamen(MESASPUBLICADAS); 
	$oMesaExamen->save();
	
	// Crea un objeto que guarda el cambio de estado en el historial
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	$oHistorial->setIdestadomesaexamen(MESASPUBLICADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();	
	
	echo "Se ha publicado correctamente la mesa de examen.\n";
	
	return sfView::NONE;
  }  

  // Despublicar la mesa de examen
  public function executeDespublicarmesa(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	// Guarda los valores en el objeto
	$oMesaExamen->setIdestadomesaexamen(MESASCREADAS); 
	$oMesaExamen->save();
	
	// Crea un objeto que guarda el cambio de estado en el historial
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	$oHistorial->setIdestadomesaexamen(MESASCREADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();	
	
	echo "Se ha despublicado correctamente la mesa de examen.\n";
	
	return sfView::NONE;
  }  
  
  // Obtiene los alumnos en condiciones
  public function executeObteneralumnosencondiciones(sfWebRequest $request)
  {
  	$this->alumnosencondiciones = array();
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');

  	$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('idmateriaplan'));
  	//$alumnos = $oMateriaPlan->obtenerAlumnosEnCondiciones($idsede);
  	/*
  	foreach ($alumnos as $alumno) {
  		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($alumno['idalumno']); 
  		array_push($this->alumnosencondiciones, $oAlumno);
  	}*/
  	$this->alumnosencondiciones = $oMateriaPlan->obtenerAlumnosEnCondiciones($idsede);
  }  
    
  // Obtiene las mesas de examenes
  public function executeObtenermesas(sfWebRequest $request)
  {
	$this->mesasexamenes = array();
	$this->mesasexamenesvacias = array();
  	$this->idplanestudio = $request->getParameter('idplanestudio');
  		
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);

  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$oArea = Doctrine_Core::getTable('Areas')->find($idarea);
  	$this->horas =  range(0,23);
  	$this->minutos = range(0,59);
  	$this->libros = $oArea->obtenerLibrosActas();

	$mesas_examenes = $oPlanEstudio->obtenerMesasExamenes(MESASPUBLICADAS, $idsede);
	foreach ($mesas_examenes as $mesa) {
		if ($mesa->cantidad > 0) {
			array_push($this->mesasexamenes, $mesa);
		} else {
			array_push($this->mesasexamenesvacias, $mesa);
		}
	}
	
  	$mesas_examenes = $oPlanEstudio->obtenerMesasExamenes(MESASCREADAS, $idsede);
	foreach ($mesas_examenes as $mesa) {
		if ($mesa->cantidad > 0) {
			array_push($this->mesasexamenes, $mesa);
		}else{
			array_push($this->mesasexamenesvacias, $mesa);
		}
	}	
  }
    
  // Obtiene las mesas de examenes publicadas
  public function executeObtenermesaspublicadas(sfWebRequest $request)
  {
	$this->mesasexamenes = array();
	$this->mesasexamenesvacias = array();
  	$this->idplanestudio = $request->getParameter('idplanestudio');
  		
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);

  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$oArea = Doctrine_Core::getTable('Areas')->find($idarea);
  	$this->horas =  range(0,23);
  	$this->minutos = range(0,59);
  	$this->libros = $oArea->obtenerLibrosActas();

	$mesas_examenes = $oPlanEstudio->obtenerMesasExamenes(MESASPUBLICADAS, $idsede);
	foreach ($mesas_examenes as $mesa) {
		if ($mesa->cantidad > 0) {
			array_push($this->mesasexamenes, $mesa);
		}else{
			array_push($this->mesasexamenesvacias, $mesa);
		}
	}
  }
    
  // Obtiene las mesas de examenes pendientes
  public function executeObtenermesaspendientes(sfWebRequest $request)
  {
	$this->mesasexamenes = array();
	$this->mesasexamenesvacias = array();
  	$this->idplanestudio = $request->getParameter('idplanestudio');
  		
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);

  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$oArea = Doctrine_Core::getTable('Areas')->find($idarea);
  	$this->horas =  range(0,23);
  	$this->minutos = range(0,59);
  	$this->libros = $oArea->obtenerLibrosActas();

	$mesas_examenes = $oPlanEstudio->obtenerMesasExamenes(MESASCREADAS, $idsede);
	foreach ($mesas_examenes as $mesa) {
		if ($mesa->cantidad > 0) {
			array_push($this->mesasexamenes, $mesa);
		} else {
			array_push($this->mesasexamenesvacias, $mesa);
		}
	}
  }
  
  // Obtiene las materias planes
  public function executeObtenermateriasplanes(sfWebRequest $request)
  {
  	$this->materiasplanes = array();
  	$this->idplanestudio = $request->getParameter('idplanestudio');
  
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
  
  	$materias_planes = $oPlanEstudio->obtenerTodasMaterias(0);
  
  	foreach ($materias_planes as $materia) {
  		if(($materia->idtipomateria!=1) or ($materia->idtipomateria==1 and $materia->generica==0)){
  			array_push($this->materiasplanes, $materia);
  		}
  	}
  }

  
  // Obtiene las mesas de examenes vacias
  public function executeObtenermesasvacias(sfWebRequest $request)
  {
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
  	$this->mesasexamenesvacias = array();
  	$this->idplanestudio = $request->getParameter('idplanestudio');
  		
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);

	$mesas_examenes_pendientes = $oPlanEstudio->obtenerMesasExamenes(MESASCREADAS, $idsede);

	foreach ($mesas_examenes_pendientes as $mesa) {
		if ($mesa->cantidad == 0) {
			array_push($this->mesasexamenesvacias, $mesa);
		}
	}
  	$mesas_examenes_publicadas = $oPlanEstudio->obtenerMesasExamenes(MESASPUBLICADAS, $idsede);

	foreach ($mesas_examenes_publicadas as $mesa) {
		if ($mesa->cantidad == 0) {
			array_push($this->mesasexamenesvacias, $mesa);
		}
	}	
  }  
  	
  // Registra las notas en el Libro Matriz
  public function executeObtenerllamado(sfWebRequest $request)
  {
	$oLlamado = Doctrine::getTable('LlamadosTurno')->find($request->getParameter('idllamado'));	
  		
	$arr = explode('-', $oLlamado->getInicio());
	$resultado['inicio'] = $arr[2]."-".$arr[1]."-".$arr[0];
	$arr = explode('-', $oLlamado->getFin());
  	$resultado['fin'] = $arr[2]."-".$arr[1]."-".$arr[0];
  		
  	echo json_encode($resultado);
		
	return sfView::NONE;
  }   
  	
  // Obtiene las mesas de examenes por carrera
  public function executeIndex(sfWebRequest $request)
  {
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
  	//echo "AREA: ".$idarea;exit;
    $this->idplanestudio = $request->getParameter('idplanestudio');
    $this->idestado = $request->getParameter('idestado', 1);
    $this->idsede = $request->getParameter('idsede');  
    $this->idlibroacta = $request->getParameter('idlibroacta');
    $this->folio = $request->getParameter('folio');
    $this->ordencampo = $request->getParameter('ordencampo', 'ma.nombre');
    if ($this->ordencampo =='me.folio') {
    	$this->ordencampo = "cast(".$this->ordencampo." as unsigned)";
    }
    $this->ordenmetodo = $request->getParameter('ordenmetodo', 'ASC');
    $this->librosactas = array();
    $this->estado = Doctrine::getTable('EstadosMesasExamenes')->find($this->idestado);

	if ($this->idestado == 4) {
		$this->librosactas = Doctrine::getTable('LibrosActas')->obtenerLibros($idarea);
	}
    if (($this->idestado != 4) or ((!$this->folio) and (!$this->idlibroacta))) {
    	$this->acta = false;
    	$q = Doctrine_Query::create()
			->select('me.*')
		 	->from('MesasExamenes me')
		 	->innerJoin('me.Catedras ct ON me.idcatedra = ct.idcatedra')
		 	->innerJoin('ct.MateriasPlanes mp ON ct.idmateriaplan = mp.idmateriaplan')
		 	->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
		    ->where('mp.idplanestudio = '.$this->idplanestudio)
		    ->andWhere('me.idestadomesaexamen = '.$this->idestado)
		    ->andWhere('ct.idsede = '.$this->idsede)
		    ->orderBy($this->ordencampo.' '.$this->ordenmetodo);   
    } else {
    	$this->acta = true;
		if ($this->folio != "") {
	    	$q = Doctrine_Query::create()
				->select('me.*')
			 	->from('MesasExamenes me')
			 	->innerJoin('me.Catedras ct ON me.idcatedra = ct.idcatedra')
			 	->innerJoin('ct.MateriasPlanes mp ON ct.idmateriaplan = mp.idmateriaplan')
			 	->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
			 	->innerJoin('me.LibrosActas li ON me.idlibroacta = li.idlibroacta')
			    ->where('mp.idplanestudio = '.$this->idplanestudio)
			    ->andWhere('me.idestadomesaexamen = '.$this->idestado)
			    ->andWhere('li.idarea = '.$idarea)
			    ->andWhere('li.idlibroacta = '.$this->idlibroacta)
			    ->andWhere('me.folio = '.$this->folio)
			    ->andWhere('ct.idsede = '.$this->idsede)
			    ->orderBy($this->ordencampo.' '.$this->ordenmetodo);	    		   	
		} else {
	    	$q = Doctrine_Query::create()
				->select('me.*')
			 	->from('MesasExamenes me')
			 	->innerJoin('me.Catedras ct ON me.idcatedra = ct.idcatedra')
			 	->innerJoin('ct.MateriasPlanes mp ON ct.idmateriaplan = mp.idmateriaplan')
			 	->innerJoin('mp.Materias ma ON mp.idmateria = ma.idmateria')
			 	->innerJoin('me.LibrosActas li ON me.idlibroacta = li.idlibroacta')
			    ->where('mp.idplanestudio = '.$this->idplanestudio)
			    ->andWhere('me.idestadomesaexamen = '.$this->idestado)
			    ->andWhere('li.idarea = '.$idarea)
			    ->andWhere('li.idlibroacta = '.$this->idlibroacta)
			    ->andWhere('ct.idsede = '.$this->idsede)
			    ->orderBy($this->ordencampo.' '.$this->ordenmetodo);	   	
		}			   	
    }

	$this->pager = new sfDoctrinePager(
	'MesasExamenes',
	50
	);
	$this->pager->setQuery($q);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();     
  }

  // Busca las mesas de examenes por carrera
  public function executeBuscargenerica(sfWebRequest $request)
  {
  	$this->form = new BuscarMateriasGenericasForm();
  }
  
  // Busca las mesas de examenes por carrera
  public function executeBuscar(sfWebRequest $request)
  {
  	$this->form = new BuscarMesaExamenForm();
  }

  // Busca las mesas de examenes por carrera
  public function executeCerrar(sfWebRequest $request)
  {
  	$this->form = new BuscarMesaExamenForm();
  }
  
  // Cierra la mesa de examen
  public function executeCerraractaexamen(sfWebRequest $request)
  {
  	$resultado = "";
  	$observaciones = "";
  	$arregloAlumnos = $request->getParameter('alumnos');
  	$notaEscrita = $request->getParameter('notaEscrita');
  	$notaOral = $request->getParameter('notaOral');
  	$notaPromedio = $request->getParameter('notaPromedio');
  	// Busco la mesa de examen en dicha catedra
  	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
  	// Recorre todas las notas y las guarda en el objeto correspondiente.
  	foreach($arregloAlumnos as $k => $v){
  		$puedeRegistrar = 0;
  		$tieneAprobado = 0;
  		// Busco el examen en dicha catedra
  		$oExamen = Doctrine::getTable('Examenes')->getExamen($k, $request->getParameter('idmesaexamen'));
  		// Busco si existe el estado Aprobado en AluMat
  		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($k, $oMesaExamen->getIdcatedra());
  		if ($oAluMat) {
  			if ($oAluMat->getIdestadomateria()==9) {
  				$tieneAprobado = 1;
  			} else {
  				$tieneAprobado = 0;
  			}
  		} else {
  			$tieneAprobado = 0;
  		}
  	
  		// Busco el ultimo examen en dicha catedra
  		$oUltimoExamen = Doctrine::getTable('Examenes')->getUltimoExamen($k, $oMesaExamen->getIdcatedra());
  	
  		// Controla si se puede registrar la nota
  		if ($oExamen->getIdmesaexamen() != $oUltimoExamen->getIdmesaexamen()) {
  			if ($notaPromedio[$k] >= NOTAAPROBACION) {
  				$puedeRegistrar = 0;
  			} else {
  				$puedeRegistrar = 1;
  			}
  		} else {
  			$puedeRegistrar = 1;
  			if ($tieneAprobado and ($notaPromedio[$k] < NOTAAPROBACION)) {
  				$oAluMat->delete();
  			}
  		}
  	
  		// Registrar la nota
  		if ($puedeRegistrar) {
  			$oExamen->setEscrito($notaEscrita[$k]);
  			$oExamen->setOral($notaOral[$k]);
  			$oExamen->setPromedio($notaPromedio[$k]);
  			$oExamen->save();
  		} else {
  			$observaciones .= $oExamen->getAlumnos()->getPersonas()->getApellido().", ".$oExamen->getAlumnos()->getPersonas()->getNombre()."\n";
  		}
  	}
  	
  	$resultado = "Las notas han sido guardadas en el Libro Matriz.".($observaciones =="" ? "" : "\nObservaciones:\nLos siguientes alumnos tienen examenes posteriores que impiden realizar esa modificación.".$observaciones."\n");
  	
  	echo $resultado;
  }  
  
  // Registra las notas en el Libro Matriz
  public function executeRegistrarlibromatriz(sfWebRequest $request)
  {  	  	  	
  	$resultado = "";
  	$observaciones = "";	
  	$arregloAlumnos = $request->getParameter('alumnos');
  	$notaEscrita = $request->getParameter('notaEscrita');
	$notaOral = $request->getParameter('notaOral');
	$notaPromedio = $request->getParameter('notaPromedio');
  	// Busco la mesa de examen en dicha catedra
  	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	// Recorre todas las notas y las guarda en el objeto correspondiente.   
  	foreach($arregloAlumnos as $k => $v){
  		$puedeRegistrar = 0;
  		$tieneAprobado = 0;
  		// Busco el examen en dicha catedra
  		$oExamen = Doctrine::getTable('Examenes')->getExamen($k, $request->getParameter('idmesaexamen'));
  		// Busco si existe el estado Aprobado en AluMat
		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($k, $oMesaExamen->getIdcatedra());
		if ($oAluMat) {
			if ($oAluMat->getIdestadomateria()==9) {
				$tieneAprobado = 1;
			} else {
				$tieneAprobado = 0;				
			}
		} else {
			$tieneAprobado = 0;
		}
		
  		// Busco el ultimo examen en dicha catedra
		$oUltimoExamen = Doctrine::getTable('Examenes')->getUltimoExamen($k, $oMesaExamen->getIdcatedra());

		// Controla si se puede registrar la nota
		if ($oExamen->getIdmesaexamen() != $oUltimoExamen->getIdmesaexamen()) {
			if ($notaPromedio[$k] >= NOTAAPROBACION) {
				$puedeRegistrar = 0;
			} else {
				$puedeRegistrar = 1;
			}
		} else {
			$puedeRegistrar = 1;
			if ($tieneAprobado and ($notaPromedio[$k] < NOTAAPROBACION)) {
				$oAluMat->delete();
			}
		}

		// Registrar la nota
		if ($puedeRegistrar) {	
  			$oExamen->setEscrito($notaEscrita[$k]);
  			$oExamen->setOral($notaOral[$k]);
  			$oExamen->setPromedio($notaPromedio[$k]);
  			$oExamen->save();				
		} else {
			$observaciones .= $oExamen->getAlumnos()->getPersonas()->getApellido().", ".$oExamen->getAlumnos()->getPersonas()->getNombre()."\n";
		}
	}

	$resultado = "Las notas han sido guardadas en el Libro Matriz.".($observaciones =="" ? "" : "\nObservaciones:\nLos siguientes alumnos tienen examenes posteriores que impiden realizar esa modificación.".$observaciones."\n");
	
	echo $resultado;
	
	return sfView::NONE;
  }   

  // Registra las notas en el Libro Matriz
  public function executeCerrartodo(sfWebRequest $request)
  {  	 
  	$resultado = "";
  	$observaciones = "";
  	$arregloAlumnos = $request->getParameter('alumnos');
  	$notaEscrita = $request->getParameter('notaEscrita');
  	$notaOral = $request->getParameter('notaOral');
  	$notaPromedio = $request->getParameter('notaPromedio');
  	// Busco la mesa de examen en dicha catedra
  	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
  	
  	// Recorre todas las notas y las guarda en el objeto correspondiente.
  	foreach($arregloAlumnos as $k => $v){
  		$puedeRegistrar = 0;
  		$tieneAprobado = 0;
  		// Busco el examen en dicha catedra
  		$oExamen = Doctrine::getTable('Examenes')->getExamen($k, $request->getParameter('idmesaexamen'));
  		// Busco si existe el estado Aprobado en AluMat
  		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($k, $oMesaExamen->getIdcatedra());
  		if ($oAluMat) {
  			if ($oAluMat->getIdestadomateria()==9) {
  				$tieneAprobado = 1;
  			} else {
  				$tieneAprobado = 0;
  			}
  		} else {
  			$tieneAprobado = 0;
  		}
  
  		// Busco el ultimo examen en dicha catedra
  		$oUltimoExamen = Doctrine::getTable('Examenes')->getUltimoExamen($k, $oMesaExamen->getIdcatedra());
  
  		// Controla si se puede registrar la nota
  		if ($oExamen->getIdmesaexamen() != $oUltimoExamen->getIdmesaexamen()) {
  			if ($notaPromedio[$k] >= NOTAAPROBACION) {
  				$puedeRegistrar = 0;
  			} else {
  				$puedeRegistrar = 1;
  			}
  		} else {
  			$puedeRegistrar = 1;
  			if ($tieneAprobado and ($notaPromedio[$k] < NOTAAPROBACION)) {
  				$oAluMat->delete();
  			}
  		}
  
  		// Registrar la nota
  		if ($puedeRegistrar) {
  			$oExamen->setEscrito($notaEscrita[$k]);
  			$oExamen->setOral($notaOral[$k]);
  			$oExamen->setPromedio($notaPromedio[$k]);
  			$oExamen->save();
  		} else {
  			$observaciones .= $oExamen->getAlumnos()->getPersonas()->getApellido().", ".$oExamen->getAlumnos()->getPersonas()->getNombre()."\n";
  		}
  	}	
  	
  	$mesasMultiples = array();
  	$oMateriaPlan = $oMesaExamen->getCatedras()->getMateriasPlanes();
  	$alumnos = $oMesaExamen->obtenerInscriptos();
  	$cont = 0;
  	$guardado = 0;
  	$idmateria = $oMateriaPlan->getIdmateria();
  	///////////////////////////////////////////////////////////////////////////
  	$esOptativa = 0;
  	if ($oMateriaPlan->getIdtipomateria()==4) {
  		$esOptativa = 1;
 		$idmateriaplan = $oMateriaPlan->getIdmateriaplan();
  	}
  	$crearMesaGenerica = 0;
  	///////////////////////////////////////////////////////////////////////////
  	foreach($alumnos as $alumno){
  		$puedeAprobar = 0;
  		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno['idalumno'],$oMesaExamen->getIdcatedra());
  		$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);  		
  		$tieneAprobado = 0;
  		if ($oAluMat) {
  			if ($oAluMat->getIdestadomateria()==9) {
  				$tieneAprobado = 1;
  			}
  		}
  		if ($tieneAprobado==1) {
  			$cont++;
  			$resultado .= "El alumno ".$oAlumno->getPersonas()." ya tiene aprobada esta materia.\n";
  		} else {
  			// Define si el alumno puede aprobar la materia
  			$puedeAprobar = Doctrine::getTable('Examenes')->puedeAprobar($alumno['idalumno'],$oMesaExamen->getIdmesaexamen());
  			if ($puedeAprobar==1) {
  				/////////////////////////////////////////////////////////////////
  				if ($esOptativa==1) {
  					// Obtiene todas las materias genericas de las cuales forma parte
  					$materiasGenericas = $oMateriaPlan->getMateriasGenericas();
					
  					foreach ($materiasGenericas as $materiagenerica) {
  						$oMateriaGenerica = Doctrine::getTable('MateriasPlanes')->find($materiagenerica->getIdmateriaplangenerica());
  						$oCatedraGenerica = $oMateriaGenerica->obtenerCatedra($oAlumno->getIdsede());
  						$sumapuntaje = 0;
  						$puntajerequerido = $oMateriaGenerica->getPuntajerequerido();

  						$tieneAprobadoGenerica = Doctrine::getTable('AluMat')->tieneAprobado($alumno['idalumno'],$materiagenerica->getIdmateriaplangenerica());
  						if (!$tieneAprobadoGenerica) {
  							$sumapuntaje = $oMateriaGenerica->obtenerPuntajeSumado($idmateriaplan,$alumno['idalumno']);

							// Si el puntaje que tiene es mayor que el puntaje requerido se debe generar el estado aprobado de la materia generica  									
  							if ($puntajerequerido<=$sumapuntaje) {
  								$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);
  								
	  							// Crea un nuevo objeto AluMat con los datos ingresados
	  							$oAluMat = new AluMat();
	  							$oAluMat->setIdalumno($alumno['idalumno']);
	  							$oAluMat->setIdestadomateria(9);
	  							$oAluMat->setIdcatedra($oCatedraGenerica->getIdcatedra());
	  							$oAluMat->setIdmateria($idmateria);
	  							$oAluMat->setFecha($oMesaExamen->getFecha());
	  							$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
	  							$oAluMat->save();
	  							$crearMesaGenerica = 1;
	  							$mesasMultiples[$oCatedraGenerica->getIdcatedra()][]=$alumno['idalumno'];
   							}
  						}
  					}
  				}

  				/////////////////////////////////////////////////////////////////
  				// Crea un nuevo objeto AluMat con los datos ingresados
  				$oAluMat = new AluMat();
  				$oAluMat->setIdalumno($alumno['idalumno']);
  				$oAluMat->setIdestadomateria(9);
  				$oAluMat->setIdcatedra($oMesaExamen->getIdcatedra());
  				$oAluMat->setIdmateria($idmateria);
  				$oAluMat->setFecha($oMesaExamen->getFecha());
  				$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
				$oAluMat->save();
			} else {
				// Obtiene el ultimo estado de alumno en la catedra
				$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno['idalumno'],$oMesaExamen->getIdcatedra());
				// Obtiene la cantidad de aplazos permitidos de la materia
				$cantAplazosPermitidos = $oMateriaPlan->getCantidadaplazos();
				
				if ($oAluMat) {
					if ($oAluMat->getIdestadomateria()==9) {
						$oAluMat->delete();
					}
				}
  						
				if (($oMesaExamen->getIdcondicion()==1) and ($cantAplazosPermitidos!="" and $cantAplazosPermitidos!=0)) {
					$cantAplazosAlumno = Doctrine::getTable('MesasExamenes')->getCantidadAplazosPorAlumnoCatedra($alumno['idalumno'], $oMesaExamen->getIdcatedra());
					if ($cantAplazosPermitidos==$cantAplazosAlumno) {
						// Crea un nuevo objeto AluMat con los datos ingresados
						$oAluMat = new AluMat();
  						$oAluMat->setIdalumno($alumno['idalumno']);
  						$oAluMat->setIdestadomateria(8);
  						$oAluMat->setIdcatedra($oMesaExamen->getIdcatedra());
 						$oAluMat->setIdmateria($idmateria);
  						$oAluMat->setFecha($oMesaExamen->getFecha());
  						$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
  						$oAluMat->save();
  					}
  				}
  			}
  		}
  	}

  	if ($crearMesaGenerica) {
  		foreach ($mesasMultiples as $idc=>$alus) {
  			$oCatGenerica = Doctrine::getTable('Catedras')->find($idc);
  			// Crea una nueva mesa de examen para la materia generica
  			$oMesaExamenGenerica = new MesasExamenes();
  			$oMesaExamenGenerica->setIdcatedra($idc);
  			$oMesaExamenGenerica->setIdcondicion($oMesaExamen->getIdcondicion());
  			$oMesaExamenGenerica->setIdtipoexamen($oMesaExamen->getIdtipoexamen());
  			$oMesaExamenGenerica->setIdlibroacta($oMesaExamen->getIdlibroacta());
  			$oMesaExamenGenerica->setFecha($oMesaExamen->getFecha());
  			$oMesaExamenGenerica->setHora($oMesaExamen->getHora());
  			$oMesaExamenGenerica->setLibro($oMesaExamen->getLibro());
  			$oMesaExamenGenerica->setFolio($oMesaExamen->getFolio());
  			$oMesaExamenGenerica->setIdestadomesaexamen(3);
  			$oMesaExamenGenerica->setIdllamado($oMesaExamen->getIdllamado());
  			$oMesaExamenGenerica->setActivo($oMesaExamen->getActivo());
  			$oMesaExamenGenerica->setIdmateria($oCatGenerica->getMateriasPlanes()->getIdmateria());

  			$oMesaExamenGenerica->save();  	
  					
  			$promediable = $oMateriaGenerica->getPromediable();
  			foreach ($alus as $alu) {
  				// Insbribe los alumnos a la mesa de examen de la materia generica
  				$oExamenGenerica = new Examenes();
  				$oExamenGenerica->setIdalumno($alu);
  				$oExamenGenerica->setIdmesaexamen($oMesaExamenGenerica->getIdmesaexamen());
  				$oExamenGenerica->setEscrito();
  				$oExamenGenerica->setOral();
  				$promedio = $oMateriaGenerica->obtenerPromedio($oCatGenerica->getIdmateriaplan(),$alu);
  				if ($promediable == 1){
  					$oExamenGenerica->setPromedio($promedio);
  				}
  				
  				$oExamenGenerica->save();
  			}
		}  	
		$resultado .= "Se genero una mesa de examen para la materia generica.\n";
  	}
  	
  	if ($oMesaExamen){
  		$oSede = $oMesaExamen->getCatedras()->getSedes();
  		$oCarrera = $oMateriaPlan->getPlanesEstudios()->getCarreras();
  		  		
  		// Si la mesa de examen fue reabierta envia un correo a Auditoria Academica
  		if($oMesaExamen->fueReabierta()) {
  			$notas = "";
  			foreach ($alumnos as $alumno) {
  				$fecha=explode(" ",$alumno->getUpdatedAt());
  				if ($fecha[0]==date('Y-m-d')){
  					$notas .= $alumno->getAlumnos()->getPersonas()." (".$alumno->getPromedio().")\n";
  				}
  			}
  			// Destinatario
  			$destinatario = "auditoriaacademica@ucu.edu.ar";
  		
  			// Remitente
  			$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
  		
  			$msj = '
  	Se solicita el levantamiento de acta de la siguiente mesa de examen.
  	Libro: '.$oMesaExamen->getLibro().'
	Folio: '.$oMesaExamen->getFolio().'
  	Materia: '.$oMateriaPlan.'
	Carrera: '.$oCarrera.'
	Sede: '.$oSede.'
  	E-mail: '.$remitente.'
  	Notas: \n'.$notas;
  		
  		
  			$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
  		
  			$result = $this->getMailer()->composeAndSend(
  					$remitente,
  					$destinatario,
  					'SAO - Levantamiento de Acta',
  					$mensajeEmail
  			);
  		}
  		// Guarda los valores en el objeto
  		$oMesaExamen->setIdestadomesaexamen(LIBROMATRIZ);
  		$oMesaExamen->setIdmateria($idmateria);
  		$oMesaExamen->save();
  				
  		// Crea un objeto que guarda el cambio de estado en el historial
  		$oHistorial = new EstadosMesasExamenesHistorial();
  		$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
  		$oHistorial->setIdestadomesaexamen(LIBROMATRIZ);
  		$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
  		$oHistorial->save();

  		$resultado .= "Se ha cerrado correctamente el acta volante.\n";
  		$guardado = 1;
  	} else {
  		$resultado .= "No se ha podido cerrar el acta volante.\n";
  		$guardado = 0;
  	}
  		
  	$arr['mensaje'] = $resultado;
  	$arr['guardado'] = $guardado;
  		
  	echo json_encode($arr);
  		
  	return sfView::NONE;  		
  }  
  
  // Anula la mesa de examen
  public function executeAnularacta(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	// Guarda los valores en el objeto
	$oMesaExamen->setIdestadomesaexamen(MESASANULADAS); 
	$oMesaExamen->save();
	
	// Crea un objeto que guarda el cambio de estado en el historial
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	$oHistorial->setIdestadomesaexamen(MESASANULADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();	

	$alumnosInscriptos = $oMesaExamen->obtenerInscriptos();
	foreach ($alumnosInscriptos as $alumno) {
		// Busco si existe el estado Aprobado en AluMat
		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno->getIdalumno(),$oMesaExamen->getIdcatedra());
		if ($oAluMat->getIdestadomateria()==9) {
			// Busco el examen en dicha catedra
			$oExamen = Doctrine::getTable('Examenes')->getExamen($alumno->getIdalumno(), $oMesaExamen->getIdmesaexamen());
			if ($oExamen->getPromedio() >= NOTAAPROBACION) {
				$oAluMat->delete();
			}
		}
	}
	
	echo "Se ha anulado correctamente el acta volante.\n";
	
	return sfView::NONE;
  }    
    
  // Reabre el Acta Volante
  public function executeReabriracta(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	// Guarda los valores en el objeto
	$oMesaExamen->setIdestadomesaexamen(MESASCREADAS);
	$oMesaExamen->save();
	
	$oMateriaPlan = $oMesaExamen->getCatedras()->getMateriasPlanes();
	$materia = $oMateriaPlan->getIdmateriaplan().'- '.$oMateriaPlan;
	$carrera = $oMateriaPlan->getPlanesEstudios();
	$sede = $oMesaExamen->getCatedras()->getSedes();
	// Destinatario
	$destinatario = "auditoriaacademica@ucu.edu.ar";

	// Remitente
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
	 
	$msj = '
  	Se solicita el levantamiento de acta de la siguiente mesa de examen.
  	Libro: '.$oMesaExamen->getLibro().'
	Folio: '.$oMesaExamen->getFolio().'
  	Materia: '.$materia.'
	Carrera: '.$carrera.'  			
	Sede: '.$sede.'			
  	E-mail: '.$remitente;
	 
	$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
	 
	$resultado = $this->getMailer()->composeAndSend(
			$remitente,
			$destinatario,
			'SAO - Levantamiento de Acta',
			$mensajeEmail
	);
		
	// Crea un objeto que guarda el cambio de estado en el historial
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	$oHistorial->setIdestadomesaexamen(MESASCREADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();	
	
	// Al reabrir la mes de examen se tienen que eliminar los aprobados en AluMat
	$alumnos = $oMesaExamen->obtenerInscriptos();
	foreach($alumnos as $alumno){
		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno['idalumno'],$oMesaExamen->getIdcatedra());
		if ($oAluMat) {
			if ($oAluMat->getIdestadomateria()==9) {
				$oAluMat->delete();
			}
		}
	}	

	echo "Se ha reabierto correctamente el acta volante.\n";
	
	return sfView::NONE;
  }   
    
  // Reabre la Mesa de Examen
  public function executeReabrirmesa(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	// Guarda los valores en el objeto
	$oMesaExamen->setIdestadomesaexamen(MESASCREADAS);
	$oMesaExamen->save();
	
	// Crea un objeto que guarda el cambio de estado en el historial
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	$oHistorial->setIdestadomesaexamen(MESASCREADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();	

	echo "Se ha reabierto correctamente la mesa de examen.\n";
	
	return sfView::NONE;
  }  
    
  // Cierra el Acta Volante
  public function executeCerraracta(sfWebRequest $request)
  {  	
  	$resultado = "";
  	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	$oMateriaPlan = $oMesaExamen->getCatedras()->getMateriasPlanes();
	$oSede = $oMesaExamen->getCatedras()->getSedes();
	$oCarrera = $oMateriaPlan->getPlanesEstudios()->getCarreras();
	$cantAplazosPermitidos = $oMateriaPlan->getCantidadaplazos();
	$alumnos = $oMesaExamen->obtenerInscriptos();
	$cont = 0;
	$guardado = 0;
	$idmateria = $oMateriaPlan->getIdmateria(); 
	///////////////////////////////////////////////////////////////////////////
	$esOptativa = 0;
	if ($oMateriaPlan->getIdtipomateria()==4) {
		$esOptativa = 1;
		$idmateriaplan = $oMateriaPlan->getIdmateriaplan();
	}
	///////////////////////////////////////////////////////////////////////////	
	foreach($alumnos as $alumno){
		$puedeAprobar = 0;
		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno['idalumno'],$oMesaExamen->getIdcatedra());
		$tieneAprobado = 0;
		if ($oAluMat) {
			if ($oAluMat->getIdestadomateria()==9) {
				$tieneAprobado = 1;
			}
		}
		if ($tieneAprobado==1) {
			$cont++;
			$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);
			$resultado .= "El alumno ".$oAlumno->getPersonas()." ya tiene aprobada esta materia.\n";
		} else {
			$puedeAprobar = Doctrine::getTable('Examenes')->puedeAprobar($alumno['idalumno'],$oMesaExamen->getIdmesaexamen());
			if ($puedeAprobar==1) {
				/////////////////////////////////////////////////////////////////				
				if ($esOptativa == 1) {
					$materiasGenericas = $oMateriaPlan->getMateriasGenericas();
		 
					foreach ($materiasGenericas as $materiagenerica) {
						$oMateriaGenerica = Doctrine::getTable('MateriasPlanes')->find($materiagenerica->getIdmateriaplangenerica());
						$puntajerequerido = $oMateriaGenerica->getPuntajerequerido();
						
						$oAluMat = Doctrine::getTable('AluMat')->tieneAprobado($alumno['idalumno'],$materiagenerica->getIdmateriaplangenerica());
						if (!$oAluMat) {
							$sumapuntaje = 0;	
							$materiasOptativas = $oMateriaGenerica->obtenerMateriasComponentes();
							foreach ($materiasOptativas as $materiaoptativa) {
								$oAluMat = Doctrine::getTable('AluMat')->tieneAprobado($alumno['idalumno'],$materiaoptativa->getIdmateriaplan());
								if ($oAluMat or $idmateriaplan==$materiaoptativa->getIdmateriaplan()) {
									$sumapuntaje = $sumapuntaje + $materiaoptativa->getValormateria();
								}
							}
					
							if ($puntajerequerido <= $sumapuntaje) {
								$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);
								$oCatedraGenerica = $oMateriaGenerica->obtenerCatedra($oAlumno->getIdsede());
								// Crea un nuevo objeto AluMat con los datos ingresados
								$oAluMat = new AluMat();
								$oAluMat->setIdalumno($alumno['idalumno']);
								$oAluMat->setIdestadomateria(9);
								$oAluMat->setIdcatedra($oCatedraGenerica->getIdcatedra());
								// Nuevo campo GZ
								$oAluMat->setIdmateria($idmateria);
								$oAluMat->setFecha($oMesaExamen->getFecha());
								$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
								$oAluMat->save();								
								$resultado .= "Se debe generar una mesa de examen para la materia generica.\n";								
							}
						}
					}				
				}				
				/////////////////////////////////////////////////////////////////							
				// Crea un nuevo objeto AluMat con los datos ingresados
				$oAluMat = new AluMat();
				$oAluMat->setIdalumno($alumno['idalumno']);
				$oAluMat->setIdestadomateria(9);
	  		 	$oAluMat->setIdcatedra($oMesaExamen->getIdcatedra());
				$oAluMat->setIdmateria($idmateria);
		  		$oAluMat->setFecha($oMesaExamen->getFecha());
			  	$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
				$oAluMat->save();				
			} else {
				// Obtiene el ultimo estado de alumno en la catedra
				$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno['idalumno'],$oMesaExamen->getIdcatedra());
				
				if ($oAluMat) {
					if ($oAluMat->getIdestadomateria()==9) {
						$oAluMat->delete();
					}
				}	
							
				if (($oMesaExamen->getIdcondicion()==1) and ($cantAplazosPermitidos!="" and $cantAplazosPermitidos!=0)) {
					$cantAplazosAlumno = Doctrine::getTable('MesasExamenes')->getCantidadAplazosPorAlumnoCatedra($alumno['idalumno'], $oMesaExamen->getIdcatedra());
					if ($cantAplazosPermitidos==$cantAplazosAlumno) {
						// Crea un nuevo objeto AluMat con los datos ingresados
						$oAluMat = new AluMat();
						$oAluMat->setIdalumno($alumno['idalumno']);
						$oAluMat->setIdestadomateria(8);
			  		 	$oAluMat->setIdcatedra($oMesaExamen->getIdcatedra());
						$oAluMat->setIdmateria($idmateria);
				  		$oAluMat->setFecha($oMesaExamen->getFecha());
					  	$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
						$oAluMat->save();	
					}
				}
			}
		}
	}
	
	if ($oMesaExamen){
		// Si la mesa de examen fue reabierta envia un correo a Auditoria Academica
		if($oMesaExamen->fueReabierta()) {
			$notas = "";
			foreach ($alumnos as $alumno) {
				$fecha=explode(" ",$alumno->getUpdatedAt());
				if ($fecha[0]==date('Y-m-d')){
					$notas .= $alumno->getAlumnos()->getPersonas()." (".$alumno->getPromedio().")\n";
				}
			}
			// Destinatario
			$destinatario = "auditoriaacademica@ucu.edu.ar";
				
			// Remitente
			$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
				
			$msj = '
  	Se solicita el levantamiento de acta de la siguiente mesa de examen.
  	Libro: '.$oMesaExamen->getLibro().'
	Folio: '.$oMesaExamen->getFolio().'
  	Materia: '.$oMateriaPlan.'
	Carrera: '.$oCarrera.'
	Sede: '.$oSede.'
  	E-mail: '.$remitente.'
  	Notas: \n'.$notas;
				
				
			$mensajeEmail = '
**************************************************************************************
**************************************************************************************
'.$msj.'
**************************************************************************************
**************************************************************************************';
				
			$result = $this->getMailer()->composeAndSend(
					$remitente,
					$destinatario,
					'SAO - Levantamiento de Acta',
					$mensajeEmail
			);				
		}

		// Guarda los valores en el objeto
		$oMesaExamen->setIdestadomesaexamen(LIBROMATRIZ);
		// Nuevo campo GZ
		$oMesaExamen->setIdmateria($idmateria);
		$oMesaExamen->save();
					
		// Crea un objeto que guarda el cambio de estado en el historial
		$oHistorial = new EstadosMesasExamenesHistorial();
		$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
		$oHistorial->setIdestadomesaexamen(LIBROMATRIZ);
		$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
		$oHistorial->save();
		
		$resultado .= "Se ha cerrado correctamente el acta volante.\n";			
		$guardado = 1;	
	} else {
		$resultado .= "No se ha podido cerrar el acta volante.\n";
		$guardado = 0;
	}  	

	$arr['mensaje'] = $resultado;
	$arr['guardado'] = $guardado;
	
	echo json_encode($arr);	
	
	return sfView::NONE;
  } 

  // Elimina la mesa de examen
  public function executeEliminarmesa(sfWebRequest $request)
  {
	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	
	// Guarda los valores en el objeto
	$oMesaExamen->setIdestadomesaexamen(MESASELIMINADAS);
	// Se resetea el libro y folio para que pueda ser reutilizado
	$oMesaExamen->setIdlibroacta(NULL);
	$oMesaExamen->setlibro(NULL);
	$oMesaExamen->setFolio(NULL);
	$oMesaExamen->save();
	
	// Crea un objeto que guarda el cambio de estado en el historial
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	$oHistorial->setIdestadomesaexamen(MESASELIMINADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();	
	
  	$alumnosInscriptos = $oMesaExamen->obtenerInscriptos();
	foreach ($alumnosInscriptos as $alumno) {
		// Busco si existe el estado Aprobado en AluMat
		$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno->getIdalumno(),$oMesaExamen->getIdcatedra());
		if ($oAluMat->getIdestadomateria()==9) {
			// Busco el examen en dicha catedra
			$oExamen = Doctrine::getTable('Examenes')->getExamen($alumno->getIdalumno(), $oMesaExamen->getIdmesaexamen());
			if ($oExamen->getPromedio() >= NOTAAPROBACION) {
				$oAluMat->delete();
			}
		}
	}	
	
	echo "Se ha eliminado correctamente la mesa de examen.\n";

	return sfView::NONE;
  }   
    
  // Carga todos los inscriptos y si poseen las notas correspondientes al Acta Volante
  public function executeIngresarnotas(sfWebRequest $request)
  {
	$this->error = "";
	$this->alumnos = "";
	$this->alumat = "";
	$this->notaEscrita = "";
	$this->notaOral = "";
	$this->notaPromedio = "";
	$this->examen = "";
	// Obtiene la mesa de examen dependiendo de los parametros ingresados
  	if($request->getParameter('idmesaexamen')) {
  		$this->mesaexamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
  	} else {
  		$this->mesaexamen = Doctrine::getTable('MesasExamenes')->getLibroMatriz($request->getParameter('libro'),$request->getParameter('folio'),2);
  	}
    if($this->mesaexamen) {
  		$this->materiaplan = $this->mesaexamen->getCatedras()->getMateriasPlanes();
    	$this->materia = $this->materiaplan->getMaterias();
	    $this->carrera = $this->materiaplan->getPlanesEstudios()->getCarreras();
	    $this->condicion = $this->mesaexamen->getCondicionesMesas();
    	$this->mesa = $this->mesaexamen->getFecha();
    	$this->libro = $this->mesaexamen->getLibrosActas();
    	$this->idlibro = $this->mesaexamen->getIdlibroacta();
    	$this->folio = $this->mesaexamen->getFolio();
    	$this->idmesaexamen = $this->mesaexamen->getIdmesaexamen();
    	$this->idestado = $this->mesaexamen->getIdestadomesaexamen();
    	$this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    	
	    // Obtiene los inscriptos a una mesa de examen 
  		$this->inscriptos = $this->mesaexamen->obtenerInscriptos();
  		$idcatedra = $this->mesaexamen->idcatedra;
  		
  		foreach($this->inscriptos as $inscripto) {	
  			$this->alumnos[$inscripto->getIdalumno()] = $inscripto->getAlumnos();
  			$oExamen = Doctrine::getTable('Examenes')->getExamen($inscripto->getIdalumno(),$this->mesaexamen->getIdmesaexamen());
  			$this->notaEscrita[$inscripto->getIdAlumno()] = $oExamen->getEscrito();
  			$this->notaOral[$inscripto->getIdAlumno()] = $oExamen->getOral();
			$this->notaPromedio[$inscripto->getIdAlumno()] = $oExamen->getPromedio();	
			$this->examen[$inscripto->getIdAlumno()] = $oExamen->getIdexamen();
	  	}
    } else{
    	$this->error = "No se ha encontrado la mesa de examen.";
    	$this->form = new ConsultarLibroMatrizForm();

    	$this->setTemplate('consultarlibromatriz');
    }	
  }  
  
  // Muestra el formulario de Consulta de Libro Matriz
  public function executeConsultarlibromatriz(sfWebRequest $request)
  {	
  	$this->error = "";
  	$this->form = new ConsultarLibroMatrizForm();
  }  
  
  // Cierra la mesa de examen
  public function executeCerrarmesa(sfWebRequest $request)
  {		
	$noFaltanProfesores = true;
	$noFaltanDatos = true;		
	$this->mensaje = "";
	$resultado = "";
	$cupo = 25;

	// Busco si existe designacion Presidente Catedra o Asociado
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	$idmateria=$oMesaExamen->getCatedras()->getMateriasPlanes()->getIdmateria();

	// Obtengo los inscriptos a la mesa de examen
	$this->inscriptos = $oMesaExamen->obtenerInscriptos(2);
	
	// Cierra la mesa de examen completa y con alumnos inscriptos
	if($request->getParameter('tipo') == 1) {
		// Antes de cerrar la mesa hay que designar los profesores
		// si no hay profesores designados no debe dejar cerrar la mesa
		/*
		// Control de si falta presidente de mesa 
		if (count($oMesaExamen->obtenerDesignaciones(1)) != 1) { // el parametro 1 es titular
			$noFaltanProfesores=false;
			$this->mensaje .= "Falta designar Presidente de Mesa.\n";
		}
		
		// Control existe designacion primer vocal de mesa
		if (count($oMesaExamen->obtenerDesignaciones(2)) != 1) { // el parametor 2 es Primer Vocal
			$noFaltanProfesores=false;
			$this->mensaje .= "Falta designar Primer Vocal de Mesa.\n";
		}
	
		// Control existe designacion segundo vocal de mesa
		if (count($oMesaExamen->obtenerDesignaciones(3)) != 1) { // el parametor 3 es Segundo Vocal
			$noFaltanProfesores=false;
			$this->mensaje .= "Falta designar Segundo Vocal de Mesa.\n";
		}
		*/	
		// Validacion de Libro y folio antes de guardar
		if ($noFaltanProfesores) { // noFaltanProfesores
			if(($request->getParameter('folio')!="") and ($request->getParameter('libro')!="")) { // Si hay libro y folio

				$oLibroActa = Doctrine::getTable('LibrosActas')->find($request->getParameter('libro'));
				if (($request->getParameter('folio') > 0) and ($oLibroActa->getDescripcion()!='Equivalencia')) { // Si es distinto de Equivalencia	
					// Estado = 3 (ACTA)
					$estado = MESASCERRADAS;
				} else {
					// si folio = 0 y la condicion de mesa es equivalencia
					if($oMesaExamen->getIdcondicion()==5) {
						$mesasMultiples = array();
						$crearMesaGenerica = 0;						
						///////////////////////////////////////////////////////////////////////////
						$oMateriaPlan = $oMesaExamen->getCatedras()->getMateriasPlanes();
						$esOptativa = 0;
						if ($oMateriaPlan->getIdtipomateria()==4) {
							$esOptativa = 1;
							$idmateriaplan = $oMateriaPlan->getIdmateriaplan();
						}
						///////////////////////////////////////////////////////////////////////////
						
						$oMesaExamen->setIdtipoexamen(4);
						// Estado = 4 (LIBRO)
						$estado = LIBROMATRIZ;
						$alumnosInscriptos = $oMesaExamen->obtenerInscriptos();
						foreach ($alumnosInscriptos as $alumno) {
							/////////////////////////////////////////////////////////////////
							if ($esOptativa==1) {
								// Obtiene todas las materias genericas de las cuales forma parte
								$materiasGenericas = $oMateriaPlan->getMateriasGenericas();
							
								foreach ($materiasGenericas as $materiagenerica) {
									$oMateriaGenerica = Doctrine::getTable('MateriasPlanes')->find($materiagenerica->getIdmateriaplangenerica());
									$oCatedraGenerica = $oMateriaGenerica->obtenerCatedra($oMesaExamen->getCatedras()->getIdsede());
									$sumapuntaje = 0;
									$puntajerequerido = $oMateriaGenerica->getPuntajerequerido();
							
									$tieneAprobadoGenerica = Doctrine::getTable('AluMat')->tieneAprobado($alumno['idalumno'],$materiagenerica->getIdmateriaplangenerica());
									if (!$tieneAprobadoGenerica) {
										$sumapuntaje = $oMateriaGenerica->obtenerPuntajeSumado($idmateriaplan,$alumno['idalumno']);
							
										// Si el puntaje que tiene es mayor que el puntaje requerido se debe generar el estado aprobado de la materia generica
										if ($puntajerequerido<=$sumapuntaje) {
											$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);
							
											// Crea un nuevo objeto AluMat con los datos ingresados
											$oAluMat = new AluMat();
											$oAluMat->setIdalumno($alumno['idalumno']);
											$oAluMat->setIdestadomateria(9);
											$oAluMat->setIdcatedra($oCatedraGenerica->getIdcatedra());
											$oAluMat->setIdmateria($idmateria);
											$oAluMat->setFecha($oMesaExamen->getFecha());
											$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
											$oAluMat->save();
											$crearMesaGenerica = 1;
											$mesasMultiples[$oCatedraGenerica->getIdcatedra()][]=$alumno['idalumno'];
										}
									}
								}
							}
							/////////////////////////////////////////////////////////////////
														
							// Busco si existe el estado Aprobado en AluMat
							$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($alumno['idalumno'],$oMesaExamen->getIdcatedra());
							if (!$oAluMat or $oAluMat->getIdestadomateria()!=9) {
								// Crea un nuevo objeto AluMat con los datos ingresados
								$oAluMat = new AluMat();
								$oAluMat->setIdalumno($alumno['idalumno']);
								$oAluMat->setIdestadomateria(9);
								$oAluMat->setIdcatedra($oMesaExamen->getIdcatedra());
								// Nuevo campo GZ
								$oAluMat->setIdmateria($idmateria);
								$oAluMat->setFecha($oMesaExamen->getFecha());
								$oAluMat->setFechavencimiento($oMesaExamen->getFecha());
								$oAluMat->save();
							}
						}
						
						if ($crearMesaGenerica) {
							foreach ($mesasMultiples as $idc=>$alus) {
								$oCatGenerica = Doctrine::getTable('Catedras')->find($idc);
								// Crea una nueva mesa de examen para la materia generica
								$oMesaExamenGenerica = new MesasExamenes();
								$oMesaExamenGenerica->setIdcatedra($idc);
								$oMesaExamenGenerica->setIdcondicion($oMesaExamen->getIdcondicion());
								$oMesaExamenGenerica->setIdtipoexamen($oMesaExamen->getIdtipoexamen());
								$oMesaExamenGenerica->setIdlibroacta($oMesaExamen->getIdlibroacta());
								$oMesaExamenGenerica->setFecha($oMesaExamen->getFecha());
								$oMesaExamenGenerica->setHora($oMesaExamen->getHora());
								$oMesaExamenGenerica->setLibro($oMesaExamen->getLibro());
								$oMesaExamenGenerica->setFolio($oMesaExamen->getFolio());
								$oMesaExamenGenerica->setIdestadomesaexamen(4);
								$oMesaExamenGenerica->setIdllamado($oMesaExamen->getIdllamado());
								$oMesaExamenGenerica->setActivo($oMesaExamen->getActivo());
								$oMesaExamenGenerica->setIdmateria($oCatGenerica->getMateriasPlanes()->getIdmateria());
						
								$oMesaExamenGenerica->save();
									
								$promediable = $oMateriaGenerica->getPromediable();
								foreach ($alus as $alu) {
									// Insbribe los alumnos a la mesa de examen de la materia generica
									$oExamenGenerica = new Examenes();
									$oExamenGenerica->setIdalumno($alu);
									$oExamenGenerica->setIdmesaexamen($oMesaExamenGenerica->getIdmesaexamen());
									$oExamenGenerica->setEscrito();
									$oExamenGenerica->setOral();
									$oExamenGenerica->setPromedio();
						
									$oExamenGenerica->save();
								}
							}
							$this->mensaje .= "Se genero una mesa de examen para la materia generica.\n";
						}						
					} else {
						// Estado = 3 (ACTA)
						$estado = MESASCERRADAS;
					}
				} // Si es distinto de Equivalencia	
				if (($oMesaExamen->existeFolio($request->getParameter('libro'),$request->getParameter('folio'))) and ($request->getParameter('folio')!=0) and ($oLibroActa->getDescripcion()!='Equivalencia') and ($oMesaExamen->getIdcondicion()!=6)){ // Si existe el folio         
					//$ultimo = $oMesaExamen->buscarUltimoFolio($request->getParameter('libro'));
					$libros = Doctrine::getTable('MesasExamenes')->findByIdlibroacta($request->getParameter('libro'));
					$ultimo = 0;
					foreach($libros as $libro) {
						if(intval($libro->getFolio()) > $ultimo) {
							$ultimo = intval($libro->getFolio());
						}
					}
					$this->mensaje .="El Folio ya fue registrado para otra mesa. El ultimo folio registrado pare ese libro es el ".$ultimo;
					$noFaltanDatos = false;
				} else {
					$arr = explode('-', $request->getParameter('fecha'));
					$fecha = $arr[2]."-".$arr[1]."-".$arr[0];					
					if (count($this->inscriptos) > $cupo) {
						$i = 1;
						$cantMesas = 1;
						foreach($this->inscriptos as $inscripto) {
							
							if ($i==$cupo*$cantMesas+1) {
								$oNuevaMesaExamen = new MesasExamenes();
								$oNuevaMesaExamen->setIdcatedra($oMesaExamen->getIdcatedra());
								$oNuevaMesaExamen->setIdmateria($idmateria);
								$oNuevaMesaExamen->setIdcondicion($oMesaExamen->getIdcondicion());
								$oNuevaMesaExamen->setIdtipoexamen($oMesaExamen->getIdtipoexamen());
								$oNuevaMesaExamen->setFecha($fecha);
								$oNuevaMesaExamen->setHora($request->getParameter('hora'));
								$oNuevaMesaExamen->setIdestadomesaexamen(MESASCREADAS);
								$oNuevaMesaExamen->setIdllamado($oMesaExamen->getIdllamado());
								$oNuevaMesaExamen->save();
								
								$oHistorial = new EstadosMesasExamenesHistorial();
								$oHistorial->setIdmesaexamen($oNuevaMesaExamen->getIdmesaexamen());
								// Asigna el estado mesa examen: CREADA
								$oHistorial->setIdestadomesaexamen(MESASCREADAS);
								$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
								$oHistorial->save();	
								$cantMesas++;							
							}
							if ($i > $cupo) {
								$oExamen = Doctrine::getTable('Examenes')->find($inscripto->getIdexamen());
								$oExamen->setIdmesaexamen($oNuevaMesaExamen->getIdmesaexamen());
								$oExamen->save();
							}
							$i++;		
						}		
						$this->mensaje .="Se ha creado una nueva mesa de examen debido a que la mesa de examen actual ha excedido el cupo de inscriptos. \nLa nueva mesa de exmane debera ser cerrada.";
					}
					// Se obtiene el libro de actas
					$oLibroActa = Doctrine::getTable('LibrosActas')->find($request->getParameter('libro'));
						
					// Guarda los valores en el objeto
					$oMesaExamen->setIdmateria($idmateria);
					$oMesaExamen->setIdestadomesaexamen($estado);
					$oMesaExamen->setFecha($fecha);
					$oMesaExamen->setHora($request->getParameter('hora'));
					$oMesaExamen->setFolio($request->getParameter('folio'));
					$oMesaExamen->setLibro($oLibroActa->getDescripcion());
					$oMesaExamen->setIdlibroacta($request->getParameter('libro'));
					$oMesaExamen->save();
					// Crea un objeto que guarda el cambio de estado en el historial
					$oHistorial = new EstadosMesasExamenesHistorial();
					$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
					$oHistorial->setIdestadomesaexamen($estado);
					$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
					$oHistorial->save();					
				} // Si existe el folio
		            
			} else { // si no existe libro y/o folio
			    $this->mensaje .= "Falta ingresar el libro y/o folio.";
			    $noFaltanDatos = false;
			} // Si hay libro y folio
		} // noFaltanProfesores
		
		if(($noFaltanProfesores==false) or ($noFaltanDatos==false)){
			$resultado = "No se ha podido cerrar la mesa de examen.\nObservaciones:\n".$this->mensaje."\n";
		} else {
			if (count($this->inscriptos) > $cupo) {
				$resultado = "Se ha cerrado correctamente la mesa de examen.\nObservaciones:\n".$this->mensaje."\n";
			} else {
				$resultado = "Se ha cerrado correctamente la mesa de examen.\n";
			} 
		}
	} else {
		// Guarda los valores en el objeto			
		// Estado = 4 (LIBRO)
		$oMesaExamen->setIdestadomesaexamen(LIBROMATRIZ);
		$oMesaExamen->save();
		// Crea un objeto que guarda el cambio de estado en el historial						
		$oHistorial = new EstadosMesasExamenesHistorial();
		$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
		$oHistorial->setIdestadomesaexamen(LIBROMATRIZ);
		$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
		$oHistorial->save();

		$resultado = "Se ha cerrado correctamente la mesa de examen.\n";
	}
  	echo $resultado;
  	
	return sfView::NONE;
  }
  
  // Obtiene las designaciones a la mesa de examen
  public function executeObtenerdesignaciones(sfWebRequest $request)
  {	
	$this->idsede = $request->getParameter('idsede');  	
  	// Se obtiene la mesa de examen
	$this->mesaexamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
  	// Se obtiene la catedra
	$oCatedra = $this->mesaexamen->getCatedras();
	// Se asigna el idcaracter
	$this->caracter = Doctrine::getTable('TiposDesignacionesMesas')->find($request->getParameter('idtipodesignacionmesa'));
	// Busca todas las designaciones de profesores a dicha mesa de examen
	$this->designacionesmesas = $this->mesaexamen->obtenerDesignaciones(0);
	// Busca todas las designaciones de profesores a dicho detalleplan
	$this->designacionesmaterias = $oCatedra->obtenerProfesores($request->getParameter('idtipodesignacionmesa'));
  }

  public function executeNew(sfWebRequest $request)
  {
  	$this->form = new MesasExamenesForm();
  }

  public function executeNuevo(sfWebRequest $request)
  {
  	$this->idplanestudio = $request->getParameter('idplanestudio', '');
  	$this->form = new MesasExamenesForm();
  }  
  
  public function executeNuevomasivo(sfWebRequest $request)
  {
  	$this->idplanestudio = $request->getParameter('idplanestudio', '');
  	$this->form = new MesasExamenesForm();
  }
    
  public function executeNuevogenerica(sfWebRequest $request)
  {
  	$this->materiaplan = Doctrine_Core::getTable('MateriasPlanes')->find($request->getParameter('idmateriaplan'));
  	$this->form = new MesasExamenesGenericasForm();
  	$this->form->setDefault('idmateriaplan', $this->materiaplan->getIdmateriaplan());
  }  
  
  public function executeCrearmasivo(sfWebRequest $request)
  {
  	$materias_seleccionadas = $request->getParameter('case');
  	$arreglo = $request->getParameter('mesas_examenes');

  	foreach($materias_seleccionadas as $k =>$v) {
  		$oCatedra = Doctrine_Core::getTable('Catedras')->obtenerCatedra(intval($v), $arreglo['idsede']);
		if ($oCatedra) {	
	  		$oMesaExamen = new MesasExamenes();
	  		$oMesaExamen->setIdcatedra($oCatedra->getIdcatedra());
	  		$oMesaExamen->setIdmateria($oCatedra->getMateriasPlanes()->getIdmateria());
	  		$oMesaExamen->setIdcondicion($arreglo['idcondicion']);
	  		$oMesaExamen->setIdllamado($arreglo['idllamado']);
	  		// Asigna el tipo de examen: Final
	  		$oMesaExamen->setIdtipoexamen(1);
	  		$arr = explode('-', $arreglo['fecha']);
	  		$mesa = $arr[2]."-".$arr[1]."-".$arr[0];
	  		$oMesaExamen->setFecha($mesa);
	  		$oMesaExamen->setHora($arreglo['hora']);
	  		// Asigna el estado mesa examen: CREADA
	  		$oMesaExamen->setIdestadomesaexamen(MESASCREADAS);
	  		$oMesaExamen->setIdtipoexamen(1);
	  		$oMesaExamen->save();
	  		
	  		$oHistorial = new EstadosMesasExamenesHistorial();
	  		$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	  		// Asigna el estado mesa examen: CREADA
	  		$oHistorial->setIdestadomesaexamen(MESASCREADAS);
	  		$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	  		$oHistorial->save(); 
		}
  	}  	
  	
  	echo "Se han creado correctamente las mesas de examenes.\n";
  
  	return sfView::NONE;
  }
    
  public function executeCrear(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
  		
  	$this->form = new MesasExamenesForm();
  	
	$arreglo = $request->getParameter('mesas_examenes');
	$oCatedra = Doctrine_Core::getTable('Catedras')->obtenerCatedra($arreglo['idmateriaplan'], $arreglo['idsede']);
	$oMesaExamen = new MesasExamenes();
	$oMesaExamen->setIdcatedra($oCatedra->getIdcatedra());
	$oMesaExamen->setIdmateria($oCatedra->getMateriasPlanes()->getIdmateria());
	$oMesaExamen->setIdcondicion($arreglo['idcondicion']);
	$oMesaExamen->setIdllamado($arreglo['idllamado']);
	// Asigna el tipo de examen: Final
	$oMesaExamen->setIdtipoexamen(1);
	$arr = explode('-', $arreglo['fecha']);
	$mesa = $arr[2]."-".$arr[1]."-".$arr[0];	  
	$oMesaExamen->setFecha($mesa);
	$oMesaExamen->setHora($arreglo['hora']);
	// Asigna el estado mesa examen: CREADA
	$oMesaExamen->setIdestadomesaexamen(MESASCREADAS);
	$oMesaExamen->setIdtipoexamen(1);
	$oMesaExamen->save();
	  
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	// Asigna el estado mesa examen: CREADA
	$oHistorial->setIdestadomesaexamen(MESASCREADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();

	echo "Se ha creado correctamente la mesa de examen.\n";
	
	return sfView::NONE;
  }    
  
  public function executeCreargenerica(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
  		
	$this->form = new MesasExamenesGenericasForm();
  	
	$arregloMesa = $request->getParameter('mesasexamenes');
	
	$oCatedra = Doctrine_Core::getTable('Catedras')->obtenerCatedra($arregloMesa['idmateriaplan'], $arregloMesa['idsede']);
	$oMesaExamen = new MesasExamenes();
	$oMesaExamen->setIdcatedra($oCatedra->getIdcatedra());
	$oMesaExamen->setIdcondicion($arregloMesa['idcondicion']);
	$oMesaExamen->setIdllamado($arregloMesa['idllamado']);
	// Asigna el tipo de examen: Final
	$oMesaExamen->setIdtipoexamen(1);
	$arr = explode('-', $arregloMesa['fecha']);
	$mesa = $arr[2]."-".$arr[1]."-".$arr[0];	  
	$oMesaExamen->setFecha($mesa);
	$oMesaExamen->setHora($arregloMesa['hora']);
	// Asigna el estado mesa examen: CREADA
	$oMesaExamen->setIdestadomesaexamen(MESASCREADAS);
	$oMesaExamen->setIdtipoexamen(1);
	$oMesaExamen->save();
	  
	$oHistorial = new EstadosMesasExamenesHistorial();
	$oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	// Asigna el estado mesa examen: CREADA
	$oHistorial->setIdestadomesaexamen(MESASCREADAS);
	$oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	$oHistorial->save();
	  
	$arregloAlumnos = $request->getParameter('alumnos');
  
	foreach($arregloAlumnos as $alumno) {
		$oExamen = new Examenes();
	  	$oExamen->setIdalumno($alumno['id']);
	  	$oExamen->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	  	$oExamen->setEscrito($alumno['notaescrita']);
	  	$oExamen->setOral($alumno['notaoral']);
	  	$oExamen->setPromedio($alumno['promedio']);
		// Guarda el examen
	  	$oExamen->save();
	}
	echo "Se ha creado correctamente la mesa de examen con los alumnos seleccionados.\n";
  	
	return sfView::NONE;
  }   
    
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MesasExamenesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mesas_examenes = Doctrine_Core::getTable('MesasExamenes')->find(array($request->getParameter('idmesaexamen'))), sprintf('Object mesas_examenes does not exist (%s).', $request->getParameter('idmesaexamen')));
    $this->form = new MesasExamenesForm($mesas_examenes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mesas_examenes = Doctrine_Core::getTable('MesasExamenes')->find(array($request->getParameter('idmesaexamen'))), sprintf('Object mesas_examenes does not exist (%s).', $request->getParameter('idmesaexamen')));
    $this->form = new MesasExamenesForm($mesas_examenes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mesas_examenes = Doctrine_Core::getTable('MesasExamenes')->find(array($request->getParameter('idmesaexamen'))), sprintf('Object mesas_examenes does not exist (%s).', $request->getParameter('idmesaexamen')));
    $mesas_examenes->delete();

    $this->redirect('mesasexamenes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mesas_examenes = $form->save();

      $this->redirect('mesasexamenes/edit?idmesaexamen='.$mesas_examenes->getIdmesaexamen());
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
		$pdf->Cell(23,7,$alumno->getPersonas()->getTiposDocumentos()." ".$alumno->getPersonas()->getNroDoc(),0,1,'C');
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

  protected function procesarForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
	  $arreglo = $request->getParameter('mesas_examenes');
	  $oCatedra = Doctrine_Core::getTable('Catedras')->obtenerCatedra($arreglo['idmateriaplan'], $arreglo['idsede']);
      $oMesaExamen = new MesasExamenes();
	  $oMesaExamen->setIdcatedra($oCatedra->getIdcatedra());
	  $oMesaExamen->setIdcondicion($arreglo['idcondicion']);
	  $oMesaExamen->setIdllamado($arreglo['idllamado']);
	  // Asigna el tipo de examen: Final
	  $oMesaExamen->setIdtipoexamen(1);
	  $arr = explode('-', $arreglo['fecha']);
	  $mesa = $arr[2]."-".$arr[1]."-".$arr[0];	  
	  $oMesaExamen->setFecha($mesa);
	  $oMesaExamen->setHora($arreglo['hora']);
	  // Asigna el estado mesa examen: CREADA
	  $oMesaExamen->setIdestadomesaexamen(MESASCREADAS);
	  $oMesaExamen->setIdtipoexamen(1);
	  $oMesaExamen->save();
	  
	  $oHistorial = new EstadosMesasExamenesHistorial();
	  $oHistorial->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
	  // Asigna el estado mesa examen: CREADA
	  $oHistorial->setIdestadomesaexamen(MESASCREADAS);
	  $oHistorial->setIdusuario($this->getUser()->getGuardUser()->getId());
	  $oHistorial->save();

	  return sfView::NONE;
    }
  }  
}
