<?php

/**
 * carreras actions.
 *
 * @package    sig
 * @subpackage carreras
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class carrerasActions extends sfActions
{
  public function executeObtenersedes(sfWebRequest $request)
  {
  	$this->sedes = Doctrine_Core::getTable('Carreras')->obtenerSedes($request->getParameter('idcarrera'));
  }
  
  public function executeObtenerplanes(sfWebRequest $request)
  {
  	$this->version = $request->getParameter('version');
  	$this->planes = Doctrine_Core::getTable('Carreras')->obtenerPlanesEstudio($request->getParameter('idcarrera'));
  }
    
  public function executeIndex(sfWebRequest $request)
  {
    $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
    
  	$q = Doctrine_Core::getTable('Carreras')
      ->createQuery('c')
      ->innerjoin('c.AreasCarrera a on c.idcarrera=a.idcarrera')
      ->where('a.idarea = ?', $idarea);
      

     $this->pager = new sfDoctrinePager(
      'Carreras',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();      
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CarrerasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CarrerasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($carreras = Doctrine_Core::getTable('Carreras')->find(array($request->getParameter('idcarrera'))), sprintf('Object carreras does not exist (%s).', $request->getParameter('idcarrera')));
    $this->form = new CarrerasForm($carreras);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($carreras = Doctrine_Core::getTable('Carreras')->find(array($request->getParameter('idcarrera'))), sprintf('Object carreras does not exist (%s).', $request->getParameter('idcarrera')));
    $this->form = new CarrerasForm($carreras);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($carreras = Doctrine_Core::getTable('Carreras')->find(array($request->getParameter('idcarrera'))), sprintf('Object carreras does not exist (%s).', $request->getParameter('idcarrera')));
    $carreras->delete();

    $this->redirect('carreras/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $carreras = $form->save();
      
      $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
      $oAreasCarrera = Doctrine_Core::getTable('AreasCarrera')->obtenerAreasCarrera($idarea, $carreras->getIdcarrera());
      if(!$oAreasCarrera){
      	$oAreasCarrera = new AreasCarrera();
      	$oAreasCarrera->setIdarea($idarea);
      	$oAreasCarrera->setIdcarrera($carreras->getIdcarrera());
      	$oAreasCarrera->save();
      }

      $this->redirect('carreras/edit?idcarrera='.$carreras->getIdcarrera());
    }
  }
}
