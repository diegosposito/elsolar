<?php

/**
 * egresados actions.
 *
 * @package    sig
 * @subpackage egresados
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class egresadosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeBuscaralumnos(sfWebRequest $request) {
	
  }
  
  // 9 Planilla de Aspirantes (Excel)
  public function executeListadoegresadoscsv(sfWebRequest $request)
  {

  	// Busco los egresados por sede
  	$this->alumnos = Doctrine_Core::getTable('Alumnos')->buscarEgresadosFiltrados($request->getParameter('idfacultad'), $request->getParameter('idsede'), $request->getParameter('idplanestudio'), $request->getParameter('ordencampo'), $request->getParameter('ordenmetodo'), $request->getParameter('idestado'));
  
  	// verificacion de existencia del objeto alumnos  (if*1)
  	if($this->alumnos){
  		//Creamos el archivo temporal de exportación
  		$file = 'listado-egresados.cvs';
  
  		$fh = fopen($file,"w+") or die ("unable to open file");
  
  		$titulo = "Id, Legajo, Apellido, Nombre, Nro. de documento, Fecha de egreso, Carrera, Facultad, Sede, Area,\n";
  		fwrite($fh,$titulo);
  		
  		foreach ($this->alumnos as $alumno){
  			$areaDestino = "";
  			if ($alumno['idexpediente']) {
  				$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($alumno['idexpediente']);
  				$oDerivacion = $oExpediente->obtenerUltimaDerivacion();
  				$areaDestino = $oDerivacion->obtenerAreaDestino();
  			}		
  			$row = $alumno['idalumno'].",".$alumno['legajo'].",".$alumno['nombre'].",".$alumno['nrodoc'].",".$alumno['fechaegreso'].",".$alumno['carrera'].",".$alumno['facultad'].",".$alumno['sede'].",".$areaDestino.","."\n";
  		  
  			fwrite($fh,$row);
  		}
  	}
  
  	// Close file
  	fclose($fh);
  
  	header("Content-Type: application/vnd.ms-excel");
  	header("Content-Type: application/force-download");
  	header("Content-Transfer-Encoding: binary");
  	header("Content-Disposition: attachment;filename=".$file );
  	header("Content-Length: ".filesize($file));
  	header("Pragma: no-cache");
  	header("Expires: 0");
  	readfile($file);
  
  	// stop symfony process
  	throw new sfStopException();
  
  	return sfView::NONE;
  }  
  
  public function executeIndex(sfWebRequest $request)
  {
  	$this->idsede = $request->getParameter('idsede',0);
  	$this->idfacultad = $request->getParameter('idfacultad',0);
  	$this->idplanestudio = $request->getParameter('idplanestudio',0);
  	$this->idestado = $request->getParameter('idestado',0);
  	$this->ordencampo = $request->getParameter('ordencampo','s.nombre');
  	$this->ordenmetodo = $request->getParameter('ordenmetodo','ASC');
  	
  	if ($this->idsede!=0) {
  		$oSede =  Doctrine_Core::getTable('Sedes')->find($this->idsede);
  		$this->sede = $oSede->getNombre();
  	} else {
  		$this->sede = "Todas las sedes.";
  	}
  	if ($this->idfacultad!=0) {
  		$oFacultad =  Doctrine_Core::getTable('Facultades')->find($this->idfacultad);
  		$this->facultad = $oFacultad->getNombre();
  	} else {
  		$this->facultad = "Todas las facultades.";
  	}  	
  	if ($this->idplanestudio!=0) {
  		$oPlan =  Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
  		$this->plan = $oPlan->getNombre();
  	} else {
  		$this->plan = "Todas las carreras.";
  	}  	
  	if ($this->idestado!=0) {
  		$arregloEstados = array('0' => '----TODOS----','1' => 'En curso','2' => 'Finalizada');
  		$this->estado = $arregloEstados[$this->idestado];
  	} else {
  		$this->estado = "Todas los estados.";
  	}  	
  	// Busco los egresados por sede
  	$this->alumnos = Doctrine_Core::getTable('Alumnos')->buscarEgresadosFiltrados($request->getParameter('idfacultad'), $request->getParameter('idsede'), $request->getParameter('idplanestudio'), $request->getParameter('ordencampo'), $request->getParameter('ordenmetodo'), $request->getParameter('idestado'));
  }  
  
  public function executeBuscaregresadosfiltrados(sfWebRequest $request)
  {
  	$this->mensaje = "";
  	$this->form = new BuscarEgresadosFiltrosForm();
  }
    
  public function executeActualizarpromedio(sfWebRequest $request)
  {
  	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	$oAlumno->setPromedio($request->getParameter('promedio'));
	$oAlumno->save();
  
  	echo "El promedio se ha guardado correctamente.";
  
  	return sfView::NONE;
  }
    
  public function executeRegistrarpromedio(sfWebRequest $request)
  {
  	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  }

  public function executeRegistraregresado(sfWebRequest $request)
  {
	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
	$mesa = $this->alumno->obtenerUltimoMesaAprobada();
	$fecha = explode("-", $mesa['fecha']);
    $this->fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];    
  }  
  	
  public function executeVercarreras(sfWebRequest $request)
  {
    $this->personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona')));
    $this->forward404Unless($this->personas);

    $oAreas = new Areas();
     
    $this->carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorAreaPorPersona($this->getUser()->getProfile()->getIdarea(),$request->getParameter('idpersona'));
  }

  public function executeAgregaralumno(sfWebRequest $request)
  {
    $this->personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona')));
    $this->forward404Unless($this->personas);

    $oAreas = new Areas();
     
    $this->carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorArea($this->getUser()->getProfile()->getIdarea());
    $this->sedes = Doctrine::getTable('Sedes')->findAll();       
    $this->ciclos = Doctrine_Core::getTable('CiclosLectivos')->obtenerCiclosLectivosActivos();
  }

  public function executeActualizaralumno(sfWebRequest $request)
  {
      $oPersona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
      $internacional = '0';

      /////////////////////////////////////////////////////
      //conexion webservice alumnos
      $soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
      $soapclient->setCredentials("root", "sistemas2009");
     
      /////////////////////////////////////////////////////   
      // falta buscar si ya existe la persona y plan de estudio Y CANCELAR LA OPERACION

      $oAlumno = new Alumnos();
      
      // control: si la persona y plan de estudio ya existe en la tabla alumnos, dale con error
      if ($oAlumno->obtenerAlumnoPersonaPlan($request->getParameter('idpersona'), $request->getParameter('idplanestudio'))>0){
          $resultado = "El alumno ya existe en esa carrera.";
      } else {
      	  $oCiclo = Doctrine::getTable('CiclosLectivos')->find($request->getParameter('idciclo'));
      
	  
	      $oAlumno->setIdpersona($request->getParameter('idpersona'));
	      $oAlumno->setIdplanestudio($request->getParameter('idplanestudio'));
	      $oAlumno->setFechaingreso($oCiclo->getCiclo().'-01-01');
	      $oAlumno->setIdciclolectivo($request->getParameter('idciclo'));
	      $oAlumno->setIdSede($request->getParameter('idsede'));
	      $oAlumno->setActivo(1);
	      $oAlumno->save();
	     
	
	     // llamamos la función implementada en el webservices
	     $resultadoSoap = $soapclient->call('actualizaralumno',
	      array('idalumno' => NULL, 
	      'idpersona' => $request->getParameter('idpersona'),
	      'idplanestudio' => $request->getParameter('idplanestudio'),
	      'fechaingreso' => $oCiclo->getCiclo().'-01-01', 
	      'ingreso' => NULL,       
	      'legajo' => NULL,
	      'fotografia' => NULL,
	      'fotocopiadni' => NULL,
	      'fotocopialegtitulo' => NULL,
	      'certtittramite' => NULL,
	      'certalureg' => NULL,
	      'derechoevaluacion' => NULL,
	      'experiencialaboral' => NULL,
	      'pagomatricula' => NULL,
	      'bancarizacion' => NULL,
	      'titulorevalido' => NULL,
	      'tramiteresidencia' => NULL,
	      'radiografiatorax' => NULL,
	      'electrocardiograma' => NULL,
	      'ergonomia' => NULL,
	      'planillamedica' => NULL,
	      'planillabucodental' => NULL,
	      'activo' => 1,
	      'idestadoalumno' => 1,
	      'internacional' => $internacional,
	      'codadministracion' => 0,
	      'egresado' => 0,
	      'fechaegreso' => NULL)
	    );  
	    $this->alumno = unserialize(base64_decode($resultadoSoap));    

	    $resultado = "El alumno se ha asociado correctamente.";
      
      }
  	echo $resultado;
	
	return sfView::NONE;
  }

  public function executeBuscar(sfWebRequest $request)
  {
	$this->form = new BuscarAlumnosForm(array(
		'url' => '',
	    'titulo' => '',
		'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
	));	

	if ($request->isMethod('post')) {
		$this->form->bind($request->getParameter($this->form->getName()));
		if ($this->form->isValid())	{
			$arreglo = $request->getParameter($this->form->getName());

			$this->idplanestudio = $arreglo['idplanestudio'];
       		$this->tipocriterio = $arreglo['tipocriterio'];
        	$this->criterio = $arreglo['criterio'];
        
                $this->resultado = Doctrine_Core::getTable('Personas')->obtenerPersonas($this->tipocriterio, $this->criterio);		
  			//$this->resultado = Doctrine_Core::getTable('Alumnos')->buscarAlumnos($this->tipocriterio, $this->criterio, $this->idplanestudio, $this->getUser()->getProfile()->getIdsede());			
		}
	} else {
		$this->resultado = array();
	}
  }

  public function executeBuscaregresados(sfWebRequest $request)
  {
    $this->resultado = array();
     
    $this->form = new BuscarEgresadosForm();
    
    if ($request->isMethod('post')) {
    	$this->form->bind($request->getParameter($this->form->getName()));
    
    	if ($this->form->isValid())	{
    		$arreglo = $request->getParameter($this->form->getName());
    
    		$this->idplanestudio = $arreglo['idplanestudio'];
    		$this->tipocriterio = $arreglo['tipocriterio'];
    		$this->criterio = $arreglo['criterio'];
    		 
    		$this->resultado = Doctrine_Core::getTable('Alumnos')->buscarEgresados($this->tipocriterio, $this->criterio, $this->idplanestudio, $this->getUser()->getProfile()->getIdsede());
    	}
    } else {
    	$this->resultado = array();
    }
  } // END function executeBuscarEgresados
  
  public function executeAgregarcarrera(sfWebRequest $request)
  {
     $this->personas = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona')));
     $this->forward404Unless($this->personas);

     $oAreas = new Areas();
     
     $this->carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPlanesPorAreaPorPersona($this->getUser()->getProfile()->getIdarea(),$request->getParameter('idpersona'));
 
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));

      if ($this->form->isValid())
      {
            $this->tipocriterio = $this->form->getValue('tipocriterio');
            $this->criterio = $this->form->getValue('criterio');

            $this->resultado = Doctrine_Core::getTable('Personas')->obtenerEgresados($this->tipocriterio, $this->criterio);     
      }
    }
  } // END function executeAgregarcarrera

  public function executeNewpersonas(sfWebRequest $request)
  {
    $this->form = new PersonasForm();
  } 

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new PersonasForm();

    // Obtener Facultad
     $oFacultad = Doctrine_Core::getTable('Facultades')->find(Doctrine_Core::getTable('AreasCarrera')->obtenerFacultadxdesignacion());
     $this->forward404Unless($oFacultad);

    // VALIDAR DOCUMENTO
    //===========================================================================
    $post = $request->getParameter($this->form->getName());
    $oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find($post['idtipodoc']);        
    $formato = $oTipoDocumento->getFormato(); 
    //$nrodoc = preg_replace("/[^\d]/", "", $post['nrodoc']);
    $nrodoc = preg_replace('/[^\d]/', '', $post['numerodoc']);

/*    if (!preg_match($formato, $post['numerodoc'])) 
       return $this->forward404('Formato de documento no valido Ejemplo para DNI 22.456.333'); 
  */  
    // CONTROLAR QUE EL NRODOC NO EXISTA PREVIAMENTE
    //===================================================
    $oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($post['idtipodoc'],$nrodoc);
    //$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($post['idtipodoc'], $post['nrodoc']);
    
    if($oPersona)
       return $this->forward404('La persona ya existe en el sistema, verifique la operacion..'); 
    
    // GRABAR VIA WS EN SISTEMA ALUMNOS ANTERIOR
    //=============================================================================
    $soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
    //$soapclient->setCredentials("root", "sistemas2009");

    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarpersona',
        array('idpersona' => null,
        'nombre' => ucwords(strtolower($post['nombre'])), 
        'apellido' => strtoupper($post['apellido']), 
        'sexo' => $post['idsexo'], 
        'idtipodoc' => $post['idtipodoc'],
        'nrodoc' => $nrodoc,      
        'fechanac' => $post['fechanac']['year']."-".$post['fechanac']['month']."-".$post['fechanac']['day'],
        'fechaingreso' => '1971-01-01',
        'idciudadnac' => $post['idciudadnac'], 
        'idnacionalidad' => $post['idnacionalidad'],
        'estadocivil' => $post['estadocivil'],
        'vive' => 1)
    );

    $this->persona = unserialize(base64_decode($resultadoSoap));    

    if($this->persona['idPersona']>0){
        // Graba la persona
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    } else {
        return $this->forward404('La persona no pudo ser ingresada, reintente la operacion..'); 
    } 
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
    
   // $nrodoc = preg_replace("/[^\d]/", "", $post['nrodoc']);
    $nrodoc = preg_replace('/[^\d]/', '', $post['numerodoc']);

    // GRABAR VIA WS EN SISTEMA ALUMNOS ANTERIOR
    //===========================================
    $soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
    $soapclient->setCredentials("root", "sistemas2009");

    // llamamos la función implementada en el webservices
    $resultadoSoap = $soapclient->call('actualizarpersona',
        array('idpersona' => $request->getParameter('idpersona'),
        'nombre' => ucwords(strtolower($post['nombre'])), 
        'apellido' => strtoupper($post['apellido']), 
        'sexo' => $post['idsexo'], 
        'idtipodoc' => $post['idtipodoc'],
        'nrodoc' => $nrodoc,      
        'fechanac' => "1980-01-01",
        'fechaingreso' => "1980-01-01",
        'idciudadnac' => "734", 
        'idnacionalidad' => "1",
        'estadocivil' => "1",
        'vive' => 1)
    );

    $this->persona = unserialize(base64_decode($resultadoSoap));   
   
    if($this->persona['idPersona']>0){
      // PROCESAR TEMPLATE
       $this->processForm($request, $this->form);

       $this->setTemplate('edit'); 

    } else {
       return $this->forward404('La persona no pudo ser ingresada, reintente la operacion..'); 
    }  
  }

  public function executeActualizaregresado(sfWebRequest $request)
  {
	$arr = explode('-', $request->getParameter('fechaegreso'));
	$fechaupdate = $arr[2]."-".$arr[1]."-".$arr[0];	
        $oAlumno = new Alumnos();
        $idAlumno = $oAlumno->obtenerAlumnoPersonaPlan($request->getParameter('idpersona'), $request->getParameter('idplanestudio'));
	//$oAlumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));


    // Grabar en tabla EstadosAlumnoHistorial
    $oEah = new EstadosAlumnoHistorial();
     
    $oEah->setIdestadoalumno(3);
    $oEah->setIdalumno($idAlumno);
    $oEah->setFecha($fechaupdate);

    $oEah->save();
           
  	echo "El egresado ha sido guardado correctamente.";
	
	return sfView::NONE;
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $personas = $form->save();

      $this->redirect('egresados/edit?idpersona='.$personas->getIdpersona());
    }
  }

  public function executeObtenerdetalleegresados(sfWebRequest $request)
  {
           $fechaa = explode("/", $request->getParameter('inicio'));
           $fechadesde = $fechaa[2]."-".$fechaa[0]."-".$fechaa[1]; 

           $fechab = explode("/", $request->getParameter('fin'));
           $fechahasta = $fechab[2]."-".$fechab[0]."-".$fechab[1]; 

           switch ($request->getParameter('idreporte')) {
              case 1:
                  //Creamos el archivo temporal de exportación
                 $file = 'egresados_detalle.csv';
                 $fh = fopen($file,"w+") or die ("unable to open file");

                 // Obtener nuevos inscriptos por anio
                 $resultado = Doctrine_Core::getTable('Personas')->detalleEgresadosPorRango($fechadesde, $fechahasta);
          
                $titulo = "Sede, Facultad, Carrera, Egresado, FechaEgreso, Sexo,"."\n";
                fwrite($fh,$titulo); 

                foreach($resultado as $datos){
                    $row = $datos['sede'].",".$datos['facultad'].",".$datos['carrera'].",".$datos['nombre'].",".$datos['fechaegreso'].",".$datos['sexo'].","."\n";
                    fwrite($fh,$row); 
                }
                break; 

              case 2:
                  //Creamos el archivo temporal de exportación
                 $file = 'egresados_totales.csv';
                 $fh = fopen($file,"w+") or die ("unable to open file");

                 // Obtener nuevos inscriptos por anio
                 $resultado = Doctrine_Core::getTable('Personas')->totalEgresadosPorRango($fechadesde, $fechahasta);
          
                 $titulo = "Sede, Facultad, Carrera, Varones, Mujeres, Total,"."\n";
                 fwrite($fh,$titulo); 

                foreach($resultado as $datos){
                    $row = $datos['sede'].",".$datos['facultad'].",".$datos['carrera'].",".$datos['varones'].",".$datos['mujeres'].",".$datos['total'].","."\n";
                    fwrite($fh,$row); 
                } 
                break; 
           }     
           
          // Close file            
          fclose($fh);  

          header("Content-Type: application/vnd.ms-excel");
          header("Content-Type: application/force-download");
          header("Content-Transfer-Encoding: binary");
          header("Content-Disposition: attachment;filename=".$file );
          header("Content-Length: ".filesize($file));
          header("Pragma: no-cache");
          header("Expires: 0");
          readfile($file);
          throw new sfStopException();   
         // return sfView::NONE; 
  } 

  public function executeMostraregresados()
  {
  }
}
