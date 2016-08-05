<?php

/**
 * TiposFechasCalendario form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TiposFechasCalendarioForm extends BaseTiposFechasCalendarioForm
{
  public function configure()
  {
  	// remove unwanted fields
	unset($this['updated_at'], $this['created_at'], $this['updated_by'], $this['created_by']);  	
  }
}
