<?php

/**
 * Correlatividades form base class.
 *
 * @method Correlatividades getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrelatividadesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'idmateriaplan'        => new sfWidgetFormInputText(),
      'situacion'            => new sfWidgetFormInputText(),
      'condicion'            => new sfWidgetFormInputText(),
      'idmateriaplanc'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'add_empty' => true)),
      'idtipocorrelatividad' => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idmateriaplan'        => new sfValidatorInteger(array('required' => false)),
      'situacion'            => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'condicion'            => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'idmateriaplanc'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'required' => false)),
      'idtipocorrelatividad' => new sfValidatorInteger(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'created_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('correlatividades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correlatividades';
  }

}
