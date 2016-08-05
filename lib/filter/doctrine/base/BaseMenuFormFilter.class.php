<?php

/**
 * Menu filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMenuFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'credencial'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'modulo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parametro'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idgrupomenu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupomenu'), 'add_empty' => true)),
      'orden'       => new sfWidgetFormFilterInput(),
      'idsistema'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sistemas'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'credencial'  => new sfValidatorPass(array('required' => false)),
      'modulo'      => new sfValidatorPass(array('required' => false)),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'parametro'   => new sfValidatorPass(array('required' => false)),
      'idgrupomenu' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupomenu'), 'column' => 'id')),
      'orden'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idsistema'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sistemas'), 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('menu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menu';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'credencial'  => 'Text',
      'modulo'      => 'Text',
      'descripcion' => 'Text',
      'parametro'   => 'Text',
      'idgrupomenu' => 'ForeignKey',
      'orden'       => 'Number',
      'idsistema'   => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'created_by'  => 'ForeignKey',
      'updated_by'  => 'ForeignKey',
    );
  }
}
