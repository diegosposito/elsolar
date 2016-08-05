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
		
		if ($request->getParameter('idsistema')) {
			$this->idsistema = $request->getParameter('idsistema'); 
			sfContext::getInstance()->getUser()->setAttribute('id_sistema',$this->idsistema);
		} else {
			$this->idsistema = sfContext::getInstance()->getUser()->getAttribute('id_sistema');
		}
	  	//obtengo datos del usuario
		$this->usuario=$user->getUsername();
		$this->idarea = $user->getProfile()->getIdarea();
		$oAreas = Doctrine::getTable('Areas')->find($this->idarea);
		if($this->getUser()->hasCredential('alumno')) {
			$this->area = "Alumno";
		} else {
			$this->area = $oAreas->getDescripcion();
		}
  	} else {
  		$this->usuario = "";
  	}
  }  
  
  public function executeIndexfacultad(sfWebRequest $request)
  {
  	//obtengo datos del usuario
	$this->usuario=$this->getUser()->getUsername();
	$this->idarea = $this->getUser()->getAttribute('id_area');
	$oAreas = Doctrine::getTable('Areas')->find($this->idarea);
	$this->area= $oAreas->getDescripcion();
  }  
  
  public function executeError(sfWebRequest $request)
  {
    $this->msgerror = $request->getParameter('msgerror');
  }
}
