<?php

/**
 * Edificios form base class.
 *
 * @method Edificios getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEdificiosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idedificio' => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'direccion'  => new sfWidgetFormInputText(),
      'telefono'   => new sfWidgetFormInputText(),
      'idciudad'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => false)),
      'idsede'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idedificio' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idedificio')), 'empty_value' => $this->getObject()->get('idedificio'), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 60)),
      'direccion'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telefono'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'idciudad'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'required' => false)),
      'idsede'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'created_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('edificios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Edificios';
  }

}
