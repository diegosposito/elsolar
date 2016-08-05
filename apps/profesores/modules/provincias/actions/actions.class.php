<?php

/**
 * provincias actions.
 *
 * @package    sig
 * @subpackage provincias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class provinciasActions extends sfActions
{
  public function executeObtenerciudades(sfWebRequest $request)
  {
	$provincia = Doctrine_Core::getTable('Provincias')->find($request->getParameter('idprovincia'));
  	$this->ciudades = $provincia->obtenerCiudades();
  }
  
	public function executeIndex(sfWebRequest $request)
  {
    $this->provinciass = Doctrine_Core::getTable('Provincias')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProvinciasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProvinciasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($provincias = Doctrine_Core::getTable('Provincias')->find(array($request->getParameter('idprovincia'))), sprintf('Object provincias does not exist (%s).', $request->getParameter('idprovincia')));
    $this->form = new ProvinciasForm($provincias);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($provincias = Doctrine_Core::getTable('Provincias')->find(array($request->getParameter('idprovincia'))), sprintf('Object provincias does not exist (%s).', $request->getParameter('idprovincia')));
    $this->form = new ProvinciasForm($provincias);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($provincias = Doctrine_Core::getTable('Provincias')->find(array($request->getParameter('idprovincia'))), sprintf('Object provincias does not exist (%s).', $request->getParameter('idprovincia')));
    $provincias->delete();

    $this->redirect('provincias/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $provincias = $form->save();

      $this->redirect('provincias/edit?idprovincia='.$provincias->getIdprovincia());
    }
  }
}
