<?php

/**
 * inscripciones actions.
 *
 * @package    sig
 * @subpackage inscripciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

	public function executeBuscaralumnosanalitico(sfWebRequest $request)	{
	
	}
	public function executeBuscaralumnosanaliticocompleto(sfWebRequest $request)	{
	
	}
	
 public function executeObteneranalitico(sfWebRequest $request) {
	$soapclient = new nusoap_client("http://wssig.ucu.edu.ar/ucu/sitio/webservices/personas.php?wsdl");
	
	//llamamos la función implementada en el server.php de la siguiente manera
	$resultado = $soapclient->call('getpersona',array( 'value'=> $request->getParameter('idpersona')));
	$this->persona = unserialize(base64_decode($resultado));
	       
	//obtener planes
	$planespersona = $soapclient->call('obtenerplanalumno',array( 'value'=> $request->getParameter('idalumno')));
	       
	$this->planes = unserialize(base64_decode($planespersona));      
	$this->analitico="";
	
	if ($request->getParameter('idcarrera')){
		$analitico = $soapclient->call('obteneranalitico',array( 'idp'=> $request->getParameter('idpersona'),  'idc'=> $request->getParameter('idcarrera')));
		$this->analitico = unserialize(base64_decode($analitico));
	}

	$tipoanalitico=1; // analitico parcial 
        $this->analiticoalumno = Doctrine::getTable('MesasExamenes')->obtenerAnalitico($request->getParameter('idalumno'), $tipoanalitico);

	        
	$this->idp = $this->persona['idPersona'];
  }	
	

  

 public function executeObteneranaliticocompleto(sfWebRequest $request) {
	$soapclient = new nusoap_client("http://wssig.ucu.edu.ar/ucu/sitio/webservices/personas.php?wsdl");
	
	//llamamos la función implementada en el server.php de la siguiente manera
	$resultado = $soapclient->call('getpersona',array( 'value'=> $request->getParameter('idpersona')));
	$this->persona = unserialize(base64_decode($resultado));
	       
	//obtener planes
	$planespersona = $soapclient->call('obtenerplanalumno',array( 'value'=> $request->getParameter('idalumno')));
	       
	$this->planes = unserialize(base64_decode($planespersona));      
	$this->analitico="";
	
	if ($request->getParameter('idcarrera')){
		$analitico = $soapclient->call('obteneranaliticocompleto',array( 'idp'=> $request->getParameter('idpersona'),  'idc'=> $request->getParameter('idcarrera')));
		$this->analitico = unserialize(base64_decode($analitico));
	}
	        
	$this->idp = $this->persona['idPersona'];
  }	 
}