<?php

/**
 * noticias actions.
 *
 * @package    sig
 * @subpackage noticias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticiasActions extends sfActions
{
	public function executeVernoticias(sfWebRequest $request) {
		$oAreas = new Areas();
  	
		$this->areas = $oAreas->obtenerTodasLasAreas();
	}

	public function executeVernoticiaspublicadas(sfWebRequest $request) { 
  		$this->noticias = array();

  		$this->noticias = Doctrine_Core::getTable('Noticias')->obtenerNoticiasPorCarrera($request->getParameter('carrerasxsede'));
	}
  
	public function executeIndex(sfWebRequest $request) {
		$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
		$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$this->noticiass = Doctrine::getTable('Noticias')->obtenerNoticiasPorArea($idarea, $idsede, 1);
    	//$this->noticiass = Doctrine::getTable('Noticias')->obtenerNoticiasPorUsuario($this->getUser()->getGuardUser()->getId(), 1);
  	}
  	
	public function executeLista(sfWebRequest $request) {
		$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
		$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
		$this->noticiass = Doctrine::getTable('Noticias')->obtenerNoticiasPorArea($idarea, $idsede, $request->getParameter('activo'));
		
    	$this->setTemplate('index');
  	}
  	public function executeNueva(sfWebRequest $request) {
    	$this->form = new NoticiasForm();
    	$this->form->setDefault('idusuario', $this->getUser()->getGuardUser()->getId());
  	}

	public function executeGuardar(sfWebRequest $request) {
	  	if($request->getParameter('idnoticia')) {
  			$oNoticia = Doctrine_Core::getTable('Noticias')->find($request->getParameter('idnoticia'));
  			$resultado = Doctrine::getTable('NoticiasCarrera')->findByIdnoticia($request->getParameter('idnoticia'));
  			foreach($resultado as $registro){
  				$registro->delete();
  			}
	  	} else {
  			$oNoticia = new Noticias();
  			
  		}
  		$oNoticia->setIdsede($this->getUser()->getProfile()->getIdsede());
  		$oNoticia->setTitulo($request->getParameter('titulo'));
  		$oNoticia->setIntro($request->getParameter('intro'));
  		$oNoticia->setDescripcion($request->getParameter('descripcion'));
  		$oNoticia->setIdusuario($request->getParameter('idusuario'));
  		$arr = explode('-', $request->getParameter('inicio'));
  		$oNoticia->setInicio($arr[2]."-".$arr[1]."-".$arr[0]);
  		$arr = explode('-', $request->getParameter('fin'));
  		$oNoticia->setFin($arr[2]."-".$arr[1]."-".$arr[0]);
  		if($request->getParameter('is_active')=="on"){
  			$activo = 1;
  		}else{
  			$activo = 0;
  		}
  		$oNoticia->setIsActive($activo);

  		if($request->getParameter('privada')=="on"){
  			$privada = 1;
  		}else{
  			$privada = 0;
  		}
  		$oNoticia->setPrivada($privada);

  		if($request->getParameter('leer_mas')=="on"){
  			$leer_mas = 1;
  		}else{
  			$leer_mas = 0;
  		}
  		$oNoticia->setLeerMas($leer_mas);
  		$oNoticia->setOrden($request->getParameter('orden'));
  		
  		$oNoticia->save();
	  	
  		$arregloCarreras = $request->getParameter('carrera');
  		foreach ($arregloCarreras as $carrera){
  			$oNoticiasCarrera = new NoticiasCarrera();
  			$oNoticiasCarrera->setIdcarrera($carrera);
  			$oNoticiasCarrera->setIdnoticia($oNoticia->getId());
  			$oNoticiasCarrera->save();
  		}  		
    	
  		$this->redirect('noticias/index');
	}

	public function executeEditar(sfWebRequest $request) {
		$oNoticia = Doctrine_Core::getTable('Noticias')->find($request->getParameter('idnoticia'));
		
    	$this->form = new NoticiasForm();
    	$this->form->setDefault('idnoticia', $request->getParameter('idnoticia'));
    	$this->form->setDefault('idusuario', $oNoticia->getIdusuario());
    	$this->form->setDefault('titulo', $oNoticia->getTitulo());    
    	$this->form->setDefault('intro', $oNoticia->getIntro());    
    	$this->form->setDefault('descripcion', $oNoticia->getDescripcion());   
  		$resultado = Doctrine::getTable('NoticiasCarrera')->findByIdnoticia($request->getParameter('idnoticia'));
		foreach($resultado as $item) {
			$arr[] = $item->getIdcarrera();
		}
    	$this->form->setDefault('carrera', $arr);    
    	$this->form->setDefault('leer_mas', $oNoticia->getLeerMas());
    	$this->form->setDefault('inicio', $oNoticia->getInicio());    
    	$this->form->setDefault('fin', $oNoticia->getFin());        	
    	$this->form->setDefault('is_active', $oNoticia->getIsActive());
    	$this->form->setDefault('privada', $oNoticia->getPrivada());
    	$this->form->setDefault('orden', $oNoticia->getOrden());
	}
	
	public function executeActivar(sfWebRequest $request) {
		$oNoticia = Doctrine_Core::getTable('Noticias')->find($request->getParameter('idnoticia'));
		$oNoticia->setIsActive($request->getParameter('activo'));
		$oNoticia->save();
		
		if ($request->getParameter('activo')) {
			$resultado = "La noticia ha sido activada.\n";
		} else {
			$resultado = "La noticia ha sido desactivada.\n";
		}
		echo $resultado;
		
		return sfView::NONE;	
	}


  public function executeVer(sfWebRequest $request)
  {
  	$this->noticia = Doctrine_Core::getTable('Noticias')->find($request->getParameter('idnoticia'));
  }
}
