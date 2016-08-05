<?php

/**
 * estadoscomisiones actions.
 *
 * @package    sig
 * @subpackage estadoscomisiones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadoscomisionesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->estados_comisioness = Doctrine_Core::getTable('EstadosComisiones')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EstadosComisionesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EstadosComisionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estados_comisiones = Doctrine_Core::getTable('EstadosComisiones')->find(array($request->getParameter('idestadocomision'))), sprintf('Object estados_comisiones does not exist (%s).', $request->getParameter('idestadocomision')));
    $this->form = new EstadosComisionesForm($estados_comisiones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estados_comisiones = Doctrine_Core::getTable('EstadosComisiones')->find(array($request->getParameter('idestadocomision'))), sprintf('Object estados_comisiones does not exist (%s).', $request->getParameter('idestadocomision')));
    $this->form = new EstadosComisionesForm($estados_comisiones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($estados_comisiones = Doctrine_Core::getTable('EstadosComisiones')->find(array($request->getParameter('idestadocomision'))), sprintf('Object estados_comisiones does not exist (%s).', $request->getParameter('idestadocomision')));
    $estados_comisiones->delete();

    $this->redirect('estadoscomisiones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $estados_comisiones = $form->save();

      $this->redirect('estadoscomisiones/edit?idestadocomision='.$estados_comisiones->getIdestadocomision());
    }
  }
}
