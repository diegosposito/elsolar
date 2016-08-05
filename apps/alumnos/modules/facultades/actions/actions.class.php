<?php

/**
 * facultades actions.
 *
 * @package    sig
 * @subpackage facultades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facultadesActions extends sfActions
{
	
  public function executeObtenercarreras(sfWebRequest $request)
  {
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
  	
  	$this->planes = Doctrine_Core::getTable('PlanesEstudios')
		->createQuery('p')
		->innerJoin('p.Carreras c ON p.idcarrera=c.idcarrera')
		->innerJoin('c.AreasCarrera a ON c.idcarrera=a.idcarrera')
		->where('c.idfacultad='.$request->getParameter('idfacultad'))
		->andWhere('a.idarea='.$idarea)
		->andWhere('p.idestadoplan IN (2, 4)')
		->andWhere('c.idtipocarrera NOT IN (1, 2, 5, 6)')
		->orderBy('c.nombre ASC')
		->groupBy('p.idplanestudio')
		->execute();
  }
		
  public function executeGuardarparametros(sfWebRequest $request)
  {
  	$oFacultad = Doctrine_Core::getTable('Facultades')->find($request->getParameter('idfacultad'));  	
  	$carreras_sede = $oFacultad->obtenerCarrerasSedes($request->getParameter('idsede'));

  	foreach ($carreras_sede as $carrera) {
  		$carrera->setPlazocerttittramite($request->getParameter('plazo'));
  		$carrera->save(); 
  	}
  	
	$this->redirect('facultades/index');
  }
		
  public function executeRegistrar(sfWebRequest $request)
  {
	$this->form = new FacultadesSedesForm();
  }
	
  public function executeIndex(sfWebRequest $request)
  {
    $this->facultadess = Doctrine_Core::getTable('Facultades')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FacultadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FacultadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($facultades = Doctrine_Core::getTable('Facultades')->find(array($request->getParameter('idfacultad'))), sprintf('Object facultades does not exist (%s).', $request->getParameter('idfacultad')));
    $this->form = new FacultadesForm($facultades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($facultades = Doctrine_Core::getTable('Facultades')->find(array($request->getParameter('idfacultad'))), sprintf('Object facultades does not exist (%s).', $request->getParameter('idfacultad')));
    $this->form = new FacultadesForm($facultades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($facultades = Doctrine_Core::getTable('Facultades')->find(array($request->getParameter('idfacultad'))), sprintf('Object facultades does not exist (%s).', $request->getParameter('idfacultad')));
    $facultades->delete();

    $this->redirect('facultades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $facultades = $form->save();

      $this->redirect('facultades/edit?idfacultad='.$facultades->getIdfacultad());
    }
  }
}
