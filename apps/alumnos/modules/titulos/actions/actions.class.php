<?php

/**
 * titulos actions.
 *
 * @package    sig
 * @subpackage titulos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class titulosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Titulos')
      ->createQuery('a')
      ->orderBy('a.nombre ASC');

    $this->pager = new sfDoctrinePager(
      'Titulos',
      20
    );
    $this->pager->setQuery($q);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();        
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TitulosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TitulosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($titulos = Doctrine_Core::getTable('Titulos')->find(array($request->getParameter('idtitulo'))), sprintf('Object titulos does not exist (%s).', $request->getParameter('idtitulo')));
    $this->form = new TitulosForm($titulos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($titulos = Doctrine_Core::getTable('Titulos')->find(array($request->getParameter('idtitulo'))), sprintf('Object titulos does not exist (%s).', $request->getParameter('idtitulo')));
    $this->form = new TitulosForm($titulos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($titulos = Doctrine_Core::getTable('Titulos')->find(array($request->getParameter('idtitulo'))), sprintf('Object titulos does not exist (%s).', $request->getParameter('idtitulo')));
    $titulos->delete();

    $this->redirect('titulos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $titulos = $form->save();

      $this->redirect('titulos/edit?idtitulo='.$titulos->getIdtitulo());
    }
  }
}
