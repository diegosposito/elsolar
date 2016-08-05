<?php

/**
 * tiposcargos actions.
 *
 * @package    sig
 * @subpackage tiposcargos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposcargosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_cargoss = Doctrine_Core::getTable('TiposCargos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposCargosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposCargosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_cargos = Doctrine_Core::getTable('TiposCargos')->find(array($request->getParameter('idtipocargo'))), sprintf('Object tipos_cargos does not exist (%s).', $request->getParameter('idtipocargo')));
    $this->form = new TiposCargosForm($tipos_cargos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_cargos = Doctrine_Core::getTable('TiposCargos')->find(array($request->getParameter('idtipocargo'))), sprintf('Object tipos_cargos does not exist (%s).', $request->getParameter('idtipocargo')));
    $this->form = new TiposCargosForm($tipos_cargos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_cargos = Doctrine_Core::getTable('TiposCargos')->find(array($request->getParameter('idtipocargo'))), sprintf('Object tipos_cargos does not exist (%s).', $request->getParameter('idtipocargo')));
    $tipos_cargos->delete();

    $this->redirect('tiposcargos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_cargos = $form->save();

      $this->redirect('tiposcargos/edit?idtipocargo='.$tipos_cargos->getIdtipocargo());
    }
  }
}
