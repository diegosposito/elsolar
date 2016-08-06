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
		if($this->getUser()->hasCredential('DesignacionesProfesores')) {
			$this->area = "DesignacionesProfesores";
		} elseif ($this->getUser()->hasCredential('DesignacionesSedes')) {
			$this->area = "DesignacionesSedes";
		} elseif ($this->getUser()->hasCredential('adminProfesores')) {
			$this->area = "adminProfesores";	
		} else {
			$current_link = "http://$_SERVER[HTTP_HOST]";
			$this->redirect($current_link."/profesores.php/logout");
		}
		$this->area = "DesignacionesSedes";
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
