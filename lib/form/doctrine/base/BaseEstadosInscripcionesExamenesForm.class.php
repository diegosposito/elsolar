<?php

/**
 * EstadosInscripcionesExamenes form base class.
 *
 * @method EstadosInscripcionesExamenes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstadosInscripcionesExamenesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'idinscripcionexamen' => new sfWidgetFormInputText(),
      'fechalibredeuda'     => new sfWidgetFormDateTime(),
      'idestadoinscripcion' => new sfWidgetFormInputText(),
      'observaciones'       => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idinscripcionexamen' => new sfValidatorInteger(array('required' => false)),
      'fechalibredeuda'     => new sfValidatorDateTime(),
      'idestadoinscripcion' => new sfValidatorInteger(array('required' => false)),
      'observaciones'       => new sfValidatorString(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('estados_inscripciones_examenes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstadosInscripcionesExamenes';
  }

}
