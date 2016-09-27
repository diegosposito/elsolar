<?php

/**
 * ObrasSociales filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseObrasSocialesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'denominacion'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'abreviada'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estado'                  => new sfWidgetFormFilterInput(),
      'ninterno'                => new sfWidgetFormFilterInput(),
      'general'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'protesis'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ortodoncia'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'implantes'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fechaarancel'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaultimoperiodo'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaaranceltexto'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechaultimoperiodotexto' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'denominacion'            => new sfValidatorPass(array('required' => false)),
      'abreviada'               => new sfValidatorPass(array('required' => false)),
      'estado'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ninterno'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'general'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'protesis'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ortodoncia'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'implantes'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fechaarancel'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaultimoperiodo'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaaranceltexto'       => new sfValidatorPass(array('required' => false)),
      'fechaultimoperiodotexto' => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('obras_sociales_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ObrasSociales';
  }

  public function getFields()
  {
    return array(
      'idobrasocial'            => 'Number',
      'denominacion'            => 'Text',
      'abreviada'               => 'Text',
      'estado'                  => 'Number',
      'ninterno'                => 'Number',
      'general'                 => 'Boolean',
      'protesis'                => 'Boolean',
      'ortodoncia'              => 'Boolean',
      'implantes'               => 'Boolean',
      'fechaarancel'            => 'Date',
      'fechaultimoperiodo'      => 'Date',
      'fechaaranceltexto'       => 'Text',
      'fechaultimoperiodotexto' => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'created_by'              => 'ForeignKey',
      'updated_by'              => 'ForeignKey',
    );
  }
}
