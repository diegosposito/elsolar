<?php

/**
 * detalleplan actions.
 *
 * @package    sig
 * @subpackage detalleplan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detalleplanActions extends sfActions
{ 
  public function executeIndex(sfWebRequest $request)
  {
    $this->detalle_plans = Doctrine_Core::getTable('DetallePlan')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DetallePlanForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DetallePlanForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($detalle_plan = Doctrine_Core::getTable('DetallePlan')->find(array($request->getParameter('iddetalleplan'))), sprintf('Object detalle_plan does not exist (%s).', $request->getParameter('iddetalleplan')));
    $this->form = new DetallePlanForm($detalle_plan);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($detalle_plan = Doctrine_Core::getTable('DetallePlan')->find(array($request->getParameter('iddetalleplan'))), sprintf('Object detalle_plan does not exist (%s).', $request->getParameter('iddetalleplan')));
    $this->form = new DetallePlanForm($detalle_plan);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($detalle_plan = Doctrine_Core::getTable('DetallePlan')->find(array($request->getParameter('iddetalleplan'))), sprintf('Object detalle_plan does not exist (%s).', $request->getParameter('iddetalleplan')));
    $detalle_plan->delete();

    $this->redirect('detalleplan/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $detalle_plan = $form->save();

      $this->redirect('detalleplan/edit?iddetalleplan='.$detalle_plan->getIddetalleplan());
    }
  }
}
