<?php

/**
 * cicloslectivos actions.
 *
 * @package    sig
 * @subpackage cicloslectivos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class autogestionActions extends sfActions
{

	public function executeBuscaralumnosactivos(sfWebRequest $request)	{
	
	}
	
  public function executeRegistrodeinscripcionesmesas(sfWebRequest $request)
  {
  	$this->form = new BuscarAlumnosInscriptosMesasForm();
  	$this->form->setDefault('tipo', 3);
  }

  // Obtiene los alumnos cursantes en una materia
  public function executeObteneralumnos(sfWebRequest $request)
  {	
  	$this->alumnos = array();
  	$this->mensaje = "";
  	$this->mesaexamen = "";
  	$this->form = new CerrarCicloLectivoForm();
  	$this->tipo = $request->getParameter('tipo');
	// Se obtiene la comision
	$this->comision = Doctrine::getTable('Comisiones')->find($request->getParameter('idcomision'));
	// Se obtiene la catedra
	$this->catedra = $this->comision->getCatedras();
	// Se obtiene la materiaplan
	$this->materiaplan = $this->catedra->getMateriasPlanes();
	$this->idcatedra = $this->catedra->getIdcatedra();
	$this->arreglo_llamados=$this->comision->getCatedras()->obtenerLlamadosAutogestion();
	
	$this->llamado= $request->getParameter('idllamado');
	// CONTROL LIBREDEUDA //
	$this->administracion = new Administracion();
			
	//$this->catedra->getIdcatedra()
	$this->comisiones = Doctrine::getTable('Comisiones')->find($request->getParameter('idcomision'));
	$idcatedra=$this->comisiones->getIdcatedra();

	$this->alumnos = Doctrine::getTable('InscripcionesMesas')->getAlumnosInscriptosMesas($idcatedra, $request->getParameter('idllamado') , $idcondicion=0, $estado=0);
	
  }


  // Asignar mesa
  public function executeAsignarmesa(sfWebRequest $request) 
  { 	

	$this->alumnos = $request->getParameter('alumno');

	$resultado ="";

	// Obtiene la mesa de examen
	$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
	// Obtiene la cantidad de inscriptos a la mesa
	$cantidadInscriptos = count($oMesaExamen->obtenerInscriptos());

	// Obtiene la comision
  	$oComision = Doctrine::getTable('Comisiones')->find($request->getParameter('idcomision'));
	$idcatedra=$oComision->getIdcatedra();
	// Recorre todas las notas y las guarda en el objeto correspondiente.   
  	foreach($this->alumnos as $k => $v){

  			if ($cantidadInscriptos > 25) {
				// si la cantidad de alumnos es 25 se pide cerrar la mesa creada y crear otra
				$resultado = "La mesa creada ya esta completa, por favor cierre la mesa y vuelva a crear otra para poder inscribir el resto de los alumnos.";
			} else {
				// Inscribe el alumno a mesa de examen de tipo Promocion
				$oAlumno = Doctrine::getTable('Alumnos')->find($k);
				$oAlumno->inscribirMesaExamen($oMesaExamen->getIdmesaexamen());
				

				// Actualiza el estado de la inscripcion
				
				$oInscripcionesMesas = Doctrine::getTable('InscripcionesMesas')->getInscripcionMesa($k,$idcatedra,1);
				$oInscripcionesMesas->setConfirmado(1);
				$oInscripcionesMesas->setIdcondicionmesa($oMesaExamen->getIdcondicion());
				$oInscripcionesMesas->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
				$oInscripcionesMesas->save();			

				$cantidadInscriptos++;
				
				$resultado = "Se ha inscripto correctamente a la mesa.";
			} 
  				  	
	}



	echo $resultado;

	return sfView::NONE;
  }
  	
 // Eliminar Inscripcion Mesa
  public function executeEliminarinscripcion(sfWebRequest $request) 
  { 
	$oInscripcionesMesas = Doctrine::getTable('InscripcionesMesas')->find($request->getParameter('idinscripcion'));
	$idmesaexamen=$oInscripcionesMesas->getIdmesaexamen();
	$idalumno=$oInscripcionesMesas->getIdalumno();

	$examen= Doctrine::getTable('Examenes')->borrarExamen($idalumno, $idmesaexamen);
	

	$oInscripcionesMesas->setIdmesaexamen(0);
	$oInscripcionesMesas->setConfirmado(0);	
	 
	$oInscripcionesMesas->save();
				
	$resultado = "Se ha eliminado correctamente de la mesa.";

	echo $resultado;

	return sfView::NONE;
  }


}
