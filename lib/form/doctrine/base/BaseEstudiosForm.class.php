<?php

/**
 * Estudios form base class.
 *
 * @method Estudios getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudiosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idestudio'         => new sfWidgetFormInputHidden(),
      'idpersona'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idnivelestudio'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NivelesEstudios'), 'add_empty' => true)),
      'descripcion'       => new sfWidgetFormInputText(),
      'establecimiento'   => new sfWidgetFormInputText(),
      'idciudad'          => new sfWidgetFormInputText(),
      'fecha'             => new sfWidgetFormDate(),
      'duracion'          => new sfWidgetFormInputText(),
      'anioingreso'       => new sfWidgetFormInputText(),
      'anioegreso'        => new sfWidgetFormInputText(),
      'idunidadtiempo'    => new sfWidgetFormInputText(),
      'cantmaterias'      => new sfWidgetFormInputText(),
      'cantmatapro'       => new sfWidgetFormInputText(),
      'promedio'          => new sfWidgetFormInputText(),
      'concluyo'          => new sfWidgetFormInputText(),
      'continua'          => new sfWidgetFormInputText(),
      'idcategoriatitulo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CategoriasTitulos'), 'add_empty' => true)),
      'formaciondocente'  => new sfWidgetFormInputCheckbox(),
      'otrotitulo'        => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idestudio'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idestudio')), 'empty_value' => $this->getObject()->get('idestudio'), 'required' => false)),
      'idpersona'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'required' => false)),
      'idnivelestudio'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NivelesEstudios'), 'required' => false)),
      'descripcion'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'establecimiento'   => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'idciudad'          => new sfValidatorInteger(array('required' => false)),
      'fecha'             => new sfValidatorDate(array('required' => false)),
      'duracion'          => new sfValidatorInteger(array('required' => false)),
      'anioingreso'       => new sfValidatorInteger(array('required' => false)),
      'anioegreso'        => new sfValidatorInteger(array('required' => false)),
      'idunidadtiempo'    => new sfValidatorInteger(array('required' => false)),
      'cantmaterias'      => new sfValidatorInteger(array('required' => false)),
      'cantmatapro'       => new sfValidatorInteger(array('required' => false)),
      'promedio'          => new sfValidatorNumber(array('required' => false)),
      'concluyo'          => new sfValidatorInteger(array('required' => false)),
      'continua'          => new sfValidatorInteger(array('required' => false)),
      'idcategoriatitulo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CategoriasTitulos'), 'required' => false)),
      'formaciondocente'  => new sfValidatorBoolean(array('required' => false)),
      'otrotitulo'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'created_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudios';
  }

}
