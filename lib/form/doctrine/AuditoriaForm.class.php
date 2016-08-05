<?php

/**
 * Auditoria form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AuditoriaForm extends BaseAuditoriaForm
{
  public function configure()
  {
        unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );


        $years = range(date('Y') - 70, date('Y'));
        $this->widgetSchema['fechaactividad'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => array_combine($years, $years))) 
        ));
        $this->widgetSchema['proximafecha'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => array_combine($years, $years))) 
        ));
  }
}