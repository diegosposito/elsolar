<?php

/**
 * Carreras filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCarrerasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombrereducido'      => new sfWidgetFormFilterInput(),
      'idfacultad'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'add_empty' => true)),
      'letra'               => new sfWidgetFormFilterInput(),
      'titulo'              => new sfWidgetFormFilterInput(),
      'idtipocarrera'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCarreras'), 'add_empty' => true)),
      'idmodalidad'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ModalidadesCarreras'), 'add_empty' => true)),
      'termino'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechacreacion'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechabaja'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nroresolucion'       => new sfWidgetFormFilterInput(),
      'nroresolucionhcd'    => new sfWidgetFormFilterInput(),
      'nroresolucioncsu'    => new sfWidgetFormFilterInput(),
      'nroresolucionconeau' => new sfWidgetFormFilterInput(),
      'nroresolucionbaja'   => new sfWidgetFormFilterInput(),
      'nroexpediente'       => new sfWidgetFormFilterInput(),
      'anioinicio'          => new sfWidgetFormFilterInput(),
      'idestadocarrera'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosCarreras'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'              => new sfValidatorPass(array('required' => false)),
      'nombrereducido'      => new sfValidatorPass(array('required' => false)),
      'idfacultad'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facultades'), 'column' => 'idfacultad')),
      'letra'               => new sfValidatorPass(array('required' => false)),
      'titulo'              => new sfValidatorPass(array('required' => false)),
      'idtipocarrera'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposCarreras'), 'column' => 'idtipocarrera')),
      'idmodalidad'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ModalidadesCarreras'), 'column' => 'idmodalidad')),
      'termino'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fechacreacion'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechabaja'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nroresolucion'       => new sfValidatorPass(array('required' => false)),
      'nroresolucionhcd'    => new sfValidatorPass(array('required' => false)),
      'nroresolucioncsu'    => new sfValidatorPass(array('required' => false)),
      'nroresolucionconeau' => new sfValidatorPass(array('required' => false)),
      'nroresolucionbaja'   => new sfValidatorPass(array('required' => false)),
      'nroexpediente'       => new sfValidatorPass(array('required' => false)),
      'anioinicio'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idestadocarrera'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosCarreras'), 'column' => 'idestadocarrera')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('carreras_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carreras';
  }

  public function getFields()
  {
    return array(
      'idcarrera'           => 'Number',
      'nombre'              => 'Text',
      'nombrereducido'      => 'Text',
      'idfacultad'          => 'ForeignKey',
      'letra'               => 'Text',
      'titulo'              => 'Text',
      'idtipocarrera'       => 'ForeignKey',
      'idmodalidad'         => 'ForeignKey',
      'termino'             => 'Number',
      'fechacreacion'       => 'Date',
      'fechabaja'           => 'Date',
      'nroresolucion'       => 'Text',
      'nroresolucionhcd'    => 'Text',
      'nroresolucioncsu'    => 'Text',
      'nroresolucionconeau' => 'Text',
      'nroresolucionbaja'   => 'Text',
      'nroexpediente'       => 'Text',
      'anioinicio'          => 'Number',
      'idestadocarrera'     => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'created_by'          => 'ForeignKey',
      'updated_by'          => 'ForeignKey',
    );
  }
}
