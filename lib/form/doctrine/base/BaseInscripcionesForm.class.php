<?php

/**
 * Inscripciones form base class.
 *
 * @method Inscripciones getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'idalumno'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idciclolectivo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CicloLectivo'), 'add_empty' => true)),
      'fecha'          => new sfWidgetFormDate(),
      'hora'           => new sfWidgetFormTime(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idalumno'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'idciclolectivo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CicloLectivo'), 'required' => false)),
      'fecha'          => new sfValidatorDate(array('required' => false)),
      'hora'           => new sfValidatorTime(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inscripciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inscripciones';
  }

}
