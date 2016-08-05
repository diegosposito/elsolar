<?php

/**
 * InscripcionesExamenes form base class.
 *
 * @method InscripcionesExamenes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesExamenesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'idfechaexamen' => new sfWidgetFormInputText(),
      'idalumno'      => new sfWidgetFormInputText(),
      'fechaexamen'   => new sfWidgetFormDate(),
      'horaexamen'    => new sfWidgetFormTime(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idfechaexamen' => new sfValidatorInteger(array('required' => false)),
      'idalumno'      => new sfValidatorInteger(array('required' => false)),
      'fechaexamen'   => new sfValidatorDate(),
      'horaexamen'    => new sfValidatorTime(),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inscripciones_examenes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InscripcionesExamenes';
  }

}
