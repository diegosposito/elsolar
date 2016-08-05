<?php

/**
 * Clases filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClasesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idasignacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AsignacionesClases'), 'add_empty' => true)),
      'fecha'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tema'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'temaplanificado' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'horasdictadas'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'activo'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idasignacion'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AsignacionesClases'), 'column' => 'idasignacion')),
      'fecha'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tema'            => new sfValidatorPass(array('required' => false)),
      'temaplanificado' => new sfValidatorPass(array('required' => false)),
      'horasdictadas'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'activo'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('clases_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clases';
  }

  public function getFields()
  {
    return array(
      'idclase'         => 'Number',
      'idasignacion'    => 'ForeignKey',
      'fecha'           => 'Date',
      'tema'            => 'Text',
      'temaplanificado' => 'Text',
      'horasdictadas'   => 'Number',
      'activo'          => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'created_by'      => 'ForeignKey',
      'updated_by'      => 'ForeignKey',
    );
  }
}
