<?php

/**
 * Aulas filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAulasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ubicacion'   => new sfWidgetFormFilterInput(),
      'piso'        => new sfWidgetFormFilterInput(),
      'capacidad'   => new sfWidgetFormFilterInput(),
      'descripcion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idedificio'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Edificios'), 'add_empty' => true)),
      'idtipoaula'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposAulas'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'      => new sfValidatorPass(array('required' => false)),
      'ubicacion'   => new sfValidatorPass(array('required' => false)),
      'piso'        => new sfValidatorPass(array('required' => false)),
      'capacidad'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'idedificio'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Edificios'), 'column' => 'idedificio')),
      'idtipoaula'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposAulas'), 'column' => 'idtipoaula')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('aulas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Aulas';
  }

  public function getFields()
  {
    return array(
      'idaula'      => 'Number',
      'nombre'      => 'Text',
      'ubicacion'   => 'Text',
      'piso'        => 'Text',
      'capacidad'   => 'Number',
      'descripcion' => 'Text',
      'idedificio'  => 'ForeignKey',
      'idtipoaula'  => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'created_by'  => 'ForeignKey',
      'updated_by'  => 'ForeignKey',
    );
  }
}
