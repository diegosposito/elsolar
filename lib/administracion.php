<?php

require_once('nusoap.php');

class Administracion {

	function __construct() {
		$this->idAlumno = 0;
		$this->nroDoc = 0;
		$this->idplan = 0;
	}

	function setIdAlumno($idalumno){
		// primer valor seteado
		$this->idAlumno=$idalumno;
	}
	
	function setNumeroDoc($nrodoc){
		// primer valor seteado
		$this->nroDoc=$nrodoc;
	}

	function setIdPlan($idplan){
		// primer valor seteado
		$this->idplan=$idplan;
	}


	/*function obtenerlibredeudaalumno($idalumno,$nrodoc){
		$libredeuda = array();

		/////////////////////////////////////////////////////
		// conexion webservice administracion
		$soapclient = new nusoap_client("http://192.168.2.194/personacuenta.php?wsdl");
		//$soapclient->setCredentials("root", "2012kvm401");
		
		// Obtener personas relacionadas a la facultad del usuario con perfil de facultad
		$personas = $soapclient->call('obtenerlibredeudaalumno', array( 'idalumno'=> $idalumno, 'nrodoc'=> $nrodoc));     
		
		$datospersona = unserialize(base64_decode($personas));
		if ($datospersona){
	  		foreach($datospersona as $libredeuda){
			
			}
		}
echo var_dump($libredeuda); die;
		return $libredeuda;
	}*/

	function wsobtenerlibredeudaalumno($idalumno,$nrodoc){
		$objeto = array();
		
		$link = mysql_connect("192.168.2.172","administracion","administracion911");
		
		mysql_select_db("bdadministracion",$link);
		mysql_query("SET NAMES 'utf8'");
		$result = mysql_query("SELECT t_cuentas_personas.libredeuda as fechalibredeuda FROM `t_cuentas_personas`,t_personas WHERE t_personas.id=t_cuentas_personas.idpersona and t_cuentas_personas.idalumno>0 and t_cuentas_personas.idalumno = ".$idalumno." and t_personas.ndoc='".$nrodoc."'" ,$link);
		$my_error = mysql_error($link);
	
		while($row = mysql_fetch_array($result))
			$objeto = $row;
	
		return base64_encode(serialize($objeto));
	}

	function obtenerlibredeudaalumno($idalumno,$nrodoc){
		$libredeuda = "";
		
		// Obtener personas relacionadas a la facultad del usuario con perfil de facultad
		$personas = $this->wsobtenerlibredeudaalumno($idalumno,$nrodoc);     
		
		$datospersona = unserialize(base64_decode($personas));
		if ($datospersona){
			foreach($datospersona as $libredeuda){
			}
		}

		return $libredeuda;
	}

	function wsobtenerestadoalumno($idalumno,$nrodoc){
		$objeto = array();
		     
		$link = mysql_connect("192.168.2.172","administracion","administracion911");

		mysql_select_db("bdadministracion".$link);
		mysql_query("SET NAMES 'utf8'");
		$result = mysql_query("SELECT tcp.libredeuda as fechalibredeuda,tcp.activo as activo,tcp.acreditabanco as acreditabanco,  tag.fechafin as fechafin, tcp.fin as fin, tcp.finhasta as finhasta, tcp.recursante as recursante, tcp.baja as baja, tp.numerodoc as numerodoc, tp.ndni as ndni FROM t_cuentas_personas tcp inner join t_personas tp on tp.id=tcp.idpersona left join t_anio_gracia tag on tag.idcuentapersona=tcp.id WHERE tcp.idalumno = ".$idalumno." and tp.ndoc='".$nrodoc."'" ,$link);
		$my_error = mysql_error($link);
	  
		while($row = mysql_fetch_array($result))
			$objeto = $row;

		return base64_encode(serialize($objeto));
	}

	function obtenerestadoalumno($idalumno,$nrodoc){
		$libredeuda = array();

		$personas = $this->wsobtenerestadoalumno($idalumno,$nrodoc); 

		$datospersona = unserialize(base64_decode($personas));

		if ($datospersona){
	  		foreach($datospersona as $libredeuda){
			}
		}
		return $libredeuda;

	}

	function wsobtenerpersonassegunfiltrosede($idn, $iddni,$sede){
		$objeto = array();

		$link = mysql_connect("192.168.2.172","administracion","administracion911");
		mysql_select_db("bdadministracion",$link);

		mysql_query("SET NAMES 'utf8'");
		
		// los id sede estan invertido en sistemas
		$sede1=$sede;
		//ROSARIO
		if($sede=='4') {$sede1='5';};
		//SANTA FE
		if($sede=='5') {$sede1='6';};
		//PARANA
		if($sede=='6') {$sede1='4';};

		$countsql = 0; // permite saber el estado de la consulta para saber como armarla
		//from t_personas, t_cuentas_personas, t_cuentas 
		$sql = "select distinct tp.*,tc.descripcion, tcp.id as idcp, tcp.idalumno as idalumno ";
		$sql.= "from t_cuentas_personas tcp inner join t_cuentas tc on tc.id=tcp.idcuenta inner join t_personas tp on tp.id=tcp.idpersona ";
		$sql.= " where tc.codcar <> '0' and tc.codcar <> 'M' and tc.codfac <> 'W' and tc.idsede=".$sede1." ";

		if (trim($idn) != "") {
			$sql.= " and nombre like '%".$idn."%' ";
			$countsql++;
		}
		if (trim($iddni) != "") {
			$sql.= " and ndoc like '%".$iddni."%' ";
			$countsql++;
		}

		$result = mysql_query( $sql ,$link) or die($sql."<br/><br/>".mysql_error());
		$my_error = mysql_error($link);

		while($row = mysql_fetch_array($result))
			$objeto[] = $row;
	  
		return base64_encode(serialize($objeto));
	}

	function obtenerpersonassegunfiltrosede($idn, $iddni,$sede){
		$datospersona = array();

		$personas = $this->wsobtenerpersonassegunfiltrosede($idn, $iddni,$sede); 

		$datospersona = unserialize(base64_decode($personas));

		return $datospersona;
	}

	function registrarIrregularidadAlumno($idalumno,$nrodoc,$idplan,$nombre,$usuario){
		/////////////////////////////////////////////////////
		// conexion webservice administracion
		$soapclient = new nusoap_client("http://localhost/personacuenta.php?wsdl");
		//$soapclient->setCredentials("root", "sistemas2009");
				
		// Obtener personas relacionadas a la facultad del usuario con perfil de facultad
		$personas = $soapclient->call('registrarirregularidadalumno', array( 'idalumno'=> $idalumno, 'nrodoc'=> $nrodoc, 'idplan'=> $idplan,'nombre'=> $nombre, 'usuario'=>$usuario));     
		
		$datospersona = unserialize(base64_decode($personas));
	}






	function obtenerlibredeudaalumnoporid($idalumno){
		$objeto = array();
		
		$link = mysql_connect("192.168.2.172","administracion","administracion911");
		
		mysql_select_db("bdadministracion",$link);
		mysql_query("SET NAMES 'utf8'");
		$result = mysql_query("SELECT t_cuentas_personas.libredeuda as fechalibredeuda FROM `t_cuentas_personas`,t_personas WHERE t_personas.id=t_cuentas_personas.idpersona and t_cuentas_personas.idalumno>0 and t_cuentas_personas.idalumno = ".$idalumno ,$link);
		$my_error = mysql_error($link);
	
		while($row = mysql_fetch_array($result))
			$objeto = $row;
	
		return base64_encode(serialize($objeto));
	}




	/*function obtenerlibredeudaalumno($idalumno,$nrodoc){
		$libredeuda = "";
		
		// Obtener personas relacionadas a la facultad del usuario con perfil de facultad
		$personas = $this->wsobtenerlibredeudaalumno($idalumno,$nrodoc);     
		
		$datospersona = unserialize(base64_decode($personas));
		if ($datospersona){
			foreach($datospersona as $libredeuda){
			}
		}

		return $libredeuda;
	}*/






}
?>
