<?php

/**
 * CarrerasSede filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCarrerasSedeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idsede'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'idcarrera'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carreras'), 'add_empty' => true)),
      'exploratoria'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'plazocerttittramite'   => new sfWidgetFormFilterInput(),
      'entregaencuesta'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'vigente'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'plazoborradoexamen'    => new sfWidgetFormFilterInput(),
      'permiterevalida'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'cursapierderegular'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'iddependenciaaraucano' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idtituloaraucano'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idsede'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'idcarrera'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Carreras'), 'column' => 'idcarrera')),
      'exploratoria'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'plazocerttittramite'   => new sfValidatorPass(array('required' => false)),
      'entregaencuesta'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'vigente'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'plazoborradoexamen'    => new sfValidatorPass(array('required' => false)),
      'permiterevalida'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'cursapierderegular'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'iddependenciaaraucano' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idtituloaraucano'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('carreras_sede_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarrerasSede';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'idsede'                => 'ForeignKey',
      'idcarrera'             => 'ForeignKey',
      'exploratoria'          => 'Boolean',
      'plazocerttittramite'   => 'Text',
      'entregaencuesta'       => 'Boolean',
      'vigente'               => 'Boolean',
      'plazoborradoexamen'    => 'Text',
      'permiterevalida'       => 'Boolean',
      'cursapierderegular'    => 'Boolean',
      'iddependenciaaraucano' => 'Number',
      'idtituloaraucano'      => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'created_by'            => 'ForeignKey',
      'updated_by'            => 'ForeignKey',
    );
  }
}
