<?php

/**
 * BaseGrupomenu
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $descripcion
 * @property integer $orden
 * @property Doctrine_Collection $Menu
 * 
 * @method string              getDescripcion() Returns the current record's "descripcion" value
 * @method integer             getOrden()       Returns the current record's "orden" value
 * @method Doctrine_Collection getMenu()        Returns the current record's "Menu" collection
 * @method Grupomenu           setDescripcion() Sets the current record's "descripcion" value
 * @method Grupomenu           setOrden()       Sets the current record's "orden" value
 * @method Grupomenu           setMenu()        Sets the current record's "Menu" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGrupomenu extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('grupomenu');
        $this->hasColumn('descripcion', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('orden', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Menu', array(
             'local' => 'id',
             'foreign' => 'idgrupomenu'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}