<?php

/**
 * areadocumentos actions.
 *
 * @package    sig
 * @subpackage areadocumentos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areadocumentosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->area_documentoss = Doctrine_Core::getTable('AreaDocumentos')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->area_documentos = Doctrine_Core::getTable('AreaDocumentos')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->area_documentos);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreaDocumentosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AreaDocumentosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($area_documentos = Doctrine_Core::getTable('AreaDocumentos')->find(array($request->getParameter('id'))), sprintf('Object area_documentos does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreaDocumentosForm($area_documentos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($area_documentos = Doctrine_Core::getTable('AreaDocumentos')->find(array($request->getParameter('id'))), sprintf('Object area_documentos does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreaDocumentosForm($area_documentos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($area_documentos = Doctrine_Core::getTable('AreaDocumentos')->find(array($request->getParameter('id'))), sprintf('Object area_documentos does not exist (%s).', $request->getParameter('id')));
    $area_documentos->delete();

    $this->redirect('areadocumentos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {

      $area_documentos = $form->save();
      
      $es_nuevo = true;
      if ($request->getPostParameter('areadocumentos[id]')>0) 
          $es_nuevo=false;
      
      // Si es la edicion
      if ($es_nuevo){
        
          $folder_path_name = sfConfig::get('app_pathfiles_folder')."/areadocumentos/".$area_documentos->getId();
      
          if (!is_dir($folder_path_name) && !mkdir($folder_path_name)){
              die("Error creando carpeta $uploaddir");
          }
      } 

      
      $this->redirect('areadocumentos/edit?id='.$area_documentos->getId());
    }
  }
}
