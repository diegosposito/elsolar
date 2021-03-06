<?php

/**
 * horarios actions.
 *
 * @package    sig
 * @subpackage horarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class horariosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->horarioss = Doctrine_Core::getTable('Horarios')
      ->createQuery('a')
      ->where('a.anulado = false')
      ->execute();
  }

  public function executePersonal(sfWebRequest $request)
  {
    
    // Control del acceso al modulo para RRHH
    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("rrhh"))) 
        $this->redirect('ingreso');

    $this->personass = Doctrine_Core::getTable('Personas')
      ->createQuery('p')
      ->where('p.activo')
      ->execute();

    $this->idpersona = "";
   // $this->idmes = (int) date('m');
   // $this->idanio = date('Y');
    $this->personas_tiempos = "";

    if($request->getParameter('meses')>0)
       $this->idmes = $request->getParameter('meses');

    if($request->getParameter('anio')>0)
       $this->idanio = $request->getParameter('anio');
       
    if($request->getParameter('idpersona')>0)
        $this->idpersona = $request->getParameter('idpersona'); 

    if(!$this->idmes>0)  
      $this->idmes = (int) date('m');

    if(!$this->idanio>0)  
      $this->idanio = date('Y');


    $this->personas_tiempos = Doctrine_Core::getTable('Horarios')->obtenerTiempoTrabajadoxPeriodo($this->idpersona, $this->idmes, $this->idanio); 
      
 
  }

  public function executePersonalhoraspdf(sfWebRequest $request){

    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("rrhh"))) 
        $this->redirect('ingreso');

    $this->idpersona = "";
    $this->idmes = (int) date('m');
    $this->idanio = date('Y');
    $this->personas_tiempos = "";

    $this->idmes = $request->getParameter('idmes');
    $this->idanio =$request->getParameter('idanio');
    if ($request->getParameter('idpersona')>0)
          $this->idpersona = $request->getParameter('idpersona'); 

    switch ($request->getParameter('idmes')) {
    case '1':
        $mesactual ='Enero';
        break;
    case '2':
        $mesactual ='Febrero';
        break;
    case '3':
        $mesactual ='Marzo';
        break;
    case '4':
        $mesactual ='Abril';
        break;
    case '5':
        $mesactual ='Mayo';
        break;
    case '6':
        $mesactual ='Junio';
        break;
    case '7':
        $mesactual ='Julio';
        break;
    case '8':
        $mesactual ='Agosto';
        break;
    case '9':
        $mesactual ='Setiembre';
        break;
    case '10':
        $mesactual ='Octubre';
        break;
    case '11':
        $mesactual ='Noviembre';
        break;
    case '12':
        $mesactual ='Diciembre';
        break;           
    }    
        
    // Obtener informacion mensual para imprimir 
    $this->personas_tiempos = Doctrine_Core::getTable('Horarios')->obtenerTiempoTrabajadoxPeriodo($this->idpersona, $request->getParameter('idmes'), $request->getParameter('idanio')); 

    // pdf object
    $pdf = new PDF('P');

      // settings
    $pdf->SetFont("Times", "", 9);
    // sentencias para retirar encabezados y pie por defecto
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false); 
 
        // add a page
    $pdf->AddPage();
    $current_date = date("Y");
    $encabezado = '
      <div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
      style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/header_elsolar.png" height="70px" width="550px">
      <br><br><b>Resumen Mensual Horas Trabajadas:</b> '.$mesactual.' del '.$this->idanio.'</div>';        

    $pdf->writeHTML($encabezado, true, false, true, false, '');   
    
    $y = 48;
    $pdf->SetXY(10,$y);
    $pdf->Cell(15,5,'Persona',0,0,'C');    
    $pdf->SetXY(41,$y);
    $pdf->Cell(100,5,'Mensual',0,0,'C'); 
    $pdf->SetXY(45,$y);
    $pdf->Cell(160,5,'1er Quinc. ',0,0,'C'); 
    $pdf->SetXY(45,$y);
     $pdf->Cell(195,5,'2da Quinc. ',0,0,'C'); 
    $pdf->SetXY(45,$y);
    $y = $y + 5;    
    $contador = 1;
    
    $pdf->Line(10,$y,190,$y);
    
      foreach ($this->personas_tiempos as $pt){ 
                      
        $pdf->SetXY(0,$y-5);
            $pdf->SetXY(10,$y);
        $pdf->Cell(15,5,$pt['nombrecompleto'],0,0,'L');
        $pdf->SetXY(85,$y);        
        $pdf->Cell(100,5,$pt['hora'],0,0,'L'); 
        $pdf->SetXY(115,$y);        
        $pdf->Cell(170,5,$pt['hours_worked_first'],0,0,'L'); 
        $pdf->SetXY(135,$y);        
        $pdf->Cell(170,5,$pt['hours_worked_second'],0,0,'L');         
        $pdf->SetXY(130,$y); 

        
    
      $y = $y + 5;  
      // add a page
      if($y>=265) {
        $pdf->AddPage();
 
  
        $pdf->writeHTML($encabezado, true, false, true, false, '');   
        $y=48;

      }
  
        } // fin (foreach)  

       
    $pdf->Output('planilla.pdf', 'I');
 
    // stop symfony process
    throw new sfStopException();
        
    return sfView::NONE;
  } 

  public function executePersonalhorasdetallepdf(sfWebRequest $request){

    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("rrhh"))) 
        $this->redirect('ingreso');

    $detalle_mensual_detallado = Doctrine_Core::getTable('Horarios')->obtenerResumenMensualxPer($request->getParameter('idpersona'), $request->getParameter('idmes'), $request->getParameter('idanio'), true); 
    $detalle_mensual = Doctrine_Core::getTable('Horarios')->obtenerTiempoTrabajadoxPeriodo($request->getParameter('idpersona'), $request->getParameter('idmes'), $request->getParameter('idanio'));
    $superdetallado = Doctrine_Core::getTable('Horarios')->obtenerDetalleMensualxPerFormat($request->getParameter('idpersona'), $request->getParameter('idmes'), $request->getParameter('idanio'), false); 
  
    $horas_mensuales_trabajadas='';
    foreach ($detalle_mensual as $dm){
        $horas_mensuales_trabajadas=$dm['hora'];
        $horas_primer_quincena=$dm['hours_worked_first'];
        $horas_segunda_quincena=$dm['hours_worked_second'];
    }

    switch ($request->getParameter('idmes')) {
    case '1':
        $mesactual ='Enero';
        break;
    case '2':
        $mesactual ='Febrero';
        break;
    case '3':
        $mesactual ='Marzo';
        break;
    case '4':
        $mesactual ='Abril';
        break;
    case '5':
        $mesactual ='Mayo';
        break;
    case '6':
        $mesactual ='Junio';
        break;
    case '7':
        $mesactual ='Julio';
        break;
    case '8':
        $mesactual ='Agosto';
        break;
    case '9':
        $mesactual ='Setiembre';
        break;
    case '10':
        $mesactual ='Octubre';
        break;
    case '11':
        $mesactual ='Noviembre';
        break;
    case '12':
        $mesactual ='Diciembre';
        break;           
    }
        
    // pdf object
    $pdf = new PDF('P');

      // settings
    $pdf->SetFont("Times", "", 9);
    // sentencias para retirar encabezados y pie por defecto
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false); 
 
    // add a page
    $pdf->AddPage();
    $current_date = date("Y");
    $encabezado = '
      <div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
      style="font-size: 11;"><img src="'.$request->getRelativeUrlRoot().'/images/header_elsolar.png" height="70px" width="550px">
      <br><br><b>Resumen Mensual Horas Trabajadas:</b> '.$mesactual.' del '.$request->getParameter('idanio').'
      <br>Total mensual horas: <b>'.$horas_mensuales_trabajadas.'</b>
      1er Quinc: <b>'.$horas_primer_quincena.'</b>
      2da Quinc: <b>'.$horas_segunda_quincena.'</b>
      </div>';        
      

    $pdf->writeHTML($encabezado, true, false, true, false, '');   
    
    $y = 53;
    $pdf->SetXY(10,$y);
    $pdf->Cell(15,5,'Persona',0,0,'C');    
    $pdf->SetXY(45,$y);
    $pdf->Cell(100,5,'Fecha',0,0,'C'); 
    $pdf->SetXY(45,$y);
    $pdf->Cell(170,5,'Hs. Trabajadas',0,0,'C'); 
    $pdf->SetXY(45,$y);
    $y = $y + 5;    
    $contador = 1;
    
    $pdf->Line(10,$y,190,$y);

    // Imprimir reporte acumulado de horas trabajads por dia por persona
    
      foreach ($detalle_mensual_detallado as $dt){ 
                      
        $pdf->SetXY(0,$y-5);
            $pdf->SetXY(10,$y);
        $pdf->Cell(15,5,$dt['nombrecompleto'],0,0,'L');
        $pdf->SetXY(85,$y);        
        $pdf->Cell(100,5,$dt['date'],0,0,'L'); 
        $pdf->SetXY(125,$y);        
        $pdf->Cell(170,5,$dt['hora'],0,0,'L');        
        $pdf->SetXY(130,$y); 
        
    
        $y = $y + 5;  
        // add a page
        if($y>=265) {
          $pdf->AddPage();
          $pdf->writeHTML($encabezado, true, false, true, false, '');   
          $y=53;
        }
      } // fin (foreach) 

    // Imprimir reporte detallado de todas las entradas/salidas por dia por persona

    // add a page
    $pdf->AddPage();
    $current_date = date("Y");
    $encabezado = '
      <div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
      style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/header_elsolar.png" height="70px" width="550px">
      <br><br><b>Resumen Detallado de Ingresos/Egresos:</b> '.$mesactual.' del '.$request->getParameter('idanio').'</div>';        
      

    $pdf->writeHTML($encabezado, true, false, true, false, '');   
    
    $y = 48;
    $pdf->SetXY(10,$y);
    $pdf->Cell(15,5,'Persona',0,0,'C');    
    $pdf->SetXY(35,$y);
    $pdf->Cell(100,5,'Fecha',0,0,'C'); 
    $pdf->SetXY(46,$y);
    $pdf->Cell(170,5,'Hora Entrada',0,0,'C'); 
    $pdf->SetXY(70,$y);
    $pdf->Cell(170,5,'Hora Salida',0,0,'C'); 
    $pdf->SetXY(85,$y);
    $pdf->Cell(180,5,'Estado',0,0,'C'); 
    $pdf->SetXY(65,$y);
    $y = $y + 5;    
    $contador = 1;
    
    $pdf->Line(10,$y,190,$y);
    
      foreach ($superdetallado as $st){ 
                      
        $pdf->SetXY(0,$y-5);
            $pdf->SetXY(10,$y);
        $pdf->Cell(15,5,$st['nombrecompleto'],0,0,'L');
        $pdf->SetXY(80,$y);        
        $pdf->Cell(100,5,$st['fecha'],0,0,'L'); 
        $pdf->SetXY(122,$y);        
        $pdf->Cell(170,5,$st['horaingreso'],0,0,'L'); 
        $pdf->SetXY(150,$y);        
        $pdf->Cell(170,5,$st['horaegreso'],0,0,'L'); 
        $pdf->SetXY(169,$y);        
        $pdf->Cell(180,5,$st['estado']==0 ? 'Falta salida' :'' ,0,0,'L');       
        $pdf->SetXY(130,$y); 
        
    
        $y = $y + 5;  
        // add a page
        if($y>=265) {
          $pdf->AddPage();
          $pdf->writeHTML($encabezado, true, false, true, false, '');   
          $y=48;
        }
      } // fin (foreach) 

       
    $pdf->Output('planilladetallada.pdf', 'I');
 
    // stop symfony process
    throw new sfStopException();
        
    return sfView::NONE;
  }

  public function executeIngresar(sfWebRequest $request)
  {
    // Control de acceso de usuarios de administracion
    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("administracion"))) 
      $this->redirect('ingreso');
  }

  public function executeEntrada(sfWebRequest $request)
  {
    // Control de acceso de usuarios de administracion
    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("registro"))) 
      $this->redirect('ingreso');
  }

  public function executeSalida(sfWebRequest $request)
  {
    // Control de acceso de usuarios de administracion
    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("registro"))) 
      $this->redirect('ingreso');
  }

  public function executeRegistro(sfWebRequest $request)
  {
    // Control de acceso de usuarios de administracion
    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("registro"))) 
      $this->redirect('ingreso'); 

    if ($request->isMethod(sfRequest::POST)){
       
        $persona = Doctrine_Core::getTable('Personas')->obtenerPersonaxnrodoc($request->getParameter('display')); 
        $oPersona = Doctrine_Core::getTable('Personas')->find($persona[0]['idpersona']);
         
        if (trim($persona[0]['idpersona'])==''){
            $this->msgError = "Registro no válido, intente nuevamente!!";
        } else {
            $idultimoregistro = Doctrine_Core::getTable('Horarios')->obtenerUltimoRegistro($oPersona->getIdpersona());
        
        $ultHorario = '';
        if ($idultimoregistro<>'0')    
            $ultHorario = Doctrine_Core::getTable('Horarios')->find($idultimoregistro);
        
        $actualizar_anterior = false;
         
            // Si es entraba solo se graba el nuevo registro sin controla nada
            // Si es salida, se graba que lo controle al registro, y se busca la ultima entrada
            $oHorario = new Horarios();
            $oHorario->setIdpersona($oPersona->getIdpersona());
            $oHorario->setAnulado(false);

            if ($request->getParameter('registro')=='E')
                $oHorario->setTiporegistro(1);
            
            if ($request->getParameter('registro')=='S')
               $oHorario->setTiporegistro(0);
            
            if($request->getParameter('registro')=='E'){
              $oHorario->setControlar(false);
            }

            if($request->getParameter('registro')=='S'){
                if ($idultimoregistro<>'0') {
                    if ($ultHorario->getTiporegistro()){
                        $oHorario->setControlar(true);
                        $actualizar_anterior = true;
                    } else {
                        $oHorario->setControlar(false);
                        $actualizar_anterior = false;
                    }
                } else { // si el ultimo anterior es 0, no hubo registros previos
                    $oHorario->setControlar(false);
                    $actualizar_anterior = false;
                }
            }

            $oHorario->setObservaciones('');
            $oHorario->save();
            
            if($actualizar_anterior){
                Doctrine_Core::getTable('Horarios')->updEstadoPorRegistro($ultHorario->getId(), true);
            }
            $this->msgSuccess = "Registro ingresado correctamente!!";
        }  
    } 

    // Obtener ultimos 50 registros
    $this->horarioss = Doctrine_Core::getTable('Horarios')
      ->createQuery('a')
      ->where('a.anulado = false')
      ->orderBy('a.id DESC limit 50 ')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->horarios);
  }

  public function executeAgregarobservacion(sfWebRequest $request)
  {
   
       $this->horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id')));
       $this->persona = Doctrine_Core::getTable('Personas')->find(array( $this->horarios->getIdpersona()));
       $this->forward404Unless($this->horarios);
  }

   public function executeGuardarobservacion(sfWebRequest $request)
  {
    if ($request->isMethod('post')) {
       $horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id')));
       $horarios->setObservaciones($request->getParameter('observaciones'));
       $horarios->save();
       $this->redirect('horarios/registro?msgSuccess='.'Observaciones actualizadas correctamente!!');
    } 
  }

  public function executeVerdetalle(sfWebRequest $request)
  { 
    
    // Control del acceso al modulo para RRHH
    $currentUser = sfContext::getInstance()->getUser();
    if (!($currentUser->isAuthenticated() && $currentUser->hasCredential("rrhh"))) 
        $this->redirect('ingreso');

    $this->detalle_mensual_detallado = Doctrine_Core::getTable('Horarios')->obtenerResumenMensualxPer($request->getParameter('id'), $request->getParameter('idmes'), $request->getParameter('idanio'), true); 
    $this->detalle_mensual = Doctrine_Core::getTable('Horarios')->obtenerTiempoTrabajadoxPeriodo($request->getParameter('id'), $request->getParameter('idmes'), $request->getParameter('idanio')); 
    $this->superdetallado = Doctrine_Core::getTable('Horarios')->obtenerDetalleMensualxPerFormat($request->getParameter('id'), $request->getParameter('idmes'), $request->getParameter('idanio'), false); 
    

    $this->horas_mensuales_trabajadas=''; $this->horas_primer_quincena=$dm['hora']=''; $this->horas_segunda_quincena='';
    foreach ($this->detalle_mensual as $dm){
        $this->horas_mensuales_trabajadas=$dm['hora'];
        $this->horas_primer_quincena=$dm['hours_worked_first'];
        $this->horas_segunda_quincena=$dm['hours_worked_second'];
    }

    switch ($request->getParameter('idmes')) {
    case '1':
        $mesactual ='Enero';
        break;
    case '2':
        $mesactual ='Febrero';
        break;
    case '3':
        $mesactual ='Marzo';
        break;
    case '4':
        $mesactual ='Abril';
        break;
    case '5':
        $mesactual ='Mayo';
        break;
    case '6':
        $mesactual ='Junio';
        break;
    case '7':
        $mesactual ='Julio';
        break;
    case '8':
        $mesactual ='Agosto';
        break;
    case '9':
        $mesactual ='Setiembre';
        break;
    case '10':
        $mesactual ='Octubre';
        break;
    case '11':
        $mesactual ='Noviembre';
        break;
    case '12':
        $mesactual ='Diciembre';
        break;           
    }
    
    $this->mesactual = $mesactual;
    $this->anio = $request->getParameter('idanio');
    $this->idmes = $request->getParameter('idmes');
    $this->idpersona = $request->getParameter('id');
  
    $this->persona = Doctrine_Core::getTable('Personas')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->persona);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new HorariosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new HorariosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id'))), sprintf('Object horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new HorariosForm($horarios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id'))), sprintf('Object horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new HorariosForm($horarios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id'))), sprintf('Object horarios does not exist (%s).', $request->getParameter('id')));
    $horarios->delete();

    $this->redirect('horarios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $horarios = $form->save();

      $this->redirect('horarios/edit?id='.$horarios->getId());
    }
  }  
}
