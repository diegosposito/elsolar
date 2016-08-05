<?php

/**
 * materias actions.
 *
 * @package    sig
 * @subpackage materias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materiasActions extends sfActions
{   
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Materias')
      ->createQuery('a');

     $this->pager = new sfDoctrinePager(
      'Materias',
      20
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();         
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MateriasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MateriasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($materias = Doctrine_Core::getTable('Materias')->find(array($request->getParameter('idmateria'))), sprintf('Object materias does not exist (%s).', $request->getParameter('idmateria')));
    $this->form = new MateriasForm($materias);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($materias = Doctrine_Core::getTable('Materias')->find(array($request->getParameter('idmateria'))), sprintf('Object materias does not exist (%s).', $request->getParameter('idmateria')));
    $this->form = new MateriasForm($materias);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($materias = Doctrine_Core::getTable('Materias')->find(array($request->getParameter('idmateria'))), sprintf('Object materias does not exist (%s).', $request->getParameter('idmateria')));
    $materias->delete();

    $this->redirect('materias/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $materias = $form->save();

      $this->redirect('materias/edit?idmateria='.$materias->getIdmateria());
    }
  }
}