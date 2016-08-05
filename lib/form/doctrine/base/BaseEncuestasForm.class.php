<?php

/**
 * Encuestas form base class.
 *
 * @method Encuestas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEncuestasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idencuesta'  => new sfWidgetFormInputHidden(),
      'idcarrera'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carreras'), 'add_empty' => true)),
      'idsede'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'nombre'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormInputText(),
      'fecha'       => new sfWidgetFormDate(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idencuesta'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idencuesta')), 'empty_value' => $this->getObject()->get('idencuesta'), 'required' => false)),
      'idcarrera'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carreras'), 'required' => false)),
      'idsede'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 255)),
      'descripcion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fecha'       => new sfValidatorDate(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('encuestas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Encuestas';
  }

}
