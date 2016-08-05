<?php

/**
 * escalasnotas actions.
 *
 * @package    sig
 * @subpackage escalasnotas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class escalasnotasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->escalas_notass = Doctrine_Core::getTable('EscalasNotas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EscalasNotasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EscalasNotasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($escalas_notas = Doctrine_Core::getTable('EscalasNotas')->find(array($request->getParameter('idescalanota'))), sprintf('Object escalas_notas does not exist (%s).', $request->getParameter('idescalanota')));
    $this->form = new EscalasNotasForm($escalas_notas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($escalas_notas = Doctrine_Core::getTable('EscalasNotas')->find(array($request->getParameter('idescalanota'))), sprintf('Object escalas_notas does not exist (%s).', $request->getParameter('idescalanota')));
    $this->form = new EscalasNotasForm($escalas_notas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($escalas_notas = Doctrine_Core::getTable('EscalasNotas')->find(array($request->getParameter('idescalanota'))), sprintf('Object escalas_notas does not exist (%s).', $request->getParameter('idescalanota')));
    $escalas_notas->delete();

    $this->redirect('escalasnotas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $escalas_notas = $form->save();

      $this->redirect('escalasnotas/edit?idescalanota='.$escalas_notas->getIdescalanota());
    }
  }
}
