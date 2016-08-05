<?php

/**
 * aulas actions.
 *
 * @package    sig
 * @subpackage aulas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class aulasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->idedificio = $request->getParameter('idedificio');
    $this->edificio = Doctrine_Core::getTable('Edificios')->find($this->idedificio);
  	if($this->idedificio){
	  	$this->aulass = Doctrine_Core::getTable('Aulas')
	      ->createQuery('a')
	      ->where('a.idedificio = ?', $this->idedificio)
	      ->execute();
    } else {
	  	$this->aulass = Doctrine_Core::getTable('Aulas')
	      ->createQuery('a')
	      ->execute();
    }      
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idedificio = $request->getParameter('idedificio');
    $this->form = new AulasForm();
    
    $this->form->setDefault('idedificio', $this->idedificio);  	
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->idedificio = $request->getParameter('idedificio');
    
  	$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AulasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($aulas = Doctrine_Core::getTable('Aulas')->find(array($request->getParameter('idaula'))), sprintf('Object aulas does not exist (%s).', $request->getParameter('idaula')));
    $this->form = new AulasForm($aulas);
    
    $this->idedificio = $aulas->getIdedificio();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($aulas = Doctrine_Core::getTable('Aulas')->find(array($request->getParameter('idaula'))), sprintf('Object aulas does not exist (%s).', $request->getParameter('idaula')));
    $this->form = new AulasForm($aulas);

    $this->processForm($request, $this->form);

    $this->idedificio = $aulas->getIdedificio();
    
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($aulas = Doctrine_Core::getTable('Aulas')->find(array($request->getParameter('idaula'))), sprintf('Object aulas does not exist (%s).', $request->getParameter('idaula')));
    $aulas->delete();

    $this->redirect('aulas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $aulas = $form->save();

      $this->redirect('aulas/edit?idaula='.$aulas->getIdaula());
    }
  }
}
