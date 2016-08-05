<?php

/**
 * tiposdocumentacion actions.
 *
 * @package    sig
 * @subpackage tiposdocumentacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposdocumentacionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_documentacions = Doctrine_Core::getTable('TiposDocumentacion')
      ->createQuery('a')
      ->execute();
    
    $this->aplicable = array('0' => 'Todos', '1' => 'Alumnos argentinos', '2' => 'Alumnos extranjeros');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->tipos_documentacion = Doctrine_Core::getTable('TiposDocumentacion')->find(array($request->getParameter('idtipodocumentacion')));
    $this->forward404Unless($this->tipos_documentacion);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposDocumentacionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposDocumentacionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_documentacion = Doctrine_Core::getTable('TiposDocumentacion')->find(array($request->getParameter('idtipodocumentacion'))), sprintf('Object tipos_documentacion does not exist (%s).', $request->getParameter('idtipodocumentacion')));
    $this->form = new TiposDocumentacionForm($tipos_documentacion);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_documentacion = Doctrine_Core::getTable('TiposDocumentacion')->find(array($request->getParameter('idtipodocumentacion'))), sprintf('Object tipos_documentacion does not exist (%s).', $request->getParameter('idtipodocumentacion')));
    $this->form = new TiposDocumentacionForm($tipos_documentacion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_documentacion = Doctrine_Core::getTable('TiposDocumentacion')->find(array($request->getParameter('idtipodocumentacion'))), sprintf('Object tipos_documentacion does not exist (%s).', $request->getParameter('idtipodocumentacion')));
    $tipos_documentacion->delete();

    $this->redirect('tiposdocumentacion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_documentacion = $form->save();

      $this->redirect('tiposdocumentacion/edit?idtipodocumentacion='.$tipos_documentacion->getIdtipodocumentacion());
    }
  }
}
