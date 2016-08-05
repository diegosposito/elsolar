<?php

/**
 * facultad actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendarActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$user = $this->getUser();
	if($user->isAuthenticated()) {
	  	//obtengo datos de credencial
		if($this->getUser()->hasCredential('alumno') or $this->getUser()->hasCredential('alumnoauto')) {
			$this->area = "Alumno";
		  	$this->noticias = array();
		  	if($this->getUser()->getGuardUser()){
		  		$oPerfil = $this->getUser()->getGuardUser()->getProfile();
		  		$this->Persona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());
				$this->Carreras = Doctrine_Core::getTable('Personas')->obtenerCarrerasActivasPersona($oPerfil->getNrodoc());
				$this->idSede= $oPerfil->getIdsede();
		  	}
		} 
  	} 
  }
}
