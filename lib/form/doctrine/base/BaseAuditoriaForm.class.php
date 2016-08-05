<?php

/**
 * Auditoria form base class.
 *
 * @method Auditoria getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAuditoriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'fechaactividad' => new sfWidgetFormDate(),
      'proximafecha'   => new sfWidgetFormDate(),
      'ingresantes'    => new sfWidgetFormInputCheckbox(),
      'reg7'           => new sfWidgetFormInputCheckbox(),
      'docentes'       => new sfWidgetFormInputCheckbox(),
      'desigdocentes'  => new sfWidgetFormInputCheckbox(),
      'progplanif'     => new sfWidgetFormInputCheckbox(),
      'asistenciadoc'  => new sfWidgetFormInputCheckbox(),
      'diplomas'       => new sfWidgetFormInputCheckbox(),
      'equival'        => new sfWidgetFormInputCheckbox(),
      'certif'         => new sfWidgetFormInputCheckbox(),
      'actividades'    => new sfWidgetFormInputCheckbox(),
      'paseinterno'    => new sfWidgetFormInputCheckbox(),
      'idfacultad'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'add_empty' => false)),
      'idsede'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => false)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fechaactividad' => new sfValidatorDate(),
      'proximafecha'   => new sfValidatorDate(array('required' => false)),
      'ingresantes'    => new sfValidatorBoolean(array('required' => false)),
      'reg7'           => new sfValidatorBoolean(array('required' => false)),
      'docentes'       => new sfValidatorBoolean(array('required' => false)),
      'desigdocentes'  => new sfValidatorBoolean(array('required' => false)),
      'progplanif'     => new sfValidatorBoolean(array('required' => false)),
      'asistenciadoc'  => new sfValidatorBoolean(array('required' => false)),
      'diplomas'       => new sfValidatorBoolean(array('required' => false)),
      'equival'        => new sfValidatorBoolean(array('required' => false)),
      'certif'         => new sfValidatorBoolean(array('required' => false)),
      'actividades'    => new sfValidatorBoolean(array('required' => false)),
      'paseinterno'    => new sfValidatorBoolean(array('required' => false)),
      'idfacultad'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'required' => false)),
      'idsede'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('auditoria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Auditoria';
  }

}
