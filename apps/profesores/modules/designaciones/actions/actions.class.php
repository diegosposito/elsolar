<?php

/**
 * designaciones actions.
 *
 * @package    sig
 * @subpackage designaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class designacionesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
     $this->designacioness=""; $this->oPersona="";

     if ($request->getParameter('idpersona')){
         $this->oPersona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
         $this->designacioness = Doctrine_Core::getTable('Profesores')->obtenerDesignaciones($this->getUser()->getProfile()->getIdsede(),$request->getParameter('idpersona'));
     }
     
     $this->form = new BuscarProfesoresForm();
    //  $this->setTemplate('buscarprofesores');
    
  }

  public function executeObtenertiposdesignaciones(sfWebRequest $request)
  {
    
    $this->designaciones_tipos = '';
    $this->designaciones_tipos = Doctrine_Core::getTable('TiposDesignaciones')->getByCategory($request->getParameter('idcategoriadesignacion'));

  }

  public function executeObtenerresolucionessede(sfWebRequest $request)
  {

      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
      $idfacultad=''; $nombrefacultad = '';
    
     // Obtener facultad relacionada al area // debe ser una facultad
      foreach($facultades as $facultad){
          if ($idfacultad==''){
            $idfacultad= $facultad['idfacultad'];
            $nombrefacultad = $facultad['nombre'];
          } 
      }  
    
    $this->resoluciones = '';
    $this->resoluciones = Doctrine_Core::getTable('ResolucionesProfesores')->obtenerResolucionesAcademicasxSedeFacultad($request->getParameter('idsede'), $idfacultad);

  }

  public function executeObtenerresoluciones(sfWebRequest $request)
  {
    $this->resoluciones_profesores = '';
    $this->resoluciones_profesores = Doctrine_Core::getTable('ResolucionesProfesores')->obtenerResolucionesxSedePlanEstudio($request->getParameter('idsede'), $request->getParameter('idplanestudio'));
  }

  public function executeShow(sfWebRequest $request)
  {
     $this->designacioness=""; $this->oPersona="";

     if ($request->getParameter('idpersona')){
         $this->oPersona = Doctrine_Core::getTable('Personas')->find($request->getParameter('idpersona'));
         $this->designacioness = Doctrine_Core::getTable('Profesores')->obtenerDesignaciones($this->getUser()->getProfile()->getIdsede(),$request->getParameter('idpersona'));
     }
          
     $this->form = new BuscarProfesoresForm();
    //  $this->setTemplate('buscarprofesores');
  }

  public function executeObtenermaterias(sfWebRequest $request)
  {
    $planestudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
    
    // FALTA ESPECIFICAR LA SEDE PARA LA DESIGNACION
    $this->catedras = $planestudio->obtenerCatedras($this->getUser()->getProfile()->getIdsede());

  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DesignacionesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
   
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DesignacionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    $this->form = new DesignacionesProfForm($designaciones);

    // control para saber si puede editar
    $oDesignaciones = Doctrine_Core::getTable('Designaciones')->find($request->getParameter('iddesignacion'));

    if ($oDesignaciones->getIdestadodesignacion()!=1 && $oDesignaciones->getIdestadodesignacion()!=3){
          $this->redirect($this->generateUrl('default', array('module' => 'profesores',
            'action' => 'ver', 'idpersona' => $oDesignaciones->getIdPersona(), 'msgError' => 'Esta designacion no puede ser editada' )));
    }

  }


  public function executeGuardar(sfWebRequest $request)
  {
      $validar = true; $msgError='';

      if ( $request->getParameter('fechadesde')=='' || 
           $request->getParameter('fechahasta')=='' ){
       
          $validar = false;
          $msgError = 'Deben seleccionarse el rango de fechas y la fecha de aprobación.';

      }

      if ( $request->getParameter('idcatedra')=='' || $request->getParameter('idcatedra')=='0' ||
           $request->getParameter('idplanestudio')=='' || $request->getParameter('idplanestudio')=='0' || 
           $request->getParameter('idcategoriadesignacion')=='' || $request->getParameter('idcategoriadesignacion')=='0' ||
           $request->getParameter('idtipodesignacion')=='' || $request->getParameter('idtipodesignacion')=='0' ){
       
          $validar = false;
          $msgError = 'Deben seleccionarse el Plan de Estudios, la Cátedra y el Tipo de Designación.';

      } 

      $oTipoDesignacion = Doctrine_Core::getTable('TiposDesignaciones')->find($request->getParameter('idtipodesignacion'));

     /* 
	
	if ( ($request->getParameter('idcategoriadesignacion')=='1' && $request->getParameter('iddedicacion')>'1') ||
           ($request->getParameter('idcategoriadesignacion')=='2' && $request->getParameter('iddedicacion')>'1' && $oTipoDesignacion->getIdordinaria()=='2') ){
       
          $validar = false;
          $msgError = 'Solo designaciones por Concurso Ordinarias llevan dedicación';

      } */
      
      if (!$validar){

         //$msgError = Encriptar::encrypt('Error: '.$msgError, "!@#$%^&*");
         $idprofesor = Encriptar::encrypt($request->getParameter('idprofesor'), "!@#$%^&*");
        
         $this->redirect($this->generateUrl('default', array('module' => 'profesores',
'action' => 'designar', 'idprofesor' => $idprofesor, 'msgError' => $msgError)));

      }

      
      $oDesignaciones = new Designaciones();
      $oDesignaciones->setIdcatedra($request->getParameter('idcatedra'));
      $oDesignaciones->setIdprofesor($request->getParameter('idprofesor'));
      $oDesignaciones->setIdtipodesignacion($request->getParameter('idtipodesignacion'));
      $oDesignaciones->setIddedicacion($request->getParameter('iddedicacion'));
      $oDesignaciones->setObservaciones($request->getParameter('observaciones'));
      $oDesignaciones->setMotivonuevadesignacion($request->getParameter('motivonuevadesignacion'));

      if ($request->getParameter('adhonorem') == 'on')
        $oDesignaciones->setAdhonorem(1);
      else
        $oDesignaciones->setAdhonorem(0);

      if ($request->getParameter('licencia') == 'on')
        $oDesignaciones->setLicencia(1);
      else
        $oDesignaciones->setLicencia(0);

      // Estado Inicial
      $oDesignaciones->setIdestadodesignacion(1);

      $arr = explode('-', $request->getParameter('fechadesde'));
      $oDesignaciones->setInicio($arr[2]."-".$arr[1]."-".$arr[0]);

      $arr = explode('-', $request->getParameter('fechahasta'));
      $oDesignaciones->setFin($arr[2]."-".$arr[1]."-".$arr[0]);

      $oDesignaciones->setHoras($request->getParameter('hora'));
      
      // solo los usuarios de sede Central visualizan informacion de sede central
      if (sfContext::getInstance()->getUser()->getAttribute('id_sede','')=='1')
         $oDesignaciones->setVisibleensede(1);
                
      $oDesignaciones->save();

      $oProfesor = Doctrine_Core::getTable('Profesores')->find($request->getParameter('idprofesor'));
      $idpersona = $oProfesor->getIdpersona();

      $this->redirect($this->generateUrl('default', array('module' => 'profesores',
'action' => 'ver', 'idpersona' => $idpersona, 'msgSuccess' => 'Designación creada correctamente!')));
     
      //$this->redirect('profesores/ver?idpersona='.$idpersona);
    
  }

  public function executeEditar(sfWebRequest $request)
  {
      $validar = true; $msgError='';

      if ( $request->getParameter('fechadesde')=='' || 
           $request->getParameter('fechahasta')=='' ){
       
          $validar = false;
          $msgError = 'Deben seleccionarse el rango de fechas y la fecha de aprobación.';

      }

      if ( $request->getParameter('idcatedra')=='' || $request->getParameter('idcatedra')=='0' ||
           $request->getParameter('idplanestudio')=='' || $request->getParameter('idplanestudio')=='0' || 
           $request->getParameter('idcategoriadesignacion')=='' || $request->getParameter('idcategoriadesignacion')=='0' ||
           $request->getParameter('idtipodesignacion')=='' || $request->getParameter('idtipodesignacion')=='0' ){
       
          $validar = false;
          $msgError = 'Deben seleccionarse el Plan de Estudios, la Cátedra y el Tipo de Designación.';

      } 

      $oTipoDesignacion = Doctrine_Core::getTable('TiposDesignaciones')->find($request->getParameter('idtipodesignacion'));

      /*if ( ($request->getParameter('idcategoriadesignacion')=='1' && $request->getParameter('iddedicacion')>'1') ||
           ($request->getParameter('idcategoriadesignacion')=='2' && $request->getParameter('iddedicacion')>'1' && $oTipoDesignacion->getIdordinaria()=='2') ){
       
          $validar = false;
          $msgError = 'Solo designaciones por Concurso Ordinarias llevan dedicación';

      } */
      
      if (!$validar){

        $this->redirect($this->generateUrl('default', array('module' => 'profesores',
'action' => 'edit', 'iddesignacion' => $request->getParameter('iddesignacion'), 'msgError' => $msgError)));

      }

      $oDesignaciones = Doctrine_Core::getTable('Designaciones')->find($request->getParameter('iddesignacion'));
      $oDesignaciones->setIdcatedra($request->getParameter('idcatedra'));
      $oDesignaciones->setIdprofesor($request->getParameter('idprofesor'));
      $oDesignaciones->setIdtipodesignacion($request->getParameter('idtipodesignacion'));
      $oDesignaciones->setIddedicacion($request->getParameter('iddedicacion'));
      $oDesignaciones->setObservaciones($request->getParameter('observaciones'));
      $oDesignaciones->setMotivonuevadesignacion($request->getParameter('motivonuevadesignacion'));
      
      if ($request->getParameter('adhonorem') == 'on')
        $oDesignaciones->setAdhonorem(1);
      else
        $oDesignaciones->setAdhonorem(0);

      if ($request->getParameter('licencia') == 'on')
        $oDesignaciones->setLicencia(1);
      else
        $oDesignaciones->setLicencia(0);
      
      // Estado Inicial (si se edita una designacion, vuelve a su estado inicial)
      // si se edita y el usuario es Juan, podria seleccionar un cabmio de estado o q sea automatico
      $oDesignaciones->setIdestadodesignacion(1);

      $arr = explode('-', $request->getParameter('fechadesde'));
      $oDesignaciones->setInicio($arr[2]."-".$arr[1]."-".$arr[0]);

      $arr = explode('-', $request->getParameter('fechahasta'));
      $oDesignaciones->setFin($arr[2]."-".$arr[1]."-".$arr[0]);

      $oDesignaciones->setHoras($request->getParameter('hora'));

      // solo los usuarios de sede Central visualizan informacion de sede central
      if (sfContext::getInstance()->getUser()->getAttribute('id_sede','')=='1')
         $oDesignaciones->setVisibleensede(1);

                
      $oDesignaciones->save();

      $oProfesor = Doctrine_Core::getTable('Profesores')->find($request->getParameter('idprofesor'));
      $idpersona = $oProfesor->getIdpersona();
      
      $this->redirect($this->generateUrl('default', array('module' => 'profesores',
      'action' => 'ver', 'idpersona' => $idpersona, 'msgSuccess' => 'Designacion actualizada correctamente' )));

    
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    $this->form = new DesignacionesForm($designaciones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDeleteconfirmar(sfWebRequest $request)
  {
   
      $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
       
       // control para saber si puede editar
      $oDesignaciones = Doctrine_Core::getTable('Designaciones')->find($request->getParameter('iddesignacion'));
      $oProfesor = Doctrine_Core::getTable('Profesores')->find($oDesignaciones->getIdProfesor());
      
      if ($oDesignaciones->getIdestadodesignacion()!=1 && $oDesignaciones->getIdestadodesignacion()!=3){
            $this->redirect($this->generateUrl('default', array('module' => 'profesores',
              'action' => 'ver', 'idpersona' => $oProfesor->getIdPersona(), 'msgError' => 'Esta designacion no puede ser editada' )));
      }

      $this->designacion = Doctrine_Core::getTable('Designaciones')->obtenerInfoDesignacion($request->getParameter('iddesignacion'));
    
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    
    $designacioninfo = Doctrine_Core::getTable('Designaciones')->obtenerInfoDesignacion($request->getParameter('iddesignacion'));

    $designaciones->delete(); 

    $this->redirect($this->generateUrl('default', array('module' => 'profesores',
      'action' => 'ver', 'idpersona' => $designacioninfo[0]['idpersona'], 'msgSuccess' => 'Designacion eliminada correctamente' )));

  }

  public function executeReporteestados(sfWebRequest $request)
  {
  
      if (sfContext::getInstance()->getUser()->hasCredential('adminProfesores')) {
         
          // Obtener informacion de Designaciones Nuevas
          $resultado = Doctrine_Core::getTable('Designaciones')->reporteEstadosDesignaciones();

          $file = 'estados_designaciones.csv';
          $fh = fopen($file,"w+") or die ("unable to open file");

          $row = "SEDE,FACULTAD,ESTADO, CANTIDAD".","."\n";
          fwrite($fh,$row);
         
          foreach($resultado as $registro) {
            
              $row = $registro['sede'].",".$registro['facultad'].",".$registro['estado'].",".$registro['cantidad'].","."\n";
         
              fwrite($fh,$row);
          
          }

          fclose($fh); 
          
          header("Content-Type: application/vnd.ms-excel");
          header("Content-Type: application/force-download");
          header("Content-Transfer-Encoding: binary");
          header("Content-Disposition: attachment;filename=".$file );
          header("Content-Length: ".filesize($file));
          header("Pragma: no-cache");
          header("Expires: 0");
          readfile($file);
          
      }

      return sfView::NONE;

  }

  public function executeImprimir(sfWebRequest $request)
  {
    
    $this->oPersona = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('iddesignacion')));
    $this->forward404Unless($this->oPersona);
    $this->form = new ImprimirDesignacionesForm();
  }

  public function executeImprimirpdf(sfWebRequest $request)
  {
    // Controlar que la persona exista
    $oPersona = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('idpersona')));
    $this->forward404Unless($oPersona);

    // Obtener facultad por area  obtenerFacultadxdesignacion()
    $oFacultad = Doctrine_Core::getTable('Facultades')->find(Doctrine_Core::getTable('AreasCarrera')->obtenerFacultadxdesignacion());
    $this->forward404Unless($oFacultad);

    define ('PDF_HEADER_LOGO_SEDECENTRAL', 'cabeceraprofesores'.$this->getUser()->getProfile()->getIdsede().'.jpg');
   
    // Obtener fechas a mostrar en listado final en PDF
    $arrfech = $request->getParameter('fechaemision');
    $this->fechaemision = $arrfech['year']."-".$arrfech['month']."-".$arrfech['day'];
    $arrfech = $request->getParameter('fechacsu');
    $this->fechacsu = $arrfech['year']."-".$arrfech['month']."-".$arrfech['day'];
    $arrfech = $request->getParameter('fechadesde');
    $this->fechadesde = $arrfech['year']."-".$arrfech['month']."-".$arrfech['day'];
    $arrfech = $request->getParameter('fechahasta');
    $this->fechahasta = $arrfech['year']."-".$arrfech['month']."-".$arrfech['day'];

    // Obtener designaciones para el profesor seleccionado
    $designacioness = Doctrine_Core::getTable('Profesores')->obtenerDesignacionesxFecha($this->getUser()->getProfile()->getIdsede(),$oPersona->getIdPersona(),$this->fechadesde,$this->fechahasta);
    
    $this->fechadesde = date('d/m/Y',strtotime($this->fechadesde));
    $this->fechahasta = date('d/m/Y',strtotime($this->fechahasta));
    $this->fechaemision = date('d/m/Y',strtotime($this->fechaemision));
    $this->fechacsu = date('d/m/Y',strtotime($this->fechacsu));
    
    // Preparo PDF a imprimir    
    $pdf = new sfTCPDF("P","mm","LETTER");
    $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT,0);
    $pdf->SetHeaderMargin(3);
    $pdf->SetHeaderData(PDF_HEADER_LOGO_SEDECENTRAL, 190);
         
    $pdf->SetFont("Times", "", 8);

    //Obtener facultad del area
    $pdf->Cell(100,4,"facultad".$oFacultad->getNombre(),0,0,'L');
  
    //Obtener universidad del area
    $universidad = "Universidad de Concepcion del Uruguay";
    $pdf->Cell(100,4,"universidad".$universidad,0,0,'L');          

    $pdf->AddPage();  
    // Imprimir encabezado 
    $this->encabezadoimpporfec($pdf, $oPersona, $oFacultad->getNombre(), $universidad, $this->fechaemision,$this->fechacsu,$this->fechadesde,$this->fechahasta);

    $pdf->SetFont("Times", "", 12);
           
    // Recorro movimientos y genero pdf con informacion de las mismas
    foreach($designacioness as $result){
          $pdf->Ln(4);
          $pdf->Cell(10,4,"Carrera:    ".$result['carrera'],0,0,'L');
          $pdf->Ln(4); 
          $pdf->Cell(10,4,"Asignatura: ".$result['materia'],0,0,'L');
          $pdf->Ln(4);
          $pdf->Cell(10,4,"Cargo:      ".$result['descripcion'],0,0,'L');
          $current_y_position = $pdf->getY();
          $pdf->Ln(2);   
                    
          // si pasa el ancho de pagina permitido agrega nueva pagina
          if ($this->newpage($pdf, $current_y_position)){
              $current_y_position = $pdf->getY();
              $this->encabezadoimpporfec($pdf, $oPersona, $oFacultad->getNombre(), $universidad, $this->fechaemision,$this->fechacsu,$this->fechadesde,$this->fechahasta);
          }
                              
    } 
            
    $current_y_position = $pdf->getY();   

    // Pie de primer hoja
    if ($current_y_position>220){
        $pdf->AddPage();
        $pdf->Ln(18); 
        $current_y_position = $pdf->getY();
    }

    $pdf->Ln(8);
    $taldesignacion = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tal designación debe ser aceptada por usted en forma expresa. Agradeciendo vuestra estimable colaboración, me complace saludarlo/a con distinguida condiseración.';

    // get current vertical position
    $pdf->Ln(8);
    $current_y_position = $pdf->getY();

    // write the first column
    $pdf->SetFont("Times", "", 12); 
    $pdf->writeHTMLCell(180, '', '', $current_y_position, "<p align='justify'>".$taldesignacion."</p>", 0, 0, 0, false); 

    // Pie de primer hoja
    if ($current_y_position>220){
        $pdf->AddPage();
        $pdf->Ln(18); 
        $current_y_position = $pdf->getY();
    }

    $pdf->Ln(8);  
    $pdf->Cell(8,4,"".str_repeat("_",85),0,0,'L');
    $cadena3 = $oPersona->getSexo() == "1"?"Profesor":"Profesora"; 
    $pdf->Ln(28);
    $current_y_position = $pdf->getY();

    if ($current_y_position>200){
        $pdf->AddPage();
        $pdf->Ln(35);  
        $current_y_position = $pdf->getY();
    }

    $fechita = $this->fechaemision==null?date('d/m/Y'):trim($this->fechaemision);            
    $piepagina1 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;He tomado conocimiento de la nota de fecha '.$this->fechaemision.' del Sr. Decano de la '.$oFacultad->getNombre().' por la cual se me designa como '.$cadena3.' de la asignatura que arriba se detalla, por el período '.$this->fechadesde.' al '.$this->fechahasta.'. Presto mi plena conformidad a la modalidad de la designación tal como se explicita en la nota cuyo acuse de recibo y formal aceptación notifico en la presente';

    // write the first column
    $pdf->SetFont("Times", "", 12); 
    $pdf->writeHTMLCell(180, '', '', $current_y_position, "<p align='justify'>".$piepagina1."</p>", 0, 0, 0, false); 
    $pdf->Ln(35); 
    $pdf->Cell(150,4,"C. del Uruguay,         de                   de                     ",0,0,'C');
    $pdf->Ln(8);  
    $pdf->Cell(140,4,"Firma: ",0,0,'R');

    // COMIENZO HOJA NRO 2
    $pdf->AddPage();  
    // Imprimir encabezado 
    $this->encabezadoimpporfec($pdf, $oPersona, $oFacultad->getNombre(), $universidad, $this->fechaemision,$this->fechacsu,$this->fechadesde,$this->fechahasta);

    $pdf->SetFont("Times", "", 12);
           
    // Recorro movimientos y genero pdf con informacion de las mismas
    foreach($designacioness as $result){
          $pdf->Ln(4);
          $pdf->Cell(10,4,"Carrera:    ".$result['carrera'],0,0,'L');
          $pdf->Ln(4); 
          $pdf->Cell(10,4,"Asignatura: ".$result['materia'],0,0,'L');
          $pdf->Ln(4);
          $pdf->Cell(10,4,"Cargo:      ".$result['descripcion'],0,0,'L');
          $current_y_position = $pdf->getY();
          $pdf->Ln(2);   
                    
          // si pasa el ancho de pagina permitido agrega nueva pagina
          if ($this->newpage($pdf, $current_y_position)){
              $current_y_position = $pdf->getY();
              $this->encabezadoimpporfec($pdf, $oPersona, $oFacultad->getNombre(), $universidad, $this->fechaemision,$this->fechacsu,$this->fechadesde,$this->fechahasta);
          }
                              
    } 
               
    $current_y_position = $pdf->getY() + 10;   
    $pdf->Ln(18);
      
    // write the first column
    $pdf->SetFont("Times", "", 12); 
    $pdf->writeHTMLCell(180, '', '', $current_y_position, "<p align='justify'>".$taldesignacion."</p>", 0, 0, 0, false); 

    // si pasa el ancho de pagina permitido agrega nueva pagina
    if ($this->newpage($pdf, $current_y_position)){
        $current_y_position = $pdf->getY();
        $this->encabezadoimpporfec($pdf, $oPersona, $oFacultad->getNombre(), $universidad, $this->fechaemision,$this->fechacsu,$this->fechadesde,$this->fechahasta);
    }
 
    $pdf->Ln(8);  
    $pdf->Cell(8,4,"".str_repeat("_",85),0,0,'L');
            
    //  FIN HOJA NRO 2
    $pdf->Output("impresionesporfecha.pdf", "I");
     
    return sfView::NONE;    
  }

  public function newpage($pPdf, $currenty){
      // si pasa el ancho de pagina permitido agrega nueva pagina
      if ($currenty>290){
         $pPdf->AddPage();
         return true;
      }
      else
      {
        return false;
      } 
    }

  public function encabezadoimpporfec($pPdf, $oPersona, $pFacultad, $pUniversidad, $pFecha=null, $pFechacsu=null, $pFdesde=null, $pFhasta=null)
  {
      $cadena=""; 
      $nombre = $oPersona->getApellido().", ".$oPersona->getNombre()." "; 
                
      $cadena = $oPersona->getSexo() == "1"?" Profesor: ":" Profesora: ";
      $cadena2 = $oPersona->getSexo() == "1"?"Profesor":"Profesora"; 
      $tipodoc = $oPersona->getIdTipoDoc() == "1"?"D.N.I. ":"C.I. ";
              
      $first_column_width = 180;
      $current_y_position = $pPdf->getY();
      $pPdf->Ln(35); 
      $pPdf->SetFont("Times", "", 12); 
               
      if ($pFecha == null) 
          $pPdf->Cell(170,4,str_repeat(" ",40).date('d/m/Y'),0,0,'R');
        else
          $pPdf->Cell(170,4,str_repeat(" ",40).$pFecha,0,0,'R');
                     
      $pPdf->Ln(1); 
      $pPdf->SetFont("Times", "B", 12);
      $pPdf->Cell(20,4,$cadena.$nombre,0,0,'L');
      $pPdf->Ln(6); 
      $pPdf->Cell(20,4,"S                    /                      D",0,0,'L');
      $pPdf->Ln(2); 
      $pPdf->Cell(20,4,"_________________________",0,0,'L');
      $pPdf->Ln(6); 
      $pPdf->Cell(20,4,"De nuestra consideración:",0,0,'L');
      $pPdf->Ln(4); 
      $current_y_position = $pPdf->getY();

      $pPdf->Ln(4);
      $subtitle = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Me dirijo a usted a los efectos de hacerle saber que en la reunión del CSU de la  '.$pUniversidad.' de fecha '.$pFechacsu.' se le ha designado '.$cadena2.' de la '.$pFacultad.', por el período comprendido entre el '.$pFdesde.' al '.$pFhasta.' en las materias que se especifican a continuación, siendo su remuneración de acuerdo a las horas efectivamente dictadas.';

      // get current vertical position
      $current_y_position = $pPdf->getY();

    // write the first column
      $pPdf->SetFont("Times", "", 12); 
      $pPdf->writeHTMLCell($first_column_width, '', '', $current_y_position, "<p align='justify'>".$subtitle."</p>", 0, 0, 0, false); 

      $pPdf->Ln(25);
      $pPdf->SetFont("Times", "", 10);
  }

 
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
   
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
     
      $designaciones = $form->save();
      
      $this->redirect('designaciones/edit?iddesignacion='.$designaciones->getIddesignacion());
    }
  }
}
