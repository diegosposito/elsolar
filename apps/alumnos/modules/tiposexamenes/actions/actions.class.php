<?php

/**
 * tiposexamenes actions.
 *
 * @package    sig
 * @subpackage tiposexamenes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposexamenesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_exameness = Doctrine_Core::getTable('TiposExamenes')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposExamenesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposExamenesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_examenes = Doctrine_Core::getTable('TiposExamenes')->find(array($request->getParameter('idtipoexamen'))), sprintf('Object tipos_examenes does not exist (%s).', $request->getParameter('idtipoexamen')));
    $this->form = new TiposExamenesForm($tipos_examenes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_examenes = Doctrine_Core::getTable('TiposExamenes')->find(array($request->getParameter('idtipoexamen'))), sprintf('Object tipos_examenes does not exist (%s).', $request->getParameter('idtipoexamen')));
    $this->form = new TiposExamenesForm($tipos_examenes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_examenes = Doctrine_Core::getTable('TiposExamenes')->find(array($request->getParameter('idtipoexamen'))), sprintf('Object tipos_examenes does not exist (%s).', $request->getParameter('idtipoexamen')));
    $tipos_examenes->delete();

    $this->redirect('tiposexamenes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_examenes = $form->save();

      $this->redirect('tiposexamenes/edit?idtipoexamen='.$tipos_examenes->getIdtipoexamen());
    }
  }
}
