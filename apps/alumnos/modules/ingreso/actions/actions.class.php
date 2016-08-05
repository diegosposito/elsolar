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
	$this->idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
	
	if($user->isAuthenticated()) {
		if ($request->getParameter('idsistema')) {
			$this->idsistema = $request->getParameter('idsistema'); 
			sfContext::getInstance()->getUser()->setAttribute('id_sistema',$this->idsistema);
		} else {
			$this->idsistema = sfContext::getInstance()->getUser()->getAttribute('id_sistema');
		}
	  	//obtengo datos del usuario
		$this->usuario=$user->getUsername();
		//$this->idarea = $user->getProfile()->getIdarea();
		$this->idsede= $user->getProfile()->getIdsede();
		$oAreas = Doctrine::getTable('Areas')->find($this->idarea);

		$this->darea= $oAreas->getDescripcion();
		
		$oSedes = Doctrine::getTable('Sedes')->find($this->idsede);
		$this->dsede= $oSedes->getNombre();

		$oAreas = Doctrine::getTable('Areas')->find($this->idarea);
		
		if($this->getUser()->hasCredential('alumno')) {
			$this->area = "Alumno";
			//$this->redirect("http://alumnos.ucu.edu.ar/autogestion.php");
		} else {
			$this->area = $oAreas->getDescripcion();
		}
		// obtener consultas de alumnos
		$this->solicitudess = Doctrine_Core::getTable('Solicitudes')->obtenerSolicitudes($this->getUser()->getProfile()->getIdarea(), $this->getUser()->getProfile()->getIdsede(),0);

	  	$oUsuario = $this->getUser()->getGuardUser();
	 	$oPerfil = $oUsuario->getProfile();
	  	$oAreasCarrera = Doctrine_Core::getTable('AreasCarrera')->findByIdArea($this->idarea);
		$arregloCarreras = "";
		$arregloFacultades = "";
	  	foreach($oAreasCarrera as $ac){
	  		$ca =$ac->getCarreras();
	  		if ($ca->getIdtipocarrera()!=6) {
				if ($arregloCarreras=='') $arregloCarreras = $ac->idcarrera;
				$arregloCarreras = $ac->idcarrera.','.$arregloCarreras;
				if ($arregloFacultades=='') $arregloFacultades = $ca->getIdfacultad();
				$arregloFacultades .= ','.$ca->getIdfacultad();
	  		}
		}

		$this->noticias = array();

  		if(($this->getUser()->getGuardUser()) && ($arregloCarreras!="")) {
			$this->noticias = Doctrine::getTable('Noticias')->obtenerNoticiasPrivadasPorCarrera($arregloCarreras,$this->getUser()->getProfile()->getIdsede());
  		}
  		$this->calendarioss = array();
		if ($arregloFacultades = "") {
			$this->calendarioss = Doctrine_Core::getTable('Calendarios')
				->createQuery('a')
				->where('idsede='.$oPerfil->getIdsede())
				->andWhere('idfacultad IN ('.$arregloFacultades.')')
				->andWhere('activo = 1')
				->execute();			
		} else {
			$this->calendarioss = array();
		}
    
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
