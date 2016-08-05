<?php

/**
 * Facultades form base class.
 *
 * @method Facultades getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacultadesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idfacultad'  => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormTextarea(),
      'decano'      => new sfWidgetFormInputText(),
      'nombreabrev' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idfacultad'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idfacultad')), 'empty_value' => $this->getObject()->get('idfacultad'), 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'decano'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'nombreabrev' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('facultades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Facultades';
  }

}
