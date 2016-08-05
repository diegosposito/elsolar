<?php

/**
 * DesignacionesEmpleados form base class.
 *
 * @method DesignacionesEmpleados getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDesignacionesEmpleadosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'idempleado'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empleados'), 'add_empty' => true)),
      'idarea'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Areas'), 'add_empty' => true)),
      'idtipocargo'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCargos'), 'add_empty' => true)),
      'idsede'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'inicio'        => new sfWidgetFormDate(),
      'fin'           => new sfWidgetFormDate(),
      'titulo'        => new sfWidgetFormInputText(),
      'activo'        => new sfWidgetFormInputCheckbox(),
      'nroresolucion' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idempleado'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Empleados'), 'required' => false)),
      'idarea'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Areas'), 'required' => false)),
      'idtipocargo'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCargos'), 'required' => false)),
      'idsede'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'required' => false)),
      'inicio'        => new sfValidatorDate(),
      'fin'           => new sfValidatorDate(),
      'titulo'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'activo'        => new sfValidatorBoolean(array('required' => false)),
      'nroresolucion' => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('designaciones_empleados[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DesignacionesEmpleados';
  }

}
