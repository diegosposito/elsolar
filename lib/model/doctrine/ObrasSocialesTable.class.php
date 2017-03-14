<?php

/**
 * ObrasSocialesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ObrasSocialesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ObrasSocialesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ObrasSociales');
    }

    // Obtener obras sociales
    public static function obtenerObrasSociales($estado=NULL)
    {
        $sql ="SELECT os.idobrasocial, os.denominacion as denominacion, os.general, os.ortodoncia, os.implantes, os.protesis, os.abreviada, if(os.estado=1,'Habilitada','No Habilitada') as estado, os.fechaultimoperiodo, DATE_FORMAT(os.fechaultimoperiodo, '%d/%m/%Y') as fechaultimoperiodoformat, os.fechaultimoperiodotexto
				FROM obras_sociales os ";

		if($estado !== NULL)
		    $sql .=  " WHERE os.estado = ".$estado." ";	

		$sql .= " ORDER BY os.denominacion;";
        
        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);

        return $q;
    } 

    // Obtiene todas las OS ordeandas por campo abreviada
    public static function obtenerTodas()
    {
        $q = Doctrine_Query::create()
            ->select('o.*')
            ->from('ObrasSociales o')
            ->orderby('o.abreviada ASC ');

        return $q->execute();
    } 

    // Obten
}