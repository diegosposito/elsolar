<?php

/**
 * Materias form base class.
 *
 * @method Materias getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMateriasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmateria'       => new sfWidgetFormInputHidden(),
      'nombre'          => new sfWidgetFormInputText(),
      'nombrereducido'  => new sfWidgetFormInputText(),
      'contenidominimo' => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idmateria'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idmateria')), 'empty_value' => $this->getObject()->get('idmateria'), 'required' => false)),
      'nombre'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nombrereducido'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'contenidominimo' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('materias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Materias';
  }

}
