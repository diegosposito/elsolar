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
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->detalle_horarios = Doctrine_Core::getTable('DetalleHorarios')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->detalle_horarios);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DetalleHorariosForm();
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
      $detalle_horarios = $form->save();

      $this->redirect('detallehorarios/edit?id='.$detalle_horarios->getId());
    }
  }
}
