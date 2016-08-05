<?php

/**
 * FichaAlumnos filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFichaAlumnosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idalumno'         => new sfWidgetFormFilterInput(),
      'idmateriaplan'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'add_empty' => true)),
      'idlibroacta'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibrosActas'), 'add_empty' => true)),
      'fecha'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'folio'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'promedio'         => new sfWidgetFormFilterInput(),
      'idestadomateria'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMateria'), 'add_empty' => true)),
      'fechavencimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'controlado'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'transferido'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idalumno'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idmateriaplan'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MateriasPlanes'), 'column' => 'idmateriaplan')),
      'idlibroacta'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibrosActas'), 'column' => 'idlibroacta')),
      'fecha'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'folio'            => new sfValidatorPass(array('required' => false)),
      'promedio'         => new sfValidatorPass(array('required' => false)),
      'idestadomateria'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosMateria'), 'column' => 'idestadomateria')),
      'fechavencimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'controlado'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'transferido'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ficha_alumnos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FichaAlumnos';
  }

  public function getFields()
  {
    return array(
      'idficha'          => 'Number',
      'idalumno'         => 'Number',
      'idmateriaplan'    => 'ForeignKey',
      'idlibroacta'      => 'ForeignKey',
      'fecha'            => 'Date',
      'folio'            => 'Text',
      'promedio'         => 'Text',
      'idestadomateria'  => 'ForeignKey',
      'fechavencimiento' => 'Date',
      'controlado'       => 'Boolean',
      'transferido'      => 'Boolean',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'created_by'       => 'ForeignKey',
      'updated_by'       => 'ForeignKey',
    );
  }
}
