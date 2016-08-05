<?php

/**
 * asignacionesclases actions.
 *
 * @package    sig
 * @subpackage asignacionesclases
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class asignacionesclasesActions extends sfActions
{
  // Guarda la asignacion
  public function executeValidar(sfWebRequest $request) {  
  	$arregloAsignaciones =$request->getParameter('asignaciones_clases');
    $asignaciones = Doctrine_Core::getTable('AsignacionesClases')->findByIdcomision($arregloAsignaciones['idcomision']);
	$resultado = true;
	// Buscamos que el aula no este ya asignada
    foreach($asignaciones as $asignacion) {
    	if($arregloAsignaciones['idasignacion'] != $asignacion->getIdasignacion()) {
	    	$intersection = $this->getInterseccion($arregloAsignaciones,$asignacion);
			if($intersection) {
	    		$resultado = false;
			}
    	}
	}
   	echo $resultado;
   	
	return sfView::NONE;	
  }	
  
  // Guarda la asignacion
  public function executeGuardar(sfWebRequest $request) {  
  	$arregloAsignaciones =$request->getParameter('asignaciones_clases');

	if($arregloAsignaciones['idasignacion']) {
		$oAsignacionClase = Doctrine_Core::getTable('AsignacionesClases')->find($arregloAsignaciones['idasignacion']);
		if(($oAsignacionClase->getDia() != $arregloAsignaciones['dia']) or ($oAsignacionClase->getInicio() != $arregloAsignaciones['inicio']) or ($oAsignacionClase->getFin() != $arregloAsignaciones['fin']) or ($oAsignacionClase->getPeriodicidad() != $arregloAsignaciones['periodicidad'])) {
			// Elimina las clases ya generadas porquue se cambio alguno de los parametros que existian
			$clases = Doctrine_Core::getTable('Clases')->findByIdasignacion($arregloAsignaciones['idasignacion']);
			foreach($clases as $clase) {
				$clase->delete();
			}	
			$generar_clases = true; 
		} else {
			$generar_clases = false;
		}
	} else {
		$oAsignacionClase = new AsignacionesClases();
		$generar_clases = true;
	}
	// Guarda la informacion de la asignacion
	$oAsignacionClase->setIdaula($arregloAsignaciones['idaula']);
	$oAsignacionClase->setDia($arregloAsignaciones['dia']);
	$oAsignacionClase->setInicio($arregloAsignaciones['inicio']['year']."-".$arregloAsignaciones['inicio']['month']."-".$arregloAsignaciones['inicio']['day']);
	$oAsignacionClase->setFin($arregloAsignaciones['fin']['year']."-".$arregloAsignaciones['fin']['month']."-".$arregloAsignaciones['fin']['day']);
	$oAsignacionClase->setHorainicio($arregloAsignaciones['horainicio']);
	$oAsignacionClase->setHorafin($arregloAsignaciones['horafin']);
	$oAsignacionClase->setObservaciones($arregloAsignaciones['observaciones']);
	$oAsignacionClase->setIdcomision($arregloAsignaciones['idcomision']);
	$oAsignacionClase->setIdtipoclase($arregloAsignaciones['idtipoclase']);
	$oAsignacionClase->setPeriodicidad($arregloAsignaciones['periodicidad']);
	$oAsignacionClase->save();
		
	if ($generar_clases) {
		// Asigna la periodicidad que se va a utilizar
		switch ($oAsignacionClase->getPeriodicidad()) {
			case 'S':
		    	$periodicidad = new DateInterval("P1W");
		        break;
		    case 'Q':
		        $periodicidad = new DateInterval("P2W");
		        break;
		    case 'M':
		        $periodicidad = new DateInterval("P1M");
		        break;
		}		
		// Asigna el dia que se va a utilizar	
		switch ($oAsignacionClase->getDia()) {
			case 'L':
		    	$dia = ' next Monday';
		        break;
		    case 'M':
		        $dia = ' next Tuesday';
		        break;
		    case 'I':
		        $dia = ' next Wednesday';
		        break;
		    case 'J':
		        $dia = ' next Thursday';
		        break;
		    case 'V':
		        $dia = ' next Friday';
		        break;
		    case 'S':
		        $dia = ' next Saturday';
		        break;
		    case 'D':
		        $dia = ' next Sunday';
		        break;
		}	
		$inicio = date('Y-m-d', strtotime($oAsignacionClase->getInicio(). $dia));
		$fechaInicio = new DateTime($inicio);
				
		$fechaFin = new DateTime($oAsignacionClase->getFin());		
		$fechas = new DatePeriod($fechaInicio, $periodicidad, $fechaFin);
		foreach($fechas as $fecha){
			$oClase = new Clases();
			// Guarda la informacion de la clase
			$oClase->setIdasignacion($oAsignacionClase->getIdasignacion());
			$oClase->setFecha($fecha->format("Y-m-d"));
			$oClase->setActivo(1);
			$oClase->save();
		}						
	}

   	echo "Se ha guardado correctamente la asignación.";
   	
	return sfView::NONE;	
  }
	
  public function executeBuscar(sfWebRequest $request)
  {
  	$this->form = new BuscarHorariosForm();
  }
    
  public function executeIndex(sfWebRequest $request)
  {
  	$this->idcomision = $request->getParameter('idcomision');

	$this->idciclolectivo = $request->getParameter('idciclolectivo');
	$this->comision = Doctrine_Core::getTable('Comisiones')->find($this->idcomision);
	
	$oCatedra = Doctrine_Core::getTable('Catedras')->find($this->comision->getIdcatedra());
	
	$this->ciclolectivo = Doctrine_Core::getTable('CiclosLectivos')->find($this->idciclolectivo);
	$this->sede = $oCatedra->getSedes();
	$this->planestudio = $oCatedra->getMateriasPlanes()->getPlanesEstudios();
	
	$this->getUser()->setAttribute('idcomision', $this->idcomision);
	$this->getUser()->setAttribute('idciclolectivo', $this->idciclolectivo);
	
    $this->asignaciones_clasess = Doctrine_Core::getTable('AsignacionesClases')
      ->createQuery('a')
      ->where('a.idcomision = ?', $this->idcomision)
      ->andWhere('YEAR(a.inicio) = ?', $this->ciclolectivo->getCiclo())
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->idcomision = $request->getParameter('idcomision');
    
  	$this->form = new AsignacionesClasesForm();
    $this->form->setDefault('idcomision', $this->idcomision);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AsignacionesClasesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($asignaciones_clases = Doctrine_Core::getTable('AsignacionesClases')->find(array($request->getParameter('idasignacion'))), sprintf('Object asignaciones_clases does not exist (%s).', $request->getParameter('idasignacion')));
    $this->form = new AsignacionesClasesForm($asignaciones_clases);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asignaciones_clases = Doctrine_Core::getTable('AsignacionesClases')->find(array($request->getParameter('idasignacion'))), sprintf('Object asignaciones_clases does not exist (%s).', $request->getParameter('idasignacion')));
    $this->form = new AsignacionesClasesForm($asignaciones_clases);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {   
  	$clases = Doctrine_Core::getTable('Clases')->findByIdasignacion($request->getParameter('idasignacion'));
	foreach ($clases as $clase) {
		$clase->delete();
	} 
  	$request->checkCSRFProtection();
  
    $this->forward404Unless($asignaciones_clases = Doctrine_Core::getTable('AsignacionesClases')->find(array($request->getParameter('idasignacion'))), sprintf('Object asignaciones_clases does not exist (%s).', $request->getParameter('idasignacion')));
    $asignaciones_clases->delete();

    $this->redirect('asignacionesclases/index?idcomision='.$this->getUser()->getAttribute('idcomision').'&idciclolectivo='.$this->getUser()->getAttribute('idciclolectivo'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
  	$arregloAsignaciones =$request->getParameter('asignaciones_clases');
    $asignaciones = Doctrine_Core::getTable('AsignacionesClases')->findByIdcomision($arregloAsignaciones['idcomision']);
	$valid = true;
	// Buscamos que el aula no este ya asignada
    foreach($asignaciones as $asignacion) {
    	if($arregloAsignaciones['idasignacion'] != $asignacion->getIdasignacion()) {
	    	$intersection = $this->getInterseccion($arregloAsignaciones,$asignacion);
			if($intersection) {
	    		$valid = false;
			}
    	}
	}

  if ($form->isValid())
	    {
	      $asignaciones_clases = $form->save();
	
	      $this->redirect('asignacionesclases/edit?idasignacion='.$asignaciones_clases->getIdasignacion());
	    }
	    
  }
 
  public function getInterseccion($a,$b)
  {
    $aInicio = $a['inicio'];
    $aFin = $a['fin'];
    $aDia = $a['dia'];
    $aHoraInicio = $a['horainicio'];
    $aHoraFin = $a['horafin'];
    $aAula = $a['idaula'];
  
    $bInicio = $b->getInicio();
    $bFin = $b->getFin();
    $bDia = $b->getDia();
    $bHoraInicio = $b->getHorainicio();
    $bHoraFin = $b->getHorafin();
    $bAula = $b->getIdaula();

    if($bInicio > $aFin || $aInicio > $bFin || $aFin < $aInicio || $bFin < $bInicio || $bHoraInicio > $aHoraFin || $aHoraInicio > $bHoraFin || $aHoraFin < $aHoraInicio || $bHoraFin < $bHoraInicio || $aAula != $bAula || $aDia != $bDia) {
		return false;
    } else {
        if(($aAula == $bAula) and ($aDia == $bDia) and !($bHoraInicio > $aHoraFin || $aHoraInicio > $bHoraFin || $aHoraFin < $aHoraInicio || $bHoraFin < $bHoraInicio) and !($bInicio > $aFin || $aInicio > $bFin || $aFin < $aInicio || $bFin < $bInicio)) {
			return true;
    	} else {
    		return false;
    	}
    }
  }  
}