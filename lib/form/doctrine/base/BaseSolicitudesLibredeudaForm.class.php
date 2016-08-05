<?php

/**
 * SolicitudesLibredeuda form base class.
 *
 * @method SolicitudesLibredeuda getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSolicitudesLibredeudaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'idusuarioorigen'   => new sfWidgetFormInputText(),
      'idusuariodestino'  => new sfWidgetFormInputText(),
      'idalumno'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => false)),
      'idestadosolicitud' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosSolicitudes'), 'add_empty' => false)),
      'fecha'             => new sfWidgetFormDate(),
      'hora'              => new sfWidgetFormTime(),
      'mensaje'           => new sfWidgetFormInputText(),
      'observaciones'     => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idusuarioorigen'   => new sfValidatorInteger(),
      'idusuariodestino'  => new sfValidatorInteger(),
      'idalumno'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'))),
      'idestadosolicitud' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosSolicitudes'))),
      'fecha'             => new sfValidatorDate(array('required' => false)),
      'hora'              => new sfValidatorTime(array('required' => false)),
      'mensaje'           => new sfValidatorString(array('max_length' => 255)),
      'observaciones'     => new sfValidatorString(array('max_length' => 255)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'created_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('solicitudes_libredeuda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SolicitudesLibredeuda';
  }

}
