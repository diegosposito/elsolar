<?php

/**
 * noticias actions.
 *
 * @package    sig
 * @subpackage noticias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticiasActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeVer(sfWebRequest $request)
  {
  	$this->noticia = Doctrine_Core::getTable('Noticias')->find($request->getParameter('idnoticia'));
  }
}
