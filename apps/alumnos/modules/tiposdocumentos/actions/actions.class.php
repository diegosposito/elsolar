<?php

/**
 * tiposdocumentos actions.
 *
 * @package    sig
 * @subpackage tiposdocumentos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposdocumentosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_documentoss = Doctrine_Core::getTable('TiposDocumentos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposDocumentosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposDocumentosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_documentos = Doctrine_Core::getTable('TiposDocumentos')->find(array($request->getParameter('idtipodoc'))), sprintf('Object tipos_documentos does not exist (%s).', $request->getParameter('idtipodoc')));
    $this->form = new TiposDocumentosForm($tipos_documentos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_documentos = Doctrine_Core::getTable('TiposDocumentos')->find(array($request->getParameter('idtipodoc'))), sprintf('Object tipos_documentos does not exist (%s).', $request->getParameter('idtipodoc')));
    $this->form = new TiposDocumentosForm($tipos_documentos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_documentos = Doctrine_Core::getTable('TiposDocumentos')->find(array($request->getParameter('idtipodoc'))), sprintf('Object tipos_documentos does not exist (%s).', $request->getParameter('idtipodoc')));
    $tipos_documentos->delete();

    $this->redirect('tiposdocumentos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_documentos = $form->save();

      $this->redirect('tiposdocumentos/edit?idtipodoc='.$tipos_documentos->getIdtipodoc());
    }
  }
}
