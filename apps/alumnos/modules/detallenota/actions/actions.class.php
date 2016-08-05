<?php

/**
 * detallenota actions.
 *
 * @package    sig
 * @subpackage detallenota
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detallenotaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {     
    $this->idescalanota = $request->getParameter('idescalanota');
    
  	if($this->idescalanota){
	  	$q = Doctrine_Core::getTable('DetalleNota')
	      ->createQuery('a')
	      ->where('a.idescalanota = ?', $this->idescalanota);
    } else {
	  	$q = Doctrine_Core::getTable('DetalleNota')
	      ->createQuery('a');
    }

     $this->pager = new sfDoctrinePager(
      'DetalleNota',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();          
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idescalanota = $request->getParameter('idescalanota');
    
  	$this->form = new DetalleNotaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DetalleNotaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  	$this->idescalanota = $request->getParameter('idescalanota');
  	
    $this->forward404Unless($detalle_nota = Doctrine_Core::getTable('DetalleNota')->find(array($request->getParameter('iddetallenota'))), sprintf('Object detalle_nota does not exist (%s).', $request->getParameter('iddetallenota')));
    $this->form = new DetalleNotaForm($detalle_nota);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($detalle_nota = Doctrine_Core::getTable('DetalleNota')->find(array($request->getParameter('iddetallenota'))), sprintf('Object detalle_nota does not exist (%s).', $request->getParameter('iddetallenota')));
    $this->form = new DetalleNotaForm($detalle_nota);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($detalle_nota = Doctrine_Core::getTable('DetalleNota')->find(array($request->getParameter('iddetallenota'))), sprintf('Object detalle_nota does not exist (%s).', $request->getParameter('iddetallenota')));
    $detalle_nota->delete();

    $this->redirect('detallenota/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $detalle_nota = $form->save();

      $this->redirect('detallenota/edit?iddetallenota='.$detalle_nota->getIddetallenota());
    }
  }
}
