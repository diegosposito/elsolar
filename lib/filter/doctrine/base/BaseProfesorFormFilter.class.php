<?php

/**
 * Profesor filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexo'           => new sfWidgetFormFilterInput(),
      'idtipodoc'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'add_empty' => true)),
      'nrodoc'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numerodoc'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechanac'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaingreso'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'idciudadnac'    => new sfWidgetFormFilterInput(),
      'idnacionalidad' => new sfWidgetFormFilterInput(),
      'estadocivil'    => new sfWidgetFormFilterInput(),
      'vive'           => new sfWidgetFormFilterInput(),
      'titulo'         => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'         => new sfValidatorPass(array('required' => false)),
      'apellido'       => new sfValidatorPass(array('required' => false)),
      'sexo'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idtipodoc'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposDocumentos'), 'column' => 'idtipodoc')),
      'nrodoc'         => new sfValidatorPass(array('required' => false)),
      'numerodoc'      => new sfValidatorPass(array('required' => false)),
      'fechanac'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaingreso'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idciudadnac'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idnacionalidad' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'estadocivil'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vive'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'titulo'         => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('profesor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profesor';
  }

  public function getFields()
  {
    return array(
      'idprofesor'     => 'Number',
      'nombre'         => 'Text',
      'apellido'       => 'Text',
      'sexo'           => 'Number',
      'idtipodoc'      => 'ForeignKey',
      'nrodoc'         => 'Text',
      'numerodoc'      => 'Text',
      'fechanac'       => 'Date',
      'fechaingreso'   => 'Date',
      'idciudadnac'    => 'Number',
      'idnacionalidad' => 'Number',
      'estadocivil'    => 'Number',
      'vive'           => 'Number',
      'titulo'         => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'created_by'     => 'ForeignKey',
      'updated_by'     => 'ForeignKey',
    );
  }
}
