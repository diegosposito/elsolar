<?php

require_once dirname(__FILE__).'/../lib/personasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/personasGeneratorHelper.class.php';

/**
 * personas actions.
 *
 * @package    sig
 * @subpackage personas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personasActions extends autoPersonasActions
{






  public function executePlanesestudios(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 
 	$oUsuario = $this->getUser()->getGuardUser();
 	$oPerfil = $oUsuario->getProfile();
	//echo "SEDE:".$oPerfil->getIdsede(); 

	//if($oPerfil->getIdsede()>3)

	      $this->getUser()->setAttribute('idpersona',$request->getParameter('idpersona'));
	      //$this->forward('planesestudios', 'index');
	      $this->redirect('planesestudios');
	//} else {
//die;
		//return sfView::NONE;
	    //  $this->forward('personas', 'index');

	//};

  }
  }





}
