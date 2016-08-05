<?php

/**
 * alumat actions.
 *
 * @package    sig
 * @subpackage alumat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alumatActions extends sfActions
{
  public function executeBuscar(sfWebRequest $request) {
	
  }
  	
  public function executeIndex(sfWebRequest $request)
  {
	// Busco el alumno
	$this->alumno = Doctrine::getTable('Alumnos')->find($request->getParameter('idalumno'));
	
	$oCarreraSede = Doctrine_Core::getTable('CarrerasSede')->obtenerCarrerasSede($this->alumno->getPlanesEstudios()->getIdcarrera(), $this->alumno->getIdsede());
	$this->permiterevalida = $oCarreraSede->getPermiterevalida();
	
  	// Busca si existe el alumno	    
  	$this->alu_mats = Doctrine_Core::getTable('AluMat')
    	->createQuery('am')
    	->innerJoin('am.Catedras ca')
    	->innerJoin('ca.MateriasPlanes mp')
    	->innerJoin('mp.Materias ma')
    	->where('idalumno='.$this->alumno->getIdalumno())
    	->orderBy('ma.nombre ASC')
    	->addOrderBy('am.id DESC')
      	->execute();
  }
  
  public function executeRevalidar(sfWebRequest $request)
  {
  	$oAluMat = Doctrine_Core::getTable('AluMat')->find($request->getParameter('id'));

  	$fechavence = date('Y-m-d', strtotime($oAluMat->getFechavencimiento()));
  	$fechavencimiento = date('Y-m-d', strtotime("$fechavence + 1 year"));
  	 
  	$oNuevoAluMat = new AluMat();
  	$oNuevoAluMat->setIdalumno($request->getParameter('idalumno'));
  	$oNuevoAluMat->setIdestadomateria($oAluMat->getIdestadomateria());
  	$oNuevoAluMat->setFecha($oAluMat->getFechavencimiento());
  	$oNuevoAluMat->setFechavencimiento($fechavencimiento);
  	$oNuevoAluMat->setIdcomision($oAluMat->getIdcomision());
  	$oNuevoAluMat->setIdmateria($oAluMat->getIdmateria());
  	$oNuevoAluMat->setIdcatedra($oAluMat->getIdcatedra());
  	$oNuevoAluMat->save();
  	
  	$this->redirect('alumat/index?idalumno='.$request->getParameter('idalumno'));
  }  
  
  public function executeDelete(sfWebRequest $request)
  {
  	$this->forward404Unless($alumat = Doctrine_Core::getTable('AluMat')->find(array($request->getParameter('id'))), sprintf('Object alumat does not exist (%s).', $request->getParameter('id')));
  	$alumat->delete();
  
  	$this->redirect('alumat/index?idalumno='.$request->getParameter('idalumno'));
  }  
}
