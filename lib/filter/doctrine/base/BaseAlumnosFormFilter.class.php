<?php

/**
 * Alumnos filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAlumnosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idpersona'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idplanestudio'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => true)),
      'idcuentapersona'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idciclolectivo'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CiclosLectivos'), 'add_empty' => true)),
      'idestudioprevio'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudios'), 'add_empty' => true)),
      'fechaingreso'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'ingreso'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'legajo'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fotografia'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fotocopiadni'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fotocopialegtitulo'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fotocopialegtitulogrado' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fotocopialegpartidanac'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'certtittramite'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fechacerttittramite'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'certalureg'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fechacertalureg'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'derechoevaluacion'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'experiencialaboral'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'pagomatricula'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bancarizacion'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'titulorevalidado'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tramiteresidencia'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'radiografiatorax'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'electrocardiograma'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ergonomia'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ergometria'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'planillamedica'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'planillabucodental'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'hemograma'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'glucemia'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estudiovdrl'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'activo'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'promedio'                => new sfWidgetFormFilterInput(),
      'idtipoinscripto'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposInscriptos'), 'add_empty' => true)),
      'idsede'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'codadministracion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'internacional'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'aspirante'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'observaciones'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idpersona'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Personas'), 'column' => 'idpersona')),
      'idplanestudio'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PlanesEstudios'), 'column' => 'idplanestudio')),
      'idcuentapersona'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idciclolectivo'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CiclosLectivos'), 'column' => 'id')),
      'idestudioprevio'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estudios'), 'column' => 'idestudio')),
      'fechaingreso'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'ingreso'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'legajo'                  => new sfValidatorPass(array('required' => false)),
      'fotografia'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fotocopiadni'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fotocopialegtitulo'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fotocopialegtitulogrado' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fotocopialegpartidanac'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'certtittramite'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fechacerttittramite'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'certalureg'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fechacertalureg'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'derechoevaluacion'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'experiencialaboral'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'pagomatricula'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bancarizacion'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'titulorevalidado'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tramiteresidencia'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'radiografiatorax'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'electrocardiograma'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ergonomia'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ergometria'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'planillamedica'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'planillabucodental'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'hemograma'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'glucemia'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estudiovdrl'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'activo'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'promedio'                => new sfValidatorPass(array('required' => false)),
      'idtipoinscripto'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposInscriptos'), 'column' => 'idtipoinscripto')),
      'idsede'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'codadministracion'       => new sfValidatorPass(array('required' => false)),
      'internacional'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'aspirante'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'observaciones'           => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('alumnos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alumnos';
  }

  public function getFields()
  {
    return array(
      'idalumno'                => 'Number',
      'idpersona'               => 'ForeignKey',
      'idplanestudio'           => 'ForeignKey',
      'idcuentapersona'         => 'Number',
      'idciclolectivo'          => 'ForeignKey',
      'idestudioprevio'         => 'ForeignKey',
      'fechaingreso'            => 'Date',
      'ingreso'                 => 'Number',
      'legajo'                  => 'Text',
      'fotografia'              => 'Boolean',
      'fotocopiadni'            => 'Boolean',
      'fotocopialegtitulo'      => 'Boolean',
      'fotocopialegtitulogrado' => 'Boolean',
      'fotocopialegpartidanac'  => 'Boolean',
      'certtittramite'          => 'Boolean',
      'fechacerttittramite'     => 'Date',
      'certalureg'              => 'Boolean',
      'fechacertalureg'         => 'Date',
      'derechoevaluacion'       => 'Boolean',
      'experiencialaboral'      => 'Boolean',
      'pagomatricula'           => 'Number',
      'bancarizacion'           => 'Boolean',
      'titulorevalidado'        => 'Boolean',
      'tramiteresidencia'       => 'Boolean',
      'radiografiatorax'        => 'Boolean',
      'electrocardiograma'      => 'Boolean',
      'ergonomia'               => 'Boolean',
      'ergometria'              => 'Boolean',
      'planillamedica'          => 'Boolean',
      'planillabucodental'      => 'Boolean',
      'hemograma'               => 'Boolean',
      'glucemia'                => 'Boolean',
      'estudiovdrl'             => 'Boolean',
      'activo'                  => 'Boolean',
      'promedio'                => 'Text',
      'idtipoinscripto'         => 'ForeignKey',
      'idsede'                  => 'ForeignKey',
      'codadministracion'       => 'Text',
      'internacional'           => 'Boolean',
      'aspirante'               => 'Boolean',
      'observaciones'           => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'created_by'              => 'ForeignKey',
      'updated_by'              => 'ForeignKey',
    );
  }
}
