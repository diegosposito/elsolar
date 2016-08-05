<?php

/**
 * Comisiones form base class.
 *
 * @method Comisiones getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComisionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcomision'            => new sfWidgetFormInputHidden(),
      'nombre'                => new sfWidgetFormInputText(),
      'descripcion'           => new sfWidgetFormInputText(),
      'inscripcionhabilitada' => new sfWidgetFormInputCheckbox(),
      'capacidad'             => new sfWidgetFormInputText(),
      'letrainicio'           => new sfWidgetFormInputText(),
      'letrafin'              => new sfWidgetFormInputText(),
      'turno'                 => new sfWidgetFormInputText(),
      'activo'                => new sfWidgetFormInputCheckbox(),
      'idestadocomision'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosComisiones'), 'add_empty' => false)),
      'idcatedra'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => false)),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'created_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcomision'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcomision')), 'empty_value' => $this->getObject()->get('idcomision'), 'required' => false)),
      'nombre'                => new sfValidatorString(array('max_length' => 255)),
      'descripcion'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'inscripcionhabilitada' => new sfValidatorBoolean(array('required' => false)),
      'capacidad'             => new sfValidatorInteger(array('required' => false)),
      'letrainicio'           => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'letrafin'              => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'turno'                 => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'activo'                => new sfValidatorBoolean(array('required' => false)),
      'idestadocomision'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosComisiones'), 'required' => false)),
      'idcatedra'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
      'created_by'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comisiones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comisiones';
  }

}
