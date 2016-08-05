<?php

/**
 * PlanesEstudios filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlanesEstudiosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcarrera'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carreras'), 'add_empty' => true)),
      'fecha'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechafin'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nombre'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'version'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'letra'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nroresolucion'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nroresolucionhcd'          => new sfWidgetFormFilterInput(),
      'nroresolucioncsu'          => new sfWidgetFormFilterInput(),
      'nroresolucionconeau'       => new sfWidgetFormFilterInput(),
      'duracionnumerica'          => new sfWidgetFormFilterInput(),
      'horastotales'              => new sfWidgetFormFilterInput(),
      'cantidadmaterias'          => new sfWidgetFormFilterInput(),
      'cantidadcomunes'           => new sfWidgetFormFilterInput(),
      'cantidadgenericas'         => new sfWidgetFormFilterInput(),
      'cantidadsubespacios'       => new sfWidgetFormFilterInput(),
      'cantidadpreuniversitarias' => new sfWidgetFormFilterInput(),
      'cantidadoptativas'         => new sfWidgetFormFilterInput(),
      'cantidadextracurriculares' => new sfWidgetFormFilterInput(),
      'cantidadseminarios'        => new sfWidgetFormFilterInput(),
      'cantidadidiomas'           => new sfWidgetFormFilterInput(),
      'cantidadtesinas'           => new sfWidgetFormFilterInput(),
      'cantidadtpfinal'           => new sfWidgetFormFilterInput(),
      'fechavigencia'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'vigenciaminima'            => new sfWidgetFormFilterInput(),
      'topecreditocursado'        => new sfWidgetFormFilterInput(),
      'topecreditoregularidades'  => new sfWidgetFormFilterInput(),
      'idtiporesolucion'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposResoluciones'), 'add_empty' => true)),
      'idplananterior'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idtipoplan'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposPlanes'), 'add_empty' => true)),
      'idestadoplan'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadosPlanes'), 'add_empty' => true)),
      'idescalanota'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EscalasNotas'), 'add_empty' => true)),
      'titulo'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechaaprobacion'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'aprobada'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'modalidadalumnolibre'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcarrera'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Carreras'), 'column' => 'idcarrera')),
      'fecha'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechafin'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nombre'                    => new sfValidatorPass(array('required' => false)),
      'version'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'letra'                     => new sfValidatorPass(array('required' => false)),
      'nroresolucion'             => new sfValidatorPass(array('required' => false)),
      'nroresolucionhcd'          => new sfValidatorPass(array('required' => false)),
      'nroresolucioncsu'          => new sfValidatorPass(array('required' => false)),
      'nroresolucionconeau'       => new sfValidatorPass(array('required' => false)),
      'duracionnumerica'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'horastotales'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadmaterias'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadcomunes'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadgenericas'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadsubespacios'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadpreuniversitarias' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadoptativas'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadextracurriculares' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadseminarios'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadidiomas'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadtesinas'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidadtpfinal'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fechavigencia'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'vigenciaminima'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'topecreditocursado'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'topecreditoregularidades'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idtiporesolucion'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposResoluciones'), 'column' => 'idtiporesolucion')),
      'idplananterior'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idtipoplan'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposPlanes'), 'column' => 'idtipoplan')),
      'idestadoplan'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadosPlanes'), 'column' => 'idestadoplan')),
      'idescalanota'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EscalasNotas'), 'column' => 'idescalanota')),
      'titulo'                    => new sfValidatorPass(array('required' => false)),
      'fechaaprobacion'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'aprobada'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'modalidadalumnolibre'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('planes_estudios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PlanesEstudios';
  }

  public function getFields()
  {
    return array(
      'idplanestudio'             => 'Number',
      'idcarrera'                 => 'ForeignKey',
      'fecha'                     => 'Date',
      'fechafin'                  => 'Date',
      'nombre'                    => 'Text',
      'version'                   => 'Number',
      'letra'                     => 'Text',
      'nroresolucion'             => 'Text',
      'nroresolucionhcd'          => 'Text',
      'nroresolucioncsu'          => 'Text',
      'nroresolucionconeau'       => 'Text',
      'duracionnumerica'          => 'Number',
      'horastotales'              => 'Number',
      'cantidadmaterias'          => 'Number',
      'cantidadcomunes'           => 'Number',
      'cantidadgenericas'         => 'Number',
      'cantidadsubespacios'       => 'Number',
      'cantidadpreuniversitarias' => 'Number',
      'cantidadoptativas'         => 'Number',
      'cantidadextracurriculares' => 'Number',
      'cantidadseminarios'        => 'Number',
      'cantidadidiomas'           => 'Number',
      'cantidadtesinas'           => 'Number',
      'cantidadtpfinal'           => 'Number',
      'fechavigencia'             => 'Date',
      'vigenciaminima'            => 'Number',
      'topecreditocursado'        => 'Number',
      'topecreditoregularidades'  => 'Number',
      'idtiporesolucion'          => 'ForeignKey',
      'idplananterior'            => 'Number',
      'idtipoplan'                => 'ForeignKey',
      'idestadoplan'              => 'ForeignKey',
      'idescalanota'              => 'ForeignKey',
      'titulo'                    => 'Text',
      'fechaaprobacion'           => 'Date',
      'aprobada'                  => 'Boolean',
      'modalidadalumnolibre'      => 'Boolean',
      'created_at'                => 'Date',
      'updated_at'                => 'Date',
      'created_by'                => 'ForeignKey',
      'updated_by'                => 'ForeignKey',
    );
  }
}
