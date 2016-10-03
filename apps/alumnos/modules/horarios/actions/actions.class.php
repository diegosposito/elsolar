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
    $this->personass = Doctrine_Core::getTable('Personas')
      ->createQuery('p')
      ->where('p.activo')
      ->execute();

    $this->idpersona = "";
    $this->idmes = (int) date('m');
    $this->idanio = date('Y');
    $this->personas_tiempos = "";

    if ($request->isMethod(sfRequest::POST)){    
        $this->idmes = $request->getParameter('meses');
        $this->idanio =$request->getParameter('anio');

        if ($request->getParameter('idpersona')>0)
           $this->idpersona = $request->getParameter('idpersona'); 
        
        $this->personas_tiempos = Doctrine_Core::getTable('Horarios')->obtenerTiempoTrabajadoxPeriodo($this->idpersona, $request->getParameter('meses'), $request->getParameter('anio')); 
        
    } 
  }

  public function executePersonalhoraspdf(sfWebRequest $request){

    $personas_tiempos = Doctrine_Core::getTable('Horarios')->obtenerTiempoTrabajadoxPeriodo(null, $request->getParameter('meses'), $request->getParameter('anio')); 

    $oAutoridades = Doctrine_Core::getTable('Autoridades')->obtenerAutoridades();

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
      <b>Autoridades:</b> '.$current_date.'</div>';        

    $pdf->writeHTML($encabezado, true, false, true, false, '');   
    
    $y = 45;
    $pdf->SetXY(10,$y);
    $pdf->Cell(15,5,'Entidad',0,0,'C');    
    $pdf->SetXY(45,$y);
    $pdf->Cell(120,5,'Autoridad',0,0,'C');    
    $y = $y + 5;    
    $contador = 1;
    
    $pdf->Line(10,$y,190,$y);
    
      foreach ($oAutoridades as $oautoridad){ 
                      
        $pdf->SetXY(0,$y-5);
            $pdf->SetXY(10,$y);
        $pdf->Cell(15,5,$oautoridad['entidad'],0,0,'L');
        $pdf->SetXY(100,$y);        
        $pdf->Cell(120,5,$oautoridad['autoridad'],0,0,'L');        
        $pdf->SetXY(130,$y); 
        
    
      $y = $y + 5;  
      // add a page
      if($y>=265) {
        $pdf->AddPage();
 
  
        $pdf->writeHTML($encabezado, true, false, true, false, '');   
        $y=60;

      }
  
        } // fin (foreach)  

       
    $pdf->Output('planilla.pdf', 'I');
 
    // stop symfony process
    throw new sfStopException();
        
    return sfView::NONE;
  } 

  public function executeIngresar(sfWebRequest $request)
  {
  }

  public function executeRegistro(sfWebRequest $request)
  {
    if ($request->isMethod(sfRequest::POST)){
       
        $persona = Doctrine_Core::getTable('Personas')->obtenerPersonaxnrodoc($request->getParameter('display')); 
        $oPersona = Doctrine_Core::getTable('Personas')->find($persona[0]['idpersona']);
         
        if (trim($persona[0]['idpersona'])==''){
            $this->msgError = "Registro no válido, intente nuevamente!!";
        } else {
            $proximo_estado = Doctrine_Core::getTable('Horarios')->obtenerProximoEstado($oPersona->getIdpersona());
            $oHorario = new Horarios();
            $oHorario->setIdpersona($oPersona->getIdpersona());
            $oHorario->setAnulado(false);
            $oHorario->setTiporegistro($proximo_estado);
            if($proximo_estado=='1'){
              $oHorario->setControlar(false);
            }
            $oHorario->setObservaciones('');
            $oHorario->save();
            
            if($proximo_estado=='0'){
                Doctrine_Core::getTable('Horarios')->updEntradaAControlar($oPersona->getIdpersona());
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
