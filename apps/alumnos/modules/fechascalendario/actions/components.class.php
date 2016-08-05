<?php
class fechascalendarioComponents extends sfComponents
{
  public function executeObtenerllamados(sfWebRequest $request)
  {
    $this->idfecha = $request->getParameter('idfecha');
  	$this->llamados = Doctrine_Core::getTable('LlamadosTurno')
      ->createQuery('a')
      ->where('idfecha='.$this->idfecha)
      ->execute();
  }
}