<?php

/**
 * Menu form base class.
 *
 * @method Menu getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMenuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'credencial'  => new sfWidgetFormInputText(),
      'modulo'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormInputText(),
      'parametro'   => new sfWidgetFormInputText(),
      'idgrupomenu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupomenu'), 'add_empty' => true)),
      'orden'       => new sfWidgetFormInputText(),
      'idsistema'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sistemas'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'credencial'  => new sfValidatorString(array('max_length' => 20)),
      'modulo'      => new sfValidatorString(array('max_length' => 200)),
      'descripcion' => new sfValidatorString(array('max_length' => 200)),
      'parametro'   => new sfValidatorString(array('max_length' => 200)),
      'idgrupomenu' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupomenu'), 'required' => false)),
      'orden'       => new sfValidatorInteger(array('required' => false)),
      'idsistema'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sistemas'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menu';
  }

}
