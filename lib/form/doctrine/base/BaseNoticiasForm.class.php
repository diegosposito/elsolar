<?php

/**
 * Noticias form base class.
 *
 * @method Noticias getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNoticiasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'idsede'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => false)),
      'titulo'      => new sfWidgetFormInputText(),
      'intro'       => new sfWidgetFormTextarea(),
      'descripcion' => new sfWidgetFormTextarea(),
      'idusuario'   => new sfWidgetFormInputText(),
      'orden'       => new sfWidgetFormInputText(),
      'inicio'      => new sfWidgetFormDate(),
      'fin'         => new sfWidgetFormDate(),
      'leer_mas'    => new sfWidgetFormInputCheckbox(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'privada'     => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idsede'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'))),
      'titulo'      => new sfValidatorString(array('max_length' => 255)),
      'intro'       => new sfValidatorString(array('max_length' => 500)),
      'descripcion' => new sfValidatorString(array('max_length' => 4000)),
      'idusuario'   => new sfValidatorInteger(),
      'orden'       => new sfValidatorInteger(),
      'inicio'      => new sfValidatorDate(),
      'fin'         => new sfValidatorDate(),
      'leer_mas'    => new sfValidatorBoolean(array('required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'privada'     => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('noticias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Noticias';
  }

}
