<?php

/**
 * ingreso actions.
 *
 * @package    sig
 * @subpackage ingreso
 * @author     Your name here
 * @version    
 */
class ingresoActions extends sfActions
{		
    public function executeIndex(sfWebRequest $request)
  {
	$user = $this->getUser();



	if($user->isAuthenticated()) {
		//obtengo datos del usuario
		$this->usuario=$user->getUsername();
		$this->idarea = $user->getProfile()->getIdarea();
		$oAreas = Doctrine::getTable('Areas')->find(1);
		$this->area = "Alumno";
  	} else {
  		$this->usuario = "";
  	}
  }  
  
  public function executeIndexfacultad(sfWebRequest $request)
  {
  	//obtengo datos del usuario
	$this->usuario=$this->getUser()->getUsername();
	$this->idarea = 1;
	$oAreas = Doctrine::getTable('Areas')->find($this->idarea);
	$this->area= $oAreas->getDescripcion();
  }  
  
  public function executeError(sfWebRequest $request)
  {
    $this->msgerror = $request->getParameter('msgerror');
  }
}
