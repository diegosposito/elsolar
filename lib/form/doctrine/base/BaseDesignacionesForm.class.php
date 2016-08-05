<?php

/**
 * Designaciones form base class.
 *
 * @method Designaciones getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDesignacionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddesignacion'          => new sfWidgetFormInputHidden(),
      'idcatedra'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => true)),
      'idprofesor'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesores'), 'add_empty' => true)),
      'idtipodesignacion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDesignaciones'), 'add_empty' => true)),
      'inicio'                 => new sfWidgetFormDate(),
      'fin'                    => new sfWidgetFormDate(),
      'fechaaprobacion'        => new sfWidgetFormDate(),
      'horas'                  => new sfWidgetFormInputText(),
      'activo'                 => new sfWidgetFormInputCheckbox(),
      'adhonorem'              => new sfWidgetFormInputCheckbox(),
      'licencia'               => new sfWidgetFormInputCheckbox(),
      'visibleensede'          => new sfWidgetFormInputCheckbox(),
      'idresolucionprofesor'   => new sfWidgetFormInputText(),
      'idresolucioncsu'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ResolucionesProfesores'), 'add_empty' => true)),
      'iddedicacion'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dedicaciones'), 'add_empty' => true)),
      'idestadodesignacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosDesignaciones'), 'add_empty' => true)),
      'observaciones'          => new sfWidgetFormTextarea(),
      'motivonuevadesignacion' => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'created_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddesignacion'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddesignacion')), 'empty_value' => $this->getObject()->get('iddesignacion'), 'required' => false)),
      'idcatedra'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'required' => false)),
      'idprofesor'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesores'), 'required' => false)),
      'idtipodesignacion'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDesignaciones'), 'required' => false)),
      'inicio'                 => new sfValidatorDate(),
      'fin'                    => new sfValidatorDate(),
      'fechaaprobacion'        => new sfValidatorDate(),
      'horas'                  => new sfValidatorString(array('max_length' => 8)),
      'activo'                 => new sfValidatorBoolean(array('required' => false)),
      'adhonorem'              => new sfValidatorBoolean(array('required' => false)),
      'licencia'               => new sfValidatorBoolean(array('required' => false)),
      'visibleensede'          => new sfValidatorBoolean(array('required' => false)),
      'idresolucionprofesor'   => new sfValidatorInteger(array('required' => false)),
      'idresolucioncsu'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ResolucionesProfesores'), 'required' => false)),
      'iddedicacion'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dedicaciones'), 'required' => false)),
      'idestadodesignacion'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosDesignaciones'), 'required' => false)),
      'observaciones'          => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'motivonuevadesignacion' => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
      'created_by'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('designaciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Designaciones';
  }

}
