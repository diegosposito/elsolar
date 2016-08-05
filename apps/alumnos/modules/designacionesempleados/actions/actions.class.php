<?php

/**
 * designacionesempleados actions.
 *
 * @package    sig
 * @subpackage designacionesempleados
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class designacionesempleadosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {   
  	$this->idempleado = $request->getParameter('idempleado');
  	$this->empleado = Doctrine_Core::getTable('Empleados')->find($this->idempleado);
  	
  	$q = Doctrine_Core::getTable('DesignacionesEmpleados')
      ->createQuery('d')
      ->where('d.idempleado = ?', $this->idempleado);
      

     $this->pager = new sfDoctrinePager(
      'DesignacionesEmpleados',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();         
  }

  public function executeNew(sfWebRequest $request)
  {
  	$this->idempleado = $request->getParameter('idempleado');
  	
  	$this->form = new DesignacionesEmpleadosForm();
  	$this->form->setDefault('idempleado', $this->idempleado);
  	$this->form->setDefault('titulo', "");
  }

  public function executeCreate(sfWebRequest $request)
  {
    $arregloDesignaciones  = $request->getParameter('designaciones_empleados');
  	$this->idempleado = $arregloDesignaciones['idempleado'];

  	$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DesignacionesEmpleadosForm();
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  	$this->idempleado = $request->getParameter('idempleado');
  	
    $this->forward404Unless($designaciones_empleados = Doctrine_Core::getTable('DesignacionesEmpleados')->find(array($request->getParameter('id'))), sprintf('Object designaciones_empleados does not exist (%s).', $request->getParameter('id')));
    $this->form = new DesignacionesEmpleadosForm($designaciones_empleados);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($designaciones_empleados = Doctrine_Core::getTable('DesignacionesEmpleados')->find(array($request->getParameter('id'))), sprintf('Object designaciones_empleados does not exist (%s).', $request->getParameter('id')));
    $this->form = new DesignacionesEmpleadosForm($designaciones_empleados);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($designaciones_empleados = Doctrine_Core::getTable('DesignacionesEmpleados')->find(array($request->getParameter('id'))), sprintf('Object designaciones_empleados does not exist (%s).', $request->getParameter('id')));
    $idempleado = $designaciones_empleados->getIdempleado();
    $designaciones_empleados->delete();

    $this->redirect('designacionesempleados/index?idempleado='.$idempleado);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid())
    {
      $designaciones_empleados = $form->save();

      $this->redirect('designacionesempleados/edit?id='.$designaciones_empleados->getId().'&idempleado='.$designaciones_empleados->getIdempleado());
    }
  }
}
