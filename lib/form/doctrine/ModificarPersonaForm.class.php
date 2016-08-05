<?php
class ModificarPersonaForm extends sfForm
{
	        
  public function configure()
  {         
	$arregloSexo = array(1 => 'Masculino', 2 => 'Femenino');
	$arregloEstadosCiviles = array(1 => 'Soltero', 2 =>'Casado', 3 =>'Otros');
  	$arregloSiNo = array(1 => 'No', 2 => 'Si');
	$arregloDedicacion = array(1 => 'Menos de 10 hs.', 2 => '10-20 hs.', 3 => '21-30 hs.', 4 => 'Más de 30 hs.');

	// Se define el esquema del form
  	
	// INFORMACION PERSONAL
	$this->widgetSchema['idpersona'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['idalumno'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['nombre'] = new sfWidgetFormInput(array('label' => '<p align="left">Nombre:</p>'), array('size' => '20','disabled' =>'disabled'));
	$this->widgetSchema['apellido'] = new sfWidgetFormInput(array('label' => '<p align="left">Apellido:</p>'), array('size' => '20','disabled' =>'disabled'));	
	$this->widgetSchema['idsexo'] = new sfWidgetFormChoice(array('label' => '<p align="left">Sexo:</p>', 'choices' => $arregloSexo, 'expanded' => true, 'default' => 1));
  	$this->widgetSchema['estadocivil'] = new sfWidgetFormSelect(array('label' => '<p align="left">Estado Civil:</p>', 'choices' => $arregloEstadosCiviles));
	$this->widgetSchema['paisnacimiento'] = new sfWidgetFormInput(array('label' => '<p align="left">País:</p>'), array('size' => '30','disabled' =>'disabled'));
	$this->widgetSchema['provincianacimiento'] = new sfWidgetFormInput(array('label' => '<p align="left">Provincia:</p>'), array('size' => '30','disabled' =>'disabled'));
	$this->widgetSchema['ciudadnacimiento'] = new sfWidgetFormInput(array('label' => '<p align="left">Ciudad:</p>'), array('size' => '30','disabled' =>'disabled'));
	$this->widgetSchema['fechanacimiento'] = new sfWidgetFormInput(array('label' => '<p align="left">Fecha de Nacimiento:</p>'), array('size' =>'9','disabled' =>'disabled'));	
		
	$this->widgetSchema['tipodocumento'] = new sfWidgetFormInput(array('label' => '<p align="left">Tipo Documento:</p>'), array('size' =>'7','disabled' =>'disabled'));
	$this->widgetSchema['nrodocumento'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro. Documento:</p>'), array('size' =>'10','disabled' =>'disabled'));
	
	// RESIDENCIA ESTABLE
	$this->widgetSchema['nombrecalleE'] = new sfWidgetFormInput(array('label' => '<p align="left">Calle:</p>'), array('size' =>'30'));
	$this->widgetSchema['nrocalleE'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro.:</p>'), array('size' =>'5'));
	$this->widgetSchema['barrioE'] = new sfWidgetFormInput(array('label' => '<p align="left">Barrio:</p>'), array('size' =>'10'));
	$this->widgetSchema['edificioE'] = new sfWidgetFormInput(array('label' => '<p align="left">Edificio:</p>'), array('size' =>'10'));
	$this->widgetSchema['pisoE'] = new sfWidgetFormInput(array('label' => '<p align="left">Piso:</p>'), array('size' =>'5'));
	$this->widgetSchema['deptoE'] = new sfWidgetFormInput(array('label' => '<p align="left">Depto.:</p>'), array('size' =>'5'));
	
	$this->widgetSchema['paisresidenciaE'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left">País:</p>', 	
		'expanded' => false,
		'multiple' => false,
		'model' => 'Paises',
		'add_empty' => false
	));
	$this->widgetSchema['provinciaresidenciaE'] = new sfWidgetFormSelect(array('label' => '<p align="left">Provincia:</p>', 'choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['ciudadresidenciaE'] = new sfWidgetFormSelect(array('label' => '<p align="left">Ciudad:</p>', 'choices' => array(0 => '----Seleccione----')));

	// RESIDENCIA TRANSITORIA
	$this->widgetSchema['nombrecalleT'] = new sfWidgetFormInput(array('label' => '<p align="left">Calle:</p>'), array('size' =>'30'));
	$this->widgetSchema['nrocalleT'] = new sfWidgetFormInput(array('label' => '<p align="left">Nro.:</p>'), array('size' =>'5'));
	$this->widgetSchema['barrioT'] = new sfWidgetFormInput(array('label' => '<p align="left">Barrio:</p>'), array('size' =>'10'));
	$this->widgetSchema['edificioT'] = new sfWidgetFormInput(array('label' => '<p align="left">Edificio:</p>'), array('size' =>'10'));
	$this->widgetSchema['pisoT'] = new sfWidgetFormInput(array('label' => '<p align="left">Piso:</p>'), array('size' =>'5'));
	$this->widgetSchema['deptoT'] = new sfWidgetFormInput(array('label' => '<p align="left">Depto.:</p>'), array('size' =>'5'));
	
	$this->widgetSchema['paisresidenciaT'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left">País:</p>', 	
		'expanded' => false,
		'multiple' => false,
		'model' => 'Paises',
		'add_empty' => false
	));
	$this->widgetSchema['provinciaresidenciaT'] = new sfWidgetFormSelect(array('label' => '<p align="left">Provincia:</p>', 'choices' => array(0 => '----Seleccione----')));
	$this->widgetSchema['ciudadresidenciaT'] = new sfWidgetFormSelect(array('label' => '<p align="left">Ciudad:</p>', 'choices' => array(0 => '----Seleccione----')));

	// OTROS MEDIOS DE CONTACTO
	$this->widgetSchema['areatelefonofijo'] = new sfWidgetFormInput(array('label' => '<p align="left">Teléfono:</p>'), array('size' =>'5'));
	$this->widgetSchema['nrotelefonofijo'] = new sfWidgetFormInput(array('label' => '<p align="left">Teléfono:</p>'), array('size' =>'10'));
	$this->widgetSchema['areatelefonomovil'] = new sfWidgetFormInput(array('label' => '<p align="left">Teléfono:</p>'), array('size' =>'5'));
	$this->widgetSchema['nrotelefonomovil'] = new sfWidgetFormInput(array('label' => '<p align="left">Celular:</p>'), array('size' =>'10'));
	$this->widgetSchema['email'] = new sfWidgetFormInput(array('label' => '<p align="left">E-mail:</p>'), array('size' =>'40'));
	$this->widgetSchema['email1'] = new sfWidgetFormInput(array('label' => '<p align="left">E-mail1:</p>'), array('size' =>'40'));

	// DATOS OCUPACIONALES
	$this->widgetSchema['iddoclaboral'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['trabaja'] = new sfWidgetFormChoice(array('label' => '<p align="left">¿Trabaja?:</p>', 'choices' => $arregloSiNo, 'expanded' => true, 'default' => 1));
	$this->widgetSchema['profesion'] = new sfWidgetFormDoctrineChoice(array(
		'label' => '<p align="left">Ocupación:</p>', 	
		'expanded' => false,
		'multiple' => false,
		'model' => 'Profesiones',
		'order_by' => array('descripcion', 'asc'),
		'add_empty' => false
	));	
	$this->widgetSchema['dedicacion'] = new sfWidgetFormSelect(array('label' => '<p align="left">Dedicación horaria semanal aproximada:</p>', 'choices' => $arregloDedicacion));
	//$this->widgetSchema['dedicacion'] = new sfWidgetFormInput(array('label' => '<p align="left">Dedicación en hs. semanales:</p>'), array('size' =>'2'));
	$this->widgetSchema['lugar'] = new sfWidgetFormInput(array('label' => '<p align="left">Lugar de Trabajo:</p>'), array('size' =>'15'));
	$this->widgetSchema['certificado'] = new sfWidgetFormChoice(array('label' => '<p align="left">Certificado Laboral:</p>', 'choices' => $arregloSiNo, 'expanded' => true, 'default' => 1));	
  }
}
