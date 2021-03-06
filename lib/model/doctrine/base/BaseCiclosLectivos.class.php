<?php

/**
 * BaseCiclosLectivos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ciclo
 * @property date $inicio
 * @property date $fin
 * @property boolean $activo
 * @property Doctrine_Collection $CiclosLectivos
 * @property Doctrine_Collection $InscripcionesCicloLectivo
 * 
 * @method string              getCiclo()                     Returns the current record's "ciclo" value
 * @method date                getInicio()                    Returns the current record's "inicio" value
 * @method date                getFin()                       Returns the current record's "fin" value
 * @method boolean             getActivo()                    Returns the current record's "activo" value
 * @method Doctrine_Collection getCiclosLectivos()            Returns the current record's "CiclosLectivos" collection
 * @method Doctrine_Collection getInscripcionesCicloLectivo() Returns the current record's "InscripcionesCicloLectivo" collection
 * @method CiclosLectivos      setCiclo()                     Sets the current record's "ciclo" value
 * @method CiclosLectivos      setInicio()                    Sets the current record's "inicio" value
 * @method CiclosLectivos      setFin()                       Sets the current record's "fin" value
 * @method CiclosLectivos      setActivo()                    Sets the current record's "activo" value
 * @method CiclosLectivos      setCiclosLectivos()            Sets the current record's "CiclosLectivos" collection
 * @method CiclosLectivos      setInscripcionesCicloLectivo() Sets the current record's "InscripcionesCicloLectivo" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCiclosLectivos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ciclos_lectivos');
        $this->hasColumn('ciclo', 'string', 60, array(
             'type' => 'string',
             'length' => 60,
             ));
        $this->hasColumn('inicio', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('fin', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Alumnos as CiclosLectivos', array(
             'local' => 'id',
             'foreign' => 'idciclolectivo'));

        $this->hasMany('InscripcionesCicloLectivo', array(
             'local' => 'id',
             'foreign' => 'idciclolectivo'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}