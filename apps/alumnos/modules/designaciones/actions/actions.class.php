<?php

/**
 * designaciones actions.
 *
 * @package    sig
 * @subpackage designaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class designacionesActions extends sfActions
{
  // Guarda la asignacion
  public function executeGuardar(sfWebRequest $request) {  
  	$arregloDesignaciones = $request->getParameter('designaciones');

	if($arregloDesignaciones['iddesignacion']) {
		$oDesignacion = Doctrine_Core::getTable('Designaciones')->find($arregloDesignaciones['iddesignacion']);
	} else {
		$oDesignacion = new Designaciones();
	}

	// Guarda la informacion de la asignacion
	$oDesignacion->setIdcatedra($arregloDesignaciones['idcatedra']);
	$oDesignacion->setIdprofesor($arregloDesignaciones['idprofesor']);
	$oDesignacion->setIdtipodesignacion($arregloDesignaciones['idtipodesignacion']);
	$arr = explode('-', $arregloDesignaciones['inicio']);
	$inicio = $arr[2]."-".$arr[1]."-".$arr[0];	
	$oDesignacion->setInicio($inicio);
	$arr = explode('-', $arregloDesignaciones['fin']);
	$fin = $arr[2]."-".$arr[1]."-".$arr[0];		
	$oDesignacion->setFin($fin);
	$arr = explode('-', $arregloDesignaciones['fechaaprobacion']);
	$fechaaprobacion = $arr[2]."-".$arr[1]."-".$arr[0];		
	$oDesignacion->setFechaaprobacion($fechaaprobacion);
	$oDesignacion->save();
	
   	echo "Se ha guardado correctamente la designación.";
   	
	return sfView::NONE;			
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->designacioness = Doctrine_Core::getTable('Designaciones')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DesignacionesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DesignacionesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    $this->form = new DesignacionesForm($designaciones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    $this->form = new DesignacionesForm($designaciones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($designaciones = Doctrine_Core::getTable('Designaciones')->find(array($request->getParameter('iddesignacion'))), sprintf('Object designaciones does not exist (%s).', $request->getParameter('iddesignacion')));
    $designaciones->delete();

    $this->redirect('designaciones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $designaciones = $form->save();

      $this->redirect('designaciones/edit?iddesignacion='.$designaciones->getIddesignacion());
    }
  }
}