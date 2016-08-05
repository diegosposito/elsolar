<?php

/**
 * Catedras form base class.
 *
 * @method Catedras getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCatedrasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcatedra'     => new sfWidgetFormInputHidden(),
      'idmateriaplan' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'add_empty' => true)),
      'idsede'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'activa'        => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcatedra'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcatedra')), 'empty_value' => $this->getObject()->get('idcatedra'), 'required' => false)),
      'idmateriaplan' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MateriasPlanes'), 'required' => false)),
      'idsede'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'required' => false)),
      'activa'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catedras[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catedras';
  }

}
