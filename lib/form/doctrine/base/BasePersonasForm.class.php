<?php

/**
 * Personas form base class.
 *
 * @method Personas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePersonasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idpersona'                => new sfWidgetFormInputHidden(),
      'nombre'                   => new sfWidgetFormInputText(),
      'apellido'                 => new sfWidgetFormInputText(),
      'idsexo'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexo'), 'add_empty' => true)),
      'idtipodoc'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'add_empty' => true)),
      'nrodoc'                   => new sfWidgetFormInputText(),
      'numerodoc'                => new sfWidgetFormInputText(),
      'fechanac'                 => new sfWidgetFormDate(),
      'fechaingreso'             => new sfWidgetFormDate(),
      'idciudadnac'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'idnacionalidad'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Paises'), 'add_empty' => true)),
      'estadocivil'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoCivil'), 'add_empty' => true)),
      'vive'                     => new sfWidgetFormInputText(),
      'idprofesion'              => new sfWidgetFormInputText(),
      'cantgrupofamiliar'        => new sfWidgetFormInputText(),
      'titulo'                   => new sfWidgetFormInputText(),
      'tienefoto'                => new sfWidgetFormInputCheckbox(),
      'nrolector'                => new sfWidgetFormInputText(),
      'otrainformacionrelevante' => new sfWidgetFormTextarea(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'created_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idpersona'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idpersona')), 'empty_value' => $this->getObject()->get('idpersona'), 'required' => false)),
      'nombre'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'apellido'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'idsexo'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sexo'), 'required' => false)),
      'idtipodoc'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'required' => false)),
      'nrodoc'                   => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'numerodoc'                => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'fechanac'                 => new sfValidatorDate(array('required' => false)),
      'fechaingreso'             => new sfValidatorDate(array('required' => false)),
      'idciudadnac'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'required' => false)),
      'idnacionalidad'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Paises'), 'required' => false)),
      'estadocivil'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoCivil'), 'required' => false)),
      'vive'                     => new sfValidatorInteger(array('required' => false)),
      'idprofesion'              => new sfValidatorInteger(array('required' => false)),
      'cantgrupofamiliar'        => new sfValidatorInteger(array('required' => false)),
      'titulo'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'tienefoto'                => new sfValidatorBoolean(array('required' => false)),
      'nrolector'                => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'otrainformacionrelevante' => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'created_by'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personas';
  }

}
