<?php

/**
 * FichaCarga form base class.
 *
 * @method FichaCarga getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFichaCargaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idficha'          => new sfWidgetFormInputHidden(),
      'idalumno'         => new sfWidgetFormInputText(),
      'idmateriaplan'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'add_empty' => true)),
      'idlibroacta'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibrosActas'), 'add_empty' => true)),
      'fecha'            => new sfWidgetFormDate(),
      'folio'            => new sfWidgetFormInputText(),
      'promedio'         => new sfWidgetFormInputText(),
      'idestadomateria'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMateria'), 'add_empty' => true)),
      'fechavencimiento' => new sfWidgetFormDate(),
      'controlado'       => new sfWidgetFormInputCheckbox(),
      'transferido'      => new sfWidgetFormInputCheckbox(),
      'comentarios'      => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'created_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idficha'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idficha')), 'empty_value' => $this->getObject()->get('idficha'), 'required' => false)),
      'idalumno'         => new sfValidatorInteger(array('required' => false)),
      'idmateriaplan'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'required' => false)),
      'idlibroacta'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibrosActas'), 'required' => false)),
      'fecha'            => new sfValidatorDate(),
      'folio'            => new sfValidatorString(array('max_length' => 10)),
      'promedio'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'idestadomateria'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMateria'), 'required' => false)),
      'fechavencimiento' => new sfValidatorDate(),
      'controlado'       => new sfValidatorBoolean(array('required' => false)),
      'transferido'      => new sfValidatorBoolean(array('required' => false)),
      'comentarios'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'created_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'FichaCarga', 'column' => array('idalumno', 'idmateriaplan', 'idestadomateria')))
    );

    $this->widgetSchema->setNameFormat('ficha_carga[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FichaCarga';
  }

}
