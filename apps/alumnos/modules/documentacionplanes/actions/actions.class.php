<?php

/**
 * documentacionplanes actions.
 *
 * @package    sig
 * @subpackage documentacionplanes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentacionplanesActions extends sfActions
{
  public function executeGuardar(sfWebRequest $request)
  {
  	$planes_seleccionadas = $request->getParameter('planes');
  	$idtipodocumentacion = $request->getParameter('idtipodocumentacion');
  	$documentaciones_planes = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->obtenerDocumentacionesPlanesPorTipo($idtipodocumentacion);
  	$documentaciones  = Doctrine_Core::getTable('Documentacion')->findByIdtipodocumentacion($idtipodocumentacion);
  	foreach($documentaciones_planes as $documentacion_plan) {
  		$documentacion_plan->delete();
  	}  	
  	foreach($planes_seleccionadas as $plan_estudio) {
  		foreach ($documentaciones as $documentacion){
  			$oDocumentacionPlan = new DocumentacionPlanesEstudios();
  			$oDocumentacionPlan->setIddocumentacion($documentacion->getIddocumentacion());
  			$oDocumentacionPlan->setIdplanestudio($plan_estudio);
  			$oDocumentacionPlan->setActivo(1);
  			$oDocumentacionPlan->setObligatorio(1);
  			$oDocumentacionPlan->save();
  		}
  	}
	
  	$this->redirect('documentacionplanes/index');
  }
	
  public function executeAplicar(sfWebRequest $request)
  {
	$this->form = new AplicarTiposDocumentacionForm();
		
	$this->planes_estudios = Doctrine_Query::create()
		->select('pe.*')
		->from('PlanesEstudios pe')
		->innerJoin('pe.Carreras ca ON pe.idcarrera = ca.idcarrera')
		->where('ca.idtipocarrera NOT IN (2,6,7)')
		->andWhere('pe.idestadoplan != 5')
		->orderBy('ca.nombre ASC')
		->execute();
  }	
	
  public function executeIndex(sfWebRequest $request)
  {
    $this->documentacion_planes_estudioss = Doctrine_Core::getTable('DocumentacionPlanesEstudios')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->documentacion_planes_estudios = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->documentacion_planes_estudios);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DocumentacionPlanesEstudiosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DocumentacionPlanesEstudiosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($documentacion_planes_estudios = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->find(array($request->getParameter('id'))), sprintf('Object documentacion_planes_estudios does not exist (%s).', $request->getParameter('id')));
    $this->form = new DocumentacionPlanesEstudiosForm($documentacion_planes_estudios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($documentacion_planes_estudios = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->find(array($request->getParameter('id'))), sprintf('Object documentacion_planes_estudios does not exist (%s).', $request->getParameter('id')));
    $this->form = new DocumentacionPlanesEstudiosForm($documentacion_planes_estudios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($documentacion_planes_estudios = Doctrine_Core::getTable('DocumentacionPlanesEstudios')->find(array($request->getParameter('id'))), sprintf('Object documentacion_planes_estudios does not exist (%s).', $request->getParameter('id')));
    $documentacion_planes_estudios->delete();

    $this->redirect('documentacionplanes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $documentacion_planes_estudios = $form->save();

      $this->redirect('documentacionplanes/edit?id='.$documentacion_planes_estudios->getId());
    }
  }
}
