<?php

/**
 * EstadosFechasExamenesHistorial filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstadosFechasExamenesHistorialFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idestadofechaexamen' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosFechasExamenes'), 'add_empty' => true)),
      'idfechaexamen'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FechasExamenes'), 'add_empty' => true)),
      'idusuario'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idestadofechaexamen' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosFechasExamenes'), 'column' => 'idestadofechaexamen')),
      'idfechaexamen'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FechasExamenes'), 'column' => 'idfechaexamen')),
      'idusuario'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('estados_fechas_examenes_historial_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstadosFechasExamenesHistorial';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'idestadofechaexamen' => 'ForeignKey',
      'idfechaexamen'       => 'ForeignKey',
      'idusuario'           => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'created_by'          => 'ForeignKey',
      'updated_by'          => 'ForeignKey',
    );
  }
}
