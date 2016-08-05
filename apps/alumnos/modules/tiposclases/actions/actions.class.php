<?php

/**
 * tiposclases actions.
 *
 * @package    sig
 * @subpackage tiposclases
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposclasesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_clasess = Doctrine_Core::getTable('TiposClases')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposClasesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposClasesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_clases = Doctrine_Core::getTable('TiposClases')->find(array($request->getParameter('idtipoclase'))), sprintf('Object tipos_clases does not exist (%s).', $request->getParameter('idtipoclase')));
    $this->form = new TiposClasesForm($tipos_clases);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_clases = Doctrine_Core::getTable('TiposClases')->find(array($request->getParameter('idtipoclase'))), sprintf('Object tipos_clases does not exist (%s).', $request->getParameter('idtipoclase')));
    $this->form = new TiposClasesForm($tipos_clases);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_clases = Doctrine_Core::getTable('TiposClases')->find(array($request->getParameter('idtipoclase'))), sprintf('Object tipos_clases does not exist (%s).', $request->getParameter('idtipoclase')));
    $tipos_clases->delete();

    $this->redirect('tiposclases/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_clases = $form->save();

      $this->redirect('tiposclases/edit?idtipoclase='.$tipos_clases->getIdtipoclase());
    }
  }
}
