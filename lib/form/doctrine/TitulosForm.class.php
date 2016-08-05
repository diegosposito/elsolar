<?php

/**
 * Titulos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TitulosForm extends BaseTitulosForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']); 
  	$arregloNivelesTitulos = array(0 => 'Intermedio', 1 =>'Final');

  	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre:</p>'), array('size' => '50'));
  	$this->widgetSchema['nombrefemenino'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre femenino:</p>'), array('size' => '50'));
  	
  	$this->widgetSchema['niveltitulo'] = new sfWidgetFormSelect(array('label' => '<p align="left">Tipo:</p>', 'choices' => $arregloNivelesTitulos));
  	$this->widgetSchema['duracion'] = new sfWidgetFormInput(array('label' => '<p align="left">Duración (años):</p>'), array('size' => '4'));
  	$this->widgetSchema['tiempotrabajofinal'] = new sfWidgetFormInput(array('label' => '<p align="left">Tiempo de trabajo final (años):</p>'), array('size' => '4'));
  	//$this->widgetSchema['incumbencias'] = new sfWidgetFormInput(array('label' => '<p align="left">Incumbencias:</p>'), array('size' => '50'));
	$this->widgetSchema['nroresolucion'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro. de resolución:</p>'), array('size' => '15'));
	$this->widgetSchema['nroresolucionministerial'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro. de resolución ministerial:</p>'), array('size' => '15'));
	$this->widgetSchema['fechacreacion'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de creación:</p>'), array('size' =>'10'));
	$this->widgetSchema['fechacreacionministerial'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de creación ministerial:</p>'), array('size' =>'10'));
	$this->widgetSchema['incumbencias'] = new sfWidgetFormTextareaTinyMCE(
			array(
					'config' => sfConfig::get('app_tiny_mce_simple')
			)
	);
		
   	// Se define los labels
	$this->widgetSchema->setLabel('incumbencias', '<p align="left">Incumbencias:</p>');
	$this->widgetSchema->setLabel('idtipotitulo', '<p align="left">Nivel académico:</p>');
	$this->widgetSchema->setLabel('acreditacionconeau', '<p align="left">Acreditación CONEAU:</p>');
	$this->widgetSchema->setLabel('categorizacionconeau', '<p align="left">Categorización CONEAU:</p>');
	
  }  	
}
