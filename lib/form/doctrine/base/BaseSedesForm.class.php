<?php

/**
 * Sedes form base class.
 *
 * @method Sedes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSedesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idsede'        => new sfWidgetFormInputHidden(),
      'nombre'        => new sfWidgetFormInputText(),
      'abreviacion'   => new sfWidgetFormInputText(),
      'direccion'     => new sfWidgetFormInputText(),
      'idciudad'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'telefonos'     => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      'imgencabezado' => new sfWidgetFormInputText(),
      'imgpie'        => new sfWidgetFormInputText(),
      'idtiposede'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposSedes'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idsede'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idsede')), 'empty_value' => $this->getObject()->get('idsede'), 'required' => false)),
      'nombre'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'abreviacion'   => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'direccion'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'idciudad'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'required' => false)),
      'telefonos'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'imgencabezado' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'imgpie'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'idtiposede'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposSedes'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sedes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sedes';
  }

}
