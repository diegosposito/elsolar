<?php

/**
 * Profile filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'tipodoc'          => new sfWidgetFormFilterInput(),
      'nrodoc'           => new sfWidgetFormFilterInput(),
      'idarea'           => new sfWidgetFormFilterInput(),
      'perfil'           => new sfWidgetFormFilterInput(),
      'idsede'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'tipodoc'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nrodoc'           => new sfValidatorPass(array('required' => false)),
      'idarea'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'perfil'           => new sfValidatorPass(array('required' => false)),
      'idsede'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'sf_guard_user_id' => 'ForeignKey',
      'tipodoc'          => 'Number',
      'nrodoc'           => 'Text',
      'idarea'           => 'Number',
      'perfil'           => 'Text',
      'idsede'           => 'Number',
    );
  }
}
