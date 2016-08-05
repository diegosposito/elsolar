<?php

/**
 * Correlatividades form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CorrelatividadesForm extends BaseCorrelatividadesForm
{
  public function configure()
  { 
  	unset(
      $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'], $this['idtipocorrelatividad']  
    );  		
	$arregloSituaciones = array('C' => 'Cursar', 'R' =>'Rendir');
	$arregloCondiciones = array('A' => 'Aprobada', 'R' => 'Regularizada', 'E' => 'No Posee');
	
	$this->widgetSchema['condicion'] = new sfWidgetFormSelect(array('label' => '<p align="left">Condición:</p>', 'choices' => $arregloCondiciones));	
	$this->widgetSchema['situacion'] = new sfWidgetFormSelect(array('label' => '<p align="left">Situación:</p>', 'choices' => $arregloSituaciones));
  }
}
