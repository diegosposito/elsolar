<?php

/**
 * TransicionesMaterias form base class.
 *
 * @method TransicionesMaterias getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransicionesMateriasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtransicionmateria' => new sfWidgetFormInputHidden(),
      'idtransicionplan'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TransicionesPlanes'), 'add_empty' => false)),
      'idmateriaorigen'     => new sfWidgetFormInputText(),
      'idmateriadestino'    => new sfWidgetFormInputText(),
      'valormateria'        => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idtransicionmateria' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idtransicionmateria')), 'empty_value' => $this->getObject()->get('idtransicionmateria'), 'required' => false)),
      'idtransicionplan'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TransicionesPlanes'), 'required' => false)),
      'idmateriaorigen'     => new sfValidatorInteger(array('required' => false)),
      'idmateriadestino'    => new sfValidatorInteger(array('required' => false)),
      'valormateria'        => new sfValidatorInteger(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'created_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transiciones_materias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransicionesMaterias';
  }

}
