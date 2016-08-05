<?php
class AsignarHorariosForm extends sfForm
{    
  public function configure()
  {         
	$arregloPeriodicidad = array('S' => 'Semanal', 'Q' => 'Quincenal', 'M' => 'Mensual');
	$arregloDias = array('L' => 'Lunes', 'M' => 'Martes', 'I' => 'Miercoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sabado', 'D' => 'Domingo');
		
  	// Se define el esquema del form
	$this->widgetSchema['idcomision'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['dia'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Día:</b></p>', 'choices' => $arregloDias));
	$this->widgetSchema['idtipoclase'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'TiposClases',
		'label' => '<p align="left"><b>Tipo clase:</b></p>',
		'add_empty' => false
	));	
	$this->widgetSchema['periodicidad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Periodicidad:</b></p>', 'choices' => $arregloPeriodicidad));
	
	$this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left">Inicio:</p>'), array('size' =>'10'));
	$this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left">Fin:</p>'), array('size' =>'10'));
	$this->widgetSchema['horainicio'] = new sfWidgetFormInput(array('label' => '<p align="left">Hora inicio:</p>'), array('size' =>'4'));
	$this->widgetSchema['horafin'] = new sfWidgetFormInput(array('label' => '<p align="left">Hora fin:</p>'), array('size' =>'4'));
  	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left">Observaciones:</p>'));	
  }
}