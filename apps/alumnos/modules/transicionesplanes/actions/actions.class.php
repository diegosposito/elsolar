<?php

/**
 * transicionesplanes actions.
 *
 * @package    sig
 * @subpackage transicionesplanes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transicionesplanesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->transiciones_planess = Doctrine_Core::getTable('TransicionesPlanes')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TransicionesPlanesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TransicionesPlanesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($transiciones_planes = Doctrine_Core::getTable('TransicionesPlanes')->find(array($request->getParameter('idtransicionplan'))), sprintf('Object transiciones_planes does not exist (%s).', $request->getParameter('idtransicionplan')));
    $this->form = new TransicionesPlanesForm($transiciones_planes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($transiciones_planes = Doctrine_Core::getTable('TransicionesPlanes')->find(array($request->getParameter('idtransicionplan'))), sprintf('Object transiciones_planes does not exist (%s).', $request->getParameter('idtransicionplan')));
    $this->form = new TransicionesPlanesForm($transiciones_planes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($transiciones_planes = Doctrine_Core::getTable('TransicionesPlanes')->find(array($request->getParameter('idtransicionplan'))), sprintf('Object transiciones_planes does not exist (%s).', $request->getParameter('idtransicionplan')));
    $transiciones_planes->delete();

    $this->redirect('transicionesplanes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $transiciones_planes = $form->save();

      $this->redirect('transicionesplanes/edit?idtransicionplan='.$transiciones_planes->getIdtransicionplan());
    }
  }
}
