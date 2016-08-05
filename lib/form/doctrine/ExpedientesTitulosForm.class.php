<?php

/**
 * ExpedientesTitulos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ExpedientesTitulosForm extends BaseExpedientesEgresadosForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['fechasolicitud'], $this['nerorecibo1'], $this['activo'], $this['idderivacionbiblioteca'], $this['idderivacionadministracion'], $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
	  	
	$this->widgetSchema['observaciones'] = new sfWidgetFormTextArea(array('label' => '<p align="left"><b>Observaciones:</b></p>'), array('rows' => '5', 'cols' => '75'));
	$this->widgetSchema['nrorecibo2'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nro. recibo:</b></p>'), array('size' =>'6'));
	$this->widgetSchema['registrodiplomame'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Registro de diploma M.E.:</b></p>'), array('size' =>'6')); 
	$this->widgetSchema['registrocertificadome'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Registro de certificado M.E.:</b></p>'), array('size' =>'6'));
	$this->widgetSchema['idexpediente'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['fechaenviome'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha de envio a M.E.:</b></p>'), array('size' =>'10'));
	$this->widgetSchema['fecharecibidome'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha de recepción de M.E.:</b></p>'), array('size' =>'10'));
	$this->widgetSchema['fechaentregatitulo'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha de entrega de título:</b></p>'), array('size' =>'10'));
	
  }
}