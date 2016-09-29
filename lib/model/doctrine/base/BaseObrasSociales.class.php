<?php

/**
 * BaseObrasSociales
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idobrasocial
 * @property string $denominacion
 * @property string $abreviada
 * @property integer $estado
 * @property integer $ninterno
 * @property boolean $general
 * @property boolean $protesis
 * @property boolean $ortodoncia
 * @property boolean $implantes
 * @property date $fechaarancel
 * @property date $fechaultimoperiodo
 * @property string $fechaaranceltexto
 * @property string $fechaultimoperiodotexto
 * 
 * @method integer       getIdobrasocial()            Returns the current record's "idobrasocial" value
 * @method string        getDenominacion()            Returns the current record's "denominacion" value
 * @method string        getAbreviada()               Returns the current record's "abreviada" value
 * @method integer       getEstado()                  Returns the current record's "estado" value
 * @method integer       getNinterno()                Returns the current record's "ninterno" value
 * @method boolean       getGeneral()                 Returns the current record's "general" value
 * @method boolean       getProtesis()                Returns the current record's "protesis" value
 * @method boolean       getOrtodoncia()              Returns the current record's "ortodoncia" value
 * @method boolean       getImplantes()               Returns the current record's "implantes" value
 * @method date          getFechaarancel()            Returns the current record's "fechaarancel" value
 * @method date          getFechaultimoperiodo()      Returns the current record's "fechaultimoperiodo" value
 * @method string        getFechaaranceltexto()       Returns the current record's "fechaaranceltexto" value
 * @method string        getFechaultimoperiodotexto() Returns the current record's "fechaultimoperiodotexto" value
 * @method ObrasSociales setIdobrasocial()            Sets the current record's "idobrasocial" value
 * @method ObrasSociales setDenominacion()            Sets the current record's "denominacion" value
 * @method ObrasSociales setAbreviada()               Sets the current record's "abreviada" value
 * @method ObrasSociales setEstado()                  Sets the current record's "estado" value
 * @method ObrasSociales setNinterno()                Sets the current record's "ninterno" value
 * @method ObrasSociales setGeneral()                 Sets the current record's "general" value
 * @method ObrasSociales setProtesis()                Sets the current record's "protesis" value
 * @method ObrasSociales setOrtodoncia()              Sets the current record's "ortodoncia" value
 * @method ObrasSociales setImplantes()               Sets the current record's "implantes" value
 * @method ObrasSociales setFechaarancel()            Sets the current record's "fechaarancel" value
 * @method ObrasSociales setFechaultimoperiodo()      Sets the current record's "fechaultimoperiodo" value
 * @method ObrasSociales setFechaaranceltexto()       Sets the current record's "fechaaranceltexto" value
 * @method ObrasSociales setFechaultimoperiodotexto() Sets the current record's "fechaultimoperiodotexto" value
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseObrasSociales extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('obras_sociales');
        $this->hasColumn('idobrasocial', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('denominacion', 'string', 200, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 200,
             ));
        $this->hasColumn('abreviada', 'string', 120, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 120,
             ));
        $this->hasColumn('estado', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ninterno', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('general', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('protesis', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('ortodoncia', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('implantes', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('fechaarancel', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('fechaultimoperiodo', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('fechaaranceltexto', 'string', 120, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => ' ',
             'autoincrement' => false,
             'length' => 120,
             ));
        $this->hasColumn('fechaultimoperiodotexto', 'string', 120, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => ' ',
             'autoincrement' => false,
             'length' => 120,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}