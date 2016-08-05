<?php

/**
 * Titulos form base class.
 *
 * @method Titulos getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTitulosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtitulo'                 => new sfWidgetFormInputHidden(),
      'nombre'                   => new sfWidgetFormInputText(),
      'nombrefemenino'           => new sfWidgetFormInputText(),
      'idtipotitulo'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposTitulos'), 'add_empty' => false)),
      'niveltitulo'              => new sfWidgetFormInputText(),
      'fechacreacion'            => new sfWidgetFormDate(),
      'nroresolucion'            => new sfWidgetFormInputText(),
      'fechacreacionministerial' => new sfWidgetFormDate(),
      'nroresolucionministerial' => new sfWidgetFormInputText(),
      'duracion'                 => new sfWidgetFormInputText(),
      'tiempotrabajofinal'       => new sfWidgetFormInputText(),
      'incumbencias'             => new sfWidgetFormInputText(),
      'acreditacionconeau'       => new sfWidgetFormInputCheckbox(),
      'categorizacionconeau'     => new sfWidgetFormInputText(),
      'fechabaja'                => new sfWidgetFormDate(),
      'idestadotitulo'           => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'created_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idtitulo'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idtitulo')), 'empty_value' => $this->getObject()->get('idtitulo'), 'required' => false)),
      'nombre'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nombrefemenino'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'idtipotitulo'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposTitulos'), 'required' => false)),
      'niveltitulo'              => new sfValidatorInteger(array('required' => false)),
      'fechacreacion'            => new sfValidatorDate(array('required' => false)),
      'nroresolucion'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'fechacreacionministerial' => new sfValidatorDate(array('required' => false)),
      'nroresolucionministerial' => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'duracion'                 => new sfValidatorInteger(array('required' => false)),
      'tiempotrabajofinal'       => new sfValidatorInteger(array('required' => false)),
      'incumbencias'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'acreditacionconeau'       => new sfValidatorBoolean(array('required' => false)),
      'categorizacionconeau'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'fechabaja'                => new sfValidatorDate(array('required' => false)),
      'idestadotitulo'           => new sfValidatorInteger(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'created_by'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('titulos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Titulos';
  }

}
