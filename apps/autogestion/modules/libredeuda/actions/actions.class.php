<?php

/**
 * libredeuda actions.
 *
 * @package    sig
 * @subpackage libredeuda
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libredeudaActions extends sfActions
{

  public function executeGetlibredeuda(sfWebRequest $request) {
  	$this->historial ="";
  	$this->tipo =$request->getParameter('tipo');
  	$soapclient = new nusoap_client("http://190.228.68.196/ucu/sitio/webservices/personas.php?wsdl");

	$this->solicitudess = Doctrine_Core::getTable('SolicitudesLibredeuda')->getSolicitudesPendientes();

	foreach ( $this->solicitudess as $key => $value){
		// llamamos la función implementada en el server.php de la siguiente manera
		$resultado = $soapclient->call('getalumno',array( 'value'=> $value['idalumno']));
       	$this->alumno = unserialize(base64_decode($resultado));
       	$resultado = $soapclient->call('getpersona',array( 'value'=> $this->alumno['idPersona']));

       	$this->persona = unserialize(base64_decode($resultado));
       		
       	$this->solicitudess[$key]['dni'] = $this->persona['nroDoc'];
       	$this->solicitudess[$key]['alumno'] = $this->persona['apellido'].', '.$this->persona['nombre'];  
    }
  }

  public function executeAceptarlibredeuda(sfWebRequest $request) {
	// Se envia peticion de libredeuda
	if ($request->getParameter('ida')!='') {
		$connection = Doctrine_Manager::connection();
		$query = 'UPDATE solicitudes_libredeuda SET idestadosolicitud=3 where idestadosolicitud=1 and idalumno= '.$request->getParameter('ida');
		$statement = $connection->execute($query);
		$statement->execute();
		//mediante webservice actualizo el libredeuda en la cuenta del alumno
	} 
	$this->redirect('libredeuda/getlibredeuda');
  }

  public function executeRechazarlibredeuda(sfWebRequest $request) {
	// Se envia peticion de libredeuda
	if ($request->getParameter('ida')!='') {
		//$comentario= 'comentario_'.$request->getParameter('ida');
		$connection = Doctrine_Manager::connection();
		$query = 'UPDATE solicitudes_libredeuda SET idestadosolicitud=2, observaciones="'.$request->getParameter('comentario').'" where idestadosolicitud=1 and idalumno= '.$request->getParameter('ida');
		$statement = $connection->execute($query);
		$statement->execute();
	} 
	$this->redirect('libredeuda/getlibredeuda');
  }
}