<?php

/**
 * NoDocentes form base class.
 *
 * @method NoDocentes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNoDocentesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'idlegajo'        => new sfWidgetFormInputText(),
      'nombre'          => new sfWidgetFormInputText(),
      'apellido'        => new sfWidgetFormInputText(),
      'idsexo'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexo'), 'add_empty' => true)),
      'idtipodoc'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'add_empty' => true)),
      'nrodoc'          => new sfWidgetFormInputText(),
      'cuit'            => new sfWidgetFormInputText(),
      'fechanac'        => new sfWidgetFormDate(),
      'fechaingreso'    => new sfWidgetFormDate(),
      'idcategoria'     => new sfWidgetFormInputText(),
      'categoria'       => new sfWidgetFormTextarea(),
      'idciudadnac'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'idnacionalidad'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Paises'), 'add_empty' => true)),
      'idsede'          => new sfWidgetFormInputText(),
      'idfacultad'      => new sfWidgetFormInputText(),
      'titulo'          => new sfWidgetFormTextarea(),
      'cargo'           => new sfWidgetFormTextarea(),
      'nivel_educativo' => new sfWidgetFormTextarea(),
      'area'            => new sfWidgetFormTextarea(),
      'direccion'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idlegajo'        => new sfValidatorInteger(array('required' => false)),
      'nombre'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'apellido'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'idsexo'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sexo'), 'required' => false)),
      'idtipodoc'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentos'), 'required' => false)),
      'nrodoc'          => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'cuit'            => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'fechanac'        => new sfValidatorDate(array('required' => false)),
      'fechaingreso'    => new sfValidatorDate(array('required' => false)),
      'idcategoria'     => new sfValidatorInteger(array('required' => false)),
      'categoria'       => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'idciudadnac'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'required' => false)),
      'idnacionalidad'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Paises'), 'required' => false)),
      'idsede'          => new sfValidatorInteger(array('required' => false)),
      'idfacultad'      => new sfValidatorInteger(array('required' => false)),
      'titulo'          => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'cargo'           => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'nivel_educativo' => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'area'            => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'direccion'       => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('no_docentes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NoDocentes';
  }

}
