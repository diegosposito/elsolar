<?php

/**
 * FichaAlumnos form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FichaAlumnosForm extends BaseFichaAlumnosForm
{
  public function configure()
  {


    unset(
      $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']
    );
	$this->validatorSchema['promedio']->setOption('required', false);
	$this->validatorSchema['folio']->setOption('required', false);
        $this->validatorSchema['folio']->setOption('max_length', 3);
	//$this->validatorSchema['idalumno']->setOption('required', false);
	
        
        $this->validatorSchema['fechavencimiento']->setOption('required', false);
	$this->widgetSchema['promedio'] = new sfWidgetFormInput(array('label' => '<p align="left">Calificación:</p>'), array('size' =>'4'));	

		$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();

		//formato de los campos fecha 
		$format = '%day%/%month%/%year%';

		//define el rango de campo fecha
		$range  = range(date('Y')-14, date('Y'));
		$years = array_combine($range,$range);
		// setea la condifuracion de campo fecha en el campo del formulario
		$this->widgetSchema['fecha'] = new sfWidgetFormDate(array('years' => $years, 'format' => $format ));

		//define el rango de campo fecha
		$range1  = range(date('Y')-2, date('Y')+3);
		$years1 = array_combine($range1,$range1);
		// setea la condifuracion de campo fecha en el campo del formulario
		$this->widgetSchema['fechavencimiento'] = new sfWidgetFormDate(array('years' => $years1, 'format' => $format ));

		$this->widgetSchema->setLabel('idlibroacta', '<p align="left">Libro:</p>');
		$this->widgetSchema->setLabel('idmateriaplan', '<p align="left">Materia:</p>');
		$this->widgetSchema->setLabel('idestadomateria', '<p align="left">Estado Materia:</p>');
		$this->widgetSchema->setLabel('fechavencimiento', '<p align="left">Fecha Vencimiento:</p>');

		$idarea = sfContext::getInstance()->getUser()->getProfile()->getIdarea();  

		$librosactas = Doctrine_Core::getTable('LibrosActas')->obtenerLibros($idarea);
		foreach($librosactas as $libros){
				$arregloLibros[$libros->getIdlibroacta()] = $libros->getDescripcion(); 
		}  	
		asort($arregloLibros);	

		$estadosmateria = Doctrine_Core::getTable('EstadosMateria')->obtenerEstadosFichaAlumno();

		$idpe = sfContext::getInstance()->getUser()->getAttribute('idplanestudio','');
		$materiasplan = Doctrine_Core::getTable('planesestudios')->obtenerMateriasPlan($idpe);
		foreach($materiasplan as $materias){
				$arregloMaterias[$materias->getIdmateriaplan()] = $materias->getNombre(); 
		}  	
		asort($arregloMaterias);	


		$this->widgetSchema['idlibroacta'] = new sfWidgetFormSelect(array('choices' => $arregloLibros));
		$this->widgetSchema['idestadomateria'] = new sfWidgetFormSelect(array('choices' => $estadosmateria));
		$this->widgetSchema['idmateriaplan'] = new sfWidgetFormSelect(array('choices' => $arregloMaterias));
  }
}
