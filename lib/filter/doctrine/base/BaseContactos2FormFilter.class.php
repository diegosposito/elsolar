<?php

/**
 * Contactos2 filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContactos2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idpersona'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idtipocontacto' => new sfWidgetFormFilterInput(),
      'idciudad'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'campo1'         => new sfWidgetFormFilterInput(),
      'campo2'         => new sfWidgetFormFilterInput(),
      'campo3'         => new sfWidgetFormFilterInput(),
      'campo4'         => new sfWidgetFormFilterInput(),
      'campo5'         => new sfWidgetFormFilterInput(),
      'campo6'         => new sfWidgetFormFilterInput(),
      'campo7'         => new sfWidgetFormFilterInput(),
      'campo8'         => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'idpersona'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Personas'), 'column' => 'idpersona')),
      'idtipocontacto' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idciudad'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudades'), 'column' => 'idciudad')),
      'campo1'         => new sfValidatorPass(array('required' => false)),
      'campo2'         => new sfValidatorPass(array('required' => false)),
      'campo3'         => new sfValidatorPass(array('required' => false)),
      'campo4'         => new sfValidatorPass(array('required' => false)),
      'campo5'         => new sfValidatorPass(array('required' => false)),
      'campo6'         => new sfValidatorPass(array('required' => false)),
      'campo7'         => new sfValidatorPass(array('required' => false)),
      'campo8'         => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contactos2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contactos2';
  }

  public function getFields()
  {
    return array(
      'idcontacto'     => 'Number',
      'idpersona'      => 'ForeignKey',
      'idtipocontacto' => 'Number',
      'idciudad'       => 'ForeignKey',
      'campo1'         => 'Text',
      'campo2'         => 'Text',
      'campo3'         => 'Text',
      'campo4'         => 'Text',
      'campo5'         => 'Text',
      'campo6'         => 'Text',
      'campo7'         => 'Text',
      'campo8'         => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
