<?php

/**
 * Edificios filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEdificiosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'  => new sfWidgetFormFilterInput(),
      'telefono'   => new sfWidgetFormFilterInput(),
      'idciudad'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'idsede'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'     => new sfValidatorPass(array('required' => false)),
      'direccion'  => new sfValidatorPass(array('required' => false)),
      'telefono'   => new sfValidatorPass(array('required' => false)),
      'idciudad'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudades'), 'column' => 'idciudad')),
      'idsede'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('edificios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Edificios';
  }

  public function getFields()
  {
    return array(
      'idedificio' => 'Number',
      'nombre'     => 'Text',
      'direccion'  => 'Text',
      'telefono'   => 'Text',
      'idciudad'   => 'ForeignKey',
      'idsede'     => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'created_by' => 'ForeignKey',
      'updated_by' => 'ForeignKey',
    );
  }
}
