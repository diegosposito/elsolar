<?php

/**
 * InscripcionesMesas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InscripcionesMesasForm extends BaseInscripcionesMesasForm
{


  protected static $arrLlamados = array(1 => "Primer llamado");

  public function configure()
  {

 	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by'], $this['idmesaexamen'],$this['idcondicionmesa'],$this['confirmado'], $this['transferido'], $this['comentario']);

		/*$tipos = Doctrine_Core::getTable('TiposMaterias')
			->createQuery('a')
			->execute();
		foreach($tipos as $tipo){
			$arregloTiposMaterias[$tipo->getIdtipomateria()] = $tipo->getDescripcion(); 
		}

		$librosactas = Doctrine_Core::getTable('LibrosActas')->obtenerLibros($idarea);
		foreach($librosactas as $libros){
				$arregloLibros[$libros->getIdlibroacta()] = $libros->getDescripcion(); 
		}  	
		asort($arregloLibros);	

		$idpe = sfContext::getInstance()->getUser()->getAttribute('idplanestudio','');
		$materiasplan = Doctrine_Core::getTable('planesestudios')->obtenerMateriasPlan($idpe);
		foreach($materiasplan as $materias){
				$arregloMaterias[$materias->getIdmateriaplan()] = $materias->getNombre(); 
		}  	
		asort($arregloMaterias);	


		$this->widgetSchema['idlibroacta'] = new sfWidgetFormSelect(array('choices' => $arregloLibros));
		$this->widgetSchema['idestadomateria'] = new sfWidgetFormSelect(array('choices' => $estadosmateria));
		$this->widgetSchema['idmateriaplan'] = new sfWidgetFormSelect(array('choices' => $arregloMaterias));
*/


		$idpe = sfContext::getInstance()->getUser()->getAttribute('idplanestudio','');
		//$idpe = 180;
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find(sfContext::getInstance()->getUser()->getAttribute('idalumno'));
			// Obtiene las materias habilitadas para cursar
			$this->materias = $this->alumno->obtenerMateriasHabilitadasAutogestion('R', 'L');

			foreach ($this->materias as $materiahabilitada) {
 
				$oCatedra = Doctrine_Core::getTable('Catedras')->find($materiahabilitada['idcatedra']);
				// obtengo mesa publicada de la catedra 
				$oMesasexamenes= new MesasExamenes();
				$oMesasexamenes->setIdCatedra($materiahabilitada['idcatedra']);
				$arrMC= $oMesasexamenes->obtenerMesasPublicadasCatedra();
				$catedrapublicada=false;
				foreach($arrMC as $mc){
					$catedrapublicada=true;
				};
				if ($catedrapublicada) $arregloMaterias[$oCatedra->getIdcatedra()] = $oCatedra->getMateriasPlanes();
			}


		/*$materiasplan = Doctrine_Core::getTable('planesestudios')->obtenerMateriasPlan($idpe);
		foreach($materiasplan as $materias){
				$arregloMaterias[$materias->getIdmateriaplan()] = $materias->getNombre(); 
		}  	*/
		asort($arregloMaterias);	


	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idllamado'] = new sfWidgetFormSelect(array('choices' => self::$arrLlamados));
	$this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => $arregloMaterias));
	$this->widgetSchema->setLabel('idcatedra', '<p align="left"><b>Materia:</b></p>');
	$this->widgetSchema->setLabel('idllamado', '<p align="left"><b>Llamado:</b></p>');
	// Se define el esquema del form
  	//$this->widgetSchema['idcatedra'] = new sfWidgetFormSelect(array('choices' => self::$arrMesasdisponibles));
  	//$this->widgetSchema->setLabel('idmesaexamen', '<p align="left"><b>Mesas Disponibles:</b></p>');


  }
}
