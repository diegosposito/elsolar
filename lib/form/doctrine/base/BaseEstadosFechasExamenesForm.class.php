<?php

/**
 * EstadosFechasExamenes form base class.
 *
 * @method EstadosFechasExamenes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstadosFechasExamenesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idestadofechaexamen' => new sfWidgetFormInputHidden(),
      'descripcion'         => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idestadofechaexamen' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idestadofechaexamen')), 'empty_value' => $this->getObject()->get('idestadofechaexamen'), 'required' => false)),
      'descripcion'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'created_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estados_fechas_examenes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstadosFechasExamenes';
  }

}
