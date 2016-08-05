<?php

/**
 * Titulos filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTitulosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombrefemenino'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idtipotitulo'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposTitulos'), 'add_empty' => true)),
      'niveltitulo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechacreacion'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nroresolucion'            => new sfWidgetFormFilterInput(),
      'fechacreacionministerial' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nroresolucionministerial' => new sfWidgetFormFilterInput(),
      'duracion'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tiempotrabajofinal'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'incumbencias'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'acreditacionconeau'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'categorizacionconeau'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechabaja'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'idestadotitulo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'                   => new sfValidatorPass(array('required' => false)),
      'nombrefemenino'           => new sfValidatorPass(array('required' => false)),
      'idtipotitulo'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposTitulos'), 'column' => 'idtipotitulo')),
      'niveltitulo'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fechacreacion'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nroresolucion'            => new sfValidatorPass(array('required' => false)),
      'fechacreacionministerial' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nroresolucionministerial' => new sfValidatorPass(array('required' => false)),
      'duracion'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tiempotrabajofinal'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'incumbencias'             => new sfValidatorPass(array('required' => false)),
      'acreditacionconeau'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'categorizacionconeau'     => new sfValidatorPass(array('required' => false)),
      'fechabaja'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idestadotitulo'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('titulos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Titulos';
  }

  public function getFields()
  {
    return array(
      'idtitulo'                 => 'Number',
      'nombre'                   => 'Text',
      'nombrefemenino'           => 'Text',
      'idtipotitulo'             => 'ForeignKey',
      'niveltitulo'              => 'Number',
      'fechacreacion'            => 'Date',
      'nroresolucion'            => 'Text',
      'fechacreacionministerial' => 'Date',
      'nroresolucionministerial' => 'Text',
      'duracion'                 => 'Number',
      'tiempotrabajofinal'       => 'Number',
      'incumbencias'             => 'Text',
      'acreditacionconeau'       => 'Boolean',
      'categorizacionconeau'     => 'Text',
      'fechabaja'                => 'Date',
      'idestadotitulo'           => 'Number',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'created_by'               => 'ForeignKey',
      'updated_by'               => 'ForeignKey',
    );
  }
}
