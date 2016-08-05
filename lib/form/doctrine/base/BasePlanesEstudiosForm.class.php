<?php

/**
 * PlanesEstudios form base class.
 *
 * @method PlanesEstudios getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlanesEstudiosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idplanestudio'             => new sfWidgetFormInputHidden(),
      'idcarrera'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carreras'), 'add_empty' => false)),
      'fecha'                     => new sfWidgetFormDate(),
      'fechafin'                  => new sfWidgetFormDate(),
      'nombre'                    => new sfWidgetFormInputText(),
      'version'                   => new sfWidgetFormInputText(),
      'letra'                     => new sfWidgetFormInputText(),
      'nroresolucion'             => new sfWidgetFormInputText(),
      'nroresolucionhcd'          => new sfWidgetFormInputText(),
      'nroresolucioncsu'          => new sfWidgetFormInputText(),
      'nroresolucionconeau'       => new sfWidgetFormInputText(),
      'duracionnumerica'          => new sfWidgetFormInputText(),
      'horastotales'              => new sfWidgetFormInputText(),
      'cantidadmaterias'          => new sfWidgetFormInputText(),
      'cantidadcomunes'           => new sfWidgetFormInputText(),
      'cantidadgenericas'         => new sfWidgetFormInputText(),
      'cantidadsubespacios'       => new sfWidgetFormInputText(),
      'cantidadpreuniversitarias' => new sfWidgetFormInputText(),
      'cantidadoptativas'         => new sfWidgetFormInputText(),
      'cantidadextracurriculares' => new sfWidgetFormInputText(),
      'cantidadseminarios'        => new sfWidgetFormInputText(),
      'cantidadidiomas'           => new sfWidgetFormInputText(),
      'cantidadtesinas'           => new sfWidgetFormInputText(),
      'cantidadtpfinal'           => new sfWidgetFormInputText(),
      'fechavigencia'             => new sfWidgetFormDate(),
      'vigenciaminima'            => new sfWidgetFormInputText(),
      'topecreditocursado'        => new sfWidgetFormInputText(),
      'topecreditoregularidades'  => new sfWidgetFormInputText(),
      'idtiporesolucion'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposResoluciones'), 'add_empty' => false)),
      'idplananterior'            => new sfWidgetFormInputText(),
      'idtipoplan'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposPlanes'), 'add_empty' => false)),
      'idestadoplan'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosPlanes'), 'add_empty' => false)),
      'idescalanota'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EscalasNotas'), 'add_empty' => false)),
      'titulo'                    => new sfWidgetFormInputText(),
      'fechaaprobacion'           => new sfWidgetFormDate(),
      'aprobada'                  => new sfWidgetFormInputCheckbox(),
      'modalidadalumnolibre'      => new sfWidgetFormInputCheckbox(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
      'created_by'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idplanestudio'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idplanestudio')), 'empty_value' => $this->getObject()->get('idplanestudio'), 'required' => false)),
      'idcarrera'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carreras'), 'required' => false)),
      'fecha'                     => new sfValidatorDate(array('required' => false)),
      'fechafin'                  => new sfValidatorDate(array('required' => false)),
      'nombre'                    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'version'                   => new sfValidatorInteger(array('required' => false)),
      'letra'                     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'nroresolucion'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nroresolucionhcd'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nroresolucioncsu'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nroresolucionconeau'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'duracionnumerica'          => new sfValidatorNumber(array('required' => false)),
      'horastotales'              => new sfValidatorInteger(array('required' => false)),
      'cantidadmaterias'          => new sfValidatorInteger(array('required' => false)),
      'cantidadcomunes'           => new sfValidatorInteger(array('required' => false)),
      'cantidadgenericas'         => new sfValidatorInteger(array('required' => false)),
      'cantidadsubespacios'       => new sfValidatorInteger(array('required' => false)),
      'cantidadpreuniversitarias' => new sfValidatorInteger(array('required' => false)),
      'cantidadoptativas'         => new sfValidatorInteger(array('required' => false)),
      'cantidadextracurriculares' => new sfValidatorInteger(array('required' => false)),
      'cantidadseminarios'        => new sfValidatorInteger(array('required' => false)),
      'cantidadidiomas'           => new sfValidatorInteger(array('required' => false)),
      'cantidadtesinas'           => new sfValidatorInteger(array('required' => false)),
      'cantidadtpfinal'           => new sfValidatorInteger(array('required' => false)),
      'fechavigencia'             => new sfValidatorDate(array('required' => false)),
      'vigenciaminima'            => new sfValidatorInteger(array('required' => false)),
      'topecreditocursado'        => new sfValidatorInteger(array('required' => false)),
      'topecreditoregularidades'  => new sfValidatorInteger(array('required' => false)),
      'idtiporesolucion'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposResoluciones'), 'required' => false)),
      'idplananterior'            => new sfValidatorInteger(array('required' => false)),
      'idtipoplan'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposPlanes'), 'required' => false)),
      'idestadoplan'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosPlanes'), 'required' => false)),
      'idescalanota'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EscalasNotas'), 'required' => false)),
      'titulo'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fechaaprobacion'           => new sfValidatorDate(array('required' => false)),
      'aprobada'                  => new sfValidatorBoolean(array('required' => false)),
      'modalidadalumnolibre'      => new sfValidatorBoolean(array('required' => false)),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
      'created_by'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('planes_estudios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PlanesEstudios';
  }

}
