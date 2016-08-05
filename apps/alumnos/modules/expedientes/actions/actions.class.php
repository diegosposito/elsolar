<?php

/**
 * expedientes actions.
 *
 * @package    sig
 * @subpackage expedientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class expedientesActions extends sfActions
{
	public function executeImprimirsolicituddiploma(sfWebRequest $request)
	{
		setlocale(LC_ALL,"es_ES");
	
		$arrayMeses = array('01' =>'enero','02' =>'febrero','03' =>'marzo','04' =>'abril','05' =>'mayo','06' =>'junio','07' =>'julio','08' =>'agosto','09' =>'septiembre','10' =>'octubre','11' =>'noviembre','12' =>'diciembre');
	
		$oExpediente = Doctrine::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
		$fechaSolicitud = $oExpediente->getFechasolicitud();
		$fecha = explode("-",$fechaSolicitud);
		$fecha_convertida = intval($fecha[2]).' de '.$arrayMeses[$fecha[1]].' de '.$fecha[0];
		 
		$oAlumno = $oExpediente->getAlumnos();
		$oPersona = $oAlumno->getPersonas();
		$oPais = Doctrine::getTable('Paises')->find(array($oPersona->getIdnacionalidad()));
		$oCiudadNac = Doctrine::getTable('Ciudades')->find(array($oPersona->getIdciudadnac()));
		$oPlanEstudio = $oAlumno->getPlanesEstudios();
		$oCarrera = $oPlanEstudio->getCarreras();
		$oFacultad = $oCarrera->getFacultades();
		$oTitulo = $oExpediente->getTitulos();
		
		$ultimamesa = $oAlumno->obtenerUltimoMesaAprobada();
		$arr = explode('-', $ultimamesa['fecha']);
		$fechaegreso = $ultimamesa['fecha'];
	
		$oContacto = $oPersona->getContacto();
	
		$telefonofijo = $oContacto->getTelefonofijonum();
		if ($telefonofijo=="") {
			$tel = "-";
		} else {
			$areatelefonofijo = $oContacto->getTelefonofijocar();
			if ($areatelefonofijo=="") {
				$tel = $telefonofijo;
			} else {
				$tel = $areatelefonofijo."-".$telefonofijo;
			}
		}
	
		$telefonomovil = $oContacto->getCelularnum();
		if ($telefonomovil=="") {
			$cel = "-";
		} else {
			$areatelefonomovil = $oContacto->getCelularcar();
			if ($areatelefonomovil=="") {
				$cel = $telefonomovil;
			} else {
				$cel = $areatelefonomovil."-".$telefonomovil;
			}
		}
	
		if($oContacto->getEmail()){
			$email = $oContacto->getEmail();
		} else {
			$email = "";
		}
	
		if ($oPersona->getIdsexo()==1) {
			$diploma = $oTitulo->getNombre();
		} else {
			$diploma = $oTitulo->getNombrefemenino();
		}
				
		// Crea una instancia de la clase de FPDF
		$pdf = new PDF();
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
	
		// Asigna el titulo de la planilla
		$titulo = "SOLICITUD DE DIPLOMA";
		// Configura el auto-salto de pagina
		$pdf->SetAutoPageBreak(1 , 10);
		// Agrega la Cabecera al documento
		$pdf->Cabecera($oFacultad, $oCarrera, $titulo);
		$pdf->SetFont('Times','',10);
		//$pdf->SetX(35);
		// Define un alias para el número de páginas del documento pdf
		$pdf->AliasNbPages();
		 
		$html= '<div style="text-align: right;margin-left: 80px;"><span
		style="font-family: Times New Roman,Times,serif;">CONCEPCIÓN DEL URUGUAY, '.$fecha_convertida.'</span><br>
		</div>';
	
		$html .= '
		<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
				<td width="35%"><b>Nro. de expediente:</b></td>
				<td width="65%">'.$oExpediente->getIdexpediente().'</td>
		</tr>
		<tr>
				<td><b>Apellido y Nombres:</b></td>
				<td>'.$oPersona->getApellido() .', '.$oPersona->getNombre().'</td>
		</tr>
		<tr>
				<td><b>Nacionalidad:</b></td>
				<td>'.$oPais->getDescripcion().'</td>
		</tr>
		<tr>
				<td><b>Documento:</b></td>
				<td>'.$oPersona->getNroDoc().'</td>
		</tr>
		<tr>
				<td><b>Fecha de nacimiento:</b></td>
				<td>'.strftime("%d-%m-%Y",strtotime($oPersona->getFechaNac())).'</td>
		</tr>
		<tr>
				<td><b>Lugar de nacimiento:</b></td>
				<td>'.$oCiudadNac->getDescripcion().'</td>
		</tr>
		<tr>
				<td><b>Domicilio:</b></td>
				<td>'.$oContacto->getCallee().' '.$oContacto->getNumeroe().'</td>
		</tr>
		<tr>
				<td><b>Teléfono:</b></td>
				<td>'.$tel.'</td>
		</tr>
		<tr>
				<td><b>Celular:</b></td>
				<td>'.$cel.'</td>
		</tr>
		<tr>
				<td><b>Correo electrónico:</b></td>
				<td>'.$email.'</td>
		</tr>
		<tr>
				<td><b>Lector de biblioteca Nro.:</b></td>
				<td></td>
		</tr>
		<tr>
				<td><b>Fecha de aprobación de la última materia:</b></td>
				<td>'.strftime("%d-%m-%Y",strtotime($fechaegreso)).'</td>
		</tr>
		<tr>
				<td><b>Diploma que solicita:</b></td>
				<td>'.strtoupper($diploma).'</td>
		</tr>
		<tr>
				<td></td>
				<td></td>
		</tr>
		<tr>
				<td></td>
				<td></td>
		</tr>
		<tr>
				<td></td>
				<td align="center">
				<table width="60%" border="0">
				<tr><td><hr></td></tr>
				<tr><td align="center">Firma</td></tr>
				</table>
				</td>
		</tr>
		</tbody>
		</table>
		';
	
		$pdf->writeHTML($html, true, false, true, false, '');
	
		// output
		$pdf->Output('solicitud-diploma.pdf', 'I');
	
		// Stop symfony process
		throw new sfStopException();
	}	
	
	// Guarda el cambio de estado
	public function executeGuardarsolicituddiploma(sfWebRequest $request)
	{
		$arregloExpedientes = $request->getParameter('expedientes_egresados');
	
		// Guarda la informacion del expediente
		$oExpediente = new ExpedientesEgresados();
	
		$oExpediente->setIdalumno($arregloExpedientes['idalumno']);
		$arr = explode('-', $arregloExpedientes['fechasolicitud']);
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		$oExpediente->setFechasolicitud($fecha);
	
		// Obtener el alumno
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arregloExpedientes['idalumno']);
		// Obtener el titulo
		$oTitulo = Doctrine_Core::getTable('Titulos')->find($arregloExpedientes['idtitulo']);
		
		$ultimamesa = $oAlumno->obtenerUltimoMesaAprobada();
		$arr = explode('-', $ultimamesa['fecha']);
		$fechaegreso = $ultimamesa['fecha'];
		$oExpediente->setFechaegreso($fechaegreso);
		$oExpediente->setObservaciones($arregloExpedientes['observaciones']);
		$oExpediente->setIdsede($this->getUser()->getProfile()->getIdsede());
		$oExpediente->setIdtitulo($arregloExpedientes['idtitulo']);
		$oExpediente->setActivo(1);
		$oExpediente->save();
	
		//Se agrega derivacion a Biblioteca
		$oDerivacionBiblioteca = new ExpedientesDerivaciones();
	
		$oDerivacionBiblioteca->setIdexpediente($oExpediente->getIdexpediente());
		$oDerivacionBiblioteca->setIdareaorigen($this->getUser()->getProfile()->getIdarea());
		$oDerivacionBiblioteca->setIdareadestino(30);
		$oDerivacionBiblioteca->setObservaciones('Se solicita informe sobre el estado del alumno en el area.');
		$oDerivacionBiblioteca->setActivo(1);
		$oDerivacionBiblioteca->setCreatedAt(date('Y-m-d'));
		$oDerivacionBiblioteca->save();
	
		//Se agrega derivacion a Administracion
		$oDerivacionAdministracion = new ExpedientesDerivaciones();
	
		$oDerivacionAdministracion->setIdexpediente($oExpediente->getIdexpediente());
		$oDerivacionAdministracion->setIdareaorigen($this->getUser()->getProfile()->getIdarea());
		if($this->getUser()->getProfile()->getIdsede()==1) {
			$oDerivacionAdministracion->setIdareadestino(11);
		} else {
			$oDerivacionAdministracion->setIdareadestino(61);
		}
		$oDerivacionAdministracion->setObservaciones('Se solicita informe sobre el estado del alumno en el area.');
		$oDerivacionAdministracion->setActivo(1);
		$oDerivacionAdministracion->setCreatedAt(date('Y-m-d'));
		$oDerivacionAdministracion->save();
	
		$observaciones = ($arregloExpedientes['observaciones'] ? $arregloExpedientes['observaciones'] : "Sin Observaciones.");
		
		$asunto = "SAO - Solicitud de Diploma: ".$oAlumno->getPersonas();
		
		$usuariosDestinoAdm = Doctrine_Core::getTable('EmpleadosSede')->obtenerUsuarios($oAlumno->getIdsede(), 6);

		$destinatarioAdm = array_values($usuariosDestinoAdm);

		$usuariosDestinoBib = Doctrine_Core::getTable('EmpleadosSede')->obtenerUsuariosBiblioteca($oAlumno->getIdsede());
		
		$destinatarioBib = array_values($usuariosDestinoBib);
		$destinatarios = array_merge($usuariosDestinoAdm, $usuariosDestinoBib);
		
		if ($oAlumno->getPersonas()->getIdsexo()==1) {
			$titulo = $oTitulo->getNombre();
		} else {
			$titulo = $oTitulo->getNombrefemenino();
		}
		
		$remitente = $this->getUser()->getGuardUser()->getEmailAddress();
		$mensaje = '
		**************************************************************************************
		**************************************************************************************
	
		Se solicita el diploma sobre del alumno '.$oAlumno->getPersonas().' ('.$oAlumno->getIdalumno().'), de la carrera '.$titulo.' de la sede '.$oAlumno->getSedes().'
		Observaciones: '.$observaciones.'
		**************************************************************************************
		**************************************************************************************';
			
		$resultado = $this->getMailer()->composeAndSend(
				$remitente,
				$destinatarios,
				$asunto,
				$mensaje
		);

		echo "Se ha guardado correctamente el expediente.";
	
		return sfView::NONE;
	}
		
	public function executeSolicitardiploma(sfWebRequest $request)
	{
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->titulo = Doctrine_Core::getTable('Titulos')->find($request->getParameter('idtitulo'));
		
		$fecha = date('d-m-Y');
	
		$this->form = new SolicitudDiplomaForm();
		$this->form->setDefault('idalumno', $request->getParameter('idalumno'));
		$this->form->setDefault('idtitulo', $request->getParameter('idtitulo'));
		$this->form->setDefault('fechasolicitud', $fecha);
		$this->form->setDefault('idestadoalumno', 3);
	}
		
	public function executeVeregresado(sfWebRequest $request)
	{
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->persona = $this->alumno->getPersonas();
		$this->nacionalidad = Doctrine::getTable('Paises')->find($this->persona->getIdNacionalidad());
		$this->ciudadnac = Doctrine::getTable('Ciudades')->find($this->persona->getIdCiudadNac());
		$this->titulo = Doctrine::getTable('Titulos')->find($request->getParameter('idtitulo'));

		if($this->persona->getContacto()) {
			$this->contacto = $this->persona->getContacto();
		} else {
			$this->contacto = "";
		}
	
		//$this->expediente = $this->alumno->obtenerExpediente();
		$this->expediente = $this->alumno->obtenerExpedienteSegunTitulo($request->getParameter('idtitulo'));
		if(!$this->expediente) {
			$this->estado = 1; // El alumno es egresado pero no solicito el diploma
		} else {
			if($this->contacto != "") {
				$this->estado = 2; // El alumno es egresado y solicito el diploma
			} else {
				$this->estado = 3; // El alumno no tiene cargado los datos de contacto
			}
		}
	
		$mesa = $this->alumno->obtenerUltimoMesaAprobada();
	
		$this->ultimafecha = "-";
		if ($mesa['fecha']) {
			$arr = explode('-', $mesa['fecha']);
			$this->ultimafecha = $arr[2]."-".$arr[1]."-".$arr[0];
		}
	
	}
		
	public function executeBuscar(sfWebRequest $request)
	{
		$this->form = new BuscarTitulosForm();	

		if ($request->isMethod('post')) {
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid())	{
				$arreglo = $request->getParameter($this->form->getName());
				
        		$this->idtitulo = $arreglo['idtitulo'];
        		$this->tipocriterio = $arreglo['tipocriterio'];
        		$this->criterio = $arreglo['criterio'];
        	
  				$this->resultado = Doctrine_Core::getTable('Alumnos')->buscarEgresadosPorTitulo($this->tipocriterio, $this->criterio, $this->idtitulo, $this->getUser()->getProfile()->getIdsede());			
			}
		} else {
			$this->resultado = array();
		}
	}
		
  public function executeImprimirinforme(sfWebRequest $request)
  {
  	$arrayMeses = array('01' =>'enero','02' =>'febrero','03' =>'marzo','04' =>'abril','05' =>'mayo','06' =>'junio','07' =>'julio','08' =>'agosto','09' =>'septiembre','10' =>'octubre','11' =>'noviembre','12' =>'diciembre');

  	$this->expedientes = Doctrine::getTable('ExpedientesEgresados')->find(array($request->getParameter('idexpediente')));
	$fechaInforme = $this->expedientes->getFechainformeauditoria();
	$fecha = explode("-",$fechaInforme);

	if($fecha[2] == "01"){
		$dia = "un";
	}else{
		$diaEnLetra=new EnLetras();
		$dia= $diaEnLetra->ValorEnLetras($fecha[2]);
	}

	$fecha_convertida = $dia.' días del mes de '.$arrayMeses[$fecha[1]].' de '.$fecha[0];
	
	$this->alumno = $this->expedientes->getAlumnos();
	$this->persona = $this->alumno->getPersonas();
	$this->nombrepersona = $this->persona->getApellido().", ".$this->persona->getNombre();
	$this->facultad = $this->expedientes->getAlumnos()->getPlanesEstudios()->getCarreras()->getFacultades();
	
  	if ($this->alumno->getIdestudioprevio()==0) {
		$this->estudio = Doctrine_Query::create()
			->from('Estudios e')
			->where('e.idpersona = '.$this->alumno->getIdpersona())
			->fetchOne();
	} else {
		$this->estudio = Doctrine_Core::getTable('Estudios')->find($this->alumno->getIdestudioprevio());
	}
	
	$this->ciudadestudio = Doctrine::getTable('Ciudades')->find(array($this->estudio->getIdciudad()));
	$this->provinciaestudio = Doctrine::getTable('Provincias')->find(array($this->ciudadestudio->getIdprovincia()));
	$this->planestudios = Doctrine::getTable('PlanesEstudios')->find(array($this->alumno->getIdplanestudio()));
		
	$this->documentaciones = Doctrine::getTable('DocumentacionExpedientes')
		->createQuery('d')
  		->where('d.idexpediente = ?', $this->expedientes->getIdexpediente())
  		->orderBy('d.iddocumentacion ASC')
  		->execute();
	$this->condiciones = Doctrine::getTable('CondicionesExpedientes')
		->createQuery('c')
  		->where('c.idexpediente = ?', $this->expedientes->getIdexpediente())
  		->orderBy('c.idcondicion ASC')
  		->execute();
  				
	$config = sfTCPDFPluginConfigHandler::loadConfig();
 
	// Crea una instancia de la clase de FPDF
	$pdf = new PDF();
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
		

	// Asigna los margenes
	$pdf->SetMargins(30, 5, 15);
	
	// Define el tamaño de la letra
	$pdf->SetFont("Times", "", 12);
  
	// add a page
	$pdf->AddPage();
  
	$html = '
		<div style="text-align: center; font-weight: bold; font-family: Times New Roman,Times,serif;"><span
		style="font-size: 16;"><img src="'.$request->getRelativeUrlRoot().'/images/LOGOUCU2.gif" width="70"><br>UNIVERSIDAD DE CONCEPCIÓN DEL URUGUAY</span><br>
		<span style="font-size: 14;">OFICINA DE AUDITORIA ACADEMICO ADMINISTRATIVA</span><br>
		<br>
		INFORME DE AUDITORIA<br>
		</div>';
	
	$pdf->writeHTML($html, true, false, true, false, '');
 	$tabulado = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	$html= '<div style="text-align: justify;margin-left: 80px;"><span
		style="font-family: Times New Roman,Times,serif;">Señor Rector</span>:
		<br>'.$tabulado.'En mi carácter de Auditor Académico Administrativo, informo a Ud. sobre las verificaciones
		efectuadas al CERTIFICADO ANALÍTICO que se adjunta a folio '.$this->expedientes->getFolio().', el que
		fue expedido por la '.strtoupper($this->facultad).', a nombre de '.$this->nombrepersona.', '.$this->persona->getTiposDocumentos().' '.$this->persona->getNumerodoc().'.<br><br>
		'.$tabulado.'Tales verificaciones consistieron en el cotejo de los datos transcriptos en el Certificado, con la
		documentación respaldatoria obrante en esa Unidad Académica, a saber:
		<ul style="text-align: justify;margin-left: 80px;">';
	foreach ($this->documentaciones as $documentacion) {
		if($documentacion->getIddocumentacion()=='2') {
			if(($this->estudio->getIdcategoriatitulo()==2) or ($this->estudio->getIdcategoriatitulo()==6)) {
				$articulo =	"el";
			} else {
				$articulo = "la";
			}
			$html .= '<li>Fotocopia autenticada en original del Título '.$this->estudio->getDescripcion().' expedido por '.$articulo.' '.$this->estudio->getEstablecimiento().', de '.$this->ciudadestudio.', '.$this->provinciaestudio;
			if($this->estudio->getAnioEgreso() != '0') $html .=', en el año '.$this->estudio->getAnioEgreso();
			$html .= '.</li>';
		}elseif($documentacion->getIddocumentacion()=='3') {
			$fechaEstudio = $this->planestudios->getFecha();
			$fecha = explode("-",$fechaEstudio);

			$fechaEstudio = $fecha[2].' de '.$arrayMeses[$fecha[1]].' de '.$fecha[0];
			$html .= '<li>Resolución '.$this->planestudios->getNroresolucion().' del '.$fechaEstudio.', que otorga el reconocimiento oficial y la validez nacional a la Carrera '.$this->planestudios->getCarreras().' y establece las "Condiciones de Ingreso", el "Plan de Estudios" y el "Régimen de Correlatividades" de la misma.';
		} else {
			$html .= '<li>'.$documentacion->getDocumentacion().'</li>';
		}
	}
	if($this->expedientes->getOtradocumentacion()) {
		$html .= '<li>'.$this->expedientes->getOtradocumentacion().'</li>';
	}
	$html .= '
		</ul>		
		'.$tabulado.'El análisis realizado permite informar lo siguiente:
		<ul style="text-align: justify;margin-left: 80px;">';
  	foreach ($this->condiciones as $condicion) {
		$html .= '<li>'.$condicion->getCondiciones().'</li>';
	}

	$html .='
		</ul>
		<span style="font-weight: bold; text-decoration: underline;">Observaciones:</span><br>
		'.$tabulado.''.$this->expedientes->getObservaciones().'<br>
		'.$tabulado.'Emito el presente Informe en Concepción del Uruguay, provincia de Entre Ríos, a los '.$fecha_convertida.'.
		</div>';
 
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// output
	$pdf->Output('Informe-Auditoria.pdf', 'I');
 
	// Stop symfony process
	throw new sfStopException();
  }
  	
  public function executeVer(sfWebRequest $request)
  {
  	$this->derivacionbiblio = "";
  	$this->derivacionadmin = "";
  	$this->credencial = $request->getParameter('credencial');

	// Obtener el expediente
  	$this->expediente = Doctrine::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
  	if ($this->expediente->getIdderivacionbiblioteca()!=0) {
  		$this->derivacionbiblio = Doctrine::getTable('ExpedientesDerivaciones')->find($this->expediente->getIdderivacionbiblioteca());
  	}
  	if ($this->expediente->getIdderivacionadministracion()!=0) {
  		$this->derivacionadmin = Doctrine::getTable('ExpedientesDerivaciones')->find($this->expediente->getIdderivacionadministracion());
  	}
  	
  	if ($this->expediente->getNrorecibo1()==$this->expediente->getNrorecibo2()){
		$this->tipopago = "Total";
	} else {
		$this->tipopago = "Parcial";
	}
	  	
  	// se obtienen todas las derivaciones de un expediente
    $this->derivacioness = Doctrine_Query::create()
    	->select('d.*')
    	->from('ExpedientesDerivaciones d')
    	->where('d.idexpediente='.$request->getParameter('idexpediente'))
    	->orderBy('d.idderivacion DESC')
    	->execute();    	
  }
  	
  public function executeRegistrar(sfWebRequest $request)
  {
	// Obtener el expediente
  	$oExpediente = Doctrine::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));

	//Se agrega derivacion a Auditoria
	$oDerivacionAudi = new ExpedientesDerivaciones();
	
	$oDerivacionAudi->setIdExpediente($oExpediente->getIdexpediente());
	$oDerivacionAudi->setIdAreaorigen($this->getUser()->getProfile()->getIdarea());
	$oDerivacionAudi->setIdAreadestino(29);
	$oDerivacionAudi->setObservaciones($oExpediente->getObservaciones());
	$oDerivacionAudi->setActivo(1);
	$oDerivacionAudi->setCreatedAt(date('Y-m-d'));
	$oDerivacionAudi->save();	  	
	
	// Obtener las derivaciones de adminitracion y biblioteca
  	$oDerivacionAdmin = Doctrine::getTable('ExpedientesDerivaciones')->find($oExpediente->getIdderivacionadministracion());
  	$oDerivacionAdmin->setLeido(1);
  	$oDerivacionAdmin->save();
  	$oDerivacionBiblio = Doctrine::getTable('ExpedientesDerivaciones')->find($oExpediente->getIdderivacionbiblioteca());
  	$oDerivacionBiblio->setLeido(1);
  	$oDerivacionBiblio->save();	
  	
    $this->redirect('expedientes/indexfacultad');	
  }
  
  public function executeImprimirprimeraparte(sfWebRequest $request)
  {
	setlocale(LC_ALL,"es_ES");
	  	
  	$arrayMeses = array('01' =>'enero','02' =>'febrero','03' =>'marzo','04' =>'abril','05' =>'mayo','06' =>'junio','07' =>'julio','08' =>'agosto','09' =>'septiembre','10' =>'octubre','11' =>'noviembre','12' =>'diciembre');

  	$oExpediente = Doctrine::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
	$fechaSolicitud = $oExpediente->getFechasolicitud();
  	$fecha = explode("-",$fechaSolicitud);  
	$fecha_convertida = intval($fecha[2]).' de '.$arrayMeses[$fecha[1]].' de '.$fecha[0];
  	
	$oAlumno = $oExpediente->getAlumnos();
	$oPersona = $oAlumno->getPersonas();
    $oPais = Doctrine::getTable('Paises')->find(array($oPersona->getIdnacionalidad()));
    $oCiudadNac = Doctrine::getTable('Ciudades')->find(array($oPersona->getIdciudadnac()));
	$oPlanEstudio = $oAlumno->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
    $oFacultad = $oCarrera->getFacultades();
	
	$ultimamesa = $oAlumno->obtenerUltimoMesaAprobada();
	$arr = explode('-', $ultimamesa['fecha']);
   	$fechaegreso=$ultimamesa['fecha'];

   	$oContacto = $oPersona->getContacto();

    $areatelefonofijo = $oContacto->getTelefonofijocar();
    $telefonofijo = $oContacto->getTelefonofijonum();
   	$areatelefonomovil = $oContacto->getCelularcar();
   	$telefonomovil = $oContacto->getCelularnum();

    if($oContacto->getEmail()){
    	$email = $oContacto->getEmail();
    } else {
    	$email = "";    	
    }  	
 
  	// Crea una instancia de la clase de FPDF
	$pdf = new PDF();
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);	
	
	// Asigna el titulo de la planilla
	$titulo = "SOLICITUD DE DIPLOMA";	
	// Configura el auto-salto de pagina
	$pdf->SetAutoPageBreak(1 , 10);
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);		
	$pdf->SetFont('Times','',10);
	//$pdf->SetX(35);
	// Define un alias para el número de páginas del documento pdf
	$pdf->AliasNbPages();
	  
	$html= '<div style="text-align: right;margin-left: 80px;"><span
		style="font-family: Times New Roman,Times,serif;">CONCEPCIÓN DEL URUGUAY, '.$fecha_convertida.'</span><br>
		</div>';

	$html .= '
		<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
				<td width="35%"><b>Nro. de expediente:</b></td>
				<td width="65%">'.$oExpediente->getIdexpediente().'</td>
		</tr>
		<tr>
				<td><b>Apellido y Nombres:</b></td>
				<td>'.$oPersona->getApellido() .', '.$oPersona->getNombre().'</td>
		</tr>
		<tr>
				<td><b>Nacionalidad:</b></td>
				<td>'.$oPais->getDescripcion().'</td>
		</tr>
		<tr>
				<td><b>Documento:</b></td>
				<td>'.$oPersona->getNroDoc().'</td>
		</tr>
		<tr>
				<td><b>Fecha de nacimiento:</b></td>
				<td>'.strftime("%d-%m-%Y",strtotime($oPersona->getFechaNac())).'</td>
		</tr>
		<tr>
				<td><b>Lugar de nacimiento:</b></td>
				<td>'.$oCiudadNac->getDescripcion().'</td>
		</tr>
		<tr>
				<td><b>Domicilio:</b></td>
				<td>'.$oContacto->getCallee().' '.$oContacto->getNumeroe().'</td>
		</tr>
		<tr>
				<td><b>Teléfono:</b></td>
				<td>'.$areatelefonofijo.'-'.$telefonofijo.'</td>
		</tr>
		<tr>
				<td><b>Celular:</b></td>
				<td>'.$areatelefonomovil.'-'.$telefonomovil.'</td>
		</tr>		
		<tr>
				<td><b>Correo electrónico:</b></td>
				<td>'.$email.'</td>
		</tr>
		<tr>
				<td><b>Lector de biblioteca Nro.:</b></td>
				<td></td>
		</tr>
		<tr>
				<td><b>Fecha de aprobación de la última materia:</b></td>
				<td>'.strftime("%d-%m-%Y",strtotime($fechaegreso)).'</td>
		</tr>
		<tr>
				<td><b>Diploma que solicita:</b></td>
				<td>'.strtoupper($oCarrera->getTitulo()).'</td>
		</tr>
		<tr>
				<td></td>
				<td></td>
		</tr>		
		<tr>
				<td></td>
				<td></td>
		</tr>		
		<tr>
				<td></td>
				<td align="center">
				<table width="60%" border="0">
				<tr><td><hr></td></tr>
				<tr><td align="center">Firma</td></tr>
				</table>
				</td>
		</tr>		
		</tbody>
		</table>
		';
 
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// output
	$pdf->Output('solicitud-diploma.pdf', 'I');
 
	// Stop symfony process
	throw new sfStopException();
  }  
  	
  public function executeImprimirsegundaparte(sfWebRequest $request)
  {
	setlocale(LC_ALL,"es_ES");
  	
	$arrayMeses = array('01' =>'enero','02' =>'febrero','03' =>'marzo','04' =>'abril','05' =>'mayo','06' =>'junio','07' =>'julio','08' =>'agosto','09' =>'septiembre','10' =>'octubre','11' =>'noviembre','12' =>'diciembre');
	
  	$oExpediente = Doctrine::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
  	$oDerivacionBiblio = Doctrine::getTable('ExpedientesDerivaciones')->find($oExpediente->getIdderivacionbiblioteca());
  	$oDerivacionAdmin = Doctrine::getTable('ExpedientesDerivaciones')->find($oExpediente->getIdderivacionadministracion());
  	// Guarda el estado leido a las derivaciones de Biblioteca y Administracion
  	$oDerivacionBiblio->setLeido(1);
  	$oDerivacionBiblio->save();
  	$oDerivacionAdmin->setLeido(1);
  	$oDerivacionAdmin->save();
  	
  	$fecha = explode("-",$oDerivacionBiblio->getCreatedAt());  
	$fechaBiblioteca = intval($fecha[2]).' de '.$arrayMeses[$fecha[1]].' de '.$fecha[0];
	
  	$fecha = explode("-",$oDerivacionAdmin->getCreatedAt());  
	$fechaAdministracion = intval($fecha[2]).' de '.$arrayMeses[$fecha[1]].' de '.$fecha[0];
	if ($oExpediente->getNrorecibo1()==$oExpediente->getNrorecibo2()){
		$tipopago = "Total";
	} else {
		$tipopago = "Parcial";
	}
	$config = sfTCPDFPluginConfigHandler::loadConfig();

	$oAlumno = $oExpediente->getAlumnos();
	$oPersona = $oAlumno->getPersonas();
    $oPais = Doctrine::getTable('Paises')->find(array($oPersona->getIdnacionalidad()));
    $oPlanEstudio = $oAlumno->getPlanesEstudios();
	$oCarrera = $oPlanEstudio->getCarreras();
    $oFacultad = $oCarrera->getFacultades();
	
  	// Crea una instancia de la clase de FPDF
	$pdf = new PDF();
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);	
	
	// Asigna el titulo de la planilla
	$titulo = "SOLICITUD DE DIPLOMA";	
	// Configura el auto-salto de pagina
	$pdf->SetAutoPageBreak(1 , 10);
	// Agrega la Cabecera al documento
	$pdf->Cabecera($oFacultad, $oCarrera, $titulo);		
	$pdf->SetFont('Times','',10);
	//$pdf->SetX(35);
	// Define un alias para el número de páginas del documento pdf
	$pdf->AliasNbPages();
	  
	$html = '
		<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
				<td style="vertical-align: top; width: 20%;"><b>Nro. de expediente:</b></td>
				<td style="vertical-align: top; width: 80%;">'.$oExpediente->getIdexpediente().'</td>
		</tr>
		<tr>
				<td><b>Apellido y Nombres:</b></td>
				<td>'.$oPersona->getApellido() .', '.$oPersona->getNombre().'</td>
		</tr>
		<tr>
				<td colspan="2"></td>
		</tr>	
		<tr>
				<td colspan="2"><hr></td>
		</tr>				
		<tr>
				<td colspan="2"><b><h2>INFORME DE BIBLIOTECA:</h2></b></td>
		</tr>		
		<tr>
				<td><b>Lector n°:</b></td>
				<td>'.$oPersona->getNrolector().'</td>
		</tr>
		<tr>
				<td><b>Observaciones:</b></td>
				<td>'.$oDerivacionBiblio->getObservaciones().'</td>
		</tr>
		<tr>
				<td><b>Fecha:</b></td>
				<td>'.$fechaBiblioteca.'</td>
		</tr>		
		<tr>
				<td colspan="2"></td>
		</tr>	
		<tr>
				<td colspan="2"><hr></td>
		</tr>				
		<tr>
				<td colspan="2"><b><h2>INFORME DE CONTADURIA:</h2></b></td>
		</tr>		
		<tr>
				<td><b>Recibo n°:</b></td>
				<td>'.$oExpediente->getNrorecibo1().'</td>
		</tr>
		<tr>
				<td><b>Tipo de pago:</b></td>
				<td>'.$tipopago.'</td>
		</tr>		
		<tr>
				<td><b>Observaciones:</b></td>
				<td>'.$oDerivacionAdmin->getObservaciones().'</td>
		</tr>
		<tr>
				<td><b>Fecha:</b></td>
				<td>'.$fechaAdministracion.'</td>
		</tr>					
		</tbody>
		</table>
		';
 
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// output
	$pdf->Output('solicitud-diploma.pdf', 'I');
 
	// Stop symfony process
	throw new sfStopException();
  }

  public function executeIndex(sfWebRequest $request)
  {
  	$this->expedientess = array();
  	$idarea = $this->getUser()->getProfile()->getIdarea();
  	$idsede = $this->getUser()->getProfile()->getIdsede();

  	$derivaciones = Doctrine::getTable('ExpedientesEgresados')->obtenerExpedientesPorOrigen($idarea);
  
  	foreach ($derivaciones as $derivacion) {
  		$exp = Doctrine::getTable('ExpedientesEgresados')->find($derivacion['idexpediente']);
  		$this->expedientess[$exp->getIdexpediente()] = $exp;
  	}
  }

  public function executeIndextitulos(sfWebRequest $request)
  {  	
    $this->expedientess = array();  
	$idarea = $this->getUser()->getProfile()->getIdarea();
	$idsede = $this->getUser()->getProfile()->getIdsede();

    $derivaciones = Doctrine::getTable('ExpedientesEgresados')->obtenerExpedientes($idarea);

    foreach ($derivaciones as $derivacion) {
    	if ($derivacion['idareadestino']==31) {
	    	$exp = Doctrine::getTable('ExpedientesEgresados')->find($derivacion['idexpediente']);
	    	$this->expedientess[$exp->getIdexpediente()] = $exp;
    	}
	}    
  }
    
  public function executeIndexsede(sfWebRequest $request)
  {  	
    $this->mensajes = array(
    	'0'=>"",	
    	'1'=>"No se recibieron las aprobaciones de Biblioteca y Administración Central.",
    	'2'=>"No se recibió la aprobación de Administración Central.",
    	'3'=>"No se recibió la aprobación de Biblioteca.",
    	'4'=>"No existen los estudios previos cargados.",
    	'5'=>"Existen observaciones realizadas por Auditoria.",
    	'6'=>"Existen observaciones realizadas por Legalización de Titulos.",
    	'7'=>"No existe el nro. de resolucion cargada.",
    	'8'=>"Existen observaciones realizadas por Biblioteca o Adminsitracion Central.",
    	'9'=>"No existe el nro. de recibo y/o registro M.E. cargada."
    );
  	$this->errores = array();
    $this->estudios = array();
    $this->expedientess = array();  
	$idarea = $this->getUser()->getProfile()->getIdarea();
	$idsede = $this->getUser()->getProfile()->getIdsede();

    $derivaciones = Doctrine::getTable('ExpedientesEgresados')->obtenerExpedientes($idarea);
   
    foreach ($derivaciones as $derivacion) { 	
    	if (($derivacion['idareadestino']==$idarea) or (($derivacion['idareaorigen']==$idarea) and (($derivacion['idareadestino']==61) or ($derivacion['idareadestino']==30)))){
	    	$exp = Doctrine::getTable('ExpedientesEgresados')->find($derivacion['idexpediente']);
	    	$this->expedientess[$exp->getIdexpediente()] = $exp;
	    	
			if(($exp->getIdderivacionbiblioteca()==0) && ($exp->getIdderivacionadministracion()==0)) {				
				if(($derivacion['idareaorigen']==30) or ($derivacion['idareaorigen']==61)) {
			   		$this->errores[$exp->getIdexpediente()] = 8;
				} else {
					$this->errores[$exp->getIdexpediente()] = 1;
				}
			} elseif(($exp->getIdderivacionbiblioteca()<>0) && ($exp->getIdderivacionadministracion()==0)) {
				if($derivacion['idareaorigen']==11) {
			   		$this->errores[$exp->getIdexpediente()] = 8;			   		
				} else {
					$this->errores[$exp->getIdexpediente()] = 2;
				}				
			} elseif(($exp->getIdderivacionbiblioteca()==0) && ($exp->getIdderivacionadministracion()<>0)) {
				if($derivacion['idareaorigen']==30) {
			   		$this->errores[$exp->getIdexpediente()] = 8;			   		
				} else {
					$this->errores[$exp->getIdexpediente()] = 3;
				}					
			} else {
			   	if($derivacion['idareaorigen']==29) {
	    			$this->errores[$exp->getIdexpediente()] = 5;
			   	}elseif($derivacion['idareaorigen']==31) {
			   		if (($exp->getRegistrome()!="") and ($exp->getNrorecibo2()!="")) {
			   			$this->errores[$exp->getIdexpediente()] = 6;
			   		} else {
			   			$this->errores[$exp->getIdexpediente()] = 9;
			   		}
		    	} else {
					$this->errores[$exp->getIdexpediente()] = 0;
		    	}
			}
			$estudio = $exp->getAlumnos()->getPersonas()->getEstudiosPrevios();
			if(count($estudio)==0) {
				$this->errores[$exp->getIdexpediente()] = 4;
			}
			$plan = $exp->getAlumnos()->getPlanesEstudios();
			if($plan->getNroresolucion()=="") {
				$this->errores[$exp->getIdexpediente()] = 7;
			}
	    }
	}    
  }  
    
  public function executeIndexfacultad(sfWebRequest $request)
  {  	
    $this->mensajes = array(
    	'0'=>"",	
    	'1'=>"No se recibieron las aprobaciones de Biblioteca y Administración Central.",
    	'2'=>"No se recibió la aprobación de Administración Central.",
    	'3'=>"No se recibió la aprobación de Biblioteca.",
    	'4'=>"No existen los estudios previos cargados.",
    	'5'=>"Existen observaciones realizadas por Auditoria.",
    	'6'=>"Existen observaciones realizadas por Legalización de Titulos.",
    	'7'=>"No existe el nro. de resolucion cargada.",
    	'8'=>"Existen observaciones realizadas por Biblioteca o Adminsitracion Central.",
    	'9'=>"El expediente ha sido reenviado a Administración Central para su evaluación.",
    	'10'=>"No existe el nro. de recibo y/o registro M.E. cargada."
    );
  	$this->errores = array();
    $this->estudios = array();
    $this->expedientess = array();  
	$idarea = $this->getUser()->getProfile()->getIdarea();
	$idsede = $this->getUser()->getProfile()->getIdsede();

	$areas = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
		SELECT	de.idarea AS idarea, de.descripcion AS area
			FROM areas ar
			INNER JOIN areas de ON ar.idareadependiente=de.idarea	
			WHERE 
				de.idtipoarea=3 and ar.idarea=".$idarea
	);
	$idareasc = $areas[0]['idarea'];		

	$derivacionessc = Doctrine::getTable('ExpedientesEgresados')->obtenerExpedientes($idarea);

	if ($idareasc) { 
		$derivacionescr = Doctrine::getTable('ExpedientesEgresados')->obtenerExpedientes($idareasc);
		$derivaciones = array_merge($derivacionessc, $derivacionescr);
	} else {
		$derivaciones = $derivacionessc;
	}
    
    foreach ($derivaciones as $derivacion) { 
    	if (($derivacion['idareadestino']==$idarea) or ($derivacion['idareadestino']==$idareasc) or (($derivacion['idareaorigen']==$idarea) and (($derivacion['idareadestino']==11) or ($derivacion['idareadestino']==30)))){

    		$exp = Doctrine::getTable('ExpedientesEgresados')->find($derivacion['idexpediente']);
	    	$this->expedientess[$exp->getIdexpediente()] = $exp;
	    	
			if(($exp->getIdderivacionbiblioteca()==0) && ($exp->getIdderivacionadministracion()==0)) {				
				if(($derivacion['idareaorigen']==30) or ($derivacion['idareaorigen']==11)) {
			   		$this->errores[$exp->getIdexpediente()] = 8;
				} else {
					$this->errores[$exp->getIdexpediente()] = 1;
				}
			} elseif(($exp->getIdderivacionbiblioteca()<>0) && ($exp->getIdderivacionadministracion()==0)) {
				if($derivacion['idareaorigen']==11) {
			   		$this->errores[$exp->getIdexpediente()] = 8;			   		
				} else {
					$this->errores[$exp->getIdexpediente()] = 2;
				}				
			} elseif(($exp->getIdderivacionbiblioteca()==0) && ($exp->getIdderivacionadministracion()<>0)) {
				if($derivacion['idareaorigen']==30) {
			   		$this->errores[$exp->getIdexpediente()] = 8;			   		
				} else {
					$this->errores[$exp->getIdexpediente()] = 3;
				}								
			} else {
			   	if($derivacion['idareaorigen']==29) {
	    			$this->errores[$exp->getIdexpediente()] = 5;
			   	}elseif($derivacion['idareaorigen']==31) {
			   		if (($exp->getRegistrodiplomame()=="" && $exp->getRegistrocertificadome()=="") || ($exp->getNrorecibo2()=="")) {
			   			$this->errores[$exp->getIdexpediente()] = 10;
			   		} else {
			   			$this->errores[$exp->getIdexpediente()] = 6;
			   		}			   		
		    	} else {
					if(($derivacion['idareadestino']==11) and ($derivacion['idsede']!=1)) {
						$this->errores[$exp->getIdexpediente()] = 9;
					} else {
						$this->errores[$exp->getIdexpediente()] = 0;
					}			    		
					
		    	}
			}
			$estudio = $exp->getAlumnos()->getPersonas()->getEstudiosPrevios();
			if(count($estudio)==0) {
				$this->errores[$exp->getIdexpediente()] = 4;
			}
			$plan = $exp->getAlumnos()->getPlanesEstudios();
			if($plan->getNroresolucion()=="") {
				$this->errores[$exp->getIdexpediente()] = 7;
			}
	    }
	}    
  }
    
  public function executeIndexauditoria(sfWebRequest $request)
  {  	
    $this->mensajes = array(
    	'0'=>"",	
    	'1'=>"No existen los estudios previos cargados.",
    	'2'=>"No existe el nro. de resolucion cargada.",
    	'3'=>"Falta completar el expediente."
    );  	
    $this->errores = array();
    $this->expedientess = array();  
    $this->otrosexpedientess = array();
	$idarea = $this->getUser()->getProfile()->getIdarea();
	$idsede = $this->getUser()->getProfile()->getIdsede();
    
    $derivaciones = Doctrine::getTable('ExpedientesEgresados')->obtenerExpedientes($idarea);

    foreach ($derivaciones as $derivacion) {
    	if (($derivacion['idareadestino']==29) and ($idarea==29)) {
    		$exp = Doctrine::getTable('ExpedientesEgresados')->find($derivacion['idexpediente']);
	    	$this->expedientess[$exp->getIdexpediente()] = $exp;
	    	
			if(($exp['folio']=="") or ($exp['fechainformeauditoria']=="")) {
	    		$this->errores[$exp->getIdexpediente()] = 3;
			} else {
				$this->errores[$exp->getIdexpediente()] = 0;
		    }

		    $estudio = $exp->getAlumnos()->getPersonas()->getEstudiosPrevios();
			if(count($estudio)==0) {
				$this->errores[$exp->getIdexpediente()] = 1;
			}
			$plan = $exp->getAlumnos()->getPlanesEstudios();
			if($plan->getNroresolucion()=="") {
				$this->errores[$exp->getIdexpediente()] = 2;
			}
    	}
	}    
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ExpedientesEgresadosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ExpedientesEgresadosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
  
  public function executeGuardar(sfWebRequest $request)
  {
	$arregloExpedientes = $request->getParameter('expedientes_egresados');
	
	$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($arregloExpedientes['idexpediente']);
	$oExpediente->setFolio($arregloExpedientes['folio']);
	$arr = explode('-', $arregloExpedientes['fechainformeauditoria']);
	$fechaAuditoria = $arr[2]."-".$arr[1]."-".$arr[0];
	$oExpediente->setFechainformeauditoria($fechaAuditoria);
	$oExpediente->setOtradocumentacion($arregloExpedientes['otradocumentacion']);
	$oExpediente->setObservaciones($arregloExpedientes['observaciones']);
	$oExpediente->save();
	
   	// Get a arrays
	$arregloDocumentacion = $arregloExpedientes['documentacion'];
	$this->documentaciones = Doctrine::getTable('Documentacion')
    	->createQuery('a')
		->execute();

	foreach ($this->documentaciones as $documentacion) {
		$oDocumentacionExpedientes = Doctrine_Core::getTable('DocumentacionExpedientes')->getDocumentacionExpediente($arregloExpedientes['idexpediente'], $documentacion->getIddocumentacion());
			
		if (in_array($documentacion->getIddocumentacion(), $arregloDocumentacion)) {
			if (!$oDocumentacionExpedientes) {
				// Create a object DocumentacionExpedientes
				$oDocumentacionExpedientes = new DocumentacionExpedientes();
			}

			$oDocumentacionExpedientes->setIdexpediente($arregloExpedientes['idexpediente']);
			$oDocumentacionExpedientes->setIddocumentacion($documentacion->getIddocumentacion());
			$oDocumentacionExpedientes->save();
		} else {			
			if ($oDocumentacionExpedientes) {
				$oDocumentacionExpedientes->delete();
			}
		}
	}	

	$arregloCondiciones = $arregloExpedientes['condicion'];
	$this->condiciones = Doctrine::getTable('Condiciones')
    	->createQuery('a')
		->execute();
		
	foreach ($this->condiciones as $condicion) {
		$oCondicionExpedientes = Doctrine_Core::getTable('CondicionesExpedientes')->getCondicionesExpediente($arregloExpedientes['idexpediente'], $condicion->getIdcondicion());
			
		if (in_array($condicion->getIdcondicion(), $arregloCondiciones)) {
			if (!$oCondicionExpedientes) {
				// Create a object CondicionesExpedientes
				$oCondicionExpedientes = new CondicionesExpedientes();
			}
			
			$oCondicionExpedientes->setIdexpediente($arregloExpedientes['idexpediente']);
			$oCondicionExpedientes->setIdcondicion($condicion->getIdcondicion());
			$oCondicionExpedientes->save();
		} else {			
			if ($oCondicionExpedientes) {
				$oCondicionExpedientes->delete();
			}
		}
	}	

	$this->redirect('expedientes/indexauditoria');
  }  

  public function executeGuardartitulo(sfWebRequest $request)
  {
	$arregloExpedientes = $request->getParameter('expedientes_egresados');
	$currentUser = sfContext::getInstance()->getUser();
	$idarea = $currentUser->getAttribute('id_area','');

	$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($arregloExpedientes['idexpediente']);
	$arr = explode('-', $arregloExpedientes['fechaenviome']);
	$fechaEnvio = $arr[2]."-".$arr[1]."-".$arr[0];    
	$oExpediente->setFechaenviome($fechaEnvio);

	$arr = explode('-', $arregloExpedientes['fecharecibidome']);
	$fechaRecibido = $arr[2]."-".$arr[1]."-".$arr[0];
	$oExpediente->setFecharecibidome($fechaRecibido);

	$arr = explode('-', $arregloExpedientes['fechaentregatitulo']);
	$fechaEntrega = $arr[2]."-".$arr[1]."-".$arr[0];
	$oExpediente->setFechaentregatitulo($fechaEntrega);
		
	if($oExpediente->getNrorecibo2()==""){
		$oExpediente->setNrorecibo2($arregloExpedientes['nrorecibo2']);
	}
	$oExpediente->setRegistrodiplomame($arregloExpedientes['registrodiplomame']);
	$oExpediente->setRegistrocertificadome($arregloExpedientes['registrocertificadome']);
	$oExpediente->save();
	
	$oDerivacion = new ExpedientesDerivaciones();
	
	$oDerivacion->setIdexpediente($arregloExpedientes['idexpediente']);
	$oDerivacion->setIdareaorigen($idarea);
	$oDerivacion->setIdareadestino($idarea);
	$oDerivacion->setObservaciones($arregloExpedientes['observaciones']);
	$oDerivacion->setActivo(1);
	$oDerivacion->setLeido(1);
	 	  
	$oDerivacion->save();		

	$this->redirect('expedientes/indextitulos');
  }  
    
  public function executeEditar(sfWebRequest $request)
  {
	$this->forward404Unless($expedientes_egresados = Doctrine_Core::getTable('ExpedientesEgresados')->find(array($request->getParameter('idexpediente'))), sprintf('Object expedientes_egresados does not exist (%s).', $request->getParameter('idexpediente')));
	$this->form = new ExpedientesEgresadosForm($expedientes_egresados);
	$this->form->setDefault('documentacion', $expedientes_egresados->getIdDocumentaciones());
	$this->form->setDefault('condicion', $expedientes_egresados->getIdCondiciones());
	// Guardar como leido la derivacion de la facultad
	$oDerivacion = $expedientes_egresados->obtenerUltimaDerivacion();
	$oDerivacion->setLeido(1);
	$oDerivacion->save();
	
    $this->expediente = $expedientes_egresados;
    $this->estudios = $this->expediente->getAlumnos()->getPersonas()->getEstudiosPrevios();    
  }

  public function executeRegistrartitulo(sfWebRequest $request)
  {
   	$this->expediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($request->getParameter('idexpediente'));
   	$this->form = new ExpedientesTitulosForm();
   	$this->form->setDefault('idexpediente', $this->expediente->getIdexpediente());
   	$this->form->setDefault('idalumno', $this->expediente->getIdalumno());
   	$this->form->setDefault('nrorecibo2', $this->expediente->getNrorecibo2());
   	$this->form->setDefault('fechaenviome', $this->expediente->getFechaenviome());
   	$this->form->setDefault('fecharecibidome', $this->expediente->getFecharecibidome());
   	$this->form->setDefault('fechaentregatitulo', $this->expediente->getFechaentregatitulo());
   	$this->form->setDefault('registrodiplomame', $this->expediente->getRegistrodiplomame());
   	$this->form->setDefault('registrocertificadome', $this->expediente->getRegistrocertificadome());
   	if($this->expediente->getNrorecibo1()==$this->expediente->getNrorecibo2()) {
   		$this->form->getWidget('nrorecibo2')
      		->setAttribute('disabled', 'disabled');
   	}
   	
    $this->estudios = $this->expediente->getAlumnos()->getPersonas()->getEstudiosPrevios();    
  }
    
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($expedientes_egresados = Doctrine_Core::getTable('ExpedientesEgresados')->find(array($request->getParameter('idexpediente'))), sprintf('Object expedientes_egresados does not exist (%s).', $request->getParameter('idexpediente')));
    $this->form = new ExpedientesEgresadosForm($expedientes_egresados);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($expedientes_egresados = Doctrine_Core::getTable('ExpedientesEgresados')->find(array($request->getParameter('idexpediente'))), sprintf('Object expedientes_egresados does not exist (%s).', $request->getParameter('idexpediente')));
    $expedientes_egresados->delete();

    $this->redirect('expedientes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $expedientes_egresados = $form->save();

      $this->redirect('expedientes/editar?idexpediente='.$expedientes_egresados->getIdexpediente());
    }
  }
}
