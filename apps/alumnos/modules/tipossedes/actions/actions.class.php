<?php

/**
 * tipossedes actions.
 *
 * @package    sig
 * @subpackage tipossedes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tipossedesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_sedess = Doctrine_Core::getTable('TiposSedes')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposSedesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposSedesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_sedes = Doctrine_Core::getTable('TiposSedes')->find(array($request->getParameter('idtiposede'))), sprintf('Object tipos_sedes does not exist (%s).', $request->getParameter('idtiposede')));
    $this->form = new TiposSedesForm($tipos_sedes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_sedes = Doctrine_Core::getTable('TiposSedes')->find(array($request->getParameter('idtiposede'))), sprintf('Object tipos_sedes does not exist (%s).', $request->getParameter('idtiposede')));
    $this->form = new TiposSedesForm($tipos_sedes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_sedes = Doctrine_Core::getTable('TiposSedes')->find(array($request->getParameter('idtiposede'))), sprintf('Object tipos_sedes does not exist (%s).', $request->getParameter('idtiposede')));
    $tipos_sedes->delete();

    $this->redirect('tipossedes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_sedes = $form->save();

      $this->redirect('tipossedes/edit?idtiposede='.$tipos_sedes->getIdtiposede());
    }
  }
}
