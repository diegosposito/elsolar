<?php

/**
 * LogEventosDesignaciones form base class.
 *
 * @method LogEventosDesignaciones getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLogEventosDesignacionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'sede'          => new sfWidgetFormInputText(),
      'facultad'      => new sfWidgetFormInputText(),
      'idfacultad'    => new sfWidgetFormInputText(),
      'idsede'        => new sfWidgetFormInputText(),
      'estado'        => new sfWidgetFormInputText(),
      'observaciones' => new sfWidgetFormTextarea(),
      'origen'        => new sfWidgetFormInputText(),
      'destinatario'  => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sede'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'facultad'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'idfacultad'    => new sfValidatorInteger(),
      'idsede'        => new sfValidatorInteger(),
      'estado'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'observaciones' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'origen'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'destinatario'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_eventos_designaciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogEventosDesignaciones';
  }

}
