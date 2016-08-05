<?php

/**
 * paises actions.
 *
 * @package    sig
 * @subpackage paises
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paisesActions extends sfActions
{
  public function executeObtenerprovincias(sfWebRequest $request)
  {
	$pais = Doctrine_Core::getTable('Paises')->find($request->getParameter('idpais'));
  	$this->provincias = $pais->obtenerProvincias();
  }
	public function executeIndex(sfWebRequest $request)
  {
    $this->paisess = Doctrine_Core::getTable('Paises')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PaisesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PaisesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($paises = Doctrine_Core::getTable('Paises')->find(array($request->getParameter('idpais'))), sprintf('Object paises does not exist (%s).', $request->getParameter('idpais')));
    $this->form = new PaisesForm($paises);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($paises = Doctrine_Core::getTable('Paises')->find(array($request->getParameter('idpais'))), sprintf('Object paises does not exist (%s).', $request->getParameter('idpais')));
    $this->form = new PaisesForm($paises);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($paises = Doctrine_Core::getTable('Paises')->find(array($request->getParameter('idpais'))), sprintf('Object paises does not exist (%s).', $request->getParameter('idpais')));
    $paises->delete();

    $this->redirect('paises/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $paises = $form->save();

      $this->redirect('paises/edit?idpais='.$paises->getIdpais());
    }
  }
}
