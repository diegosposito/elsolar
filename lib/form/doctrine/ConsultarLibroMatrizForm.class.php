<?php
class ConsultarLibroMatrizForm extends sfForm
{	        
  public function configure()
  {        
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	
  	$libros = Doctrine_Core::getTable('LibrosActas')->findByIdarea($idarea);

  	foreach($libros as $libro){
		$arregloLibros[$libro->getIdlibroacta()] = $libro->getDescripcion();  
	}  	

	// Se define el esquema del form
  	$this->widgetSchema['libro'] = new sfWidgetFormSelect(array('choices' => $arregloLibros));
  	$this->widgetSchema['folio'] = new sfWidgetFormInput();
	
 	// Se define los labels
	$this->widgetSchema->setLabel('libro', '<p align="left">Libro:</p>');
	$this->widgetSchema->setLabel('folio', '<p align="left">Folio:</p>');

 	// Se define los validadores 
	$this->setValidators(array(
		'libro'    => new sfValidatorString(),
		'folio'    => new sfValidatorInteger(array('min' => 1, 'max' => 3))
	)); 
  } 
}