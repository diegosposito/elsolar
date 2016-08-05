<?php

/**
 * DocLaboral filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocLaboralFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idpersona'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idprofesion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesiones'), 'add_empty' => true)),
      'iddedicacion'   => new sfWidgetFormFilterInput(),
      'lugar'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'horas'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idunidadtiempo' => new sfWidgetFormFilterInput(),
      'certificado'    => new sfWidgetFormFilterInput(),
      'trabaja'        => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idpersona'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Personas'), 'column' => 'idpersona')),
      'idprofesion'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesiones'), 'column' => 'idprofesion')),
      'iddedicacion'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lugar'          => new sfValidatorPass(array('required' => false)),
      'horas'          => new sfValidatorPass(array('required' => false)),
      'idunidadtiempo' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'certificado'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'trabaja'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('doc_laboral_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocLaboral';
  }

  public function getFields()
  {
    return array(
      'iddoclaboral'   => 'Number',
      'idpersona'      => 'ForeignKey',
      'idprofesion'    => 'ForeignKey',
      'iddedicacion'   => 'Number',
      'lugar'          => 'Text',
      'horas'          => 'Text',
      'idunidadtiempo' => 'Number',
      'certificado'    => 'Number',
      'trabaja'        => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'created_by'     => 'ForeignKey',
      'updated_by'     => 'ForeignKey',
    );
  }
}
