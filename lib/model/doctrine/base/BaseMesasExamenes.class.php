<?php

/**
 * BaseMesasExamenes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idmesaexamen
 * @property integer $idcatedra
 * @property integer $idmateria
 * @property integer $idcondicion
 * @property integer $idtipoexamen
 * @property integer $idlibroacta
 * @property integer $idllamado
 * @property date $fecha
 * @property string $hora
 * @property string $libro
 * @property string $folio
 * @property integer $idestadomesaexamen
 * @property boolean $activo
 * @property CondicionesMesas $CondicionesMesas
 * @property TiposExamenes $TiposExamenes
 * @property Catedras $Catedras
 * @property Materias $Materias
 * @property EstadosMesasExamenes $EstadosMesasExamenes
 * @property LibrosActas $LibrosActas
 * @property LlamadosTurno $LlamadosTurno
 * @property Doctrine_Collection $MesasExamenes
 * 
 * @method integer              getIdmesaexamen()         Returns the current record's "idmesaexamen" value
 * @method integer              getIdcatedra()            Returns the current record's "idcatedra" value
 * @method integer              getIdmateria()            Returns the current record's "idmateria" value
 * @method integer              getIdcondicion()          Returns the current record's "idcondicion" value
 * @method integer              getIdtipoexamen()         Returns the current record's "idtipoexamen" value
 * @method integer              getIdlibroacta()          Returns the current record's "idlibroacta" value
 * @method integer              getIdllamado()            Returns the current record's "idllamado" value
 * @method date                 getFecha()                Returns the current record's "fecha" value
 * @method string               getHora()                 Returns the current record's "hora" value
 * @method string               getLibro()                Returns the current record's "libro" value
 * @method string               getFolio()                Returns the current record's "folio" value
 * @method integer              getIdestadomesaexamen()   Returns the current record's "idestadomesaexamen" value
 * @method boolean              getActivo()               Returns the current record's "activo" value
 * @method CondicionesMesas     getCondicionesMesas()     Returns the current record's "CondicionesMesas" value
 * @method TiposExamenes        getTiposExamenes()        Returns the current record's "TiposExamenes" value
 * @method Catedras             getCatedras()             Returns the current record's "Catedras" value
 * @method Materias             getMaterias()             Returns the current record's "Materias" value
 * @method EstadosMesasExamenes getEstadosMesasExamenes() Returns the current record's "EstadosMesasExamenes" value
 * @method LibrosActas          getLibrosActas()          Returns the current record's "LibrosActas" value
 * @method LlamadosTurno        getLlamadosTurno()        Returns the current record's "LlamadosTurno" value
 * @method Doctrine_Collection  getMesasExamenes()        Returns the current record's "MesasExamenes" collection
 * @method MesasExamenes        setIdmesaexamen()         Sets the current record's "idmesaexamen" value
 * @method MesasExamenes        setIdcatedra()            Sets the current record's "idcatedra" value
 * @method MesasExamenes        setIdmateria()            Sets the current record's "idmateria" value
 * @method MesasExamenes        setIdcondicion()          Sets the current record's "idcondicion" value
 * @method MesasExamenes        setIdtipoexamen()         Sets the current record's "idtipoexamen" value
 * @method MesasExamenes        setIdlibroacta()          Sets the current record's "idlibroacta" value
 * @method MesasExamenes        setIdllamado()            Sets the current record's "idllamado" value
 * @method MesasExamenes        setFecha()                Sets the current record's "fecha" value
 * @method MesasExamenes        setHora()                 Sets the current record's "hora" value
 * @method MesasExamenes        setLibro()                Sets the current record's "libro" value
 * @method MesasExamenes        setFolio()                Sets the current record's "folio" value
 * @method MesasExamenes        setIdestadomesaexamen()   Sets the current record's "idestadomesaexamen" value
 * @method MesasExamenes        setActivo()               Sets the current record's "activo" value
 * @method MesasExamenes        setCondicionesMesas()     Sets the current record's "CondicionesMesas" value
 * @method MesasExamenes        setTiposExamenes()        Sets the current record's "TiposExamenes" value
 * @method MesasExamenes        setCatedras()             Sets the current record's "Catedras" value
 * @method MesasExamenes        setMaterias()             Sets the current record's "Materias" value
 * @method MesasExamenes        setEstadosMesasExamenes() Sets the current record's "EstadosMesasExamenes" value
 * @method MesasExamenes        setLibrosActas()          Sets the current record's "LibrosActas" value
 * @method MesasExamenes        setLlamadosTurno()        Sets the current record's "LlamadosTurno" value
 * @method MesasExamenes        setMesasExamenes()        Sets the current record's "MesasExamenes" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMesasExamenes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mesas_examenes');
        $this->hasColumn('idmesaexamen', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('idcatedra', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('idmateria', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('idcondicion', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('idtipoexamen', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('idlibroacta', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('idllamado', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('hora', 'string', 8, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('libro', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('folio', 'string', 10, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('idestadomesaexamen', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CondicionesMesas', array(
             'local' => 'idcondicion',
             'foreign' => 'idcondicion'));

        $this->hasOne('TiposExamenes', array(
             'local' => 'idtipoexamen',
             'foreign' => 'idtipoexamen'));

        $this->hasOne('Catedras', array(
             'local' => 'idcatedra',
             'foreign' => 'idcatedra'));

        $this->hasOne('Materias', array(
             'local' => 'idmateria',
             'foreign' => 'idmateria'));

        $this->hasOne('EstadosMesasExamenes', array(
             'local' => 'idestadomesaexamen',
             'foreign' => 'idestadomesaexamen'));

        $this->hasOne('LibrosActas', array(
             'local' => 'idlibroacta',
             'foreign' => 'idlibroacta'));

        $this->hasOne('LlamadosTurno', array(
             'local' => 'idllamado',
             'foreign' => 'idllamado'));

        $this->hasMany('EstadosMesasExamenesHistorial as MesasExamenes', array(
             'local' => 'idmesaexamen',
             'foreign' => 'idmesaexamen'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}