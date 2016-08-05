<?php

/**
 * tiposmaterias actions.
 *
 * @package    sig
 * @subpackage tiposmaterias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposmateriasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_materiass = Doctrine_Core::getTable('TiposMaterias')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposMateriasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposMateriasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_materias = Doctrine_Core::getTable('TiposMaterias')->find(array($request->getParameter('idtipomateria'))), sprintf('Object tipos_materias does not exist (%s).', $request->getParameter('idtipomateria')));
    $this->form = new TiposMateriasForm($tipos_materias);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_materias = Doctrine_Core::getTable('TiposMaterias')->find(array($request->getParameter('idtipomateria'))), sprintf('Object tipos_materias does not exist (%s).', $request->getParameter('idtipomateria')));
    $this->form = new TiposMateriasForm($tipos_materias);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_materias = Doctrine_Core::getTable('TiposMaterias')->find(array($request->getParameter('idtipomateria'))), sprintf('Object tipos_materias does not exist (%s).', $request->getParameter('idtipomateria')));
    $tipos_materias->delete();

    $this->redirect('tiposmaterias/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_materias = $form->save();

      $this->redirect('tiposmaterias/edit?idtipomateria='.$tipos_materias->getIdtipomateria());
    }
  }
}
