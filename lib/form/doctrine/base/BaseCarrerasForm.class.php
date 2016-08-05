<?php

/**
 * Carreras form base class.
 *
 * @method Carreras getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCarrerasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcarrera'           => new sfWidgetFormInputHidden(),
      'nombre'              => new sfWidgetFormInputText(),
      'nombrereducido'      => new sfWidgetFormInputText(),
      'idfacultad'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'add_empty' => false)),
      'letra'               => new sfWidgetFormInputText(),
      'titulo'              => new sfWidgetFormInputText(),
      'idtipocarrera'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCarreras'), 'add_empty' => false)),
      'idmodalidad'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ModalidadesCarreras'), 'add_empty' => false)),
      'termino'             => new sfWidgetFormInputText(),
      'fechacreacion'       => new sfWidgetFormDate(),
      'fechabaja'           => new sfWidgetFormDate(),
      'nroresolucion'       => new sfWidgetFormInputText(),
      'nroresolucionhcd'    => new sfWidgetFormInputText(),
      'nroresolucioncsu'    => new sfWidgetFormInputText(),
      'nroresolucionconeau' => new sfWidgetFormInputText(),
      'nroresolucionbaja'   => new sfWidgetFormInputText(),
      'nroexpediente'       => new sfWidgetFormInputText(),
      'anioinicio'          => new sfWidgetFormInputText(),
      'idestadocarrera'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosCarreras'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcarrera'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcarrera')), 'empty_value' => $this->getObject()->get('idcarrera'), 'required' => false)),
      'nombre'              => new sfValidatorString(array('max_length' => 255)),
      'nombrereducido'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'idfacultad'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facultades'), 'required' => false)),
      'letra'               => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'titulo'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'idtipocarrera'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCarreras'), 'required' => false)),
      'idmodalidad'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ModalidadesCarreras'), 'required' => false)),
      'termino'             => new sfValidatorInteger(array('required' => false)),
      'fechacreacion'       => new sfValidatorDate(array('required' => false)),
      'fechabaja'           => new sfValidatorDate(array('required' => false)),
      'nroresolucion'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'nroresolucionhcd'    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'nroresolucioncsu'    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'nroresolucionconeau' => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'nroresolucionbaja'   => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'nroexpediente'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'anioinicio'          => new sfValidatorInteger(array('required' => false)),
      'idestadocarrera'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosCarreras'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'created_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('carreras[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carreras';
  }

}
