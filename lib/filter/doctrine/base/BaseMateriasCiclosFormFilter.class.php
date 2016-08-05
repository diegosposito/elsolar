<?php

/**
 * MateriasCiclos filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMateriasCiclosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmateria'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => true)),
      'idciclo'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciclos'), 'add_empty' => true)),
      'idresolucion'   => new sfWidgetFormFilterInput(),
      'idtipomateria'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposMaterias'), 'add_empty' => true)),
      'idtipocursada'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cursada'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'horas'          => new sfWidgetFormFilterInput(),
      'curso'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codmat'         => new sfWidgetFormFilterInput(),
      'activa'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idmateria'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materias'), 'column' => 'idmateria')),
      'idciclo'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciclos'), 'column' => 'idciclo')),
      'idresolucion'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idtipomateria'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposMaterias'), 'column' => 'idtipomateria')),
      'idtipocursada'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orden'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cursada'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'horas'          => new sfValidatorPass(array('required' => false)),
      'curso'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codmat'         => new sfValidatorPass(array('required' => false)),
      'activa'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('materias_ciclos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MateriasCiclos';
  }

  public function getFields()
  {
    return array(
      'idmateriaciclo' => 'Number',
      'idmateria'      => 'ForeignKey',
      'idciclo'        => 'ForeignKey',
      'idresolucion'   => 'Number',
      'idtipomateria'  => 'ForeignKey',
      'idtipocursada'  => 'Number',
      'orden'          => 'Number',
      'cursada'        => 'Number',
      'horas'          => 'Text',
      'curso'          => 'Number',
      'codmat'         => 'Text',
      'activa'         => 'Boolean',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'created_by'     => 'ForeignKey',
      'updated_by'     => 'ForeignKey',
    );
  }
}
