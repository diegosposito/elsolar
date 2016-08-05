<?php

/**
 * periodoscursadas actions.
 *
 * @package    sig
 * @subpackage periodoscursadas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class periodoscursadasActions extends sfActions
{
  public function executeEdit(sfWebRequest $request)
  {
    $this->idfecha = $request->getParameter('idfecha');
    $oFecha = Doctrine_Core::getTable('FechasCalendario')->find($this->idfecha);
    $this->idcalendario = $oFecha->getIdcalendario();
        
  	$this->form = new PeriodosCursadasForm();
    $this->form->setDefault('idfecha', $this->idfecha);
  }

  public function executeAsociar(sfWebRequest $request)
  {
	$arregloPeriodos =$request->getParameter('periodos_cursadas');

	$oPeriodoCursada = Doctrine_Core::getTable('PeriodosCursadas')->findOneByIdfecha($arregloPeriodos['idfecha']);	    
    if (!$oPeriodoCursada) {
		$oPeriodoCursada = new PeriodosCursadas();
		$oPeriodoCursada->setIdfecha($arregloPeriodos['idfecha']);
    }
   	$oPeriodoCursada->setPeriododecursada($arregloPeriodos['periododecursada']);
    $oPeriodoCursada->save();
        
    $oFecha = Doctrine_Core::getTable('FechasCalendario')->find($arregloPeriodos['idfecha']);
	
    $this->redirect('calendarios/ver?idcalendario='.$oFecha->getIdcalendario());
  }
}
