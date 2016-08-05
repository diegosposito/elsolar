<?php

/**
 * AsignacionesMesas form base class.
 *
 * @method AsignacionesMesas getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignacionesMesasForm extends AsignacionesForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['idmesaexamen'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesasExamenes'), 'add_empty' => false));
    $this->validatorSchema['idmesaexamen'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesasExamenes'), 'required' => false));

    $this->widgetSchema->setNameFormat('asignaciones_mesas[%s]');
  }

  public function getModelName()
  {
    return 'AsignacionesMesas';
  }

}
