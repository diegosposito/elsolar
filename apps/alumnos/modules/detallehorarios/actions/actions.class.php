<?php

/**
 * detallehorarios actions.
 *
 * @package    sig
 * @subpackage detallehorarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detallehorariosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->detalle_horarioss = Doctrine_Core::getTable('DetalleHorarios')
      ->createQuery('a')
      ->where('a.idlistahorarios = ?', $request->getParameter('idlistahorario'))
      ->execute();

    $this->idlistahorario = $request->getParameter('idlistahorario');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->detalle_horarios = Doctrine_Core::getTable('DetalleHorarios')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->detalle_horarios);
  }

  public function executeNew(sfWebRequest $request)
  { 
    $this->idlistahorario = $request->getParameter('idlistahorario');
    $this->form = new DetalleHorariosForm(array(), array('nuevo' => true, 'idlistahorario' => $request->getParameter('idlistahorario')));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DetalleHorariosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($detalle_horarios = Doctrine_Core::getTable('DetalleHorarios')->find(array($request->getParameter('id'))), sprintf('Object detalle_horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new DetalleHorariosForm($detalle_horarios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($detalle_horarios = Doctrine_Core::getTable('DetalleHorarios')->find(array($request->getParameter('id'))), sprintf('Object detalle_horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new DetalleHorariosForm($detalle_horarios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($detalle_horarios = Doctrine_Core::getTable('DetalleHorarios')->find(array($request->getParameter('id'))), sprintf('Object detalle_horarios does not exist (%s).', $request->getParameter('id')));
    $detalle_horarios->delete();

    $this->redirect('detallehorarios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      
       foreach($request->getPostParameter('detalle_horarios[idpaciente]') as $paciente){

        $detalle_horario = new DetalleHorarios();
        $detalle_horario->setNombre($request->getPostParameter('detalle_horarios[nombre]'));
        $detalle_horario->setOrden(1);
        $detalle_horario->setIdlistahorarios($request->getPostParameter('idlistahorario'));
        $detalle_horario->setIdcentro($request->getPostParameter('detalle_horarios[idcentro]'));
        $detalle_horario->setIdprofesional($request->getPostParameter('detalle_horarios[idprofesional]'));
        $detalle_horario->setIdpaciente($paciente);
        $detalle_horario->setHdesde($request->getPostParameter('detalle_horarios[hdesde][hour]').":".$request->getPostParameter('detalle_horarios[hdesde][minute]'));
        $detalle_horario->setHhasta($request->getPostParameter('detalle_horarios[hhasta][hour]').":".$request->getPostParameter('detalle_horarios[hhasta][minute]'));
        $detalle_horario->save();
          /* $detalle_horarios = $form->save();
           $detalle_horarios->setIdlistahorarios($request->getPostParameter('idlistahorario'));
           $detalle_horarios->setIdpaciente($paciente);
           $detalle_horarios->save(); */
       }
      
      //$detalle_horarios->setIdlistahorarios($request->getPostParameter('idlistahorario'));

      //$detalle_horarios->save();
 
      $this->redirect('detallehorarios/index?idlistahorario='.$request->getPostParameter('idlistahorario'));
    }
  }
}
