<?php

/**
 * ResolucionesProfesores form base class.
 *
 * @method ResolucionesProfesores getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResolucionesProfesoresForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idresolucionprofesor' => new sfWidgetFormInputHidden(),
      'idsede'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => false)),
      'idfacultad'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'add_empty' => true)),
      'resolucion'           => new sfWidgetFormInputText(),
      'fecha'                => new sfWidgetFormDate(),
      'is_default'           => new sfWidgetFormInputCheckbox(),
      'resolucion_csu'       => new sfWidgetFormInputCheckbox(),
      'activa'               => new sfWidgetFormInputCheckbox(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idresolucionprofesor' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idresolucionprofesor')), 'empty_value' => $this->getObject()->get('idresolucionprofesor'), 'required' => false)),
      'idsede'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'))),
      'idfacultad'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'required' => false)),
      'resolucion'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fecha'                => new sfValidatorDate(),
      'is_default'           => new sfValidatorBoolean(array('required' => false)),
      'resolucion_csu'       => new sfValidatorBoolean(array('required' => false)),
      'activa'               => new sfValidatorBoolean(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'created_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resoluciones_profesores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResolucionesProfesores';
  }

}
