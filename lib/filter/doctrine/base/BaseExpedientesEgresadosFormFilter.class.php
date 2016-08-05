<?php

/**
 * ExpedientesEgresados filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExpedientesEgresadosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtitulo'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titulos'), 'add_empty' => true)),
      'idalumno'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumnos'), 'add_empty' => true)),
      'idsede'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sedes'), 'add_empty' => true)),
      'fechaegreso'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechainformeauditoria'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechasolicitud'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaentregatitulo'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaenviome'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecharecibidome'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'idderivacionbiblioteca'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idderivacionadministracion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'folio'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'otradocumentacion'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'activo'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'registrodiplomame'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'registrome'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'registrocertificadome'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nrorecibo1'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nrorecibo2'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idtitulo'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titulos'), 'column' => 'idtitulo')),
      'idalumno'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Alumnos'), 'column' => 'idalumno')),
      'idsede'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sedes'), 'column' => 'idsede')),
      'fechaegreso'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechainformeauditoria'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechasolicitud'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaentregatitulo'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fechaenviome'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecharecibidome'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idderivacionbiblioteca'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idderivacionadministracion' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'folio'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'otradocumentacion'          => new sfValidatorPass(array('required' => false)),
      'observaciones'              => new sfValidatorPass(array('required' => false)),
      'activo'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'registrodiplomame'          => new sfValidatorPass(array('required' => false)),
      'registrome'                 => new sfValidatorPass(array('required' => false)),
      'registrocertificadome'      => new sfValidatorPass(array('required' => false)),
      'nrorecibo1'                 => new sfValidatorPass(array('required' => false)),
      'nrorecibo2'                 => new sfValidatorPass(array('required' => false)),
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('expedientes_egresados_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpedientesEgresados';
  }

  public function getFields()
  {
    return array(
      'idexpediente'               => 'Number',
      'idtitulo'                   => 'ForeignKey',
      'idalumno'                   => 'ForeignKey',
      'idsede'                     => 'ForeignKey',
      'fechaegreso'                => 'Date',
      'fechainformeauditoria'      => 'Date',
      'fechasolicitud'             => 'Date',
      'fechaentregatitulo'         => 'Date',
      'fechaenviome'               => 'Date',
      'fecharecibidome'            => 'Date',
      'idderivacionbiblioteca'     => 'Number',
      'idderivacionadministracion' => 'Number',
      'folio'                      => 'Number',
      'otradocumentacion'          => 'Text',
      'observaciones'              => 'Text',
      'activo'                     => 'Number',
      'registrodiplomame'          => 'Text',
      'registrome'                 => 'Text',
      'registrocertificadome'      => 'Text',
      'nrorecibo1'                 => 'Text',
      'nrorecibo2'                 => 'Text',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'created_by'                 => 'ForeignKey',
      'updated_by'                 => 'ForeignKey',
    );
  }
}
