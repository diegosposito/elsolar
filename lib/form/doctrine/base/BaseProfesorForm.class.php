<?php

/**
 * Profesor form base class.
 *
 * @method Profesor getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idprofesor'     => new sfWidgetFormInputHidden(),
      'nombre'         => new sfWidgetFormInputText(),
      'apellido'       => new sfWidgetFormInputText(),
      'sexo'           => new sfWidgetFormInputText(),
      'idtipodoc'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'add_empty' => true)),
      'nrodoc'         => new sfWidgetFormInputText(),
      'numerodoc'      => new sfWidgetFormInputText(),
      'fechanac'       => new sfWidgetFormDate(),
      'fechaingreso'   => new sfWidgetFormDate(),
      'idciudadnac'    => new sfWidgetFormInputText(),
      'idnacionalidad' => new sfWidgetFormInputText(),
      'estadocivil'    => new sfWidgetFormInputText(),
      'vive'           => new sfWidgetFormInputText(),
      'titulo'         => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idprofesor'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idprofesor')), 'empty_value' => $this->getObject()->get('idprofesor'), 'required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'apellido'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'sexo'           => new sfValidatorInteger(array('required' => false)),
      'idtipodoc'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'required' => false)),
      'nrodoc'         => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'numerodoc'      => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'fechanac'       => new sfValidatorDate(array('required' => false)),
      'fechaingreso'   => new sfValidatorDate(array('required' => false)),
      'idciudadnac'    => new sfValidatorInteger(array('required' => false)),
      'idnacionalidad' => new sfValidatorInteger(array('required' => false)),
      'estadocivil'    => new sfValidatorInteger(array('required' => false)),
      'vive'           => new sfValidatorInteger(array('required' => false)),
      'titulo'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profesor';
  }

}
