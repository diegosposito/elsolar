<?php

/**
 * DetalleNota filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetalleNotaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resultado'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valorinferior' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valorsuperior' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'activo'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'idescalanota'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EscalasNotas'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'descripcion'   => new sfValidatorPass(array('required' => false)),
      'resultado'     => new sfValidatorPass(array('required' => false)),
      'valorinferior' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'valorsuperior' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'activo'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'idescalanota'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EscalasNotas'), 'column' => 'idescalanota')),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('detalle_nota_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleNota';
  }

  public function getFields()
  {
    return array(
      'iddetallenota' => 'Number',
      'descripcion'   => 'Text',
      'resultado'     => 'Text',
      'valorinferior' => 'Number',
      'valorsuperior' => 'Number',
      'activo'        => 'Boolean',
      'idescalanota'  => 'ForeignKey',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'created_by'    => 'ForeignKey',
      'updated_by'    => 'ForeignKey',
    );
  }
}
