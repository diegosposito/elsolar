<?php

/**
 * Pacientes form.
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

      unset( $this['created_at'], $this['vive'],$this['otrainformacionrelevante'],$this['monto'],$this['idusuario'],$this['horarios'],$this['titulo'],$this['socio'],$this['nrolector'],$this['mostrarinfocontacto'],$this['tienefoto'],$this['idciudadnac'],$this['idprovincia'],$this['cantgrupofamiliar'],$this['idprofesion'],$this['idnacionalidad'],$this['idtipodoc'],$this['numerodoc'],$this['updated_at'], $this['created_by'], $this['updated_by'] );

      // Se define los labels
      $this->widgetSchema->setLabel('nombre', '<p align="left">Nombre:</p>');
      $this->widgetSchema->setLabel('apellido', '<p align="left">Apellido:</p>');
      $this->widgetSchema->setLabel('idpersona', '<p align="left">Nro. Afiliado:</p>');
      $this->widgetSchema->setLabel('nrodoc', '<p align="left">Documento:</p>');
      $this->widgetSchema->setLabel('idsexo', '<p align="left">Sexo:</p>');
      $this->widgetSchema->setLabel('idarea', '<p align="left">Area:</p>');
      $this->widgetSchema->setLabel('estadocivil', '<p align="left">E. Civil:</p>');
      $this->widgetSchema->setLabel('fechanac', '<p align="left">Fec. Nacimiento:</p>');
      $this->widgetSchema->setLabel('fechaingreso', '<p align="left">Fec. Ing.:</p>');
      $this->widgetSchema->setLabel('direccion', '<p align="left">Dirección:</p>');


      $this->widgetSchema->setLabel('ciudad', '<p align="left">Ciudad:</p>');
      $this->widgetSchema->setLabel('email', '<p align="left">Email:</p>');
      $this->widgetSchema->setLabel('celular', '<p align="left">Celular:</p>');
      $this->widgetSchema->setLabel('telefono', '<p align="left">Teléfono:</p>');
      $this->widgetSchema->setLabel('activo', '<p align="left">Activo:</p>');
     
      $this->widgetSchema['imagefile'] = new sfWidgetFormInputFile(array(
                                               'label' => 'Archivo',
                                             ));
      $this->widgetSchema->setLabel('imagefile', '<p align="left">Foto:</p>');

     $this->widgetSchema['credencial'] = new sfWidgetFormInputFile(array(
                                               'label' => 'Archivo',
                                             ));
      $this->widgetSchema->setLabel('credencial', '<p align="left">Foto:</p>');

      /* oss = Doctrine_Core::getTable('ObrasSociales')->obtenerTodas();
      foreach($oss as $os){
        $arregloOS[$os->getIdObrasocial()] = $os->getAbreviada(); 
      }  
        
      $this->widgetSchema['idobrasocial'] = new sfWidgetFormSelect(array('choices' => $arregloOS));
      $this->widgetSchema->setLabel('idobrasocial', '<p align="left">O. Social:</p>'); */
     
   
      $this->widgetSchema->setLabel('credencial', '<p align="left">Credencial:</p>');
         
      $range  = range(date('Y')-80, date('Y')+1);
      $years = array_combine($range,$range);

      $this->widgetSchema['direccion'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('direccion', '<p align="left">Dirección:</p>');
      
      $this->widgetSchema['fechanac'] =
      new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));
      $this->widgetSchema['fechaingreso'] =
      new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));     

      $this->widgetSchema->setLabel('fechanac', '<p align="left">Fec. Nac.:</p>');
      $this->widgetSchema->setLabel('fechaingreso', '<p align="left">Fec. Ing.:</p>');
            
      
  }
}
