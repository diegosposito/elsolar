<?php

/**
 * condicionesesas actions.
 *
 * @package    sig
 * @subpackage condicionesmesas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class condicionesmesasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->condiciones_mesass = Doctrine_Core::getTable('CondicionesMesas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CondicionesMesasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CondicionesMesasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($condiciones_mesas = Doctrine_Core::getTable('CondicionesMesas')->find(array($request->getParameter('idcondicion'))), sprintf('Object condiciones_mesas does not exist (%s).', $request->getParameter('idcondicion')));
    $this->form = new CondicionesMesasForm($condiciones_mesas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($condiciones_mesas = Doctrine_Core::getTable('CondicionesMesas')->find(array($request->getParameter('idcondicion'))), sprintf('Object condiciones_mesas does not exist (%s).', $request->getParameter('idcondicion')));
    $this->form = new CondicionesMesasForm($condiciones_mesas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($condiciones_mesas = Doctrine_Core::getTable('CondicionesMesas')->find(array($request->getParameter('idcondicion'))), sprintf('Object condiciones_mesas does not exist (%s).', $request->getParameter('idcondicion')));
    $condiciones_mesas->delete();

    $this->redirect('condicionesmesas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $condiciones_mesas = $form->save();

      $this->redirect('condicionesmesas/edit?idcondicion='.$condiciones_mesas->getIdcondicion());
    }
  }
}
