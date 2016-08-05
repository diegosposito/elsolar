<?php

/**
 * personas actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfDoctrinePager('Personas', sfConfig::get('app_pagination_cantidad'));
    $this->pager->setQuery(Doctrine::getTable('Personas')->createQuery('a')->orderBy('apellido'));
 
    $this->pager->setPage($this->getRequestParameter('page',1));
    $this->pager->init();
  }

  // Obtiene los estudios previos de la persona
  public function executeObtenerestudiosprevios(sfWebRequest $request)  {
    $persona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
    // Obtiene los estudios previos de la persona         
    $this->estudiosprevios = $persona->getEstudiosPrevios(); 

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
      $oEstudio->setFormaciondocente($request->getParameter('formaciondocente'));
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
      $resultado['formaciondocente'] = $oEstudio->getFormaciondocente() ? "Checked" : false;   
      
      echo json_encode($resultado);
  
      return sfView::NONE;
    }

  public function executeList(sfWebRequest $request)
  {
   
   /* $this->createQuery('p')
     ->innerJoin('p.Faces f')
     ->addSelect('p.*, FIELD(f.datafile_rowno, ' . $rownoStr . ') as order_pos')
     ->whereIn('f.datafile_rowno', $rownos)
     ->orderBy('order_pos');*/

    $this->pager = new sfDoctrinePager('Personas', sfConfig::get('app_pagination_cantidad'));
    $this->pager->setQuery(Doctrine::getTable('Personas')->createQuery('a')->orderBy('apellido'));
 
    // If you have filers in the to apply in the db query add the following code 
    //$this->pager->getQuery()->from('Myclass a')->where('a.column_name LIKE ?' , '%'.$searchString.'%');
 
    $this->pager->setPage($this->getRequestParameter('page',1));
    $this->pager->init();
 
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona')));
    $this->forward404Unless($this->personas);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PersonasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new PersonasForm();

    // VALIDAR DOCUMENTO
    //===========================================================================
    $post = $request->getParameter($this->form->getName());
    $oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($post['idtipodoc']);        
    $formato = $oTipoDocumento->getFormato(); 
    $nrodoc = preg_replace("/[^\d]/", "", $post['nrodoc']);
    
    if (!preg_match($formato, $post['numerodoc'])) 
       return $this->forward404('Formato de documento no valido Ejemplo para DNI 22.456.333'); 
    
    // CONTROLAR QUE EL NRODOC NO EXISTA PREVIAMENTE
    //===================================================
    $oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($post['idtipodoc'],$nrodoc);
    //$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($post['idtipodoc'], $post['nrodoc']);
    
    if($oPersona)
       return $this->forward404('La persona ya existe en el sistema, verifique la operacion..'); 
    
    // GRABAR VIA WS EN SISTEMA ALUMNOS ANTERIOR
    //===========================================
    /*$soapclient = new nusoap_client(sfConfig::get('app_wstestini_nuevaspersonas'));
    $soapclient->setCredentials("root", "sistemas2009");

    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarpersona',
        array('idpersona' => null,
        'nombre' => ucwords(strtolower($post['nombre'])), 
        'apellido' => strtoupper($post['apellido']), 
        'sexo' => $post['idsexo'], 
        'idtipodoc' => $post['idtipodoc'],
        'nrodoc' => $nrodoc,      
        'fechanac' => $post['fechanac']['year']."-".$post['fechanac']['month']."-".$post['fechanac']['day'],
        'fechaingreso' => $post['fechaingreso']['year']."-".$post['fechaingreso']['month']."-".$post['fechaingreso']['day'],
        'idciudadnac' => $post['idciudadnac'], 
        'idnacionalidad' => $post['idnacionalidad'],
        'estadocivil' => $post['estadocivil'],
        'vive' => 1)
    );

    $this->persona = unserialize(base64_decode($resultadoSoap));  */  
    
   // if($this->persona['idPersona']>0){
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    //} else {
    //    return $this->forward404('La persona no pudo ser ingresada, reintente la operacion..'); 
    //} 

  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona'))), sprintf('Object personas does not exist (%s).', $request->getParameter('idpersona')));
    $this->form = new PersonasForm($personas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona'))), sprintf('Object personas does not exist (%s).', $request->getParameter('idpersona')));
    $this->form = new PersonasForm($personas);
    

      
    // VALIDAR DOCUMENTO
    //===========================================================================
    $oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($personas->getIdtipodoc());        
    $formato = $oTipoDocumento->getFormato(); 
    $post = $request->getParameter($this->form->getName());
    if (!preg_match($formato, $post['numerodoc'])) 
       return $this->forward404('Formato de documento no valido Ejemplo para DNI 22.456.333'); 
    
    $nrodoc = preg_replace("/[^\d]/", "", $post['nrodoc']);

    // GRABAR VIA WS EN SISTEMA ALUMNOS ANTERIOR
    //===========================================
   /* $soapclient = new nusoap_client(sfConfig::get('app_wstestini_nuevaspersonas'));
    $soapclient->setCredentials("root", "sistemas2009");

    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarpersona',
        array('idpersona' => $request->getParameter('idpersona'),
        'nombre' => ucwords(strtolower($post['nombre'])), 
        'apellido' => strtoupper($post['apellido']), 
        'sexo' => $post['idsexo'], 
        'idtipodoc' => $post['idtipodoc'],
        'nrodoc' => $nrodoc,      
        'fechanac' => $post['fechanac']['year']."-".$post['fechanac']['month']."-".$post['fechanac']['day'],
        'fechaingreso' => $post['fechaingreso']['year']."-".$post['fechaingreso']['month']."-".$post['fechaingreso']['day'],
        'idciudadnac' => $post['idciudadnac'], 
        'idnacionalidad' => $post['idnacionalidad'],
        'estadocivil' => $post['estadocivil'],
        'vive' => 1)
    );

    $this->persona = unserialize(base64_decode($resultadoSoap));   */
   
   // if($this->persona['idPersona']>0){
    
      // PROCESAR TEMPLATE
       $this->processForm($request, $this->form);

       $this->setTemplate('edit'); 

   // } else {
       
     //  return $this->forward404('La persona no pudo ser ingresada, reintente la operacion..'); 
   // }   
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona'))), sprintf('Object personas does not exist (%s).', $request->getParameter('idpersona')));
    $personas->delete();

    $this->redirect('personas/index');
  }

  public function executeBuscar(sfWebRequest $request)
  {
    $this->form = new BuscarProfesoresForm(array(
      'url' => $this->url,
      'titulo' => $this->titulo,
      'tipo' => $this->tipo,        
      'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
    )); 

    $this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

    $this->post = $request->isMethod('post');

    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter($this->form->getName()));

      if ($this->form->isValid()) {
            $arreglo = $request->getParameter($this->form->getName());
        
            $this->tipocriterio = $arreglo['tipocriterio'];
            $this->criterio = $arreglo['criterio'];
            $this->titulo = $arreglo['titulo'];
            $this->tipo = $arreglo['tipo'];
          
            if ($this->tipocriterio=='1' &&  strlen($this->criterio)<3){
                $this->msjErr = 'La cadena a buscar debe tener por lo menos 3 caracteres';
                $this->resultado = array();
            } else {
                $this->resultado = Doctrine_Core::getTable('Profesores')->buscarProfesores($this->tipocriterio, $this->criterio, sfContext::getInstance()->getUser()->getAttribute('id_area',''));     
            }
            
      }
    } else {
      $this->resultado = array();
    }
  }

  public function executeVerfacultades(sfWebRequest $request)
  {
   
    // Parametros obligatorios
    $this->idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
    $this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');

    if (Encriptar::decrypt($request->getParameter('action_decrypt', ''), "!@#$%^&*")=='decrypt')
      $this->idpersona = Encriptar::decrypt($request->getParameter('idpersona', ''), "!@#$%^&*");   
    else
      $this->idpersona = $request->getParameter('idpersona', '');
        
    $this->oPersona = Doctrine_Core::getTable('Personas')->find($this->idpersona);

    $this->facultades = Doctrine_Core::getTable('Profesores')->obtenerFacultadesAAsignar($this->idpersona, $this->idarea );
  
  }

  public function executeAgregarprofesor(sfWebRequest $request)
  {
     if ( $request->getParameter('idpersona')<>'' && $request->getParameter('idpersona')>='0' &&
           //$request->getParameter('legajo')<>'' && $request->getParameter('legajo')>'0' &&
           $request->getParameter('idfacultad')<>'' && $request->getParameter('idfacultad')>'0' ){
       
          $oProfesor = new Profesores();
          $oProfesor->setIdpersona($request->getParameter('idpersona'));
          $oProfesor->setIdpersona($request->getParameter('idpersona'));
          $oProfesor->setIdfacultad($request->getParameter('idfacultad'));
          $oProfesor->setLegajo($request->getParameter('legajo'));
          
          $oProfesor->save();

          $oPersona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));

    }

     // Redireccionar
      $this->redirect($this->generateUrl('default', array('module' => 'personas',
      'action' => 'asociar', 'msg' => $oPersona->getApellido().', '.$oPersona->getNombre(). ' fue agregado correctamente como profesor.' )));
      
  }

  public function executeAsociar(sfWebRequest $request)
  {
    $this->form = new BuscarProfesoresForm(array(
      'url' => $this->url,
      'titulo' => $this->titulo,
      'tipo' => $this->tipo,        
      'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
    )); 

    $this->msg = $request->getParameter('msg');

    $this->post = $request->isMethod('post');

    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter($this->form->getName()));

      if ($this->form->isValid()) {
            $arreglo = $request->getParameter($this->form->getName());
        
            $this->tipocriterio = $arreglo['tipocriterio'];
            $this->criterio = $arreglo['criterio'];
            $this->titulo = $arreglo['titulo'];
            $this->tipo = $arreglo['tipo'];
          
            $this->resultado = Doctrine_Core::getTable('Profesores')->buscarPosibleProfesores($this->tipocriterio, $this->criterio);     
            
      }
    } else {
      $this->resultado = array();
    }
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $personas = $form->save();

      $nrodoc = preg_replace("/[^\d]/", "", $personas->getNrodoc());  
      $personas->setNrodoc($nrodoc);
      $personas->setNombre(ucwords(strtolower($personas->getNombre())));
      $personas->setApellido(strtoupper($personas->getApellido()));
      $personas->save();

      $this->redirect('personas/edit?idpersona='.$personas->getIdpersona());
    }
  }
}
