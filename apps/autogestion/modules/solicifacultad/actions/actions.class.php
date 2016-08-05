<?php

/**
 * solicifacultad actions.
 *
 * @package    sig
 * @subpackage solicifacultad
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class solicifacultadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->solicitudess = Doctrine_Core::getTable('Solicitudes')
      ->createQuery('a')
      //->where('idarea = ?', $this->getUser()->getProfile()->getIdarea())
     // ->andWhere('resuelta = 0')
      ->orderby('updated_at desc')
      ->limit(300)
      ->execute();
      
     // obtener identificador de datos a mostrar -> resueltas = 1   no resueltas = 0 
     $this->id = $request->getParameter('id'); 
     
  }

  public function executeNew(sfWebRequest $request)
  {
  }

  public function executeCreate(sfWebRequest $request)
  {
    /*$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SolicitudesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $this->form = new SolicifacultadForm($solicitudes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $this->form = new SolicifacultadForm($solicitudes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    /*$request->checkCSRFProtection();

    $this->forward404Unless($solicitudes = Doctrine_Core::getTable('Solicitudes')->find(array($request->getParameter('id'))), sprintf('Object solicitudes does not exist (%s).', $request->getParameter('id')));
    $solicitudes->delete();

    $this->redirect('solicifacultad/index');*/
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $solicitudes = $form->save();

      $this->redirect('solicifacultad/edit?id='.$solicitudes->getId());
    }
  }
}
