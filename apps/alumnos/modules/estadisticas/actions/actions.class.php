<?php

/**
 * estadisticas actions.
 *
 * @package    sig
 * @subpackage estadisticas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadisticasActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	
  public function executePromediosxcarrera(sfWebRequest $request)
  {
  	$this->carreras = array();
  	
  	$idarea = sfContext::getInstance()->getUser()->getAttribute('id_area',''); 
  	$carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($idarea);
	foreach($carreras as $carrera){
		$this->carreras[$carrera->getIdcarrera()] = $carrera->getNombrereducido(); 
	}

    if ($request->isMethod(sfRequest::POST)){

    	$this->resultado = array();
    	
	    $aDesde1 =  explode("-", $request->getParameter('fecha-desde1')); 
	    $aHasta1 =  explode("-", $request->getParameter('fecha-hasta1')); 
	    $aDesde2 =  explode("-", $request->getParameter('fecha-desde2')); 
	    $aHasta2 =  explode("-", $request->getParameter('fecha-hasta2')); 

	    $desde1 = $aDesde1[2]."-".$aDesde1[1]."-".$aDesde1[0]; 
	    $hasta1 = $aHasta1[2]."-".$aHasta1[1]."-".$aHasta1[0]; 
	    $desde2 = $aDesde2[2]."-".$aDesde2[1]."-".$aDesde2[0];  
	    $hasta2 = $aHasta2[2]."-".$aHasta2[1]."-".$aHasta2[0]; 
        $idcarrera = $request->getParameter('idcarrera');
        $ausentes = $request->getParameter('ausentes');
 		$desaprobados = $request->getParameter('desaprobados');

		$oEstadistica = new Estadisticas();
    	    
		// Obtener estadisticas de nuevos incriptos por lugar de procedencia
		$resultadoPrimerPeriodo = $oEstadistica->obtenerPromediosPorCarrera($desde1, $hasta1, $idcarrera, $ausentes, $desaprobados);
		$resultadoSegundoPeriodo = $oEstadistica->obtenerPromediosPorCarrera($desde2, $hasta2, $idcarrera, $ausentes, $desaprobados);
		
		$i = 1;
		foreach ($resultadoPrimerPeriodo as $key => $value){
			//echo " FFFF ".$key." - ".$resultadoSegundoPeriodo[$key]['promedio'];
    		$this->resultado[$i]['curso'] = $value['curso'];
    		$this->resultado[$i]['nombre'] = $value['nombre'];
    		$this->resultado[$i]['promedioprimerperiodo'] = $value['promedio'];
    		$this->resultado[$i]['promediosegundoperiodo'] = $resultadoSegundoPeriodo[$key]['promedio'];
    		$i++;
    	}
    	$this->primerperiodo = "Desde ".$desde1." hasta ".$hasta1;
    	$this->segundoperiodo = "Desde ".$desde2." hasta ".$hasta2;    	
    }
    //$this->periodoi =  " de ".$request->getParameter('datepicker')." a ".$request->getParameter('datepickerii'); 
	//$this->periodof =  " de ".$request->getParameter('datepickeriii')." a ".$request->getParameter('datepickeriv'); 
  }
  	
  public function executeAspirantes(sfWebRequest $request)
  {
    $this->tiposcarreras = Doctrine_Core::getTable('TiposCarreras')
      ->createQuery('a')
      ->execute(); 

    $idTiposCarreras = "";

    if ($request->isMethod(sfRequest::POST)){

	    $aDesde1 =  explode("-", $request->getParameter('datepicker')); 
	    $aHasta1 =  explode("-", $request->getParameter('datepickerii')); 
	    $aDesde2 =  explode("-", $request->getParameter('datepickeriii')); 
	    $aHasta2 =  explode("-", $request->getParameter('datepickeriv')); 

	    $desde1 = $aDesde1[2]."-".$aDesde1[1]."-".$aDesde1[0]; 
	    $hasta1 = $aHasta1[2]."-".$aHasta1[1]."-".$aHasta1[0]; 
	    $desde2 = $aDesde2[2]."-".$aDesde2[1]."-".$aDesde2[0];  
	    $hasta2 = $aHasta2[2]."-".$aHasta2[1]."-".$aHasta2[0]; 
        $idsede=$this->getUser()->getProfile()->getIdarea();

		$oEstadistica = new Estadisticas();

		if($request->getParameter('idtipocarrera')<>"") {	

			// Obtiene los idtipocarrera seleccionados
    		foreach($request->getParameter('idtipocarrera') as $datos){
      			$idTiposCarreras .= $datos.",";
    		} 
    		$this->idtipocarr = substr($idTiposCarreras,0, strlen($idTiposCarreras)-1);	
    		$arr=explode(",",$this->idtipocarr);

    	    // Obtener informacion de carreras seleccionadas
    		$dato = Doctrine_Query::create()->from('TiposCarreras tc')->whereIn('tc.idtipocarrera', $arr[0])->execute();
    		foreach($dato as $info){
    			$this->carreraseleccionada .= $info.", ";
    		} 

    		$this->carreraseleccionada = substr($this->carreraseleccionada,0,strlen($this->carreraseleccionada)-1);	
      	     
           // Obtener estadisticas de nuevos incriptos por lugar de procedencia
			$this->resultado = $oEstadistica->obtenerAspirantesPeriodo($desde1, $hasta1, $desde2, $hasta2, $idsede,$this->idtipocarr);
     
      		// Obtener estadisticas por facutlad
    		$this->rFacultades = $oEstadistica->obtenerAspirantesPeriodoGroupFacultad($desde1, $hasta1, $desde2, $hasta2, $idsede,$this->idtipocarr);

    		// Obtener estadisticas por sede/facutlad
    		$this->rSedefacultad = $oEstadistica->obtenerAspirantesPeriodoGroupSedeFacultad($desde1, $hasta1, $desde2, $hasta2, $idsede,$this->idtipocarr);

    		// Obtener estadisticas por sede
    		$this->rSedes = $oEstadistica->obtenerAspirantesPeriodoGroupSede($desde1, $hasta1, $desde2, $hasta2, $idsede,$this->idtipocarr);
    
    		// Obtener estadisticas totales
   			$this->rTotales = $oEstadistica->obtenerAspirantesPeriodoGroupTotal($desde1, $hasta1, $desde2, $hasta2, $idsede,$this->idtipocarr);
    }

    $this->periodoi =  " de ".$request->getParameter('datepicker')." a ".$request->getParameter('datepickerii') ; 
	$this->periodof =  " de ".$request->getParameter('datepickeriii')." a ".$request->getParameter('datepickeriv') ; 
	
   }
  }
  
 public function executeNixcarrera(sfWebRequest $request)
  {
	   if ($request->isMethod(sfRequest::POST)){
	              
	       // Convertir fechas para consulta
		    $aAnio =  $request->getParameter('seleccionar') ; 
		    
		    $oEstadistica = new Estadisticas();
		    
		  // Obtener estadisticas de nuevos incriptos por lugar de procedencia
	      	$resultado = $oEstadistica->nixciudadorigen('1', $request->getParameter('seleccionar'));
	      	
	      //Creamos el archivo temporal de exportación
		   $file = 'inscriptos'.$aAnio.'.csv';
	       $fh = fopen($file,"w+") or die ("unable to open file");
	       
	       $titulo = "Id, Ciudad, Cantidad , \n";
	       fwrite($fh,$titulo);
	       
	       foreach($resultado as $datos){
	            //Cabecera - Cambienla por sus necesidades
	             $row = $datos["idciudadnac"].",".$datos["descripcion"].",".$datos["anioactual"].","."\n";
	             fwrite($fh,$row); 
	       }
	          
	    // Close file            
	       fclose($fh);  
	              
	       header("Content-Type: application/vnd.ms-excel");
	       header("Content-Type: application/force-download");
	       header("Content-Transfer-Encoding: binary");
	       header("Content-Disposition: attachment;filename=".$file );
	       header("Content-Length: ".filesize($file));
	       header("Pragma: no-cache");
	       header("Expires: 0");
	       readfile($file);
	       
	       return sfView::NONE;      
	  
	   } else {
	   	
	      $anioactual = date ("Y"); 
  	 
  	      $this->aAnios =  array($anioactual + 1,
	  	                        $anioactual,
	  	 			    		$anioactual-1,
	  	 						$anioactual-2,
	  	 						$anioactual-3,
	  	 						$anioactual-4,
	  	 						$anioactual-5,
	  	 						$anioactual-6,
	  	 						$anioactual-7,
	  	 						$anioactual-8,
	  	 						$anioactual-9,
	  	 						$anioactual-10);
	   }
  }

  public function executeObtenermemoria(sfWebRequest $request)
  {
    /*  $idarea = sfContext::getInstance()->getUser()->getAttribute('id_area','');
     
      $facultades = Doctrine_Core::getTable('Facultades')->obtenerFacultadesPorArea($idarea);
    
     // Obtener facultad relacionada al area // debe ser una facultad
      foreach($facultades as $facultad){
          if ($idfacultad==''){
            $idfacultad= $facultad['idfacultad'];
            $nombrefacultad = $facultad['nombre'];
          } 
      } */

      // solo usuarios de sede central pueden elevar designaciones
      /*if(sfContext::getInstance()->getUser()->getAttribute('id_sede','')<>'1'){
          $this->msgError = 'El usuario actual no está habilitado para imprimir este listado!!';
          $this->resultado ='';
      }
     
      // Obtener Sedes
      $this->sedes = Doctrine_Core::getTable('Sedes')->findAll();

      
      $this->idsede = $idsede;*/
     
  }

  public function executeMemoria(sfWebRequest $request)
  {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load("exceltemplates/AnexoMemoria.xls");

        $CICLO = $request->getParameter('idanio');// por ahora harcodeado, se tiene que pedir este valor

        ini_set('max_execution_time', 123456);

      
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Diego Sposito")
                       ->setLastModifiedBy("Diego Sposito")
                       ->setTitle("PHPExcel Document")
                       ->setSubject("PHPExcel Document")
                       ->setDescription("PHPExcel, generated using PHP classes.")
                       ->setKeywords("office PHPExcel php")
                       ->setCategory("Generate Excel Report");
        
        // obtener informacion empleados, pestaña 1 del Excel
        $empleados = Doctrine_Core::getTable('Empleados')->obtenerEmpleadosActivos();

        // obtener informacion ofertas academicas, pestaña 2 del Excel
        $oferta_academica = Doctrine_Core::getTable('PlanesEstudios')->obtenerOfertaAcademica();

        // obtener informacion Anexo 3, estadisticas de profesores
        $anexo3 = Doctrine_Core::getTable('Designaciones')->estadisticasDesignaciones($CICLO); 

        // obtener informacion Anexo 3 b, estadisticas de profesores
        $anexo3b = Doctrine_Core::getTable('Designaciones')->estadisticasDesignacionesDetalladas($CICLO); 
        
        // obtener informacion ofertas academicas, NI, RI, EG, TOTAL para anexo 8
        $anexo8 = Doctrine_Core::getTable('PlanesEstudios')->obtenerInformacionMemoriaAnexo8($CICLO); 


        $objPHPExcel->getSheet(0)->setCellValue('C5', Doctrine_Core::getTable('Empleados')->obtenerEmpleadosActivosCantidad());

        // Llenar primera hoja
        $objPHPExcel->getSheet(0)->setCellValue('D1', 'MEMORIA AÑO : '.$CICLO);

        $row = 3;
        foreach($empleados as $empleado) {
          $row++;
          $objPHPExcel->getSheet(0)->insertNewRowBefore($row,1);

          $objPHPExcel->getSheet(0)->setCellValue('B'.$row, $empleado['uacademica'])
                                        ->setCellValue('C'.$row, $empleado['empleado'])
                                        ->setCellValue('D'.$row, $empleado['sexo'])
                                        ->setCellValue('E'.$row, $empleado['edad'])
                                        ->setCellValue('F'.$row, $empleado['cargo'])
                                        ->setCellValue('G'.$row, $empleado['nivel_educativo'])
                                        ->setCellValue('H'.$row, $empleado['titulo']);
        }

        // Llenar segunda hoja
        $objPHPExcel->getSheet(1)->setCellValue('E1', 'MEMORIA AÑO : '.$CICLO);

        $row = 3;
        foreach($oferta_academica as $oa) {
          $row++;
          $objPHPExcel->getSheet(1)->insertNewRowBefore($row,1);

          $objPHPExcel->getSheet(1)->setCellValue('B'.$row, $oa['uacademica'])
                                        ->setCellValue('C'.$row, $oa['carrera'])
                                        ->setCellValue('D'.$row, $oa['titulo'])
                                        ->setCellValue('E'.$row, $oa['nivel'])
                                        ->setCellValue('F'.$row, $oa['modalidad'])
                                        ->setCellValue('G'.$row, $oa['resolucionhcdcsu'])
                                        ->setCellValue('H'.$row, $oa['resolucionministerial'])
                                        ->setCellValue('I'.$row, $oa['resolucionconeau'])
                                        ->setCellValue('J'.$row, $oa['inicio'])
                                        ->setCellValue('K'.$row, $oa['planestudio'])
                                        ->setCellValue('L'.$row, $oa['horas']);
        }

        // Llenar hoja3
        $objPHPExcel->getSheet(2)->setCellValue('E1', 'MEMORIA AÑO : '.$CICLO);

        $row = 5;
        foreach($anexo3  as $oa) {
          $row++;
          $objPHPExcel->getSheet(2)->insertNewRowBefore($row,1);

          $objPHPExcel->getSheet(2)->setCellValue('B'.$row, $oa['Sede'])
                                        ->setCellValue('C'.$row, $oa['Carrera'])
                                        ->setCellValue('E'.$row, $oa['total'])
                                        ->setCellValue('F'.$row, $oa['varones'])
                                        ->setCellValue('G'.$row, $oa['mujeres'])
                                        ->setCellValue('H'.$row, $oa['NivelESecundario'])
                                        ->setCellValue('I'.$row, $oa['NivelETerciario'])
                                        ->setCellValue('J'.$row, $oa['NivelEUnivesitarioPreGr'])
                                        ->setCellValue('K'.$row, $oa['NivelEUniversitarioGr'])
                                        ->setCellValue('L'.$row, $oa['NivelEEspecializacion'])
                                        ->setCellValue('M'.$row, $oa['NivelEMaestria'])
                                        ->setCellValue('N'.$row, $oa['NivelEDoctorado'])
                                        ->setCellValue('S'.$row, $oa['Profesor_Titular'])
                                        ->setCellValue('T'.$row, $oa['Profesor_Asociado'])
                                        ->setCellValue('U'.$row, $oa['Profesor_Adjunto'])
                                        ->setCellValue('V'.$row, $oa['JTP'])
                                        ->setCellValue('W'.$row, $oa['Auxiliar_Docente'])
                                        ->setCellValue('X'.$row, $oa['Ayudante_Alumno'])
                                        ->setCellValue('Y'.$row, $oa['Ayudante_Diplomado'])
                                        ->setCellValue('Z'.$row, $oa['Profesor_Emerito'])
                                        ->setCellValue('AA'.$row, $oa['Profesor_Honorario'])
                                        ->setCellValue('AB'.$row, $oa['Profesor_Consulto'])
                                        ->setCellValue('AC'.$row, $oa['Profesor_Invitado'])
                                        ->setCellValue('AD'.$row, $oa['Dedicacion_Exclusiva'])
                                        ->setCellValue('AE'.$row, $oa['Dedicacion_Semi_Exclusiva'])
                                        ->setCellValue('AF'.$row, $oa['Dedicacion_Completa'])
                                        ->setCellValue('AG'.$row, $oa['Dedicacion_Parcial'])
                                        ->setCellValue('AH'.$row, $oa['Dedicacion_Simple'])
                                        ->setCellValue('AI'.$row, $oa['Sin_Dedicacion']);
        }

        // Llenar hoja4
        $objPHPExcel->getSheet(3)->setCellValue('E1', 'MEMORIA AÑO : '.$CICLO);

        $row = 4;
        foreach($anexo3b  as $oa) {
          $row++;
          $objPHPExcel->getSheet(3)->insertNewRowBefore($row,1);

          $objPHPExcel->getSheet(3)->setCellValue('B'.$row, $oa['Sede'])
                                        ->setCellValue('C'.$row, $oa['Carrera'])
                                        ->setCellValue('D'.$row, $oa['persona'])
                                        ->setCellValue('E'.$row, $oa['sexo'])
                                        ->setCellValue('F'.$row, $oa['edad'])
                                        ->setCellValue('G'.$row, $oa['nivel_educativo'])
                                        ->setCellValue('H'.$row, $oa['titulo'])
                                        ->setCellValue('I'.$row, $oa['materia'])
                                        ->setCellValue('J'.$row, $oa['tipo_designacion'])
                                        ->setCellValue('K'.$row, $oa['resolucion'])
                                        ->setCellValue('L'.$row, $oa['ciudad']);
        }



        // Llenar octava hoja
        $objPHPExcel->getSheet(8)->setCellValue('E1', 'MEMORIA AÑO : '.$CICLO);

        $row = 5;
        foreach($anexo8 as $oa) {
          $row++;
          $objPHPExcel->getSheet(8)->insertNewRowBefore($row,1);

          $objPHPExcel->getSheet(8)->setCellValue('B'.$row, $oa['Sede'])
                                        ->setCellValue('C'.$row, $oa['Carrera'])
                                        ->setCellValue('D'.$row, $oa['Tipocarrera'])
                                        ->setCellValue('E'.$row, $oa['NI_total'])
                                        ->setCellValue('F'.$row, $oa['NI_varones'])
                                        ->setCellValue('G'.$row, $oa['NI_mujeres'])
                                        ->setCellValue('H'.$row, $oa['NIeq_total'])
                                        ->setCellValue('I'.$row, $oa['NIeq_varones'])
                                        ->setCellValue('J'.$row, $oa['NIeq_mujeres'])
                                        ->setCellValue('K'.$row, $oa['REINSCRIPTOS_total'])
                                        ->setCellValue('L'.$row, $oa['REINSCRIPTOS_varones'])
                                        ->setCellValue('M'.$row, $oa['REINSCRIPTOS_mujeres'])
                                        ->setCellValue('N'.$row, $oa['NOREINSCRIPTOS_total'])
                                        ->setCellValue('O'.$row, $oa['NOREINSCRIPTOS_varones'])
                                        ->setCellValue('P'.$row, $oa['NOREINSCRIPTOS_mujeres'])
                                        ->setCellValue('Q'.$row, $oa['Bajas_total'])
                                        ->setCellValue('R'.$row, $oa['Bajas_varones'])
                                        ->setCellValue('S'.$row, $oa['Bajas_mujeres'])
                                        ->setCellValue('T'.$row, $oa['Egresados_total'])
                                        ->setCellValue('U'.$row, $oa['Egresados_varones'])
                                        ->setCellValue('V'.$row, $oa['Egresados_mujeres'])
                                        ->setCellValue('W'.$row, $oa['TOTAL'])
                                        ->setCellValue('X'.$row, $oa['TOTAL_varones'])
                                        ->setCellValue('Y'.$row, $oa['TOTAL_mujeres']);
        }
        


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save(str_replace('.php', '.xls', __FILE__));
      

      // Echo done
    //    echo 'Files have been created in ' , getcwd() , EOL;
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Type: application/force-download");
      header("Content-Transfer-Encoding: binary");
      header("Content-Disposition: attachment;filename=Memoria.xls" );
      header("Pragma: no-cache");
      header("Expires: 0");
      readfile($objWriter);

      $objWriter->save('php://output');
  
      return sfView::NONE;
      
  }

}
