<?php

class StrategyArchivo 
{
  private $_strategy;
  private $_codigo;
  
  public function __construct( $codStrategy )
  {
     $this->_strategy="";
     try{
	 switch ($codStrategy)
         {
          
  	    case "1":
	       $this->_strategy = new StrategyOne();
			break;
	    case "2":
	       $this->_strategy = new StrategyTwo();
			break; 
         } 
	 
     } catch (Exception $e) {
	    throw new Exception(); 
     }
  }
  


  public function getControlActivo($ciclo,$idAlumno)
  {
                $this->planes= array();
                $plan_estudio='';

		$this->ciclolectivo = Doctrine_Core::getTable('InscripcionesCicloLectivo')
			->createQuery('a')
            ->where('idciclolectivo  = ?' , $ciclo)
			->andWhere('idalumno = ?' , $idAlumno)
			->execute();

		if(count($this->ciclolectivo)!=0) {
            return true;
		} else {
			return false;
        }
   }



  public function getIdCicloLectivoActual()
  {

      $this->ciclolectivo = Doctrine_Core::getTable('CicloLectivo')
					->createQuery('a')
					->where('inicio < ?' , date("Y-m-d"))
					->andWhere('fin > ?' , date("Y-m-d"))
					->execute();	
				if(count($this->ciclolectivo)==0){

					return 0;

				}else{

                                       // en caso de encontrarse el ciclo lectivo, se lo busca
                                       foreach ($this->ciclolectivo as $ciclo_lectivo){ $ciclo=$ciclo_lectivo->getId(); }
					return $ciclo;
                                }
}














  // Propiedades
  public function getEncabezado($pFechaPresentacion, $cantRegistros, $pImporteT)
  {
   return $this->_strategy->getEncabezado($pFechaPresentacion, $cantRegistros, $pImporteT);
  }
  public function getLinea($pPartida, $pCbu, $pFechaVenc, $pImporte, $pIdCuenta, $pNombrePer)
  {
     return $this->_strategy->getLinea($pPartida, $pCbu, $pFechaVenc, $pImporte, $pIdCuenta, $pNombrePer);
  }

  public function getPie()
  {
     return $this->_strategy->getPie();
  }

}

// Diferentes clases con su estrategia para redefinir informacion a reportar a entes

//-- Estrategia Uno
class StrategyOne 
{
  private $_codigo;

  public function __construct( ) {
  }
  


  // Propiedades:
  // partida: es el codigo de alumno formado por codF + codC + codAl
  public function getLinea($pPartida, $pCbu, $pFechaVenc, $pImporte, $pIdCuenta, $pNombrePer)
  {
         // falta redondeo del Importe, no deberia salir el punto
         
         $tipoRegistro = "11";
         $partida=$pPartida;  
         
         $long = 22 - strlen($partida);
	 $partida = $partida.str_repeat(" ", $long); 
         $cbu = $pCbu;
         
         $long2 = 15 - strlen($pIdCuenta);
	 $idCuenta = str_repeat("0", $long2).$pIdCuenta; 

         if (strlen($pNombrePer)>30)
            $pNombrePer = substr($pNombrePer, 0, 29);

         $long3 = 30 - strlen($pNombrePer);
	 $nombrePersona = $pNombrePer.str_repeat(" ", $long3); 
         
         $pImporte = $pImporte * 100;
         $long4 = 16 - strlen($pImporte);
	 $importe = str_repeat("0", $long4).$pImporte; 
           
         $filler = " ";

         $linea = $tipoRegistro.$partida.$cbu.$pFechaVenc.$importe.$idCuenta.$nombrePersona.$filler;  	 

         return $linea;
  }

  public function getEncabezado( $pFechaPresentacion, $pCantRegistros, $pImporteT)
  {
         $tipoRegistro = "10";
         $fechapresentacion = $pFechaPresentacion;
         
         $long = 5 - strlen($pCantRegistros);
         $cantRegistros = str_repeat("0", $long).$pCantRegistros;
         
         $pImporteT = $pImporteT * 100; 
         $long2 = 19 - strlen($pImporteT);
         $importeTotal = str_repeat("0", $long2).$pImporteT;
         
         $encabezado =  $tipoRegistro.$fechapresentacion.$cantRegistros.$importeTotal;
        
         return $encabezado;  

 
  }
 

  public function getPie()
  {
       
         return "";  

  }

}










//-- Estrategia Dos para enviar directo al banco
class StrategyTwo 
{
  private $_codigo;

  public function __construct( ) {
  }
  
 // Propiedades:
  // partida: es el codigo de alumno formado por codF + codC + codAl



  public function getLinea($pPartida, $pCbu, $pFechaVenc, $pImporte, $pIdCuenta, $pNombrePer, $pFechaPres="")
  {

/*

ESTE ES EL FORMATO PARA SALTAR EL ADDI

CUIT UCU    - 11 - 30530917696
DESCRIP     - 10 - ARANCEL
SUCURSAL    -  3 - 370
FIJO        -  7 - 0000072  
FIJO        -  5 - 00010

INICIO CBU  -  7 - 0720312
AGREGADO    -  3 - 000
ULTIMOS CBU - 14 - 88000032110986      IMPORTANTE (EL NUMERO INTERNO DEL CBU SE AGREGA EN OTRO LUGAR)

CODALU      -  7 - TA01212
29 ESPACIOS EN BLANCO
NRO INT CBU -  1 - 9                            <--- NUMERO INTERNO DEL CBU
FECHA BARRID-  8 - 20100218
45 ESPACIOS EN BLANCO
MONTO      -  16 - 0000000000056200
ID MONTO   -  15 - 000000000000015   (POR CADA VALOR DISTINTO DE MONTO SE GENERA UN ID)
223 ESPACIOS EN BLANCO
FECHA PRESE-   8 - 20100205
FIJO           4 - 1000
62 ESPACIOS EN BLANCO
NOM INSTITUCION -  16 - ASOCIACION EDUCA
83 ESPACIOS EN BLANCO
FECHA PRESENTAC - 8 - 20100205
VALOR FIJO hora presentacion     - 6 - 030235
8 ESPACIOS EN BLANCO

*/
         // falta redondeo del Importe, no deberia salir el punto

//$pPartida, $pCbu, $pFechaVenc, $pImporte, $pIdCuenta, $pNombrePer

	$ciutucu='30530917696';
	$descucu='ARANCEL   ';
	$sucursal='370';
	$fijo1='0000072';
	$fijo2='00010';
	$iniciocbu=substr($pCbu,0,7);//7
	$agregadocbu='000';
	$finalcbu= substr($pCbu,8,14); //14


	//$codalu=$pPartida;//7
	$codalu=str_pad($pPartida, 7, "0", STR_PAD_LEFT);
	$espacios=str_repeat(" ", 30);
	$nrointernocbu=substr($pCbu,7,1); //1
	$fechabarrida='20101111'; //8
	$espacios1=str_repeat(" ", 45); //45
	//$monto='0000000000009999'; //16 y tener en cuenta 2 decimales
	$monto=$pImporte; //16 y tener en cuenta 2 decimales

	//$idmonto='000000000000001'; // por cada variante de monto se genera un numero
	$importe=substr($pImporte,5);
	$idmonto=str_pad($importe, 15, "0", STR_PAD_LEFT);

	$espacios2=str_repeat(" ", 223); //223
	$fechapresent='20100504'; //8
	$fijo3='1000';
	$espacios3=str_repeat(" ", 62);// 62
	$institucion='ASOCIACION EDUCA';
	$espacios4=str_repeat(" ", 83); // 83
	
	$fechapresentacion=$pFechaPres!= '' ? $pFechaPres: date('Ymd'); //8
	$horapresentacion='090000'; //6  la hora de presentacion la mantenemos fija a las 9AM
	$espacios5=str_repeat(" ", 8); // 8


	 $linea1 = $ciutucu.$descucu.$sucursal.$fijo1.$fijo2.$iniciocbu.$agregadocbu.$finalcbu.$codalu.$espacios.$nrointernocbu.$fechabarrida.$espacios1;
         $linea2=$monto.$idmonto.$espacios2.$fechapresent.$fijo3.$espacios3.$institucion.$espacios4.$fechapresentacion.$horapresentacion.$espacios5;

         $linea = $linea1.$linea2;

         return $linea;
  }





  public function getEncabezado( $pFechaPresentacion, $pCantRegistros, $pImporteT)
  {
         return "";  

 
  }

  public function getPie()
  {
       
         return "";  

  }

}
?>
