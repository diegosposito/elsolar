<?php

/**
 * TitulosPlanes filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTitulosPlanesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtitulo'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titulos'), 'add_empty' => true)),
      'idplanestudio'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => true)),
      'tieneorientacion'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'eligeorientacion'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'totalcreditoegreso' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idmodoegreso'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ModosEgreso'), 'add_empty' => true)),
      'sumacredito'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idtitulo'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titulos'), 'column' => 'idtitulo')),
      'idplanestudio'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PlanesEstudios'), 'column' => 'idplanestudio')),
      'tieneorientacion'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'eligeorientacion'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'totalcreditoegreso' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idmodoegreso'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ModosEgreso'), 'column' => 'idmodoegreso')),
      'sumacredito'        => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('titulos_planes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TitulosPlanes';
  }

  public function getFields()
  {
    return array(
      'idtituloplan'       => 'Number',
      'idtitulo'           => 'ForeignKey',
      'idplanestudio'      => 'ForeignKey',
      'tieneorientacion'   => 'Boolean',
      'eligeorientacion'   => 'Boolean',
      'totalcreditoegreso' => 'Number',
      'idmodoegreso'       => 'ForeignKey',
      'sumacredito'        => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'created_by'         => 'ForeignKey',
      'updated_by'         => 'ForeignKey',
    );
  }
}
