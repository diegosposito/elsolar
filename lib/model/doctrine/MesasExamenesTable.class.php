<?php

/**
 * MesasExamenesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MesasExamenesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object MesasExamenesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MesasExamenes');
    }
    // Obtiene el libro matriz
    public function getLibroMatriz($libro,$folio,$estado=0) 
    {
    	if ($estado!=0) $criterioestado = " OR (f.idestadomesaexamen=".$estado.")";   
    	
    	$q = Doctrine_Query::create()
			->select('f.*')
			->from("MesasExamenes f")
	    	->where("(f.idlibroacta = ".$libro.") AND (f.folio = ".$folio.")");
 	
		return $q->fetchOne();
    }     
    
    // Control de error: devuelve un listado de alumnos que ya aprobaron
    // la materia de la mesa que se quiere cerrar 
    public static function getAlumnosYaAprobaron($idmesaexamen, $idcatedra) {
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
	    	SELECT p.nombre, p.apellido 
	         	FROM (
	         		SELECT DISTINCT e.idalumno, m.idcatedra 
	         			FROM mesas_examenes m 
	         			INNER JOIN examenes e ON m.idmesaexamen = e.idmesaexamen 
	         			INNER JOIN ( 
	         				SELECT DISTINCT e.idalumno, m.idcatedra 
	         					FROM mesas_examenes m 
	         					INNER JOIN examenes e ON m.idmesaexamen = e.idmesaexamen 
	         					WHERE m.idestadomesaexamen = 4 AND m.idcatedra = ".$idcatedra." AND m.idmesaexamen <> ".$idmesaexamen." AND ((m.idtipoexamen = 1 AND e.promedio >=4) OR (e.promedio LIKE 'A%') OR (m.idtipoexamen = 4))
	         			) AS Datos ON (e.idalumno = Datos.idalumno AND m.idcatedra = Datos.idcatedra)
	         			WHERE m.idmesaexamen = ".$idmesaexamen. " 
	         		) AS info 
	         	INNER JOIN alumnos a ON info.idalumno = a.idalumno 
	         	INNER JOIN personas p ON a.idpersona = p.idpersona
		");

		return $q;
    } 

    // Devuelve la cantidad de aplazos de una catedra para un alumno especifico, a partir de la fecha
    // de ultima regularidad del alumno
    public static function getCantidadAplazosPorAlumnoCatedra($idalumno, $idcatedra) {
		$cantidad = 0;
    	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				    	SELECT a.idalumno, per.apellido, per.nombre, m.nombre,
			COUNT(DISTINCT IF( mp.anodecursada>=1 AND me.idestadomesaexamen=4 AND me.fecha>= IFNULL(am.fecha,'1990-01-01') AND ((e.promedio > 0 AND e.promedio < 4) OR e.promedio='U') , e.idexamen, NULL)) as cantidad,
			COUNT(DISTINCT IF( mp.anodecursada>=1 AND me.idestadomesaexamen=4 AND me.fecha>= IFNULL(am.fecha,'1990-01-01') AND (e.promedio >=4 OR me.idtipoexamen = 4), mp.idmateriaplan, NULL)) as aprobada
			FROM mesas_examenes me
			JOIN examenes e ON me.idmesaexamen = e.idmesaexamen
			JOIN catedras cat ON me.idcatedra = cat.idcatedra
			LEFT JOIN (
			           SELECT am1.id, am1.idalumno, am1.idcatedra, am1.fecha FROM alu_mat am1 JOIN
			           (SELECT MAX(id) as idalumat FROM alu_mat WHERE idestadomateria=3 AND idalumno= ".$idalumno." GROUP BY idalumno, idcatedra) as regular
			           ON am1.id = regular.idalumat
			           ) as am ON e.idalumno = am.idalumno AND me.idcatedra = am.idcatedra
			JOIN materias_planes mp ON cat.idmateriaplan = mp.idmateriaplan
			JOIN materias m ON mp.idmateria = m.idmateria
			JOIN alumnos a ON e.idalumno = a.idalumno
			JOIN personas per ON a.idpersona = per.idpersona
			WHERE cat.idcatedra = ".$idcatedra." AND a.idalumno = ".$idalumno." 
			GROUP BY a.idalumno, mp.idmateriaplan
			HAVING aprobada = 0 AND cantidad >= 3
		");
		foreach($q as $fila){
			$cantidad = $fila['cantidad'];
		}
		return $cantidad;
    }       
    
    // Control de error: devuelve un listado de alumnos que ya aprobaron
    // la materia de la mesa que se quiere cerrar 
    public static function obtenerMesaExamenPromocion($idcatedra, $estado) {
    	$q = Doctrine_Query::create()
			->select('me.*')
			->from("MesasExamenes me")
	    	->where("me.idcondicion = 3")
	    	->andWhere("me.idestadomesaexamen = ".$estado)
	    	->andWhere("me.idcatedra = ".$idcatedra);

		return $q->fetchOne();  	
    }

    public static function obtenerMesasExamenes($idcatedra, $estado, $tipomesa) {
    	$q = Doctrine_Query::create()
			->select('me.*')
			->from("MesasExamenes me")
	    	->where("me.idcondicion = ".$tipomesa)
	    	->andWhere("me.idestadomesaexamen = ".$estado)
	    	->andWhere("me.idcatedra = ".$idcatedra);

		return $q->fetchOne();  	
    }

    public static function obtenerAnalitico($idAlumno, $idTipoAnalitico) {
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
			SELECT 
				concat(MP.codMat, '-', MP.idMateriaPlan) as Codigo, 
				M.nombre,
				ME.libro,
				ME.folio, 
				ME.fecha,
				CF.Condicion, 
				MP.curso, 
				MP.orden, 
				E.promedio,
				ME.fecha, 
				ME.idTipoExamen,
				ME.idmesaexamen as idfe,
				E.idalumno as ida,
				ME.idMateria as idm
			FROM examenes E
			INNER JOIN mesas_examenes ME ON E.idmesaexamen = ME.idmesaexamen 
			INNER JOIN materias M on ME.idMateria = M.idMateria 
			INNER JOIN materias_planes MP on M.idMateria = MP.idMateria 
			INNER JOIN condiciones_mesas CF ON ME.idCondicion = CF.idCondicion 
			INNER JOIN alumnos A ON E.idAlumno = A.idAlumno 
				
			WHERE A.idAlumno = ".$idAlumno." AND  ME.idestadomesaexamen = 4 AND ((ME.idTipoExamen = 1 and E.promedio >=4) or (E.promedio like 'A%') or (ME.idTipoExamen = 4)) 
			ORDER BY MP.curso, MP.orden
		");


		return $q;	
    }    
}
