<?php

/**
 * AsignacionesClases form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AsignacionesClasesForm extends BaseAsignacionesClasesForm
{
  public function configure()
  {
	$arregloPeriodicidad = array('S' => 'Semanal', 'Q' => 'Quincenal', 'M' => 'Mensual');
	$arregloDias = array('L' => 'Lunes', 'M' => 'Martes', 'I' => 'Miercoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sabado', 'D' => 'Domingo');
  	$aulas = Doctrine_Core::getTable('Aulas')
		->createQuery('a')
		->execute();
	foreach($aulas as $aula){
		$arregloAulas[$aula->getIdaula()] = $aula->getEdificios()." - ".$aula->getNombre(); 
	}  	
  	
	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	// Se define el esquema del form
	$this->widgetSchema['idcomision'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idaula'] = new sfWidgetFormChoice(array('choices' => $arregloAulas));
  	$this->widgetSchema['dia'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Día:</b></p>', 'choices' => $arregloDias));
	$this->widgetSchema['idtipoclase'] = new sfWidgetFormDoctrineChoice(array(
		'expanded' => false,
		'multiple' => false,
		'model' => 'TiposClases',
		'label' => '<p align="left"><b>Tipo clase:</b></p>',
		'add_empty' => false
	));	
	$this->widgetSchema['periodicidad'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Periodicidad:</b></p>', 'choices' => $arregloPeriodicidad));

    $this->widgetSchema['inicio'] = new sfWidgetFormJQueryDate(array(
		'config' => '{}',
		'image'=> sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.gif',
		'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
		'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));
    $this->widgetSchema['fin'] = new sfWidgetFormJQueryDate(array(
		'config' => '{}',
		'image'=> sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.gif',
		'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
		'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));        
	$this->widgetSchema['horainicio'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Hora inicio:</b></p>'), array('size' =>'4'));
	$this->widgetSchema['horafin'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Hora fin:</b></p>'), array('size' =>'4','attr' => array('readonly' => true)));
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Observaciones:</b></p>'));
	
	$this->widgetSchema->setLabel('idaula', '<p align="left"><b>Aula:</b></p>');
	$this->widgetSchema->setLabel('inicio', '<p align="left"><b>Inicio:</b></p>');
	$this->widgetSchema->setLabel('fin', '<p align="left"><b>Fin:</b></p>');
  }
}
