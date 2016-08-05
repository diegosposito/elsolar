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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	// Desactiva el layout ya que es un popup
  	$this->setLayout(false);
  	
  	$idciclolectivo = Doctrine_Core::getTable('CiclosLectivos')->getIdUltimoCicloLectivoActivo();
  	$this->ciclolectivo = Doctrine_Core::getTable('CiclosLectivos')->find($idciclolectivo);
  	
  	$this->asignacioness = Doctrine_Core::getTable('AsignacionesClases')
      ->createQuery('c')
      ->where('c.idcomision = ?', $request->getParameter('idcomision'))
      ->andWhere('YEAR(c.inicio) < ?', $this->ciclolectivo->getCiclo())
      ->orderBy('c.idcomision DESC')
      ->execute();

  }
}
