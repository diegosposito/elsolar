<?php

/**
 * historialpaciente actions.
 *
 * @package    sig
 * @subpackage historialpaciente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class historialpacienteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->historialpacientes = Doctrine_Core::getTable('Historialpaciente')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->historialpaciente = Doctrine_Core::getTable('Historialpaciente')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->historialpaciente);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new HistorialpacienteForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new HistorialpacienteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($historialpaciente = Doctrine_Core::getTable('Historialpaciente')->find(array($request->getParameter('id'))), sprintf('Object historialpaciente does not exist (%s).', $request->getParameter('id')));
    $this->form = new HistorialpacienteForm($historialpaciente);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($historialpaciente = Doctrine_Core::getTable('Historialpaciente')->find(array($request->getParameter('id'))), sprintf('Object historialpaciente does not exist (%s).', $request->getParameter('id')));
    $this->form = new HistorialpacienteForm($historialpaciente);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($historialpaciente = Doctrine_Core::getTable('Historialpaciente')->find(array($request->getParameter('id'))), sprintf('Object historialpaciente does not exist (%s).', $request->getParameter('id')));
    $historialpaciente->delete();

    $this->redirect('historialpaciente/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {  

       $es_nuevo = true;$credencial_name= ''; $imagefile_name= '';
      if ($request->getPostParameter('paciente[id]')>0)
          $es_nuevo=false;

      $historialpaciente = $form->save();
 
     // $historialpaciente->setActivo(1);

      $historialpaciente->save();

      $this->redirect('historialpaciente/edit?id='.$historialpaciente->getId());
    }
  }
}
