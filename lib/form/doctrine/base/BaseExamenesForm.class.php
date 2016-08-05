<?php

/**
 * Examenes form base class.
 *
 * @method Examenes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExamenesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idexamen'     => new sfWidgetFormInputHidden(),
      'idalumno'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idmesaexamen' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesasExamenes'), 'add_empty' => true)),
      'escrito'      => new sfWidgetFormInputText(),
      'oral'         => new sfWidgetFormInputText(),
      'promedio'     => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'created_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idexamen'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idexamen')), 'empty_value' => $this->getObject()->get('idexamen'), 'required' => false)),
      'idalumno'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'idmesaexamen' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesasExamenes'), 'required' => false)),
      'escrito'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'oral'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'promedio'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'created_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('examenes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Examenes';
  }

}
