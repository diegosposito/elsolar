<?php

/**
 * TitulosPlanes form base class.
 *
 * @method TitulosPlanes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTitulosPlanesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtituloplan'       => new sfWidgetFormInputHidden(),
      'idtitulo'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titulos'), 'add_empty' => true)),
      'idplanestudio'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => true)),
      'tieneorientacion'   => new sfWidgetFormInputCheckbox(),
      'eligeorientacion'   => new sfWidgetFormInputCheckbox(),
      'totalcreditoegreso' => new sfWidgetFormInputText(),
      'idmodoegreso'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ModosEgreso'), 'add_empty' => true)),
      'sumacredito'        => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'created_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idtituloplan'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idtituloplan')), 'empty_value' => $this->getObject()->get('idtituloplan'), 'required' => false)),
      'idtitulo'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titulos'), 'required' => false)),
      'idplanestudio'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'required' => false)),
      'tieneorientacion'   => new sfValidatorBoolean(array('required' => false)),
      'eligeorientacion'   => new sfValidatorBoolean(array('required' => false)),
      'totalcreditoegreso' => new sfValidatorInteger(array('required' => false)),
      'idmodoegreso'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ModosEgreso'), 'required' => false)),
      'sumacredito'        => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'created_by'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('titulos_planes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TitulosPlanes';
  }

}
