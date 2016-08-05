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


	// Busca la persona
  	$this->persona = Doctrine_Core::getTable('Personas')->buscarPersona($this->getUser()->getProfile()->getTipodoc(), $this->getUser()->getProfile()->getNrodoc());	       
	// Obtiene los planes de estudio
	$this->planes = $this->persona->obtenerPlanesEstudios();      
	
	$this->analitico="";
	
	/*if ($request->getParameter('idc')){
		$alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('ida'));
		$this->analitico = $alumno->obtenerAnalitico();
	}
	
	$this->idp = $this->persona['idpersona'];*/



	foreach($this->planes as $plan){
	


		// Busco el alumno
		$this->alumno = Doctrine::getTable('Alumnos')->find($request->getParameter('idalumno'));
	  	
	  	// Busca si existe el alumno	    
	  	/*$this->alu_mats = Doctrine_Core::getTable('AluMat')
	    	->createQuery('am')
	    	->innerJoin('am.Catedras ca')
	    	->innerJoin('ca.MateriasPlanes mp')
	    	->innerJoin('mp.Materias ma')
	    	->where('idalumno='.$plan['idalumno'])
	    	->andWhere('am.idestadomateria=3 or am.idestadomateria=1 or am.idestadomateria=9')
	    	->orderBy('mp.anodecursada')
	    	->addOrderBy(' am.idestadomateria DESC')
	      	->execute();*/

	  	$this->alu_mats = Doctrine_Core::getTable('AluMat')
	    	->createQuery('am')
	    	->innerJoin('am.Catedras ca')
	    	->innerJoin('ca.MateriasPlanes mp')
	    	->innerJoin('mp.Materias ma')
	    	->innerJoin('am.Alumnos a')
	    	->where('idpersona='.$this->persona->getIdPersona())
	    	->andWhere('am.idestadomateria=3 or am.idestadomateria=1 or am.idestadomateria=9 or am.idestadomateria=4')
	    	->orderBy('am.idestadomateria DESC')
	    	->addOrderBy('mp.anodecursada')
	    	->addOrderBy('mp.orden')
	      	->execute();

//$this->persona
	}

  }


  public function executeInfo(sfWebRequest $request) {	
  	// Busca el alumno
	$oAluMat = Doctrine_Core::getTable('AluMat')->find($request->getParameter('idalumat'));
	$idalumno=$oAluMat->getIdalumno();
	$oAluMat->getIdcatedra();
	$idmateriaplan=$oAluMat->getCatedras()->getIdmateriaplan();
	$oAlumno = Doctrine_Core::getTable('Alumnos')->find($idalumno);

  		$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($idmateriaplan);
  		$tipo = 'Operacion: Consulta INFO de Autogestion';
  		$texto = 'Materia: '.$oMateriaPlan->getIdmateriaplan().'('.$oAluMat->getEstadosMateria().')'.$oMateriaPlan;
  		$otro = '';

	// LOS MAILS NO ESTAN CONFIGURADOS EN TABLAS POR LO QUE SE AGREGO MANUALMENTE

		$destinatario = array('redmine@ucu.edu.ar' => 'Departamento Informatica' );


	// Remitente
	$remitente = $this->getUser()->getGuardUser()->getEmailAddress();  	
 	$mensaje = '

El alumno '.$oAlumno->getPersonas().', '.$oAlumno->getPersonas()->getTiposDocumentos().': '.$oAlumno->getPersonas()->getNrodoc().', de la carrera '.$oAlumno->getPlanesEstudios()->getCarreras().'.
IdAlumno: '.$oAlumno->getIdalumno().'
'.$tipo.'
'.$texto.'
'.$otro.'
';
 
$resultado = $this->getMailer()->composeAndSend(
  $remitente,
  $destinatario,
  'Consulta en Autogestion ALUMAT de alumno: '. $oAlumno->getPersonas(),
  $mensaje
);
	if ($resultado) {
		echo "Esta materia se encuentra registrada como ".$oAluMat->getEstadosMateria();
	} else {
		echo "Consultar con Secretaria";
	}
    
	return sfView::NONE;
  }


}
