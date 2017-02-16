<?php

/**
 * listahorarios actions.
 *
 * @package    sig
 * @subpackage listahorarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listahorariosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lista_horarioss = Doctrine_Core::getTable('ListaHorarios')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->lista_horarios = Doctrine_Core::getTable('ListaHorarios')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->lista_horarios);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ListaHorariosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ListaHorariosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lista_horarios = Doctrine_Core::getTable('ListaHorarios')->find(array($request->getParameter('id'))), sprintf('Object lista_horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new ListaHorariosForm($lista_horarios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lista_horarios = Doctrine_Core::getTable('ListaHorarios')->find(array($request->getParameter('id'))), sprintf('Object lista_horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new ListaHorariosForm($lista_horarios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lista_horarios = Doctrine_Core::getTable('ListaHorarios')->find(array($request->getParameter('id'))), sprintf('Object lista_horarios does not exist (%s).', $request->getParameter('id')));
    $lista_horarios->delete();

    $this->redirect('listahorarios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {

      $lista_horarios = $form->save();

      if ($request->getPostParameter('lista_horarios[activa]') == 'on') {
        $lista_horarios->setActiva(1);
      } else {
        $lista_horarios->setActiva(0);
      }
      $lista_horarios->save();
        
      $this->redirect('listahorarios/edit?id='.$lista_horarios->getId());
    }
  }
}
