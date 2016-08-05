<?php
class BuscarAspirantesForm extends sfForm
{
  public function configure()
  {         
  	$cicloslectivos = Doctrine_Core::getTable('CiclosLectivos')->obtenerCiclosLectivosActivos();
  	foreach($cicloslectivos as $ciclo){
		$arregloCiclos[$ciclo->getId()] = $ciclo->getCiclo(); 
	}  	  	

	// Se define el esquema del form
  	$this->widgetSchema['idciclo'] = new sfWidgetFormSelect(array('choices' => $arregloCiclos));
  	   
 	// Se define los labels
 	$this->widgetSchema->setLabel('idciclo', '<p align="left">Ciclo lectivo:</p>'); 	  	
  }
}