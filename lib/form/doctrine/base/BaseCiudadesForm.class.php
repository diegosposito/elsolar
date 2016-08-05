<?php

/**
 * Ciudades form base class.
 *
 * @method Ciudades getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCiudadesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idciudad'       => new sfWidgetFormInputHidden(),
      'iddepartamento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Departamentos'), 'add_empty' => true)),
      'idprovincia'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Provincias'), 'add_empty' => true)),
      'descripcion'    => new sfWidgetFormInputText(),
      'codpostal'      => new sfWidgetFormInputText(),
      'chequeada'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idciudad'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idciudad')), 'empty_value' => $this->getObject()->get('idciudad'), 'required' => false)),
      'iddepartamento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Departamentos'), 'required' => false)),
      'idprovincia'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Provincias'), 'required' => false)),
      'descripcion'    => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'codpostal'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'chequeada'      => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ciudades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ciudades';
  }

}
