<?php

/**
 * ExpedientesDerivaciones filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExpedientesDerivacionesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idexpediente'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ExpedientesEgresados'), 'add_empty' => true)),
      'idareaorigen'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idareadestino' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'activo'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'leido'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idexpediente'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ExpedientesEgresados'), 'column' => 'idexpediente')),
      'idareaorigen'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idareadestino' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observaciones' => new sfValidatorPass(array('required' => false)),
      'activo'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'leido'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('expedientes_derivaciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpedientesDerivaciones';
  }

  public function getFields()
  {
    return array(
      'idderivacion'  => 'Number',
      'idexpediente'  => 'ForeignKey',
      'idareaorigen'  => 'Number',
      'idareadestino' => 'Number',
      'observaciones' => 'Text',
      'activo'        => 'Boolean',
      'leido'         => 'Boolean',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'created_by'    => 'ForeignKey',
      'updated_by'    => 'ForeignKey',
    );
  }
}
