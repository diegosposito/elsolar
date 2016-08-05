<?php

/**
 * ingreso actions.
 *
 * @package    sig
 * @subpackage ingreso
 * @author     Your name here
 * @version    
 */
class defaultActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  	 
  }  
  
  public function executeSecure(sfWebRequest $request)
  {
    $this->msgerror = $request->getParameter('msgerror');
  }

public function executeError404(sfWebRequest $request)
  { 
//$this->setTemplate('error404'); 
   // $this->msgerror = $request->getParameter('msgerror');
  }

}
