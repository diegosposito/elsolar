<?php

/**
 * cicloslectivos actions.
 *
 * @package    sig
 * @subpackage cicloslectivos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cicloslectivosActions extends sfActions
{
  public function executeBuscaralumnoscursantes(sfWebRequest $request)
  {
  	$this->form = new BuscarAlumnosActivosForm();
  	$this->form->setDefault('tipo', 1);
  }
  
  public function executeBuscaralumnosactivos(sfWebRequest $request)
  {
	$this->form = new BuscarAlumnosActivosForm();
	$this->form->setDefault('tipo', 2);
  }
 
  public function executeBuscaralumnosRecarga(sfWebRequest $request)
  {
	$this->form = new BuscarAlumnosActivosForm();
	$this->form->setDefault('tipo', 4);
  }
 
  public function executeRegistrodepromociones(sfWebRequest $request)
  {
  	$this->form = new BuscarAlumnosActivosForm();
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
		
	// CONTROL LIBREDEUDA //
	$this->administracion = new Administracion();

	// Controla el tipo ingresado
  	if($this->tipo == 2) {
		// Se obtienen los alumnos activos dicha materia
		$this->alumnos = Doctrine::getTable('AluMat')->getAlumnosActivos($request->getParameter('idcomision'));  	

  	} elseif($this->tipo == 4) {

			//$this->alumnos = Doctrine::getTable('AluMat')->getAlumnosActivos($request->getParameter('idcomision')); 
			$this->comisiones = Doctrine::getTable('Comisiones')->find($request->getParameter('idcomision'));
			$idcatedra=$this->comisiones->getIdcatedra();
			$this->catedras = Doctrine::getTable('Catedras')->find($idcatedra);
			$idmateriaplan=$this->catedras->getIdmateriaplan();
			$idsede=$this->catedras->getIdsede();
			$this->matplan = Doctrine::getTable('MateriasPlanes')->find($idmateriaplan);
			$idpe=$this->matplan->getIdplanestudio();

			$alumnos = Doctrine::getTable('Alumnos')->buscarAlumnos(1, "", $idpe, $idsede,4);
			
			foreach ($alumnos as $alumno) {
				$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);
				$this->alumnos[$alumno['idalumno']]= $oAlumno;
			}  	
  	} elseif($this->tipo == 1) {

	  	// Se obtienen los alumnos cursando dicha materia y comision
		$this->alumnos = Doctrine::getTable('AluMat')->getAlumnosCursando($request->getParameter('idcomision'));
  	} else {	
	  	// Se obtienen los alumnos cursando dicha materia y comision
		$alumnos = Doctrine::getTable('AluMat')->getAlumnosPromocionables($request->getParameter('idcomision'),'R');

		foreach ($alumnos as $alumno) {
			$oAlumno = Doctrine::getTable('Alumnos')->find($alumno['idalumno']);
			$this->alumnos[$alumno['idalumno']]= $oAlumno;
		}
  	}		
  }
  
  // Cerrar Ciclo Lectivo
  public function executeCerrar(sfWebRequest $request) 
  { 	
	$this->alumnos = $request->getParameter('alumno');

	$resultado ="";
	if ($request->getParameter('tipo')==3){
		// Obtiene la mesa de examen
  		$oMesaExamen = Doctrine::getTable('MesasExamenes')->find($request->getParameter('idmesaexamen'));
		// Obtiene la cantidad de inscriptos a la mesa
  		$cantidadInscriptos = count($oMesaExamen->obtenerInscriptos());
	}
	// Obtiene la comision
  	$oComision = Doctrine::getTable('Comisiones')->find($request->getParameter('idcomision'));
	$idmateria=$oComision->getCatedras()->getMateriasPlanes()->getIdmateria(); 
	// Recorre todas las notas y las guarda en el objeto correspondiente.   
  	foreach($this->alumnos as $k => $v){
  		if ($request->getParameter('tipo') == 1) {
  			// Actualiza el estado del objeto AluMat
  			$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($k,$oComision->getIdcatedra());
  			if($oAluMat->getIdestadomateria()==1) {
  				// Se actualiza al estado CURSO
				// Nuevo campo GZ
				$oAluMat->setIdmateria($idmateria);
  				$oAluMat->setIdestadomateria(7);
	  			$oAluMat->save();
  			}
	  		
	  		// Crea un nuevo objeto AluMat con los datos ingresados 
	  		$oAluMat = new AluMat();
	  		$oAluMat->setIdalumno($k);
	  		$oAluMat->setIdcatedra($oComision->getIdcatedra());
			// Nuevo campo GZ
	  		$oAluMat->setIdmateria($idmateria);
	  		$oAluMat->setIdcomision($oComision->getIdcomision());
	  		$oAluMat->setIdmateria($oComision->getCatedras()->getMateriasPlanes()->getIdmateria());
	  		$arr = explode('-', $request->getParameter('fechacierre'));
	  		$oAluMat->setFecha($arr[2]."-".$arr[1]."-".$arr[0]);
		  	$arr = explode('-', $request->getParameter('fechavencimiento'));
		  	$oAluMat->setFechavencimiento($arr[2]."-".$arr[1]."-".$arr[0]);
	  		$oAluMat->setIdestadomateria($request->getParameter('idestadomateria'));
			$oAluMat->save();	 
			
			$resultado = "Se ha cerrado correctamente el ciclo lectivo.";
		} elseif (($request->getParameter('tipo') == 2) or ($request->getParameter('tipo') == 4)) {

	  		// Crea un nuevo objeto AluMat con los datos ingresados
			$oAluMat = new AluMat();
	  		$oAluMat->setIdalumno($k);
	  		$oAluMat->setIdcatedra($oComision->getIdcatedra());
			// Nuevo campo GZ
			$oAluMat->setIdmateria($idmateria);
	  		$oAluMat->setIdcomision($oComision->getIdcomision());
	  		$oAluMat->setIdmateria($oComision->getCatedras()->getMateriasPlanes()->getIdmateria());
	  		$arr = explode('-', $request->getParameter('fechacierre'));
	  		$oAluMat->setFecha($arr[2]."-".$arr[1]."-".$arr[0]);
		  	$arr = explode('-', $request->getParameter('fechavencimiento'));
		  	$oAluMat->setFechavencimiento($arr[2]."-".$arr[1]."-".$arr[0]);
	  		$oAluMat->setIdestadomateria($request->getParameter('idestadomateria'));
			$oAluMat->save();	  	
			
			$resultado = "Se ha cerrado correctamente el ciclo lectivo.";
	  	} else {
  			if ($cantidadInscriptos > 25) {
				// si la cantidad de alumnos es 25 se pide cerrar la mesa creada y crear otra
				$resultado = "La mesa creada para promocion ya esta completa, por favor cierre la mesa y vuelva a crear otra para poder inscribir el resto de los alumnos.";
			} else {
				// Inscribe el alumno a mesa de examen de tipo Promocion
				$oAlumno = Doctrine::getTable('Alumnos')->find($k);
				$oAlumno->inscribirMesaExamen($oMesaExamen->getIdmesaexamen());
				
				// Actualiza el estado del objeto AluMat
				$oAluMat = Doctrine::getTable('AluMat')->getUltimoEstado($k,$oComision->getIdcatedra());
				if($oAluMat->getIdestadomateria()==1) {
					// Se actualiza al estado CURSO
					// Nuevo campo GZ
					$oAluMat->setIdmateria($idmateria);
					$oAluMat->setIdestadomateria(7);
					$oAluMat->save();
				}

				// Crea un nuevo objeto AluMat con los datos ingresados
		  		//$oAluMat = new AluMat();
		  		//$oAluMat->setIdalumno($k);
	  			//$oAluMat->setIdcatedra($oComision->getIdcatedra());
	  			//$oAluMat->setIdcomision($oComision->getIdcomision());
		  		//$arr = explode('-', $request->getParameter('fechacierre'));
		  		//$oAluMat->setFecha($arr[2]."-".$arr[1]."-".$arr[0]);
	  			//$oAluMat->setIdestadomateria(7);
				//$oAluMat->save();
						
				$cantidadInscriptos++;
				
				$resultado = "Se ha cerrado correctamente el ciclo lectivo.";
			} 
  		}		  	
	}
	echo $resultado;

	return sfView::NONE;
  }
  	
  public function executeIndex(sfWebRequest $request)
  {
    $this->ciclos_lectivoss = Doctrine_Core::getTable('CiclosLectivos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CiclosLectivosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CiclosLectivosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ciclos_lectivos = Doctrine_Core::getTable('CiclosLectivos')->find(array($request->getParameter('id'))), sprintf('Object ciclos_lectivos does not exist (%s).', $request->getParameter('id')));
    $this->form = new CiclosLectivosForm($ciclos_lectivos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ciclos_lectivos = Doctrine_Core::getTable('CiclosLectivos')->find(array($request->getParameter('id'))), sprintf('Object ciclos_lectivos does not exist (%s).', $request->getParameter('id')));
    $this->form = new CiclosLectivosForm($ciclos_lectivos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ciclos_lectivos = Doctrine_Core::getTable('CiclosLectivos')->find(array($request->getParameter('id'))), sprintf('Object ciclos_lectivos does not exist (%s).', $request->getParameter('id')));
    $comisiones = Doctrine_Core::getTable('Comisiones')->findByIdciclolectivo($ciclos_lectivos->getId());
    
    if(count($comisiones) == 0) {
    	$ciclos_lectivos->delete();	
    }

    $this->redirect('cicloslectivos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ciclos_lectivos = $form->save();

      $this->redirect('cicloslectivos/edit?id='.$ciclos_lectivos->getId());
    }
  }
}
