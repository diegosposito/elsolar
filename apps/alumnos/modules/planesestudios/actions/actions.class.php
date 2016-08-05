<?php

/**
 * planesestudios actions.
 *
 * @package    sig
 * @subpackage planesestudios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planesestudiosActions extends sfActions
{ 
  public function executeObtenerprofesores(sfWebRequest $request)
  {
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$oFacultad = $oPlanEstudio->getCarreras()->getFacultades();
  	$this->profesores = Doctrine_Core::getTable('Profesores')->findByIdfacultad($oFacultad->getIdfacultad());
  }
  	
  public function executeObtenercatedrasconalumnos(sfWebRequest $request)
  {
  	$this->catedras = array();
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$catedras = $oPlanEstudio->obtenerCatedras($request->getParameter('idsede'));
  	foreach ($catedras as $catedra) {
  		if ($catedra->getCantidadAlumnosCursando() > 0) {
  			$this->catedras[$catedra->idcatedra] = $catedra;
  		}
  	}
  }  
  
  public function executeObtenercatedras(sfWebRequest $request)
  {
  	$this->catedras = "";
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$catedras = $oPlanEstudio->obtenerCatedras($request->getParameter('idsede'));
   	foreach ($catedras as $catedra) { 
  		$this->catedras[$catedra->idcatedra] = $catedra;
  	}  	
  }
  	 
  public function executeCargarmaterias(sfWebRequest $request)
  {	
	$this->redirect('materiasplanes/index?idplanestudio='.$request->getParameter('idplanestudio'));
  }	  
  
  public function executeActivar(sfWebRequest $request)
  {  
    $oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
    if($oPlanEstudio->getNroresolucion() != "") {
	    if ($oPlanEstudio->activar()) {
	      $resultado = "El elemento se ha creado correctamente.";
	    } else {
	      $resultado = "El elemento no se ha guardado porque se ha producido algún error.";
	    }
	} else {
		$resultado = "El elemento no puede ser activado porque no existe numero de resolucion cargado.";
	}
	
	echo $resultado;

	return sfView::NONE;		
  }	

  public function executeCrearversion(sfWebRequest $request)
  {  
    $oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));

    if (($oPlanEstudio->getIdestadoplan() == 1) or ($oPlanEstudio->getIdestadoplan() == 2)) {
    	$oNuevoPlanEstudio = new PlanesEstudios();
    
		$oNuevoPlanEstudio = $oPlanEstudio->copy(false); // no deep copy required
		$version = $oPlanEstudio->getVersion();
		$nuevaVersion = $version + 1;
		$oNuevoPlanEstudio->setVersion($nuevaVersion);
		$oNuevoPlanEstudio->setIdestadoplan(1);
		$oNuevoPlanEstudio->setIdplananterior($oPlanEstudio->getIdplanestudio());
		$oNuevoPlanEstudio->setNroresolucion("");
		
		$oNuevoPlanEstudio->save();
		
    	if ($oNuevoPlanEstudio->getIdplanestudio()) {
      		$resultado = "El elemento se ha creado correctamente.";
    	} else {
      		$resultado = "El elemento no se ha guardado porque se ha producido algún error.";
    	}
    } else {
    	$resultado = "El elemento debe estar activo.";
    }      
  	echo json_encode($resultado);

	return sfView::NONE;
  }	  
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->idcarrera = $request->getParameter('idcarrera');
    
  	if($this->idcarrera){
	  	$q = Doctrine_Core::getTable('PlanesEstudios')
	      ->createQuery('a')
	      ->where('a.idcarrera = ?', $this->idcarrera);
    } else {
	  	$q = Doctrine_Core::getTable('PlanesEstudios')
	      ->createQuery('a');
    }

     $this->pager = new sfDoctrinePager(
      'PlanesEstudios',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();      
  }

  public function executeObtenerllamadosexamenes(sfWebRequest $request)
  {
  	$oFechaCalendario = Doctrine_Core::getTable('FechasCalendario')->find($request->getParameter('idturno')); 	
  	$this->llamados = $oFechaCalendario->obtenerLlamados();
  }
    
  public function executeObtenerturnosexamenes(sfWebRequest $request)
  {
 	$oUsuario = $this->getUser()->getGuardUser();
 	$oPerfil = $oUsuario->getProfile();
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$oCarrera = $oPlanEstudio->getCarreras();
  	$oCalendario = Doctrine_Core::getTable('Calendarios')->obtenerCalendario($oCarrera->getIdfacultad(), $oPerfil->getIdsede()); 	

  	$this->turnos = $oCalendario->obtenerFechasPorTipo(7);
  }

  public function executeObtenermaterias(sfWebRequest $request)
  {
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$this->materias = $oPlanEstudio->obtenerMaterias(MATERIASNOGENERICAS);
  }
    
  public function executeNew(sfWebRequest $request)
  {
    $this->idcarrera = $request->getParameter('idcarrera');
  	$this->form = new PlanesEstudiosForm();

    $oEstadoPlan = Doctrine_Core::getTable('EstadosPlanes')->find(1);
    $this->estadoplan = $oEstadoPlan->getNombre();

    $this->form->setDefault('idcarrera', $this->idcarrera);
    $this->form->setDefault('idestadoplan', 1);
  }

  public function executeCreate(sfWebRequest $request)
  {
  	$this->forward404Unless($request->isMethod(sfRequest::POST));
  	
  	$arrPlanes = $request->getParameter('planes_estudios');
  	
  	$oEstadoPlan = Doctrine_Core::getTable('EstadosPlanes')->find($arrPlanes['idestadoplan']);
  	$this->estadoplan = $oEstadoPlan->getNombre();
  	$this->idcarrera = $arrPlanes['idcarrera'];
  	
    $this->form = new PlanesEstudiosForm();
   
    $this->processForm($request, $this->form);
    
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($planes_estudios = Doctrine_Core::getTable('PlanesEstudios')->find(array($request->getParameter('idplanestudio'))), sprintf('Object planes_estudios does not exist (%s).', $request->getParameter('idplanestudio')));
    $this->form = new PlanesEstudiosForm($planes_estudios);
    
    $oEstadoPlan = Doctrine_Core::getTable('EstadosPlanes')->find($planes_estudios->getIdestadoplan());
    $this->estadoplan = $oEstadoPlan->getNombre();
    $this->idcarrera = $planes_estudios->getIdcarrera();

    $arr = explode('-', $planes_estudios->getFechaaprobacion());
    $fecha = $arr[2]."-".$arr[1]."-".$arr[0];    
    $this->form->setDefault('fechaaprobacion', $fecha);
    $this->form->setDefault('idestadoplan', $planes_estudios->getIdestadoplan());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($planes_estudios = Doctrine_Core::getTable('PlanesEstudios')->find(array($request->getParameter('idplanestudio'))), sprintf('Object planes_estudios does not exist (%s).', $request->getParameter('idplanestudio')));
    $this->form = new PlanesEstudiosForm($planes_estudios);
    
    $oEstadoPlan = Doctrine_Core::getTable('EstadosPlanes')->find($planes_estudios->getIdestadoplan());
    $this->estadoplan = $oEstadoPlan->getNombre();
    $this->idcarrera = $planes_estudios->getIdcarrera();
    
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($planes_estudios = Doctrine_Core::getTable('PlanesEstudios')->find(array($request->getParameter('idplanestudio'))), sprintf('Object planes_estudios does not exist (%s).', $request->getParameter('idplanestudio')));
    $planes_estudios->delete();

    $this->redirect('planesestudios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
  	$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    if ($form->isValid())
    {
      //$planes_estudios = $form->save();
          
      $arrPlanes = $request->getParameter('planes_estudios');
      
      if($arrPlanes['idplanestudio']) {
      	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($arrPlanes['idplanestudio']);
      } else {
      	$oPlanEstudio = new PlanesEstudios();
      }
      
      $oPlanEstudio->setIdcarrera($arrPlanes['idcarrera']);
      $oPlanEstudio->setNombre($arrPlanes['nombre']);
      $oPlanEstudio->setVersion($arrPlanes['version']);
      $oPlanEstudio->setLetra($arrPlanes['letra']);
      $oPlanEstudio->setCantidadcomunes($arrPlanes['cantidadcomunes']);
      $oPlanEstudio->setCantidadoptativas($arrPlanes['cantidadoptativas']);
      $oPlanEstudio->setCantidadextracurriculares($arrPlanes['cantidadextracurriculares']);
      $oPlanEstudio->setCantidadpreuniversitarias($arrPlanes['cantidadpreuniversitarias']);
      $oPlanEstudio->setCantidadtesinas($arrPlanes['cantidadtesinas']);
      $oPlanEstudio->setCantidadtpfinal($arrPlanes['cantidadtpfinal']);
      $oPlanEstudio->setCantidadmaterias($arrPlanes['cantidadmaterias']);
      $oPlanEstudio->setDuracionnumerica($arrPlanes['duracionnumerica']);
      $oPlanEstudio->setHorastotales($arrPlanes['horastotales']);
      $oPlanEstudio->setNroresolucion($arrPlanes['nroresolucion']);
      $arr = explode('-', $arrPlanes['fechaaprobacion']);
      $fecha = $arr[2]."-".$arr[1]."-".$arr[0];      
      $oPlanEstudio->setFechaaprobacion($fecha);
      $oPlanEstudio->setIdestadoplan($arrPlanes['idestadoplan']);
      
      $oPlanEstudio->save();
            
      $this->redirect('planesestudios/edit?idplanestudio='.$oPlanEstudio->getIdplanestudio());
    }
  }


  public function executeSolicitarmodificacion(sfWebRequest $request)
  {
  	$oPlanesEstudios = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio')); 	

  	$nombreplan = $oPlanesEstudios->getNombre();
  	$versionplan = $oPlanesEstudios->getVersion();
  	$nroresplan = $oPlanesEstudios->getNroresolucion();
  	$letraplan = $oPlanesEstudios->getLetra();
  	$fechaplan = $oPlanesEstudios->getFecha();
  	$idcarrera = $oPlanesEstudios->getIdcarrera();

  	$oCarreras = Doctrine_Core::getTable('Carreras')->find($idcarrera); 

  	$nombrecarrera = $oCarreras->getNombre();		

	// Remitente
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();  	

	$destinatario = array('academica@ucu.edu.ar' => 'Secretaria Académica', 'informatica@ucu.edu.ar' => 'Departamento Informática', 'informatica@ucu.edu.ar' => 'Departamento Informática', $remitente  );
	
 	$mensaje = '
		**************************************************************************************
		**************************************************************************************

		Se solicita apertura de plan para modificaciones, esta peticion la realiza el usuario cuya cuenta de email es '.$remitente.', la carrera es '.$nombrecarrera.', el plan de estudio es "'.$nombreplan.'" - Se identifica en el sistema por la letra '.$letraplan.'
		**************************************************************************************
		**************************************************************************************';
		 
	$resultado = $this->getMailer()->composeAndSend(
	  $remitente,
	  $destinatario,
	  'Solicitud de Apertura de Plan para Cambios de '.$this->getUser()->getGuardUser()->getLastName().', '.$this->getUser()->getGuardUser()->getFirstName(),
	  $mensaje
	);
	if ($resultado) {

	      $respuesta = "Se ha enviado la solicitud. Este es un proceso que debe ser autorizado por Secretaría Académica.";
	} else {
	      $respuesta = "El elemento no se ha enviado porque se ha producido algún error.";
	}

	
	echo $respuesta;

	return sfView::NONE;	
  }

}
