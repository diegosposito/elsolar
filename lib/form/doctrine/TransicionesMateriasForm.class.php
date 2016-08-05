<?php

/**
 * TransicionesMaterias form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TransicionesMateriasForm extends BaseTransicionesMateriasForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);
  	
  	$this->widgetSchema['idtransicionplan'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['idmateriaorigen'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	$this->widgetSchema['idmateriadestino'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	$this->widgetSchema['valormateria'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Valor:</b></p>'), array('size' => '5'));
  	
  	$this->widgetSchema->setLabel('idmateriaorigen', '<p align="left"><b>Materia (Origen):</b></p>');
  	$this->widgetSchema->setLabel('idmateriadestino', '<p align="left"><b>Materia (Destino):</b></p>');
  }
}
