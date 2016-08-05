<?php

/**
 * ExpedientesEgresados form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ExpedientesEgresadosForm extends BaseExpedientesEgresadosForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['fechasolicitud'], $this['nerorecibo'], $this['registrome'], $this['activo'], $this['idderivacionbiblioteca'], $this['idderivacionadministracion'], $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
	  	
	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['folio'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Folio:</b></p>'), array('size' =>'4'));
	$this->widgetSchema['fechainformeauditoria'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha de informe:</b></p>'), array('size' =>'8', 'value' => date('d-m-Y')));
 	
	$this->widgetSchema['documentacion'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left"><b>Documentación:</b></p>',
		'expanded' => true,
		'multiple' => true,
		'model' => 'Documentacion',
	    'table_method' => 'getDocumentacionesPorTipo',
		'add_empty' => false
	));
	$this->widgetSchema['otradocumentacion'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Otra Documentación:</b></p>'), array('rows' => '5', 'cols' => '75'));
	
	$this->widgetSchema['condicion'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left"><b>Analisis:</b></p>',
		'expanded' => true,
		'multiple' => true,
		'model' => 'Condiciones', 
		'add_empty' => false
	));
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Observaciones:</b></p>'), array('rows' => '5', 'cols' => '75'));
		
  }
}