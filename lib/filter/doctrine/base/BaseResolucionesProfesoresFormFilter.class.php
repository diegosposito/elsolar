<?php

/**
 * ResolucionesProfesores filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResolucionesProfesoresFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idsede'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'idfacultad'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'add_empty' => true)),
      'resolucion'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_default'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'resolucion_csu'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'activa'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idsede'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'idfacultad'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facultades'), 'column' => 'idfacultad')),
      'resolucion'           => new sfValidatorPass(array('required' => false)),
      'fecha'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'is_default'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'resolucion_csu'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'activa'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('resoluciones_profesores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResolucionesProfesores';
  }

  public function getFields()
  {
    return array(
      'idresolucionprofesor' => 'Number',
      'idsede'               => 'ForeignKey',
      'idfacultad'           => 'ForeignKey',
      'resolucion'           => 'Text',
      'fecha'                => 'Date',
      'is_default'           => 'Boolean',
      'resolucion_csu'       => 'Boolean',
      'activa'               => 'Boolean',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'created_by'           => 'ForeignKey',
      'updated_by'           => 'ForeignKey',
    );
  }
}
