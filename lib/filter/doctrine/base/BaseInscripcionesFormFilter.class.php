<?php

/**
 * Inscripciones filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idalumno'       => new sfWidgetFormFilterInput(),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora'           => new sfWidgetFormFilterInput(),
      'type'           => new sfWidgetFormFilterInput(),
      'iddetalleplan'  => new sfWidgetFormFilterInput(),
      'idfechaexamen'  => new sfWidgetFormFilterInput(),
      'idciclolectivo' => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'idalumno'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'hora'           => new sfValidatorPass(array('required' => false)),
      'type'           => new sfValidatorPass(array('required' => false)),
      'iddetalleplan'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idfechaexamen'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idciclolectivo' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('inscripciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inscripciones';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'idalumno'       => 'Number',
      'fecha'          => 'Date',
      'hora'           => 'Text',
      'type'           => 'Text',
      'iddetalleplan'  => 'Number',
      'idfechaexamen'  => 'Number',
      'idciclolectivo' => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
