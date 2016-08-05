<?php

/**
 * InscripcionesExamen filter form base class.
 *
 * @package    sig
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInscripcionesExamenFormFilter extends InscripcionesFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('inscripciones_examen_filters[%s]');
  }

  public function getModelName()
  {
    return 'InscripcionesExamen';
  }
}
