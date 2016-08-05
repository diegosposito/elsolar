<?php

/**
 * DetalleNota form base class.
 *
 * @method DetalleNota getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetalleNotaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddetallenota' => new sfWidgetFormInputHidden(),
      'descripcion'   => new sfWidgetFormInputText(),
      'resultado'     => new sfWidgetFormInputText(),
      'valorinferior' => new sfWidgetFormInputText(),
      'valorsuperior' => new sfWidgetFormInputText(),
      'activo'        => new sfWidgetFormInputCheckbox(),
      'idescalanota'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EscalasNotas'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddetallenota' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddetallenota')), 'empty_value' => $this->getObject()->get('iddetallenota'), 'required' => false)),
      'descripcion'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'resultado'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'valorinferior' => new sfValidatorNumber(array('required' => false)),
      'valorsuperior' => new sfValidatorNumber(array('required' => false)),
      'activo'        => new sfValidatorBoolean(array('required' => false)),
      'idescalanota'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EscalasNotas'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_nota[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleNota';
  }

}
