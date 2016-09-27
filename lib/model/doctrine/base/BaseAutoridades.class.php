<?php

/**
 * BaseAutoridades
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idautoridad
 * @property string $nombre
 * @property integer $idcargoautoridad
 * @property CargoAutoridades $CargoAutoridades
 * 
 * @method integer          getIdautoridad()      Returns the current record's "idautoridad" value
 * @method string           getNombre()           Returns the current record's "nombre" value
 * @method integer          getIdcargoautoridad() Returns the current record's "idcargoautoridad" value
 * @method CargoAutoridades getCargoAutoridades() Returns the current record's "CargoAutoridades" value
 * @method Autoridades      setIdautoridad()      Sets the current record's "idautoridad" value
 * @method Autoridades      setNombre()           Sets the current record's "nombre" value
 * @method Autoridades      setIdcargoautoridad() Sets the current record's "idcargoautoridad" value
 * @method Autoridades      setCargoAutoridades() Sets the current record's "CargoAutoridades" value
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAutoridades extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('autoridades');
        $this->hasColumn('idautoridad', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nombre', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('idcargoautoridad', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => '0',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CargoAutoridades', array(
             'local' => 'idcargoautoridad',
             'foreign' => 'idcargoautoridad'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}