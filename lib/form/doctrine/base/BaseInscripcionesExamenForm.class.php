<?php

/**
 * InscripcionesExamen form base class.
 *
 * @method InscripcionesExamen getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesExamenForm extends InscripcionesForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('inscripciones_examen[%s]');
  }

  public function getModelName()
  {
    return 'InscripcionesExamen';
  }

}
