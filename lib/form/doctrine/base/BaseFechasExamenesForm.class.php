<?php

/**
 * FechasExamenes form base class.
 *
 * @method FechasExamenes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFechasExamenesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idfechaexamen'       => new sfWidgetFormInputHidden(),
      'idmateria'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => true)),
      'idcondicion'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CondicionesFechas'), 'add_empty' => true)),
      'idtipoexamen'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposExamenes'), 'add_empty' => true)),
      'idlibroacta'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibrosActas'), 'add_empty' => true)),
      'idllamado'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LlamadosTurno'), 'add_empty' => true)),
      'fecha'               => new sfWidgetFormDate(),
      'hora'                => new sfWidgetFormInputText(),
      'libro'               => new sfWidgetFormInputText(),
      'folio'               => new sfWidgetFormInputText(),
      'idestadofechaexamen' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosFechasExamenes'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idfechaexamen'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idfechaexamen')), 'empty_value' => $this->getObject()->get('idfechaexamen'), 'required' => false)),
      'idmateria'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'required' => false)),
      'idcondicion'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CondicionesFechas'), 'required' => false)),
      'idtipoexamen'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposExamenes'), 'required' => false)),
      'idlibroacta'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibrosActas'), 'required' => false)),
      'idllamado'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LlamadosTurno'), 'required' => false)),
      'fecha'               => new sfValidatorDate(),
      'hora'                => new sfValidatorString(array('max_length' => 8)),
      'libro'               => new sfValidatorString(array('max_length' => 100)),
      'folio'               => new sfValidatorString(array('max_length' => 10)),
      'idestadofechaexamen' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosFechasExamenes'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'created_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fechas_examenes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FechasExamenes';
  }

}
