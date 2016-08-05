<?php

/**
 * provincia actions.
 *
 * @package    sig
 * @subpackage provincia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class provinciaActions extends sfActions
{
  public function executeObtenerciudades(sfWebRequest $request)
  {
	$provincia = Doctrine_Core::getTable('Provincias')->find($request->getParameter('idprovincia'));
  	$this->ciudades = $provincia->obtenerCiudades();
  }
}
