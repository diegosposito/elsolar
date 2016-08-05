<?php

/**
 * encuestasalumnos actions.
 *
 * @package    sig
 * @subpackage encuestasalumnos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class encuestasalumnosActions extends sfActions
{
	// Guarda la entrega de la encuesta
	public function executeGuardar(sfWebRequest $request)
	{
		$arregloEntrega = $request->getParameter('encuestas_alumnos');

		// Guarda la informacion de la entrega		
		if ($arregloEntrega['id']) {
			$oEntrega  = Doctrine::getTable('EncuestasAlumnos')->find($arregloEntrega['id']);
		} else {
			$oEntrega = new EncuestasAlumnos();
		}
	
		$oEntrega->setIdalumno($arregloEntrega['idalumno']);
		$oEntrega->setIdencuesta($arregloEntrega['idencuesta']);
		$arr = explode('-', $arregloEntrega['fecha']);
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		$oEntrega->setFecha($fecha);
		$oEntrega->save();
	
		echo "Se ha guardado correctamente la entrega.";
		
		return sfView::NONE;
	}
		
  public function executeRegistrarencuesta(sfWebRequest $request)	
  {
	
  }

  public function executeEncuestasentregadas(sfWebRequest $request)
  {
  	// Busco el alumno
  	$this->alumno = Doctrine::getTable('Alumnos')->find($request->getParameter('idalumno'));
  
  	$this->encuestas_alumnoss = Doctrine_Core::getTable('EncuestasAlumnos')
  		->createQuery('ea')
  		->where('ea.idalumno='.$request->getParameter('idalumno'))
  		->execute();
  }
  
  public function executeIndex(sfWebRequest $request)
  {
	$this->encuestas_alumnoss = Doctrine_Core::getTable('EncuestasAlumnos')
  		->createQuery('ea')
  		->execute();  		
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->encuestas_alumnos = Doctrine_Core::getTable('EncuestasAlumnos')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->encuestas_alumnos);
  }

  public function executeNew(sfWebRequest $request)
  {
  	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	$fecha = date('d-m-Y');
  	
  	$this->form = new EncuestasAlumnosForm();
  	$this->form->setDefault('fecha', $fecha);
  	$this->form->setDefault('idalumno', $this->alumno->getIdalumno());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EncuestasAlumnosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  	$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
  	 
    $this->forward404Unless($encuestas_alumnos = Doctrine_Core::getTable('EncuestasAlumnos')->find(array($request->getParameter('id'))), sprintf('Object encuestas_alumnos does not exist (%s).', $request->getParameter('id')));
    $this->form = new EncuestasAlumnosForm($encuestas_alumnos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($encuestas_alumnos = Doctrine_Core::getTable('EncuestasAlumnos')->find(array($request->getParameter('id'))), sprintf('Object encuestas_alumnos does not exist (%s).', $request->getParameter('id')));
    $this->form = new EncuestasAlumnosForm($encuestas_alumnos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($encuestas_alumnos = Doctrine_Core::getTable('EncuestasAlumnos')->find(array($request->getParameter('id'))), sprintf('Object encuestas_alumnos does not exist (%s).', $request->getParameter('id')));
    $idalumno = $encuestas_alumnos->getIdalumno();
    $encuestas_alumnos->delete();

    $this->redirect('encuestasalumnos/index?idalumno='.$idalumno);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $encuestas_alumnos = $form->save();

      $this->redirect('encuestasalumnos/edit?id='.$encuestas_alumnos->getId());
    }
  }
}
