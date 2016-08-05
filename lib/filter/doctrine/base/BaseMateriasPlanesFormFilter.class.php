<?php

/**
 * MateriasPlanes filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMateriasPlanesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmateria'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materias'), 'add_empty' => true)),
      'idplanestudio'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanesEstudios'), 'add_empty' => true)),
      'idtipomateria'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposMaterias'), 'add_empty' => true)),
      'idtipocursada'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposCursadas'), 'add_empty' => true)),
      'obligatoria'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'promediable'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'saleanalitico'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'generica'                 => new sfWidgetFormFilterInput(),
      'orden'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'anodecursada'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'periododecursada'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cargahorariasemanal'      => new sfWidgetFormFilterInput(),
      'cargahorariatotal'        => new sfWidgetFormFilterInput(),
      'cantidadaplazos'          => new sfWidgetFormFilterInput(),
      'regularpararendirlibre'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'cantidadaplazoslibre'     => new sfWidgetFormFilterInput(),
      'porcentajepararendir'     => new sfWidgetFormFilterInput(),
      'credito'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'puntajerequerido'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vigencia'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codmat'                   => new sfWidgetFormFilterInput(),
      'contenidominimo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idmodoinscripcioncursada' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ModosInscripcionCursadas'), 'add_empty' => true)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idmateria'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materias'), 'column' => 'idmateria')),
      'idplanestudio'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PlanesEstudios'), 'column' => 'idplanestudio')),
      'idtipomateria'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposMaterias'), 'column' => 'idtipomateria')),
      'idtipocursada'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposCursadas'), 'column' => 'idtipocursada')),
      'obligatoria'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'promediable'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'saleanalitico'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'generica'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orden'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'anodecursada'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'periododecursada'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cargahorariasemanal'      => new sfValidatorPass(array('required' => false)),
      'cargahorariatotal'        => new sfValidatorPass(array('required' => false)),
      'cantidadaplazos'          => new sfValidatorPass(array('required' => false)),
      'regularpararendirlibre'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'cantidadaplazoslibre'     => new sfValidatorPass(array('required' => false)),
      'porcentajepararendir'     => new sfValidatorPass(array('required' => false)),
      'credito'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'puntajerequerido'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vigencia'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codmat'                   => new sfValidatorPass(array('required' => false)),
      'contenidominimo'          => new sfValidatorPass(array('required' => false)),
      'idmodoinscripcioncursada' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ModosInscripcionCursadas'), 'column' => 'idmodoinscripcioncursada')),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('materias_planes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MateriasPlanes';
  }

  public function getFields()
  {
    return array(
      'idmateriaplan'            => 'Number',
      'idmateria'                => 'ForeignKey',
      'idplanestudio'            => 'ForeignKey',
      'idtipomateria'            => 'ForeignKey',
      'idtipocursada'            => 'ForeignKey',
      'obligatoria'              => 'Boolean',
      'promediable'              => 'Boolean',
      'saleanalitico'            => 'Boolean',
      'generica'                 => 'Number',
      'orden'                    => 'Number',
      'anodecursada'             => 'Number',
      'periododecursada'         => 'Number',
      'cargahorariasemanal'      => 'Text',
      'cargahorariatotal'        => 'Text',
      'cantidadaplazos'          => 'Text',
      'regularpararendirlibre'   => 'Boolean',
      'cantidadaplazoslibre'     => 'Text',
      'porcentajepararendir'     => 'Text',
      'credito'                  => 'Number',
      'puntajerequerido'         => 'Number',
      'vigencia'                 => 'Number',
      'codmat'                   => 'Text',
      'contenidominimo'          => 'Text',
      'idmodoinscripcioncursada' => 'ForeignKey',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'created_by'               => 'ForeignKey',
      'updated_by'               => 'ForeignKey',
    );
  }
}
