<?php

/**
 * examenes actions.
 *
 * @package    sig
 * @subpackage examenes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class examenesActions extends sfActions
{
  public function executeBuscar(sfWebRequest $request)
  {
  	$this->exameness = Doctrine_Core::getTable('Examenes')
      ->createQuery('a')
      ->execute();
  }
  
  public function executeInscribir(sfWebRequest $request)
  {
	$request->setParameter('ida',$request->getParameter('idalumno'));
	$request->setParameter('idc',$request->getParameter('idcarrera'));
        
	// Obtiene el alumno y la persona          
	$this->alumno = Doctrine_Core::getTable('Alumnos')->find(array($request->getParameter('idalumno')));
  	
	// Inscribir alumno a mesa de examen
	$this->mensaje = $this->alumno->inscribirMesaExamen($request->getParameter('idmesaexamen'));

	//$this->executeObtenermesasexamenes($request);
	$this->forward('examenes', 'obtenermesasexamenes');
  }
    
  public function executeObtenermesasexamenes(sfWebRequest $request)
  {
	$this->mesasexamenes="";
	$this->mensaje="";

    // Obtiene el alumno y la persona          
    $this->alumno = Doctrine_Core::getTable('Alumnos')->find(array($request->getParameter('idalumno')));
  	$this->persona = $this->alumno->getPersonas();
          
	// Obtener materias habilitadas para rendir
	//$materiasHabilitadas = $this->alumno->obtenerMateriasHabilitadas("R");
	$materiasHabilitadas = $this->alumno->obtenerMateriasHabilitadas('R', 'R');
	$materias = unserialize(base64_decode($materiasHabilitadas));
         
	// Prepara string para filtrar mesas de examenes por materias habilitadas para rendir
	$sMaterias = "";
	foreach($materias as $materia){
		$sMaterias = $materia['iddetalleplan'].", ";
	}           
  
	$sMaterias = substr($sMaterias, 0, strlen($sMaterias)-2);
	$materias_serialize = base64_encode(serialize($sMaterias));
           
	// Obtener mesas habilitadas para el usuario (segun correlatividad)  
	$mesasExamenesHabilitadas = $this->alumno->obtenerMateriasHabilitadas('R', 'R');
	//$mesasExamenesHabilitadas = $this->alumno->obtenerMesasExamenesHabilitadas($materias_serialize);
	$this->mesasexamenes = unserialize(base64_decode($mesasExamenesHabilitadas));
                      
  }
   	
  public function executeIndex(sfWebRequest $request)
  {
    $this->exameness = Doctrine_Core::getTable('Examenes')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ExamenesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ExamenesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($examenes = Doctrine_Core::getTable('Examenes')->find(array($request->getParameter('idexamen'))), sprintf('Object examenes does not exist (%s).', $request->getParameter('idexamen')));
    $this->form = new ExamenesForm($examenes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($examenes = Doctrine_Core::getTable('Examenes')->find(array($request->getParameter('idexamen'))), sprintf('Object examenes does not exist (%s).', $request->getParameter('idexamen')));
    $this->form = new ExamenesForm($examenes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($examenes = Doctrine_Core::getTable('Examenes')->find(array($request->getParameter('idexamen'))), sprintf('Object examenes does not exist (%s).', $request->getParameter('idexamen')));
    $examenes->delete();

    $this->redirect('examenes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $examenes = $form->save();

      $this->redirect('examenes/edit?idexamen='.$examenes->getIdexamen());
    }
  }
}
