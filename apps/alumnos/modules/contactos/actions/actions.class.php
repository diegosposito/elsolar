<?php

/**
 * contactos actions.
 *
 * @package    sig
 * @subpackage contactos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->contactoss = Doctrine_Core::getTable('Contactos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ContactosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContactosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contactos = Doctrine_Core::getTable('Contactos')->find(array($request->getParameter('idcontacto'))), sprintf('Object contactos does not exist (%s).', $request->getParameter('idcontacto')));
    $this->form = new ContactosForm($contactos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contactos = Doctrine_Core::getTable('Contactos')->find(array($request->getParameter('idcontacto'))), sprintf('Object contactos does not exist (%s).', $request->getParameter('idcontacto')));
    $this->form = new ContactosForm($contactos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($contactos = Doctrine_Core::getTable('Contactos')->find(array($request->getParameter('idcontacto'))), sprintf('Object contactos does not exist (%s).', $request->getParameter('idcontacto')));
    $contactos->delete();

    $this->redirect('contactos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contactos = $form->save();

      $this->redirect('contactos/edit?idcontacto='.$contactos->getIdcontacto());
    }
  }
}
