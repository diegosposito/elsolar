<?php

/**
 * derivaciones actions.
 *
 * @package    sig
 * @subpackage derivaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class derivacionesActions extends sfActions
{ 
  public function executeIndex(sfWebRequest $request)
  { 
	$this->idarea = $this->getUser()->getProfile()->getIdarea();
	$this->idsede = $this->getUser()->getProfile()->getIdsede();
	$currentUser = sfContext::getInstance()->getUser();

  	$where = "ex.activo=1";
    $w = "";
    
  	if($request->getParameter('id')) {
    	$where .= " AND (de.idexpediente=".$request->getParameter('id'). ")";
    } else {
		if ((!in_array("biblioteca", $currentUser->getCredentials())) and (!in_array("administracion", $currentUser->getCredentials()))) {
    		$where .= " AND (de.idareadestino=".$this->idarea.")";
    	}
    }

    if ($currentUser->isAuthenticated() and in_array("biblioteca", $currentUser->getCredentials())) {
   		$where .= " AND (ex.idderivacionbiblioteca = 0) AND (ex.idsede = ".$this->idsede.")";
   		$w = " WHERE idareadestino=30 ";
   	}
   	if ($currentUser->isAuthenticated() and in_array("administracion", $currentUser->getCredentials())) {
   		
   		if($this->idsede==1) {  			
   			//$where .= " AND ((ex.idderivacionadministracion = 0 AND ex.idsede = 1) OR (ex.idderivacionadministracion != 0 AND ex.idsede != 1 AND de.idareadestino=11))";
   			$where .= " AND ex.idderivacionadministracion = 0";
   			$w = " WHERE (idareadestino=61 or idareadestino=11 or idareaorigen=61 or idareaorigen=11)";
   		} else {
			$where .= " AND (de.idareadestino=61) AND (ex.idderivacionadministracion = 0) AND (ex.idsede = ".$this->idsede.")";
			$w = " WHERE idareadestino=61 ";   	
   		}
	}
	
    // se obtienen todas las expedientes
	$this->expedientes_derivacioness = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
			SELECT de.*, ex.idsede
			FROM expedientes_egresados ex
			INNER JOIN ( 
				SELECT * FROM (
					SELECT * 
					FROM expedientes_derivaciones
					".$w."
					ORDER BY idderivacion DESC
				) AS der
				GROUP BY der.idexpediente
			) AS de ON ex.idexpediente=de.idexpediente
			WHERE ".$where
	);
  }
  
  public function executeVer(sfWebRequest $request)
  {
  	// Obtener el idarea 
  	$idarea = $this->getUser()->getProfile()->getIdarea();
  	
  	// se obtienen todas las derivaciones de un expediente
    $this->derivacioness = Doctrine_Query::create()
    	->select('d.*')
    	->from('ExpedientesDerivaciones d')
    	->where('d.idexpediente='.$request->getParameter('idexpediente'))
    	->orderBy('d.idderivacion DESC')
    	->execute();  
    	
   	foreach ($this->derivacioness as $derivacion) {
   		if ($derivacion->getIdareadestino()==$idarea) {
   			$derivacion->setLeido(1);
   			$derivacion->save();
   		}
   	}
  }  

  public function executeDerivar(sfWebRequest $request)
  {
  	$this->credencial = $request->getParameter('credencial');
  	$this->expediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
	$idarea = $this->getUser()->getProfile()->getIdarea();
	$idsede = $this->getUser()->getProfile()->getIdsede();

	// Auditoria Academica
    if($idarea==29) {
    	//$oUltimaDerivacion = $this->expediente->obtenerUltimaDerivacion();
    	//$oArea = Doctrine_Core::getTable('Areas')->find($oUltimaDerivacion->getIdareaorigen());
    	$oPrimeraDerivacion = $this->expediente->obtenerPrimeraDerivacion();
    	$oArea = Doctrine_Core::getTable('Areas')->find($oPrimeraDerivacion->getIdareaorigen());    	
		$arrDestinos = array($oArea->getIdarea() => $oArea->getDescripcion(), 31=>'Legalización de Titulos');
		if ($this->expediente->getIdsede()!=1) {
			$idcarrera = $this->expediente->getAlumnos()->getPlanesEstudios()->getIdcarrera();
		
			$areas = Doctrine_Core::getTable('AreasCarrera')->obtenerUnidadesAcademicas($idcarrera);
			foreach($areas as $area){
				if($idarea!=$area['idarea']){
					$arrDestinos[$area['idarea']] = $area['area'];
				}
			}
		}
	// Legalizacion de Titulos
    } elseif($idarea==31) {
		$oPrimeraDerivacion = $this->expediente->obtenerPrimeraDerivacion();
		$oArea = Doctrine_Core::getTable('Areas')->find($oPrimeraDerivacion->getIdareaorigen());
		$arrDestinos = array($oArea->getIdarea() => $oArea->getDescripcion(), 29=>'Auditoría Académica');
	// Administracion Central
	} elseif($idarea==11) {
		if($idsede==1) {
    		$oUltimaDerivacion = $this->expediente->obtenerUltimaDerivacion();
    		$oArea = Doctrine_Core::getTable('Areas')->find($oUltimaDerivacion->getIdareaorigen());
			$arrDestinos = array($oArea->getIdarea() => $oArea->getDescripcion());
		}	
	// Facultad	
	} else {
		// Sede Central
		if($idsede==1) {
			if ($this->expediente->getIdsede()==1) {
				$arrDestinos = array(29=>'Auditoría Académica', 31=>'Legalización de Titulos');
			} else {
				$arrDestinos = array(29=>'Auditoría Académica', 31=>'Legalización de Titulos', 11=>'Administración Central');
			}
		// Otras sedes
		} else {
			$arrDestinos = array(29=>'Auditoría Académica', 31=>'Legalización de Titulos');
		}
	}		
	
	$this->form = new ExpedientesDerivacionesForm();
	$this->form->setDefault('idexpediente', $request->getParameter('idexpediente'));
	$this->form->setDefault('idareaorigen', $this->getUser()->getProfile()->getIdarea());
	$this->form->getWidget('idareadestino')
      ->setOption('choices', $arrDestinos);
  }
  
  public function executeResponder(sfWebRequest $request)
  {
  	$this->derivacion = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($request->getParameter('idderivacion'));
  	$this->expediente = $this->derivacion->getExpedientesEgresados();
    $currentUser = sfContext::getInstance()->getUser();
    
	//if ($currentUser->isAuthenticated() && $currentUser->hasCredential("biblioteca")) {
    if ($currentUser->isAuthenticated() && in_array("biblioteca", $currentUser->getCredentials())) {
    	$this->usuario = "biblioteca";
		$this->form = new ExpedientesDerivacionesBibliotecaForm();
		if($this->derivacion->getLeido()==1) {
			if ($this->expediente->getIdderivacionbiblioteca()!=0) {
				$oDerivacionBiblio = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($this->expediente->getIdderivacionbiblioteca());
				$this->form->setDefault('idderivacion', $this->expediente->getIdderivacionbiblioteca());	    	
				$this->form->setDefault('aprobado', 1);
				$this->form->setDefault('observaciones', $oDerivacionBiblio->getObservaciones());
			}
			$nrolector = $this->expediente->getAlumnos()->getPersonas()->getNrolector();
			$this->form->setDefault('nrolector', $nrolector);
		}
	}
	
	//if ($currentUser->isAuthenticated() && $currentUser->hasCredential("administracion")) {
	if ($currentUser->isAuthenticated() && in_array("administracion", $currentUser->getCredentials())) {
		$this->usuario = "administracion";
    	$this->form = new ExpedientesDerivacionesAdministracionForm();
		if($this->derivacion->getLeido()) {
			if ($this->expediente->getIdderivacionadministracion()!=0) {
				$oDerivacionAdmin = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($this->expediente->getIdderivacionadministracion());
				$this->form->setDefault('idderivacion', $this->expediente->getIdderivacionadministracion());	    	
				$this->form->setDefault('aprobado', 1);
    			$this->form->setDefault('observaciones', $oDerivacionAdmin->getObservaciones());
			}
    		$nrolector = $this->expediente->getAlumnos()->getPersonas()->getNrolector();
    		$this->form->setDefault('nrorecibo1', $this->expediente->getNrorecibo1());
		}    	
    }
    $this->form->setDefault('idderivacionanterior', $request->getParameter('idderivacion'));
	$this->form->setDefault('idexpediente', $this->expediente->getIdexpediente());
	$this->form->setDefault('idareaorigen', $this->derivacion->getIdareaorigen());    
	$this->form->setDefault('idareadestino', $this->derivacion->getIdareadestino());
  }
  
  public function executeArchivar(sfWebRequest $request)
  {  
	$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
	$oExpediente->setActivo(0);
	$oExpediente->save();

	if ($request->getParameter('credencial')=="sede") {
  		$url = 'expedientes/indexsede';
  	} else {
  		$url = 'expedientes/indexfacultad';
  	}
   	
	$this->redirect($url);	
  }  
    
  public function executeGuardarderivacion(sfWebRequest $request)
  {  
  	$url = $request->getParameter('url');
  	$idarea = $this->getUser()->getProfile()->getIdarea();
	
  	$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($request->getPostParameter('expedientes_derivaciones[idexpediente]'));
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($oExpediente->getIdalumno());
  	$oUser = Doctrine_Core::getTable('sfGuardUser')->find($oExpediente->created_by);
  	
  	$oDerivacion = new ExpedientesDerivaciones();
	
	$oDerivacion->setIdexpediente($request->getPostParameter('expedientes_derivaciones[idexpediente]'));
	$oDerivacion->setIdareaorigen($request->getPostParameter('expedientes_derivaciones[idareaorigen]'));
	$oDerivacion->setIdareadestino($request->getPostParameter('expedientes_derivaciones[idareadestino]'));
	$oDerivacion->setObservaciones($request->getPostParameter('expedientes_derivaciones[observaciones]'));
	$oDerivacion->setActivo(1);
	$oDerivacion->setLeido(0);
	 	  
	$oDerivacion->save();	
	
	$asunto = "SAO - Gestion de Diploma: Derivacion";
	
	$observaciones = ($request->getPostParameter('expedientes_derivaciones[observaciones]') ? $request->getPostParameter('expedientes_derivaciones[observaciones]') : "Sin Observaciones.");
	
	// LOS MAILS NO ESTAN CONFIGURADOS EN TABLAS POR LO QUE SE AGREGO MANUALMENTE
	if($request->getPostParameter('expedientes_derivaciones[idareadestino]')==30) { // Biblioteca
		$destinatario = array('biblioteca@ucu.edu.ar' => 'UCU - Biblioteca Central' );
	} elseif ($request->getPostParameter('expedientes_derivaciones[idareadestino]')==31) { // Titulos
		$destinatario = array('legalizacionestitulos@ucu.edu.ar' => 'UCU - Legalizaciones de Títulos');
	} elseif ($request->getPostParameter('expedientes_derivaciones[idareadestino]')==29) { // Auditoria Academica
		$destinatario = array('auditoriaacademica@ucu.edu.ar' => 'UCU - Auditoria Academica');
	} else {
		$nombre_usuario = $oUser->getFirstName().' '.$oUser->getLastName();
		$email_usuario = $oUser->getEmailAddress(); 
		$destinatario = array($email_usuario => $nombre_usuario , 'secgeneral@ucu.edu.ar' => 'UCU - Secretaria General');
	}
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
	$mensaje = '
		**************************************************************************************
		**************************************************************************************
	
		Se derivó el diploma sobre del alumno '.$oAlumno->getPersonas().' ('.$oAlumno->getIdalumno().'), de la carrera '.$oExpediente->getTitulos().' y de la sede '.$oAlumno->getSedes().'
		Observaciones: '.$observaciones.'
		**************************************************************************************
		**************************************************************************************';
		
	$resultado = $this->getMailer()->composeAndSend(
			$remitente,
			$destinatario,
			$asunto,
			$mensaje
	);	
	
	$this->redirect($url);
  }  
  
  public function executeGuardarbiblioteca(sfWebRequest $request)
  {
  	$arreglo = $request->getParameter('expedientes_derivaciones');
  
  	$oDerivacionAnt = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($arreglo['idderivacionanterior']);
  	$oDerivacionAnt->setLeido(1);
  	$oDerivacionAnt->save();
  
  	if($arreglo['idderivacion']) {
  		$oDerivacion = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($arreglo['idderivacion']);
  	} else {
  		$oDerivacion = new ExpedientesDerivaciones();
  	}
  	$observaciones = $arreglo['observaciones'];
  	$oDerivacion->setIdexpediente($arreglo['idexpediente']);
  	$oDerivacion->setIdareaorigen($arreglo['idareadestino']);
  	$oDerivacion->setIdareadestino($arreglo['idareaorigen']);
  	$oDerivacion->setObservaciones($observaciones);
  	$oDerivacion->setActivo(1);
  	$oDerivacion->setLeido(0);
  		
  	$oDerivacion->save();
  		
  	$oExpediente = Doctrine::getTable('ExpedientesEgresados')->find(array($arreglo['idexpediente']));
  
  	// Biblioteca
  	if(($arreglo['aprobado']==1) && ($arreglo['nrolector']!="")){
  		$oExpediente->setIdderivacionbiblioteca($oDerivacion->getIdderivacion());
  	}
  	if ($arreglo['nrolector']!=""){
  		$oPersona = $oExpediente->getAlumnos()->getPersonas();
  		$oPersona->setNrolector($arreglo['nrolector']);
  		$oPersona->save();
  	}
  
	$oUser = Doctrine_Core::getTable('sfGuardUser')->find($oExpediente->created_by);
	$destinatario = $oUser->getEmailAddress();
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
	$asunto = "SAO - Gestion de Diploma: Respuesta";

	$mensaje = '
		**************************************************************************************
		**************************************************************************************
  
		NOTIFICAR AL ALUMNO DE LA SITUACIÓN
		Se respondio la solicitud de diploma sobre del alumno '.$oExpediente->getAlumnos()->getPersonas().' ('.$oExpediente->getAlumnos()->getIdalumno().'), de la carrera '.$oExpediente->getTitulos().' y de la sede '.$oExpediente->getAlumnos()->getSedes().'
		Observaciones: '.$observaciones.'
		**************************************************************************************
		**************************************************************************************';
  
	$resultado = $this->getMailer()->composeAndSend(
			$remitente,
			$destinatario,
			$asunto,
  			$mensaje
	);
  
  	$oExpediente->save();
  
  	echo "Se ha guardado correctamente el expediente.";
  
  	return sfView::NONE;
  }  
  
  public function executeGuardaradministracion(sfWebRequest $request)
  {
  	$arreglo = $request->getParameter('expedientes_derivaciones');
  
  	$oDerivacionAnt = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($arreglo['idderivacionanterior']);
  	$oDerivacionAnt->setLeido(1);
  	$oDerivacionAnt->save();
  
  	if($arreglo['idderivacion']) {
  		$oDerivacion = Doctrine_Core::getTable('ExpedientesDerivaciones')->find($arreglo['idderivacion']);
  	} else {
  		$oDerivacion = new ExpedientesDerivaciones();
  	}
  	$observaciones = $arreglo['observaciones'];
  	$oDerivacion->setIdexpediente($arreglo['idexpediente']);
  	$oDerivacion->setIdareaorigen($arreglo['idareadestino']);
  	$oDerivacion->setIdareadestino($arreglo['idareaorigen']);
  	$oDerivacion->setObservaciones($observaciones);
  	$oDerivacion->setActivo(1);
  	$oDerivacion->setLeido(0);
  		
  	$oDerivacion->save();
  		
  	$oExpediente = Doctrine::getTable('ExpedientesEgresados')->find(array($arreglo['idexpediente']));
  
  	// Administracion
  	if(($arreglo['aprobado']==1) && ($arreglo['nrorecibo1']!="")){
  		$oExpediente->setIdderivacionadministracion($oDerivacion->getIdderivacion());
  	}
  	if($arreglo['nrorecibo1']!=""){
  		$oExpediente->setNrorecibo1($arreglo['nrorecibo1']);
  		if($arreglo['tipopago']==1) {
  			$oExpediente->setNrorecibo2($arreglo['nrorecibo1']);
  		}
  	}
  	 
	$oUser = Doctrine_Core::getTable('sfGuardUser')->find($oExpediente->created_by);
	$destinatario = $oUser->getEmailAddress();
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
	$asunto = "SAO - Gestion de Diploma: Respuesta";
  
	$mensaje = '
		**************************************************************************************
		**************************************************************************************
  
		NOTIFICAR AL ALUMNO DE LA SITUACIÓN
		Se respondio la solicitud de diploma sobre del alumno '.$oExpediente->getAlumnos()->getPersonas().' ('.$oExpediente->getAlumnos()->getIdalumno().'), de la carrera '.$oExpediente->getTitulos().' y de la sede '.$oExpediente->getAlumnos()->getSedes().'
		Observaciones: '.$observaciones.'
		**************************************************************************************
		**************************************************************************************';
  
	$resultado = $this->getMailer()->composeAndSend(
			$remitente,
			$destinatario,
			$asunto,
			$mensaje
	);

  	// Titulos
  	if($arreglo['nroRegistro']!=""){
  		$oExpediente->setRegistroME($arreglo['nroregistro']);
  		$oExpediente->setFechaEntregaTitulo($arreglo['fechaentregatitulo']);
  	}
  
  	$oExpediente->save();
  
  	echo "Se ha guardado correctamente el expediente.";
  
  	return sfView::NONE;
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ExpedientesDerivacionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($expedientes_derivaciones = Doctrine_Core::getTable('ExpedientesDerivaciones')->find(array($request->getParameter('idderivacion'))), sprintf('Object expedientes_derivaciones does not exist (%s).', $request->getParameter('idderivacion')));
    $this->form = new ExpedientesDerivacionesForm($expedientes_derivaciones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($expedientes_derivaciones = Doctrine_Core::getTable('ExpedientesDerivaciones')->find(array($request->getParameter('idderivacion'))), sprintf('Object expedientes_derivaciones does not exist (%s).', $request->getParameter('idderivacion')));
    $this->form = new ExpedientesDerivacionesForm($expedientes_derivaciones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($expedientes_derivaciones = Doctrine_Core::getTable('ExpedientesDerivaciones')->find(array($request->getParameter('idderivacion'))), sprintf('Object expedientes_derivaciones does not exist (%s).', $request->getParameter('idderivacion')));
    $expedientes_derivaciones->delete();

    $this->redirect('derivaciones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $expedientes_derivaciones = $form->save();

      $this->redirect('derivaciones/edit?idderivacion='.$expedientes_derivaciones->getIdderivacion());
    }
  }
}
