<?php

/**
 * Personas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PersonasegresadasForm extends BasePersonasForm
{
  public function configure()
  {
	unset( $this['cantgrupofamiliar'],$this['titulo'],$this['idprofesion'],$this['vive'],$this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] , $this['fechanac'], $this['fechaingreso']         );

	// Se define los labels

	$this->widgetSchema->setLabel('nombre', '<p align="left">Nombre:</p>');
	$this->widgetSchema->setLabel('apellido', '<p align="left">Apellido:</p>');
	$this->widgetSchema->setLabel('idtipodoc', '<p align="left">Tipo Doc:</p>');
	$this->widgetSchema->setLabel('idsexo', '<p align="left">Sexo:</p>');
	$this->widgetSchema->setLabel('numerodoc', '<p align="left">Numero Doc:</p>');
	//nrodoc se saca los puntos

	$this->setValidators(array(
	'nombre'    => new sfValidatorString(array('required' => true)),
	'apellido'    => new sfValidatorString(array('required' => true)),
	'numerodoc'    => new sfValidatorString(array('required' => true)),
	));
	$this->widgetSchema->setNameFormat('personas[%s]');
/*
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();*/
 }
}
