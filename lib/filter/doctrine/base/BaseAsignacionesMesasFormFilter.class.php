<?php

/**
 * AsignacionesMesas filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsignacionesMesasFormFilter extends AsignacionesFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['idmesaexamen'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesasExamenes'), 'add_empty' => true));
    $this->validatorSchema['idmesaexamen'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MesasExamenes'), 'column' => 'idmesaexamen'));

    $this->widgetSchema->setNameFormat('asignaciones_mesas_filters[%s]');
  }

  public function getModelName()
  {
    return 'AsignacionesMesas';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'idmesaexamen' => 'ForeignKey',
    ));
  }
}
