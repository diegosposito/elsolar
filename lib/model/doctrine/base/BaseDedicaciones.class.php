<?php

/**
 * BaseDedicaciones
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $iddedicacion
 * @property string $descripcion
 * @property string $rangohorario
 * @property boolean $is_default
 * @property Designaciones $Designaciones
 * 
 * @method integer       getIddedicacion()  Returns the current record's "iddedicacion" value
 * @method string        getDescripcion()   Returns the current record's "descripcion" value
 * @method string        getRangohorario()  Returns the current record's "rangohorario" value
 * @method boolean       getIsDefault()     Returns the current record's "is_default" value
 * @method Designaciones getDesignaciones() Returns the current record's "Designaciones" value
 * @method Dedicaciones  setIddedicacion()  Sets the current record's "iddedicacion" value
 * @method Dedicaciones  setDescripcion()   Sets the current record's "descripcion" value
 * @method Dedicaciones  setRangohorario()  Sets the current record's "rangohorario" value
 * @method Dedicaciones  setIsDefault()     Sets the current record's "is_default" value
 * @method Dedicaciones  setDesignaciones() Sets the current record's "Designaciones" value
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDedicaciones extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dedicaciones');
        $this->hasColumn('iddedicacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('descripcion', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => ' ',
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('rangohorario', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => ' ',
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('is_default', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Designaciones', array(
             'local' => 'iddedicacion',
             'foreign' => 'iddedicacion'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}