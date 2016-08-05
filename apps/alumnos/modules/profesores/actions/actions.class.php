<?php

/**
 * profesores actions.
 *
 * @package    sig
 * @subpackage profesores
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesoresActions extends sfActions
{
	
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
  		
  		echo json_encode($resultado);
	
  		return sfView::NONE;
  	}  		
	
	public function executeGuardarcontacto(sfWebRequest $request) {
  		$oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
	  	
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
	
	    echo "El profesor ha sido guardado correctamente.";
	  	  	
	  	return sfView::NONE;
	}	
		
	public function executeGuardarinformacionpersonal(sfWebRequest $request) {
		$numerodoc = $request->getParameter('nrodocumento');
    	$nrodoc = preg_replace("/[^\d]/", "", $numerodoc);		
		$fechaingreso = date('Y-m-d');
		$arr = explode('-', $request->getParameter('fechanacimiento'));
		$fechanacimiento = $arr[2]."-".$arr[1]."-".$arr[0];

	  	if($request->getParameter('idpersona')) {	  		
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
	  	if ($request->getParameter('idprofesor')) {	
  			$oProfesor = Doctrine::getTable('Profesores')->find($request->getParameter('idprofesor'));
  		} else {
	  		$oProfesor = new Profesores();
  			$oProfesor->setIdpersona($oPersona->getIdpersona());
  			$oProfesor->setIdfacultad($request->getParameter('idfacultad'));
  		}
  		$oProfesor->setLegajo($request->getParameter('legajo'));
  		$oProfesor->save();

		if($request->getParameter('idprofesor')) {
	  		echo json_encode(array("idpersona"=>0,"idprofesor"=>0,"mensaje"=>"El profesor se encuentra repetido.")); 
	  	} else { 
			echo json_encode(array("idpersona"=>$oPersona->getIdpersona(),"idprofesor"=>$oProfesor->getIdprofesor(),"mensaje"=>"El profesor ha sido guardado correctamente."));	  		
	  	}  		

		return sfView::NONE;
	}		
	
	public function executeModificar(sfWebRequest $request)	{	
		// Busca si existe el profesor
		$oProfesor = Doctrine_Core::getTable('Profesores')->find($request->getParameter('idprofesor'));
		$oPersona = $oProfesor->getPersonas();
		$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($oPersona->getIdtipodoc());
		$this->facultad = $oProfesor->getFacultades()->getNombre();
		$this->idprofesor = $oProfesor->getIdprofesor();
		
		$this->form = new InscripcionesProfesorForm();
		$this->email = 0;
		$this->activo = 0;
		
		// Si existe obtiene todos los datos personales y los muestra en pantalla
		$this->form->setDefault('idfacultad', $request->getParameter('facultad'));
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

			$this->form->setDefault('legajo', $oProfesor->getLegajo());
			$this->form->setDefault('idprofesor', $oProfesor->getIdprofesor());
		} else {
			$this->idciudadnac = 0;
			$this->idciudadres = 0;
		}
		$this->setTemplate('inscribir');
	}		
	
	public function executeInscribir(sfWebRequest $request)	{
		$numerodoc = $request->getParameter('nrodocumento');
		$nrodoc = preg_replace("/[^\d]/", "", $numerodoc);
	
		$this->idprofesor = 0;
		$this->idtipodoc = 1;

		$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($request->getParameter('idtipodocumento'));        
		$this->formato = $oTipoDocumento->getFormato();  

   		if (preg_match($this->formato, $numerodoc)) {
			$oFacultad = Doctrine_Core::getTable('Facultades')->find($request->getParameter('facultad'));
			$this->facultad = $oFacultad->getNombre();   			
			$this->form = new InscripcionesProfesorForm();
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

			  	// Obtiene la documentacion del alumno
			  	$oProfesor = Doctrine_Core::getTable('Profesores')->buscarProfesor($oPersona->getIdpersona(), $request->getParameter('facultad'));
				if($oProfesor) {
			  		$this->idprofesor = $oProfesor->getIdprofesor();
					$this->form->setDefault('legajo', $oProfesor->getLegajo());	
					$this->form->setDefault('idprofesor', $this->idprofesor);		  		
				}
			} else {
				$this->idpersona = 0;
				$this->idciudadnac = 0;
				$this->idciudadres = 0;		
			}
			$this->form->setDefault('idfacultad', $request->getParameter('facultad'));
			$this->form->setDefault('nrodocumento', $request->getParameter('nrodocumento'));
			$this->form->setDefault('idtipodocumento', $request->getParameter('idtipodocumento'));			
			$this->form->setDefault('tipodocumento', $oTipoDocumento->getDescripcion()."(".$oTipoDocumento->getPaises()->getAbreviacion().")");			
   		} else {		
 			$this->mensaje = "Formato de documento no valido Ejemplo para DNI 22.456.333";

   			$this->form = new BuscarPersonasForm();
   			$this->form->setDefault('facultad', $request->getParameter('facultad'));
			$this->form->setDefault('idtipodocumento', $request->getParameter('idtipodocumento'));
			$this->form->setDefault('nrodocumento', $request->getParameter('nrodocumento'));   			
   			$this->setTemplate('buscarpersona');
   		}
	}		
	
	public function executeBuscarpersona(sfWebRequest $request)	{
		$this->mensaje = "";
		$this->form = new BuscarPersonasForm();
	}		
	
  public function executeIndex(sfWebRequest $request)
  {     
 	$arreglo = "";
  	$oUsuario = $this->getUser()->getGuardUser();
 	$oPerfil = $oUsuario->getProfile();
    $oAreas = new Areas(); 	
   	$facultades = $oAreas->obtenerFacultadesPorArea($oPerfil->getIdarea());
  	foreach($facultades as $facultad){
		$arreglo .= $facultad->idfacultad.", "; 
	}
	$arregloFacultades = substr($arreglo, 0, strlen($arreglo)-2);
          
  	$q = Doctrine_Core::getTable('Profesores')
      ->createQuery('p')
      ->where('p.idfacultad IN ( '.$arregloFacultades.' )');
      

     $this->pager = new sfDoctrinePager(
      'Profesores',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();        
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProfesoresForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProfesoresForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($profesores = Doctrine_Core::getTable('Profesores')->find(array($request->getParameter('idprofesor'))), sprintf('Object profesores does not exist (%s).', $request->getParameter('idprofesor')));
    $this->form = new ProfesoresForm($profesores);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($profesores = Doctrine_Core::getTable('Profesores')->find(array($request->getParameter('idprofesor'))), sprintf('Object profesores does not exist (%s).', $request->getParameter('idprofesor')));
    $this->form = new ProfesoresForm($profesores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($profesores = Doctrine_Core::getTable('Profesores')->find(array($request->getParameter('idprofesor'))), sprintf('Object profesores does not exist (%s).', $request->getParameter('idprofesor')));
    $profesores->delete();

    $this->redirect('profesores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $profesores = $form->save();

      $this->redirect('profesores/edit?idprofesor='.$profesores->getIdprofesor());
    }
  }
}
