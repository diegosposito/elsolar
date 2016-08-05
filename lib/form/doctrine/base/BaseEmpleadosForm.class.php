<?php

/**
 * Empleados form base class.
 *
 * @method Empleados getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEmpleadosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idempleado' => new sfWidgetFormInputHidden(),
      'idpersona'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'legajo'     => new sfWidgetFormInputText(),
      'activo'     => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idempleado' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idempleado')), 'empty_value' => $this->getObject()->get('idempleado'), 'required' => false)),
      'idpersona'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'required' => false)),
      'legajo'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'activo'     => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'created_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('empleados[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Empleados';
  }

}
