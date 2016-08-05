<?php

/**
 * Designaciones filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDesignacionesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcatedra'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'idprofesor'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesores'), 'add_empty' => true)),
      'idtipodesignacion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDesignaciones'), 'add_empty' => true)),
      'inicio'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fin'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaaprobacion'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'horas'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'activo'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'adhonorem'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'licencia'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'visibleensede'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'idresolucionprofesor'   => new sfWidgetFormFilterInput(),
      'idresolucioncsu'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ResolucionesProfesores'), 'add_empty' => true)),
      'iddedicacion'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dedicaciones'), 'add_empty' => true)),
      'idestadodesignacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosDesignaciones'), 'add_empty' => true)),
      'observaciones'          => new sfWidgetFormFilterInput(),
      'motivonuevadesignacion' => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcatedra'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catedras'), 'column' => 'idcatedra')),
      'idprofesor'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesores'), 'column' => 'idprofesor')),
      'idtipodesignacion'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposDesignaciones'), 'column' => 'idtipodesignacion')),
      'inicio'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fin'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaaprobacion'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'horas'                  => new sfValidatorPass(array('required' => false)),
      'activo'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'adhonorem'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'licencia'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'visibleensede'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'idresolucionprofesor'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idresolucioncsu'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ResolucionesProfesores'), 'column' => 'idresolucionprofesor')),
      'iddedicacion'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dedicaciones'), 'column' => 'iddedicacion')),
      'idestadodesignacion'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosDesignaciones'), 'column' => 'idestadodesignacion')),
      'observaciones'          => new sfValidatorPass(array('required' => false)),
      'motivonuevadesignacion' => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('designaciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Designaciones';
  }

  public function getFields()
  {
    return array(
      'iddesignacion'          => 'Number',
      'idcatedra'              => 'ForeignKey',
      'idprofesor'             => 'ForeignKey',
      'idtipodesignacion'      => 'ForeignKey',
      'inicio'                 => 'Date',
      'fin'                    => 'Date',
      'fechaaprobacion'        => 'Date',
      'horas'                  => 'Text',
      'activo'                 => 'Boolean',
      'adhonorem'              => 'Boolean',
      'licencia'               => 'Boolean',
      'visibleensede'          => 'Boolean',
      'idresolucionprofesor'   => 'Number',
      'idresolucioncsu'        => 'ForeignKey',
      'iddedicacion'           => 'ForeignKey',
      'idestadodesignacion'    => 'ForeignKey',
      'observaciones'          => 'Text',
      'motivonuevadesignacion' => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'created_by'             => 'ForeignKey',
      'updated_by'             => 'ForeignKey',
    );
  }
}
