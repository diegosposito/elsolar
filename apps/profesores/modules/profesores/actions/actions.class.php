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
  public function executeShow(sfWebRequest $request)
  {
    $this->personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona')));
    $this->forward404Unless($this->personas);
  }

  public function executeBuscarpersona(sfWebRequest $request) {
    $this->mensaje = "";
    $this->form = new BuscarPersonasForm();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PersonasForm();
  }

  public function executeRegistrar(sfWebRequest $request)
  {
  }

  public function executeInscribir(sfWebRequest $request) {
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

  public function executeGuardarcontacto(sfWebRequest $request) {
      $oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
      
      /////////////////////////////////////////////////////
    //conexion webservice alumnos
    /*$soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
    $soapclient->setCredentials("root", "sistemas2009");
        
    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarcontacto',
      array('idcontacto' => NULL,
      'idpersona' => $oPersona->getIdpersona(), 
      'idtipocontacto' => '1', 
      'idciudad' => $request->getParameter('ciudadresidencia'), 
      'campo1' => $request->getParameter('nombrecalle'), 
      'campo2' => $request->getParameter('edificio'), 
      'campo3' => $request->getParameter('casa'), 
      'campo4' => $request->getParameter('depto'), 
      'campo5' => $request->getParameter('manzana'), 
      'campo6' => $request->getParameter('barrio'), 
      'campo7' => $request->getParameter('piso'),       
      'campo8' => $request->getParameter('nrocalle'))
    );
    $this->domicilioEstable = unserialize(base64_decode($resultadoSoap));
    $resultadoSoap = $soapclient->call('actualizarcontacto',
      array('idcontacto' => NULL,
      'idpersona' => $oPersona->getIdpersona(), 
      'idtipocontacto' => '3',  
      'idciudad' => NULL, 
      'campo1' => NULL, 
      'campo2' => NULL, 
      'campo3' => $request->getParameter('areatelefonofijo'), 
      'campo4' => $request->getParameter('nrotelefonofijo'),
      'campo5' => NULL, 
      'campo6' => NULL, 
      'campo7' => NULL,       
      'campo8' => NULL)     
    );  
    $this->telefonoFijo = unserialize(base64_decode($resultadoSoap));
    $resultadoSoap = $soapclient->call('actualizarcontacto',
      array('idcontacto' => NULL,
      'idpersona' => $oPersona->getIdpersona(), 
      'idtipocontacto' => '4',  
      'idciudad' => NULL, 
      'campo1' => NULL, 
      'campo2' => NULL,       
      'campo3' => $request->getParameter('areatelefonomovil'), 
      'campo4' => $request->getParameter('nrotelefonomovil'),
      'campo5' => NULL, 
      'campo6' => NULL, 
      'campo7' => NULL,       
      'campo8' => NULL)         
    );    
    $this->telefonoMovil = unserialize(base64_decode($resultadoSoap));
    $resultadoSoap = $soapclient->call('actualizarcontacto',
      array('idcontacto' => NULL,
      'idpersona' => $oPersona->getIdpersona(), 
      'idtipocontacto' => 7,  
      'idciudad' => NULL,
      'campo1' => $request->getParameter('email'),
      'campo2' => NULL,       
      'campo3' => NULL, 
      'campo4' => NULL,
      'campo5' => NULL, 
      'campo6' => NULL, 
      'campo7' => NULL,       
      'campo8' => NULL)         
    );
    $this->email = unserialize(base64_decode($resultadoSoap));   */           
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
    $oContacto->setEmail1($request->getParameter('email1'));
    $oContacto->save();
    $resultado = "El Aspirante ha sido guardado correctamente.";
    
    /*if(!$this->domicilioEstable) {
        $resultado .= "Webservice: El domicilio estable se encuentra repetido o no existe."; 
      }   
    if(!$this->telefonoFijo) {
        $resultado .= "Webservice: El telefono fijo se encuentra repetido o no existe."; 
      }       
    if(!$this->telefonoMovil) {
        $resultado .= "Webservice: El telefono movil se encuentra repetido o no existe."; 
      } 
    if(!$this->email) {
        $resultado .= "Webservice: El email se encuentra repetido o no existe."; 
      } */  
      echo $resultado;
          
      return sfView::NONE;
  } 

  public function executeGuardarinformacionpersonal(sfWebRequest $request) {
    $numerodoc = $request->getParameter('nrodocumento');
      $nrodoc = preg_replace("/[^\d]/", "", $numerodoc);    
    $fechaingreso = date('Y-m-d');
    $arr = explode('-', $request->getParameter('fechanacimiento'));
    $fechanacimiento = $arr[2]."-".$arr[1]."-".$arr[0];

      /////////////////////////////////////////////////////
    //conexion webservice alumnos
    /*$soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
    $soapclient->setCredentials("root", "sistemas2009");
    
    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarpersona',
      array('idpersona' => $request->getParameter('idpersona'),
      'nombre' => ucwords(strtolower($request->getParameter('nombre'))), 
      'apellido' => strtoupper($request->getParameter('apellido')), 
      'sexo' => $request->getParameter('idsexo'), 
      'idtipodoc' => $request->getParameter('idtipodocumento'),
      'nrodoc' => $nrodoc,      
      'fechanac' => $fechanacimiento,
      'fechaingreso' => $fechaingreso,
      'idciudadnac' => $request->getParameter('ciudadnacimiento'), 
      'idnacionalidad' => $request->getParameter('paisnacimiento'),
      'estadocivil' => $request->getParameter('estadocivil'),
      'vive' => 1)
    );

      $this->persona = unserialize(base64_decode($resultadoSoap));    */

      if($request->getParameter('idpersona')) {       
        $oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
    } else {
      $oPersona = new Personas();
      $oPersona->setIdpersona($this->persona['idPersona']);
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
    $fechaegreso=($arr[2]."-".$arr[1]."-".$arr[0]);
      $oEstudio->setDuracion($request->getParameter('duracion'));
      $oEstudio->setIdunidadtiempo($request->getParameter('unidadtiempo'));
    $oEstudio->setConcluyo($request->getParameter('concluyo'));
    $oEstudio->setContinua($request->getParameter('continua'));
      $oEstudio->setCantmaterias($request->getParameter('numerototal'));
      $oEstudio->setCantmatapro($request->getParameter('numeroaprobadas'));
      $oEstudio->setAnioingreso($request->getParameter('anioingreso'));
      $oEstudio->setAnioegreso($request->getParameter('anioegreso'));
      $oEstudio->setPromedio($request->getParameter('promedio'));
      $oEstudio->setFormaciondocente($request->getParameter('formaciondocente'));

      if ($request->getParameter('formaciondocente') == 'on')
          $oEstudio->setFormaciondocente(1);
        else
          $oEstudio->setFormaciondocente(0);

      $oEstudio->save();

    /////////////////////////////////////////////////////
    //conexion webservice alumnos
  /*  
      $soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
    $soapclient->setCredentials("root", "sistemas2009");
    
    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarestudios',
      array('idpersona' => $oEstudio->getIdpersona(),
        'idnivelestudio' => $request->getParameter('nivel'),
        'descripcion' => $request->getParameter('titulo'), 
        'establecimiento' => $request->getParameter('establecimiento'), 
        'idciudad' => $request->getParameter('ciudadestablecimiento'), 
        'fecha' => $arr[2]."-".$arr[1]."-".$arr[0], 
        'duracion' => $request->getParameter('duracion'), 
        'anioingreso' => $request->getParameter('anioingreso'), 
        'anioegreso' => $request->getParameter('anioegreso'), 
        'idunidadtiempo' => $request->getParameter('unidadtiempo'),
        'cantmaterias' => $request->getParameter('numerototal'), 
        'cantmatapro' => $request->getParameter('numeroaprobadas'), 
        'promedio' => $request->getParameter('promedio'),
        'concluyo' => $request->getParameter('concluyo'), 
        'continua' => $request->getParameter('continua'), 
        'idcategoriatitulo' => $request->getParameter('categoria')
      )   
    );
             
    $this->estudio = unserialize(base64_decode($resultadoSoap));
      $resultado = "El estudio previo sido guardado correctamente.";
    if(($this->estudio == "1E") || ($this->estudio == "2E")) {
        $resultado = "Webservice: El estudio previo se encuentra repetida o no existe."; 
      }         
   */
      /////////////////////////////////////////////////////     
    
      echo "El estudio previo ha sido guardado correctamente.";

      return sfView::NONE;    
  }

  public function executeDesignar(sfWebRequest $request)
  {
    
    $result = strpos( $request->getReferer(), '/personas/buscar');

    $this->idplanestudio = $request->getParameter('idplanestudio', '');
    $this->idprofesor = $request->getParameter('idprofesor', '');
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    
    if ($result>0){

      $this->idprofesor = $request->getParameter('idprofesor', '');
      $this->msgError = "";
    
    } else {

      $this->idprofesor = Encriptar::decrypt($request->getParameter('idprofesor', ''), "!@#$%^&*");
      //$this->msgError = Encriptar::decrypt($request->getParameter('msgError', ''), "!@#$%^&*");
      $this->msgError =$request->getParameter('msgError', '');
        
    }
    
    $oProfesor = Doctrine_Core::getTable('Profesores')->find($this->idprofesor);
    $idpersona = $oProfesor->getIdpersona();
   
    $this->oPersona = Doctrine_Core::getTable('Personas')->find($idpersona);

    $this->form = new DesignacionesProfForm();
  }

  public function executeEdit(sfWebRequest $request)
  { 
    $result = strpos( $request->getReferer(), '/personas/buscar');

    // control para saber si puede editar
    $oDesignaciones = Doctrine_Core::getTable('Designaciones')->find($request->getParameter('iddesignacion'));
    $oProfesor = Doctrine_Core::getTable('Profesores')->find($oDesignaciones->getIdProfesor());
    
    // este control se puede agregar pero falta definir el perfil de juan
    /*if ($oDesignaciones->getIdestadodesignacion()!=1 && $oDesignaciones->getIdestadodesignacion()!=3){
          $this->redirect($this->generateUrl('default', array('module' => 'profesores',
            'action' => 'ver', 'idpersona' => $oProfesor->getIdPersona(), 'msgError' => 'Esta designacion no puede ser editada' )));
    }*/

    $infodesignacion = Doctrine_Core::getTable('Designaciones')->obtenerInfoDesignacion($request->getParameter('iddesignacion'));
    
    if ($infodesignacion[0]['idsede']<>sfContext::getInstance()->getUser()->getAttribute('id_sede','')){
          $this->redirect($this->generateUrl('default', array('module' => 'profesores',
            'action' => 'ver', 'idpersona' => $oProfesor->getIdPersona(), 'msgError' => 'Esta designacion no puede ser editada con este perfil de usuario' )));
    }

    $this->idplanestudio = $infodesignacion[0]['idplanestudio'];
    $this->idprofesor = $infodesignacion[0]['idprofesor'];
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $this->iddesignacion = $request->getParameter('iddesignacion');
    $this->msgError = $request->getParameter('msgError');
    
    $oProfesor = Doctrine_Core::getTable('Profesores')->find($this->idprofesor);
    $idpersona =  $infodesignacion[0]['idpersona'];
   
    $this->oPersona = Doctrine_Core::getTable('Personas')->find($idpersona);
    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    $this->form = new DesignacionesProfForm(array(), array('iddesignacion' => $request->getParameter('iddesignacion')));

  }

  
  public function executeVer(sfWebRequest $request)
  {
    
    if ($request->getParameter('idpersona', '')=='')
      $this->redirect($this->generateUrl('default', array('module' => 'personas',
                'action' => 'buscar', 'msgError' => 'Seleccione un profesor' )));

    // Parametros opcionales
    $fechadesde=''; $fechahasta='';
    $idplanestudio = $request->getParameter('idplanestudio', '');
    $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
    $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
    $idestadodesignacion=''; // todos los tipos de designaciones

    if ($request->getParameter('fechadesde')<>''){
      $arr = explode('-', $request->getParameter('fechadesde'));
      $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
    }
    
    if ($request->getParameter('fechahasta')<>''){
      $arr = explode('-', $request->getParameter('fechahasta'));
      $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
    }

    // Parametros obligatorios
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

    if (Encriptar::decrypt($request->getParameter('action_decrypt', ''), "!@#$%^&*")=='decrypt')
      $this->idpersona = Encriptar::decrypt($request->getParameter('idpersona', ''), "!@#$%^&*");   
    else
      $this->idpersona = $request->getParameter('idpersona', '');
        
    
    $this->oPersona = Doctrine_Core::getTable('Personas')->find($this->idpersona);
    
    $orderby = 2; // ordena por fechainicio designacion y luego por nombre materia
    $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesPorPersona($this->idpersona, $this->idarea, $this->idsede, $idplanestudio, $idcategoriadesignacion, $idtipodesignacion, $idestadodesignacion, $fechadesde, $fechahasta, $orderby);
    
    $this->msgSuccess = $request->getParameter('msgSuccess');
    $this->msgError = $request->getParameter('msgError');
    $this->form = new DesignacionesVerForm();
  }

  public function executeMostrar(sfWebRequest $request)
  {
   
    // Parametros opcionales
    $fechadesde=''; $fechahasta=''; $idsede = '';
    $idplanestudio = $request->getParameter('idplanestudio', '');
    $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
    $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
    $idestadodesignacion =''; // en todos los estados de designacion

    if ($request->getParameter('fechadesde')<>''){
      $arr = explode('-', $request->getParameter('fechadesde'));
      $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
    }
    
    if ($request->getParameter('fechahasta')<>''){
      $arr = explode('-', $request->getParameter('fechahasta'));
      $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
    }

    // Parametros obligatorios
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

    //Sede central seria administrador de todas las designaciones de la facultad respectiva
      if ($idsede=='1')
          $idsede='';

    if (Encriptar::decrypt($request->getParameter('action_decrypt', ''), "!@#$%^&*")=='decrypt')
      $this->idpersona = Encriptar::decrypt($request->getParameter('idpersona', ''), "!@#$%^&*");   
    else
      $this->idpersona = $request->getParameter('idpersona', '');
        
    
    $this->oPersona = Doctrine_Core::getTable('Personas')->find($this->idpersona);

    $orderby = 2; // ordena por fechainicio designacion y luego por nombre materia

    $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesPorPersona($this->idpersona, $this->idarea, $idsede, $idplanestudio, $idcategoriadesignacion, $idtipodesignacion, $idestadodesignacion, $fechadesde, $fechahasta, $orderby);
   
  }

  public function executeConsultar(sfWebRequest $request)
  {
   
      // Parametros opcionales
      $fechadesde=''; $fechahasta=''; 
      $idfacultad=''; $idpersona=''; $estadodesignacion=''; $idresolucion='';
      $idcategoriadesignacion ='';$idtipodesignacion='';
      $idplanestudio = $request->getParameter('idplanestudio', '');
      $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
      $idpersona = $request->getParameter('idpersona', '');
      $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
      $estadodesignacion = $request->getParameter('idestadodesignacion', '');
      $idcatedra = $request->getParameter('idcatedra', '');

       // Parametros obligatorios
      $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
      foreach($facultades as $facultad){
      
        if ($idfacultad=='')
          $idfacultad= $facultad['idfacultad'];

      } 

      //Sede central seria administrador de todas las designaciones de la facultad respectiva
      if ($idsede=='1'){
          $idsede=''; 
          $idarea='';
      }
          

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }

      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion, $idcatedra);
  
  }

  public function executeImprimir(sfWebRequest $request)
  {
   
    // Parametros opcionales
    $fechadesde=''; $fechahasta=''; $facultad='';
    $idplanestudio = $request->getParameter('idplanestudio', '');
    $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
    $idtipodesignacion = $request->getParameter('idtipodesignacion', '');

// este valor viene hardcodeado de la vista, dado que solo se imprimen designaciones en estado=5 (aprobadas)
    $idestadodesignacion = $request->getParameter('idestadodesignacion', '');

    if ($request->getParameter('fechadesde')<>''){
      $arr = explode('-', $request->getParameter('fechadesde'));
      $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
    }
    
    if ($request->getParameter('fechahasta')<>''){
      $arr = explode('-', $request->getParameter('fechahasta'));
      $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
    }

    // Parametros obligatorios
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

    if (Encriptar::decrypt($request->getParameter('action_decrypt', ''), "!@#$%^&*")=='decrypt')
      $this->idpersona = Encriptar::decrypt($request->getParameter('idpersona', ''), "!@#$%^&*");   
    else
      $this->idpersona = $request->getParameter('idpersona', '');
        
    
    $this->oPersona = Doctrine_Core::getTable('Personas')->find($this->idpersona);
 
    // ** Variables para Imprimir  **
    $fdesde = str_replace("-", "/", $request->getParameter('fechadesde'));
    $fhasta = str_replace("-", "/", $request->getParameter('fechahasta'));
    $profesor = $this->oPersona->getApellido().', '.$this->oPersona->getNombre();
    $current_date = date('d/m/Y');
    $titulo = $this->oPersona->getIdSexo()==1 ? 'Profesor' : 'Profesora';

     // Obtener facultad del area relacionada al usuario
    $facultades = Doctrine_Core::getTable('Profesores')->obtenerFacultadSegunArea($this->oPersona->getIdPersona(), $this->idarea );
    
    foreach($facultades as $infofac)
        $facultad = $infofac['nombre'];

    // ** Fin de Variables a Imprimir  

    $orderby = 2; // ordena por fechainicio designacion y luego por nombre materia
    // Obtener designaciones del profesor
    $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesPorPersona($this->idpersona, $this->idarea, $idsede, $idplanestudio, $idcategoriadesignacion, $idtipodesignacion, $idestadodesignacion, $fechadesde, $fechahasta, $orderby);

    // Obtener fecha de la resolucion csu para el grupo de designaciones
    $fecha_csu='';$fechacsu='';
    foreach($this->resultado as $datos){

          $fecha_csu= Doctrine_Core::getTable('Designaciones')->obtenerFechaResolucionCsuPorDesignacion($datos['iddesignacion']);
          $fechacsu = date("d/m/Y", strtotime($fecha_csu[0]['fecha']));
          break;
    }

    // Crea una instancia de la clase de FPDF
    $config = sfTCPDFPluginConfigHandler::loadConfig();
    
    // pdf object
    $pdf = new profPDF();

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 002');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

   
    // set default header data
    switch (sfContext::getInstance()->getUser()->getAttribute('id_sede','')) {
    case '1':
        $pdf->SetHeaderData('headProfesoresSC.jpg', '170', '', '');
        break;
    case '2':
        $pdf->SetHeaderData('headProfesoresSRG.jpg', '170', '', '');
        break;
    case '3':
        $pdf->SetHeaderData('headProfesoresEAV.jpg', '170', '', '');
        break;
    case '4':
        $pdf->SetHeaderData('headProfesoresCRR.jpg', '170', '', '');
        break;
    case '5':
        $pdf->SetHeaderData('headProfesoresCRSF.jpg', '170', '', '');
        break;
    case '6':
        $pdf->SetHeaderData('headProfesoresCRP.jpg', '170', '', '');
        break;
    case '7':
        $pdf->SetHeaderData('headProfesoresEAG.jpg', '170', '', '');
        break;                
    default:
        $pdf->SetHeaderData('CabeceraSIG-UCU.jpg', '170', '', '');
    }

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont("Times", "", 12);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

    // Set some content to print
    $html = <<<EOD
            <br>
            <p><b>{$titulo}: {$profesor} 
               <br> S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D 
               <br> ---------------------------------- 
               <br> De nuestra consideración: <br></b>
            </p>
            
            <p>Me dirijo a usted a los efectos de hacerle saber que en la reunión del CSU de la Universidad de
        Concepción del Uruguay de fecha {$fechacsu} se le ha designado {$titulo} de la {$facultad}
        , por el período comprendido entre el {$fdesde} al {$fhasta} en las materias que se
        especifican a continuación, siendo su remuneración de acuerdo a las horas efectivamente dictadas.</p>
EOD;

      $html2='<table>'; $ad_licencia='';

      foreach($this->resultado as $datos){
          $ad_licencia=$datos['licencia']?' (En licencia) ':'';
          $html2 .='<tr><td width="1200" height="30">Carrera: '. $datos['carreraplan'];
          $html2 .='<br/> Asignatura: '.$datos['materia'];
          $html2 .='<br/>Cargo: '.$datos['tipo'].$ad_licencia.'<br/>';
          $html2 .='</td></tr>';
      }

      $html2.='</table><br/><br/>';

      $html3.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Tal designación debe ser aceptada por usted en forma expresa. Agradeciendo vuestra estimable
colaboración, me complace saludarlo/a con distinguida consideración. <br>
_______________________________________________________________________________
';    
      
      $html4= <<<EOD
       <br><br><br><br><br><br><br><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;He tomado conocimiento de la nota de fecha {$current_date} del Sr. Decano de la {$facultad}
        por la cual se me designa como {$titulo} de las asignaturas que arriba se detallan, por el
período {$fdesde} al {$fhasta}. Presto mi plena conformidad a la modalidad de la designación tal
como se explicita en la nota cuyo acuse de recibo y formal aceptación notifico en la presente.
<br><br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
C. del Uruguay,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma:
EOD;

      // Print text using writeHTMLCell()
      $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html.$html2.$html3.$html4, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
      
      $pdf->AddPage();

      // Print text using writeHTMLCell()
    //  $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html4, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
      
    //  $pdf->AddPage();

      // Print text using writeHTMLCell()
      $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html.$html2.$html3, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
     

      // Close and output PDF document
      // This method has several options, check the source code documentation for more information.
      $pdf->Output('designaciones.pdf', 'I');

      // Stop symfony process
      throw new sfStopException();
      
      return sfView::NONE;
  }

  public function executeImppdf(sfWebRequest $request)
  {
   
    // Parametros opcionales
    $fechadesde=''; $fechahasta=''; $facultad='';
    $idplanestudio = $request->getParameter('idplanestudio', '');
    $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
    $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
    $idestadodesignacion = $request->getParameter('idestadodesignacion', '');

    if ($request->getParameter('fechadesde')<>''){
      $arr = explode('-', $request->getParameter('fechadesde'));
      $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
    }
    
    if ($request->getParameter('fechahasta')<>''){
      $arr = explode('-', $request->getParameter('fechahasta'));
      $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
    }

    // Parametros obligatorios
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

    // ** Variables para Imprimir  **
    $fdesde = str_replace("-", "/", $request->getParameter('fechadesde'));
    $fhasta = str_replace("-", "/", $request->getParameter('fechahasta'));
    $current_date = date('d/m/Y');
    // ** Fin de Variables a Imprimir  

    $orderby = 2; // ordena por fechainicio designacion y luego por nombre materia
    
    // Obtener informacion a imprimir en PDF
    $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $idestadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion, $idcatedra);
      

    // Crea una instancia de la clase de FPDF
    $config = sfTCPDFPluginConfigHandler::loadConfig();
    
    // pdf object
    $pdf = new profPDF();

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 002');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData('CabeceraSIG-UCU.jpg', '170', '', '');

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont("Times", "", 12);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

    // Set some content to print
    $html = <<<EOD
            <table border="1">
<tr>
<th rowspan="3">Left column</th>
<th colspan="5">Heading Column Span 5</th>
<th colspan="9">Heading Column Span 9</th>
</tr>
<tr>
<th rowspan="2">Rowspan 2<br />This is some text that fills the table cell.</th>
<th colspan="2">span 2</th>
<th colspan="2">span 2</th>
<th rowspan="2">2 rows</th>
<th colspan="8">Colspan 8</th>
</tr>
<tr>
<th>1a</th>
<th>2a</th>
<th>1b</th>
<th>2b</th>
<th>1</th>
<th>2</th>
<th>3</th>
<th>4</th>
<th>5</th>
<th>6</th>
<th>7</th>
<th>8</th>
</tr>
</table>
EOD;

      $html2='<table>';

      foreach($this->resultado as $datos){
          $html2 .='<tr><td width="1200" height="30">Carrera: '. $datos['carreraplan'];
          $html2 .='<br/> Asignatura: '.$datos['materia'];
          $html2 .='<br/>Cargo: '.$datos['tipo'].'<br/>';
          $html2 .='</td></tr>';
      }

      $html2.='</table><br/><br/>';

      $html3.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Tal designación debe ser aceptada por usted en forma expresa. Agradeciendo vuestra estimable
colaboración, me complace saludarlo/a con distinguida consideración. <br>
_______________________________________________________________________________
';    
      
      $html4= <<<EOD
       <br><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;He tomado conocimiento de la nota de fecha {$current_date} del Sr. Decano de la {$facultad}
        por la cual se me designa como {$titulo} de las asignaturas que arriba se detallan, por el
período {$fdesde} al {$fhasta}. Presto mi plena conformidad a la modalidad de la designación tal
como se explicita en la nota cuyo acuse de recibo y formal aceptación notifico en la presente.
EOD;

      // Print text using writeHTMLCell()
      $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html.$html2.$html3, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
      
      $pdf->AddPage();

      // Print text using writeHTMLCell()
      $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html4, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);


      // Close and output PDF document
      // This method has several options, check the source code documentation for more information.
      $pdf->Output('designaciones.pdf', 'I');

      // Stop symfony process
      throw new sfStopException();
      
      return sfView::NONE;
  }


  public function executeAprobardesignaciones(sfWebRequest $request)
  {
      $this->form = new DesignacionesAprobarForm();
      $this->msg = $request->getParameter('msg');
      $this->success = $request->getParameter('success');
  }

  public function executeConsultardesignaciones(sfWebRequest $request)
  {
        // Parametros opcionales
      $fechadesde=''; $fechahasta='';
      $idfacultad=''; $idpersona=''; $estadodesignacion=''; $idresolucion='';
      $idplanestudio = $request->getParameter('idplanestudio', '');
      $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
      $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
      $idcatedra = $request->getParameter('idcatedra', '');

       // Parametros obligatorios
      $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($idpersona<>'')
          $this->oPersona = Doctrine_Core::getTable('Personas')->find($idpersona);

      //$this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idarea, $idsede, $idfacultad, $idplanestudio, $idpersona, $idcategoriadesignacion, $idtipodesignacion, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion);
      $this->form = new DesignacionesConsultarForm();
  }

  public function executeFindecarga(sfWebRequest $request)
  {
      $this->form = new FinDeCargaForm();
  }

  public function executeConfirmarfindecarga(sfWebRequest $request)
  {
        // Parametros opcionales
      $fechadesde=''; $fechahasta=''; $idfacultad = ''; $idestadodesignacion= '';
      $idplanestudio=''; $idpersona=''; $idcategoriadesignacion=''; $idtipodesignacion=''; $idresolucion='';
    
      // Parametros obligatorios
      $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      $idfacultad= $request->getParameter('idfacultad');

      // Solo designaciones en estado inicial pueden confirmarse para finalizar la carga, 
      // Las observadas deben editarse y corregirse/ o eliminarse
      $idestadodesignacion= $request->getParameter('idestadodesignacion');

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      $resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $idestadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion, $idcatedra);
      
      $arrDesignaciones = array();
      
      foreach ($resultado as $datos) {
        $arrDesignaciones[] = $datos['iddesignacion'];
      }
      
      if (count($arrDesignaciones)>0)
          Doctrine_Core::getTable('Designaciones')->confirmarfincargaDesignaciones($arrDesignaciones); 
      
      if (count($arrDesignaciones)>0){
         $this->msgSuccess = 'El Fin de Carga se hizo correctamente!!';
      } else
      {
         $this->msgError = 'No hay elementos seleccionados para finalizar la carga!!';
      }
  }

  public function executeConsultardesignacionesporfacultad(sfWebRequest $request)
  {
        // Parametros opcionales
      $fechadesde=''; $fechahasta=''; $idarea='';
      $idfacultad=''; $idpersona=''; $idsede=''; $estadodesignacion=''; $idresolucion='';
      $idplanestudio = $request->getParameter('idplanestudio', '');
      $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
      $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
      $idsede = $request->getParameter('idsede', '');
      $idfacultad = $request->getParameter('idfacultad', ''); 
      $idcatedra = $request->getParameter('idcatedra', ''); 
      $habilitado = true;

      $permisos = sfContext::getInstance()->getUser()->getGuardUser()->getAllPermissions();

      // SOlo usuarios con credencial adminProfesores pueden usar este modulo
      /*if (!sfContext::getInstance()->getUser()->hasCredential('adminProfesores')) 
          die("Solo usuario con credencial adminProfesores pueden usar este modulo");*/
     
       // Parametros obligatorios
      //$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      //$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($idpersona<>'')
          $this->oPersona = Doctrine_Core::getTable('Personas')->find($idpersona);

      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion, $idcatedra);
     
      $this->form = new DesignacionesConsultarPorFacultadForm();
  }

  public function executeConsultardesignacionesporfacultadcsv(sfWebRequest $request)
  {
        // Parametros opcionales
      $fechadesde=''; $fechahasta=''; $idarea='';
      $idfacultad=''; $idpersona=''; $idsede=''; $estadodesignacion=''; $idresolucion='';
      $idplanestudio = $request->getParameter('idplanestudio', '');
      $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
      $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
      $idsede = $request->getParameter('idsede', '');
      $idfacultad = $request->getParameter('idfacultad', ''); 
      $idcatedra = $request->getParameter('idcatedra', ''); 
      $habilitado = true;

      $permisos = sfContext::getInstance()->getUser()->getGuardUser()->getAllPermissions();

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($idpersona<>'')
          $this->oPersona = Doctrine_Core::getTable('Personas')->find($idpersona);

      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion, $idcatedra);
       
      $file = 'consultardesignaciones.csv';
      $fh = fopen($file,"w+") or die ("unable to open file");

      $row = "SEDE;CARRERA;FACULTAD;APELLIDO;NOMBRE;MATERIA;HORAS;TIPO ASIGNACION;INICIO;FIN;DEDICACION;ESTADO;OBSERVACIONES;MOTIVONUEVADESIGNACION".";"."\n";
      fwrite($fh,$row);


      foreach($this->resultado as $registro) {
         
            $row = $registro['sedeabv'].";".$registro['carreraplan'].";".$registro['facultad'].";".$registro['apellido'].";".$registro['nombre'].";".$registro['materia'].";".$registro['horas'].";".$registro['tipo']."(".$registro['categoria'].");".$registro['inicioformat'].";".$registro['finformat'].";".$registro['dedicacion'].";".$registro['estadodesignacion'].";".$registro['observaciones'].";".$registro['motivonuevadesignacion'].";"."\n";
         
            fwrite($fh,$row);
      
      }

      //var_dump($this_resultado);

      fclose($fh);
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Type: application/force-download");
      header("Content-Transfer-Encoding: binary");
      header("Content-Disposition: attachment;filename=".$file );
      header("Content-Length: ".filesize($file));
      header("Pragma: no-cache");
      header("Expires: 0");
      readfile($file);
  
      return sfView::NONE;

  }

  public function executeAprobardesignacionesxfacultad(sfWebRequest $request)
  {
        // Parametros opcionales
      $fechadesde=''; $fechahasta=''; $idfacultad=''; $idsede = '';
      $idfacultad = $request->getParameter('idfacultad', '');
      $idsede = $request->getParameter('idsede', '');

      $this->msgError = $request->getParameter('msgError', '');
      $this->msgSuccess = $request->getParameter('msgSuccess', '');

       // Parametros obligatorios
      //$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      //$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idarea, $idsede, $idfacultad, $idplanestudio, $idpersona, $idcategoriadesignacion, $idtipodesignacion, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion);
     
      $this->form = new DesignacionesAprobarPorFacultadForm();
  }


  public function executeConsultarporfacultad(sfWebRequest $request)
  {
   
      // Parametros opcionales
      $fechadesde=''; $fechahasta=''; $idarea='';
      $idfacultad=''; $idpersona=''; $estadodesignacion=''; $idresolucion='';
      $idcategoriadesignacion ='';$idtipodesignacion='';
      $idplanestudio = $request->getParameter('idplanestudio', '');
      $idcatedra = $request->getParameter('idcatedra', '');
      $idsede = $request->getParameter('idsede', '');
      $idfacultad = $request->getParameter('idfacultad', '');
      $idcategoriadesignacion = $request->getParameter('idcategoriadesignacion', '');
      $idpersona = $request->getParameter('idpersona', '');
      $idtipodesignacion = $request->getParameter('idtipodesignacion', '');
      $estadodesignacion = $request->getParameter('idestadodesignacion', '');

      

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion, $idcatedra);
   
  }

  public function executeElevardesignaciones(sfWebRequest $request)
  {
      // Parametros obligatorios
      $idsede = ''; $idfacultad='';
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $this->msgSuccess = $request->getParameter('msgSuccess', '');
      $this->msgError = $request->getParameter('msgError', '');
      $estadodesignacion = 1; // estado inicial de la designacion (el unico que se puede elevar)

      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
      foreach($facultades as $facultad){
      
         if ($idfacultad=='')
           $idfacultad= $facultad['idfacultad'];

      } 

      //Sede central seria administrador de todas las designaciones de la facultad respectiva
      if ($idsede=='1')
          $idsede=''; 
      
      $idarea='';// al elevar no se filtra por area, se filtra siempre por el idfacultad, se eleva toda la facultad
      
      //$this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idarea, $idsede, $idfacultad, $idplanestudio, $idpersona, $idcategoriadesignacion, $idtipodesignacion, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion);
      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion);

      // solo usuarios de sede central pueden elevar designaciones
      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para elevar designaciones!!';
          $this->resultado ='';
      }
   
  }

  public function executeResolucionfacultad(sfWebRequest $request)
  {
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $idsede = $request->getParameter('idsede', '');
      $this->msgSuccess = $request->getParameter('msgSuccess', '');
      $this->msgError = $request->getParameter('msgError', '');
     
      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
     // Obtener facultad relacionada al area // debe ser una facultad
      foreach($facultades as $facultad){
          if ($idfacultad==''){
            $idfacultad= $facultad['idfacultad'];
            $nombrefacultad = $facultad['nombre'];
          } 
      } 

      // solo usuarios de sede central pueden asignar resoluciones
      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para asignar resoluciones!!';
          $this->resultado ='';
      }

      if ($idsede=='')
         $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
     
      // Obtener Sedes
      $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();
      
      $this->idsede = $idsede;
     
  }

  public function executeAsignarresolucionseleccionada(sfWebRequest $request)
  {
       $this->msgSuccess = $request->getParameter('msgSuccess', '');
       $this->msgError = $request->getParameter('msgError', '');

      // Debe seleccionarse una resolucion para realizar esta operacion
        if ($request->getParameter('idresolucion')>0){     

            $oResolucion = Doctrine_Core::getTable('ResolucionesProfesores')->find($request->getParameter('idresolucion'));
            $arr_designaciones = array();
           
            // Obtiene designaciones seleccionadas en la vista en un array
            $idcase = $request->getParameter('idcase', '');

            foreach($idcase as $seleccionados){
              if(is_numeric($seleccionados)) 
                $arr_designaciones[] = $seleccionados;
            }

           // Si existen designaciones para asignar nro de resolucion
            if ( count($arr_designaciones)>0 ){
                $resultado = Doctrine_Core::getTable('Designaciones')->asignarresolucionDesignaciones($arr_designaciones, $oResolucion->getIdResolucionProfesor());
                $estado = 'Las designaciones seleccionadas fueron actualizadas con número de resolución elegido.';
                $this->redirect($this->generateUrl('default', array('module' => 'profesores',
                'action' => 'resolucionfacultad', 'msgSuccess' => $estado )));
            } else {
               $estado='No hay designaciones seleccionadas para asignar número de resolución';
               $this->redirect($this->generateUrl('default', array('module' => 'profesores',
                'action' => 'resolucionfacultad', 'msgError' => $estado )));
            }

        } else {
                 $estado='Debe seleccionar una resolución para realizar esta operación';
                 $this->redirect($this->generateUrl('default', array('module' => 'profesores',
                'action' => 'resolucionfacultad', 'msgError' => $estado )));
        } // end if
     
  }


  public function executeListasabana(sfWebRequest $request)
  {
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
     
      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
     // Obtener facultad relacionada al area // debe ser una facultad
      foreach($facultades as $facultad){
          if ($idfacultad==''){
            $idfacultad= $facultad['idfacultad'];
            $nombrefacultad = $facultad['nombre'];
          } 
      } 

      // solo usuarios de sede central pueden elevar designaciones
      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para imprimir este listado!!';
          $this->resultado ='';
      }
     
      // Obtener Sedes
      $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();

      
      $this->idsede = $idsede;
     
  }

  public function executeConsultarobservaciones(sfWebRequest $request)
  {
      // solo usuarios de sede central pueden elevar designaciones
      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para imprimir este listado!!';
          $this->resultado ='';
      }

      $this->facultades = Doctrine_Core::getTable('Facultades')->findAll();
     
      // Obtener Sedes
      $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();

      $this->idsede = $request->getParameter('idsede');
      $this->idfacultad = $request->getParameter('idfacultad');
      $this->anioseleccionado = $request->getParameter('idanio');

     // Obtener observaciones
      if ($request->getParameter('idfacultad'))
           $this->resultado = Doctrine_Core::getTable('LogEventosDesignaciones')->obtenerObservacionesPorFacultadSedePeriodo($request->getParameter('idfacultad'), $request->getParameter('idsede'), $request->getParameter('idanio'));
    
     
  }

  public function executeObtenerlistasabana(sfWebRequest $request)
  {
      

      // Parametros obligatorios
      $idsede = ''; $idfacultad=''; $nombrefacultad = ''; $anio ='';
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $this->msgSuccess = $request->getParameter('msgSuccess', '');
      $this->msgError = $request->getParameter('msgError', '');
      $estadodesignacion = 1; // estado inicial de la designacion (el unico que se puede elevar)

      // Obtener parametros para filtrar informacion
      $anioseleccionado = $request->getParameter('idanio');
      $idsede = $request->getParameter('idsede');

      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
     // Obtener facultad relacionada al area // debe ser una facultad
      foreach($facultades as $facultad){
          if ($idfacultad==''){
            $idfacultad= $facultad['idfacultad'];
            $nombrefacultad = $facultad['nombre'];
          } 
      } 

      // solo usuarios de sede central pueden elevar designaciones
      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para imprimir este listado!!';
          $this->resultado ='';
      }
     
      // Obtener Sedes
      $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();

      if ($idsede<>'')
         $this->resultado = Doctrine_Core::getTable('Designaciones')->listaSabana($idsede, $idfacultad, $anioseleccionado);
      
      $this->idsede = $idsede;
      $this->anioseleccionado = $anioseleccionado;
      $this->permite_seleccionar = $request->getParameter('permite_seleccionar');

  }

  public function executeImprimirlistasabana(sfWebRequest $request)
  {
  
     // Parametros obligatorios
      $idsede = ''; $idfacultad=''; $nombrefacultad = ''; $anio ='';
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $this->msgSuccess = $request->getParameter('msgSuccess', '');
      $this->msgError = $request->getParameter('msgError', '');
      $estadodesignacion = 1; // estado inicial de la designacion (el unico que se puede elevar)

      // Obtener parametros para filtrar informacion
      $anioseleccionado = $request->getParameter('idanio');
      $idsede = $request->getParameter('idsede');

      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
     // Obtener facultad relacionada al area // debe ser una facultad
      foreach($facultades as $facultad){
          if ($idfacultad==''){
            $idfacultad= $facultad['idfacultad'];
            $nombrefacultad = $facultad['nombre'];
          } 
      } 

      // solo usuarios de sede central pueden elevar designaciones
      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para imprimir este listado!!';
          $this->resultado ='';
      }

      $this->resultado = Doctrine_Core::getTable('Designaciones')->listaSabana($idsede, $idfacultad, $anioseleccionado);
      
      // Obtener Sedes
      $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();

      // SI idformato es 2, imprime CSV 
      if ($request->getParameter('idformato')==2){ 

          if ($idsede<>''){
             
            $file = 'listado-sabana.csv';
            $fh = fopen($file,"w+") or die ("unable to open file");

            $row = "SEDE,CARRERA,APELLIDO, NOMBRE,TIPO DOCUMENTO,NUMERO DOC,MATERIA,TIPO DESIGNACION,CATEGORIA,IDCATEGORIA,RESOLUCION,ESTADO DESIGNACION,AÑO DE CURSADA,HORAS,TIPO,AD HONOREM,LICENCIA,DEDICACION,INICIO,FIN".","."\n";
            fwrite($fh,$row);

            foreach($this->resultado as $registro) {
            
                $row = $registro['sedeabreviada'].",".$registro['carreraplan'].",".$registro['apellido'].",".$registro['nombre'].",".$registro['tipodocumento'].",".$registro['numerodoc'].",".$registro['materia'].",".$registro['tipodesignacion'].",".$registro['categoria'].",".$registro['idcategoriadesignacion'].",".$registro['resolucion'].",".$registro['estadodesignacion'].",".$registro['anodecursada'].",".$registro['horas'].",".$registro['tipo'].",".$registro['adhonorem'].",".$registro['licencia'].",".$registro['dedicacion'].",".$registro['inicioformat'].",".$registro['finformat'].","."\n";
            
                fwrite($fh,$row);
          
            }

            fclose($fh);

          }
          
          $this->idsede = $idsede;
          $this->anioseleccionado = $anioseleccionado;
          
          header("Content-Type: application/vnd.ms-excel");
          header("Content-Type: application/force-download");
          header("Content-Transfer-Encoding: binary");
          header("Content-Disposition: attachment;filename=".$file );
          header("Content-Length: ".filesize($file));
          header("Pragma: no-cache");
          header("Expires: 0");
          readfile($file);
      
          return sfView::NONE;
      }

      // SI idformato es 1, imprime PDF
      if ($request->getParameter('idformato')==1){
         
          // Crea una instancia de la clase de FPDF
          $config = sfTCPDFPluginConfigHandler::loadConfig();
    
          // pdf object
          $pdf = new profPDF('L');

          // set document information
          $pdf->SetCreator(PDF_CREATOR);
          $pdf->SetAuthor('Diego Sposito');
          $pdf->SetTitle('Listado Designaciones');
          $pdf->SetSubject('Listado Designaciones');
          $pdf->SetKeywords('TCPDF, PDF, Listado, Listado, listado');

          // set default header data
          $pdf->SetHeaderData('CabeceraSIG-UCU.jpg', '170', '', '');

          // set header and footer fonts
          $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
          $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

          // set default monospaced font
          $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

          //set margins
          $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
          $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

          //set auto page breaks
          $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

          //set image scale factor
          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

          $pdf->setFontSubsetting(true);
          $pdf->SetFont("Times", "", 9);

          $pdf->AddPage();

          $idcarrera=''; // flag para saber si la carrera cambio, lo cual genera reimprimir el encabezado de la tabla

          $html2='<br><table border="1">';
                

          if ($idsede<>''){
                
                foreach($this->resultado as $registro) {
                       
                       // Si es nueva carrera , imprime encabezado de tabla
                       if ($registro['idcarrera']<> $idcarrera) {
                            
                            $html2 .='<tr><td width="3020" colspan="8"></td></tr>';
                            $html2 .='<tr><td width="3020" colspan="8"><b>Docentes de la Carrera : '.$registro['carrera'].' de la '.$registro['facultad'].'</b></td></tr>';
                            $html2 .='<tr><td width="3020" colspan="8"><b>Universidad de Concepción del Uruguay  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Ciclo : '.$registro['ciclolectivo'].'</b></td></tr>';
                            $html2 .='<tr>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="600" height="30" ><b>Profesor </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="100" height="30"><b>Tipo </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="200" height="30"><b>Nro. Doc. </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="800" height="30"><b>Asignatura </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="200" height="30"><b>Categoría </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="100" height="30"><b>Año </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="600" height="30"><b>Carrera </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="80" height="30"><b>Hs. </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="340" height="30"><b>Resolucion </b></td>';
                            $html2 .='</tr>';

                       }

                       $idcarrera = $registro['idcarrera'];
                      
                      // imprimir contenido de la tabla
                       $html2 .='<tr>';
                       $html2 .='<td width="600" height="30">'. $registro['persona'].' </td>';
                       $html2 .='<td align="center" width="100" height="30">'. $registro['tipodocumento'].' </td>';
                       $html2 .='<td width="200" height="30">'. $registro['numerodoc'].' </td>';
                       $html2 .='<td width="800" height="30">'. $registro['materia'].' </td>';
                       $html2 .='<td width="200" height="30">'. $registro['categoria'].' </td>';
                       $html2 .='<td align="center" width="100" height="30">'. $registro['anodecursada'].' </td>';
                       $html2 .='<td width="600" height="30">'. $registro['carrera'].' </td>';
                       $html2 .='<td align="center" width="80" height="30">'. $registro['horas'].' </td>';
                       $html2 .='<td width="340" height="30">'. $registro['resolucion'].' </td>';
                       $html2 .='</tr>';
                  
                

                } // endforeach

                $html2 .='</table><br/><br/>';

          } // endif

          $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html.$html2, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
          $pdf->Output('designaciones.pdf', 'I');

          // Stop symfony process
          throw new sfStopException();
          
          return sfView::NONE;

      } // end if ($request->getParameter('idformato')==1)
  
  }

  public function executeNuevasdesignaciones(sfWebRequest $request)
  {
      $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      $this->sedes='';

      if (sfContext::getInstance()->getUser()->hasCredential('adminProfesores')) 
          $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();
      else
         // $this->sedes = Doctrine_Core::getTable('Sedes')->find($idsede);  
        $this->sedes = array(Doctrine_Core::getTable('Sedes')->find($idsede)); 
     
      $this->idsede = $idsede;
     
  }

  public function executeObtenernuevasdesignaciones(sfWebRequest $request)
  {
      
      $this->msgSuccess = $request->getParameter('msgSuccess', '');
      $this->msgError = $request->getParameter('msgError', '');
      $idarea='';
     
      // Obtener parametros para filtrar informacion
      $this->anioseleccionado = $request->getParameter('idanio');
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      $this->idsede = $request->getParameter('idsede');
      $this->sedes='';

      // Nunca deberia pasar, siempre se elige una sede en la vista, pero para evitar errores pongo sede por defecto
      if ($this->idsede=='')
         $this->idsede=1;

      if (sfContext::getInstance()->getUser()->hasCredential('adminProfesores')){ 
          $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();
          $idarea='';
      }    
      else {
          $this->sedes = array(Doctrine_Core::getTable('Sedes')->find($this->idsede));
      }     
     
      // Obtener informacion de Designaciones Nuevas
      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerNuevasDesignaciones($this->idsede, $this->anioseleccionado, $idarea);
      
  }

  public function executeImprimirnuevasdesignaciones(sfWebRequest $request)
  {
  
      $this->msgSuccess = $request->getParameter('msgSuccess', '');
      $this->msgError = $request->getParameter('msgError', '');
      
      // Obtener parametros para filtrar informacion
      $this->anioseleccionado = $request->getParameter('idanio');
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

      $this->idsede = $request->getParameter('idsede');
      $this->sedes='';

      // Nunca deberia pasar, siempre se elige una sede en la vista, pero para evitar errores pongo sede por defecto
      if ($this->idsede=='')
         $this->idsede=1;

      if (sfContext::getInstance()->getUser()->hasCredential('adminProfesores')) 
          $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();
      else
          $this->sedes = array(Doctrine_Core::getTable('Sedes')->find($this->idsede)); 
     
      // Obtener informacion de Designaciones Nuevas
      $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerNuevasDesignaciones($this->idsede, $this->anioseleccionado, $idarea);
      

      // SI idformato es 2, imprime CSV 
      if ($request->getParameter('idformato')==2){ 

          if ($this->idsede<>''){
             
            $file = 'listado-nuevas-designaciones.csv';
            $fh = fopen($file,"w+") or die ("unable to open file");

            $row = "SEDE,CARRERA,APELLIDO, NOMBRE,TIPO DOCUMENTO,NUMERO DOC,MATERIA,TIPO DESIGNACION,CATEGORIA,IDCATEGORIA,ESTADO DESIGNACION,AÑO DE CURSADA,HORAS,TIPO,AD HONOREM,LICENCIA,DEDICACION,INICIO,FIN".","."\n";
            fwrite($fh,$row);

            foreach($this->resultado as $registro) {
            
                $row = $registro['sedeabreviada'].",".$registro['carreraplan'].",".$registro['apellido'].",".$registro['nombre'].",".$registro['tipodocumento'].",".$registro['numerodoc'].",".$registro['materia'].",".$registro['tipodesignacion'].",".$registro['categoria'].",".$registro['idcategoriadesignacion'].",".$registro['estadodesignacion'].",".$registro['anodecursada'].",".$registro['horas'].",".$registro['tipo'].",".$registro['adhonorem'].",".$registro['licencia'].",".$registro['dedicacion'].",".$registro['inicioformat'].",".$registro['finformat'].","."\n";
            
                fwrite($fh,$row);
          
            }

            fclose($fh);

          }
          
          header("Content-Type: application/vnd.ms-excel");
          header("Content-Type: application/force-download");
          header("Content-Transfer-Encoding: binary");
          header("Content-Disposition: attachment;filename=".$file );
          header("Content-Length: ".filesize($file));
          header("Pragma: no-cache");
          header("Expires: 0");
          readfile($file);
      
          return sfView::NONE;
      }

      // SI idformato es 1, imprime PDF
      if ($request->getParameter('idformato')==1){
         
          // Crea una instancia de la clase de FPDF
          $config = sfTCPDFPluginConfigHandler::loadConfig();
    
          // pdf object
          $pdf = new profPDF('L');

          // set document information
          $pdf->SetCreator(PDF_CREATOR);
          $pdf->SetAuthor('Diego Sposito');
          $pdf->SetTitle('Listado Designaciones');
          $pdf->SetSubject('Listado Designaciones');
          $pdf->SetKeywords('TCPDF, PDF, Listado, Listado, listado');

          // set default header data
          $pdf->SetHeaderData('CabeceraSIG-UCU.jpg', '170', '', '');

          // set header and footer fonts
          $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
          $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

          // set default monospaced font
          $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

          //set margins
          $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+5, PDF_MARGIN_RIGHT);
          $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

          //set auto page breaks
          $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

          //set image scale factor
          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

          $pdf->setFontSubsetting(true);
          $pdf->SetFont("Times", "", 10);

          $pdf->AddPage();

          $idcarrera=''; // flag para saber si la carrera cambio, lo cual genera reimprimir el encabezado de la tabla

          $html2='<br><table border="1">';
                

          if ($this->idsede<>''){
                
                foreach($this->resultado as $registro) {
                       
                       // Si es nueva carrera , imprime encabezado de tabla
                       if ($registro['idcarrera']<> $idcarrera) {
                            
                            $html2 .='<tr><td width="3020" colspan="8"></td></tr>';
                            $html2 .='<tr><td width="3020" colspan="8"><b>Docentes de la Carrera : '.$registro['carrera'].' de la '.$registro['facultad'].'</b></td></tr>';
                            $html2 .='<tr><td width="3020" colspan="8"><b>Universidad de Concepción del Uruguay  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Ciclo : '.$registro['ciclolectivo'].'</b></td></tr>';
                            $html2 .='<tr>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="700" height="30" ><b>Profesor </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="100" height="30"><b>Tipo </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="200" height="30"><b>Nro. Doc. </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="900" height="30"><b>Asignatura </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="300" height="30"><b>Categoría </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="100" height="30"><b>Año </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="600" height="30"><b>Carrera </b></td>';
                            $html2 .='<td align="center" bgcolor="#BDBDBD" width="120" height="30"><b>Horas </b></td>';
                            $html2 .='</tr>';

                       }

                       $idcarrera = $registro['idcarrera'];
                      
                      // imprimir contenido de la tabla
                       $html2 .='<tr>';
                       $html2 .='<td width="700" height="30">'. $registro['persona'].' </td>';
                       $html2 .='<td width="100" height="30">'. $registro['tipodocumento'].' </td>';
                       $html2 .='<td width="200" height="30">'. $registro['numerodoc'].' </td>';
                       $html2 .='<td width="900" height="30">'. $registro['materia'].' </td>';
                       $html2 .='<td width="300" height="30">'. $registro['categoria'].' </td>';
                       $html2 .='<td width="100" height="30">'. $registro['anodecursada'].' </td>';
                       $html2 .='<td width="600" height="30">'. $registro['carrera'].' </td>';
                       $html2 .='<td width="120" height="30">'. $registro['horas'].' </td>';
                       $html2 .='</tr>';
                  
                

                } // endforeach

                $html2 .='</table><br/><br/>';

          } // endif

          $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html.$html2, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
          $pdf->Output('designaciones.pdf', 'I');

          // Stop symfony process
          throw new sfStopException();
          
          return sfView::NONE;

      } // end if ($request->getParameter('idformato')==1)
  
  }

  public function executeConfirmarelevacion(sfWebRequest $request)
  {
      // Parametros obligatorios
      $idsede = ''; $idfacultad='';
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $estadodesignacion = 1; // estado inicial de la designacion (el unico que se puede elevar)

      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
      foreach($facultades as $facultad){
      
          if ($idfacultad=='')
            $idfacultad= $facultad['idfacultad'];

      } 

       // Parametros para envio de email
      $otro ='';
      $oFacultad = Doctrine_Core::getTable('Facultades')->find($idfacultad);
      $oSede = Doctrine_Core::getTable('Sedes')->find(sfContext::getInstance()->getUser()->getAttribute('id_sede',''));
      $estado = 'Las designaciones de '.$oSede->getNombre().' - '.$oFacultad->getNombre().' fueron elevadas correctamente.';

      $idarea='';
      
      $arrDesignaciones = array();

      //$this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idarea, $idsede, $idfacultad, $idplanestudio, $idpersona, $idcategoriadesignacion, $idtipodesignacion, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion);
      $resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($idsede, $idarea, $idfacultad, $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion);
      
      foreach ($resultado as $datos) {
        $arrDesignaciones[] = $datos['iddesignacion'];
      }

      if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){ // reseteo arreglo de designaciones
          $arrDesignaciones = array();
      }
      
      if (count($arrDesignaciones)>0){

          // ELEVAR DESIGNACIONES
          Doctrine_Core::getTable('Designaciones')->elevarDesignaciones($arrDesignaciones); 

          // Preparar envio de email
          $parametro = 'app_profesores_csuadmin';
          $destinatario = sfConfig::get($parametro);   
          //$destinatario = 'juanvelazquez@ucu.edu.ar';

          // Remitente
          $remitente = 'sistemas@ucu.edu.ar';  

          $msj = '
          Informacion sobre la elevación de designaciones de la Sede : '.$oSede->getNombre().'
          Facultad: '.$oFacultad->getNombre().' 
          Estado: '.$estado.'
          E-mail remitente: '.$remitente.'  
          '.$otro;

      
          $mensajeEmail = '
          **************************************************************************************
          **************************************************************************************
          '.$msj.'
          **************************************************************************************
          **************************************************************************************';
          
          $destino = array(
             $destinatario,
            'dsposito@ucu.edu.ar',
          );
          
          // Enviar email
          $resultado = $this->getMailer()->composeAndSend(
            $remitente,
            $destino,
            $estado,
            $mensajeEmail
          );  
      }
          
      if (count($arrDesignaciones)>0){
         $this->redirect($this->generateUrl('default', array('module' => 'profesores',
         'action' => 'elevardesignaciones', 'msgSuccess' => 'Designaciones elevadas correctamente!!' )));
      } else
      {
        $this->redirect($this->generateUrl('default', array('module' => 'profesores',
        'action' => 'elevardesignaciones', 'msgError' => 'No hay designaciones habilitadas para elevar!!' )));
      }
  }

  public function executeObtenerdesignaciones(sfWebRequest $request)
  {
      $idprofesor ='';
      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
    if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }

      $this->activo = $request->getParameter('activo');
      
      if ($request->getParameter('idsede') > 0)
          $this->resultado = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($request->getParameter('idsede'), $request->getParameter('idfacultad'), $request->getParameter('idplanestudio'), $idprofesor, $fechadesde, $fechahasta, $this->activo, $request->getParameter('idresolucion'));
      else
          $this->resultado = 'La sede es obligatoria';

  }  

  public function executeActualizarEstadoDesignaciones(sfWebRequest $request)
  {
    
    $msg = 'No se actualizaron designaciones.';
    $success=0;
   
    // SI se seleecionaron designaciones para aprobar, las apruebo
    if ( count($request->getParameter('idcase'))>0 ){

        $contar = Doctrine_Core::getTable('Designaciones')->contarDesignacionesSinActualizar($request->getParameter('idcase'));
        
        $resultado = Doctrine_Core::getTable('Designaciones')->activarDesignaciones($request->getParameter('idcase')); 
        
        // Si hay designaciones que no pueden ser actualizadas, se informa
        if ($contar > 0){
            $msg = 'Las designaciones fueron actualizadas correctamente.';
            $success=1;
        }
           
    }

    $this->redirect($this->generateUrl('default', array('module' => 'profesores',
      'action' => 'aprobardesignaciones', 'msg' => $msg, 'success' => $success )));

  }

  public function executeTestemail()
  {
    
      $estado = 'Las designaciones del periodo actual fueron observadas o vueltas a su estado inicial.';
    
      // Envio de email para informar sobre operacion realizada
      $parametro = 'app_profesores_sedefacultad'.'1'.'3';

      $destinatario = sfConfig::get($parametro);

      $otro='';

      //$destinatario = array($email => 'Informe de Designaciones Periodo Actual');
    
      // Remitente
      $remitente = 'dsposito@ucu.edu.ar';  

      // Grabar informacion en log
      $oLogDesignaciones = new LogEventosDesignaciones();
      $oLogDesignaciones->setSede('test');
      $oLogDesignaciones->setFacultad('test');
      $oLogDesignaciones->setEstado($estado);
      $oLogDesignaciones->setObservaciones('test');
      $oLogDesignaciones->setOrigen($remitente);
      $oLogDesignaciones->setDestinatario($destinatario);
                
      $oLogDesignaciones->save();  

      $msj = '
      Informacion sobre el resultado del analisis de designaciones de la Sede : '.'sede'.' 
      Facultad : '.'test'.'.
      Estado: '.$estado.'
      Observaciones: '.'test'.'
      E-mail remitente: '.$remitente.'  
      '.$otro;

  
      $mensajeEmail = '
      **************************************************************************************
      **************************************************************************************
      '.$msj.'
      **************************************************************************************
      **************************************************************************************';
      
      $destino = array(
         $destinatario,
        'dsposito@ucu.edu.ar',
      );

      $resultado = $this->getMailer()->composeAndSend(
        $remitente,
        $destino,
        'Informe de análisis de designaciones de Profesores del período actual ',
        $mensajeEmail
      );  
  }

  public function executeAceptarcancelardesignaciones(sfWebRequest $request)
  {
    
    // Parametros opcionales
      $fechadesde=''; $fechahasta=''; $idarea=''; $nuevoestado='';
      $idpersona='';  $idresolucion=''; $estado ='';
      $idcategoriadesignacion ='';$idtipodesignacion=''; $arr_casos = array();
      $this->msgSuccess=''; $this->msgError=''; $otro ='';

      $estado = 'Visacion no se realizo correctamente.';
      
      $estadodesignacion='2';

      $oFacultad = Doctrine_Core::getTable('Facultades')->find($request->getParameter('idfacultad'));
      $oSede = Doctrine_Core::getTable('Sedes')->find($request->getParameter('idsede'));
     
      // Obtiene designaciones seleccionadas en la vista en un array
      $idcase = $request->getParameter('idcase', '');

      foreach($idcase as $seleccionados){
        if(is_numeric($seleccionados)) 
          $arr_casos[] = $seleccionados;
      }
     
      // Valor 1: Aceptar designaciones    Valor 2 : No aceptar designaciones
      $operacion = $request->getParameter('idoperacion', '');

       // Si operacion es Aceptar (1) se graba estado 4 (Visada), sino se graba estado 1 (Inicial) o 2 (Observada)
      $nuevoestado = ($operacion=='1') ? 4 : 1; 
      $this->msgSuccess = ($operacion=='1') ? 'Las designaciones fueron visadas correctamente.' : 'Las designaciones volvieron a estado inicial u observadas.'; 

      if ($request->getParameter('fechadesde')<>''){
        $arr = explode('-', $request->getParameter('fechadesde'));
        $fechadesde = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      if ($request->getParameter('fechahasta')<>''){
        $arr = explode('-', $request->getParameter('fechahasta'));
        $fechahasta = $arr[2]."-".$arr[1]."-".$arr[0];
      }
      
      // Obtener designaciones a cambiar estado
      $designaciones = Doctrine_Core::getTable('Designaciones')->obtenerDesignacionesAplicandoFiltros($request->getParameter('idsede', ''), $idarea, $request->getParameter('idfacultad', ''), $idplanestudio, $idpersona, $fechadesde, $fechahasta, $estadodesignacion, $idresolucion, $idcategoriadesignacion, $idtipodesignacion);
      $arrDesignaciones = array();

      foreach($designaciones as $des){
          $arrDesignaciones[] = $des['iddesignacion'];
      }


      // Si existen designaciones para Visar / Observar
      if ( count($arrDesignaciones)>0 ){
         
          $resultado = Doctrine_Core::getTable('Designaciones')->cambiarestadoDesignaciones($arrDesignaciones, $nuevoestado);
          $estado = 'Las designaciones del periodo actual fueron visadas correctamente.';
          $this->msgSuccess = $estado;

        // designaciones seleccionadas para observar, se actualizan a estado 3
        if ($operacion=='2' && count($arr_casos)>0){
          $resultado = Doctrine_Core::getTable('Designaciones')->cambiarestadoDesignaciones($arr_casos, 3);
          $estado = 'Las designaciones del periodo actual fueron observadas o vueltas a su estado inicial.';
          $this->msgError = $estado;
          $this->msgSuccess = '';
        }
            
      } else {
         $this->msgError='No hay designaciones seleccionadas para cambiar estado';
         $this->msgSuccess = '';
      }

      // Envio de email para informar sobre operacion realizada
      $parametro = 'app_profesores_sedefacultad'.$oSede->getIdSede().$oFacultad->getIdFacultad();

      $destinatario = sfConfig::get($parametro);

      //$destinatario = array($email => 'Informe de Designaciones Periodo Actual');
    
      // Remitente
     // $remitente = 'juanvelazquez@ucu.edu.ar'; 
      $parametro = 'app_profesores_csuadmin';
      $remitente = sfConfig::get($parametro);  

      // Grabar informacion en log
      $oLogDesignaciones = new LogEventosDesignaciones();
      $oLogDesignaciones->setSede($oSede->getNombre());
      $oLogDesignaciones->setFacultad($oFacultad->getNombre());
      $oLogDesignaciones->setEstado($estado);
      $oLogDesignaciones->setObservaciones($request->getParameter('observaciones'));
      $oLogDesignaciones->setOrigen($remitente);
      $oLogDesignaciones->setDestinatario($destinatario);
      $oLogDesignaciones->setIdsede($request->getParameter('idsede'));
      $oLogDesignaciones->setIdfacultad($request->getParameter('idfacultad'));
                
      $oLogDesignaciones->save();  

      $msj = '
      Informacion sobre el resultado del analisis de designaciones de la Sede : '.$oSede->getNombre().' 
      Facultad : '.$oFacultad->getNombre().'.
      Estado: '.$estado.'
      Observaciones: '.$request->getParameter('observaciones').'
      E-mail remitente: '.$remitente.'  
      '.$otro;

  
      $mensajeEmail = '
      **************************************************************************************
      **************************************************************************************
      '.$msj.'
      **************************************************************************************
      **************************************************************************************';
      
      $destino = array(
         $destinatario,
        'dsposito@ucu.edu.ar',
      );

      $resultado = $this->getMailer()->composeAndSend(
        $remitente,
        $destino,
        'Informe de análisis de designaciones de Profesores del período actual ',
        $mensajeEmail
      );  
  }


  public function executeObtenerresolucionesxfacultad(sfWebRequest $request)
  {
    $this->resoluciones_profesores = Doctrine_Core::getTable('ResolucionesProfesores')->obtenerResolucionesAcademicasxSedeFacultad($request->getParameter('idsede'), $request->getParameter('idfacultad'));
  }

  public function executeObtenerprofesoresxfacultad(sfWebRequest $request)
  {
    $this->profesores = Doctrine_Core::getTable('Profesores')->obtenerProfesoresPorFacultad($request->getParameter('idfacultad'));
  }

}
