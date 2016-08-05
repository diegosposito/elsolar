<?php

/**
 * carrerassede actions.
 *
 * @package    sig
 * @subpackage carrerassede
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class carrerassedeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->idcarrera = $request->getParameter('idcarrera');
    $this->carrera = Doctrine_Core::getTable('Carreras')->find($this->idcarrera);
  	if($this->idcarrera){
	  	$this->carreras_sedes = Doctrine_Core::getTable('CarrerasSede')
	      ->createQuery('a')
	      ->where('a.idcarrera = ?', $this->idcarrera)
	      ->execute();
    } else {
	  	$this->carreras_sedes = Doctrine_Core::getTable('CarrerasSede')
	      ->createQuery('a')
	      ->execute();
    }   
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idcarrera = $request->getParameter('idcarrera');
    $this->form = new CarrerasSedeForm();
    
    $this->form->setDefault('idcarrera', $this->idcarrera);  	    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->idcarrera = $request->getParameter('idcarrera');
    
  	$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CarrerasSedeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($carreras_sede = Doctrine_Core::getTable('CarrerasSede')->find(array($request->getParameter('id'))), sprintf('Object carreras_sede does not exist (%s).', $request->getParameter('id')));
    $this->form = new CarrerasSedeForm($carreras_sede);
    
    $this->idcarrera = $carreras_sede->getIdcarrera();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($carreras_sede = Doctrine_Core::getTable('CarrerasSede')->find(array($request->getParameter('id'))), sprintf('Object carreras_sede does not exist (%s).', $request->getParameter('id')));
    $this->form = new CarrerasSedeForm($carreras_sede);

    $this->processForm($request, $this->form);
    
    $this->idcarrera = $carreras_sede->getIdcarrera();

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($carreras_sede = Doctrine_Core::getTable('CarrerasSede')->find(array($request->getParameter('id'))), sprintf('Object carreras_sede does not exist (%s).', $request->getParameter('id')));
    $idcarrera = $carreras_sede->getIdcarrera();
    $carreras_sede->delete();

    $this->redirect('carrerassede/index?idcarrera='.$idcarrera);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $carreras_sede = $form->save();

      $this->redirect('carrerassede/edit?id='.$carreras_sede->getId());
    }
  }
}
