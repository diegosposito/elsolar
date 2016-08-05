<?php

/**
 * TiposAulas form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TiposAulasForm extends BaseTiposAulasForm
{
  public function configure()
  {
  	unset( $this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']); 
  	
  	$this->widgetSchema->setLabel('descripcion', '<p align="left"><b>Descripción:</b></p>');
  	$this->widgetSchema->setLabel('descripcionreducido', '<p align="left"><b>Descripción reducida:</b></p>');    	
  }
}
