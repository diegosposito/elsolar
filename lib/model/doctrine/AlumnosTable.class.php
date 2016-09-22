<?php

/**
 * AlumnosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AlumnosTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AlumnosTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Alumnos');
    }
    
    // Busca todas los alumnos egresados segun los criterios
    public static function buscarEgresadosPorTitulo($tipocriterio, $criterio, $idtitulo, $idsede)
    {
    	if($tipocriterio==1) {
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT DISTINCT *, cl.ciclo as ciclo, s.nombre as sede, concat(pe.apellido, ', ', pe.nombre) as nombre, ea.fecha as fechaegreso, concat(c.nombre, ' - ', pl.nombre) as carrera
    				FROM alumnos al
   					INNER JOIN (
   						SELECT * FROM (
						    SELECT *
						    FROM estados_alumno_historial
						    ORDER BY id DESC
						) AS eah
						GROUP BY eah.idalumno
   					) AS ea ON al.idalumno = ea.idalumno
    				INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
            		INNER JOIN planes_estudios pl on al.idplanestudio = pl.idplanestudio
    				INNER JOIN titulos_planes tp on pl.idplanestudio = tp.idplanestudio
    				INNER JOIN titulos ti on tp.idtitulo = ti.idtitulo
            		INNER JOIN carreras c on pl.idcarrera = c.idcarrera
    				INNER JOIN sedes s on al.idsede = s.idsede
    				WHERE
    					((pe.apellido LIKE '%".$criterio."%') OR (pe.nombre LIKE '%".$criterio."%'))
    					AND tp.idtitulo = ".$idtitulo."
    					AND al.idsede = ".$idsede."
    					AND ((ti.niveltitulo = 0) OR (ti.niveltitulo = 1 AND ea.idestadoalumno = 3))
    				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
    	}else{
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT DISTINCT *, cl.ciclo as ciclo, s.nombre as sede, concat(pe.apellido, ', ', pe.nombre) as nombre, ea.fecha as fechaegreso, concat(c.nombre, ' - ', pl.nombre) as carrera
    				FROM alumnos al
   					INNER JOIN (
   						SELECT * FROM (
						    SELECT *
						    FROM estados_alumno_historial
						    ORDER BY fecha DESC, id DESC
						) AS eah
						GROUP BY eah.idalumno
   					) AS ea ON al.idalumno = ea.idalumno
    				INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
            		INNER JOIN planes_estudios pl on al.idplanestudio = pl.idplanestudio
    				INNER JOIN titulos_planes tp on pl.idplanestudio = tp.idplanestudio
    				INNER JOIN titulos ti on tp.idtitulo = ti.idtitulo
            		INNER JOIN carreras c on pl.idcarrera = c.idcarrera
    				INNER JOIN sedes s on al.idsede = s.idsede
    				WHERE
    					(pe.nrodoc LIKE '%".$criterio."%')
    					AND tp.idtitulo = ".$idtitulo."
    					AND al.idsede = ".$idsede."
    					AND ((ti.niveltitulo = 0) OR (ti.niveltitulo = 1 AND ea.idestadoalumno = 3))
    				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
    	}
    	return $q;
    }
    
    // Busca todas los alumnos dados de baja filtrados
    public static function buscarBajasFiltrados($idfacultad, $idsede, $idplanestudio, $ordencampo, $ordenmetodo)
    {
    	$w="";
    	 
    	if ($idfacultad!=0) {
    		$w = "c.idfacultad=".$idfacultad;
    		if ($idsede!=0 or $idplanestudio!=0) {
    			$w .= " AND ";
    		}
    	}
    	if ($idsede!=0) {
    		$w .= "al.idsede=".$idsede;
    		if ($idplanestudio!=0) {
    			$w .= " AND ";
    		}
    			
    	}
    	if($idplanestudio!=0) {
    		$w .= "pl.idplanestudio=".$idplanestudio;
    	}

    
    	if (($idfacultad!=0) or ($idsede!=0) or ($idplanestudio!=0)) {
    		$w .= " AND ";
    	}
    
    	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
	   		SELECT DISTINCT al.*, cl.ciclo as ciclo, f.nombreabrev as facultad, s.abreviacion as sede, concat(pe.apellido, ', ', pe.nombre) as nombre, pe.nrodoc as nrodoc, ea.fecha as fechabaja, ea.created_at as fecharegistro, concat(c.nombre, ' - ', pl.nombre) as carrera
	   		FROM alumnos al
			INNER JOIN (
				SELECT * FROM (
				    SELECT *
				    FROM estados_alumno_historial
				    ORDER BY fecha DESC, id DESC
				) AS eah
				GROUP BY eah.idalumno
	   		) AS ea ON al.idalumno = ea.idalumno
	    	INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
	    	INNER JOIN personas pe ON al.idpersona = pe.idpersona
	        INNER JOIN planes_estudios pl ON al.idplanestudio = pl.idplanestudio
	        INNER JOIN carreras c ON pl.idcarrera = c.idcarrera
	    	INNER JOIN facultades f ON c.idfacultad = f.idfacultad
	    	INNER JOIN sedes s ON al.idsede = s.idsede
	    	WHERE
	    		".$w."
	    		ea.idestadoalumno = 2
	    	ORDER BY ".$ordencampo." ".$ordenmetodo
    	);
    	return $q;
    }
        
    
    // Busca todas los alumnos egresados filtrados
    public static function buscarEgresadosFiltrados($idfacultad, $idsede, $idplanestudio, $ordencampo, $ordenmetodo, $estado)
    {
    	$w="";
    	
		if ($idfacultad!=0) {
			$w = "c.idfacultad=".$idfacultad;
			if ($idsede!=0 or $idplanestudio!=0 or $estado!=0) {
				$w .= " AND ";
			}
		}
		if ($idsede!=0) {
			$w .= "al.idsede=".$idsede;
			if ($idplanestudio!=0 or $estado!=0) {
				$w .= " AND ";
			}
			
		}
		if($idplanestudio!=0) {
			$w .= "pl.idplanestudio=".$idplanestudio;
			if ($estado!=0) {
				$w .= " AND ";
			}			
		}
		if($estado==1) {
			$w .= "ex.activo=1";
		} elseif($estado==2) {
			$w .= "ex.activo=0";
		} else {
			$w .="";
		}
		
		if (($idfacultad!=0) or ($idsede!=0) or ($idplanestudio!=0) or ($estado!=0)) {
		 	$w .= " AND ";
		}
	    	
	    $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
	   		SELECT DISTINCT al.*, cl.ciclo as ciclo, f.nombreabrev as facultad, s.abreviacion as sede, concat(pe.apellido, ', ', pe.nombre) as nombre, pe.nrodoc as nrodoc, ea.fecha as fechaegreso, concat(c.nombre, ' - ', pl.nombre) as carrera, ex.idexpediente as idexpediente, IF(ex.idexpediente != '' and ex.idderivacionbiblioteca != 0, 'X', '') AS bib, IF(ex.idexpediente != '' and ex.idderivacionadministracion != 0 , 'X', '') AS adm
	   		FROM alumnos al
			INNER JOIN (
				SELECT * FROM (
				    SELECT *
				    FROM estados_alumno_historial
				    ORDER BY fecha DESC, id DESC
				) AS eah
				GROUP BY eah.idalumno
	   		) AS ea ON al.idalumno = ea.idalumno
	    	INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
	    	INNER JOIN personas pe ON al.idpersona = pe.idpersona
	        INNER JOIN planes_estudios pl ON al.idplanestudio = pl.idplanestudio
	        INNER JOIN carreras c ON pl.idcarrera = c.idcarrera
	    	INNER JOIN facultades f ON c.idfacultad = f.idfacultad
	    	INNER JOIN sedes s ON al.idsede = s.idsede
	    	LEFT JOIN expedientes_egresados ex ON al.idalumno = ex.idalumno	    		
	    	WHERE
	    		".$w."
	    		ea.idestadoalumno = 3
	    	ORDER BY ".$ordencampo." ".$ordenmetodo
	    );
	    return $q;
    }
     
    
    // Busca todas los alumnos egresados segun los criterios
    public static function buscarEgresados($tipocriterio, $criterio, $idplanestudio, $idsede)
    {
    	if($tipocriterio==1) {
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT DISTINCT *, cl.ciclo as ciclo, s.nombre as sede, concat(pe.apellido, ', ', pe.nombre) as nombre, ea.fecha as fechaegreso, concat(c.nombre, ' - ', pl.nombre) as carrera
    				FROM alumnos al
   					INNER JOIN (
   						SELECT * FROM (
						    SELECT *
						    FROM estados_alumno_historial
						    ORDER BY fecha DESC, id DESC
						) AS eah
						GROUP BY eah.idalumno
   					) AS ea ON al.idalumno = ea.idalumno
    				INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
            		INNER JOIN planes_estudios pl on al.idplanestudio = pl.idplanestudio
            		INNER JOIN carreras c on pl.idcarrera = c.idcarrera    	
    				INNER JOIN sedes s on al.idsede = s.idsede 			
    				WHERE
    					((pe.apellido LIKE '%".$criterio."%') OR (pe.nombre LIKE '%".$criterio."%'))
    					AND al.idplanestudio = ".$idplanestudio."
    					AND al.idsede = ".$idsede."
    					AND ea.idestadoalumno = 3
    				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
    	}else{
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT DISTINCT *, cl.ciclo as ciclo, s.nombre as sede, concat(pe.apellido, ', ', pe.nombre) as nombre, ea.fecha as fechaegreso, concat(c.nombre, ' - ', pl.nombre) as carrera
    				FROM alumnos al
   					INNER JOIN (
   						SELECT * FROM (
						    SELECT *
						    FROM estados_alumno_historial
						    ORDER BY fecha DESC, id DESC
						) AS eah
						GROUP BY eah.idalumno
   					) AS ea ON al.idalumno = ea.idalumno
    				INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
            		INNER JOIN planes_estudios pl on al.idplanestudio = pl.idplanestudio
            		INNER JOIN carreras c on pl.idcarrera = c.idcarrera    		
    				INNER JOIN sedes s on al.idsede = s.idsede		
    				WHERE
    					(pe.nrodoc LIKE '%".$criterio."%')
    					AND al.idplanestudio = ".$idplanestudio."
    					AND al.idsede = ".$idsede."
    					AND ea.idestadoalumno = 3
    				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
    	}
    
    	//echo "SQL: ".$q->getSqlQuery();
    	//exit;
    	return $q;
    }


    // Alumnos cursando materia seleccionada y materias correlativas aprobadas
    public static function alumnosCursandoMateriasCorrelativas($idcatedra, $fecha)
    {
            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT p.idpersona, p.nombre, p.apellido, cantidad.total, a.idplanestudio, 
                COUNT(DISTINCT IF( me.fecha <='".$fecha."' AND mp2.idplanestudio = 2 AND mp2.anodecursada > 0 AND mp2.obligatoria = 1 AND mp2.idtipomateria NOT IN (2,3) AND me.idestadomesaexamen=4 AND (e.promedio >=4 OR me.idtipoexamen = 4), mp2.idmateriaplan, NULL)) as materias_corr_aprobadas 
                FROM personas p
                JOIN alumnos a ON p.idpersona = a.idpersona
                JOIN materias_planes mp ON a.idplanestudio = mp.idplanestudio
                JOIN catedras ct ON mp.idmateriaplan = ct.idmateriaplan
                JOIN alu_mat am ON ct.idcatedra = am.idcatedra AND a.idalumno = am.idalumno AND am.idestadomateria =1
                JOIN correlatividades cor ON mp.idmateriaplan = cor.idmateriaplan 
                JOIN materias_planes mp2 ON cor.idmateriaplanc = mp2.idmateriaplan 
                JOIN (
                SELECT COUNT(DISTINCT(idmateriaplanc)) as total FROM correlatividades JOIN catedras ON correlatividades.idmateriaplan = catedras.idmateriaplan WHERE catedras.idcatedra = ".$idcatedra." AND condicion ='A'
                ) as cantidad 
                JOIN catedras cat ON cor.idmateriaplanc = cat.idmateriaplan 
                LEFT JOIN examenes e ON a.idalumno = e.idalumno
                LEFT JOIN mesas_examenes me ON e.idmesaexamen = me.idmesaexamen AND cat.idcatedra = me.idcatedra
                 WHERE ct.idcatedra= ".$idcatedra." AND am.idestadomateria =1 and am.idcatedra= ".$idcatedra." AND cor.condicion ='A'
                 GROUP BY a.idalumno ORDER BY p.apellido
            ");
        
            return $q;
    }
        
    // Busca todas los alumnos segun los criterios
    public static function buscarAlumnos($tipocriterio, $criterio, $idplanestudio, $idsede, $tipo)
    {
    	if($tipo==0) {
    		$w = " AND ea.idestadoalumno != 2 ";
    	} else {
			//if($tipo==4){
			//	$w = " AND ea.idestadoalumno = 1 ";
    		//} else {
    			$w = " ";
			//}
    	}
    	if($tipocriterio==1) {
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT DISTINCT *, cl.ciclo as ciclo 
    				FROM alumnos al
   					INNER JOIN ( 
   						SELECT * FROM (
						    SELECT * 
						    FROM estados_alumno_historial
						    ORDER BY fecha DESC, id DESC
						) AS eah
						GROUP BY eah.idalumno
   					) AS ea ON al.idalumno = ea.idalumno 
    				INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
    				WHERE
    					((pe.apellido LIKE '%".$criterio."%') OR (pe.nombre LIKE '%".$criterio."%'))
    					AND al.idplanestudio = ".$idplanestudio."
    					AND al.idsede = ".$idsede.""
    				.$w.								
    				"ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
		}else{
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT DISTINCT *, cl.ciclo as ciclo
    				FROM alumnos al
   					INNER JOIN ( 
   						SELECT * FROM (
						    SELECT * 
						    FROM estados_alumno_historial
						    ORDER BY fecha DESC, id DESC
						) AS eah
						GROUP BY eah.idalumno
   					) AS ea ON al.idalumno = ea.idalumno 
    				INNER JOIN ciclos_lectivos cl ON al.idciclolectivo = cl.id
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
    				WHERE
    					(pe.nrodoc LIKE '%".$criterio."%')
    					AND al.idplanestudio = ".$idplanestudio."
    					AND al.idsede = ".$idsede.""
    					.$w.
    				"ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
		}		
		
		//echo "SQL: ".$q->getSqlQuery();
		//exit;
		return $q;
    }   

    // Busca todas los alumnos segun los criterios
    public static function buscarPersonas($tipocriterio, $criterio, $idplanestudio, $idsede, $tipo)
    {
      
        if($tipocriterio==1) {
            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT sf.username, pe.* FROM personas pe JOIN sf_guard_user sf ON pe.idusuario = sf.id 
                WHERE
                        ((pe.apellido LIKE '%".$criterio."%') OR (pe.nombre LIKE '%".$criterio."%'))
                        AND pe.idprofesion = 1  
                        ORDER BY pe.apellido ASC, pe.nombre ASC
            ");
        }else{
            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT sf.username, pe.* FROM personas pe JOIN sf_guard_user sf ON pe.idusuario = sf.id 
                    WHERE
                        (pe.nrodoc LIKE '%".$criterio."%') 
                        AND pe.idprofesion = 1 ORDER BY pe.apellido ASC, pe.nombre ASC
            ");
        }       
        
        //echo "SQL: ".$q->getSqlQuery();
        //exit;
        return $q;
    }  

    // Busca todas los alumnos segun los criterios
    public static function buscarCobrador($tipocriterio, $criterio, $idplanestudio, $idsede, $tipo)
    {
      
        if($tipocriterio==1) {
            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT pe.* FROM personas pe 
                WHERE
                        ((pe.apellido LIKE '%".$criterio."%') OR (pe.nombre LIKE '%".$criterio."%'))
                        AND NOT pe.socio 
                        ORDER BY pe.apellido ASC, pe.nombre ASC
            ");
        }else{
            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT pe.* FROM personas pe 
                    WHERE
                        (pe.nrodoc LIKE '%".$criterio."%') 
                        AND NOT pe.socio ORDER BY pe.apellido ASC, pe.nombre ASC
            ");
        }       
        
        //echo "SQL: ".$q->getSqlQuery();
        //exit;
        return $q;
    }
       
    // Busca todas los alumnos segun los criterios
    public static function buscarAlumnosPorCiclo($tipocriterio, $criterio, $idplanestudio, $idciclolectivo)
    {
    	if ($tipocriterio == 1) {
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT * 
    				FROM alumnos al
    				INNER JOIN (
    					SELECT ea.idestadoalumno, ea.fecha, ea.idalumno 
    						FROM estados_alumno_historial ea 
    						INNER JOIN ( 
								SELECT * FROM (
    								SELECT * 
    								FROM estados_alumno_historial
    								ORDER BY fecha DESC, id DESC
								) AS eah
								GROUP BY eah.idalumno
    						) AS maxestadoporalumno 
    						ON ea.idalumno = maxestadoporalumno.idalumno 
    						AND ea.fecha = maxestadoporalumno.fecha
    						AND ea.idestadoalumno != 3
    				) AS estadosalumno ON estadosalumno.idalumno = al.idalumno
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
    				WHERE
    					((pe.apellido LIKE '%".$criterio."%') OR (pe.nombre LIKE '%".$criterio."%'))
    					AND al.idplanestudio = ".$idplanestudio."
    					AND estadosalumno.idalumno = al.idalumno
    					AND al.idciclolectivo = ".$idciclolectivo."
    				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
		} else {
    		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT * 
    				FROM alumnos al
    				INNER JOIN (
    					SELECT ea.idestadoalumno, ea.fecha, ea.idalumno 
    						FROM estados_alumno_historial ea 
    						INNER JOIN ( 
								SELECT * FROM (
    								SELECT * 
    								FROM estados_alumno_historial
    								ORDER BY fecha DESC, id DESC
								) AS eah
								GROUP BY eah.idalumno
    						) AS maxestadoporalumno 
    						ON ea.idalumno = maxestadoporalumno.idalumno 
    						AND ea.fecha = maxestadoporalumno.fecha
    						AND ea.idestadoalumno != 3
    				) AS estadosalumno ON estadosalumno.idalumno = al.idalumno
    				INNER JOIN personas pe ON al.idpersona = pe.idpersona
    				WHERE
    					(pe.nrodoc LIKE '%".$criterio."%')
    					AND al.idplanestudio = ".$idplanestudio."
    					AND estadosalumno.idalumno = al.idalumno
    					AND al.idciclolectivo = ".$idciclolectivo."
    				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");
		}		
		
		return $q;
    }   
        
	// Busca el alumno
  	public function buscarAlumno($idpersona, $idplanestudio)
    {
    	$q = Doctrine_Query::create()
	  		->select("*")
	 		->from("Alumnos a")
	 		->where("a.idpersona = ".$idpersona)
	    	->andWhere("a.idplanestudio = ".$idplanestudio)
	    	->fetchOne();
	       
        return $q;
    }    
    
  	public function obtenerDatosUsuario($idUsuario)
    {
    	$q = Doctrine_Query::create()
	  		->select("*")
	 		->from("sfGuardUser u")
	 		->where("u.idusuario = ".$idUsuario);
	       
        return $q->execute();
    }        
}
