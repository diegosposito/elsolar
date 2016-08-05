<?php

/**
 * DesignacionesMesas filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDesignacionesMesasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idprofesor'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesores'), 'add_empty' => true)),
      'idmesaexamen'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesasExamenes'), 'add_empty' => true)),
      'idtipodesignacionmesa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDesignacionesMesas'), 'add_empty' => true)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idprofesor'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesores'), 'column' => 'idprofesor')),
      'idmesaexamen'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MesasExamenes'), 'column' => 'idmesaexamen')),
      'idtipodesignacionmesa' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposDesignacionesMesas'), 'column' => 'idtipodesignacionmesa')),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('designaciones_mesas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DesignacionesMesas';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'idprofesor'            => 'ForeignKey',
      'idmesaexamen'          => 'ForeignKey',
      'idtipodesignacionmesa' => 'ForeignKey',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'created_by'            => 'ForeignKey',
      'updated_by'            => 'ForeignKey',
    );
  }
}
