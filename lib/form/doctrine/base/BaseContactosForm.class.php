<?php

/**
 * Contactos form base class.
 *
 * @method Contactos getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContactosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcontacto'      => new sfWidgetFormInputHidden(),
      'idpersona'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => true)),
      'idciudade'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'add_empty' => true)),
      'callee'          => new sfWidgetFormInputText(),
      'numeroe'         => new sfWidgetFormInputText(),
      'barrioe'         => new sfWidgetFormInputText(),
      'edificioe'       => new sfWidgetFormInputText(),
      'pisoe'           => new sfWidgetFormInputText(),
      'deptoe'          => new sfWidgetFormInputText(),
      'idciudadt'       => new sfWidgetFormInputText(),
      'callet'          => new sfWidgetFormInputText(),
      'numerot'         => new sfWidgetFormInputText(),
      'barriot'         => new sfWidgetFormInputText(),
      'edificiot'       => new sfWidgetFormInputText(),
      'pisot'           => new sfWidgetFormInputText(),
      'deptot'          => new sfWidgetFormInputText(),
      'telefonofijocar' => new sfWidgetFormInputText(),
      'telefonofijonum' => new sfWidgetFormInputText(),
      'celularcar'      => new sfWidgetFormInputText(),
      'celularnum'      => new sfWidgetFormInputText(),
      'email'           => new sfWidgetFormInputText(),
      'email1'          => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcontacto'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcontacto')), 'empty_value' => $this->getObject()->get('idcontacto'), 'required' => false)),
      'idpersona'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'required' => false)),
      'idciudade'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudades'), 'required' => false)),
      'callee'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'numeroe'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'barrioe'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'edificioe'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pisoe'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'deptoe'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'idciudadt'       => new sfValidatorInteger(array('required' => false)),
      'callet'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'numerot'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'barriot'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'edificiot'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pisot'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'deptot'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'telefonofijocar' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'telefonofijonum' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'celularcar'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'celularnum'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email1'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contactos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contactos';
  }

}
