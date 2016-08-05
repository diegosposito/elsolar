<?php

/**
 * tiposcorrelatividades actions.
 *
 * @package    sig
 * @subpackage tiposcorrelatividades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposcorrelatividadesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_correlatividadess = Doctrine_Core::getTable('TiposCorrelatividades')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposCorrelatividadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposCorrelatividadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_correlatividades = Doctrine_Core::getTable('TiposCorrelatividades')->find(array($request->getParameter('idtipocorrelatividad'))), sprintf('Object tipos_correlatividades does not exist (%s).', $request->getParameter('idtipocorrelatividad')));
    $this->form = new TiposCorrelatividadesForm($tipos_correlatividades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_correlatividades = Doctrine_Core::getTable('TiposCorrelatividades')->find(array($request->getParameter('idtipocorrelatividad'))), sprintf('Object tipos_correlatividades does not exist (%s).', $request->getParameter('idtipocorrelatividad')));
    $this->form = new TiposCorrelatividadesForm($tipos_correlatividades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_correlatividades = Doctrine_Core::getTable('TiposCorrelatividades')->find(array($request->getParameter('idtipocorrelatividad'))), sprintf('Object tipos_correlatividades does not exist (%s).', $request->getParameter('idtipocorrelatividad')));
    $tipos_correlatividades->delete();

    $this->redirect('tiposcorrelatividades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_correlatividades = $form->save();

      $this->redirect('tiposcorrelatividades/edit?idtipocorrelatividad='.$tipos_correlatividades->getIdtipocorrelatividad());
    }
  }
}
