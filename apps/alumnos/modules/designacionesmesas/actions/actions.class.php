<?php

/**
 * designacionesmesas actions.
 *
 * @package    sig
 * @subpackage designacionesmesas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class designacionesmesasActions extends sfActions
{
  public function executeEliminarprofesor(sfWebRequest $request)
  {
  	$oDesignacionMesa = Doctrine_Core::getTable('DesignacionesMesas')->find(array($request->getParameter('iddesignacionmesa')));

	if($oDesignacionMesa->delete()){
    	$resultado = "Se ha eliminado correctamente la designación a dicha mesa de examen.";
    }else{
    	$resultado = "No se ha podido eliminar la designación a dicha mesa de examen.";
    }
	echo $resultado;
 
	return sfView::NONE;
  }
  
  // Verificar y agregar profesor a dicha mesa de examen
  public function executeAgregarprofesor(sfWebRequest $request)
  {
	$resultado = Doctrine_Core::getTable('DesignacionesMesas')->controlarDesignacion($request->getParameter('idprofesor'), $request->getParameter('idmesaexamen'), $request->getParameter('idtipodesignacionmesa'));
	if($resultado == ""){
		$oDesignacionMesa = new DesignacionesMesas();
		$oDesignacionMesa->setIdmesaexamen($request->getParameter('idmesaexamen'));
		$oDesignacionMesa->setIdprofesor($request->getParameter('idprofesor'));
		$oDesignacionMesa->setIdtipodesignacionmesa($request->getParameter('idtipodesignacionmesa'));
		$oDesignacionMesa->setCreatedAt(date('Y-m-d H:i:s'));
		$oDesignacionMesa->setUpdatedAt(date('Y-m-d H:i:s'));
		$oDesignacionMesa->save();
				
		$resultado = "Se ha agregado correctamente la designación a dicha mesa de examen.";
	}
	echo $resultado;
 
	return sfView::NONE;
  }

  // Mostrar el formulario para designar profesores
  public function executeDesignarprofesor(sfWebRequest $request)
  {
  	$this->form = new DesignacionesMesasForm();
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->designaciones_mesass = Doctrine_Core::getTable('DesignacionesMesas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DesignacionesMesasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DesignacionesMesasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($designaciones_mesas = Doctrine_Core::getTable('DesignacionesMesas')->find(array($request->getParameter('id'))), sprintf('Object designaciones_mesas does not exist (%s).', $request->getParameter('id')));
    $this->form = new DesignacionesMesasForm($designaciones_mesas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($designaciones_mesas = Doctrine_Core::getTable('DesignacionesMesas')->find(array($request->getParameter('id'))), sprintf('Object designaciones_mesas does not exist (%s).', $request->getParameter('id')));
    $this->form = new DesignacionesMesasForm($designaciones_mesas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($designaciones_mesas = Doctrine_Core::getTable('DesignacionesMesas')->find(array($request->getParameter('id'))), sprintf('Object designaciones_mesas does not exist (%s).', $request->getParameter('id')));
    $designaciones_mesas->delete();

    $this->redirect('designacionesmesas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $designaciones_mesas = $form->save();

      $this->redirect('designacionesmesas/edit?id='.$designaciones_mesas->getId());
    }
  }
}
