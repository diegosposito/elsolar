<?php

/**
 * AluMat form base class.
 *
 * @method AluMat getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAluMatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'idalumno'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => false)),
      'idcomision'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comisiones'), 'add_empty' => false)),
      'idmateria'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => false)),
      'idcatedra'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'add_empty' => false)),
      'idestadomateria'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMateria'), 'add_empty' => false)),
      'fecha'            => new sfWidgetFormDate(),
      'fechavencimiento' => new sfWidgetFormDate(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'created_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idalumno'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'idcomision'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comisiones'), 'required' => false)),
      'idmateria'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'required' => false)),
      'idcatedra'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catedras'), 'required' => false)),
      'idestadomateria'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosMateria'), 'required' => false)),
      'fecha'            => new sfValidatorDate(array('required' => false)),
      'fechavencimiento' => new sfValidatorDate(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'created_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('alu_mat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AluMat';
  }

}
