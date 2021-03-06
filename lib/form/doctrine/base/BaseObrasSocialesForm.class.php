<?php

/**
 * ObrasSociales form base class.
 *
 * @method ObrasSociales getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseObrasSocialesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idobrasocial'            => new sfWidgetFormInputHidden(),
      'denominacion'            => new sfWidgetFormInputText(),
      'abreviada'               => new sfWidgetFormInputText(),
      'estado'                  => new sfWidgetFormInputText(),
      'ninterno'                => new sfWidgetFormInputText(),
      'general'                 => new sfWidgetFormInputCheckbox(),
      'protesis'                => new sfWidgetFormInputCheckbox(),
      'ortodoncia'              => new sfWidgetFormInputCheckbox(),
      'implantes'               => new sfWidgetFormInputCheckbox(),
      'fechaarancel'            => new sfWidgetFormDate(),
      'fechaultimoperiodo'      => new sfWidgetFormDate(),
      'fechaaranceltexto'       => new sfWidgetFormInputText(),
      'fechaultimoperiodotexto' => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'created_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idobrasocial'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idobrasocial')), 'empty_value' => $this->getObject()->get('idobrasocial'), 'required' => false)),
      'denominacion'            => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'abreviada'               => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'estado'                  => new sfValidatorInteger(array('required' => false)),
      'ninterno'                => new sfValidatorInteger(array('required' => false)),
      'general'                 => new sfValidatorBoolean(array('required' => false)),
      'protesis'                => new sfValidatorBoolean(array('required' => false)),
      'ortodoncia'              => new sfValidatorBoolean(array('required' => false)),
      'implantes'               => new sfValidatorBoolean(array('required' => false)),
      'fechaarancel'            => new sfValidatorDate(),
      'fechaultimoperiodo'      => new sfValidatorDate(),
      'fechaaranceltexto'       => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'fechaultimoperiodotexto' => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
      'created_by'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('obras_sociales[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ObrasSociales';
  }

}
