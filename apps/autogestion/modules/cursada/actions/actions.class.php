<?php

/**
 * facultad actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cursadaActions extends sfActions
{

  public function executeGetmateriascursar(sfWebRequest $request)
  {   
    //seteo el idalumno elegido
    $this->getUser()->setAttribute('idalumno', $request->getParameter('ida'));
        
	$this->mensaje ="";   
	$this->materiascursar="";
	$this->materiasinscriptas="";
	$this->planes= array();
	$this->inscriptoCiclo= array();

	// Busca la persona
  	$this->persona = Doctrine_Core::getTable('Personas')->buscarPersona($this->getUser()->getProfile()->getTipodoc(), $this->getUser()->getProfile()->getNrodoc());	       
	
	// Obtiene el alumno
	//if ($request->getParameter('idc')!=""){		
	//	$this->alumno =  Doctrine_Core::getTable('Alumnos')->buscarAlumno($this->persona->getIdpersona(), $request->getParameter('idc'));
	//} 
	//$this->alumno =  Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
	     					         
	// Obtiene los planes de estudio
	$this->planes = $this->persona->obtenerPlanesEstudios();      

	// Si ya selecciono la carrera, analizo las mesas a mostrar
	if ($request->getParameter('idc')){
		$this->alumno =  Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));		
		// Obtener materias habilitadas para cursar
		$materiashabilitadas = $this->alumno->obtenerMateriasHabilitadas("C");
		$materias = unserialize(base64_decode($materiashabilitadas));

		// Prepara string para filtrar mesas de examenes por materias habilitadas para rendir
		$sMaterias = "";
		foreach($materias as $materia){
			$sMaterias = $materia['iddetalleplan'].", ";
		}           		         
		
		$sMaterias = substr($sMaterias, 0, strlen($sMaterias)-2);
		$materias_serialize = base64_encode(serialize($sMaterias));
	// VER ESTO	           
		// Obtener materias para cursar habilitadas para el usuario (segun correlatividad)  
		//$materiascursarhabilitadas = $soapclient->call('obtenermateriascursarhabilitadas',array( 'ida'=> $this->alumno[0], 'idc'=> $request->getParameter('idc'), 'iddetalleplanes'=> $materias_serialize));

		//$this->materiascursar = unserialize(base64_decode($materiascursarhabilitadas));
	////////////	
		$materiasinscriptas = $this->alumno->obtenerMateriasInscripto();
		// Prepara string para filtrar mesas de examenes por materias habilitadas para rendir
		
		foreach($materiasinscriptas as $materia){
			$this->materiasinscriptas[$materia['iddetalleplan']] = $materia['iddetalleplan'];
		}           		         
		
		$this->materiascursar = $materias;

		// Obtener libre deuda
		$soapclient = new nusoap_client("http://190.228.68.197:9090/administracion/webservices/personacuenta.php?wsdl");
		$soapclient->setCredentials("root", "sistemas2009");

		//Obtener libre deuda por dni
		$this->libredeuda = $soapclient->call('obtenerlibredeuda',array( 'iddni'=> $this->getUser()->getProfile()->getNrodoc(), 'idc'=> $request->getParameter('idc')));
	} // if ($request->getParameter('idc')
	if($request->getParameter('guardado')==1){
		$this->mensaje ="Se ha registrado correctamente la inscripción a la mesa de examen.";
	}       
  }

  public function executeInscribir(sfWebRequest $request)
  {
	$soapclient = new nusoap_client("http://190.228.68.196/ucu/sitio/webservices/inscripciones.php?wsdl");

	$this->guardado = $soapclient->call('inscribiralumnocursar',array( 'ida'=> $request->getParameter('idal'), 'iddp'=> $request->getParameter('idm')));
	
	$this->redirect('cursada/getmateriascursar?idc='.$request->getParameter('idc').'&ida='.$request->getParameter('ida').'&guardado='.$this->guardado);  
      
  }
}