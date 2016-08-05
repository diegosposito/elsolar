<?php

/**
 * AsignacionesClases form base class.
 *
 * @method AsignacionesClases getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignacionesClasesForm extends AsignacionesForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['idcomision'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comisiones'), 'add_empty' => false));
    $this->validatorSchema['idcomision'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comisiones'), 'required' => false));

    $this->widgetSchema   ['idtipoclase'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TiposClases'), 'add_empty' => false));
    $this->validatorSchema['idtipoclase'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TiposClases'), 'required' => false));

    $this->widgetSchema   ['periodicidad'] = new sfWidgetFormInputText();
    $this->validatorSchema['periodicidad'] = new sfValidatorString(array('max_length' => 1, 'required' => false));

    $this->widgetSchema->setNameFormat('asignaciones_clases[%s]');
  }

  public function getModelName()
  {
    return 'AsignacionesClases';
  }

}
