<?php

/**
 * InscripcionesMesas filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesMesasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idalumno'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idcatedra'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'idllamado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LlamadosTurno'), 'add_empty' => true)),
      'idcondicionmesa' => new sfWidgetFormFilterInput(),
      'idmesaexamen'    => new sfWidgetFormFilterInput(),
      'confirmado'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'transferido'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comentario'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idalumno'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Alumnos'), 'column' => 'idalumno')),
      'idcatedra'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catedras'), 'column' => 'idcatedra')),
      'idllamado'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LlamadosTurno'), 'column' => 'idllamado')),
      'idcondicionmesa' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idmesaexamen'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'confirmado'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'transferido'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comentario'      => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('inscripciones_mesas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InscripcionesMesas';
  }

  public function getFields()
  {
    return array(
      'idinscripcion'   => 'Number',
      'idalumno'        => 'ForeignKey',
      'idcatedra'       => 'ForeignKey',
      'idllamado'       => 'ForeignKey',
      'idcondicionmesa' => 'Number',
      'idmesaexamen'    => 'Number',
      'confirmado'      => 'Boolean',
      'transferido'     => 'Boolean',
      'comentario'      => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'created_by'      => 'ForeignKey',
      'updated_by'      => 'ForeignKey',
    );
  }
}
