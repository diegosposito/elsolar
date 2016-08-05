<?php
class ImprimirDesignacionesForm extends sfForm
{  
  public function configure()
  {
  	 $this->widgetSchema['fechaemision'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));
        $this->widgetSchema['fechacsu'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));
        $this->widgetSchema['fechadesde'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => sfContext::getInstance()->getUser()->getCulture(),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));
        $this->widgetSchema['fechahasta'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => sfContext::getInstance()->getUser()->getCulture(),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));
	    
  // Se define los labels
     $this->widgetSchema->setLabel('fechaemision', '<p align="left">Fecha Emision:</p>');
     $this->widgetSchema->setLabel('fechacsu', '<p align="left">Fecha C.S.U.:</p>');
     $this->widgetSchema->setLabel('fechadesde', '<p align="left">Fecha Desde:</p>');
     $this->widgetSchema->setLabel('fechahasta', '<p align="left">Fecha Hasta:</p>');
 	   
  }

}
