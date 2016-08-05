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
  	$this->carreras = array();
  	$this->noticias = array();
  	$this->persona = null;

	$user = $this->getUser();
  		
	if($user->isAuthenticated()) {
	  	//obtengo datos de credencial
		if($this->getUser()->hasCredential('alumno') or $this->getUser()->hasCredential('alumnoauto')) {
			$this->area = "Alumno";
				
		  	$this->noticias = array();
		  	if($this->getUser()->getGuardUser()){
		  		$oPerfil = $this->getUser()->getGuardUser()->getProfile();
		  		$this->persona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());

		  		$this->carreras = Doctrine_Core::getTable('Personas')->obtenerCarrerasActivasPersona($oPerfil->getNrodoc());
		  		$this->noticias = $this->persona->obtenerNoticiasPublicas();
		  		//echo "SQL: ".var_dump($this->noticias);exit;
		  		/*
		  		$orden = false; 
				foreach ($this->noticias as $noticia) {
		  			if ($noticia['orden'] > 1) {
		  				$orden = true;
		  			}
		  		}
		  		if ($orden) {
		  			//$this->array_sort_by_column($this->noticias,"orden", SORT_ASC);
		  		} else {
		  			$this->array_sort_by_column($this->noticias,"id", SORT_DESC);
		  		}
		  		*/
		  		
				$this->nrodoc= $oPerfil->getNrodoc();
//$this->redirect("http://alumnos.ucu.edu.ar/autogestion.php");
		  	}
		} else {
			$this->redirect("http://alumnos.ucu.edu.ar/autogestion.php");
		}
  	} 
  }  
  
  public function executeIndexfacultad(sfWebRequest $request)
  {
  }  
  
  public function executeError(sfWebRequest $request)
  {
    $this->msgerror = $request->getParameter('msgerror');
  }
 
/*	function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
	    $sort_col = array();
	    foreach ($arr as $key=> $row) {
	        $sort_col[$key] = $row[$col];
	    }
	
	    array_multisort($sort_col, $dir, $arr);
	}*/
 
}
