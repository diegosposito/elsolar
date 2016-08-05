<?php

/**
 * MateriasEquivalencias form base class.
 *
 * @method MateriasEquivalencias getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMateriasEquivalenciasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'idequivalencia'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EquivalenciasAlumnos'), 'add_empty' => true)),
      'idmateriaplan'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'add_empty' => true)),
      'idestadoequivalencia' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosEquivalencias'), 'add_empty' => true)),
      'fecha'                => new sfWidgetFormDate(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idequivalencia'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EquivalenciasAlumnos'), 'required' => false)),
      'idmateriaplan'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'required' => false)),
      'idestadoequivalencia' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosEquivalencias'), 'required' => false)),
      'fecha'                => new sfValidatorDate(),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'created_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('materias_equivalencias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MateriasEquivalencias';
  }

}
