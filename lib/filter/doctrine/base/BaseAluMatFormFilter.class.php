<?php

/**
 * AluMat filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAluMatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idalumno'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idcomision'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comisiones'), 'add_empty' => true)),
      'idmateria'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => true)),
      'idcatedra'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'idestadomateria'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMateria'), 'add_empty' => true)),
      'fecha'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechavencimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idalumno'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Alumnos'), 'column' => 'idalumno')),
      'idcomision'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comisiones'), 'column' => 'idcomision')),
      'idmateria'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materias'), 'column' => 'idmateria')),
      'idcatedra'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catedras'), 'column' => 'idcatedra')),
      'idestadomateria'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosMateria'), 'column' => 'idestadomateria')),
      'fecha'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechavencimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('alu_mat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AluMat';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'idalumno'         => 'ForeignKey',
      'idcomision'       => 'ForeignKey',
      'idmateria'        => 'ForeignKey',
      'idcatedra'        => 'ForeignKey',
      'idestadomateria'  => 'ForeignKey',
      'fecha'            => 'Date',
      'fechavencimiento' => 'Date',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'created_by'       => 'ForeignKey',
      'updated_by'       => 'ForeignKey',
    );
  }
}
