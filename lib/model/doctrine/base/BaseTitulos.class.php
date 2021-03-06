<?php

/**
 * BaseTitulos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idtitulo
 * @property string $nombre
 * @property string $nombrefemenino
 * @property integer $idtipotitulo
 * @property integer $niveltitulo
 * @property date $fechacreacion
 * @property string $nroresolucion
 * @property date $fechacreacionministerial
 * @property string $nroresolucionministerial
 * @property integer $duracion
 * @property integer $tiempotrabajofinal
 * @property string $incumbencias
 * @property boolean $acreditacionconeau
 * @property string $categorizacionconeau
 * @property date $fechabaja
 * @property integer $idestadotitulo
 * @property TiposTitulos $TiposTitulos
 * @property Doctrine_Collection $Titulos
 * 
 * @method integer             getIdtitulo()                 Returns the current record's "idtitulo" value
 * @method string              getNombre()                   Returns the current record's "nombre" value
 * @method string              getNombrefemenino()           Returns the current record's "nombrefemenino" value
 * @method integer             getIdtipotitulo()             Returns the current record's "idtipotitulo" value
 * @method integer             getNiveltitulo()              Returns the current record's "niveltitulo" value
 * @method date                getFechacreacion()            Returns the current record's "fechacreacion" value
 * @method string              getNroresolucion()            Returns the current record's "nroresolucion" value
 * @method date                getFechacreacionministerial() Returns the current record's "fechacreacionministerial" value
 * @method string              getNroresolucionministerial() Returns the current record's "nroresolucionministerial" value
 * @method integer             getDuracion()                 Returns the current record's "duracion" value
 * @method integer             getTiempotrabajofinal()       Returns the current record's "tiempotrabajofinal" value
 * @method string              getIncumbencias()             Returns the current record's "incumbencias" value
 * @method boolean             getAcreditacionconeau()       Returns the current record's "acreditacionconeau" value
 * @method string              getCategorizacionconeau()     Returns the current record's "categorizacionconeau" value
 * @method date                getFechabaja()                Returns the current record's "fechabaja" value
 * @method integer             getIdestadotitulo()           Returns the current record's "idestadotitulo" value
 * @method TiposTitulos        getTiposTitulos()             Returns the current record's "TiposTitulos" value
 * @method Doctrine_Collection getTitulos()                  Returns the current record's "Titulos" collection
 * @method Titulos             setIdtitulo()                 Sets the current record's "idtitulo" value
 * @method Titulos             setNombre()                   Sets the current record's "nombre" value
 * @method Titulos             setNombrefemenino()           Sets the current record's "nombrefemenino" value
 * @method Titulos             setIdtipotitulo()             Sets the current record's "idtipotitulo" value
 * @method Titulos             setNiveltitulo()              Sets the current record's "niveltitulo" value
 * @method Titulos             setFechacreacion()            Sets the current record's "fechacreacion" value
 * @method Titulos             setNroresolucion()            Sets the current record's "nroresolucion" value
 * @method Titulos             setFechacreacionministerial() Sets the current record's "fechacreacionministerial" value
 * @method Titulos             setNroresolucionministerial() Sets the current record's "nroresolucionministerial" value
 * @method Titulos             setDuracion()                 Sets the current record's "duracion" value
 * @method Titulos             setTiempotrabajofinal()       Sets the current record's "tiempotrabajofinal" value
 * @method Titulos             setIncumbencias()             Sets the current record's "incumbencias" value
 * @method Titulos             setAcreditacionconeau()       Sets the current record's "acreditacionconeau" value
 * @method Titulos             setCategorizacionconeau()     Sets the current record's "categorizacionconeau" value
 * @method Titulos             setFechabaja()                Sets the current record's "fechabaja" value
 * @method Titulos             setIdestadotitulo()           Sets the current record's "idestadotitulo" value
 * @method Titulos             setTiposTitulos()             Sets the current record's "TiposTitulos" value
 * @method Titulos             setTitulos()                  Sets the current record's "Titulos" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTitulos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('titulos');
        $this->hasColumn('idtitulo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));
        $this->hasColumn('nombrefemenino', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));
        $this->hasColumn('idtipotitulo', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => '0',
             ));
        $this->hasColumn('niveltitulo', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => '1',
             ));
        $this->hasColumn('fechacreacion', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('nroresolucion', 'string', 15, array(
             'type' => 'string',
             'primary' => false,
             'length' => 15,
             ));
        $this->hasColumn('fechacreacionministerial', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('nroresolucionministerial', 'string', 15, array(
             'type' => 'string',
             'primary' => false,
             'length' => 15,
             ));
        $this->hasColumn('duracion', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             ));
        $this->hasColumn('tiempotrabajofinal', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             ));
        $this->hasColumn('incumbencias', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'sin informacion',
             'length' => 255,
             ));
        $this->hasColumn('acreditacionconeau', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('categorizacionconeau', 'string', 2, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 2,
             ));
        $this->hasColumn('fechabaja', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('idestadotitulo', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => '0',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TiposTitulos', array(
             'local' => 'idtipotitulo',
             'foreign' => 'idtipotitulo'));

        $this->hasMany('TitulosPlanes as Titulos', array(
             'local' => 'idtitulo',
             'foreign' => 'idtitulo'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}