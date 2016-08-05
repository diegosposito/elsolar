<?php

/**
 * tiposareas actions.
 *
 * @package    sig
 * @subpackage tiposareas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposareasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_areass = Doctrine_Core::getTable('TiposAreas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposAreasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposAreasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_areas = Doctrine_Core::getTable('TiposAreas')->find(array($request->getParameter('idtipoarea'))), sprintf('Object tipos_areas does not exist (%s).', $request->getParameter('idtipoarea')));
    $this->form = new TiposAreasForm($tipos_areas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_areas = Doctrine_Core::getTable('TiposAreas')->find(array($request->getParameter('idtipoarea'))), sprintf('Object tipos_areas does not exist (%s).', $request->getParameter('idtipoarea')));
    $this->form = new TiposAreasForm($tipos_areas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_areas = Doctrine_Core::getTable('TiposAreas')->find(array($request->getParameter('idtipoarea'))), sprintf('Object tipos_areas does not exist (%s).', $request->getParameter('idtipoarea')));
    $tipos_areas->delete();

    $this->redirect('tiposareas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_areas = $form->save();

      $this->redirect('tiposareas/edit?idtipoarea='.$tipos_areas->getIdtipoarea());
    }
  }
}
