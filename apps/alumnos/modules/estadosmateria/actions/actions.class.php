<?php

/**
 * estadosmateria actions.
 *
 * @package    sig
 * @subpackage estadosmateria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadosmateriaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->estados_materias = Doctrine_Core::getTable('EstadosMateria')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EstadosMateriaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EstadosMateriaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estados_materia = Doctrine_Core::getTable('EstadosMateria')->find(array($request->getParameter('idestadomateria'))), sprintf('Object estados_materia does not exist (%s).', $request->getParameter('idestadomateria')));
    $this->form = new EstadosMateriaForm($estados_materia);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estados_materia = Doctrine_Core::getTable('EstadosMateria')->find(array($request->getParameter('idestadomateria'))), sprintf('Object estados_materia does not exist (%s).', $request->getParameter('idestadomateria')));
    $this->form = new EstadosMateriaForm($estados_materia);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($estados_materia = Doctrine_Core::getTable('EstadosMateria')->find(array($request->getParameter('idestadomateria'))), sprintf('Object estados_materia does not exist (%s).', $request->getParameter('idestadomateria')));
    $estados_materia->delete();

    $this->redirect('estadosmateria/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $estados_materia = $form->save();

      $this->redirect('estadosmateria/edit?idestadomateria='.$estados_materia->getIdestadomateria());
    }
  }
}
