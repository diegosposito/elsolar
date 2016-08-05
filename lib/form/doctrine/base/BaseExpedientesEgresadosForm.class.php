<?php

/**
 * ExpedientesEgresados form base class.
 *
 * @method ExpedientesEgresados getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExpedientesEgresadosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idexpediente'               => new sfWidgetFormInputHidden(),
      'idtitulo'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titulos'), 'add_empty' => false)),
      'idalumno'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => false)),
      'idsede'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => false)),
      'fechaegreso'                => new sfWidgetFormDate(),
      'fechainformeauditoria'      => new sfWidgetFormDate(),
      'fechasolicitud'             => new sfWidgetFormDate(),
      'fechaentregatitulo'         => new sfWidgetFormDate(),
      'fechaenviome'               => new sfWidgetFormDate(),
      'fecharecibidome'            => new sfWidgetFormDate(),
      'idderivacionbiblioteca'     => new sfWidgetFormInputText(),
      'idderivacionadministracion' => new sfWidgetFormInputText(),
      'folio'                      => new sfWidgetFormInputText(),
      'otradocumentacion'          => new sfWidgetFormTextarea(),
      'observaciones'              => new sfWidgetFormTextarea(),
      'activo'                     => new sfWidgetFormInputText(),
      'registrodiplomame'          => new sfWidgetFormInputText(),
      'registrome'                 => new sfWidgetFormInputText(),
      'registrocertificadome'      => new sfWidgetFormInputText(),
      'nrorecibo1'                 => new sfWidgetFormInputText(),
      'nrorecibo2'                 => new sfWidgetFormInputText(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'created_by'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idexpediente'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idexpediente')), 'empty_value' => $this->getObject()->get('idexpediente'), 'required' => false)),
      'idtitulo'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titulos'), 'required' => false)),
      'idalumno'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'required' => false)),
      'idsede'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'))),
      'fechaegreso'                => new sfValidatorDate(),
      'fechainformeauditoria'      => new sfValidatorDate(),
      'fechasolicitud'             => new sfValidatorDate(),
      'fechaentregatitulo'         => new sfValidatorDate(),
      'fechaenviome'               => new sfValidatorDate(),
      'fecharecibidome'            => new sfValidatorDate(),
      'idderivacionbiblioteca'     => new sfValidatorInteger(),
      'idderivacionadministracion' => new sfValidatorInteger(),
      'folio'                      => new sfValidatorInteger(),
      'otradocumentacion'          => new sfValidatorString(array('max_length' => 2000)),
      'observaciones'              => new sfValidatorString(array('max_length' => 2000)),
      'activo'                     => new sfValidatorInteger(array('required' => false)),
      'registrodiplomame'          => new sfValidatorString(array('max_length' => 20)),
      'registrome'                 => new sfValidatorString(array('max_length' => 20)),
      'registrocertificadome'      => new sfValidatorString(array('max_length' => 20)),
      'nrorecibo1'                 => new sfValidatorString(array('max_length' => 10)),
      'nrorecibo2'                 => new sfValidatorString(array('max_length' => 10)),
      'created_at'                 => new sfValidatorDateTime(),
      'updated_at'                 => new sfValidatorDateTime(),
      'created_by'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('expedientes_egresados[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpedientesEgresados';
  }

}
