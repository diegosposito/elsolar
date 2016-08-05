<?php

/**
 * MesasExamenes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InscripcionesMesasExamenesForm extends BaseInscripcionesMesasForm
{
  public function configure()
  {
	unset( 
		$this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by'], $this['idmesaexamen'],$this['idcondicionmesa'],$this['confirmado'], $this['transferido'], $this['comentario']
	);



		$this->alumno = Doctrine_Core::getTable('Alumnos')->find(sfContext::getInstance()->getUser()->getAttribute('idalumno'));
		// Obtiene las materias habilitadas para cursar
		$this->materias = $this->alumno->obtenerMateriasHabilitadasAutogestion('R', 'L');
		$arregloMaterias= array();
		array_push($arregloMaterias,'----Seleccione----');
		foreach ($this->materias as $materiahabilitada) {

			$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
			// obtengo mesa publicada de la catedra 
			$oMesasexamenes= new MesasExamenes();
			$oMesasexamenes->setIdCatedra($materiahabilitada['idcatedra']);
			$arrMC= $oMesasexamenes->obtenerMesasPublicadasCatedra();
			$catedrapublicada=false;
			//foreach($arrMC as $mc){
				$catedrapublicada=true;
			//};
			if ($catedrapublicada) $arregloMaterias[$oCatedra->getIdcatedra()] = $oCatedra->getMateriasPlanes();
		}

	$this->widgetSchema['idmateriaplan'] = new sfWidgetFormSelect(array('label' => '<p align="left"><b>Materia:</b></p>', 'choices' => $arregloMaterias));

	$this->widgetSchema['idturno'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['idllamado'] = new sfWidgetFormSelect(array('choices' => array(0 => '----Seleccione----')));

 	// Se define los labels
 	$this->widgetSchema->setLabel('idmateriaplan', '<p align="left"><b>Materia:</b></p>');
 	
 	$this->widgetSchema->setLabel('idturno', '<p align="left"><b>Turno:</b></p>');
 	$this->widgetSchema->setLabel('idllamado', '<p align="left"><b>Llamado:</b></p>'); 	
	
	$this->validatorSchema->setOption('allow_extra_fields',true); 	  	
  }
}
