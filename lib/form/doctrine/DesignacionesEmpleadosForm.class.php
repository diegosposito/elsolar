<?php

/**
 * DesignacionesEmpleados form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DesignacionesEmpleadosForm extends BaseDesignacionesEmpleadosForm
{
  public function configure()
  {
    unset(
      $this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['libro'], $this['folio'], $this['idlibroacta'], $this['idestadomesaexamen'], $this['idtipoexamen']
    );
      	
  	$areas = Doctrine_Core::getTable('Areas')
      ->createQuery('a')
      ->where('a.idtipoarea IN (2,3,4,5,7)')
      ->orderBy('a.descripcion ASC')
      ->execute();  	
      
  	foreach($areas as $area){
  			$arregloAreas[$area->getIdarea()] = $area->getDescripcion(); 
	}  	
	asort($arregloAreas);	
	      
  	$this->widgetSchema['idempleado'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idarea'] = new sfWidgetFormSelect(array('choices' => $arregloAreas));
	$this->widgetSchema['idtipocargo'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
  	$this->widgetSchema['inicio'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Inicio:</b></p>'), array('size' =>'10'));
  	$this->widgetSchema['fin'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Fin:</b></p>'), array('size' =>'10'));
  	$this->widgetSchema['nroresolucion'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nro. de resolución:</b></p>'), array('value' => '', 'size' => '15'));
  	$this->widgetSchema['idsede'] = new sfWidgetFormDoctrineChoice(array(
  			'expanded' => false,
  			'multiple' => false,
  			'model' => 'Sedes',
  			'add_empty' => false
  	));
  	  	
 	// Se define los labels
 	$this->widgetSchema->setLabel('idarea', '<p align="left"><b>Area:</b></p>');
 	$this->widgetSchema->setLabel('idtipocargo', '<p align="left"><b>Tipo de Cargo:</b></p>');
 	$this->widgetSchema->setLabel('titulo', '<p align="left"><b>Abreviación del Título(*):</b></p>');  	
 	$this->widgetSchema->setLabel('activo', '<p align="left"><b>Activo?:</b></p>');	 
 	$this->widgetSchema->setLabel('idsede', '<p align="left"><b>Sede:</b></p>');
 	
 	$this->validatorSchema['fin']->setOption('required', false);
 	$this->validatorSchema['inicio']->setMessage('required', 'Requerido'); 	
  }
}
