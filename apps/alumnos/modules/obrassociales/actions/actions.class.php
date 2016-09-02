<?php

/**
 * obrassociales actions.
 *
 * @package    sig
 * @subpackage obrassociales
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class obrassocialesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->obras_socialess = Doctrine_Core::getTable('ObrasSociales')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial')));
    $this->forward404Unless($this->obras_sociales);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ObrasSocialesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ObrasSocialesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial'))), sprintf('Object obras_sociales does not exist (%s).', $request->getParameter('idobrasocial')));
    $this->form = new ObrasSocialesForm($obras_sociales);
  }

  public function executeImpresion(sfWebRequest $request){

      $obras_sociales = Doctrine_Core::getTable('ObrasSociales')
      ->createQuery('a')
      ->execute();
     
      $pdf = new PDF();

$pdf->SetFont("Times", "", 9);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false); 
 
$pdf->AddPage();
$current_date = date("Y");
$encabezado = '
      <div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
      style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/alcec3.jpg" width="550px">
      Generar recibos: '.$current_date.'</div>';        

$pdf->writeHTML($encabezado, true, false, true, false, '');   
    
$y = 60;
$pdf->SetXY(10,$y);
$pdf->Cell(10,5,'Obra Social',0,0,'C');    
$pdf->SetXY(20,$y);
$pdf->Cell(80,5,'Abrev.',0,0,'C');    
$pdf->SetXY(20,$y);
$pdf->Cell(225,5,'Fecha1',0,0,'C'); 
$pdf->SetXY(20,$y);
$pdf->Cell(280,5,'Fecha2',0,0,'C'); 
$pdf->SetXY(20,$y);
$y = $y + 5;    
$contador = 1;
    
$pdf->Line(10,$y,199,$y);
    
    foreach ($obras_sociales as $osocial){ 

        $pdf->SetXY(0,$y-5);
        $pdf->SetXY(10,$y);
        $pdf->Cell(10,5,$osocial->getDenominacion(),0,0,'L');
        $pdf->SetXY(20,$y);        
        $pdf->Cell(80,5,$estado,0,0,'L');        
        $pdf->SetXY(120,$y); 
        $pdf->Cell(10,5,$obras_sociales->getDenominacion(),0,0,'L'); 
        $pdf->SetXY(160,$y); 
        $pdf->Cell(10,5,$obras_sociales->getFechaultimoperiodo(),0,0,'L'); 
            
        $y = $y + 5;  
        // add a page
        if($y>=265) {
            $pdf->AddPage();

            $encabezado = '
              <div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
              style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/alcec3.jpg" width="550px">Generar Recibos: '.$current_date.'</div>';        
      
            $pdf->writeHTML($encabezado, true, false, true, false, '');   
            $y=60;
         }
      
      } // fin (foreach)  

       
     $pdf->Output('recibos.pdf', 'I');
 
     return sfView::NONE;
  }


  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial'))), sprintf('Object obras_sociales does not exist (%s).', $request->getParameter('idobrasocial')));
    $this->form = new ObrasSocialesForm($obras_sociales);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial'))), sprintf('Object obras_sociales does not exist (%s).', $request->getParameter('idobrasocial')));
    $obras_sociales->delete();

    $this->redirect('obrassociales/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $obras_sociales = $form->save();

      $this->redirect('obrassociales/edit?idobrasocial='.$obras_sociales->getIdobrasocial());
    }
  }
}
