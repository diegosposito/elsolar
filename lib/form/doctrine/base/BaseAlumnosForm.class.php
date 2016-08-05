<?php

/**
 * Alumnos form base class.
 *
 * @method Alumnos getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAlumnosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idalumno'                => new sfWidgetFormInputHidden(),
      'idpersona'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'add_empty' => false)),
      'idplanestudio'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => false)),
      'idcuentapersona'         => new sfWidgetFormInputText(),
      'idciclolectivo'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CiclosLectivos'), 'add_empty' => false)),
      'idestudioprevio'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudios'), 'add_empty' => false)),
      'fechaingreso'            => new sfWidgetFormDate(),
      'ingreso'                 => new sfWidgetFormInputText(),
      'legajo'                  => new sfWidgetFormInputText(),
      'fotografia'              => new sfWidgetFormInputCheckbox(),
      'fotocopiadni'            => new sfWidgetFormInputCheckbox(),
      'fotocopialegtitulo'      => new sfWidgetFormInputCheckbox(),
      'fotocopialegtitulogrado' => new sfWidgetFormInputCheckbox(),
      'fotocopialegpartidanac'  => new sfWidgetFormInputCheckbox(),
      'certtittramite'          => new sfWidgetFormInputCheckbox(),
      'fechacerttittramite'     => new sfWidgetFormDate(),
      'certalureg'              => new sfWidgetFormInputCheckbox(),
      'fechacertalureg'         => new sfWidgetFormDate(),
      'derechoevaluacion'       => new sfWidgetFormInputCheckbox(),
      'experiencialaboral'      => new sfWidgetFormInputCheckbox(),
      'pagomatricula'           => new sfWidgetFormInputText(),
      'bancarizacion'           => new sfWidgetFormInputCheckbox(),
      'titulorevalidado'        => new sfWidgetFormInputCheckbox(),
      'tramiteresidencia'       => new sfWidgetFormInputCheckbox(),
      'radiografiatorax'        => new sfWidgetFormInputCheckbox(),
      'electrocardiograma'      => new sfWidgetFormInputCheckbox(),
      'ergonomia'               => new sfWidgetFormInputCheckbox(),
      'ergometria'              => new sfWidgetFormInputCheckbox(),
      'planillamedica'          => new sfWidgetFormInputCheckbox(),
      'planillabucodental'      => new sfWidgetFormInputCheckbox(),
      'hemograma'               => new sfWidgetFormInputCheckbox(),
      'glucemia'                => new sfWidgetFormInputCheckbox(),
      'estudiovdrl'             => new sfWidgetFormInputCheckbox(),
      'activo'                  => new sfWidgetFormInputCheckbox(),
      'promedio'                => new sfWidgetFormInputText(),
      'idtipoinscripto'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposInscriptos'), 'add_empty' => false)),
      'idsede'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => false)),
      'codadministracion'       => new sfWidgetFormInputText(),
      'internacional'           => new sfWidgetFormInputCheckbox(),
      'aspirante'               => new sfWidgetFormInputCheckbox(),
      'observaciones'           => new sfWidgetFormTextarea(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'created_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idalumno'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idalumno')), 'empty_value' => $this->getObject()->get('idalumno'), 'required' => false)),
      'idpersona'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Personas'), 'required' => false)),
      'idplanestudio'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'required' => false)),
      'idcuentapersona'         => new sfValidatorInteger(array('required' => false)),
      'idciclolectivo'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CiclosLectivos'), 'required' => false)),
      'idestudioprevio'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estudios'), 'required' => false)),
      'fechaingreso'            => new sfValidatorDate(array('required' => false)),
      'ingreso'                 => new sfValidatorInteger(array('required' => false)),
      'legajo'                  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'fotografia'              => new sfValidatorBoolean(array('required' => false)),
      'fotocopiadni'            => new sfValidatorBoolean(array('required' => false)),
      'fotocopialegtitulo'      => new sfValidatorBoolean(array('required' => false)),
      'fotocopialegtitulogrado' => new sfValidatorBoolean(array('required' => false)),
      'fotocopialegpartidanac'  => new sfValidatorBoolean(array('required' => false)),
      'certtittramite'          => new sfValidatorBoolean(array('required' => false)),
      'fechacerttittramite'     => new sfValidatorDate(),
      'certalureg'              => new sfValidatorBoolean(array('required' => false)),
      'fechacertalureg'         => new sfValidatorDate(),
      'derechoevaluacion'       => new sfValidatorBoolean(array('required' => false)),
      'experiencialaboral'      => new sfValidatorBoolean(array('required' => false)),
      'pagomatricula'           => new sfValidatorInteger(array('required' => false)),
      'bancarizacion'           => new sfValidatorBoolean(array('required' => false)),
      'titulorevalidado'        => new sfValidatorBoolean(array('required' => false)),
      'tramiteresidencia'       => new sfValidatorBoolean(array('required' => false)),
      'radiografiatorax'        => new sfValidatorBoolean(array('required' => false)),
      'electrocardiograma'      => new sfValidatorBoolean(array('required' => false)),
      'ergonomia'               => new sfValidatorBoolean(array('required' => false)),
      'ergometria'              => new sfValidatorBoolean(array('required' => false)),
      'planillamedica'          => new sfValidatorBoolean(array('required' => false)),
      'planillabucodental'      => new sfValidatorBoolean(array('required' => false)),
      'hemograma'               => new sfValidatorBoolean(array('required' => false)),
      'glucemia'                => new sfValidatorBoolean(array('required' => false)),
      'estudiovdrl'             => new sfValidatorBoolean(array('required' => false)),
      'activo'                  => new sfValidatorBoolean(array('required' => false)),
      'promedio'                => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'idtipoinscripto'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposInscriptos'), 'required' => false)),
      'idsede'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'required' => false)),
      'codadministracion'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'internacional'           => new sfValidatorBoolean(array('required' => false)),
      'aspirante'               => new sfValidatorBoolean(array('required' => false)),
      'observaciones'           => new sfValidatorString(array('max_length' => 2000)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
      'created_by'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('alumnos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alumnos';
  }

}
