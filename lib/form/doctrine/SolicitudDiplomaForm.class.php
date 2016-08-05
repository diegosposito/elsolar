<?php

/**
 * ExpedientesEgresados form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SolicitudDiplomaForm extends BaseExpedientesEgresadosForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['idderivacionbiblioteca'], $this['idderivacionadministracion'], $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
	  	
	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idtitulo'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idestadoalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['fechasolicitud'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha:</p>'), array('size' =>'8', 'value' => date('d-m-Y')));
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextarea(array('label' => '<p align="left">Observaciones:</p>'), array('size' => '50'));
 	
	// Se define los labels
 	$this->widgetSchema->setLabel('idestadoalumno', '<p align="left">Estado:</p>');  	
  }
}
