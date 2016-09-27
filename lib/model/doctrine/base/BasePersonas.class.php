<?php

/**
 * BasePersonas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idpersona
 * @property string $nombre
 * @property string $apellido
 * @property integer $idsexo
 * @property integer $idtipodoc
 * @property integer $idcargo
 * @property string $nrodoc
 * @property string $numerodoc
 * @property date $fechanac
 * @property date $fechaingreso
 * @property integer $idciudadnac
 * @property integer $idnacionalidad
 * @property integer $estadocivil
 * @property integer $vive
 * @property integer $idprofesion
 * @property integer $cantgrupofamiliar
 * @property string $titulo
 * @property string $email
 * @property string $telefono
 * @property string $ciudad
 * @property string $celular
 * @property string $direccion
 * @property boolean $tienefoto
 * @property boolean $activo
 * @property boolean $socio
 * @property boolean $mostrarinfocontacto
 * @property string $nrolector
 * @property string $otrainformacionrelevante
 * @property string $horarios
 * @property float $monto
 * @property integer $idusuario
 * @property TiposDocumentos $TiposDocumentos
 * @property Paises $Paises
 * @property Ciudades $Ciudades
 * @property EstadoCivil $EstadoCivil
 * @property Sexo $Sexo
 * @property sfGuardUser $sfGuardUser
 * @property Doctrine_Collection $Personas
 * 
 * @method integer             getIdpersona()                Returns the current record's "idpersona" value
 * @method string              getNombre()                   Returns the current record's "nombre" value
 * @method string              getApellido()                 Returns the current record's "apellido" value
 * @method integer             getIdsexo()                   Returns the current record's "idsexo" value
 * @method integer             getIdtipodoc()                Returns the current record's "idtipodoc" value
 * @method integer             getIdcargo()                  Returns the current record's "idcargo" value
 * @method string              getNrodoc()                   Returns the current record's "nrodoc" value
 * @method string              getNumerodoc()                Returns the current record's "numerodoc" value
 * @method date                getFechanac()                 Returns the current record's "fechanac" value
 * @method date                getFechaingreso()             Returns the current record's "fechaingreso" value
 * @method integer             getIdciudadnac()              Returns the current record's "idciudadnac" value
 * @method integer             getIdnacionalidad()           Returns the current record's "idnacionalidad" value
 * @method integer             getEstadocivil()              Returns the current record's "estadocivil" value
 * @method integer             getVive()                     Returns the current record's "vive" value
 * @method integer             getIdprofesion()              Returns the current record's "idprofesion" value
 * @method integer             getCantgrupofamiliar()        Returns the current record's "cantgrupofamiliar" value
 * @method string              getTitulo()                   Returns the current record's "titulo" value
 * @method string              getEmail()                    Returns the current record's "email" value
 * @method string              getTelefono()                 Returns the current record's "telefono" value
 * @method string              getCiudad()                   Returns the current record's "ciudad" value
 * @method string              getCelular()                  Returns the current record's "celular" value
 * @method string              getDireccion()                Returns the current record's "direccion" value
 * @method boolean             getTienefoto()                Returns the current record's "tienefoto" value
 * @method boolean             getActivo()                   Returns the current record's "activo" value
 * @method boolean             getSocio()                    Returns the current record's "socio" value
 * @method boolean             getMostrarinfocontacto()      Returns the current record's "mostrarinfocontacto" value
 * @method string              getNrolector()                Returns the current record's "nrolector" value
 * @method string              getOtrainformacionrelevante() Returns the current record's "otrainformacionrelevante" value
 * @method string              getHorarios()                 Returns the current record's "horarios" value
 * @method float               getMonto()                    Returns the current record's "monto" value
 * @method integer             getIdusuario()                Returns the current record's "idusuario" value
 * @method TiposDocumentos     getTiposDocumentos()          Returns the current record's "TiposDocumentos" value
 * @method Paises              getPaises()                   Returns the current record's "Paises" value
 * @method Ciudades            getCiudades()                 Returns the current record's "Ciudades" value
 * @method EstadoCivil         getEstadoCivil()              Returns the current record's "EstadoCivil" value
 * @method Sexo                getSexo()                     Returns the current record's "Sexo" value
 * @method sfGuardUser         getSfGuardUser()              Returns the current record's "sfGuardUser" value
 * @method Doctrine_Collection getPersonas()                 Returns the current record's "Personas" collection
 * @method Personas            setIdpersona()                Sets the current record's "idpersona" value
 * @method Personas            setNombre()                   Sets the current record's "nombre" value
 * @method Personas            setApellido()                 Sets the current record's "apellido" value
 * @method Personas            setIdsexo()                   Sets the current record's "idsexo" value
 * @method Personas            setIdtipodoc()                Sets the current record's "idtipodoc" value
 * @method Personas            setIdcargo()                  Sets the current record's "idcargo" value
 * @method Personas            setNrodoc()                   Sets the current record's "nrodoc" value
 * @method Personas            setNumerodoc()                Sets the current record's "numerodoc" value
 * @method Personas            setFechanac()                 Sets the current record's "fechanac" value
 * @method Personas            setFechaingreso()             Sets the current record's "fechaingreso" value
 * @method Personas            setIdciudadnac()              Sets the current record's "idciudadnac" value
 * @method Personas            setIdnacionalidad()           Sets the current record's "idnacionalidad" value
 * @method Personas            setEstadocivil()              Sets the current record's "estadocivil" value
 * @method Personas            setVive()                     Sets the current record's "vive" value
 * @method Personas            setIdprofesion()              Sets the current record's "idprofesion" value
 * @method Personas            setCantgrupofamiliar()        Sets the current record's "cantgrupofamiliar" value
 * @method Personas            setTitulo()                   Sets the current record's "titulo" value
 * @method Personas            setEmail()                    Sets the current record's "email" value
 * @method Personas            setTelefono()                 Sets the current record's "telefono" value
 * @method Personas            setCiudad()                   Sets the current record's "ciudad" value
 * @method Personas            setCelular()                  Sets the current record's "celular" value
 * @method Personas            setDireccion()                Sets the current record's "direccion" value
 * @method Personas            setTienefoto()                Sets the current record's "tienefoto" value
 * @method Personas            setActivo()                   Sets the current record's "activo" value
 * @method Personas            setSocio()                    Sets the current record's "socio" value
 * @method Personas            setMostrarinfocontacto()      Sets the current record's "mostrarinfocontacto" value
 * @method Personas            setNrolector()                Sets the current record's "nrolector" value
 * @method Personas            setOtrainformacionrelevante() Sets the current record's "otrainformacionrelevante" value
 * @method Personas            setHorarios()                 Sets the current record's "horarios" value
 * @method Personas            setMonto()                    Sets the current record's "monto" value
 * @method Personas            setIdusuario()                Sets the current record's "idusuario" value
 * @method Personas            setTiposDocumentos()          Sets the current record's "TiposDocumentos" value
 * @method Personas            setPaises()                   Sets the current record's "Paises" value
 * @method Personas            setCiudades()                 Sets the current record's "Ciudades" value
 * @method Personas            setEstadoCivil()              Sets the current record's "EstadoCivil" value
 * @method Personas            setSexo()                     Sets the current record's "Sexo" value
 * @method Personas            setSfGuardUser()              Sets the current record's "sfGuardUser" value
 * @method Personas            setPersonas()                 Sets the current record's "Personas" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePersonas extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('personas');
        $this->hasColumn('idpersona', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 100,
             ));
        $this->hasColumn('apellido', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 100,
             ));
        $this->hasColumn('idsexo', 'integer', 4, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             'length' => 4,
             ));
        $this->hasColumn('idtipodoc', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('idcargo', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('nrodoc', 'string', 80, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 80,
             ));
        $this->hasColumn('numerodoc', 'string', 80, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 80,
             ));
        $this->hasColumn('fechanac', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('fechaingreso', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('idciudadnac', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '734',
             ));
        $this->hasColumn('idnacionalidad', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('estadocivil', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('vive', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('idprofesion', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('cantgrupofamiliar', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('titulo', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 100,
             ));
        $this->hasColumn('email', 'string', 200, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 200,
             ));
        $this->hasColumn('telefono', 'string', 200, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 200,
             ));
        $this->hasColumn('ciudad', 'string', 200, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 200,
             ));
        $this->hasColumn('celular', 'string', 200, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 200,
             ));
        $this->hasColumn('direccion', 'string', 200, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 200,
             ));
        $this->hasColumn('tienefoto', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('socio', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('mostrarinfocontacto', 'boolean', null, array(
             'type' => 'boolean',
             'primary' => false,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('nrolector', 'string', 10, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 10,
             ));
        $this->hasColumn('otrainformacionrelevante', 'string', 2000, array(
             'type' => 'string',
             'length' => 2000,
             ));
        $this->hasColumn('horarios', 'string', 2000, array(
             'type' => 'string',
             'length' => 2000,
             ));
        $this->hasColumn('monto', 'float', null, array(
             'type' => 'float',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('idusuario', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TiposDocumentos', array(
             'local' => 'idtipodoc',
             'foreign' => 'idtipodoc'));

        $this->hasOne('Paises', array(
             'local' => 'idnacionalidad',
             'foreign' => 'idpais'));

        $this->hasOne('Ciudades', array(
             'local' => 'idciudadnac',
             'foreign' => 'idciudad'));

        $this->hasOne('EstadoCivil', array(
             'local' => 'estadocivil',
             'foreign' => 'idestadocivil'));

        $this->hasOne('Sexo', array(
             'local' => 'idsexo',
             'foreign' => 'idsexo'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'idusuario',
             'foreign' => 'id'));

        $this->hasMany('Horarios as Personas', array(
             'local' => 'idpersona',
             'foreign' => 'idpersona'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}