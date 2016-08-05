<?php

/**
 * EscalasNotas form base class.
 *
 * @method EscalasNotas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEscalasNotasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idescalanota' => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
      'activo'       => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'created_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idescalanota' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idescalanota')), 'empty_value' => $this->getObject()->get('idescalanota'), 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'activo'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'created_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('escalas_notas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EscalasNotas';
  }

}
