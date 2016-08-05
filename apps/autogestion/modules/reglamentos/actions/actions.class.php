<?php

/**
 * ingreso actions.
 *
 * @package    sig
 * @subpackage ingreso
 * @author     Your name here
 * @version    
 */
class reglamentosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  
 	$this->Carreras = array();
  	$this->noticias = array();

	$user = $this->getUser();
  		
	if($user->isAuthenticated()) {
		
	  	//obtengo datos de credencial

		if($this->getUser()->hasCredential('alumno') or $this->getUser()->hasCredential('alumnoauto')) {
			$this->area = "Alumno";

		  	$this->noticias = array();
		  	if($this->getUser()->getGuardUser()){
		  		$oPerfil = $this->getUser()->getGuardUser()->getProfile();
		  		$this->Persona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());
				$this->oAlumnos = Doctrine_Core::getTable('Personas')->obtenerCarrerasActivasPersona($oPerfil->getNrodoc());
		  		
				

		  	}

		} else {

			$this->redirect("http://alumnos.ucu.edu.ar/index.php");
		}
  	} 
	
  }  

}
