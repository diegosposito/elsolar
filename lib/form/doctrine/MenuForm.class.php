<?php

/**
 * Menu form.
 *
 * @package    sig
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MenuForm extends BaseMenuForm
{
  public function configure()
  {

        unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']           );
  }
}
