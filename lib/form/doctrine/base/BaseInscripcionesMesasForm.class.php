<?php

/**
 * InscripcionesMesas form base class.
 *
 * @method InscripcionesMesas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesMesasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idinscripcion'   => new sfWidgetFormInputHidden(),
      'idalumno'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idcatedra'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'idllamado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LlamadosTurno'), 'add_empty' => true)),
      'idcondicionmesa' => new sfWidgetFormInputText(),
      'idmesaexamen'    => new sfWidgetFormInputText(),
      'confirmado'      => new sfWidgetFormInputCheckbox(),
      'transferido'     => new sfWidgetFormInputCheckbox(),
      'comentario'      => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idinscripcion'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idinscripcion')), 'empty_value' => $this->getObject()->get('idinscripcion'), 'required' => false)),
      'idalumno'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'idcatedra'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'required' => false)),
      'idllamado'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LlamadosTurno'), 'required' => false)),
      'idcondicionmesa' => new sfValidatorInteger(array('required' => false)),
      'idmesaexamen'    => new sfValidatorInteger(array('required' => false)),
      'confirmado'      => new sfValidatorBoolean(array('required' => false)),
      'transferido'     => new sfValidatorBoolean(array('required' => false)),
      'comentario'      => new sfValidatorString(array('max_length' => 255)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'InscripcionesMesas', 'column' => array('idalumno', 'idcatedra', 'idllamado')))
    );

    $this->widgetSchema->setNameFormat('inscripciones_mesas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InscripcionesMesas';
  }

}
