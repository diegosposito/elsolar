<?php

/**
 * Aulas form base class.
 *
 * @method Aulas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAulasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idaula'      => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormInputText(),
      'ubicacion'   => new sfWidgetFormInputText(),
      'piso'        => new sfWidgetFormInputText(),
      'capacidad'   => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormInputText(),
      'idedificio'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Edificios'), 'add_empty' => false)),
      'idtipoaula'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposAulas'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idaula'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idaula')), 'empty_value' => $this->getObject()->get('idaula'), 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 30)),
      'ubicacion'   => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'piso'        => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'capacidad'   => new sfValidatorInteger(array('required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 255)),
      'idedificio'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Edificios'), 'required' => false)),
      'idtipoaula'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposAulas'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aulas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Aulas';
  }

}
