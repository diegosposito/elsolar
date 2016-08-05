<?php

/**
 * Comisiones filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseComisionesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'           => new sfWidgetFormFilterInput(),
      'inscripcionhabilitada' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'capacidad'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'letrainicio'           => new sfWidgetFormFilterInput(),
      'letrafin'              => new sfWidgetFormFilterInput(),
      'turno'                 => new sfWidgetFormFilterInput(),
      'activo'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'idestadocomision'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosComisiones'), 'add_empty' => true)),
      'idcatedra'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'                => new sfValidatorPass(array('required' => false)),
      'descripcion'           => new sfValidatorPass(array('required' => false)),
      'inscripcionhabilitada' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'capacidad'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'letrainicio'           => new sfValidatorPass(array('required' => false)),
      'letrafin'              => new sfValidatorPass(array('required' => false)),
      'turno'                 => new sfValidatorPass(array('required' => false)),
      'activo'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'idestadocomision'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosComisiones'), 'column' => 'idestadocomision')),
      'idcatedra'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catedras'), 'column' => 'idcatedra')),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('comisiones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comisiones';
  }

  public function getFields()
  {
    return array(
      'idcomision'            => 'Number',
      'nombre'                => 'Text',
      'descripcion'           => 'Text',
      'inscripcionhabilitada' => 'Boolean',
      'capacidad'             => 'Number',
      'letrainicio'           => 'Text',
      'letrafin'              => 'Text',
      'turno'                 => 'Text',
      'activo'                => 'Boolean',
      'idestadocomision'      => 'ForeignKey',
      'idcatedra'             => 'ForeignKey',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'created_by'            => 'ForeignKey',
      'updated_by'            => 'ForeignKey',
    );
  }
}
