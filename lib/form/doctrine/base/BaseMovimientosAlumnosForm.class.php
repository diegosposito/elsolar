<?php

/**
 * MovimientosAlumnos form base class.
 *
 * @method MovimientosAlumnos getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMovimientosAlumnosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmovimiento'     => new sfWidgetFormInputHidden(),
      'idestado'         => new sfWidgetFormInputText(),
      'fecha'            => new sfWidgetFormDate(),
      'fechavencimiento' => new sfWidgetFormDate(),
      'idalumno'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idresponsable'    => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'created_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idmovimiento'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idmovimiento')), 'empty_value' => $this->getObject()->get('idmovimiento'), 'required' => false)),
      'idestado'         => new sfValidatorInteger(array('required' => false)),
      'fecha'            => new sfValidatorDate(array('required' => false)),
      'fechavencimiento' => new sfValidatorDate(array('required' => false)),
      'idalumno'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'idresponsable'    => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'created_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movimientos_alumnos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovimientosAlumnos';
  }

}
