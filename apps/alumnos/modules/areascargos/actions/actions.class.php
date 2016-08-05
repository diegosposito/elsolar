<?php

/**
 * areascargos actions.
 *
 * @package    sig
 * @subpackage areascargos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areascargosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->areas_cargoss = Doctrine_Core::getTable('AreasCargos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreasCargosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AreasCargosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($areas_cargos = Doctrine_Core::getTable('AreasCargos')->find(array($request->getParameter('id'))), sprintf('Object areas_cargos does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreasCargosForm($areas_cargos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($areas_cargos = Doctrine_Core::getTable('AreasCargos')->find(array($request->getParameter('id'))), sprintf('Object areas_cargos does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreasCargosForm($areas_cargos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($areas_cargos = Doctrine_Core::getTable('AreasCargos')->find(array($request->getParameter('id'))), sprintf('Object areas_cargos does not exist (%s).', $request->getParameter('id')));
    $areas_cargos->delete();

    $this->redirect('areascargos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $areas_cargos = $form->save();

      $this->redirect('areascargos/edit?id='.$areas_cargos->getId());
    }
  }
}
