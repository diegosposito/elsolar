<?php

/**
 * NoDocentes filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNoDocentesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idlegajo'        => new sfWidgetFormFilterInput(),
      'nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idsexo'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexo'), 'add_empty' => true)),
      'idtipodoc'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'add_empty' => true)),
      'nrodoc'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cuit'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechanac'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaingreso'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'idcategoria'     => new sfWidgetFormFilterInput(),
      'categoria'       => new sfWidgetFormFilterInput(),
      'idciudadnac'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'idnacionalidad'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Paises'), 'add_empty' => true)),
      'idsede'          => new sfWidgetFormFilterInput(),
      'idfacultad'      => new sfWidgetFormFilterInput(),
      'titulo'          => new sfWidgetFormFilterInput(),
      'cargo'           => new sfWidgetFormFilterInput(),
      'nivel_educativo' => new sfWidgetFormFilterInput(),
      'area'            => new sfWidgetFormFilterInput(),
      'direccion'       => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idlegajo'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'          => new sfValidatorPass(array('required' => false)),
      'apellido'        => new sfValidatorPass(array('required' => false)),
      'idsexo'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sexo'), 'column' => 'idsexo')),
      'idtipodoc'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposDocumentos'), 'column' => 'idtipodoc')),
      'nrodoc'          => new sfValidatorPass(array('required' => false)),
      'cuit'            => new sfValidatorPass(array('required' => false)),
      'fechanac'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaingreso'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idcategoria'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'categoria'       => new sfValidatorPass(array('required' => false)),
      'idciudadnac'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudades'), 'column' => 'idciudad')),
      'idnacionalidad'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Paises'), 'column' => 'idpais')),
      'idsede'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idfacultad'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'titulo'          => new sfValidatorPass(array('required' => false)),
      'cargo'           => new sfValidatorPass(array('required' => false)),
      'nivel_educativo' => new sfValidatorPass(array('required' => false)),
      'area'            => new sfValidatorPass(array('required' => false)),
      'direccion'       => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('no_docentes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NoDocentes';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'idlegajo'        => 'Number',
      'nombre'          => 'Text',
      'apellido'        => 'Text',
      'idsexo'          => 'ForeignKey',
      'idtipodoc'       => 'ForeignKey',
      'nrodoc'          => 'Text',
      'cuit'            => 'Text',
      'fechanac'        => 'Date',
      'fechaingreso'    => 'Date',
      'idcategoria'     => 'Number',
      'categoria'       => 'Text',
      'idciudadnac'     => 'ForeignKey',
      'idnacionalidad'  => 'ForeignKey',
      'idsede'          => 'Number',
      'idfacultad'      => 'Number',
      'titulo'          => 'Text',
      'cargo'           => 'Text',
      'nivel_educativo' => 'Text',
      'area'            => 'Text',
      'direccion'       => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'created_by'      => 'ForeignKey',
      'updated_by'      => 'ForeignKey',
    );
  }
}
