<?php

/**
 * Estudios filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudiosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idpersona'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idnivelestudio'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NivelesEstudios'), 'add_empty' => true)),
      'descripcion'       => new sfWidgetFormFilterInput(),
      'establecimiento'   => new sfWidgetFormFilterInput(),
      'idciudad'          => new sfWidgetFormFilterInput(),
      'fecha'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'duracion'          => new sfWidgetFormFilterInput(),
      'anioingreso'       => new sfWidgetFormFilterInput(),
      'anioegreso'        => new sfWidgetFormFilterInput(),
      'idunidadtiempo'    => new sfWidgetFormFilterInput(),
      'cantmaterias'      => new sfWidgetFormFilterInput(),
      'cantmatapro'       => new sfWidgetFormFilterInput(),
      'promedio'          => new sfWidgetFormFilterInput(),
      'concluyo'          => new sfWidgetFormFilterInput(),
      'continua'          => new sfWidgetFormFilterInput(),
      'idcategoriatitulo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CategoriasTitulos'), 'add_empty' => true)),
      'formaciondocente'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'otrotitulo'        => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idpersona'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Personas'), 'column' => 'idpersona')),
      'idnivelestudio'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NivelesEstudios'), 'column' => 'idnivelestudio')),
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'establecimiento'   => new sfValidatorPass(array('required' => false)),
      'idciudad'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'duracion'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'anioingreso'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'anioegreso'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idunidadtiempo'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantmaterias'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantmatapro'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'promedio'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'concluyo'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'continua'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idcategoriatitulo' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CategoriasTitulos'), 'column' => 'idcategoriatitulo')),
      'formaciondocente'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'otrotitulo'        => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('estudios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudios';
  }

  public function getFields()
  {
    return array(
      'idestudio'         => 'Number',
      'idpersona'         => 'ForeignKey',
      'idnivelestudio'    => 'ForeignKey',
      'descripcion'       => 'Text',
      'establecimiento'   => 'Text',
      'idciudad'          => 'Number',
      'fecha'             => 'Date',
      'duracion'          => 'Number',
      'anioingreso'       => 'Number',
      'anioegreso'        => 'Number',
      'idunidadtiempo'    => 'Number',
      'cantmaterias'      => 'Number',
      'cantmatapro'       => 'Number',
      'promedio'          => 'Number',
      'concluyo'          => 'Number',
      'continua'          => 'Number',
      'idcategoriatitulo' => 'ForeignKey',
      'formaciondocente'  => 'Boolean',
      'otrotitulo'        => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'created_by'        => 'ForeignKey',
      'updated_by'        => 'ForeignKey',
    );
  }
}
