<?php

/**
 * calendarios actions.
 *
 * @package    sig
 * @subpackage calendarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendariosActions extends sfActions
{
  public function executeVer(sfWebRequest $request)
  {
    $this->fechass = Doctrine_Core::getTable('FechasCalendario')
      ->createQuery('a')
      ->where('idcalendario='.$request->getParameter('idcalendario'))
      ->execute();
    $this->calendario = Doctrine_Core::getTable('Calendarios')->find($request->getParameter('idcalendario'));




      
  }
  
  public function executeIndex(sfWebRequest $request)
  {     
 	$arreglo = "";
  	$oUsuario = $this->getUser()->getGuardUser();
 	$oPerfil = $oUsuario->getProfile();
  	$oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($oPerfil->getTipodoc(), $oPerfil->getNrodoc());
   	$facultades = $oPersona->obtenerFacultades();

echo $oPerfil->getTipodoc().'-'.$oPerfil->getNrodoc();
  	foreach($facultades as $facultad){
		$arreglo .= $facultad->idfacultad.", "; 
		//echo "*".$facultad->idfacultad;
	}
	$arregloFacultades = substr($arreglo, 0, strlen($arreglo)-2);
	foreach($arregloFacultades as $a) echo $a.'-';
  	/*$this->calendarioss = Doctrine_Core::getTable('Calendarios')
      ->createQuery('a')
      ->where('idsede='.$oPerfil->getIdsede())
      ->andWhere('idfacultad IN ( '.$arregloFacultades.' )')
      ->andWhere('activo = 1')
      ->execute();  */   
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CalendariosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CalendariosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($calendarios = Doctrine_Core::getTable('Calendarios')->find(array($request->getParameter('idcalendario'))), sprintf('Object calendarios does not exist (%s).', $request->getParameter('idcalendario')));
    $this->form = new CalendariosForm($calendarios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($calendarios = Doctrine_Core::getTable('Calendarios')->find(array($request->getParameter('idcalendario'))), sprintf('Object calendarios does not exist (%s).', $request->getParameter('idcalendario')));
    $this->form = new CalendariosForm($calendarios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($calendarios = Doctrine_Core::getTable('Calendarios')->find(array($request->getParameter('idcalendario'))), sprintf('Object calendarios does not exist (%s).', $request->getParameter('idcalendario')));
    $calendarios->delete();

    $this->redirect('calendarios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $calendarios = $form->save();

      $this->redirect('calendarios/edit?idcalendario='.$calendarios->getIdcalendario());
    }
  }

	public function executeBuscarcarrera(sfWebRequest $request)	{

		$this->materiashabilitadas= array();
		$this->materiasinscriptas= array();
		$this->habilitado=false;
		$this->estadolibredeuda = false; 
    		$this->mensaje = "";	

		$this->form = new BuscarCarrerasActivasAlumnosForm(array(
		    'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
		));

		if(sfContext::getInstance()->getUser()->getAttribute('idalumno')=='') sfContext::getInstance()->getUser()->setAttribute('idalumno',$request->getParameter('idalumno'));if(sfContext::getInstance()->getUser()->getAttribute('idalumno')=='') sfContext::getInstance()->getUser()->setAttribute('idalumno',$request->getParameter('idalumno'));

		if ($request->isMethod('post')){
			$this->alumno = Doctrine_Core::getTable('Alumnos')->find(sfContext::getInstance()->getUser()->getAttribute('idalumno'));

			// se debe verificar si esta en periodo de inscripcion
			/*$this->calendarioss = Doctrine_Core::getTable('Calendarios')->obtenerUltimoCalendario($this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $this->alumno->getIdsede());  */
  	   	  	
		  	$this->calendarioss = Doctrine_Core::getTable('Calendarios')
			      ->createQuery('a')
			      ->where('idsede='.$this->alumno->getIdsede())
				->andWhere('idfacultad = '.$this->alumno->getPlanesEstudios()->getCarreras()->getIdfacultad())
			      ->andWhere('activo = 1')
			      ->execute();      

		  	foreach($this->calendarioss as $ca){
				$arreglo = $ca->idcalendario; 
			}

		    $this->fechass = Doctrine_Core::getTable('FechasCalendario')
		      ->createQuery('a')
		      ->where('idcalendario='.$ca->idcalendario)
		      ->execute();
		    $this->calendario = Doctrine_Core::getTable('Calendarios')->find($ca->idcalendario);

			$this->setTemplate('obtenercalendario');
		}
	}

}
