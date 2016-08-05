<?php

/**
 * Contactos2 form base class.
 *
 * @method Contactos2 getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContactos2Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcontacto'     => new sfWidgetFormInputHidden(),
      'idpersona'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idtipocontacto' => new sfWidgetFormInputText(),
      'idciudad'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'campo1'         => new sfWidgetFormInputText(),
      'campo2'         => new sfWidgetFormInputText(),
      'campo3'         => new sfWidgetFormInputText(),
      'campo4'         => new sfWidgetFormInputText(),
      'campo5'         => new sfWidgetFormInputText(),
      'campo6'         => new sfWidgetFormInputText(),
      'campo7'         => new sfWidgetFormInputText(),
      'campo8'         => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idcontacto'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcontacto')), 'empty_value' => $this->getObject()->get('idcontacto'), 'required' => false)),
      'idpersona'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'required' => false)),
      'idtipocontacto' => new sfValidatorInteger(array('required' => false)),
      'idciudad'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'required' => false)),
      'campo1'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo2'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo3'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo4'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo5'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo6'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo7'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'campo8'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contactos2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contactos2';
  }

}
