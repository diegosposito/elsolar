<?php

/**
 * MesasExamenes filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMesasExamenesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcatedra'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'idmateria'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => true)),
      'idcondicion'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CondicionesMesas'), 'add_empty' => true)),
      'idtipoexamen'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposExamenes'), 'add_empty' => true)),
      'idlibroacta'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibrosActas'), 'add_empty' => true)),
      'idllamado'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LlamadosTurno'), 'add_empty' => true)),
      'fecha'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'libro'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'folio'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idestadomesaexamen' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMesasExamenes'), 'add_empty' => true)),
      'activo'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcatedra'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catedras'), 'column' => 'idcatedra')),
      'idmateria'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materias'), 'column' => 'idmateria')),
      'idcondicion'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CondicionesMesas'), 'column' => 'idcondicion')),
      'idtipoexamen'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposExamenes'), 'column' => 'idtipoexamen')),
      'idlibroacta'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibrosActas'), 'column' => 'idlibroacta')),
      'idllamado'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LlamadosTurno'), 'column' => 'idllamado')),
      'fecha'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'hora'               => new sfValidatorPass(array('required' => false)),
      'libro'              => new sfValidatorPass(array('required' => false)),
      'folio'              => new sfValidatorPass(array('required' => false)),
      'idestadomesaexamen' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosMesasExamenes'), 'column' => 'idestadomesaexamen')),
      'activo'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('mesas_examenes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MesasExamenes';
  }

  public function getFields()
  {
    return array(
      'idmesaexamen'       => 'Number',
      'idcatedra'          => 'ForeignKey',
      'idmateria'          => 'ForeignKey',
      'idcondicion'        => 'ForeignKey',
      'idtipoexamen'       => 'ForeignKey',
      'idlibroacta'        => 'ForeignKey',
      'idllamado'          => 'ForeignKey',
      'fecha'              => 'Date',
      'hora'               => 'Text',
      'libro'              => 'Text',
      'folio'              => 'Text',
      'idestadomesaexamen' => 'ForeignKey',
      'activo'             => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'created_by'         => 'ForeignKey',
      'updated_by'         => 'ForeignKey',
    );
  }
}
