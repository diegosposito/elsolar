<?php

/**
 * MesesCobroTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MesesCobroTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object MesesCobroTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MesesCobro');
    }

     // Alumnos cursando materia seleccionada y materias correlativas aprobadas
    public static function obtenerMesesCobro($idpersona)
    {
            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                select id, idpersona, mes, descripcion from meses_cobro where idpersona = ".$idpersona." 
            ");
        
            return $q;
    }

     // Alumnos cursando materia seleccionada y materias correlativas aprobadas
    public static function obtenerSoloMesesCobro($idpersona)
    {
        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
            select mes from meses_cobro where idpersona = ".$idpersona." 
        ");

        $arreglo = '';
        
        foreach($q as $mes) {
            $arreglo[] = $mes['mes'];
        }

        return $arreglo;
        
    }

    public static function borrarMesesCobro($idpersona)
    {
           $q = Doctrine_Query::create()
			->delete('MesesCobro mc')
	    	->where('(mc.idpersona = '.$idpersona.')');
 	
		return $q->execute();
    }
}