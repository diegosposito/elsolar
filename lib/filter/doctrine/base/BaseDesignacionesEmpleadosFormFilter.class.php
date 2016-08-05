<?php

/**
 * DesignacionesEmpleados filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDesignacionesEmpleadosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idempleado'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empleados'), 'add_empty' => true)),
      'idarea'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Areas'), 'add_empty' => true)),
      'idtipocargo'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCargos'), 'add_empty' => true)),
      'idsede'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'inicio'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fin'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'titulo'        => new sfWidgetFormFilterInput(),
      'activo'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nroresolucion' => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idempleado'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Empleados'), 'column' => 'idempleado')),
      'idarea'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Areas'), 'column' => 'idarea')),
      'idtipocargo'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposCargos'), 'column' => 'idtipocargo')),
      'idsede'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'inicio'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fin'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'titulo'        => new sfValidatorPass(array('required' => false)),
      'activo'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nroresolucion' => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('designaciones_empleados_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DesignacionesEmpleados';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'idempleado'    => 'ForeignKey',
      'idarea'        => 'ForeignKey',
      'idtipocargo'   => 'ForeignKey',
      'idsede'        => 'ForeignKey',
      'inicio'        => 'Date',
      'fin'           => 'Date',
      'titulo'        => 'Text',
      'activo'        => 'Boolean',
      'nroresolucion' => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'created_by'    => 'ForeignKey',
      'updated_by'    => 'ForeignKey',
    );
  }
}
