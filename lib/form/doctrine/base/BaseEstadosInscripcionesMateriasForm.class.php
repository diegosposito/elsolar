<?php

/**
 * EstadosInscripcionesMaterias form base class.
 *
 * @method EstadosInscripcionesMaterias getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstadosInscripcionesMateriasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'idinscripcion'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inscripciones'), 'add_empty' => true)),
      'idestadoinscripcion' => new sfWidgetFormInputText(),
      'fechalibredeuda'     => new sfWidgetFormDate(),
      'observaciones'       => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idinscripcion'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inscripciones'), 'required' => false)),
      'idestadoinscripcion' => new sfValidatorInteger(array('required' => false)),
      'fechalibredeuda'     => new sfValidatorDate(array('required' => false)),
      'observaciones'       => new sfValidatorString(array('max_length' => 60)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('estados_inscripciones_materias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstadosInscripcionesMaterias';
  }

}
