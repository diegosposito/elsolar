<?php

/**
 * Solicitudes form base class.
 *
 * @method Solicitudes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSolicitudesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'idcarrera'   => new sfWidgetFormInputText(),
      'idusuario'   => new sfWidgetFormInputText(),
      'idsede'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(),
      'resuelta'    => new sfWidgetFormInputCheckbox(),
      'respuesta'   => new sfWidgetFormTextarea(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idcarrera'   => new sfValidatorInteger(),
      'idusuario'   => new sfValidatorInteger(),
      'idsede'      => new sfValidatorInteger(),
      'descripcion' => new sfValidatorString(array('max_length' => 500)),
      'resuelta'    => new sfValidatorBoolean(array('required' => false)),
      'respuesta'   => new sfValidatorString(array('max_length' => 500)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('solicitudes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Solicitudes';
  }

}
