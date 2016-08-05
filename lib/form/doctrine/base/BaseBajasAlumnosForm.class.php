<?php

/**
 * BajasAlumnos form base class.
 *
 * @method BajasAlumnos getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBajasAlumnosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idbaja'        => new sfWidgetFormInputHidden(),
      'idalumno'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'fecha'         => new sfWidgetFormDate(),
      'fechabaja'     => new sfWidgetFormDate(),
      'tiposolicitud' => new sfWidgetFormInputText(),
      'tipobaja'      => new sfWidgetFormInputText(),
      'otromotivo'    => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idbaja'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idbaja')), 'empty_value' => $this->getObject()->get('idbaja'), 'required' => false)),
      'idalumno'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'fecha'         => new sfValidatorDate(),
      'fechabaja'     => new sfValidatorDate(),
      'tiposolicitud' => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'tipobaja'      => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'otromotivo'    => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bajas_alumnos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BajasAlumnos';
  }

}
