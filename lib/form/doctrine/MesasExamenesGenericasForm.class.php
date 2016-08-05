<?php

/**
 * MesasExamenesGenericas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MesasExamenesGenericasForm extends BaseMesasExamenesForm
{
  public function configure()
  {
    unset(
      $this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['libro'], $this['folio'], $this['idlibroacta'], $this['idestadomesaexamen'], $this['idtipoexamen']
    );
    
  	$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede',''); 
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 

	// Se define el esquema del form
	$this->widgetSchema['idcondicion'] = new sfWidgetFormDoctrineChoice(array('expanded' => false, 'multiple' => false, 'model' => 'CondicionesMesas', 'add_empty' => false ));
	$this->widgetSchema['idturno'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idllamado'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['fecha'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fecha:</b></p>'), array('size' =>'10'));
	$this->widgetSchema['hora'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Hora:</b></p>'), array('size' =>'6'));
	$this->widgetSchema['idsede'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idmateriaplan'] = new sfWidgetFormInputHidden();
	
	// Se define los valores por defecto	
	$this->widgetSchema->setDefault('idsede', $idsede);	
 	// Se define los labels
 	$this->widgetSchema->setLabel('idcondicion', '<p align="left"><b>Condición:</b></p>');
 	$this->widgetSchema->setLabel('idturno', '<p align="left"><b>Turno:</b></p>');
 	$this->widgetSchema->setLabel('idllamado', '<p align="left"><b>Llamado:</b></p>'); 	
 		
	//$this->validatorSchema->setOption('allow_extra_fields',true); 	  	
  }
}
