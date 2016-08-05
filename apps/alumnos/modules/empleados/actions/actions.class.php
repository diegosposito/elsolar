<?php

/**
 * empleados actions.
 *
 * @package    sig
 * @subpackage empleados
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empleadosActions extends sfActions
{
  public function executeBuscarpersona(sfWebRequest $request)
  {
	$this->form = new BuscarEmpleadoForm(array(
		'url' => $this->url,
		'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
	));	

	if ($request->isMethod('post')) {
		$this->form->bind($request->getParameter($this->form->getName()));

		if ($this->form->isValid())	{
			$arreglo = $request->getParameter($this->form->getName());

       		$this->tipocriterio = $arreglo['tipocriterio'];
       		$this->criterio = $arreglo['criterio'];
        	
  			$this->resultado = Doctrine_Core::getTable('Empleados')->buscarEmpleados($this->tipocriterio, $this->criterio);			
		}
	} else {
		$this->resultado = array();
	}
  }
  
  public function executeIndex(sfWebRequest $request)
  {              
    $q = Doctrine_Core::getTable('Empleados')
      ->createQuery('a')
      ->innerjoin('a.Personas p on a.idpersona=p.idpersona')
      ->orderBy('p.apellido ASC, p.nombre ASC');
      
     $this->pager = new sfDoctrinePager(
      'Empleados',
      15
     );
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();        
  }
  
  public function executeNew(sfWebRequest $request)
  {
	// Se obtiene la persona
	$this->persona = Doctrine::getTable('Personas')->find($request->getParameter('idpersona'));
  	
  	$this->form = new EmpleadosForm();
    $this->form->setDefault('idpersona', $request->getParameter('idpersona'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EmpleadosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $empleados = Doctrine_Core::getTable('Empleados')->find($request->getParameter('idempleado'));
    // Se obtiene la persona
	$this->persona = Doctrine::getTable('Personas')->find($empleados->getIdpersona());
    
    $this->form = new EmpleadosForm($empleados);
  }
  
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($empleados = Doctrine_Core::getTable('Empleados')->find(array($request->getParameter('idempleado'))), sprintf('Object empleados does not exist (%s).', $request->getParameter('idempleado')));
    $this->form = new EmpleadosForm($empleados);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
    
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $empleados = $form->save();

      $this->redirect('empleados/edit?idempleado='.$empleados->getIdempleado());
    }
  }
}
