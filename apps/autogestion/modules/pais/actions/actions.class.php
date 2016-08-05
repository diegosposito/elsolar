<?php

/**
 * pais actions.
 *
 * @package    sig
 * @subpackage pais
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paisActions extends sfActions
{
  public function executeObtenerprovincias(sfWebRequest $request)
  {
	$pais = Doctrine_Core::getTable('Paises')->find($request->getParameter('idpais'));
  	$this->provincias = $pais->obtenerProvincias();
  }
}
