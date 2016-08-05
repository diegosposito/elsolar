<?php

/**
 * titulosplanes actions.
 *
 * @package    sig
 * @subpackage titulosplanes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class titulosplanesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->idplanestudio = $request->getParameter('idplanestudio');
  	if($this->idplanestudio){
	  	$q = Doctrine_Core::getTable('TitulosPlanes')
	      ->createQuery('a')
	      ->innerjoin('a.Titulos t on a.idtitulo=t.idtitulo')
	      ->where('a.idplanestudio = ?', $this->idplanestudio)
	  	  ->orderBy('t.nombre ASC');
	    $oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
	    $this->idcarrera = $oPlanEstudio->getIdcarrera();
    } else {
	  	$q = Doctrine_Core::getTable('TitulosPlanes')
	      ->createQuery('a')
	  	  ->innerjoin('a.Titulos t on a.idtitulo=t.idtitulo')
	  	  ->orderBy('t.nombre ASC');
		$this->idcarrera = 0;
    }
    
    $this->pager = new sfDoctrinePager(
      'TitulosPlanes',
      20
    );
    $this->pager->setQuery($q);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();     
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idplanestudio = $request->getParameter('idplanestudio');
  	$this->form = new TitulosPlanesForm();
    
    $this->form->setDefault('idplanestudio', $this->idplanestudio);
  }

  public function executeCreate(sfWebRequest $request)
  {
  	$this->idplanestudio = $request->getParameter('idplanestudio');
  	$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TitulosPlanesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($titulos_planes = Doctrine_Core::getTable('TitulosPlanes')->find(array($request->getParameter('idtituloplan'))), sprintf('Object titulos_planes does not exist (%s).', $request->getParameter('idtituloplan')));
    $this->form = new TitulosPlanesForm($titulos_planes);

    $this->idcarrera = $titulos_planes->getPlanesEstudios()->getIdcarrera();
    $this->idplanestudio = $titulos_planes->getIdplanestudio();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($titulos_planes = Doctrine_Core::getTable('TitulosPlanes')->find(array($request->getParameter('idtituloplan'))), sprintf('Object titulos_planes does not exist (%s).', $request->getParameter('idtituloplan')));
    $this->form = new TitulosPlanesForm($titulos_planes);

    $this->processForm($request, $this->form);
    
    $this->idplanestudio = $materias_planes->getIdplanestudio();

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($titulos_planes = Doctrine_Core::getTable('TitulosPlanes')->find(array($request->getParameter('idtituloplan'))), sprintf('Object titulos_planes does not exist (%s).', $request->getParameter('idtituloplan')));
    $this->idplanestudio = $titulos_planes->getIdplanestudio();
    $titulos_planes->delete();

    $this->redirect('titulosplanes/index?idplanestudio='.$this->idplanestudio);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $titulos_planes = $form->save();
      $this->idplanestudio = $titulos_planes->getIdplanestudio();
      $this->redirect('titulosplanes/edit?idtituloplan='.$titulos_planes->getIdtituloplan());
    }
  }
}
