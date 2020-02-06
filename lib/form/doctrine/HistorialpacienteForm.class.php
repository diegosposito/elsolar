<?php

/**
 * Historialpaciente form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HistorialpacienteForm extends BaseHistorialpacienteForm
{
  public function configure()
  {

  	  unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'], $this['idmovimiento'] );

  	    // Se define los labels
	    $this->widgetSchema->setLabel('familiara', '<p align="left">Padre:</p>');
 	    $this->widgetSchema->setLabel('familiarb', '<p align="left">Madre:</p>');
        $this->widgetSchema->setLabel('familiarc', '<p align="left">Tutor:</p>');
 	    $this->widgetSchema->setLabel('detalle', '<p align="left">Detalle:</p>');
        $this->widgetSchema->setLabel('activo', '<p align="left">Activo:</p>');
  

      /*$oss = Doctrine_Core::getTable('ObrasSociales')->obtenerTodas();
      foreach($oss as $os){
        $arregloOS[$os->getIdObrasocial()] = $os->getAbreviada();
      }
      $this->widgetSchema['idobrasocial'] = new sfWidgetFormSelect(array('choices' => $arregloOS));
      $this->widgetSchema->setLabel('idobrasocial', '<p align="left">O. Social:</p>'); */

      $range  = range(date('Y')-80, date('Y')+1);
	  $years = array_combine($range,$range);

     
	  $this->widgetSchema['fecharegistro'] =
	  new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));
	  
	  $this->widgetSchema->setLabel('fecharegistro', '<p align="left">Fecha:</p>');
      
      $this->widgetSchema['familiara'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('familiara', '<p align="left">Padre:</p>');

      
  }
}
