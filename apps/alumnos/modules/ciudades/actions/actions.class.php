<?php

/**
 * ciudades actions.
 *
 * @package    sig
 * @subpackage ciudades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ciudadesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ciudadess = Doctrine_Core::getTable('Ciudades')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CiudadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CiudadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ciudades = Doctrine_Core::getTable('Ciudades')->find(array($request->getParameter('idciudad'))), sprintf('Object ciudades does not exist (%s).', $request->getParameter('idciudad')));
    $this->form = new CiudadesForm($ciudades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ciudades = Doctrine_Core::getTable('Ciudades')->find(array($request->getParameter('idciudad'))), sprintf('Object ciudades does not exist (%s).', $request->getParameter('idciudad')));
    $this->form = new CiudadesForm($ciudades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ciudades = Doctrine_Core::getTable('Ciudades')->find(array($request->getParameter('idciudad'))), sprintf('Object ciudades does not exist (%s).', $request->getParameter('idciudad')));
    $ciudades->delete();

    $this->redirect('ciudades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ciudades = $form->save();

      $this->redirect('ciudades/edit?idciudad='.$ciudades->getIdciudad());
    }
  }
}
