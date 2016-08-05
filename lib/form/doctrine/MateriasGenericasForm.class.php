<?php

/**
 * MateriasGenericas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MateriasGenericasForm extends BaseMateriasGenericasForm
{
  public function __construct($idtipomateria, $idplanestudio)
  {
    $this->idtipomateria = $idtipomateria;
    $this->idplanestudio = $idplanestudio;
    parent::__construct();
  }
  
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] 
    );

    $materias_planes = Doctrine_Core::getTable('MateriasPlanes')->obtenerMateriasComponentes($this->idtipomateria, $this->idplanestudio);
	if(count($materias_planes)> 0) {
	    foreach($materias_planes as $materia_plan){
			$arregloMaterias[$materia_plan->getIdmateriaplan()] = $materia_plan; 
		}
	} else {
		$arregloMaterias = array();
	}
	$this->widgetSchema['idmateriaplan'] = new sfWidgetFormSelect(array('choices' => $arregloMaterias));  
	$this->widgetSchema['valormateria'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Valor:</b></p>'), array('size' => '5'));
	
	$this->widgetSchema['idmateriaplan']->setAttribute('style',"width:400px");
		
	$this->widgetSchema['idmateriaplangenerica'] = new sfWidgetFormInputHidden();
	
 	// Se define los labels
 	$this->widgetSchema->setLabel('idmateriaplan', '<p align="left"><b>Materia:</b></p>');
  }
}
