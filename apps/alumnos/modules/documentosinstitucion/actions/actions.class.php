<?php

/**
 * documentosinstitucion actions.
 *
 * @package    sig
 * @subpackage documentosinstitucion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentosinstitucionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

    if ($request['idareadocumento'] >0 ){
    
      $this->archivoss= Doctrine_Core::getTable('DocumentosInstitucion')
      ->createQuery('a')
      ->where('a.idareadocumento = ?', $request['idareadocumento'])
      ->orderby(nombre)
      ->execute(); 

    } else {
      
      $this->archivoss= Doctrine_Core::getTable('DocumentosInstitucion')
      ->createQuery('a')
      ->orderby(nombre)
      ->execute(); 
    }

    $this->ficheros = array();  

    foreach($this->archivoss as $archivos){
        $targetFolder = sfConfig::get('app_pathfiles_folder')."/../documentosinstitucion".'/'.$archivos->getNombre();  
         
      $image_file = 'image.png';
      switch (pathinfo($archivos->getImagefile(), PATHINFO_EXTENSION)) {
          case 'pdf':
              $image_file = 'pdf.png';
              break;
          case 'doc':
              $image_file = 'word.png';
              break;
          case 'docx':
              $image_file = 'word.png';
              break;
          case 'xls':
              $image_file = 'excel.png';
              break;        
          case 'xlsx':
              $image_file = 'excel.png';
              break;
          case 'txt':
              $image_file = 'wordpad.png';
              break; 
          case 'ppt':
              $image_file = 'ppt.png';
              break;
          case 'pptx':
              $image_file = 'ppt.png';
              break;           
      }

      $this->ficheros[] = array($archivos->getNombre(), $archivos->getImagefile(), $image_file, $archivos->getId(), $archivos->getVisible(),$archivos->getIdAreadocumento());
    
      sort($this->ficheros);
    }  
      
  }

   public function executeDeletefile(sfWebRequest $request)
  {
    // Redirige al inicio si no tiene acceso
   //   if (!$this->getUser()->getGuardUser()->getIsSuperAdmin())
   //      $this->redirect('ingreso');

       $archivo = Doctrine_Core::getTable('DocumentosInstitucion')->find(array($request['id']));

      unlink(sfConfig::get('app_pathfiles_folder')."/../documentosinstitucion".'/'.$archivo->getImagefile());

      $archivo->delete();

      return true;  

  }

  public function executeShow(sfWebRequest $request)
  {
    $this->documentos_institucion = Doctrine_Core::getTable('DocumentosInstitucion')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->documentos_institucion);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DocumentosInstitucionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DocumentosInstitucionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($documentos_institucion = Doctrine_Core::getTable('DocumentosInstitucion')->find(array($request->getParameter('id'))), sprintf('Object documentos_institucion does not exist (%s).', $request->getParameter('id')));
    $this->form = new DocumentosInstitucionForm($documentos_institucion);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($documentos_institucion = Doctrine_Core::getTable('DocumentosInstitucion')->find(array($request->getParameter('id'))), sprintf('Object documentos_institucion does not exist (%s).', $request->getParameter('id')));
    $this->form = new DocumentosInstitucionForm($documentos_institucion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($documentos_institucion = Doctrine_Core::getTable('DocumentosInstitucion')->find(array($request->getParameter('id'))), sprintf('Object documentos_institucion does not exist (%s).', $request->getParameter('id')));
    $documentos_institucion->delete();

    $this->redirect('documentosinstitucion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $documentos_institucion = $form->save();

      if ($request->getPostParameter('documentos_institucion[visible]') == 'on') {
        $documentos_institucion->setVisible(1);
      } else {
        $documentos_institucion->setVisible(0);
      }

      $idorden = intval($request->getPostParameter('documentos_institucion[idorden]'));
      $idareadocumento = intval($request->getPostParameter('documentos_institucion[idareadocumento]'));
      $documentos_institucion->setIdAreadocumento($idareadocumento);

      if (($idorden<>"") && ($idorden !== NULL) && ($idorden>0)){
            $documentos_institucion->setIdorden($idorden);
      }
      
      foreach ($request->getFiles() as $fileName) {
          if (trim($fileName['imagefile']['name'])<>'') {
              $targetFolder = sfConfig::get('app_pathfiles_folder')."/areadocumentos".'/'.$idareadocumento.'/'.$fileName['imagefile']['name'];
               move_uploaded_file($fileName['imagefile']['tmp_name'], $targetFolder);
              $documentos_institucion->setImagefile($fileName['imagefile']['name']);
          }   
      }

      $documentos_institucion ->save();


      $this->redirect('documentosinstitucion/edit?id='.$documentos_institucion->getId());
    }
  }
}
