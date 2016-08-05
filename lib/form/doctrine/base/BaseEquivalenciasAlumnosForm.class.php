<?php

/**
 * EquivalenciasAlumnos form base class.
 *
 * @method EquivalenciasAlumnos getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEquivalenciasAlumnosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idequivalencia'    => new sfWidgetFormInputHidden(),
      'idalumno'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'fecha'             => new sfWidgetFormDate(),
      'fecharesolucion'   => new sfWidgetFormDate(),
      'nroresolucion'     => new sfWidgetFormInputText(),
      'observaciones'     => new sfWidgetFormInputText(),
      'cantidadprogramas' => new sfWidgetFormInputText(),
      'nrorecibo1'        => new sfWidgetFormInputText(),
      'nrorecibo2'        => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idequivalencia'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idequivalencia')), 'empty_value' => $this->getObject()->get('idequivalencia'), 'required' => false)),
      'idalumno'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'fecha'             => new sfValidatorDate(),
      'fecharesolucion'   => new sfValidatorDate(),
      'nroresolucion'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'observaciones'     => new sfValidatorString(array('max_length' => 255)),
      'cantidadprogramas' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'nrorecibo1'        => new sfValidatorString(array('max_length' => 10)),
      'nrorecibo2'        => new sfValidatorString(array('max_length' => 10)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'created_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('equivalencias_alumnos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EquivalenciasAlumnos';
  }

}
