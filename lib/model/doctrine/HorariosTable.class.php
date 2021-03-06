<?php

/**
 * HorariosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HorariosTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object HorariosTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Horarios');
    }

    // Obtiene persona buscando por nro de documento
    public static function obtenerProximoEstado($idpersona)
    {
        $sql ="SELECT IFNULL((SELECT CASE WHEN tiporegistro=1 THEN 0 WHEN tiporegistro=0 THEN 1 END FROM horarios WHERE DATE(created_at) = DATE(NOW()) AND idpersona = ".$idpersona." ORDER BY created_at DESC LIMIT 1), 1) AS estado;";
        $resultado = '';

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        foreach ($q as $item){
    		$resultado = $item['estado'];
    	}

        return $resultado;
    } 

    // Obtiene persona buscando por nro de documento
    public static function obtenerUltimoRegistro($idpersona)
    {
        $sql ="SELECT id FROM horarios WHERE DATE(created_at) = DATE(NOW()) AND idpersona = ".$idpersona." ORDER BY created_at DESC LIMIT 1;";
        $resultado = '';

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        $resultado = 0;
        foreach ($q as $item){
            $resultado = $item['id'];
        }

        return $resultado;
    } 

    // Actualizar todos los estados de una persona a controlar si estan en No controlar
    public static function updEstadoPorRegistro($idregistro, $estado)
    {
         
        // actualizar designaciones
        $sql ="UPDATE horarios set controlar = ".$estado." WHERE id = ".$idregistro.";";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection();
        
        return $q->execute($sql);
    } 

    // Actualizar todos los estados de una persona a controlar si estan en No controlar
    public static function updEntradaAControlar($idpersona)
    {
         
        // actualizar designaciones
        $sql ="UPDATE horarios set controlar = true WHERE (NOT controlar) AND DATE(created_at)=DATE(NOW()) AND idpersona = ".$idpersona.";";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection();
        
        return $q->execute($sql);
    } 

    // Obtiene persona buscando por nro de documento
    public static function obtenerTiempoTrabajadoxDiaxPersona($idpersona='', $fecha='')
    {
        $sql =" SELECT idpersona, DATE(created_at) AS `date`, SUM(UNIX_TIMESTAMP(created_at)*(1-2* tiporegistro))/3600 AS `hours_worked`, SEC_TO_TIME(SUM(UNIX_TIMESTAMP(created_at)*(1-2* tiporegistro))) as hora
                FROM horarios WHERE controlar ";
        
        if ($idpersona<>'')
             $sql.=" AND idpersona = ".$idpersona." ";

        if ($fecha<>'')
             $sql.=" AND date(created_at) = '".$fecha."' "; 
        
        $sql.=" GROUP BY date(created_at), idpersona;";
        
        $resultado = '';

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        foreach ($q as $item){
    		$resultado = $item['totalhoras'];
    	}

        return $resultado;
    } 

    // Obtiene persona buscando por nro de documento
    public static function obtenerTiempoTrabajadoxPeriodo($idpersona='', $mes='', $anio='')
    {
        $sql =" SELECT h.idpersona, per.apellido, per.nombre, CONCAT(per.apellido, ', ', per.nombre) as nombrecompleto,DATE(h.created_at) AS `date`, 
                    SUM(UNIX_TIMESTAMP(h.created_at)*(1- 2 * h.tiporegistro))/3600 AS `hours_worked`, 
                    SEC_TO_TIME(SUM(UNIX_TIMESTAMP(IF(DAY(h.created_at)<=15,h.created_at,0))*(1- 2 * h.tiporegistro))) AS `hours_worked_first`, 
                    SEC_TO_TIME(SUM(UNIX_TIMESTAMP(IF(DAY(h.created_at)>15,h.created_at,0))*(1- 2 * h.tiporegistro))) AS `hours_worked_second`,  
                    SEC_TO_TIME(SUM(UNIX_TIMESTAMP(h.created_at)*(1- 2 * h.tiporegistro))) as hora,
                    SEC_TO_TIME(SUM(UNIX_TIMESTAMP((CASE WHEN DATE(h.created_at) = DATE(NOW()) THEN h.created_at ELSE 0 END))*(1- 2 * h.tiporegistro))) as hora_del_dia 
                FROM horarios h JOIN personas per ON h.idpersona = per.idpersona WHERE h.controlar ";
        
        if ($idpersona<>'')
             $sql.=" AND h.idpersona = ".$idpersona." ";

        if ($mes<>'')
             $sql.=" AND MONTH(h.created_at) = '".$mes."' ";

        if ($anio<>'')
            $sql.=" AND YEAR(h.created_at) = '".$anio."' "; 
        
        $sql.=" GROUP BY h.idpersona";

        $sql.=" ORDER BY per.apellido, per.nombre;";
        
        $resultado = '';

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        return $q;
    } 

    // Obtiene persona buscando por nro de documento
    public static function obtenerResumenMensualxPer($idpersona, $mes, $anio, $detallado=false)
    {
        $sql =" SELECT h.idpersona, per.apellido, per.nombre, CONCAT(per.apellido, ', ', per.nombre) as nombrecompleto,DATE(h.created_at) AS `date`, SUM(UNIX_TIMESTAMP(h.created_at)*(1- 2 * h.tiporegistro))/3600 AS `hours_worked`, 
                SEC_TO_TIME(SUM(UNIX_TIMESTAMP(h.created_at)*(1- 2 * h.tiporegistro))) as hora, GROUP_CONCAT(DISTINCT h.observaciones SEPARATOR ' - ') as observaciones, SUM(IF(h.observaciones<> '', 1, 0)) as cantidadobs 
                FROM horarios h JOIN personas per ON h.idpersona = per.idpersona 
                WHERE h.controlar AND h.idpersona = ".$idpersona." AND MONTH(h.created_at) = '".$mes."' AND YEAR(h.created_at) = '".$anio."' GROUP BY h.idpersona ";
        
        if ($detallado)
             $sql .= " , DATE(h.created_at) ";

        $resultado = '';

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        return $q;
    } 

    // Obtiene detalle horas trabajadas mensuales por persona
    public static function obtenerDetalleMensualxPer($idpersona, $mes, $anio)
    {
        $sql =" SELECT h.idpersona, per.apellido, per.nombre, CONCAT(per.apellido, ', ', per.nombre) as nombrecompleto,h.created_at AS `date`, 
                h.tiporegistro, h.controlar,
                CASE WHEN NOT h.controlar THEN 'Registro inconsistente' ELSE '' END as estado 
                FROM horarios h JOIN personas per ON h.idpersona = per.idpersona  
                WHERE h.idpersona = ".$idpersona." AND MONTH(h.created_at) = '".$mes."' AND YEAR(h.created_at) = '".$anio."' ORDER BY h.created_at;";
      
        $resultado = '';

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        return $q;
    } 

    // Obtiene detalle horas trabajadas mensuales por persona FORMATEADO
   public static function obtenerDetalleMensualxPerFormat($idpersona, $mes, $anio)
    {
        $sql =" SELECT h.idpersona, per.apellido, per.nombre, CONCAT(per.apellido, ', ', per.nombre) as nombrecompleto,h.created_at AS `date`, 
                h.tiporegistro, h.controlar,
                CASE WHEN NOT h.controlar THEN 'Registro inconsistente' ELSE '' END as estado 
                FROM horarios h JOIN personas per ON h.idpersona = per.idpersona  
                WHERE h.idpersona = ".$idpersona." AND MONTH(h.created_at) = '".$mes."' AND YEAR(h.created_at) = '".$anio."' ORDER BY h.created_at;";
      
        $resultado = '';

        $result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
        
        $datos = array(); $hora_ingreso = '';
        foreach($result as $st){
            // Si es un registro inconsistente no se muestra horario de salida
            if(!$st['controlar']){
                $datos[] = array('nombrecompleto' => $st['nombrecompleto'],
                               'fecha'          => date("d-m-Y", strtotime($st['date'])),
                               'horaingreso'    => date("H:i:s", strtotime($st['date'])),
                               'horaegreso'     => '',
                               'estado'     => '0');
            }
            
            // si es una entrada correcta, converso el horario de entrada y no agrego
            if($st['controlar'] && ($st['tiporegistro']))
                $hora_ingreso = date("H:i:s", strtotime($st['date']));
           
            // Si es salida y es un registro consistente, agrego el registro + horario entrada del anterior
            if($st['controlar'] && (!$st['tiporegistro'])){
                $datos[] = array('nombrecompleto' => $st['nombrecompleto'],
                               'fecha'          => date("d-m-Y", strtotime($st['date'])),
                               'horaingreso'    => $hora_ingreso,
                               'horaegreso'     => date("H:i:s", strtotime($st['date'])),
                               'estado'     => '1');
                $hora_ingreso = '';
            }
        }
        return $datos;
    }                    
}