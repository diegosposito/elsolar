<?php

/**
 * Documentacion form base class.
 *
 * @method Documentacion getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddocumentacion'     => new sfWidgetFormInputHidden(),
      'descripcion'         => new sfWidgetFormTextarea(),
      'orden'               => new sfWidgetFormInputText(),
      'idtipodocumentacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentacion'), 'add_empty' => false)),
      'activo'              => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddocumentacion'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddocumentacion')), 'empty_value' => $this->getObject()->get('iddocumentacion'), 'required' => false)),
      'descripcion'         => new sfValidatorString(array('max_length' => 1000)),
      'orden'               => new sfValidatorInteger(),
      'idtipodocumentacion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposDocumentacion'))),
      'activo'              => new sfValidatorBoolean(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'created_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentacion';
  }

}
