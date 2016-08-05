<?php

/**
 * nivelesestudios actions.
 *
 * @package    sig
 * @subpackage nivelesestudios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class nivelesestudiosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->niveles_estudioss = Doctrine_Core::getTable('NivelesEstudios')
      ->createQuery('a')
      ->execute();
  }

  public function executeObtenerniveles(sfWebRequest $request)
  {
      $this->niveles_estudios = Doctrine_Core::getTable('NivelesEstudios')->obtenerNivelesEstudios($request->getParameter('formaciondocente'));
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new NivelesEstudiosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NivelesEstudiosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($niveles_estudios = Doctrine_Core::getTable('NivelesEstudios')->find(array($request->getParameter('idnivelestudio'))), sprintf('Object niveles_estudios does not exist (%s).', $request->getParameter('idnivelestudio')));
    $this->form = new NivelesEstudiosForm($niveles_estudios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($niveles_estudios = Doctrine_Core::getTable('NivelesEstudios')->find(array($request->getParameter('idnivelestudio'))), sprintf('Object niveles_estudios does not exist (%s).', $request->getParameter('idnivelestudio')));
    $this->form = new NivelesEstudiosForm($niveles_estudios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($niveles_estudios = Doctrine_Core::getTable('NivelesEstudios')->find(array($request->getParameter('idnivelestudio'))), sprintf('Object niveles_estudios does not exist (%s).', $request->getParameter('idnivelestudio')));
    $niveles_estudios->delete();

    $this->redirect('nivelesestudios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $niveles_estudios = $form->save();

      $this->redirect('nivelesestudios/edit?idnivelestudio='.$niveles_estudios->getIdnivelestudio());
    }
  }
}
