<?php

/**
 * SolicitudesLibredeuda filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSolicitudesLibredeudaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idusuarioorigen'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idusuariodestino'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idalumno'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idestadosolicitud' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosSolicitudes'), 'add_empty' => true)),
      'fecha'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora'              => new sfWidgetFormFilterInput(),
      'mensaje'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idusuarioorigen'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idusuariodestino'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idalumno'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Alumnos'), 'column' => 'idalumno')),
      'idestadosolicitud' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosSolicitudes'), 'column' => 'id')),
      'fecha'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'hora'              => new sfValidatorPass(array('required' => false)),
      'mensaje'           => new sfValidatorPass(array('required' => false)),
      'observaciones'     => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('solicitudes_libredeuda_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SolicitudesLibredeuda';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'idusuarioorigen'   => 'Number',
      'idusuariodestino'  => 'Number',
      'idalumno'          => 'ForeignKey',
      'idestadosolicitud' => 'ForeignKey',
      'fecha'             => 'Date',
      'hora'              => 'Text',
      'mensaje'           => 'Text',
      'observaciones'     => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'created_by'        => 'ForeignKey',
      'updated_by'        => 'ForeignKey',
    );
  }
}
