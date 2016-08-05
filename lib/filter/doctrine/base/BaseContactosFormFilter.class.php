<?php

/**
 * Contactos filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContactosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idpersona'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idciudade'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'callee'          => new sfWidgetFormFilterInput(),
      'numeroe'         => new sfWidgetFormFilterInput(),
      'barrioe'         => new sfWidgetFormFilterInput(),
      'edificioe'       => new sfWidgetFormFilterInput(),
      'pisoe'           => new sfWidgetFormFilterInput(),
      'deptoe'          => new sfWidgetFormFilterInput(),
      'idciudadt'       => new sfWidgetFormFilterInput(),
      'callet'          => new sfWidgetFormFilterInput(),
      'numerot'         => new sfWidgetFormFilterInput(),
      'barriot'         => new sfWidgetFormFilterInput(),
      'edificiot'       => new sfWidgetFormFilterInput(),
      'pisot'           => new sfWidgetFormFilterInput(),
      'deptot'          => new sfWidgetFormFilterInput(),
      'telefonofijocar' => new sfWidgetFormFilterInput(),
      'telefonofijonum' => new sfWidgetFormFilterInput(),
      'celularcar'      => new sfWidgetFormFilterInput(),
      'celularnum'      => new sfWidgetFormFilterInput(),
      'email'           => new sfWidgetFormFilterInput(),
      'email1'          => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idpersona'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Personas'), 'column' => 'idpersona')),
      'idciudade'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudades'), 'column' => 'idciudad')),
      'callee'          => new sfValidatorPass(array('required' => false)),
      'numeroe'         => new sfValidatorPass(array('required' => false)),
      'barrioe'         => new sfValidatorPass(array('required' => false)),
      'edificioe'       => new sfValidatorPass(array('required' => false)),
      'pisoe'           => new sfValidatorPass(array('required' => false)),
      'deptoe'          => new sfValidatorPass(array('required' => false)),
      'idciudadt'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'callet'          => new sfValidatorPass(array('required' => false)),
      'numerot'         => new sfValidatorPass(array('required' => false)),
      'barriot'         => new sfValidatorPass(array('required' => false)),
      'edificiot'       => new sfValidatorPass(array('required' => false)),
      'pisot'           => new sfValidatorPass(array('required' => false)),
      'deptot'          => new sfValidatorPass(array('required' => false)),
      'telefonofijocar' => new sfValidatorPass(array('required' => false)),
      'telefonofijonum' => new sfValidatorPass(array('required' => false)),
      'celularcar'      => new sfValidatorPass(array('required' => false)),
      'celularnum'      => new sfValidatorPass(array('required' => false)),
      'email'           => new sfValidatorPass(array('required' => false)),
      'email1'          => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('contactos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contactos';
  }

  public function getFields()
  {
    return array(
      'idcontacto'      => 'Number',
      'idpersona'       => 'ForeignKey',
      'idciudade'       => 'ForeignKey',
      'callee'          => 'Text',
      'numeroe'         => 'Text',
      'barrioe'         => 'Text',
      'edificioe'       => 'Text',
      'pisoe'           => 'Text',
      'deptoe'          => 'Text',
      'idciudadt'       => 'Number',
      'callet'          => 'Text',
      'numerot'         => 'Text',
      'barriot'         => 'Text',
      'edificiot'       => 'Text',
      'pisot'           => 'Text',
      'deptot'          => 'Text',
      'telefonofijocar' => 'Text',
      'telefonofijonum' => 'Text',
      'celularcar'      => 'Text',
      'celularnum'      => 'Text',
      'email'           => 'Text',
      'email1'          => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'created_by'      => 'ForeignKey',
      'updated_by'      => 'ForeignKey',
    );
  }
}
