<?php

/**
 * InscripcionesCursada form base class.
 *
 * @method InscripcionesCursada getObject() Returns the current form's model object
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesCursadaForm extends InscripcionesForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('inscripciones_cursada[%s]');
  }

  public function getModelName()
  {
    return 'InscripcionesCursada';
  }

}
