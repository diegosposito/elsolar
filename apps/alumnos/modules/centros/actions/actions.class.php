<?php

/**
 * centros actions.
 *
 * @package    sig
 * @subpackage centros
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class centrosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->centross = Doctrine_Core::getTable('Centros')
      ->createQuery('a')
      ->orderBy('a.descripcion')
      ->execute();
  }

  public function executeVerconfiguracion(sfWebRequest $request)
  {
   
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->centros = Doctrine_Core::getTable('Centros')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->centros);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CentrosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CentrosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($centros = Doctrine_Core::getTable('Centros')->find(array($request->getParameter('id'))), sprintf('Object centros does not exist (%s).', $request->getParameter('id')));
    $this->form = new CentrosForm($centros);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($centros = Doctrine_Core::getTable('Centros')->find(array($request->getParameter('id'))), sprintf('Object centros does not exist (%s).', $request->getParameter('id')));
    $this->form = new CentrosForm($centros);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($centros = Doctrine_Core::getTable('Centros')->find(array($request->getParameter('id'))), sprintf('Object centros does not exist (%s).', $request->getParameter('id')));
    $centros->delete();

    $this->redirect('centros/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $centros = $form->save();

      if ($request->getPostParameter('centros[activo]') == 'on') {
        $centros->setActivo(1);
      } else {
        $centros->setActivo(0);
      }
      $centros->save();

      $this->redirect('centros/edit?id='.$centros->getId());
    }
  }
}
