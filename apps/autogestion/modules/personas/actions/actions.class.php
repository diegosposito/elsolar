<?php

/**
 * facultad actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personasActions extends sfActions
{ 	  	
    public function executeCarreraspersonas(sfWebRequest $request) {
		$this->resultado = array();
		$this->activo = false;
    					
		$this->form = new BuscarCarrerasPersonasForm(array(
		    'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
		));	
		    
	    if ($request->isMethod('post')) {
			$this->form->bind($request->getParameter($this->form->getName()));
			
		    if ($this->form->isValid()) {
		        //el combo de carreras contiene el id de alumno por cada carrera
				$this->idalumno = $this->form->getValue('carrera');
            	        	    
				$this->getUser()->setAttribute('idalumno',$this->idalumno);
        	        	        	        	    
        		$this->resultado = Doctrine_Core::getTable('AluMat')->getMateriasCursando($this->idalumno);	
		            	        	        	        					    
				// obtengo el ciclo actual
				$arrcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getCicloActual();
				echo "/";											    
				$cicloactual=0;									    
				foreach($arrcicloactual as $ciclo) { 
					foreach($ciclo as $c) {
						// obtengo el id ciclo lectivo actual
						if ($c!='') {$cicloactual=$c['id'];}
					}
				}
			    	
				echo $cicloactual.'*';	        		    			
				$this->activo = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($cicloactual, $this->idalumno);
			}
		}
	}	

	// Guarda la documentacion laboral seleccionada de la persona
	public function executeGuardardocumentacionlaboral(sfWebRequest $request) {
  		if($request->getParameter('iddoclaboral')) {
  			$oDocLaboral = Doctrine_Core::getTable('DocLaboral')->find($request->getParameter('iddoclaboral'));
  		} else {
  			$oDocLaboral = new DocLaboral();
  		}
  		$oDocLaboral->setIdpersona($request->getParameter('idpersona'));
  		$oDocLaboral->setIdprofesion($request->getParameter('profesion'));
  		$oDocLaboral->setIddedicacion($request->getParameter('dedicacion'));
  		$oDocLaboral->setLugar($request->getParameter('lugar'));
  		$oDocLaboral->setIdunidadtiempo(1);
  		$oDocLaboral->setCertificado($request->getParameter('certificado'));
  		$oDocLaboral->setTrabaja($request->getParameter('trabaja'));
  		$oDocLaboral->save();

  		return sfView::NONE;  	
	}
  
	// Elimina la documentacion laboral seleccionada de la persona
	public function executeEliminardocumentacionlaboral(sfWebRequest $request) {
  		$oDocLaboral = Doctrine_Core::getTable('DocLaboral')->find($request->getParameter('iddoclaboral'));
  		$oDocLaboral->delete();
	
  		return sfView::NONE;  	
  	}

	// Modifica la documentacion laboral seleccionada de la persona
	public function executeModificardocumentacionlaboral(sfWebRequest $request) {
  		$oDocLaboral = Doctrine_Core::getTable('DocLaboral')->find($request->getParameter('iddoclaboral'));
  		
  		$resultado['profesion'] = $oDocLaboral->getIdprofesion();
  		$resultado['dedicacion'] = $oDocLaboral->getIddedicacion();
  		$resultado['lugar'] = $oDocLaboral->getLugar();
  		$resultado['certificado'] = $oDocLaboral->getCertificado();
  		
  		echo json_encode($resultado);
	
  		return sfView::NONE;
  	}  	
  	
	public function executeGuardarcontacto(sfWebRequest $request) {
  		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
	  	/////////////////////////////////////////////////////
		//conexion webservice alumnos
		$soapclient = new nusoap_client("http://192.168.2.195:9000/alumnos/nuevaspersonas.php?wsdl");
		$soapclient->setCredentials("root", "sistemas2009");
		
		//llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('actualizarcontacto',
			array( 
			'idpersona' => $oPersona->getIdpersona(), 
			'idtipocontacto' => 1, 
			'idciudad' => $request->getParameter('ciudadresidenciaE'), 
			'campo1' => $request->getParameter('nombrecalleE'), 
			'campo2' => $request->getParameter('edificioE'), 
			'campo3' => $request->getParameter('casaE'), 
			'campo4' => $request->getParameter('deptoE'), 
			'campo5' => $request->getParameter('manzanaE'), 
			'campo6' => $request->getParameter('barrioE'), 
			'campo7' => $request->getParameter('pisoE'),       
			'campo8' => $request->getParameter('nrocalleE'))
		);			       
		$resultado = $soapclient->call('actualizarcontacto',
			array( 
			'idpersona' => $oPersona->getIdpersona(), 
			'idtipocontacto' => 2, 
			'idciudad' => $request->getParameter('ciudadresidenciaT'), 
			'campo1' => $request->getParameter('nombrecalleT'), 
			'campo2' => $request->getParameter('edificioT'), 
			'campo3' => $request->getParameter('casaT'), 
			'campo4' => $request->getParameter('deptoT'), 
			'campo5' => $request->getParameter('manzanaT'), 
			'campo6' => $request->getParameter('barrioT'), 
			'campo7' => $request->getParameter('pisoT'),       
			'campo8' => $request->getParameter('nrocalleT'))
		);
		$resultado = $soapclient->call('actualizarcontacto',
			array(
			'idpersona' => $oPersona->getIdpersona(), 
			'idtipocontacto' => 3,  
			'campo3' => $request->getParameter('areatelefonofijo'), 
			'campo4' => $request->getParameter('nrotelefonofijo'))
		);
		$resultado = $soapclient->call('actualizarcontacto',
			array(
			'idpersona' => $oPersona->getIdpersona(), 
			'idtipocontacto' => 4,  
			'campo3' => $request->getParameter('areatelefonomovil'), 
			'campo4' => $request->getParameter('nrotelefonomovil'))
		);
		$resultado = $soapclient->call('actualizarcontacto',
			array(
			'idpersona' => $oPersona->getIdpersona(), 
			'idtipocontacto' => 7,  
			'campo1' => $request->getParameter('email'))
		);		
	  	/////////////////////////////////////////////////////	  		
	  	// Obtiene el contacto de la persona
		$oContacto = $oPersona->getContacto();

		// Guarda los datos del contacto
		$oContacto->setIdciudade($request->getParameter('ciudadresidenciaE'));
		$oContacto->setCallee($request->getParameter('nombrecalleE'));
		$oContacto->setNumeroe($request->getParameter('nrocalleE'));
		$oContacto->setBarrioe($request->getParameter('barrioE'));
		$oContacto->setEdificioe($request->getParameter('edificioE'));
		$oContacto->setPisoe($request->getParameter('pisoE'));
		$oContacto->setDeptoe($request->getParameter('deptoE'));
		$oContacto->setIdciudadt($request->getParameter('ciudadresidenciaT'));
		$oContacto->setCallet($request->getParameter('nombrecalleT'));
		$oContacto->setNumerot($request->getParameter('nrocalleT'));
		$oContacto->setBarriot($request->getParameter('barrioT'));
		$oContacto->setEdificiot($request->getParameter('edificioT'));
		$oContacto->setPisot($request->getParameter('pisoT'));
		$oContacto->setDeptot($request->getParameter('deptoT'));
		$oContacto->setTelefonofijocar($request->getParameter('areatelefonofijo'));
		$oContacto->setTelefonofijonum($request->getParameter('nrotelefonofijo'));
		$oContacto->setCelularcar($request->getParameter('areatelefonomovil'));
		$oContacto->setCelularnum($request->getParameter('nrotelefonomovil'));
		$oContacto->setEmail($request->getParameter('email'));

		$oContacto->save();	
		
  		// Obtiene el usuario
		//$oUsuario = sfContext::getInstance()->getUser()->getGuardUser();
		//$oUsuario->setEmailAddress($oContacto->getEmail1());
		//$oUsuario->setUsername($oContacto->getEmail1());
		//$oUsuario->save();
			  	
		return sfView::NONE;
	}	
	
	public function executeGuardarinformacionpersonal(sfWebRequest $request) {
  		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
	  	/////////////////////////////////////////////////////
		//conexion webservice alumnos
		$soapclient = new nusoap_client("http://192.168.2.195:9000/alumnos/nuevaspersonas.php?wsdl");
		$soapclient->setCredentials("root", "sistemas2009");
		
		//llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('actualizarpersona',
			array('idpersona' => $request->getParameter('idpersona'),
			'estadocivil' => $request->getParameter('estadocivil'))
		);
						       
		$this->persona = unserialize(base64_decode($resultado));  	
	  	/////////////////////////////////////////////////////	
  		// Guarda los datos personales
	  	$oPersona->setEstadocivil($request->getParameter('estadocivil'));
	  	$oPersona->save();
	  	
	  	echo $oPersona->getIdpersona();
	  	
		return sfView::NONE;
	}	
		  	
	public function executeModificardatospersonales(sfWebRequest $request) {
		$this->form = new ModificarPersonaForm();
		// Busca si existe la persona
		$usuario = sfContext::getInstance()->getUser()->getProfile();		

		$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($usuario->getTipodoc(),$usuario->getNrodoc());
		if($oPersona){			
			// Si existe obtiene todos los datos personales y los muestra en pantalla
			$this->form->setDefault('idpersona', $oPersona->getIdpersona());
			$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($oPersona->getIdtipodoc());
			$this->form->setDefault('tipodocumento', $oTipoDocumento->getDescripcion()."(".$oTipoDocumento->getPaises()->getAbreviacion().")");
			$this->form->setDefault('nrodocumento', $oPersona->getNrodoc());
			$this->form->setDefault('nombre', $oPersona->getNombre());
			$this->form->setDefault('apellido', $oPersona->getApellido());
			$this->form->setDefault('idsexo', $oPersona->getIdsexo());
			$this->form->setDefault('estadocivil', $oPersona->getEstadocivil());
			$oCiudadNacimiento = Doctrine_Core::getTable('Ciudades')->find($oPersona->getIdciudadnac());
			$this->form->setDefault('ciudadnacimiento', $oCiudadNacimiento);
			$oProvinciaNacimiento = Doctrine_Core::getTable('Provincias')->find($oCiudadNacimiento->getIdprovincia());
			$this->form->setDefault('provincianacimiento', $oProvinciaNacimiento);
			$oPaisNacimiento = Doctrine_Core::getTable('Paises')->find($oProvinciaNacimiento->getIdpais());
			$this->form->setDefault('paisnacimiento', $oPaisNacimiento);
			$arr = explode('-', $oPersona->getFechanac());
			$this->form->setDefault('fechanacimiento', $arr[2]."-".$arr[1]."-".$arr[0]);
	  		// Obtiene el contacto de la persona
			$oContacto = $oPersona->getContacto();			
			$this->form->setDefault('nombrecalleE', $oContacto->getCallee());
			$this->form->setDefault('nrocalleE', $oContacto->getNumeroe());
			$this->form->setDefault('barrioE', $oContacto->getBarrioe());
			$this->form->setDefault('edificioE', $oContacto->getEdificioe());
			$this->form->setDefault('pisoE', $oContacto->getPisoe());
			$this->form->setDefault('deptoE', $oContacto->getDeptoe());
			$this->idciudadresE = $oContacto->getIdciudade();
			if(($this->idciudadresE != 0) && ($this->idciudadresE != NULL)) {
				$ciudadresidenciaE = Doctrine_Core::getTable('Ciudades')->find($this->idciudadresE);
				$provinciaresidenciaE = Doctrine_Core::getTable('Provincias')->find($ciudadresidenciaE->getIdprovincia());
				$this->idprovinciaresE = $provinciaresidenciaE->getIdprovincia();
				$paisresidenciaE = Doctrine_Core::getTable('Paises')->find($provinciaresidenciaE->getIdpais());
		  		$this->idpaisresE = $paisresidenciaE->getIdpais();
			} else {
				$this->idciudadresE = 0;
			}	
			$this->form->setDefault('nombrecalleT', $oContacto->getCallet());
			$this->form->setDefault('nrocalleT', $oContacto->getNumerot());
			$this->form->setDefault('barrioT', $oContacto->getBarriot());
			$this->form->setDefault('edificioT', $oContacto->getEdificiot());
			$this->form->setDefault('pisoT', $oContacto->getPisot());
			$this->form->setDefault('deptoT', $oContacto->getDeptot());
			$this->idciudadresT = $oContacto->getIdciudadt();
			if(($this->idciudadresT != 0) && ($this->idciudadresT != NULL)) {
				$ciudadresidenciaT = Doctrine_Core::getTable('Ciudades')->find($this->idciudadresT);
				$provinciaresidenciaT = Doctrine_Core::getTable('Provincias')->find($ciudadresidenciaT->getIdprovincia());
				$this->idprovinciaresT = $provinciaresidenciaT->getIdprovincia();
				$paisresidenciaT = Doctrine_Core::getTable('Paises')->find($provinciaresidenciaT->getIdpais());
	  			$this->idpaisresT = $paisresidenciaT->getIdpais();
			} else {
				$this->idciudadresT = 0;
			}
	  		$this->form->setDefault('areatelefonofijo', $oContacto->getTelefonofijocar());
	  		$this->form->setDefault('nrotelefonofijo', $oContacto->getTelefonofijonum());
	  		$this->form->setDefault('areatelefonomovil', $oContacto->getCelularcar());
	  		$this->form->setDefault('nrotelefonomovil', $oContacto->getCelularnum());
	  		$this->form->setDefault('email', $oContacto->getEmail());
		}else{
			$this->idciudadnac = 0;
			$this->idciudadresT = 0;
		}
	}		

	// Obtiene las documentaciones laborales de la persona
	public function executeObtenerdocumentacioneslaborales(sfWebRequest $request)	{
		$persona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
		// Obtiene las documentaciones laborales de la persona					
		$this->documentacioneslaborales = $persona->getDocumentacionesLaborales();			
	}	
				
	public function executeIndex(sfWebRequest $request)	{
		$soapclient = new nusoap_client("http://192.168.2.197:9090/administracion/webservices/personacuenta.php?wsdl");
		$soapclient->setCredentials("root", "sistemas2009");

		if ($_POST){
			// Obtener personas relacionadas a la facultad del usuario con perfil de facultad
			$personas = $soapclient->call('personassegunfiltro', array( 'idn'=> $request->getParameter('apellido'), 'iddni'=> $request->getParameter('dni')));     
			
			$this->personas = unserialize(base64_decode($personas));
		}    

		if ($_GET){
			//obtener cuentas
			$planespersona = $soapclient->call('obtenercuentaspersona',array( 'value'=> $request->getParameter('idpersona')));
			$soapclient->setCredentials("root", "sistemas2009");

			$this->cuentas = unserialize(base64_decode($planespersona)); 

			// se debe registrar la consulta del usuario
			$oHistoricoConsultas = new HistoricoConsultas();

			$this->alumno=$request->getParameter('nombre');

  			foreach($this->cuentas as $cuenta){
				if ($cuenta[4]>=date('Y-m-d')){ $mensaje=$cuenta[4]; } else { $mensaje= 'Consultar Administracion'; };			
				$oHistoricoConsultas->setAlumno($request->getParameter('nombre'));
				$oHistoricoConsultas->setCarrera($cuenta[0]);
				$oHistoricoConsultas->setMensaje($mensaje);
				$oHistoricoConsultas->setUsuario($this->getUser()->getUsername());
			      		
				$oHistoricoConsultas->save();
  			}
		}
	}  
   
  public function executeGetanalitico(sfWebRequest $request) {
	//$soapclient = new nusoap_client("http://192.168.2.197:9999/sumar.php?wsdl");
	$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/personas.php?wsdl");
	
	//llamamos la función implementada en el server.php de la siguiente manera
	$resultado = $soapclient->call('obtenerpersona',array( 'value'=> $this->getUser()->getProfile()->getNrodoc()));
	
	$this->persona = unserialize(base64_decode($resultado));
	       
	//obtener planes
	$planespersona = $soapclient->call('obtenerplanes',array( 'value'=> $this->persona['idPersona']));
	       
	$this->planes = unserialize(base64_decode($planespersona));      
	$this->analitico="";
	           
	if ($request->getParameter('idc')){
		$analitico = $soapclient->call('obteneranalitico',array( 'idp'=> $this->persona['idPersona'],  'idc'=> $request->getParameter('idc')));         
		$this->analitico = unserialize(base64_decode($analitico));
	}
	        
	$this->idp = $this->persona['idPersona'];
  }
  
  public function executeGetmateriascursar(sfWebRequest $request) {
	$this->mensaje ="";   
	$this->materiascursar="";
	$this->planes= array();
	$this->inscriptoCiclo= array();
				   
	$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/personas.php?wsdl");

	//llamamos la función implementada en el server.php de la siguiente manera
	$resultado = $soapclient->call('obtenerpersona',array( 'value'=> $this->getUser()->getProfile()->getDni()));
	$this->persona = unserialize(base64_decode($resultado));

	//obtener el alumno
	if ($request->getParameter('idc')!=""){
		$resultado = $soapclient->call('obteneralumno',array( 'idp'=> $this->persona['idPersona'],
               					                                 'idc'=> $request->getParameter('idc')));
		$this->alumno = unserialize(base64_decode($resultado));
	}       					         
       
	//obtener planes
	$resultado = $soapclient->call('obtenerplanes',array( 'value'=> $this->persona['idPersona']));
	$this->planess = unserialize(base64_decode($resultado));
            
	$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdUltimoCicloLectivoActivo();

	//busco si esta activo el ciclo lectivo para realizar actividades con el sistema
	if ($idcicloactual > 0) {
		$InscripcionesCicloLectivo= new InscripcionesCicloLectivo();

		// Muestra los planes donde el alumno esta activo en ciclo lectivo
		foreach ($this->planess as $plan_estudio){
			$plan=Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($idcicloactual, $plan_estudio['idAl']);
			    
			if($plan) array_push($this->planes, $plan_estudio);
		    
		}
	}

	// Si ya selecciono la carrera, analizo las mesas a mostrar
	if ($request->getParameter('idc') ){
      	  
		$this->idcarrera = $request->getParameter('idc');
       	
		$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/inscripciones.php?wsdl");
          
		// Obtener materias habilitadas para cursar
		$materiashabilitadas = $soapclient->call('obtenermateriashabilitadas',array( 'idp'=> $this->persona['idPersona'], 'idc'=> $request->getParameter('idc'), 'ids'=> "C"));
		$materias = unserialize(base64_decode($materiashabilitadas));
         
		// Prepara string para filtrar materias habilitadas para cursar
		$sMaterias = "";
		foreach($materias as $mat){
			$sMaterias = $mat[0].", ";
		}           
           
		$sMaterias = substr($sMaterias, 0, strlen($sMaterias)-2);
		$materias_serialize = base64_encode(serialize($sMaterias));
           
		// Obtener materias para cursar habilitadas para el usuario (segun correlatividad)  
		$materiascursarhabilitadas = $soapclient->call('obtenermateriascursarhabilitadas',array( 'ida'=> $this->alumno[0], 'idc'=> $request->getParameter('idc'), 'iddetalleplanes'=> $materias_serialize));
		$this->materiascursar = unserialize(base64_decode($materiascursarhabilitadas));
                      
		// Obtener libre deuda
		$soapclient = new nusoap_client("http://192.168.2.197:9090/administracion/webservices/personacuenta.php?wsdl");
		$soapclient->setCredentials("root", "sistemas2009");

		//Obtener libre deuda por dni
		$this->libredeuda = $soapclient->call('obtenerlibredeuda',array( 'iddni'=> $this->getUser()->getProfile()->getDni(), 'idc'=> $request->getParameter('idc')));
        
	} //if ($request->getParameter('idc')
	if($request->getParameter('guardado')==1){
		$this->mensaje ="Se ha registrado correctamente la inscripción a la mesa de examen.";
	}       
  }

	public function executeGetmesasexamenes(sfWebRequest $request) {
		$this->mensaje = "";   
		$this->mesasexamenes = "";
		$this->planes = array();
		$this->inscriptoCiclo = array();

		$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/personas.php?wsdl");

		// llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('obtenerpersona',array( 'value'=> $this->getUser()->getProfile()->getDni()));
		$this->persona = unserialize(base64_decode($resultado));

		// obtener el alumno
		if ($request->getParameter('idc')!=""){
			$resultado = $soapclient->call('obteneralumno',array( 'idp'=> $this->persona['idPersona'],
				'idc'=> $request->getParameter('idc')));
			$this->alumno = unserialize(base64_decode($resultado));
		}       					         

		// obtener planes
		$resultado = $soapclient->call('obtenerplanes',array( 'value'=> $this->persona['idPersona']));
		$this->planess = unserialize(base64_decode($resultado));

		$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdUltimoCicloLectivoActivo();
		
		// busco si esta activo el ciclo lectivo para realizar actividades con el sistema
		if ($idcicloactual > 0) {
			$InscripcionesCicloLectivo = new InscripcionesCicloLectivo();

			// Muestra los planes donde el alumno esta activo en ciclo lectivo
			foreach ($this->planess as $plan_estudio){
				$plan = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($idcicloactual, $plan_estudio['idAl']);

				if($plan) array_push($this->planes, $plan_estudio);
			}
		}
		// Si ya selecciono la carrera, analizo las mesas a mostrar
		if ($request->getParameter('idc')){
			$this->idcarrera = $request->getParameter('idc');

			$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/inscripciones.php?wsdl");

			// Obtener materias habilitadas para rendir
			$materiashabilitadas = $soapclient->call('obtenermateriashabilitadas',array( 'idp'=> $this->persona['idPersona'], 'idc'=> $request->getParameter('idc'), 'ids'=> "R"));
			$materias = unserialize(base64_decode($materiashabilitadas));

			// Prepara string para filtrar mesas de examenes por materias habilitadas para rendir
			$sMaterias = "";
			foreach($materias as $mat){
				$sMaterias = $mat[0].", ";
			}           

			$sMaterias = substr($sMaterias, 0, strlen($sMaterias)-2);
			$materias_serialize = base64_encode(serialize($sMaterias));

			// Obtener mesas habilitadas para el usuario (segun correlatividad)  
			$mesasexameneshabilitadas = $soapclient->call('obtenermesasexameneshabilitadas',array( 'ida'=> $this->alumno[0], 'idc'=> $request->getParameter('idc'), 'iddetalleplanes'=> $materias_serialize));
			$this->mesasexamenes = unserialize(base64_decode($mesasexameneshabilitadas));

			// Obtener libre deuda
			$soapclient = new nusoap_client("http://192.168.2.197:9090/administracion/webservices/personacuenta.php?wsdl");
			$soapclient->setCredentials("root", "sistemas2009");

			// Obtener libre deuda por dni
			$this->libredeuda = $soapclient->call('obtenerlibredeuda',array( 'iddni'=> $this->getUser()->getProfile()->getDni(), 'idc'=> $request->getParameter('idc')));
		} //if ($request->getParameter('idc')
		if($request->getParameter('guardado')==1){
			$this->mensaje ="Se ha registrado correctamente la inscripción a la mesa de examen.";
		}       
	} 
  
	public function executeInscribir(sfWebRequest $request) {
		$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/inscripciones.php?wsdl");

		if($request->getParameter('tipo')=="C"){
			// Inscribir alumno a mesa de examen
			$this->guardado = $soapclient->call('inscribiralumnocursar',array( 'ida'=> $request->getParameter('ida'), 'iddp'=> $request->getParameter('idm')));

			$this->redirect('personas/getmateriascursar?idc='.$request->getParameter('idc').'&ida='.$request->getParameter('ida').'&guardado='.$this->guardado);  
		}else{
			// Inscribir alumno a mesa de examen
			$this->guardado = $soapclient->call('inscribiralumnomesa',array( 'ida'=> $request->getParameter('ida'), 'idf'=> $request->getParameter('ide')));

			$this->redirect('personas/getmesasexamenes?idc='.$request->getParameter('idc').'&ida='.$request->getParameter('ida').'&guardado='.$this->guardado);  
		}          
	}
  
	public function executeGetcuentas(sfWebRequest $request) {
		//$soapclient = new nusoap_client("http://192.168.2.197:9999/sumar.php?wsdl");
		$soapclient = new nusoap_client("http://192.168.2.197:9090/administracion/webservices/personacuenta.php?wsdl");
	
		$soapclient->setCredentials("root", "sistemas2009");
	
		// llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('obtenerpersona',array( 'value'=> $this->getUser()->getProfile()->getDni()));
	
		$this->persona = unserialize(base64_decode($resultado));
	
		// lobtener planes
		$cuentaspersona = $soapclient->call('obtenercuentaspersona',array( 'value'=> $this->persona['id']));
	
		$this->cuentas = unserialize(base64_decode($cuentaspersona)); 
	}

	public function executeShow(sfWebRequest $request) {
    	$this->personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('id')));
    	$this->forward404Unless($this->personas);
	}

	public function executeGetplanesactivacion(sfWebRequest $request) {
		$this->mensaje = "";      

		$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/personas.php?wsdl");

		// llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('obtenerpersona',array( 'value'=> $this->getUser()->getProfile()->getDni()));

		$this->persona = unserialize(base64_decode($resultado));

		// obtener planes
		$planespersona = $soapclient->call('obtenerplanes',array( 'value'=> $this->persona['idPersona']));

		$this->planes = unserialize(base64_decode($planespersona));

		$this->mesasexamenes = "";
		$this->inscriptoCiclo = array();
		
		$this->ciclolectivo = Doctrine_Core::getTable('CiclosLectivos')
			->createQuery('a')
			->where('inicio < ?' , date("Y-m-d"))
			->andWhere('fin > ?' , date("Y-m-d"))
			->execute();	

		if(count($this->ciclolectivo)==0){
			$this->ciclo = 0;
		} else {
			// en caso de encontrarse el ciclo lectivo, se lo busca
			foreach ($this->ciclolectivo as $ciclo_lectivo){ 
				$ciclo = $ciclo_lectivo->getId(); 
			}

			$this->inscriptoCiclo = array();
			// si hay ciclos lectivos nuevos verifico si esta inscripto para cada carrera
			foreach ($this->planes as $plan_estudio){
				$idCarrera = $plan_estudio['idCarrera'];
				$idAlumno = $plan_estudio['idAl'];
				//$this->inscriptoCiclo['idAl']=true;

				$this->ciclolectivo = Doctrine_Core::getTable('InscripcionesCicloLectivo')
					->createQuery('a')
        			->where('idciclolectivo  = ?' , $ciclo)
					->andWhere('idalumno = ?' , $idAlumno)
					->execute();

				if(count($this->ciclolectivo)!=0) array_push($this->inscriptoCiclo, $idAlumno);
			}
		}		
		/*
		if($request->getParameter('guardado')==1){
		$this->mensaje ="Se ha registrado correctamente la pre-inscripción a la mesa de examen.";
		}*/
		$this->idp = $this->persona['idPersona'];  
	} 

	public function executeInscribirciclolectivo(sfWebRequest $request) {
		$this->ciclolectivo = Doctrine_Core::getTable('CiclosLectivos')
			->createQuery('a')
			->where('inicio < ?' , date("Y-m-d"))
			->andWhere('fin > ?' , date("Y-m-d"))
			->execute();	
		if(count($this->ciclolectivo)!=0) { 
			foreach ($this->ciclolectivo as $ciclo_lectivo){ 
				$ciclo = $ciclo_lectivo->getId(); 
			}
		}
		$this->guardado = 0;
		// chequeamos si ya esta inscripto al ciclo lectivo
		$this->inscripcionciclo = Doctrine_Core::getTable('InscripcionesCicloLectivo')
			->createQuery('a')
			->where('idalumno = ?' ,$request->getParameter('ida'))
			->andWhere('idciclolectivo = ?' , $ciclo)
			->execute();
		// si no esta inscripto, lo inscribimos	
		if(count($this->inscripcionciclo)==0){
			$oInscripcionesCicloLectivo = new InscripcionesCicloLectivo();
			$oInscripcionesCicloLectivo->setIdalumno($request->getParameter('ida'));
			$oInscripcionesCicloLectivo->setIdciclolectivo($ciclo);
			$oInscripcionesCicloLectivo->setCreatedAt(date('Y-m-d'));
			$oInscripcionesCicloLectivo->setUpdatedAt(date('Y-m-d'));     
			$oInscripcionesCicloLectivo->save();
		}
		$this->redirect('personas/getplanesactivacion');  
	}

	public function executeGetsolicitudlibredeuda(sfWebRequest $request) {
		$this->mensaje = "";      

		$soapclient = new nusoap_client("http://192.168.2.196/ucu/sitio/webservices/personas.php?wsdl");

		// llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('obtenerpersona',array( 'value'=> $this->getUser()->getProfile()->getDni()));
		$this->persona = unserialize(base64_decode($resultado));

		// obtener el alumno
		$resultado = $soapclient->call('obteneralumno',array( 'idp'=> $this->persona['idPersona'], 'idc'=> $request->getParameter('idc')));
		$this->alumno = unserialize(base64_decode($resultado));

		// obtener planes
		$resultado = $soapclient->call('obtenerplanes',array( 'value'=> $this->persona['idPersona']));
		$this->planess = unserialize(base64_decode($resultado));

		// verifico que el alumno este activo en la cuenta
		$this->planes = array();
		$this->inscriptoCiclo = array();

		$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdUltimoCicloLectivoActivo();
		
		// busco si esta activo el ciclo lectivo para realizar actividades con el sistema
		if ($idcicloactual > 0) {
			$InscripcionesCicloLectivo = new InscripcionesCicloLectivo();

			foreach ($this->planess as $plan_estudio){
				$idCarrera = $plan_estudio['idCarrera'];
				$idAlumno = $plan_estudio['idAl'];
				// busco para el alumno y ciclo si esta inscripto
				$fechalibredeuda = Doctrine_Core::getTable('Inscripciones')->getUltimaFechaLibreDeuda($idAlumno);

				$plan_estudio['fechalibredeuda'] = $fechalibredeuda['fechalibredeuda'];
				$plan = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($idcicloactual, $idAlumno);
				if($plan) array_push($this->planes, $plan_estudio);
			}
		}

		// si la fecha libredeuda es menor que la actual
		if ($fechalibredeuda['fechalibredeuda'] < date("Y-m-d")) {
			/*	  	
			// chequeamos si ya esta inscripto al ciclo lectivo
			$this->inscripcionciclo = Doctrine_Core::getTable('EstadosLibredeuda')
			->createQuery('a')
			->where('idalumno = ?' ,$request->getParameter('ida'))
			->andWhere('idciclolectivo = ?' , $ciclo)
			->execute();
			*/

			// si el no tiene una solicitud pendiente	
			if(count($this->inscripcionciclo)==0){
				// se envia peticion de libredeuda
				if (($idAlumno!='') and ($request->getParameter('idc')!='') ) {

					$oLibredeudaTramites = new LibredeudaTramites();

					$oLibredeudaTramites->setIdAlumno($this->alumno[idAlumno]);
					$oLibredeudaTramites->setCreatedAt(date('Y-m-d H:i:s'));
					$oLibredeudaTramites->save();

					$oEstadosInscripcionesMaterias = new EstadosInscripcionesMaterias();
					
					$oEstadosInscripcionesMaterias->setIdInscripcion($oLibredeudaTramites->getId());
					$oEstadosInscripcionesMaterias->setIdEstadoInscripcion(1);
					$oEstadosInscripcionesMaterias->setCreatedAt(date('Y-m-d H:i:s'));
					$oEstadosInscripcionesMaterias->save();
				} 
			}
		}
		if($request->getParameter('guardado')==1){
			$this->mensaje = "Se ha registrado correctamente la pre-inscripción a la mesa de examen.";
		}
		$this->idp = $this->persona['idPersona'];  
	}
}