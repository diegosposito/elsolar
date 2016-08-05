<?php

/**
 * Clases form base class.
 *
 * @method Clases getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClasesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idclase'         => new sfWidgetFormInputHidden(),
      'idasignacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AsignacionesClases'), 'add_empty' => false)),
      'fecha'           => new sfWidgetFormDate(),
      'tema'            => new sfWidgetFormInputText(),
      'temaplanificado' => new sfWidgetFormInputText(),
      'horasdictadas'   => new sfWidgetFormInputText(),
      'activo'          => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idclase'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idclase')), 'empty_value' => $this->getObject()->get('idclase'), 'required' => false)),
      'idasignacion'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AsignacionesClases'), 'required' => false)),
      'fecha'           => new sfValidatorDate(),
      'tema'            => new sfValidatorString(array('max_length' => 255)),
      'temaplanificado' => new sfValidatorString(array('max_length' => 255)),
      'horasdictadas'   => new sfValidatorInteger(array('required' => false)),
      'activo'          => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clases[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clases';
  }

}
