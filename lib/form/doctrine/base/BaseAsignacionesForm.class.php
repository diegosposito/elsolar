<?php

/**
 * Asignaciones form base class.
 *
 * @method Asignaciones getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignacionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idasignacion'  => new sfWidgetFormInputHidden(),
      'idaula'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aulas'), 'add_empty' => false)),
      'dia'           => new sfWidgetFormInputText(),
      'inicio'        => new sfWidgetFormDate(),
      'fin'           => new sfWidgetFormDate(),
      'horainicio'    => new sfWidgetFormTime(),
      'horafin'       => new sfWidgetFormTime(),
      'observaciones' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idasignacion'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idasignacion')), 'empty_value' => $this->getObject()->get('idasignacion'), 'required' => false)),
      'idaula'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Aulas'), 'required' => false)),
      'dia'           => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'inicio'        => new sfValidatorDate(),
      'fin'           => new sfValidatorDate(),
      'horainicio'    => new sfValidatorTime(array('required' => false)),
      'horafin'       => new sfValidatorTime(array('required' => false)),
      'observaciones' => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('asignaciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asignaciones';
  }

}
