<?php

/**
 * facultad actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class analiticoActions extends sfActions
{
  public function executeGetanalitico(sfWebRequest $request)
  {
	// Busca la persona
  	$this->persona = Doctrine_Core::getTable('Personas')->buscarPersona($this->getUser()->getProfile()->getTipodoc(), $this->getUser()->getProfile()->getNrodoc());	       
	// Obtiene los planes de estudio
	$this->planes = $this->persona->obtenerPlanesEstudiosActivos();      
	
	$this->analitico="";
	
	if ($request->getParameter('idc')){
		$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
		$this->analitico = $alumno->obtenerAnalitico();
	}
	
	$this->idp = $this->persona['idpersona'];
  }
}
