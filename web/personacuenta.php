<?php
//control para uso del webservice solo por aprte del servidor de biblioteca ip interna
//if (!in_array(@$_SERVER['REMOTE_ADDR'], array('128.1.32.11', '::1')))
//{
// die('No se tiene acceso , verifique desde que servidor esta tratando de usarlo '.basename(__FILE__).' Para mas informacion.');
//} else {

require_once('nusoap.php'); 
 
$server = new nusoap_server;
 
$server->configureWSDL('server', 'urn:server');
 
$server->wsdl->schemaTargetNamespace = 'urn:server';

$server->register('obtenerpersona',
			array('value' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerlibredeuda',
			array('iddni' => 'xsd:string', 'idc' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerEstadoContable',
			array('idcuentapersona' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerDetallePlanesDePago',
			array('idcuentapersona' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerPlanesDePago',
			array('idcuentapersona' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');


$server->register('obtenerCursoActual',
			array('iddni' => 'xsd:string', 'idc' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerlibredeudacuenta',
			array('idcp' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');
 
$server->register('obtenercuentaspersona',
			array('value' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenercuentaspersonasede',
			array('idpersona' => 'xsd:string', 'sede' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerestadocuentaspersona',
			array('idpersona' => 'xsd:string', 'idcuenta' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerestadocuentaspersona1',
			array('idcp' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenercuentaspersonanoactivas',
			array('value' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');


$server->register('personassegunfiltro',
			array('idn' => 'xsd:string', 'iddni' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('personassegunfiltrosede',
			array('idn' => 'xsd:string', 'iddni' => 'xsd:string', 'sede' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('personasnoactivassegunfiltro',
			array('idn' => 'xsd:string', 'iddni' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('personasaniograciasegunfiltro',
			array('idn' => 'xsd:string', 'iddni' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');


$server->register('obtenerlibredeudaalumno',
			array('idalumno' => 'xsd:string','nrodoc' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenerestadoalumno',
			array('idalumno' => 'xsd:string','nrodoc' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('registrarirregularidadalumno',
			array('idalumno' => 'xsd:string','nrodoc' => 'xsd:string','idplan' => 'xsd:string','nombre' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('bajaalumno',
			array('idalumno' => 'xsd:string','nrodoc' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');

$server->register('obtenercursoaniograciaalumno',
			array('idalumno' => 'xsd:string','nrodoc' => 'xsd:string'),
			array('return' => 'xsd:string'),
			'urn:server',
			'urn:server#concatenarServer');


function obtenerpersona($dni){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT * FROM `t_personas` WHERE ndoc = '".$dni."'" ,$link);
         $my_error = mysql_error($link);

  
          while($row = mysql_fetch_array($result))
	     $objeto = $row;
        

        return base64_encode(serialize($objeto));
}

      
function obtenerlibredeuda($dni, $idcuenta){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tcp.libredeuda FROM t_personas tp INNER JOIN t_cuentas_personas tcp ON tp.id = tcp.idPersona INNER JOIN t_cuentas tc on tcp.idCuenta = tc.id where tp.ndoc = '".$dni."' and tc.idCarrera = '".$idcuenta."'" ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}


function obtenerEstadoContable($idcuentapersona){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tcp.libredeuda, tcp.acreditaenbanco, tcp.baja, tcp.activo, tag.fechainicio, tag.fechafin, tag.curso, tag.agotado  FROM t_personas tp INNER JOIN t_cuentas_personas tcp ON tp.id = tcp.idPersona INNER JOIN t_cuentas tc on tcp.idCuenta = tc.id left join t_anio_gracia tag on t_anio_gracia.idCuentaPersona=tcp.idCuentaPersona where tcp.idcuentapersona = ".$idcuentapersona ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}

function obtenerAnioGracia($idcuentapersona){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tag.fechainicio, tag.fechafin, tag.curso, tag.agotado  FROM t_anio_gracia tag where tag.idcuentapersona = ".$idcuentapersona ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}


function obtenerPlanesDePago($idcuentapersona){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tpp.montototal, tpp.cantidadcuotas, tpp.fechainicio , ttp.descripcion FROM t_planespagos tpp INNER JOIN t_tiposplanes ttp ON ttp.id=tpp.idtipoplan where tpp.idcuentapersona = ".$idcuentapersona ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}

function obtenerDetallePlanesDePago($idcuentapersona){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tdpp.fecpago, tdpp.fecvto, tdpp.concepto, tdpp.monto, tdpp.debitado, tdpp.idPlanesPago FROM t_detalleplanespagos tdpp  where tdpp.idcuentapersona = ".$idcuentapersona." order by idplanespago, fecvto" ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}

function obtenerCursoActual($dni, $idcuenta){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tcp.cursoactual FROM t_personas tp INNER JOIN t_cuentas_personas tcp ON tp.id = tcp.idPersona INNER JOIN t_cuentas tc on tcp.idCuenta = tc.id where tp.ndoc = '".$dni."' and tc.idCarrera = '".$idcuenta."'" ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}


function obtenerlibredeudacuenta($idcp){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT libredeuda FROM t_cuentas_personas where id = '".$idcp."'" ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $valor = $row[0];
  
          return $valor;
 
}

 
function obtenercuentaspersona($idpersona){
         
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tc.descripcion, tc.codcar, tcp.codalu, SUM(debe)-SUM(haber) as saldo,tcp.libredeuda, tcp.baja, tcp.activo FROM `t_cuentas_personas` tcp inner join `t_cuentas` tc on tcp.idCuenta = tc.id inner join `t_ctacte` tcte on tc.id = tcte.idCuentaPersona WHERE tc.codfac <> 'W1' and tc.codcar <> 'M' and tcp.idpersona = ".$idpersona." group by tc.id " ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;


         return base64_encode(serialize($arrObjeto));
}


function obtenercuentaspersonasede($idpersona, $sede){

                  // los id sede estan invertido en sistemas
	//ROSARIO
	$sede1=$sede;

	if($sede=='4') {$sede1='5';};
	//SANTA FE
	if($sede=='5') {$sede1='6';};
	//PARANA
	if($sede=='6') {$sede1='4';};
	
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tc.descripcion, tc.codcar, tcp.codalu, SUM(debe)-SUM(haber) as saldo,tcp.libredeuda, tcp.baja, tcp.activo FROM `t_ctacte` tcte inner join `t_cuentas_personas` tcp on tcp.id=tcte.idcuentapersona inner join `t_cuentas` tc on tcp.idCuenta = tc.id  WHERE tc.codcar <> 'M' and tc.codfac <> 'W' and tc.idSede='.$sede1.' and tcp.idpersona = ".$idpersona." group by tc.id " ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;


         return base64_encode(serialize($arrObjeto));
}


function obtenerestadocuentaspersona($idpersona, $idcuenta){

                  // los id sede estan invertido en sistemas

	
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tc.descripcion, tc.codcar,tc.codfac cf, tcp.codalu, SUM(debe)-SUM(haber) as saldo,tcp.libredeuda, tcp.baja, tcp.activo FROM `t_cuentas_personas` tcp inner join `t_cuentas` tc on tcp.idCuenta = tc.id inner join `t_ctacte` tcte on tc.id = tcte.idCuentaPersona WHERE tc.codcar <> 'M' and tc.codfac <> 'W' and tc.idsede>0 and tc.id='.$idcuenta.' and tcp.idpersona = ".$idpersona." group by tc.id " ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;


         return base64_encode(serialize($arrObjeto));
}



function obtenerestadocuentaspersona1($idcp){

                  // los id sede estan invertido en sistemas

	
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT distinct tc.descripcion, tc.codcar, tcp.codalu, tcp.libredeuda, tcp.baja, tcp.activo , tp.nombre as nombrepersona FROM t_personas tp inner join t_cuentas_personas tcp on tp.id=tcp.idpersona inner join t_cuentas tc on tcp.idcuenta = tc.id inner join t_ctacte tcc on tcp.id = tcc.idcuentapersona WHERE tcp.id = ".$idcp ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;


         return base64_encode(serialize($arrObjeto));
}

function obtenercuentaspersonanoactivas($idpersona){
         
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tc.descripcion, tc.codcar, tcp.codalu, SUM(debe)-SUM(haber) as saldo,tcp.libredeuda, tcp.baja, tcp.activo,tcp.finhasta FROM `t_cuentas_personas` tcp inner join `t_cuentas` tc on tcp.idCuenta = tc.id inner join `t_ctacte` tcte on tc.id = tcte.idCuentaPersona WHERE tc.codcar <> 'M' and tcp.idpersona = ".$idpersona." group by tc.id " ,$link);
         $my_error = mysql_error($link);
  
          while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;


         return base64_encode(serialize($arrObjeto));
}

function personassegunfiltro($idn, $iddni){
         
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         
         $countsql = 0; // permite saber el estado de la consulta para saber como armarla
         
         $sql = "select distinct t_personas.*,t_cuentas.descripcion from t_personas, t_cuentas_personas, t_cuentas ";

         $sql.= " where t_cuentas_personas.activo=1 and t_personas.id=t_cuentas_personas.idPersona and t_cuentas.id=t_cuentas_personas.idCuenta and t_cuentas.codcar <> '0' ";

         //, t_cuentas_personas, t_cuentas
         if (trim($idn) != "") {
             $sql.= " and nombre like '%".$idn."%' ";
             $countsql++;
         }
          if (trim($iddni) != "") {
             $sql.= " and ndoc like '%".$iddni."%' ";
             $countsql++;
         }


         $result = mysql_query( $sql ,$link);
         $my_error = mysql_error($link);
  
	while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;
  
        return base64_encode(serialize($arrObjeto));
}

function personassegunfiltrosede($idn, $iddni,$sede){
         //$sede=1;
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
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
         $sql = "select distinct tp.*,tc.descripcion, tcp.id as idcp ";

         $sql.= "from t_cuentas_personas tcp inner join t_cuentas tc on tc.id=tcp.idcuenta inner join t_personas tp on tp.id=tcp.idpersona ";
         $sql.= " where tc.codcar <> '0' and tc.codcar <> 'M' and tc.codfac <> 'W' and tc.idsede=".$sede1." ";
	//tcp.activo=1 and

         if (trim($idn) != "") {
             $sql.= " and nombre like '%".$idn."%' ";
             $countsql++;
         }
          if (trim($iddni) != "") {
             $sql.= " and ndoc like '%".$iddni."%' ";
             $countsql++;
         }


         $result = mysql_query( $sql ,$link);
         $my_error = mysql_error($link);
  
	while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;
  
        return base64_encode(serialize($arrObjeto));
}


function personasnoactivassegunfiltro($idn, $iddni){
         
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         
         $countsql = 0; // permite saber el estado de la consulta para saber como armarla
         
         $sql = "select distinct t_personas.*,t_cuentas.descripcion,t_cuentas_personas.finhasta from t_personas, t_cuentas_personas, t_cuentas ";
         if (trim($idn) != "") {
             $sql.= " where t_cuentas_personas.activo=0 and t_personas.id=t_cuentas_personas.idPersona and t_cuentas.id=t_cuentas_personas.idCuenta and t_cuentas.codcar <> '0' and nombre like '%".$idn."%' and t_cuentas_personas.finhasta>=NOW()";
             $countsql++;
         }
 
         if (trim($iddni) != "") {
             if ($countsql>0)
                 $sql.= " and ndoc like '%".$iddni."%'";
             else
                 $sql.= "  where ndoc like '%".$iddni."%'";
             $countsql++;
         }

         $result = mysql_query( $sql ,$link);
         $my_error = mysql_error($link);
  
	while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;
  
        return base64_encode(serialize($arrObjeto));
}




function personasaniograciasegunfiltro($idn, $iddni){
         
         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         
         $countsql = 0; // permite saber el estado de la consulta para saber como armarla
         
         $sql = "select distinct t_personas.*,t_cuentas.descripcion,t_cuentas_personas.finhasta from t_personas, t_cuentas_personas, t_cuentas, t_anio_gracia ";
         if (trim($idn) != "") {
             $sql.= " where (t_anio_gracia.fechafin>=NOW()) and t_personas.id=t_cuentas_personas.idPersona and t_cuentas.id=t_cuentas_personas.idCuenta and t_cuentas.codcar <> '0' and nombre like '%".$idn."%' and t_cuentas_personas.finhasta>=NOW()";
             $countsql++;
         }
 
         if (trim($iddni) != "") {
             if ($countsql>0)
                 $sql.= " and ndoc like '%".$iddni."%'";
             else
                 $sql.= "  where ndoc like '%".$iddni."%'";
             $countsql++;
         }

         $result = mysql_query( $sql ,$link);
         $my_error = mysql_error($link);
  
	while($row = mysql_fetch_array($result))
	     $arrObjeto[] = $row;
  
        return base64_encode(serialize($arrObjeto));
}


function obtenerlibredeudaalumno($idalumno,$nrodoc){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT t_cuentas_personas.libredeuda as fechalibredeuda FROM `t_cuentas_personas`,t_personas WHERE t_personas.id=t_cuentas_personas.idpersona and t_cuentas_personas.idalumno>0 and t_cuentas_personas.idalumno = ".$idalumno." and t_personas.ndoc='".$nrodoc."'" ,$link);
         $my_error = mysql_error($link);

  
          while($row = mysql_fetch_array($result))
	     $objeto = $row;


         return base64_encode(serialize($objeto));
}


function obtenerestadoalumno($idalumno,$nrodoc){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT tcp.libredeuda as fechalibredeuda,tcp.activo as activo,tcp.acreditabanco as acreditabanco,  tag.fechafin as fechafin, tcp.fin as fin, tcp.finhasta as finhasta, tcp.recursante as recursante, tcp.baja as baja, tp.numerodoc as numerodoc, tp.ndni as ndni FROM t_cuentas_personas tcp inner join t_personas tp on tp.id=tcp.idpersona left join t_anio_gracia tag on tag.idcuentapersona=tcp.id WHERE tcp.idalumno = ".$idalumno." and tp.ndoc='".$nrodoc."'" ,$link);
         $my_error = mysql_error($link);

  
          while($row = mysql_fetch_array($result))
	     $objeto = $row;


         return base64_encode(serialize($objeto));
}
function registrarirregularidadalumno($idalumno,$nrodoc,$idplan,$nombre,$usuario){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("INSERT INTO t_libredeuda_alumnos set idalumno=".$idalumno." , nrodoc='".$nrodoc."', idplan=".$idplan.", nombre='".$nombre."' , fecha=NOW(), usuario='".$usuario."'" ,$link);
         $my_error = mysql_error($link);

  
          while($row = mysql_fetch_array($result))
	     $objeto = $row;


         return base64_encode(serialize($objeto));
}

function bajaalumno($idalumno,$dni){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("update `t_cuentas_personas` set activo=0, baja=1 WHERE idalumno=".$idalumno." and ndoc = '".$dni."'" ,$link);
         $my_error = mysql_error($link);

  
          while($row = mysql_fetch_array($result))
	     $objeto = $row;
        

        return base64_encode(serialize($objeto));
}


function obtenercursoaniograciaalumno($idalumno,$nrodoc){

         $link = mysql_connect("192.168.2.172","administracion","administracion911");
         mysql_select_db("bdadministracion".$link);
         mysql_query("SET NAMES 'utf8'");
         $result = mysql_query("SELECT t_anio_gracia.curso as cursohabilitado FROM t_anio_gracia,t_cuentas_personas WHERE t_anio_gracia.idcuentapersona=t_cuentas_personas.id and t_cuentas_personas.idalumno = ".$idalumno." and t_personas.ndoc='".$nrodoc."' and t_anio_gracia.fechainicio<=NOW() and t_anio_gracia.fechafin>=NOW()" ,$link);
         $my_error = mysql_error($link);

  
          while($row = mysql_fetch_array($result))
	     $objeto = $row;


         return base64_encode(serialize($objeto));
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
 
$server->service($HTTP_RAW_POST_DATA);

//}
?>

           



