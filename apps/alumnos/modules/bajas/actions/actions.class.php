<?php

/**
 * bajas actions.
 *
 * @package    sig
 * @subpackage bajas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bajasActions extends sfActions
{

	// Listado de Bajas (Excel)
	public function executeListadobajascsv(sfWebRequest $request)
	{
		// Busco las bajas por sede
		$this->alumnos = Doctrine_Core::getTable('Alumnos')->buscarBajasFiltrados($request->getParameter('idfacultad'), $request->getParameter('idsede'), $request->getParameter('idplanestudio'), $request->getParameter('ordencampo'), $request->getParameter('ordenmetodo'));
	
		// verificacion de existencia del objeto alumnos  (if*1)
		if($this->alumnos){
			//Creamos el archivo temporal de exportación
			$file = 'listado-bajas.cvs';
	
			$fh = fopen($file,"w+") or die ("unable to open file");
	
			$titulo = "Id, Legajo, Apellido, Nombre, Nro. de documento, Ciclo lectivo, Fecha de baja, Carrera, Facultad, Sede, Fecha de registro,\n";
			fwrite($fh,$titulo);
	
			foreach ($this->alumnos as $alumno){
				$fecharegistro = explode(" ",$alumno['fecharegistro']);
				$row = $alumno['idalumno'].",".$alumno['legajo'].",".$alumno['nombre'].",".$alumno['ciclo'].",".$alumno['nrodoc'].",".$alumno['fechabaja'].",".$alumno['carrera'].",".$alumno['facultad'].",".$alumno['sede'].",".$fecharegistro[0].","."\n";
	
				fwrite($fh,$row);
			}
		}
	
		// Close file
		fclose($fh);
	
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
		header("Content-Disposition: attachment;filename=".$file );
		header("Content-Length: ".filesize($file));
		header("Pragma: no-cache");
		header("Expires: 0");
		readfile($file);
	
		// stop symfony process
		throw new sfStopException();
	
		return sfView::NONE;
	}
		
	public function executeInformebajas(sfWebRequest $request)
	{
		$this->idsede = $request->getParameter('idsede',0);
		$this->idfacultad = $request->getParameter('idfacultad',0);
		$this->idplanestudio = $request->getParameter('idplanestudio',0);
		$this->ordencampo = $request->getParameter('ordencampo','s.nombre');
		$this->ordenmetodo = $request->getParameter('ordenmetodo','ASC');
		 
		if ($this->idsede!=0) {
			$oSede =  Doctrine_Core::getTable('Sedes')->find($this->idsede);
			$this->sede = $oSede->getNombre();
		} else {
			$this->sede = "Todas las sedes.";
		}
		if ($this->idfacultad!=0) {
			$oFacultad =  Doctrine_Core::getTable('Facultades')->find($this->idfacultad);
			$this->facultad = $oFacultad->getNombre();
		} else {
			$this->facultad = "Todas las facultades.";
		}
		if ($this->idplanestudio!=0) {
			$oPlan =  Doctrine_Core::getTable('PlanesEstudios')->find($this->idplanestudio);
			$this->plan = $oPlan->getNombre();
		} else {
			$this->plan = "Todas las carreras.";
		}
		// Busco las bajas por sede
		$this->alumnos = Doctrine_Core::getTable('Alumnos')->buscarBajasFiltrados($request->getParameter('idfacultad'), $request->getParameter('idsede'), $request->getParameter('idplanestudio'), $request->getParameter('ordencampo'), $request->getParameter('ordenmetodo'));
	}
	
  public function executeBuscarbajas(sfWebRequest $request)
  {
	$this->mensaje = "";
	$this->form = new BuscarBajasForm();
  }
		
  public function executeIndex(sfWebRequest $request)
  {
  	$this->idarea = $this->getUser()->getProfile()->getIdarea();
  	$this->idsede = $this->getUser()->getProfile()->getIdsede();
  	if ($request->getParameter('idalumno')) {
	  	$this->bajas_alumnoss = Doctrine_Core::getTable('BajasAlumnos')
	      ->createQuery('a')
	      ->where('a.idalumno = ?', $request->getParameter('idalumno'))
	      ->orderBy('a.idbaja DESC')
	      ->execute();
    } else {
    	$this->bajas_alumnoss = Doctrine_Core::getTable('BajasAlumnos')
    	->createQuery('ba')
    	->innerJoin('ba.Alumnos al ON ba.idalumno=al.idalumno')
    	->innerJoin('al.PlanesEstudios pe ON al.idplanestudio=pe.idplanestudio')
    	->where('al.idsede = ?', $this->idsede)
    	->andWhere('pe.idcarrera IN (SELECT ac.idcarrera FROM AreasCarrera  ac WHERE ac.idarea= '.$this->idarea.')')
    	->orderBy('ba.idbaja DESC')
    	->execute();
    }	  	
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BajasAlumnosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new BajasAlumnosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($bajas_alumnos = Doctrine_Core::getTable('BajasAlumnos')->find(array($request->getParameter('idbaja'))), sprintf('Object bajas_alumnos does not exist (%s).', $request->getParameter('idbaja')));
    $this->form = new BajasAlumnosForm($bajas_alumnos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($bajas_alumnos = Doctrine_Core::getTable('BajasAlumnos')->find(array($request->getParameter('idbaja'))), sprintf('Object bajas_alumnos does not exist (%s).', $request->getParameter('idbaja')));
    $this->form = new BajasAlumnosForm($bajas_alumnos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($bajas_alumnos = Doctrine_Core::getTable('BajasAlumnos')->find(array($request->getParameter('idbaja'))), sprintf('Object bajas_alumnos does not exist (%s).', $request->getParameter('idbaja')));
    $bajas_alumnos->delete();

    $this->redirect('bajas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $bajas_alumnos = $form->save();

      $this->redirect('bajas/edit?idbaja='.$bajas_alumnos->getIdbaja());
    }
  }
}
