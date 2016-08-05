<?php

/**
 * periodosciclos actions.
 *
 * @package    sig
 * @subpackage periodosciclos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class periodosciclosActions extends sfActions
{
  public function executeEdit(sfWebRequest $request)
  {
    $this->idfecha = $request->getParameter('idfecha');
    $oFecha = Doctrine_Core::getTable('FechasCalendario')->find($this->idfecha);
    $this->idcalendario = $oFecha->getIdcalendario();
        
  	$this->form = new PeriodosCiclosForm();
    $this->form->setDefault('idfecha', $this->idfecha);
  }

  public function executeAsociar(sfWebRequest $request)
  {
	$arregloPeriodos =$request->getParameter('periodos_ciclos');

	$oPeriodoCiclo = Doctrine_Core::getTable('PeriodosCiclos')->findOneByIdfecha($arregloPeriodos['idfecha']);	    
    if (!$oPeriodoCiclo) {
		$oPeriodoCiclo = new PeriodosCiclos();
		$oPeriodoCiclo->setIdfecha($arregloPeriodos['idfecha']);
    }
   	$oPeriodoCiclo->setIdciclo($arregloPeriodos['idciclo']);
    $oPeriodoCiclo->save();
        
    $oFecha = Doctrine_Core::getTable('FechasCalendario')->find($arregloPeriodos['idfecha']);
	
    $this->redirect('calendarios/ver?idcalendario='.$oFecha->getIdcalendario());
  }
}
