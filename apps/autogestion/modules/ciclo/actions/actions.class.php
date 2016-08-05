<?php

/**
 * facultad actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cicloActions extends sfActions
{

  public function executeGetplanesactivacion(sfWebRequest $request) {
    $this->mensaje ="";
    $this->planes ="";  
    $linea = array();      
	if ($request->getParameter('guardado')){
		$this->guardado = $request->getParameter('guardado');
	}else{
		$this->guardado = 0;
	}
	$this->persona = Doctrine_Core::getTable('Personas')->buscarPersona("", $this->getUser()->getProfile()->getNrodoc()); 

	//obtener planes
	$planes_estudios = $this->persona->obtenerPlanesEstudiosActivosPreuniversitario();

	$this->planes = array();	
	foreach ($planes_estudios as $plan_estudio) {

		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($plan_estudio["idalumno"]);
		$idfacultad = $oAlumno->getPlanesEstudios()->getCarreras()->getIdfacultad();

		if ($oAlumno->getPlanesEstudios()->getCarreras()->getIdtipocarrera()!=5 and $oAlumno->getPlanesEstudios()->getIdestadoplan()==2) {

			$calendario = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($idfacultad, $oAlumno->getIdsede());
			if ($calendario!=NULL){
			$periodos = $calendario->obtenerPeriodosCiclos();

			foreach ($periodos as $periodo) {

				$activo = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($periodo['idciclo'], $plan_estudio['idalumno']);			    
				$hoy = date('Y-m-d');
				//if((!$activo) && (strtotime($hoy) > strtotime($periodo['inicio']) && strtotime($hoy) < strtotime($periodo['fin']))) array_push($this->inscriptoCiclo, $plan_estudio['idAl']);	    			
				if(strtotime($hoy) >= strtotime($periodo['inicio']) && strtotime($hoy) <= strtotime($periodo['fin'])) {
					$linea['idalumno'] = $plan_estudio['idalumno'];
					$linea['idcarrera'] = $plan_estudio['idcarrera'];
					$linea['carrera'] = $plan_estudio['nombre'];
					$linea['plan'] = $plan_estudio['plan'];
					$linea['ciclo'] = $periodo->getCiclosLectivos();
					$linea['idciclo'] = $periodo['idciclo'];
					$linea['activo'] = $activo;
					$this->planes[] = $linea;
				}
			}
			} // si no esta seteado calendario no busco periodos
		}
	}
 }

  public function executeInscribir(sfWebRequest $request)
  {
	$this->guardado = 0;
	// si no esta inscripto, lo inscribimos	

	$activo = Doctrine_Core::getTable('InscripcionesCicloLectivo')->getControlActivo($request->getParameter('idciclo'), $request->getParameter('idalumno'));
	if(!$activo){
	   	$oInscripcionesCicloLectivo = new InscripcionesCicloLectivo();
		$oInscripcionesCicloLectivo->setIdalumno($request->getParameter('idalumno'));
	   	$oInscripcionesCicloLectivo->setIdciclolectivo($request->getParameter('idciclo'));
	   	$oInscripcionesCicloLectivo->setCreatedAt(date('Y-m-d'));
	   	$oInscripcionesCicloLectivo->setUpdatedAt(date('Y-m-d'));     
		$oInscripcionesCicloLectivo->save();
		$this->guardado = 1;
	}
	$this->redirect('ciclo/getplanesactivacion?guardado='.$this->guardado);  
  }
}
