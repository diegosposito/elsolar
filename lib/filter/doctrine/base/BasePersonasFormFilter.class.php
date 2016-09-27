<?php

/**
 * Personas filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePersonasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idsexo'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexo'), 'add_empty' => true)),
      'idtipodoc'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'add_empty' => true)),
      'idcargo'                  => new sfWidgetFormFilterInput(),
      'nrodoc'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numerodoc'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechanac'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaingreso'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'idciudadnac'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'idnacionalidad'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Paises'), 'add_empty' => true)),
      'estadocivil'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoCivil'), 'add_empty' => true)),
      'vive'                     => new sfWidgetFormFilterInput(),
      'idprofesion'              => new sfWidgetFormFilterInput(),
      'cantgrupofamiliar'        => new sfWidgetFormFilterInput(),
      'titulo'                   => new sfWidgetFormFilterInput(),
      'email'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ciudad'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'celular'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tienefoto'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'activo'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'socio'                    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mostrarinfocontacto'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nrolector'                => new sfWidgetFormFilterInput(),
      'otrainformacionrelevante' => new sfWidgetFormFilterInput(),
      'horarios'                 => new sfWidgetFormFilterInput(),
      'monto'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idusuario'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'                   => new sfValidatorPass(array('required' => false)),
      'apellido'                 => new sfValidatorPass(array('required' => false)),
      'idsexo'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sexo'), 'column' => 'idsexo')),
      'idtipodoc'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposDocumentos'), 'column' => 'idtipodoc')),
      'idcargo'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nrodoc'                   => new sfValidatorPass(array('required' => false)),
      'numerodoc'                => new sfValidatorPass(array('required' => false)),
      'fechanac'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaingreso'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idciudadnac'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudades'), 'column' => 'idciudad')),
      'idnacionalidad'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Paises'), 'column' => 'idpais')),
      'estadocivil'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadoCivil'), 'column' => 'idestadocivil')),
      'vive'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idprofesion'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantgrupofamiliar'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'titulo'                   => new sfValidatorPass(array('required' => false)),
      'email'                    => new sfValidatorPass(array('required' => false)),
      'telefono'                 => new sfValidatorPass(array('required' => false)),
      'ciudad'                   => new sfValidatorPass(array('required' => false)),
      'celular'                  => new sfValidatorPass(array('required' => false)),
      'direccion'                => new sfValidatorPass(array('required' => false)),
      'tienefoto'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'activo'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'socio'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mostrarinfocontacto'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nrolector'                => new sfValidatorPass(array('required' => false)),
      'otrainformacionrelevante' => new sfValidatorPass(array('required' => false)),
      'horarios'                 => new sfValidatorPass(array('required' => false)),
      'monto'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'idusuario'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('personas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personas';
  }

  public function getFields()
  {
    return array(
      'idpersona'                => 'Number',
      'nombre'                   => 'Text',
      'apellido'                 => 'Text',
      'idsexo'                   => 'ForeignKey',
      'idtipodoc'                => 'ForeignKey',
      'idcargo'                  => 'Number',
      'nrodoc'                   => 'Text',
      'numerodoc'                => 'Text',
      'fechanac'                 => 'Date',
      'fechaingreso'             => 'Date',
      'idciudadnac'              => 'ForeignKey',
      'idnacionalidad'           => 'ForeignKey',
      'estadocivil'              => 'ForeignKey',
      'vive'                     => 'Number',
      'idprofesion'              => 'Number',
      'cantgrupofamiliar'        => 'Number',
      'titulo'                   => 'Text',
      'email'                    => 'Text',
      'telefono'                 => 'Text',
      'ciudad'                   => 'Text',
      'celular'                  => 'Text',
      'direccion'                => 'Text',
      'tienefoto'                => 'Boolean',
      'activo'                   => 'Boolean',
      'socio'                    => 'Boolean',
      'mostrarinfocontacto'      => 'Boolean',
      'nrolector'                => 'Text',
      'otrainformacionrelevante' => 'Text',
      'horarios'                 => 'Text',
      'monto'                    => 'Number',
      'idusuario'                => 'ForeignKey',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'created_by'               => 'ForeignKey',
      'updated_by'               => 'ForeignKey',
    );
  }
}
