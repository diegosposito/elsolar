<?php

/**
 * Auditoria filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAuditoriaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fechaactividad' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'proximafecha'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ingresantes'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'reg7'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'docentes'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'desigdocentes'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'progplanif'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'asistenciadoc'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'diplomas'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'equival'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'certif'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'actividades'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'paseinterno'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'idfacultad'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'add_empty' => true)),
      'idsede'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fechaactividad' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'proximafecha'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'ingresantes'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'reg7'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'docentes'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'desigdocentes'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'progplanif'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'asistenciadoc'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'diplomas'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'equival'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'certif'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'actividades'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'paseinterno'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'idfacultad'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facultades'), 'column' => 'idfacultad')),
      'idsede'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('auditoria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Auditoria';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'fechaactividad' => 'Date',
      'proximafecha'   => 'Date',
      'ingresantes'    => 'Boolean',
      'reg7'           => 'Boolean',
      'docentes'       => 'Boolean',
      'desigdocentes'  => 'Boolean',
      'progplanif'     => 'Boolean',
      'asistenciadoc'  => 'Boolean',
      'diplomas'       => 'Boolean',
      'equival'        => 'Boolean',
      'certif'         => 'Boolean',
      'actividades'    => 'Boolean',
      'paseinterno'    => 'Boolean',
      'idfacultad'     => 'ForeignKey',
      'idsede'         => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'created_by'     => 'ForeignKey',
      'updated_by'     => 'ForeignKey',
    );
  }
}
