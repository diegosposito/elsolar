<?php

/**
 * equivalencias actions.
 *
 * @package    sig
 * @subpackage equivalencias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class equivalenciasActions extends sfActions
{
	// Controla y aproba la equivalencia pendiente
	public function executeAprobar(sfWebRequest $request)
	{
		$this->idarea = $this->getUser()->getProfile()->getIdarea();
		$this->idsede = $this->getUser()->getProfile()->getIdsede();
		
		// Obtiene la materia de la equivalencia a aprobar
		$oMateriaEquivalencia = Doctrine_Core::getTable('MateriasEquivalencias')->find($request->getParameter('idmateriaequivalencia'));
		// Obtiene la equivalencia
		$oEquivalencia = $oMateriaEquivalencia->getEquivalenciasAlumnos();
		// Obtiene el alumno
		$oAlumno = $oEquivalencia->getAlumnos();
		// Obtiene la catedra	
		$oCatedra = $oMateriaEquivalencia->getMateriasPlanes()->obtenerCatedra($this->idsede);
		$fecha = $oAlumno->obtenerUltimaCorrelativaAprobada($oMateriaEquivalencia->getIdmateriaplan());
		
		// Creo la mesa de examen de tipo Equivalencia
		$oMesaExamen = new MesasExamenes();
		$oMesaExamen->setIdcatedra($oCatedra->getIdcatedra());
		$oMesaExamen->setIdcondicion(5);
		$oMesaExamen->setIdtipoexamen(4);
		$oLibro = Doctrine_Core::getTable('LibrosActas')->obtenerLibroEquivalencia($this->idarea);
		$oMesaExamen->setIdlibroacta($oLibro->getIdlibroacta());
		$oMesaExamen->setFecha($fecha);
		$oMesaExamen->setLibro('Equivalencia');
		$oMesaExamen->setFolio($oEquivalencia->getNroresolucion());
		$oMesaExamen->setIdestadomesaexamen(4);
		$oMesaExamen->setIdmateria($oMateriaEquivalencia->getMateriasPlanes()->getIdmateria());
		$oMesaExamen->save();
						
		// Registro el alumno en la mesa de examen
		$oExamen = new Examenes();
		$oExamen->setIdalumno($oEquivalencia->getIdalumno());
		$oExamen->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
		$oExamen->save();
			
		// Genero el registro aprobado en AluMat
		$oAluMat = new AluMat();
		$oAluMat->setIdalumno($oEquivalencia->getIdalumno());
		$oAluMat->setIdestadomateria(9);
		$oAluMat->setFecha($fecha);
		$oAluMat->setFechavencimiento($fecha);
		$oAluMat->setIdcomision(0);
		$oAluMat->setIdmateria($oMateriaEquivalencia->getMateriasPlanes()->getIdmateria());
		$oAluMat->setIdcatedra($oCatedra->getIdcatedra());
		$oAluMat->save();

		$oMateriaEquivalencia->setIdestadoequivalencia(4);
		$oMateriaEquivalencia->save();
	
		echo "Se ha guardado correctamente el registro.";
	
		return sfView::NONE;
	}
	
	// Guarda el pago de la equivalencia del alumno
	public function executeGuardarpago(sfWebRequest $request)
	{
		$arrEquivalencias = $request->getParameter('equivalencias_alumnos');
	
		// Guarda los cambios en los datos de contacto
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arrEquivalencias['idalumno']);
		$oPersona = $oAlumno->getPersonas();
	
		// Obtiene la equivalencia
		$oEquivalencia = Doctrine_Core::getTable('EquivalenciasAlumnos')->find($arrEquivalencias['idequivalencia']);
		$oEquivalencia->setNrorecibo1($arrEquivalencias['nrorecibo1']);
		if ($arrEquivalencias['tipopago']==1) {
			$oEquivalencia->setNrorecibo2($arrEquivalencias['nrorecibo1']);
		}
		$oEquivalencia->save();
	
		echo "Se ha guardado correctamente el pago.";
	
		return sfView::NONE;
	}
		
	// Guarda el registro de equivalencia del alumno
	public function executeGuardarregistro(sfWebRequest $request)
	{
		$this->idarea = $this->getUser()->getProfile()->getIdarea();
		$this->idsede = $this->getUser()->getProfile()->getIdsede();
		
		$estado ="";
		$arrEquivalencias = $request->getParameter('equivalencias_alumnos');
	
		$arr = explode('-', $arrEquivalencias['fecharesolucion']);
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		// Obtiene la equivalencia
		$oEquivalencia = Doctrine_Core::getTable('EquivalenciasAlumnos')->find($arrEquivalencias['idequivalencia']);
		$oEquivalencia->setFecharesolucion($fecha);
		$oEquivalencia->setNroresolucion($arrEquivalencias['nroresolucion']);
		$oEquivalencia->save();
		// Obtiene el alumno
		$oAlumno = $oEquivalencia->getAlumnos();
		
		// Obtiene todas las materias solicitadas por equivalencia
		$materias_solicitadas = Doctrine_Core::getTable('MateriasEquivalencias')->findByIdequivalencia($oEquivalencia->getIdequivalencia());
		// Obtiene las materias que aprueba por equivalencias
		$materias_aprobadas = $request->getParameter('case');	

		foreach ($materias_solicitadas as $materia) {
			$oMateriaEquivalencia = Doctrine_Core::getTable('MateriasEquivalencias')->getMateriasEquivalencias($oEquivalencia->getIdequivalencia(),$materia->getIdmateriaplan());
			if (in_array($materia->getIdmateriaplan(), $materias_aprobadas)) {
				// Obtiene las materias que puede aprobar por equivalencia
				$materias_habi = $oAlumno->obtenerMateriasHabilitadas('R','L');
				foreach($materias_habi as $materia_h) {
					$materias_habilitadas[$materia_h['idmateriaplan']] = $materia_h['idmateriaplan'];
				}			
				if (in_array($materia->getIdmateriaplan(), $materias_habilitadas)) {
					$estado = 4;
					$oCatedra = $oMateriaEquivalencia->getMateriasPlanes()->obtenerCatedra($this->idsede);
					
					// Creo la mesa de examen de tipo Equivalencia
					$oMesaExamen = new MesasExamenes();
					$oMesaExamen->setIdcatedra($oCatedra->getIdcatedra());
					$oMesaExamen->setIdcondicion(5);
					$oMesaExamen->setIdtipoexamen(4);	
					$oLibro = Doctrine_Core::getTable('LibrosActas')->obtenerLibroEquivalencia($this->idarea);
					$oMesaExamen->setIdlibroacta($oLibro->getIdlibroacta()); 
					$oMesaExamen->setFecha($oEquivalencia->getFecharesolucion());
					$oMesaExamen->setLibro('Equivalencia');
					$oMesaExamen->setFolio($oEquivalencia->getNroresolucion());
					$oMesaExamen->setIdestadomesaexamen(4);
					$oMesaExamen->setIdmateria($oMateriaEquivalencia->getMateriasPlanes()->getIdmateria());
					$oMesaExamen->save();
					
					// Registro el alumno en la mesa de examen
					$oExamen = new Examenes();
					$oExamen->setIdalumno($oEquivalencia->getIdalumno());
					$oExamen->setIdmesaexamen($oMesaExamen->getIdmesaexamen());
					$oExamen->save();
					
					// Genero el registro aprobado en AluMat
					$oAluMat = new AluMat();
					$oAluMat->setIdalumno($oEquivalencia->getIdalumno());
					$oAluMat->setIdestadomateria(9);
					$oAluMat->setFecha($oEquivalencia->getFecharesolucion());
					$oAluMat->setFechavencimiento($oEquivalencia->getFecharesolucion());
					$oAluMat->setIdcomision(0);
					$oAluMat->setIdmateria($oMateriaEquivalencia->getMateriasPlanes()->getIdmateria());
					$oAluMat->setIdcatedra($oCatedra->getIdcatedra());
					$oAluMat->save();
					
					$oAlumno->setIdtipoinscripto(3);
					$oAlumno->save();
				} else {
					$estado = 2;
				}		
			} else {
				$estado = 3;
			}
			$oMateriaEquivalencia->setIdestadoequivalencia($estado);
			$oMateriaEquivalencia->save();
		}
	
		echo "Se ha guardado correctamente el registro.";
	
		return sfView::NONE;
	}
		
	// Guarda la solicitud de equivalencia del alumno
	public function executeGuardarsolicitud(sfWebRequest $request)
	{
		$resultado = 0;
		$arrEquivalencias = $request->getParameter('equivalencias_alumnos');
	
		$arr = explode('-', $arrEquivalencias['fecha']);
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		// Guarda los cambios en los datos de contacto
		$oAlumno = Doctrine_Core::getTable('Alumnos')->find($arrEquivalencias['idalumno']);
		$oPersona = $oAlumno->getPersonas();
	
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		
		// Guarda la solicitud de equivalencia de los alumnos
		$oEquivalencia = new EquivalenciasAlumnos();
		$oEquivalencia->setIdalumno($arrEquivalencias['idalumno']);
		$oEquivalencia->setFecha($fecha);
		$oEquivalencia->setObservaciones($arrEquivalencias['observaciones']);
		$oEquivalencia->setCantidadprogramas($arrEquivalencias['cantidadprogramas']);
		$oEquivalencia->save();
	
		// Guarda los cambios los estados de los alumnos en las materias
		$materias_seleccionadas = $request->getParameter('case');
		if(count($materias_seleccionadas) > 0) {
			foreach ($materias_seleccionadas as $materia) {
				$oMateriaEquivalencia = new MateriasEquivalencias();
				$oMateriaEquivalencia->setIdequivalencia($oEquivalencia->getIdequivalencia());
				$oMateriaEquivalencia->setIdmateriaplan($materia);
				$oMateriaEquivalencia->setIdestadoequivalencia(1);
				$oMateriaEquivalencia->save();
				$resultado =1;
			}
		}
		
		echo "Se ha guardado correctamente la solicitud.";
		
		return sfView::NONE;
	}

	public function executeRegistrarpago(sfWebRequest $request)
	{
		$this->equivalencia = Doctrine_Core::getTable('EquivalenciasAlumnos')->find($request->getParameter('idequivalencia'));
		$this->materias = Doctrine_Core::getTable('MateriasEquivalencias')->findByIdequivalencia($this->equivalencia->getIdequivalencia());
	
		$this->form = new EquivalenciasAlumnosForm();
		$this->form->setDefault('idequivalencia', $this->equivalencia->getIdequivalencia());
		$this->form->setDefault('idalumno', $this->equivalencia->getIdalumno());
	}
		
	public function executeRegistrarequivalencia(sfWebRequest $request)
	{
		$this->equivalencia = Doctrine_Core::getTable('EquivalenciasAlumnos')->find($request->getParameter('idequivalencia'));
		$this->materias = Doctrine_Core::getTable('MateriasEquivalencias')->findByIdequivalencia($this->equivalencia->getIdequivalencia());
	
		$this->form = new EquivalenciasAlumnosForm();
		$this->form->setDefault('idequivalencia', $this->equivalencia->getIdequivalencia());
		$this->form->setDefault('idalumno', $this->equivalencia->getIdalumno());
		$this->form->setDefault('fecharesolucion', date('d-m-Y'));
	}
		
	public function executeSolicitarequivalencia(sfWebRequest $request)
	{		
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));
		$this->materias = Doctrine_Core::getTable('MateriasPlanes')->obtenerMateriasPlan($this->alumno->getIdplanestudio());
		
		$this->form = new EquivalenciasAlumnosForm();
		$this->form->setDefault('idalumno', $request->getParameter('idalumno'));
		$this->form->setDefault('fecha', date('d-m-Y'));
	}
		
  public function executeIndexadministracion(sfWebRequest $request)
  {
	$this->equivalencias_alumnoss = Doctrine_Core::getTable('EquivalenciasAlumnos')
	->createQuery('ea')
	->where('ea.nrorecibo2 = 0')
	->orWhere('ea.nrorecibo2 is null')
	->execute();
  }
		
  public function executeIndexacademica(sfWebRequest $request)
  {
	$this->idarea = $this->getUser()->getProfile()->getIdarea();
	$this->idsede = $this->getUser()->getProfile()->getIdsede();
	
	$this->equivalencias_alumnoss = Doctrine_Core::getTable('EquivalenciasAlumnos')
	->createQuery('ea')
	->innerJoin('ea.Alumnos al ON ea.idalumno=al.idalumno')
	->innerJoin('al.PlanesEstudios pe ON al.idplanestudio=pe.idplanestudio')
	->where('al.idsede = ?', $this->idsede)
	->andWhere('pe.idcarrera IN (SELECT ac.idcarrera FROM AreasCarrera  ac WHERE ac.idarea= '.$this->idarea.')')
	->execute();
  }
	
  public function executeIndex(sfWebRequest $request)
  { 
    $this->idarea = $this->getUser()->getProfile()->getIdarea();
    $this->idsede = $this->getUser()->getProfile()->getIdsede();

   	$this->equivalencias_alumnoss = Doctrine_Core::getTable('EquivalenciasAlumnos')
    	->createQuery('ea')
    	->innerJoin('ea.Alumnos al ON ea.idalumno=al.idalumno')
    	->innerJoin('al.PlanesEstudios pe ON al.idplanestudio=pe.idplanestudio')
    	->where('al.idsede = ?', $this->idsede)
    	->andWhere('pe.idcarrera IN (SELECT ac.idcarrera FROM AreasCarrera  ac WHERE ac.idarea= '.$this->idarea.')')
    	->execute();    
  }

  public function executeControlar(sfWebRequest $request)
  {
  	$this->equivalencias_alumnos = Doctrine_Core::getTable('EquivalenciasAlumnos')->find(array($request->getParameter('idequivalencia')));
  	$this->materias_equivalencias = Doctrine_Core::getTable('MateriasEquivalencias')->findByIdequivalencia($this->equivalencias_alumnos->getIdequivalencia());
  	if ($request->getParameter('link')==1) {
  		$this->link = 'equivalencias/indexacademica';
  	} else {
  		$this->link = 'equivalencias/index';
  	}
  	$this->forward404Unless($this->equivalencias_alumnos);
  }
    
  public function executeShow(sfWebRequest $request)
  {
    $this->equivalencias_alumnos = Doctrine_Core::getTable('EquivalenciasAlumnos')->find(array($request->getParameter('idequivalencia')));
    $this->materias_equivalencias = Doctrine_Core::getTable('MateriasEquivalencias')->findByIdequivalencia($this->equivalencias_alumnos->getIdequivalencia());
    if ($request->getParameter('link')==1) {
    	$this->link = 'equivalencias/indexacademica';
    } else {
    	$this->link = 'equivalencias/index';
    }
    $this->forward404Unless($this->equivalencias_alumnos);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EquivalenciasAlumnosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EquivalenciasAlumnosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($equivalencias_alumnos = Doctrine_Core::getTable('EquivalenciasAlumnos')->find(array($request->getParameter('idequivalencia'))), sprintf('Object equivalencias_alumnos does not exist (%s).', $request->getParameter('idequivalencia')));
    $this->form = new EquivalenciasAlumnosForm($equivalencias_alumnos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($equivalencias_alumnos = Doctrine_Core::getTable('EquivalenciasAlumnos')->find(array($request->getParameter('idequivalencia'))), sprintf('Object equivalencias_alumnos does not exist (%s).', $request->getParameter('idequivalencia')));
    $this->form = new EquivalenciasAlumnosForm($equivalencias_alumnos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($equivalencias_alumnos = Doctrine_Core::getTable('EquivalenciasAlumnos')->find(array($request->getParameter('idequivalencia'))), sprintf('Object equivalencias_alumnos does not exist (%s).', $request->getParameter('idequivalencia')));
    $equivalencias_alumnos->delete();

    $this->redirect('equivalencias/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $equivalencias_alumnos = $form->save();

      $this->redirect('equivalencias/edit?idequivalencia='.$equivalencias_alumnos->getIdequivalencia());
    }
  }
  
  public function executeBuscaralumnos(sfWebRequest $request)	{
  
  }  
}
