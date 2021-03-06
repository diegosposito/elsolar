<?php

/**
 * BaseModalidadesCarreras
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idmodalidad
 * @property string $nombre
 * @property string $descripcion
 * @property Doctrine_Collection $ModalidadesCarreras
 * 
 * @method integer             getIdmodalidad()         Returns the current record's "idmodalidad" value
 * @method string              getNombre()              Returns the current record's "nombre" value
 * @method string              getDescripcion()         Returns the current record's "descripcion" value
 * @method Doctrine_Collection getModalidadesCarreras() Returns the current record's "ModalidadesCarreras" collection
 * @method ModalidadesCarreras setIdmodalidad()         Sets the current record's "idmodalidad" value
 * @method ModalidadesCarreras setNombre()              Sets the current record's "nombre" value
 * @method ModalidadesCarreras setDescripcion()         Sets the current record's "descripcion" value
 * @method ModalidadesCarreras setModalidadesCarreras() Sets the current record's "ModalidadesCarreras" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseModalidadesCarreras extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('modalidades_carreras');
        $this->hasColumn('idmodalidad', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nombre', 'string', 40, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'sin informacion',
             'length' => 40,
             ));
        $this->hasColumn('descripcion', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'sin informacion',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Carreras as ModalidadesCarreras', array(
             'local' => 'idmodalidad',
             'foreign' => 'idmodalidad'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}