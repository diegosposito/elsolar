<?php

/**
 * Paciente form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PacienteForm extends BasePacienteForm
{
  public function configure()
  {

  	    unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'] );

  	    // Se define los labels
	    $this->widgetSchema->setLabel('nombre', '<p align="left">Nombre:</p>');
 	    $this->widgetSchema->setLabel('apellido', '<p align="left">Apellido:</p>');
        $this->widgetSchema->setLabel('nroafiliado', '<p align="left">Nro. Afiliado:</p>');
 	    $this->widgetSchema->setLabel('nrodoc', '<p align="left">Documento:</p>');
        $this->widgetSchema->setLabel('idsexo', '<p align="left">Sexo:</p>');
        $this->widgetSchema->setLabel('estadocivil', '<p align="left">E. Civil:</p>');
        $this->widgetSchema->setLabel('fechanac', '<p align="left">Fec. Nacimiento:</p>');
        $this->widgetSchema->setLabel('fechaingreso', '<p align="left">Fec. Ingreso:</p>');
        $this->widgetSchema->setLabel('direccion', '<p align="left">Domicilio:</p>');
    //  $this->widgetSchema->setLabel('idtipoiva', '<p align="left">IVA:</p>');

        $this->widgetSchema->setLabel('idprovincia', '<p align="left">Provincia:</p>');
        $this->widgetSchema->setLabel('idciudadnac', '<p align="left">Ciudad:</p>');
 	    $this->widgetSchema->setLabel('email', '<p align="left">Email:</p>');
        $this->widgetSchema->setLabel('celular', '<p align="left">Celular:</p>');
 	    $this->widgetSchema->setLabel('telefono', '<p align="left">Teléfono:</p>');
        $this->widgetSchema->setLabel('titular', '<p align="left">Titular:</p>');
        $this->widgetSchema->setLabel('parentesco', '<p align="left">Parentesco:</p>');
        $this->widgetSchema->setLabel('ocupacion', '<p align="left">Ocupación:</p>');
        $this->widgetSchema->setLabel('diagnostico', '<p align="left">Diagnóstico:</p>');
        $this->widgetSchema->setLabel('siglas', '<p align="left">Siglas:</p>');
      //  $this->widgetSchema->setLabel('idplan', '<p align="left">Plan:</p>');
        $this->widgetSchema->setLabel('trabajo', '<p align="left">Trabajo:</p>');
        $this->widgetSchema->setLabel('jerarquia', '<p align="left">Jerarquía:</p>');
        $this->widgetSchema->setLabel('anotaciones', '<p align="left">Anotaciones:</p>');
        $this->widgetSchema->setLabel('activo', '<p align="left">Activo:</p>');
        $this->widgetSchema->setLabel('historial', '<p align="left">Observaciones:</p>');

      $this->widgetSchema['imagefile'] = new sfWidgetFormInputFile(array(
                                               'label' => 'Archivo',
                                             ));
      $this->widgetSchema->setLabel('imagefile', '<p align="left">Foto:</p>');

     $this->widgetSchema['credencial'] = new sfWidgetFormInputFile(array(
                                               'label' => 'Archivo',
                                             ));
      $this->widgetSchema->setLabel('credencial', '<p align="left">Foto:</p>');

      $oss = Doctrine_Core::getTable('ObrasSociales')->obtenerTodas();
      foreach($oss as $os){
        $arregloOS[$os->getIdObrasocial()] = $os->getAbreviada();
      }

      $this->widgetSchema['idobrasocial'] = new sfWidgetFormSelect(array('choices' => $arregloOS));
      $this->widgetSchema->setLabel('idobrasocial', '<p align="left">O. Social:</p>');

      $arregloTitular = array('1' => 'Si', '2' => 'No');
      $arregloParentesco = array('1' => 'Titular', '2' => 'Esposo/a', '3' => 'Hijo/a', '4' => 'Hermano/a', '5' => 'Padre/Madre');
      $arregloTipoiva = array('1' => 'No Grabado', '2' => 'Grabado');

      $this->widgetSchema['titular'] = new sfWidgetFormSelect(array('choices' => $arregloTitular));
      $this->widgetSchema->setLabel('titular', '<p align="left">Titular:</p>');

      $this->widgetSchema['parentesco'] = new sfWidgetFormSelect(array('choices' => $arregloParentesco));
      $this->widgetSchema->setLabel('parentesco', '<p align="left">Parentesco:</p>');

      //$this->widgetSchema['idtipoiva'] = new sfWidgetFormSelect(array('choices' => $arregloTipoiva));
      //$this->widgetSchema->setLabel('idtipoiva', '<p align="left">IVA:</p>');


      $this->widgetSchema->setLabel('credencial', '<p align="left">Credencial:</p>');

      $range  = range(date('Y')-80, date('Y')+1);
		  $years = array_combine($range,$range);

      $this->widgetSchema['direccion'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('direccion', '<p align="left">Domicilio:</p>');
      /* $this->widgetSchema['titular'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('titular', '<p align="left">Titular:</p>');
      $this->widgetSchema['parentesco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;')); */
      $this->widgetSchema->setLabel('parentesco', '<p align="left">Parentesco:</p>');
      $this->widgetSchema['ocupacion'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('ocupacion', '<p align="left">Ocupación:</p>');

      //$this->widgetSchema['diagnostico'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('diagnostico', '<p align="left">Diagnóstico:</p>');

		  $this->widgetSchema['fechanac'] =
		  new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));
		  $this->widgetSchema['fechaingreso'] =
		  new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));

		  $this->widgetSchema->setLabel('fechanac', '<p align="left">Fec. Nac.:</p>');
      $this->widgetSchema->setLabel('fechaingreso', '<p align="left">Fec. Ingreso:</p>');

      $this->widgetSchema['mamnombre'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('mamnombre', '<p align="left">Apellido-Nombre/Apoderado:</p>');

      $this->widgetSchema['mamfechanac'] =
      new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));
      $this->widgetSchema->setLabel('mamfechanac', '<p align="left">Fec. Nac.:</p>');

      $this->widgetSchema['mamnrodoc'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('mamnrodoc', '<p align="left">Documento:</p>');

      $this->widgetSchema['mamnacionalidad'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('mamnacionalidad', '<p align="left">Nacionalidad:</p>');

    //  $this->widgetSchema['mamestudios'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('mamestudios', '<p align="left">Estudios / Ocupación:</p>');

      $this->widgetSchema['mamdireccion'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('mamdireccion', '<p align="left">Domicilio:</p>');

      $this->widgetSchema['papnombre'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('papnombre', '<p align="left">Apellido-Nombre/Familiar:</p>');

      $this->widgetSchema['papfechanac'] =
      new sfWidgetFormDate(array('format' => '%day%/%month%/%year%','years' => $years));
      $this->widgetSchema->setLabel('papfechanac', '<p align="left">Fec. Nac.:</p>');

      $this->widgetSchema['papnrodoc'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('papnrodoc', '<p align="left">Documento:</p>');

      $this->widgetSchema['papnacionalidad'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('papnacionalidad', '<p align="left">Nacionalidad:</p>');

      //$this->widgetSchema['papestudios'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('papestudios', '<p align="left">Estudios / Ocupación:</p>');

      $this->widgetSchema['papdireccion'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
      $this->widgetSchema->setLabel('papdireccion', '<p align="left">Domicilio:</p>');


  }
}
