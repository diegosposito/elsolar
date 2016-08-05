<?php

/**
 * planesestudios actions.
 *
 * @package    sig
 * @subpackage planesestudios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planesestudiosActions extends sfActions
{ 
  public function executeObtenerprofesores(sfWebRequest $request)
  {
  	$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$oFacultad = $oPlanEstudio->getCarreras()->getFacultades();
  	$this->profesores = Doctrine_Core::getTable('Profesores')->findByIdfacultad($oFacultad->getIdfacultad());
  }
  	
  public function executeObtenercatedras(sfWebRequest $request)
  {
  	$this->catedras = "";
    $oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($request->getParameter('idplanestudio'));
  	$catedras = $oPlanEstudio->obtenerCatedras(sfContext::getInstance()->getUser()->getAttribute('id_sede',''));
    foreach ($catedras as $catedra) {  	
  			$this->catedras[$catedra->idcatedra] = $catedra;
  	}  	
  }

  public function executeObtenerplanesxfacultad(sfWebRequest $request)
  {
    $this->carreras = Doctrine_Core::getTable('Carreras')->obtenerCarrerasPorFacultad($request->getParameter('idfacultad'));
  }

  public function executeObtenerplanesxsedefacultad(sfWebRequest $request)
  {
      $this->carreras = Doctrine_Core::getTable('Carreras')->obtenerPlanesPorSedeFacultad($request->getParameter('idsede'), $request->getParameter('idfacultad'));
  }

  public function executeObtenercatedrasxplansede(sfWebRequest $request)
  {
      
      $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
      
      // Si no es el administrador de Profesores (adminProfesores), seteo la sede del usuario de sesion
      if (!sfContext::getInstance()->getUser()->hasCredential('adminProfesores')) 
          $idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');

      $this->catedras = Doctrine_Core::getTable('PlanesEstudios')->obtenerCatedrasPorPlanSede($request->getParameter('idplanestudio'), $idsede);
  }
  	 
}