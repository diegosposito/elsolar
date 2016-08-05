<?php

/**
 * aspirante actions.
 *
 * @package    sig
 * @subpackage aspirante
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class aspiranteActions extends sfActions
{	  
	// Guarda la fotografia de la persona
	public function executeGuardarfotografia(sfWebRequest $request) {
		$oPersona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
		
		$filename = $oPersona->getNrodoc() . '.jpg';
		$result = file_put_contents( "fotos/".$filename, file_get_contents('php://input') );
		if (!$result) {
			$resultado = "ERROR: No se pudo escribir el archivo $filename, verificar los permisos.\n";
		} else {
			$resultado = "EXITO: Se pudo escribir correctamente el archivo $filename.\n";
			// Guarda la persona que tiene foto
			$oPersona->setTienefoto(1);
			$oPersona->save();
		}
		
		$this->getResponse()->setContent($resultado);
		
		return sfView::NONE;	
	}
	
	// Asocia el estudio previo al alumno
	public function executeAsociarestudioprevio(sfWebRequest $request) {
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$oAlumno->setIdestudioprevio($request->getParameter('idestudio'));
		$oAlumno->save();
	
		echo "El estudio previo ha sido asociado correctamente.";
	
		return sfView::NONE;
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
  		$resultado['fechaemision'] = $arr[2]."-".$arr[1]."-".$arr[0];
  		$resultado['duracion'] = $oEstudio->getDuracion();
  		$resultado['unidadtiempo'] = $oEstudio->getIdunidadtiempo();
  		$resultado['concluyo'] = $oEstudio->getConcluyo();
  		$resultado['continua'] = $oEstudio->getContinua();
  		$resultado['numerototal'] = $oEstudio->getCantmaterias();
  		$resultado['numeroaprobadas'] = $oEstudio->getCantmatapro();
  		$resultado['anioingreso'] = $oEstudio->getAnioingreso();
  		$resultado['anioegreso'] = $oEstudio->getAnioegreso();
  		$resultado['promedio'] = $oEstudio->getPromedio(); 
  		$resultado['formaciondocente'] = $oEstudio->getFormaciondocente()=="Checked" ? true : false;   
  		$resultado['otrotitulo'] = $oEstudio->getOtrotitulo();   
  		
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
				$password = $oPersona->getNrodoc();
				$oUsuario->setPassword($password);
				$oUsuario->setIsActive(1);
				$oUsuario->setIsSuperAdmin(0);	  				
				$oUsuario->save();
		  		
		  		$oPerfil->setTipodoc($oPersona->getIdtipodoc());
		  		$oPerfil->setNrodoc($oPersona->getNrodoc());  	  		
		  		$oPerfil->setSfGuardUserId($oUsuario->getId());
		  		$oPerfil->setIdsede($this->getUser()->getGuardUser()->getProfile()->getIdsede());
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
				$message->setFrom(array('sistemas@ucu.edu.ar' => 'UCU - Informes'));

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
				<p align="center"><img src="'. $cid.'" alt="UCU - Ingresantes" /></p>';
    			//a la brevedad para dar tus primeros pasos en 	la <b>Universidad de Concepción del Uruguay</b>!
    			$message->setBody($html, 'text/html');

    			$this->getMailer()->send($message);	  		  				
  			}
		} else {
			echo "Debe registrar un email, antes de poder generar un usuario.";
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
	  	$oFacultad = Doctrine::getTable('Facultades')->find($oAlumno->getIdFacultad());
	  	
	  	if ((count($oFacultad->buscarLegajo($request->getParameter('legajo'),$oAlumno->getIdpersona()))==0) or ($request->getParameter('legajo')=="")) {
			// Guarda las opciones seleccionadas
			$oAlumno->setObservaciones($request->getParameter('observaciones'));
			$oAlumno->setLegajo($request->getParameter('legajo'));
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
  			$oAlumno->setIdplanestudio($request->getParameter('idplanestudio'));
  			$oAlumno->setFechaingreso($fechaingreso);
  			$oAlumno->setIdciclolectivo($request->getParameter('idciclolectivo'));
  			$oAlumno->save();
  			
			// Grabar en tabla EstadosAlumnoHistorial
     		$oEstadoAlumnoHistorial = new EstadosAlumnoHistorial();
     		$oEstadoAlumnoHistorial->setIdEstadoAlumno(ESTADOACTIVO);
     		$oEstadoAlumnoHistorial->setIdAlumno($oAlumno->getIdalumno());
     		$oEstadoAlumnoHistorial->setFecha($fechaingreso);
			$oEstadoAlumnoHistorial->save();  			
  		}
		$oAlumno->setInternacional($internacional);
		$oAlumno->setActivo(1);
		$oAlumno->setIdsede($this->getUser()->getProfile()->getIdsede());
  		$oAlumno->save();

		if($request->getParameter('idalumno')) {
	  		echo json_encode(array("idpersona"=>0,"idalumno"=>0,"mensaje"=>"El alumno se encuentra repetido.")); 
	  	} else { 
			echo json_encode(array("idpersona"=>$oPersona->getIdpersona(),"idalumno"=>$oAlumno->getIdalumno(),"mensaje"=>"El Aspirante ha sido guardado correctamente."));	  		
	  	}  		

		return sfView::NONE;
	}	
	
	public function executeModificar(sfWebRequest $request)	{	
		// Busca si existe el alumno
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$oPersona = $oAlumno->getPersonas();
		$oPlanEstudio = $oAlumno->getPlanesEstudios();
		$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($oPersona->getIdtipodoc());
		$this->carrera = $oPlanEstudio->getCarreras();
		
		$this->form = new InscripcionesAspiranteForm();
		$this->email = 0;
		$this->activo = 0;
		
		// Si existe obtiene todos los datos personales y los muestra en pantalla
		$this->form->setDefault('idplanestudio', $request->getParameter('idplanestudio'));
		$this->form->setDefault('idpersona', $oPersona->getIdpersona());
		$this->form->setDefault('idtipodocumento', $oPersona->getIdtipodoc());		
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
			if ($oContacto->getEmail() != NULL) {
				$this->email = 1;
			}	  

			$this->documentacion_alumnos = array();
		  	$this->documentacion_planes = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->obtenerDocumentacionesPlanesPorPlan($oPlanEstudio->getIdplanestudio());
		  	$documentacion_alumnos = Doctrine_Core::getTable('DocumentacionAlumnos')->findByIdalumno($this->idalumno);
  			foreach ($documentacion_alumnos as $documentacion) {
  				$this->documentacion_alumnos[$documentacion->getIddocumentacion()]=$documentacion->getIddocumentacion();
  			}
  			
			$this->form->setDefault('observaciones', $oAlumno->getObservaciones());
			if($oAlumno->getInternacional()==1) {
				$this->form->setDefault('internacional', 'on');
			}
			
			$this->form->setDefault('idalumno', $oAlumno->getIdalumno());
		} else {
			$this->idciudadnac = 0;
			$this->idciudadres = 0;
		}
		$this->setTemplate('inscribir');
	}	

	public function executeInscribir(sfWebRequest $request)	{
		$numerodoc = $request->getParameter('nrodocumento');
		$nrodoc = preg_replace("/[^\d]/", "", $numerodoc);
	
		$this->email = 0;
		$this->idalumno = 0;
		$this->idtipodoc = 1;

		$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($request->getParameter('idtipodocumento'));        
		$this->formato = $oTipoDocumento->getFormato();  

   		if (preg_match($this->formato, $numerodoc)) {
			$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
			$this->carrera = $oPlanEstudio->getCarreras();
			$this->form = new InscripcionesAspiranteForm();
			$this->activo = 1;
			// Busca si existe la persona
			$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($request->getParameter('idtipodocumento'), $nrodoc);
			
			if($oPersona){
				$this->idpersona = $oPersona->getIdpersona();
				$fecha=explode(" ",$oPersona->getCreatedAt());
				$this->activo = ($fecha[0]==date('Y-m-d')) ? 1 : 0 ;
				// Si existe obtiene todos los datos personales y los muestra en pantalla
				$this->form->setDefault('idpersona', $oPersona->getIdpersona());
				$this->form->setDefault('tipodocumento', $oPersona->getTiposDocumentos());
				$this->form->setDefault('nombre', $oPersona->getNombre());
				$this->form->setDefault('apellido', $oPersona->getApellido());
				$this->form->setDefault('idsexo', $oPersona->getIdsexo());
				$this->form->setDefault('estadocivil', $oPersona->getEstadocivil());
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
			  		if ($oContacto->getEmail() != NULL){
			  			$this->email = 1;
			  		}	  
				} else {
					$this->idciudadres = 0;
				}
				
				$this->documentacion_alumnos = array();
		  		$this->documentacion_planes = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->obtenerDocumentacionesPlanesPorPlan($oPlanEstudio->getIdplanestudio());
		  		$documentacion_alumnos = Doctrine_Core::getTable('DocumentacionAlumnos')->findByIdalumno($this->idalumno);
  				foreach ($documentacion_alumnos as $documentacion) {
  					$this->documentacion_alumnos[$documentacion->getIddocumentacion()]=$documentacion->getIddocumentacion();
  				}
  			
			  	// Obtiene la documentacion del alumno
			  	$oAlumno = Doctrine_Core::getTable('Alumnos')->buscarAlumno($oPersona->getIdpersona(), $request->getParameter('idplanestudio'));
			  	if($oAlumno){
					if ($oAlumno->getInternacional()==1) {
						$this->form->setDefault('internacional', 'on');
					}
					$this->idalumno = $oAlumno->getIdalumno();
					$this->form->setDefault('idalumno', $this->idalumno);
					if($oAlumno->getIdciclolectivo()) {
						$this->form->setDefault('idciclolectivo', $oAlumno->getIdciclolectivo());
					}
					$this->form->setDefault('observaciones', $oAlumno->getObservaciones());				
			  	}
			  	// Comprobacion del legajo
			  	$legajo = "";
			  	if ($oAlumno) {
			  		$legajo = $oAlumno->getLegajo();
			  	} else {
			  		if($oPersona) {
				  		$oCarrera = $oPlanEstudio->getCarreras();
						$oFacultad = Doctrine::getTable('Facultades')->find($oCarrera->getIdfacultad());
			  			
						$resultado = $oFacultad->buscarLegajoPorPersona($oPersona->getIdpersona());
			  			if (count($resultado) > 0) {
	  						$legajo = $resultado[0]->getLegajo();
	  					}							
			  		}
			  	}	
				$this->form->setDefault('legajo', $legajo);	  	
			} else {
				$this->idpersona = 0;
				$this->idciudadnac = 0;
				$this->idciudadres = 0;		
			}
			$this->form->setDefault('idplanestudio', $request->getParameter('idplanestudio'));
			$this->form->setDefault('nrodocumento', $request->getParameter('nrodocumento'));
			$this->form->setDefault('idtipodocumento', $request->getParameter('idtipodocumento'));			
			$this->form->setDefault('tipodocumento', $oTipoDocumento->getDescripcion()."(".$oTipoDocumento->getPaises()->getAbreviacion().")");			
   		} else {		
 			$this->mensaje = "Formato de documento no valido Ejemplo para DNI 22.456.333";

   			$this->form = new BuscarPersonasForm();
   			$this->form->setDefault('idplanestudio', $request->getParameter('idplanestudio'));
			$this->form->setDefault('idtipodocumento', $request->getParameter('idtipodocumento'));
			$this->form->setDefault('nrodocumento', $request->getParameter('nrodocumento'));   			
   			$this->setTemplate('buscarpersona');
   		}
	}		
	
	public function executeBuscarpersona(sfWebRequest $request)	{
		$this->mensaje = "";
		$this->form = new BuscarPersonasForm();
	}	
        
  	public function executeImprimirplanilla(sfWebRequest $request) {
		$this->mensaje = "";
		$this->form = new BuscarPersonasForm();
	}	
              
	public function executeImprimir(sfWebRequest $request)	{
		// Aseguro que la cadena solo tenga numeros
		$ndoc = preg_replace("/[^\d]/", "", $request->getParameter('nrodocumento'));

		// Busca si existe la persona
		$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($request->getParameter('tipodocumento'), $ndoc);

		if($oPersona) {
			$nombre=$oPersona->getNombre();
			$apellido=$oPersona->getApellido();
			$idSexo= $oPersona->getIdsexo();
 			$idEcivil= $oPersona->getEstadocivil();

 			$tipodoc = Doctrine_Core::getTable('TiposDocumentos')->find($oPersona->getIdTipoDoc());                        
			$nrodoc=$oPersona->getNumeroDoc();
		                
			$arr_sexo = array(1 => "Masculino", 2 => "Femenino");
			$sexo= $arr_sexo[$idSexo];  
		                
			$arr_ecivil = array(1 => "Soltero", 2 => "Casado");
			$ecivil= $arr_ecivil[$idEcivil];    
		                
			$ciudadnacimiento = Doctrine_Core::getTable('Ciudades')->find($oPersona->getIdciudadnac());
			$provincianacimiento = Doctrine_Core::getTable('Provincias')->find($ciudadnacimiento->getIdprovincia());
			$this->idprovincianac = $provincianacimiento->getIdprovincia();
			$paisnacimiento = Doctrine_Core::getTable('Paises')->find($provincianacimiento->getIdpais());
			$this->idpaisnac = $paisnacimiento->getIdpais();
			$arr = explode('-', $oPersona->getFechanac());
			$fechanacimiento= $arr[2]."/".$arr[1]."/".$arr[0];  

		  	// Obtiene la documentacion del alumno
		  	$oAlumno = Doctrine_Core::getTable('Alumnos')->buscarAlumno($oPersona->getIdpersona(), $request->getParameter('idplanestudio'));
			$existe_alumno=false;	
			if($oAlumno) {
	  			$arri = explode('-', $oAlumno->getFechaIngreso());
	  			$ciclo=$oAlumno->getCiclosLectivos()->getCiclo();
	  			$existe_alumno=true;
  			} else {
  				$curr_time = time();
  				$arri[0] = date('Y',$curr_time);
  				$arri[1] = date('m',$curr_time);
  				$arri[2] = date('d',$curr_time);
  			}
	  		
			/*PEDIR A MARCELO CODIGO PARA ESTO*/
			if ($arri[1]==1) $mesinsc='Enero';
			if ($arri[1]==2) $mesinsc='Febrero';
			if ($arri[1]==3) $mesinsc='Marzo';
			if ($arri[1]==4) $mesinsc='Abril';
			if ($arri[1]==5) $mesinsc='Mayo';
			if ($arri[1]==6) $mesinsc='Junio';
			if ($arri[1]==7) $mesinsc='Julio';
			if ($arri[1]==8) $mesinsc='Agosto';
			if ($arri[1]==9) $mesinsc='Septiembre';
			if ($arri[1]==10) $mesinsc='Octubre';
			if ($arri[1]==11) $mesinsc='Noviembre';
			if ($arri[1]==12) $mesinsc='Diciembre';
				
			$fechaingreso= $arri[2]." de ".$mesinsc." de ".$arri[0];   

    		$config = sfTCPDFPluginConfigHandler::loadConfig();
		 
			// Crea el objeto PDF
			//$pdf = new sfTCPDF();
    		$pdf = new PDF();
    		$pdf->setPrintHeader(false);
    		$pdf->setPrintFooter(false);
    		// Configura el auto-salto de pagina
    		$pdf->SetAutoPageBreak(1 , 10);
    		// Agrega la Cabecera al documento
    		$pdf->Cabecera("", "", "SOLICITUD DE INSCRIPCION ".$ciclo);
    		
			// Configuracion
			$pdf->SetFont("Times", "", 12);

			/*
			Sedes
			1-Sede Central / 2-Sede Gualeguaychu / 3-Sede Villaguay / 4-Sede Rosario / 5-Sede Santa Fe / 6-Sede Parana / 7-Extension Gualeguay / 8-Venado Tuerto
			*/
			if ($this->getUser()->getProfile()->getIdsede()==1) $lugar='Concepción del Uruguay';
			if ($this->getUser()->getProfile()->getIdsede()==2) $lugar='San José de Gualeguaychú';
			if ($this->getUser()->getProfile()->getIdsede()==3) $lugar='Villaguay';
			if ($this->getUser()->getProfile()->getIdsede()==4) $lugar='Rosario';
			if ($this->getUser()->getProfile()->getIdsede()==5) $lugar='Santa Fe';
			if ($this->getUser()->getProfile()->getIdsede()==6) $lugar='Paraná';
            if ($this->getUser()->getProfile()->getIdsede()==7) $lugar='Gualeguay';
            if ($this->getUser()->getProfile()->getIdsede()==8) $lugar='Venado Tuerto';

			$fechalugar = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span
				style="font-size: 10;">'.$lugar.', '.$fechaingreso.'</div>';

			// Si existe registro de inscripcion de alumno en la carrera
			if($existe_alumno){
				// Asigna el espesor de la linea
				$pdf->SetLineWidth(0.1);
				// Recuadro Foto
				$pdf->Line(160,36,200,36);         
				$pdf->Line(160,76,200,76); 
				$pdf->Line(160,36,160,76);         
				$pdf->Line(200,36,200,76); 
	
				$pdf->writeHTML($fechalugar, true, false, true, false, '');   
				$pdf->SetXY(10,50);
				
				if($oAlumno->getIdplanestudio()==168) {
					$oFacultad = Doctrine_Core::getTable('Facultades')->find($request->getParameter('facultad'));
						
					$decano = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span style="font-size: 10;">
					<br>Sr./a Decano/a<br>'.$oFacultad->getNombre().'<br>'.$oFacultad->getDecano().'</div>';
				} else if ($oAlumno->getIdplanestudio()==66) {
					$decano = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span style="font-size: 10;">
					<br>Estimado/a:<br></div>';
				} else {
					$decano = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span style="font-size: 10;">
					<br>Sr./a Decano/a<br>'.$oAlumno->getNombreFacultad().'<br>'.$oAlumno->getNombreDecano().'</div>';
				}
				$pdf->writeHTML($decano, true, false, true, false, '');           

				if ($idSexo==1) {
					$sigla='El';
					$sigla_alumno='alumno';
					$sigla_alumno_l='lo';
				} else {
					$sigla='La';
					$sigla_alumno='alumna';
					$sigla_alumno_l='la';
				}

	  			$ciclolectivo=$ciclo; 
	  			
	  			if($oAlumno->getIdplanestudio()==168) {
	  				// el if podria identificar si son carrera exploratorias para imprimir otra redaccion
	  				$texto = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span style="font-size: 10;">
			    		<br>'.$sigla.' que suscribe '.$apellido.', '.$nombre.' , '.$tipodoc.' '.$nrodoc.' solicita la inscripción al '.$oAlumno->getNombreCarrera().' para el año académico '.$ciclolectivo.'.</div>';
	  				
	  				// si es un curso no se requiere entrega de ordenanzas
	  				$pdf->writeHTML($texto, true, false, true, false, '');
	  				$pdf->SetXY(10,82);
	  				
	  				$pdf->SetXY(80,95);
	  				$pdf->Cell(50,10,"Carrera de Interes: ________________________________",0,0,'C');	  				
	  			} elseif ($oAlumno->getIdplanestudio()==66) {
	  				// el if podria identificar si son carrera exploratorias para imprimir otra redaccion
	  				$texto = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span style="font-size: 10;">
			    		<br>'.$sigla.' que suscribe '.$apellido.', '.$nombre.' , '.$tipodoc.' '.$nrodoc.' solicita la inscripción al siguiente curso para el año académico '.$ciclolectivo.'.</div>';
	  				
	  				// si es un curso no se requiere entrega de ordenanzas
	  				$pdf->writeHTML($texto, true, false, true, false, '');
	  				$pdf->SetXY(10,82);
	  				
	  				$pdf->SetXY(80,95);
	  				$pdf->Cell(50,10,"Curso de Interés: ________________________________",0,0,'C');	  				
	  			} else {
	  				$texto = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span style="font-size: 10;">
			    		<br>'.$sigla.' que suscribe '.$apellido.', '.$nombre.' , '.$tipodoc.' '.$nrodoc.' solicita la inscripción como '.$sigla_alumno.' de esta Facultad en la carrera de '.$oAlumno->getNombreCarrera().' para el año académico '.$ciclolectivo.'.</div>';
	  				
	  				// si es un curso no se requiere entrega de ordenanzas
	  				$pdf->writeHTML($texto, true, false, true, false, '');
	  				$pdf->SetXY(10,82);
	  				$texto1 = '<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span	style="font-size: 10;">
			    		<br>Reconozco y presto conformidad con el régimen jurídico, reglamentario y arancelario que regula el funcionamiento de la Universidad de Concepción del Uruguay, recibiendo en este acto copia de la Ordenanza Nº 3 -de requisitos de ingreso- , Reglamento Nº 6 -de Servicios Bibliotecarios - y del Reglamento Nº 7 -de aranceles- que obran como anexo de la presente.<br></div>';
	  				
	  				$pdf->writeHTML($texto1, true, false, true, false, '');
	  				$pdf->SetXY(10,96);
	  				$texto2 = '
						<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span	style="font-size: 10;">
						<br>Acompaño la documentación que se detalla al pie de la presente, y sin más, '.$sigla_alumno_l.' saludo atentamente.</div>';
	  				
	  				$pdf->writeHTML($texto2, true, false, true, false, '');	  				
	  			}
		
				$pdf->SetXY(120,115);
	  			$pdf->Cell(50,10,"________________________________",0,0,'C');
				$pdf->Ln(5);
				// Asigna la posicion del pie de pagina: a 3,1 cm del final
				$pdf->SetXY(120,120);
				$pdf->Cell(50,10,"Firma",0,0,'C');
		
				$pdf->SetXY(10,120);
	  			$pdf->Cell(50,10,"Recibo Nº: _____________",0,0,'L');      
				$pdf->SetXY(10,130);        
	  
				$titulo_infpersonal = '
					<div style="text-align: center; border:2px solid blue; font-weight: bold; font-family: Times New Roman,Times,serif;"><span
					style="font-size: 12;">INFORMACION PERSONAL<br></div>';
		
				$pdf->writeHTML($titulo_infpersonal, true, false, true, false, '');   
				// Asigna el espesor de la linea
				$pdf->SetLineWidth(0.1);
				// Linea horizontal que separa titulo
				$pdf->Line(10,130,199,130);
				$pdf->Line(10,135,199,135);   
				$pdf->SetXY(10,133);
				$pdf->Cell(50,10,"Apellido y Nombre:",0,0,'L');
				$pdf->SetXY(45,133);
				$pdf->Cell(50,10,$apellido.", ".$nombre,0,0,'L');
				$pdf->SetXY(155,133);
				$pdf->Cell(50,10,"DNI: ".$request->getParameter('nrodocumento'),0,0,'L');  
				$pdf->SetXY(10,138);
				$pdf->Cell(50,10,"Fecha Nacimiento:",0,0,'L');   
				$pdf->SetXY(45,138);
				$pdf->Cell(50,10,$fechanacimiento,0,0,'L');                 
				$pdf->SetXY(80,138);
				$pdf->Cell(50,10,"Sexo:",0,0,'L');      
				$pdf->SetXY(90,138);
				$pdf->Cell(50,10,$sexo,0,0,'L');  
				$pdf->SetXY(130,138);
				$pdf->Cell(50,10,"Estado Civil:",0,0,'L');         
				$pdf->SetXY(155,138);
				$pdf->Cell(50,10,$ecivil,0,0,'L');   
				$pdf->SetFont("Times", "B", 12);
				$pdf->SetXY(10,143);
				$pdf->Cell(50,10,"Lugar de Nacimiento:",0,0,'L'); 
				$pdf->SetFont("Times", "", 12);
				$pdf->SetXY(10,148);
				$pdf->Cell(50,10,"Localidad:",0,0,'L');   
				$pdf->SetXY(30,148);
				$pdf->Cell(50,10,$ciudadnacimiento,0,0,'L');          
				$pdf->SetXY(100,148);
				$pdf->Cell(50,10,"Departamento:",0,0,'L');           
				$pdf->SetXY(130,148);
				//$pdf->Cell(50,10,$departamento,0,0,'L');     
				$pdf->SetXY(10,153);
				$pdf->Cell(50,10,"Provincia:",0,0,'L');         
				$pdf->SetXY(30,153);
				$pdf->Cell(50,10,$provincianacimiento,0,0,'L');  
				$pdf->SetXY(100,153);
				$pdf->Cell(50,10,"Pais:",0,0,'L');         
				$pdf->SetXY(130,153);
				$pdf->Cell(50,10,$paisnacimiento,0,0,'L');  
				$pdf->SetFont("Times", "B", 12);
				$pdf->SetXY(10,158);

				// Obtiene el contecto de la persona
				$oContacto = $oPersona->getContacto();
				if($oContacto){
					$calle=$oContacto->getCallee();
					$nrocalle= $oContacto->getNumeroe();
					$barrio= $oContacto->getBarrioe();
					$edificio= $oContacto->getEdificioe();
					$piso=$oContacto->getPisoe();
					$nrodepartamento=$oContacto->getDeptoe();
					$this->idciudadres = $oContacto->getIdciudade();
					if(($this->idciudadres != 0) && ($this->idciudadres != NULL)) {
						$oCiudadResidencia = Doctrine_Core::getTable('Ciudades')->find($this->idciudadres);
						$oProvinciaResidencia = Doctrine_Core::getTable('Provincias')->find($oCiudadResidencia->getIdprovincia());
						$this->idprovinciares = $oProvinciaResidencia->getIdprovincia();
						$oPaisResidencia = Doctrine_Core::getTable('Paises')->find($oProvinciaResidencia->getIdpais());
			  			$this->idpaisres = $oPaisResidencia->getIdpais();

						$ciudadres=$oCiudadResidencia->getDescripcion();
						$provinciares=$oProvinciaResidencia->getDescripcion();
						$paisres=$oPaisResidencia->getDescripcion();
					} else {
						$this->idciudadres = 0;
					}
  					$telefono= $oContacto->getTelefonofijocar().'-'.$oContacto->getTelefonofijonum();
			  		$celular= $oContacto->getCelularcar().'-'. $oContacto->getCelularnum();
			  		$email=$oContacto->getEmail();
				} else {
					$this->idciudadres = 0;
				}
				$pdf->Cell(30,10,"Contacto:",0,0,'L');         
				$pdf->SetFont("Times", "", 12);        
				$pdf->SetXY(10,163);
				$pdf->Cell(30,10,"Tel.Fijo:",0,0,'L');         
				$pdf->SetXY(27,163);
				$pdf->Cell(50,10,$telefono,0,0,'L');      
				$pdf->SetXY(60,163);
				$pdf->Cell(30,10,"Celular:",0,0,'L');         
				$pdf->SetXY(75,163);
				$pdf->Cell(50,10,$celular,0,0,'L');  
				$pdf->SetXY(10,167);
				$pdf->Cell(30,10,"Correo Electronico:",0,0,'L');         
				$pdf->SetXY(45,167);
				$pdf->Cell(50,10,$email,0,0,'L');                 
				$pdf->SetXY(10,175);        
	  
				$titulo_residencia = '
					<div style="text-align: center; border:2px solid blue; font-weight: bold; font-family: Times New Roman,Times,serif;"><span
					style="font-size: 12;">RESIDENCIA DEL ASPIRANTE<br></div>';
		
				$pdf->writeHTML($titulo_residencia, true, false, true, false, '');     
				// Asigna el espesor de la linea
				$pdf->SetLineWidth(0.1);
				// Linea horizontal que separa titulo
				$pdf->Line(10,175,199,175);
				$pdf->Line(10,180,199,180);   
				$pdf->SetXY(10,178);
			  	$pdf->Cell(50,10,"Calle:",0,0,'L');         
				$pdf->SetXY(30,178);
			  	$pdf->Cell(50,10,$calle,0,0,'L');      
				$pdf->SetXY(90,178);
			  	$pdf->Cell(50,10,"Nº:",0,0,'L');         
				$pdf->SetXY(100,178);
			  	$pdf->Cell(50,10,$nrocalle,0,0,'L');  
				$pdf->SetXY(130,178);
			  	$pdf->Cell(50,10,"Barrio:",0,0,'L');  
				$pdf->SetXY(145,178);
			  	$pdf->Cell(50,10,$barrio,0,0,'L'); 
				$pdf->SetXY(10,182);
			  	$pdf->Cell(50,10,"Edificio:",0,0,'L');         
				$pdf->SetXY(30,182);
			  	$pdf->Cell(50,10,$edificio,0,0,'L');      
				$pdf->SetXY(90,182);
			  	$pdf->Cell(50,10,"Piso:",0,0,'L');         
				$pdf->SetXY(100,182);
			  	$pdf->Cell(50,10,$piso,0,0,'L');  
				$pdf->SetXY(130,182);
			  	$pdf->Cell(50,10,"Nº Depto.:",0,0,'L');         
				$pdf->SetXY(150,182);
			  	$pdf->Cell(50,10,$nrodepartamento,0,0,'L');          
				$pdf->SetXY(10,186);
			  	$pdf->Cell(50,10,"Localidad:",0,0,'L');         
				$pdf->SetXY(30,186);
			  	$pdf->Cell(50,10,$ciudadres,0,0,'L'); 
				$pdf->SetXY(130,186);
			  	//---no estaba $pdf->Cell(50,10,"Departamento:",0,0,'L');         
				//$pdf->SetXY(147,186);
			  	//--no estaba $pdf->Cell(50,10,$departamentos,0,0,'L');
				$pdf->SetXY(10,190);
			  	$pdf->Cell(50,10,"Provincia:",0,0,'L');         
				$pdf->SetXY(30,190);
			  	$pdf->Cell(50,10,$provinciares,0,0,'L');  
				$pdf->SetXY(90,190);
			  	$pdf->Cell(50,10,"Pais:",0,0,'L');         
				$pdf->SetXY(110,190);
			  	$pdf->Cell(50,10,$paisres,0,0,'L');         
			    $pdf->SetXY(10,200);        

			    if(($oAlumno->getIdplanestudio()!=168) and ($oAlumno->getIdplanestudio()!=66)){
					// si es un curso no se solicita documentacion	  
					$titulo_documentacion = '
						<div style="text-align: center; border:2px solid blue; font-weight: bold; font-family: Times New Roman,Times,serif;"><span
						style="font-size: 12;">DOCUMENTACION<br></div>';
		  
					$pdf->writeHTML($titulo_documentacion, true, false, true, false, '');          
		
					// Asigna el espesor de la linea
					$pdf->SetLineWidth(0.1);
					// Linea horizontal que separa titulo
					$pdf->Line(10,200,199,200);
					$pdf->Line(10,205,199,205);
					
					$doc_alum = Doctrine_Core::getTable('DocumentacionAlumnos')->obtenerDocumentacionesPorIdalumno($oAlumno->getIdalumno());
					$documentaciones_alumnos = array();
					foreach ($doc_alum as $documentacion) {
						$documentaciones_alumnos[$documentacion->getIddocumentacion()]=$documentacion->getIddocumentacion();
					}	
					
					$style_check = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
					
					$documentaciones_planes = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->obtenerDocumentacionesPlanesPorPlan($oAlumno->getIdplanestudio());
					$r = 205;
					$x = 13;

					foreach ($documentaciones_planes as $documentacion_plan) {
						if ($pdf->getY()>=280) {
							$x=110;
							$r = 205;
						}
						if ((!$idtipoanterior) or ($idtipoanterior!=$documentacion_plan->getDocumentacion()->getIdtipodocumentacion())){
							$idtipoanterior = $documentacion_plan->getDocumentacion()->getIdtipodocumentacion();
							$r = $r +2;
							$pdf->SetXY($x,$r);
							$pdf->SetFont("Times", "B", 12);
							$pdf->Cell(30,4,strtoupper($documentacion_plan->getDocumentacion()->getTiposDocumentacion()->getNombrereducido()).$i,0,0,'L');
							$pdf->SetFont("Times", "", 12);
							$r = $r+4;
						}	
						$pdf->SetXY($x+7,$r);
						
						if (in_array($documentacion_plan->getIddocumentacion(), $documentaciones_alumnos)) {$pdf->Rect($x,$r+1,4,3,'DF',$style_check);}  else {$pdf->Rect($x,$r+1,4,3);};
						
						$pdf->Cell(50,4,$documentacion_plan->getDocumentacion(),0,0,'L');

						$r = $r+4;
					}
				}

				/*
				 Sedes
				1-Sede Central / 2-Sede Gualeguaychu / 3-Sede Villaguay / 4-Sede Rosario / 5-Sede Santa Fe / 6-Sede Parana / 7-Extension Gualeguay / 8-Venado Tuerto
				*/				
				// Agrega el Pie al documento
				$pdf->Pie($this->getUser()->getProfile()->getIdsede(),0);

				$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($oAlumno->getPlanesEstudios()->getIdcarrera(), $this->getUser()->getProfile()->getIdsede()); 
				$esExploratoria = $oCarreraSede->getExploratoria();
				if ($esExploratoria==1){
					$carrera = $oAlumno->getPlanesEstudios()->getCarreras();
			  		// Agrega la Cabecera al documento
    				$pdf->Cabecera("", "", "SOLICITUD DE INSCRIPCION ".$ciclo);
    				
    				// Muestra la imagen del Logo de la UCU
    				$pdf->Image('images/CabeceraSIG-UCU.jpg',10,5,192);
    				$pdf->SetXY(35,7);
    				// Establece la fuente: Times Negrita 14
    				$pdf->SetFont('Times','B',13);
    				// Asigna el ancho al borde
    				$pdf->SetLineWidth(0);
    				// Rectangulo Superior
    				$pdf->Rect(10,5,190,31);
    				//Asigna el ancho de la linea
    				$pdf->SetLineWidth(0);
    				// Linea horizontal que separa la cabecera y el nombre del documento
    				$pdf->Line(10,30,200,30);
    				// Asigna la posicion del eje Y
    				$pdf->SetXY(58,15);
    				// Asigna la posicion del eje Y
    				$pdf->SetY(28);
    				// Muestra el titulo
    				$pdf->Cell(0,10,"SOLICITUD DE INSCRIPCION ".$ciclo,0,1,'C');

    				$pdf->SetFont("Times", "", 12);
    				
    				$texto = '
						<div style="text-align: left; font-family: Times New Roman,Times,serif;"><span	style="font-size: 10;">
						<br>Por la presente acepto la oferta/propuesta de la Universidad de Concepción del Uruguay para la apertura exploratoria de su carrera de '.$carrera.', cuya inscripción definitiva estará condicionada a la cobertura del cupo mínimo necesario de alumnos establecido por el Decano de la '.$carrera->getFacultades().' para el ciclo lectivo '.$ciclo.', correspondiendo la devolución del importe correspondiente al pago de la Matricula Exploratoria abonada, ante la presentación del Recibo respectivo.
						<br><br>Conforme ello, declaro conocer las condiciones de ingreso para la carrera de '.$carrera.', por lo que toda la documentación que presento para la inscripción estará sujeta a revisión en cuanto a que reúna los requisitos exigidos. Deslindando a la Universidad de Concepción del Uruguay de toda responsabilidad si surgiere observación que imposibilite mi incorporación definitiva como alumno/a regular en esa Casa de Estudios.
						<br><br>'.$lugar.', a los '.$arri[2].' días del mes de '.$mesinsc.'	de '.$arri[0].'.
						<br><br><br>Firma: ________________________________________________
						<br>Aclaración:	________________________________________________
						<br>Fecha: ________________________________________________
						<br><br>En caso de menores de 18 años:
						<br><br>Firma del padre, madre o tutor legal: ________________________________________________
						<br>Aclaración:	________________________________________________
						<br>Fecha: ________________________________________________								
						</div>';
    					
    				
    				
    				
    				
    				$pdf->writeHTML($texto, true, false, true, false, '');    				
					
				}

				$pdf->Output('planilla.pdf', 'I');

				// Para symfony process
				throw new sfStopException();
	  	
		    	return sfView::NONE;   
	 		} else{ 
	 			$this->mensaje = "No se ha encontrado la persona inscripta en esa carrera.";
   				$this->form = new BuscarPersonasForm();
   				$this->form->setDefault('idplanestudio', $request->getParameter('idplanestudio')); 			
   				$this->setTemplate('imprimirplanilla');		
	 		} // fin del if de existe_alumno
		} else {
		 	$this->mensaje = "No se ha encontrado la persona.";

   			$this->form = new BuscarPersonasForm();
   			$this->form->setDefault('idplanestudio', $request->getParameter('idplanestudio')); 			
   			$this->setTemplate('imprimirplanilla');
		} // fin del if de personas
	}

	public function executeGenerarpassword($length = 8) {
	    // start with a blank password
    	$password = "";

	    // define possible characters - any character in this string can be
    	// picked for use in the password, so if you want to put vowels back in
    	// or add special characters such as exclamation marks, this is where
	    // you should do it
    	$possible = "012346789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

	    // we refer to the length of $possible a few times, so let's grab it now
    	$maxlength = strlen($possible);
  
	    // check for length overflow and truncate if necessary
    	if ($length > $maxlength) {
      		$length = $maxlength;
    	}
	
	    // set up a counter for how many characters are in the password so far
    	$i = 0; 
    
	    // add random characters to $password until $length is reached
    	while ($i < $length) { 
			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
			// have we already used this character in $password?
			if (!strstr($password, $char)) { 
        		// no, so it's OK to add it onto the end of whatever we've already got...
        		$password .= $char;
        		// ... and increase the counter by one
        		$i++;
			}
    	}
    // done!
    return $password;
  }

	public function limpiar($String){
	    $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
	    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
	    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
	    $String = str_replace(array('í','ì','î','ï'),"i",$String);
	    $String = str_replace(array('é','è','ê','ë'),"e",$String);
	    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
	    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
	    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
	    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
	    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
	    $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
	    $String = str_replace("ç","c",$String);
	    $String = str_replace("Ç","C",$String);
	    $String = str_replace("ñ","n",$String);
	    $String = str_replace("Ñ","N",$String);
	    $String = str_replace("Ý","Y",$String);
	    $String = str_replace("ý","y",$String);
	     
	    $String = str_replace("&aacute;","a",$String);
	    $String = str_replace("&Aacute;","A",$String);
	    $String = str_replace("&eacute;","e",$String);
	    $String = str_replace("&Eacute;","E",$String);
	    $String = str_replace("&iacute;","i",$String);
	    $String = str_replace("&Iacute;","I",$String);
	    $String = str_replace("&oacute;","o",$String);
	    $String = str_replace("&Oacute;","O",$String);
	    $String = str_replace("&uacute;","u",$String);
	    $String = str_replace("&Uacute;","U",$String);
	    return $String;
	}

	public function executeGeneraremail(sfWebRequest $request) {
		// Obtiene la persona
		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));

		// Obtiene el contacto de la persona
		$oContacto = $oPersona->getContacto(); //($oContacto->getEmail() != "") &&
		if($oContacto &&  ($oContacto->getEmail1() == "")) {
			// busco datos del alumno para generar email

			// formato utilizado (APELLIDOCOMPLETOSINESPACIOS GUION BAJO Y PRIMER NOMBRE)
			if($oContacto){
				$apellido=strtolower(trim($oPersona->getApellido()));
				$apellido=str_replace(" ","",$apellido);
				$nombre=strtolower(trim($oPersona->getNombre()));
				$posespacio=strpos($nombre,' ');
				if($posespacio=='') { $posespacio=strlen($nombre);};
				$nombre=substr($nombre,0,$posespacio);
				$nombrecompleto=$this->limpiar($apellido.'_'.$nombre);
				$correocompleto='+'.$nombrecompleto.'@ucu.edu.ar';
				$oContacto->setEMail1($correocompleto);
				$oContacto->save();
	  		  	echo "Se ha generado un nuevo correo para el alumno.";
			}
  			
		} else {
			
			if(!$oContacto){
				$oContactos = new Contactos();
				$oContactos->setIdpersona($request->getParameter('idpersona'));
				$oContactos->setEmail("no_tiene_email@com.ar");
				$oContactos->save();
			};
			$idcontacto=$oContacto->getIdcontacto();
			echo "Es Obligatorio la cargade email personal para poder notificarlo al alumno mediante esta via. (".$idcontacto.")";
		}
		
		return sfView::NONE;		
	}

	public function executeNotificaremail(sfWebRequest $request) {
		// Obtiene la persona
		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));

		// Obtiene el contacto de la persona
		$oContacto = $oPersona->getContacto();
		// se busca los datos para notificar de cuenta UCU enviando datos a cuenta personal
		if($oContacto){
				$sexo=$oPersona->getIdsexo(); 
				if ($sexo==1) { $texto='o'; }{ $texto='a'; };
	  			// Enviar un correo a biblioteca y administracionalumnos
				$message = $this->getMailer()->compose();
				//$cid = $message->embed(Swift_Image::fromPath('images/Imagen-Entorno-Virtual-Alumnos.jpg'));
				$message->setSubject('Bienvenida');
				//$message->setTo(array($oContacto->getEmail() => $oPersona->getNombre().' '.$oPersona->getApellido()));
				$message->setTo(array($oContacto->getEmail() ));
				$message->setFrom(array('sistemas@ucu.edu.ar' => 'UCU - Sistemas'));

    			$html = '<div><img src="http://alumnos.ucu.edu.ar/images/cabeceraucu_2015.jpg" height="116" width="923" class="CToWUd"></div><P>Bienvenid'.$texto.' a la Universidad de Concepción del Uruguay, te invitamos a que ingreses a tu nueva cuenta de Correo Electrónico Institucional, esta cuenta sera tu medio de contacto con con las diversas Áreas de la Institución, te mantendremos informado de los eventos UCU , recibirás materiales de estudio e información que te va a ser útil en tu vida académica. Vas a poder disfrutar de las Aplicaciones Google Apps (Gmail, Hangout, Calendar, Driver , etc.)<br><br> Ingresar en:<br><br>http://correo.ucu.edu.ar<br><br>usuario: '.$oContacto->getEmail1().'<br>clave: '.$oPersona->getNrodoc().'<br><br>En el primer acceso tendrás que aceptar las condiciones dispuestas en la pantalla de ingreso y luego vas a tener que ingresar dos veces la nueva clave de acceso a tu cuenta de correo UCU.<br><br>Ante cualquier duda envíanos la consulta a informatica@ucu.edu.ar<br><br>Saludos<br><br>Ing. Guillermo A. Zdanowicz<br>Jefe Departamento Informática UCU<br>';
    			
    			$message->setBody($html, 'text/html');

    			$this->getMailer()->send($message);	

		echo "Se ha notificado al alumno de su nueva cuenta de EMail UCU.";
		};
		
		return sfView::NONE;		
	}
}