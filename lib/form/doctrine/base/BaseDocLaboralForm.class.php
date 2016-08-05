<?php

/**
 * DocLaboral form base class.
 *
 * @method DocLaboral getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocLaboralForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddoclaboral'   => new sfWidgetFormInputHidden(),
      'idpersona'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idprofesion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesiones'), 'add_empty' => true)),
      'iddedicacion'   => new sfWidgetFormInputText(),
      'lugar'          => new sfWidgetFormInputText(),
      'horas'          => new sfWidgetFormInputText(),
      'idunidadtiempo' => new sfWidgetFormInputText(),
      'certificado'    => new sfWidgetFormInputText(),
      'trabaja'        => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddoclaboral'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddoclaboral')), 'empty_value' => $this->getObject()->get('iddoclaboral'), 'required' => false)),
      'idpersona'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'required' => false)),
      'idprofesion'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesiones'), 'required' => false)),
      'iddedicacion'   => new sfValidatorInteger(array('required' => false)),
      'lugar'          => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'horas'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'idunidadtiempo' => new sfValidatorInteger(array('required' => false)),
      'certificado'    => new sfValidatorInteger(array('required' => false)),
      'trabaja'        => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('doc_laboral[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocLaboral';
  }

}
