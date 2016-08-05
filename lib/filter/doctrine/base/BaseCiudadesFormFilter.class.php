<?php

/**
 * Ciudades filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCiudadesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddepartamento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Departamentos'), 'add_empty' => true)),
      'idprovincia'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Provincias'), 'add_empty' => true)),
      'descripcion'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codpostal'      => new sfWidgetFormFilterInput(),
      'chequeada'      => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddepartamento' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Departamentos'), 'column' => 'iddepartamento')),
      'idprovincia'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Provincias'), 'column' => 'idprovincia')),
      'descripcion'    => new sfValidatorPass(array('required' => false)),
      'codpostal'      => new sfValidatorPass(array('required' => false)),
      'chequeada'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ciudades_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ciudades';
  }

  public function getFields()
  {
    return array(
      'idciudad'       => 'Number',
      'iddepartamento' => 'ForeignKey',
      'idprovincia'    => 'ForeignKey',
      'descripcion'    => 'Text',
      'codpostal'      => 'Text',
      'chequeada'      => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'created_by'     => 'ForeignKey',
      'updated_by'     => 'ForeignKey',
    );
  }
}
