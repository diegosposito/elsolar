<?php

/**
 * Personas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PersonasForm extends BasePersonasForm
{
  public function configure()
  {

        unset( $this['cantgrupofamiliar'],$this['titulo'],$this['idprofesion'],$this['vive'],$this['created_at'], $this['updated_at'], $this['nrolector'], $this['tienefoto'], $this['created_by'], $this['updated_by'] ,$this['nrodoc'] ,$this['fechanac'],$this['fechaingreso'] ,$this['idciudadnac'],$this['idnacionalidad'],$this['estadocivil']         );
     
        $years = range(date('Y') - 70, date('Y'));
    /*    $this->widgetSchema['fechanac'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => array_combine($years, $years))) 
        ));
        $this->widgetSchema['fechaingreso'] = new sfWidgetFormJQueryDate(array(
            'config' => '{}',
            'image'=>'/images/calendar.gif',
            'culture' => substr(sfContext::getInstance()->getUser()->getCulture(), 0, 2),
            'config' => "{firstDay: 1, dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']}", 
            'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')) 
        ));*/
        
         // Se define los labels
	    $this->widgetSchema->setLabel('nombre', '<p align="left">Nombre:</p>');
 	    $this->widgetSchema->setLabel('apellido', '<p align="left">Apellido:</p>');
      $this->widgetSchema->setLabel('idsexo', '<p align="left">Sexo:</p>');
 	    $this->widgetSchema->setLabel('idtipodoc', '<p align="left">Tipo Documento:</p>');
      $this->widgetSchema->setLabel('numerodoc', '<p align="left">Numero Doc:</p>');
      $this->widgetSchema->setLabel('direccion', '<p align="left">Dirección:</p>');
      $this->widgetSchema->setLabel('email', '<p align="left">Email:</p>');
      $this->widgetSchema->setLabel('telefono', '<p align="left">Teléfono:</p>');
      $this->widgetSchema->setLabel('celular', '<p align="left">Celular:</p>');
      $this->widgetSchema->setLabel('activo', '<p align="left">Activo:</p>');
      $this->widgetSchema->setLabel('otrainformacionrelevante', '<p align="left">Observaciones:</p>');
      

   
	 }

 

    public function checkDni($validator, $values)
    {
      // no debe estar vacio el campo numerodoc
      if(empty($values['numerodoc']) )
      {
        // nrodoc incorrecto
        throw new sfValidatorError($validator, 'Numero de documento invalido');
      } else {

		$nrodoc = preg_replace("/[^\d]/", "", $values['numerodoc']);
		//$values['idtipodoc']
		$oTipoDocumento = Doctrine_Core::getTable('TiposDocumentos')->find(1);        
		$this->formato = $oTipoDocumento->getFormato();  

   		if (preg_match($this->formato, $values['numerodoc'])) {

		    // CONTROLAR QUE EL NRODOC NO EXISTA PREVIAMENTE
		    //===================================================
		    $oPersona = Doctrine_Core::getTable('Personas')->buscarPersona($values['idtipodoc'],$nrodoc);
			if($oPersona) throw new sfValidatorError($validator, 'La persona ya esta en la base , se encontro el DNI.');

		} else {
			throw new sfValidatorError($validator, 'Formato de documento incorrecto');
		}

	}
 
      // nrodocincorrecto
      return $values;
    }

}
