<?php

/**
 * DocumentacionPlanesEstudios form base class.
 *
 * @method DocumentacionPlanesEstudios getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentacionPlanesEstudiosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'iddocumentacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentacion'), 'add_empty' => false)),
      'idplanestudio'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => false)),
      'activo'          => new sfWidgetFormInputCheckbox(),
      'obligatorio'     => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'iddocumentacion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentacion'))),
      'idplanestudio'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'))),
      'activo'          => new sfValidatorBoolean(array('required' => false)),
      'obligatorio'     => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentacion_planes_estudios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentacionPlanesEstudios';
  }

}
