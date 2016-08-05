<?php

/**
 * MateriasPlanes form base class.
 *
 * @method MateriasPlanes getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMateriasPlanesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmateriaplan'            => new sfWidgetFormInputHidden(),
      'idmateria'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => true)),
      'idplanestudio'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => true)),
      'idtipomateria'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposMaterias'), 'add_empty' => true)),
      'idtipocursada'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCursadas'), 'add_empty' => false)),
      'obligatoria'              => new sfWidgetFormInputCheckbox(),
      'promediable'              => new sfWidgetFormInputCheckbox(),
      'saleanalitico'            => new sfWidgetFormInputCheckbox(),
      'generica'                 => new sfWidgetFormInputText(),
      'orden'                    => new sfWidgetFormInputText(),
      'anodecursada'             => new sfWidgetFormInputText(),
      'periododecursada'         => new sfWidgetFormInputText(),
      'cargahorariasemanal'      => new sfWidgetFormInputText(),
      'cargahorariatotal'        => new sfWidgetFormInputText(),
      'cantidadaplazos'          => new sfWidgetFormInputText(),
      'regularpararendirlibre'   => new sfWidgetFormInputCheckbox(),
      'cantidadaplazoslibre'     => new sfWidgetFormInputText(),
      'porcentajepararendir'     => new sfWidgetFormInputText(),
      'credito'                  => new sfWidgetFormInputText(),
      'puntajerequerido'         => new sfWidgetFormInputText(),
      'vigencia'                 => new sfWidgetFormInputText(),
      'codmat'                   => new sfWidgetFormInputText(),
      'contenidominimo'          => new sfWidgetFormInputText(),
      'idmodoinscripcioncursada' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ModosInscripcionCursadas'), 'add_empty' => false)),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'created_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idmateriaplan'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idmateriaplan')), 'empty_value' => $this->getObject()->get('idmateriaplan'), 'required' => false)),
      'idmateria'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'required' => false)),
      'idplanestudio'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'required' => false)),
      'idtipomateria'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposMaterias'), 'required' => false)),
      'idtipocursada'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCursadas'), 'required' => false)),
      'obligatoria'              => new sfValidatorBoolean(array('required' => false)),
      'promediable'              => new sfValidatorBoolean(array('required' => false)),
      'saleanalitico'            => new sfValidatorBoolean(array('required' => false)),
      'generica'                 => new sfValidatorInteger(array('required' => false)),
      'orden'                    => new sfValidatorInteger(array('required' => false)),
      'anodecursada'             => new sfValidatorInteger(array('required' => false)),
      'periododecursada'         => new sfValidatorInteger(array('required' => false)),
      'cargahorariasemanal'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'cargahorariatotal'        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'cantidadaplazos'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'regularpararendirlibre'   => new sfValidatorBoolean(array('required' => false)),
      'cantidadaplazoslibre'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'porcentajepararendir'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'credito'                  => new sfValidatorInteger(array('required' => false)),
      'puntajerequerido'         => new sfValidatorInteger(array('required' => false)),
      'vigencia'                 => new sfValidatorInteger(array('required' => false)),
      'codmat'                   => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'contenidominimo'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'idmodoinscripcioncursada' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ModosInscripcionCursadas'), 'required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'created_by'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('materias_planes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MateriasPlanes';
  }

}
