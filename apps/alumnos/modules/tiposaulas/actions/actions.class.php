<?php

/**
 * tiposaulas actions.
 *
 * @package    sig
 * @subpackage tiposaulas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposaulasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_aulass = Doctrine_Core::getTable('TiposAulas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposAulasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposAulasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_aulas = Doctrine_Core::getTable('TiposAulas')->find(array($request->getParameter('idtipoaula'))), sprintf('Object tipos_aulas does not exist (%s).', $request->getParameter('idtipoaula')));
    $this->form = new TiposAulasForm($tipos_aulas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_aulas = Doctrine_Core::getTable('TiposAulas')->find(array($request->getParameter('idtipoaula'))), sprintf('Object tipos_aulas does not exist (%s).', $request->getParameter('idtipoaula')));
    $this->form = new TiposAulasForm($tipos_aulas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_aulas = Doctrine_Core::getTable('TiposAulas')->find(array($request->getParameter('idtipoaula'))), sprintf('Object tipos_aulas does not exist (%s).', $request->getParameter('idtipoaula')));
    $tipos_aulas->delete();

    $this->redirect('tiposaulas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_aulas = $form->save();

      $this->redirect('tiposaulas/edit?idtipoaula='.$tipos_aulas->getIdtipoaula());
    }
  }
}
