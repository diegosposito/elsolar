<?php
class BuscarProfesoresForm extends sfForm
{
  protected static $tiposcriterios = array(1 => "Apellido", 2 => "Nro. Documento");
          
  public function configure()
  {        
    
    // Se define el esquema del form
    $this->widgetSchema['tipocriterio'] = new sfWidgetFormSelect(array('choices' => self::$tiposcriterios));
    $this->widgetSchema['criterio'] = new sfWidgetFormInput();
    $this->widgetSchema['referer'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['url'] = new sfWidgetFormInputHidden(); 
    $this->widgetSchema['titulo'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['tipo'] = new sfWidgetFormInputHidden();
  
    // Se define los labels
    $this->widgetSchema->setLabel('tipocriterio', '<p align="left">Buscar en:</p>');
    $this->widgetSchema->setLabel('criterio', '<p align="left"></p>');

    // Se define los validadores 
    $this->setValidators(array(
      'tipocriterio'    => new sfValidatorString(), 
      'criterio'    => new sfValidatorString(array('required' => false)),
      'url' => new sfValidatorString(array('required' => false)),
      'referer' => new sfValidatorString(array('required' => false)),
    ));
 
    $this->widgetSchema->setNameFormat('buscar[%s]');
  
    $this->validatorSchema->setOption('allow_extra_fields',true);   
  }
}
