<?php

/**
 * AsignacionesClases filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsignacionesClasesFormFilter extends AsignacionesFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['idcomision'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comisiones'), 'add_empty' => true));
    $this->validatorSchema['idcomision'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comisiones'), 'column' => 'idcomision'));

    $this->widgetSchema   ['idtipoclase'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposClases'), 'add_empty' => true));
    $this->validatorSchema['idtipoclase'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TiposClases'), 'column' => 'idtipoclase'));

    $this->widgetSchema   ['periodicidad'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['periodicidad'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('asignaciones_clases_filters[%s]');
  }

  public function getModelName()
  {
    return 'AsignacionesClases';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'idcomision' => 'ForeignKey',
      'idtipoclase' => 'ForeignKey',
      'periodicidad' => 'Text',
    ));
  }
}
