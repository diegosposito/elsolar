<?php

/**
 * MateriasPlanes form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MateriasPlanesForm extends BaseMateriasPlanesForm
{
	public function configure()
	{
		unset( $this['regularpararendirlibre'], $this['vigencia'], $this['porcentajepararendir'], $this['cantidadaplazoslibre'], $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by'] );
	
		$tipos = Doctrine_Core::getTable('TiposMaterias')
			->createQuery('a')
			->execute();
		foreach($tipos as $tipo){
			$arregloTiposMaterias[$tipo->getIdtipomateria()] = $tipo->getDescripcion(); 
		}
		$arregloTiposGenerica = array('0' => 'Ninguna', '4' => 'Optativas', '2' =>'Sub Espacios');
		
		$this->widgetSchema['idmateria'] = new sfWidgetFormDoctrineChoice(array(
			'expanded' => false,
			'multiple' => false,
			'model' => 'Materias',
			'order_by' => array('nombre', 'asc'),
			'label' => '<p align="left"><b>Asignatura:</b></p>',
			'add_empty' => false
		)); 
	
		$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nombre:</b></p>'), array('size' => '75'));
		$this->widgetSchema['nombrereducido'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Nombre reducido:</b></p>'), array('size' => '50'));
	
		$this->widgetSchema['idtipomateria'] = new sfWidgetFormChoice(array('choices' => $arregloTiposMaterias));
		$this->widgetSchema['idtipocursada'] = new sfWidgetFormDoctrineChoice(array(
			'expanded' => false,
			'multiple' => false,
			'model' => 'TiposCursadas',
			'label' => '<p align="left"><b>Modalidad de dictado:</b></p>',
			'add_empty' => false
		)); 	
		$this->widgetSchema['idmateria']->setAttribute('style',"width:400px");
	
		$this->widgetSchema['orden'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Orden:</b></p>'), array('size' => '2'));
		$this->widgetSchema['periododecursada'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Periodo de cursada:</b></p>'), array('size' => '2'));	
		$this->widgetSchema['anodecursada'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Año de cursado:</b></p>'), array('size' => '2'));	
		$this->widgetSchema['cargahorariasemanal'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Carga horaria semanal:</b></p>'), array('size' => '2'));
		$this->widgetSchema['cargahorariatotal'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Carga horaria total:</b></p>'), array('size' => '2'));
		$this->widgetSchema['cantidadaplazos'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Cantidad de aplazos:</b></p>'), array('size' => '2'));

		$this->widgetSchema['credito'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Credito:</b></p>'), array('size' => '2'));
		$this->widgetSchema['puntajerequerido'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Puntaje requerido:</b></p>'), array('size' => '2'));
		$this->widgetSchema['codmat'] = new sfWidgetFormInput(array('label' => '<p align="left"><b>Codigo:</b></p>'), array('size' => '5'));
		$this->widgetSchema['idplanestudio'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['contenidominimo'] = new sfWidgetFormTextarea(array('label' => '<p align="left"><b>Contenidos minimos:</b></p>'), array('size' => '50'));
		$this->widgetSchema['generica'] = new sfWidgetFormChoice(array('choices' => $arregloTiposGenerica));
		$this->setDefault('generica', '0');

		// Se define los labels
		$this->widgetSchema->setLabel('idtipomateria', '<p align="left"><b>Tipo de asignatura:</b></p>');
		$this->widgetSchema->setLabel('saleanalitico', '<p align="left"><b>Sale analitico?</b></p>');
		$this->widgetSchema->setLabel('generica', '<p align="left"><b>Asignatura que contiene?</b></p>');

		$this->validatorSchema['idtipomateria'] = new sfValidatorChoice(array('choices' => array_keys($arregloTiposMaterias)));
		$this->validatorSchema['orden'] = new sfValidatorInteger(array('required' => true), array('required' => '<font color="red">El valor es requerido.</font>'));	
		$this->validatorSchema['periododecursada'] = new sfValidatorInteger(array('min' => '1', 'max' => '9', 'required' => true), array('required' => '<font color="red">El valor es requerido.</font>', 'max' => '<font color="red">El maximo permitido es 9.</font>', 'min' => '<font color="red">El minimo permitido es 1.</font>'));
		$this->validatorSchema['anodecursada'] = new sfValidatorInteger(array('min' => '1', 'required' => true), array('required' => '<font color="red">El valor es requerido.</font>', 'min' => '<font color="red">El minimo permitido es 1.</font>'));	
		$this->validatorSchema['cantidadaplazos'] = new sfValidatorInteger(array('required' => true), array('required' => '<font color="red">El valor es requerido.</font>'));
		$this->validatorSchema['credito'] = new sfValidatorInteger(array('required' => true), array('required' => '<font color="red">El valor es requerido.</font>'));
		
		// Añado un post validator
		$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
			new sfValidatorCallback(array('callback' => array($this, 'checkCantidadMaterias'))),
			new sfValidatorCallback(array('callback' => array($this, 'checkHorasDisponibles'))),
			new sfValidatorCallback(array('callback' => array($this, 'checkDuracion'))),
			new sfValidatorCallback(array('callback' => array($this, 'checkCantidadMateriasGenericas')))
		))); 
	}
  
	public function checkCantidadMateriasGenericas($validator, $values)
	{
		$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($values['idplanestudio']);
		
		$cantidadGenericasTotales = $oPlanEstudio->getCantidadgenericas();
		$cantidadGenericasAcumuladas = $oPlanEstudio->obtenerCantidadMateriasGenericas();
		$cantidadGenericasDisponibles = $cantidadGenericasTotales - $cantidadGenericasAcumuladas;
		if($values['generica']) {
			if($cantidadGenericasDisponibles < 0) {
				$error = new sfValidatorError($validator, '<font color="red">Se ha alcanzado el maximo permitido de asignaturas genericas.</font>');
				// throw an error bound to the password field
				throw new sfValidatorErrorSchema($validator, array('generica' => $error));  
			}
		}			
		return $values;
	}  
 
	public function checkCantidadMaterias($validator, $values)
	{
		$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($values['idplanestudio']);
		$cantidadTotales = 0;
		$cantidadAcumuladas = 0;
		$cantidadDisponibles = 0;
		
		// Obtiene la cantidad de materias del tipo seleccionado
		switch ($values['idtipomateria']) {
			case 1: // Obligatorias
				$cantidadTotales = $oPlanEstudio->getCantidadcomunes();
				break;
			case 3: // Preuniversitarias
				$cantidadTotales = $oPlanEstudio->getCantidadpreuniversitarias();
				break;				
			case 4: // Optativas
				$cantidadTotales = $oPlanEstudio->getCantidadoptativas();
				break;
			case 5: // Extracurriculares
				$cantidadTotales = $oPlanEstudio->getCantidadextracurriculares();
				break;
			case 6: // Tesinas 	
				$cantidadTotales = $oPlanEstudio->getCantidadtesinas();
				break;
			case 7: // Trabajos finales
				$cantidadTotales = $oPlanEstudio->getCantidadtpfinal();
				break;
		}
		$cantidadAcumuladas = $oPlanEstudio->obtenerCantidadMateriasAcumuladas($values['idtipomateria']);	
		
		$cantidadDisponibles = $cantidadTotales - $cantidadAcumuladas;
	 	if($cantidadDisponibles <= 0){
			$error = new sfValidatorError($validator, '<font color="red">Se ha alcanzado el maximo permitido para dicho tipo de asignatura.</font>');
	
			// throw an error bound to the password field
			throw new sfValidatorErrorSchema($validator, array('idtipomateria' => $error));  
 		}
		return $values;
	}   
	
	public function checkHorasDisponibles($validator, $values)
	{
		$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($values['idplanestudio']);
	
		$horasTotales = $oPlanEstudio->getHorastotales();
  		$horasAcumuladas = $oPlanEstudio->obtenerHorasAcumuladas();
  		$horasDisponibles = $horasTotales - $horasAcumuladas;
		if ($values['idmateriaplan']) {
			$oMateriaPlan = Doctrine_Core::getTable('MateriasPlanes')->find($values['idmateriaplan']);
			$cargaHoraria = $oMateriaPlan->getCargahorariatotal();
			$horasDisponibles = $horasDisponibles + $cargaHoraria;
		}
		
	 	if($horasDisponibles < $values['cargahorariatotal']){
			$error = new sfValidatorError($validator, '<font color="red">El maximo permitido es '.$horasDisponibles.'.</font>');
	
			// throw an error bound to the password field
			throw new sfValidatorErrorSchema($validator, array('cargahorariatotal' => $error));  
 		}
		return $values;
	}   	
	
	public function checkDuracion($validator, $values)
	{
		$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($values['idplanestudio']);
	
		$duracion = $oPlanEstudio->getDuracionnumerica();
  	
	 	if($duracion < $values['anodecursada']){
			$error = new sfValidatorError($validator, '<font color="red">El maximo permitido es '.$duracion.'.</font>');
	
			// throw an error bound to the password field
			throw new sfValidatorErrorSchema($validator, array('anodecursada' => $error));  
 		}
		return $values;
	}   		
}
