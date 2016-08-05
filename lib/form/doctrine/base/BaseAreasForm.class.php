<?php

/**
 * Areas form base class.
 *
 * @method Areas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAreasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idarea'            => new sfWidgetFormInputHidden(),
      'idtipoarea'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposAreas'), 'add_empty' => false)),
      'idareadependiente' => new sfWidgetFormInputText(),
      'descripcion'       => new sfWidgetFormInputText(),
      'letralegajo'       => new sfWidgetFormInputText(),
      'abreviacion'       => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idarea'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idarea')), 'empty_value' => $this->getObject()->get('idarea'), 'required' => false)),
      'idtipoarea'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposAreas'), 'required' => false)),
      'idareadependiente' => new sfValidatorInteger(array('required' => false)),
      'descripcion'       => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'letralegajo'       => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'abreviacion'       => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'created_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('areas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Areas';
  }

}
