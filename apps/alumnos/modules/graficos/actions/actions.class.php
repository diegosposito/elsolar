<?php

/**
 * graficos actions.
 *
 * @package    sig
 * @subpackage graficos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class graficosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

  public function executeBuscarcohorte(sfWebRequest $request)	{
	$this->mensaje = "";
	$this->form = new BuscarCohortesForm();
  }

  public function executeInscriptoscohorte(sfWebRequest $request)
  {
  	 $this->aFacultades = $oAreas->obtenerFacultadesPorArea($this->getUser()->getProfile()->getIdarea());
  }

  public function executeNuevosinscriptos(sfWebRequest $request)
  {
  	 $oAreas = new Areas();

  	 $this->facultades = $oAreas->obtenerFacultadesPorArea($this->getUser()->getProfile()->getIdarea());  	  	 
  }
  
 
 public function executeNuevosinscriptosgraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();

      	  	
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por carrera
      	$resultado = $oEstadistica->obtenerUltimosPeriodosArea($request->getParameter('seleccionar'),$this->getUser()->getProfile()->getIdarea(),sfContext::getInstance()->getUser()->getAttribute('id_sede',''));
  	   	 	
        // Generar xml en archivo de texto
	    $this->generarXml($resultado);
  }
  
public function executeNixsedes(sfWebRequest $request)
  {
  	 $oAreas = new Areas();
  	
  	 $this->areas = $oAreas->obtenerAllAreas();	  	 
  }
  
 
 public function executeNixsedesgraf(sfWebRequest $request)
  {	 	
       $oEstadistica = new Estadisticas();
       
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por carrera
       $resultado = $oEstadistica->obtenerUltimosPeriodosSede($request->getParameter('seleccionar'));
  	   	 
  	   // Generar xml en archivo de texto
	   $this->generarXmlSedes($resultado);
  }
  
public function generarXmlSedes(&$resultados){
	  /* Calculo eje x */
  	     $fecha = explode("-", date("Y-m-d"));
		 switch ($fecha[1]){
			case 10:
			case 11:
			case 12:
					$anio1 =   $fecha[0] - 1;
					$anio2 =   $fecha[0] ;
					$anio3 =   $fecha[0] + 1;
					break;
			default:
				    $anio1 =   $fecha[0] - 2;
					$anio2 =   $fecha[0] - 1;
					$anio3 =   $fecha[0];
					break;
		};
		  
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Nuevos Inscriptos por Centro Regional (agrupado por Carrera)');
		 $r->setAttribute('shownames', '1');
		 $r->setAttribute('showvalues', '1');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('numberPrefix', '');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 /* Crear nodo 'categories' y lo agrego dentro de chart*/
		 $cat = $doc->createElement( "categories" );
		 $r->appendChild( $cat );
		 
		 /* Crear nodos 'dataset' y lo agrego dentro de chart*/
		 $dat = $doc->createElement( "dataset" );
		 $dat->setAttribute('seriesName', $anio1);
		 $dat->setAttribute('color', 'AFD8F8');
		 $dat->setAttribute('showValues', '0');
		 $r->appendChild( $dat );
		 
		 $dat2 = $doc->createElement( "dataset" );
		 $dat2->setAttribute('seriesName', $anio2);
		 $dat2->setAttribute('color', 'F6BD0F');
		 $dat2->setAttribute('showValues', '0');
		 $r->appendChild( $dat2 );
		 
		 $dat3 = $doc->createElement( "dataset" );
		 $dat3->setAttribute('seriesName', $anio3);
		 $dat3->setAttribute('color', '8BBA00');
		 $dat3->setAttribute('showValues', '0');
		 $r->appendChild( $dat3 );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {
			
		 	if ($datos['carrera']!=$carrera) {
			 	
		         $c = $doc->createElement( "category" );
		         $c->setAttribute('label', $datos['carrera']);
                 $carrera = $datos['carrera'];
                 $cat->appendChild( $c );	 
			 
			 }
		 } 
		 
		 // Creo variable xpath para buscar en el dom 
		 $xpath = new DOMXpath($doc);
		 
		 // Recorro resultados y los agrego al dataset correspondiente */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {

		         $dataset = $doc->getElementsByTagName("dataset")->item(0);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['primeranio']);
		         $dataset->appendChild($set);
		         	         
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(1);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['segundoanio']);
		         $dataset->appendChild($set);
		 	    	 	     
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(2);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['terceranio']);
		         $dataset->appendChild($set);		 	     
		 	   
		 } 
		 
		 $doc->save('nixsedesgraf.xml');
		 echo $doc->saveXML();
  }
  
  public function generarXml(&$resultados){
	  /* Calculo eje x */
  	     $fecha = explode("-", date("Y-m-d"));
		 switch ($fecha[1]){
			case 10:
			case 11:
			case 12:
					$anio1 =   $fecha[0] - 1;
					$anio2 =   $fecha[0] ;
					$anio3 =   $fecha[0] + 1;
					break;
			default:
				    $anio1 =   $fecha[0] - 2;
					$anio2 =   $fecha[0] - 1;
					$anio3 =   $fecha[0];
					break;
		};
		  
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Nuevos Inscriptos por Facultad agrupado por Carreras');
		 $r->setAttribute('shownames', '1');
		 $r->setAttribute('showvalues', '1');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('numberPrefix', '');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 /* Crear nodo 'categories' y lo agrego dentro de chart*/
		 $cat = $doc->createElement( "categories" );
		 $r->appendChild( $cat );
		 
		 /* Crear nodos 'dataset' y lo agrego dentro de chart*/
		 $dat = $doc->createElement( "dataset" );
		 $dat->setAttribute('seriesName', $anio1);
		 $dat->setAttribute('color', 'AFD8F8');
		 $dat->setAttribute('showValues', '0');
		 $r->appendChild( $dat );
		 
		 $dat2 = $doc->createElement( "dataset" );
		 $dat2->setAttribute('seriesName', $anio2);
		 $dat2->setAttribute('color', 'F6BD0F');
		 $dat2->setAttribute('showValues', '0');
		 $r->appendChild( $dat2 );
		 
		 $dat3 = $doc->createElement( "dataset" );
		 $dat3->setAttribute('seriesName', $anio3);
		 $dat3->setAttribute('color', '8BBA00');
		 $dat3->setAttribute('showValues', '0');
		 $r->appendChild( $dat3 );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {
			
		 	if ($datos['carrera']!=$carrera) {
			 	
		         $c = $doc->createElement( "category" );
		         $c->setAttribute('label', $datos['carrera']);
                 $carrera = $datos['carrera'];
                 $cat->appendChild( $c );	 
			 
			 }
		 } 
		 
		 // Creo variable xpath para buscar en el dom 
		 $xpath = new DOMXpath($doc);
		 
		 // Recorro resultados y los agrego al dataset correspondiente */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {

		         $dataset = $doc->getElementsByTagName("dataset")->item(0);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['primeranio']);
		         $dataset->appendChild($set);
		         	         
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(1);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['segundoanio']);
		         $dataset->appendChild($set);
		 	    	 	     
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(2);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['terceranio']);
		         $dataset->appendChild($set);		 	     
		 	   
		 } 
		 
		 $doc->save('niultimosperiodos.xml');
		 echo $doc->saveXML();
  }
  
public function executeNilugarprocedencia(sfWebRequest $request)
  {
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
  	 						
  	 /*$this->aCiudades =  array("Ciudad de Origen", "Ciudad de Residenciarigen",);	*/											
  }
  
  public function executeNilugarresidencia(sfWebRequest $request)
  {
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
  	 						
  	 /*$this->aCiudades =  array("Ciudad de Origen","Ciudad de Residenciarigen",);	*/											
  }

  public function executeNialumnosxactividadacademica(sfWebRequest $request)
  {
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
  	 						
  	 /* $this->aCiudades =  array("Ciudad de Origen", "Ciudad de Residenciarigen",);	*/						
  }

  public function executeNialumnosxactividadacademicafacultad(sfWebRequest $request)
  {
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
  	 						
  	 /*$this->aCiudades =  array("Ciudad de Origen",
  	                           "Ciudad de Residenciarigen",);	*/					
  	 							
  }


  public function executeNialumnosxactividadacademicagraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por carrera
       
      	$resultado = $oEstadistica->obtenerAlumnosxActividad($request->getParameter('seleccionar'));
       
       // Obtener resumen solo para Sede Central
     	$this->resultadosc = $oEstadistica->obtenerAlumnosSCentralxActividad($request->getParameter('seleccionar'));
  	   

       // Obtener totales agrupados por sede, carrera segun actividad academica
     	$this->resultadostot = $oEstadistica->obtenerAlumnosxActividadxSedexFacultad($request->getParameter('seleccionar'));
  	   	
       // Obtener totales agrupados por sede(area), facultad segun actividad academica
     	$this->resultadostotaf = $oEstadistica->obtenerAlumnosxActividadxAreaxFacultad($request->getParameter('seleccionar'));
  	   	   	
        // Generar xml en archivo de texto
	    $this->generarXmlActividad($resultado, $request->getParameter('seleccionar'));
  }

  public function executeNialumnosxactividadacademicafacultadgraf(sfWebRequest $request)
  {
      	$oEstadistica = new estadisticaspirantes();
  	 	  	
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por carrera
       
      	$resultado = $oEstadistica->obtenerAlumnosxActividad($this->getUser()->getProfile()->getIdarea(), $request->getParameter('seleccionar'));
       
       // Obtener resumen solo para Sede Central
     	$this->resultadosc = $oEstadistica->obtenerAlumnosSCentralxActividad($this->getUser()->getProfile()->getIdarea(), $request->getParameter('seleccionar'));
  	   
       // Obtener totales agrupados por sede, carrera segun actividad academica
     	$this->resultadostot = $oEstadistica->obtenerAlumnosxActividadxSedexFacultad($this->getUser()->getProfile()->getIdarea(), $request->getParameter('seleccionar'));
  	   	
        // Generar xml en archivo de texto
	    $this->generarXmlActividad($resultado, $request->getParameter('seleccionar'));
  	
  }
  
public function generarXmlActividad(&$resultados, $anio){
	    
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $titulo = 'Evolucion de Alumnos segun Actividad Academica '.$anio.'            Emitido: '.date("d/m/Y");
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', $titulo);
		 $r->setAttribute('subcaption', 'Cada mes representa el acumulado desde principio de año hasta el mes que se visualiza');
		 $r->setAttribute('lineThickness', '1');
		 $r->setAttribute('showValues', '1');
		 $r->setAttribute('formatNumberScale', '0');
		 $r->setAttribute('anchorRadius', '2');
		 $r->setAttribute('divLineAlpha', '20');
		 $r->setAttribute('divLineColor', 'CC3300');
		 $r->setAttribute('divLineIsDashed', '1');
		 $r->setAttribute('showAlternateHGridColor', '1');
		 $r->setAttribute('alternateHGridAlpha', '5');
		 $r->setAttribute('alternateHGridColor', 'CC3300');
		 $r->setAttribute('shadowAlpha', '40');
		 $r->setAttribute('labelStep', '1');
		 $r->setAttribute('numvdivlines', '5');
		 $r->setAttribute('chartRightMargin', '35');
		 $r->setAttribute('bgColor', 'FFFFFF,CC3300');
		 $r->setAttribute('bgAngle', '270');
		 $r->setAttribute('bgAlpha', '10,10');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		  /* Crear nodo 'categories' y lo agrego dentro de chart*/
		 $cat = $doc->createElement( "categories" );
		 $r->appendChild( $cat );
		 
		 /* Crear nodos 'dataset' y lo agrego dentro de chart*/
		 $dat = $doc->createElement( "dataset" );
		 $dat->setAttribute('seriesName', 'Sede Central');
		 $dat->setAttribute('color', 'DBDC25');
		 $dat->setAttribute('anchorBorderColor', 'DBDC25');
		 $dat->setAttribute('anchorBgColor', 'DBDC25');
		 $r->appendChild( $dat );
		 
		 $dat2 = $doc->createElement( "dataset" );
		 $dat2->setAttribute('seriesName', 'Centro Regional Gualeguaychu');
		 $dat2->setAttribute('color', 'F1683C');
		 $dat2->setAttribute('anchorBorderColor', 'F1683C');
		 $dat2->setAttribute('anchorBgColor', 'F1683C');
		 $r->appendChild( $dat2 );
		 
		 $dat3 = $doc->createElement( "dataset" );
		 $dat3->setAttribute('seriesName', 'Extensión Áulica Villaguay');
		 $dat3->setAttribute('color', '2AD62A');
		 $dat3->setAttribute('anchorBorderColor', '2AD62A');
		 $dat3->setAttribute('anchorBgColor', '2AD62A');
		 $r->appendChild( $dat3 );

		 $dat4 = $doc->createElement( "dataset" );
		 $dat4->setAttribute('seriesName', 'Centro Regional Rosario');
		 $dat4->setAttribute('color', 'E41111');
		 $dat4->setAttribute('anchorBorderColor', 'E11111');
		 $dat4->setAttribute('anchorBgColor', 'E11111');
		 $r->appendChild( $dat4 );

		 $dat5 = $doc->createElement( "dataset" );
		 $dat5->setAttribute('seriesName', 'Centro Regional Santa Fé');
		 $dat5->setAttribute('color', '0000FF');
		 $dat5->setAttribute('anchorBorderColor', '0000FF');
		 $dat5->setAttribute('anchorBgColor', '0000FF');
		 $r->appendChild( $dat5 );
		 
		  $dat6 = $doc->createElement( "dataset" );
		 $dat6->setAttribute('seriesName', 'Centro Regional Paraná');
		 $dat6->setAttribute('color', '00FFFF');
		 $dat6->setAttribute('anchorBorderColor', '00FFFF');
		 $dat6->setAttribute('anchorBgColor', '00FFFF');
		 $r->appendChild( $dat6 );

		 $dat7 = $doc->createElement( "dataset" );
		 $dat7->setAttribute('seriesName', 'Extensión Áulica Gualeguay');
		 $dat7->setAttribute('color', 'DF01A5');
		 $dat7->setAttribute('anchorBorderColor', 'DF01A5');
		 $dat7->setAttribute('anchorBgColor', 'DF01A5');
		 $r->appendChild( $dat7 );
		 
		 // Recorro los meses y las agrego como nodos category */
		 $meses = array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic');
		 foreach( $meses as $mes )
		 {
		         $c = $doc->createElement( "category" );
		         $c->setAttribute('label', $mes);
                 $cat->appendChild( $c );	 
		 } 
		 
		 // Creo variable xpath para buscar en el dom 
		 $xpath = new DOMXpath($doc);
		 
		 // Recorro resultados y los agrego al dataset correspondiente */
		 $carrera = ""; $ciclos = -1; $contador = 0;
		 foreach( $resultados as $datos )
		 {
                 $ciclos++; 
                     
		         $dataset = $doc->getElementsByTagName("dataset")->item($ciclos);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['enero']);
		         $dataset->appendChild($set);

		         $set1 = $doc->createElement("set");
		         $set1->setAttribute('value', $datos['febrero']);
		         $dataset->appendChild($set1);

		         $set2 = $doc->createElement("set");
		         $set2->setAttribute('value', $datos['marzo']);
		         $dataset->appendChild($set2);

		         $set3 = $doc->createElement("set");
		         $set3->setAttribute('value', $datos['abril']);
		         $dataset->appendChild($set3);

		         $set4 = $doc->createElement("set");
		         $set4->setAttribute('value', $datos['mayo']);
		         $dataset->appendChild($set4);

		         $set5 = $doc->createElement("set");
		         $set5->setAttribute('value', $datos['junio']);
		         $dataset->appendChild($set5);
		         	         
		         $set6 = $doc->createElement("set");
		         $set6->setAttribute('value', $datos['julio']);
		         $dataset->appendChild($set6);

		         $set7 = $doc->createElement("set");
		         $set7->setAttribute('value', $datos['agosto']);
		         $dataset->appendChild($set7);	         
		 
		         $set8 = $doc->createElement("set");
		         $set8->setAttribute('value', $datos['septiembre']);
		         $dataset->appendChild($set8);	

		         $set9 = $doc->createElement("set");
		         $set9->setAttribute('value', $datos['octubre']);
		         $dataset->appendChild($set9);	

		         $set10 = $doc->createElement("set");
		         $set10->setAttribute('value', $datos['noviembre']);
		         $dataset->appendChild($set10);	

		         $set11= $doc->createElement("set");
		         $set11->setAttribute('value', $datos['diciembre']);
		         $dataset->appendChild($set11);	
                 
		 } 
		 
		 $doc->save('msline2.xml');
		 $doc->saveXML();
  }
  
  
 public function executeNilugarprocedenciagraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos por lugar de procedencia
      	$resultado = $oEstadistica->nixciudadorigen($this->getUser()->getProfile()->getIdarea(), $request->getParameter('seleccionar'),sfContext::getInstance()->getUser()->getAttribute('id_sede',''));
  	   	 	
        // Generar xml en archivo de texto
	    $this->generarXmlLugarProcedencia($resultado);
  }
  
public function executeNilugarresidenciadenciagraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos por lugar de procedencia
      	$resultado = $oEstadistica->nixciudadresidencia($this->getUser()->getProfile()->getIdarea(), $request->getParameter('seleccionar'));
  	   	 	
        // Generar xml en archivo de texto
	    $this->generarXmlLugarProcedencia($resultado);
  }
  
public function generarXmlLugarProcedencia(&$resultados){
	    
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Nuevos Inscriptos por Lugar de Nacimiento');
		 $r->setAttribute('xAxisName', 'Lugar de Origen');
		 $r->setAttribute('yAxisName', 'Cantidades');
		 $r->setAttribute('showValues', '0');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('formatNumberScale', '0');
		 $r->setAttribute('chartRightMargin', '30');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {
		         $c = $doc->createElement( "set" );
		         $c->setAttribute('label', $datos['descripcion']);
                 $c->setAttribute('value', $datos['anioactual']);
                 $r->appendChild( $c ); 
		 } 
		 
		 $doc->save('nilugarprocedencia.xml');
		 echo $doc->saveXML();
  }
  
 public function executeEvolucionmensualinscriptos(sfWebRequest $request)
  {
  	 $oAreas = new Areas();
  	 
     $this->carreras = Doctrine_Core::getTable('AreasCarrera')->obtenerCarrerasPorArea($this->getUser()->getProfile()->getIdarea());	  	 
  }
  
 public function executeEvolucionmensualinscriptosgraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por carrera
       
      	$resultado = $oEstadistica->obtenerUltimosPeriodosCarrera($request->getParameter('seleccionar'),$this->getUser()->getProfile()->getIdarea(),sfContext::getInstance()->getUser()->getAttribute('id_sede',''));
  	   	 	
        // Generar xml en archivo de texto
	    $this->generarXmlPeriodos($resultado);
  }
  
public function generarXmlPeriodos(&$resultados){
	    
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Evolucion de Inscriptos');
		 $r->setAttribute('subcaption', 'Analisis ultimos 4 anios, desde 1 octubre hasta 31 marzo');
		 $r->setAttribute('lineThickness', '1');
		 $r->setAttribute('showValues', '0');
		 $r->setAttribute('formatNumberScale', '0');
		 $r->setAttribute('anchorRadius', '2');
		 $r->setAttribute('divLineAlpha', '20');
		 $r->setAttribute('divLineColor', 'CC3300');
		 $r->setAttribute('divLineIsDashed', '1');
		 $r->setAttribute('showAlternateHGridColor', '1');
		 $r->setAttribute('alternateHGridAlpha', '5');
		 $r->setAttribute('alternateHGridColor', 'CC3300');
		 $r->setAttribute('shadowAlpha', '40');
		 $r->setAttribute('labelStep', '1');
		 $r->setAttribute('numvdivlines', '5');
		 $r->setAttribute('chartRightMargin', '35');
		 $r->setAttribute('bgColor', 'FFFFFF,CC3300');
		 $r->setAttribute('bgAngle', '270');
		 $r->setAttribute('bgAlpha', '10,10');

        // Realizar calculo de fechas
		$fecha = explode("-", date("Y-m-d"));
		if ($fecha[1]>8) {
		    $desde=date("Y");
		    $hasta=date("Y")+1;
		} else {
		    $desde=date("Y")-1;
		    $hasta=date("Y");

		}
		$last_year = (date("Y-m-d")>=$fecha[0]."04-01" and date("Y-m-d")<=$fecha[0]."09-30")?$desde:$hasta;
		$first_year = $last_year - 3;
		$second_year = $last_year - 2;
		$thirdt_year = $last_year - 1;
		$initial_year = $last_year - 4;
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		  /* Crear nodo 'categories' y lo agrego dentro de chart*/
		 $cat = $doc->createElement( "categories" );
		 $r->appendChild( $cat );
		 
		 /* Crear nodos 'dataset' y lo agrego dentro de chart*/
		 $dat = $doc->createElement( "dataset" );
		 $dat->setAttribute('seriesName', $first_year);
		 $dat->setAttribute('color', 'DBDC25');
		 $dat->setAttribute('anchorBorderColor', 'DBDC25');
		 $dat->setAttribute('anchorBgColor', 'DBDC25');
		 $r->appendChild( $dat );
		 
		 $dat2 = $doc->createElement( "dataset" );
		 $dat2->setAttribute('seriesName', $second_year);
		 $dat2->setAttribute('color', 'F1683C');
		 $dat2->setAttribute('anchorBorderColor', 'F1683C');
		 $dat2->setAttribute('anchorBgColor', 'F1683C');
		 $r->appendChild( $dat2 );
		 
		 $dat3 = $doc->createElement( "dataset" );
		 $dat3->setAttribute('seriesName', $thirdt_year);
		 $dat3->setAttribute('color', '2AD62A');
		 $dat3->setAttribute('anchorBorderColor', '2AD62A');
		 $dat3->setAttribute('anchorBgColor', '2AD62A');
		 $r->appendChild( $dat3 );
		 
		 $dat4 = $doc->createElement( "dataset" );
		 $dat4->setAttribute('seriesName', $last_year);
		 $dat4->setAttribute('color', '1D8BD1');
		 $dat4->setAttribute('anchorBorderColor', '1D8BD1');
		 $dat4->setAttribute('anchorBgColor', '1D8BD1');
		 $r->appendChild( $dat4 );
		 
		 // Recorro los meses y las agrego como nodos category */
		 $meses = array('Octubre','Noviembre','Diciembre','Enero','Febrero','Marzo');
		 foreach( $meses as $mes )
		 {
		         $c = $doc->createElement( "category" );
		         $c->setAttribute('label', $mes);
                 $cat->appendChild( $c );	 
		 } 
		 
		 // Creo variable xpath para buscar en el dom 
		 $xpath = new DOMXpath($doc);
		 
		 // Recorro resultados y los agrego al dataset correspondiente */
		 $carrera = ""; $ciclos = -1; $contador = 0;
		 foreach( $resultados as $datos )
		 {
                 if ($contador % 6 == 0)
                     $ciclos++; 
                 $contador++;    
                     
		         $dataset = $doc->getElementsByTagName("dataset")->item($ciclos);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['totalalumnos']);
		         $dataset->appendChild($set);
		         	         
		 } 
		 
		 $doc->save('msline.xml');
		 $doc->saveXML();
  }
  
  public function executeNuevosinscriptosxfacultadgraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por facultad
      	$resultado = $oEstadistica->obtenerInscriptosxFacultadxArea($this->getUser()->getProfile()->getIdarea());
  	   	 	
        // Generar xml en archivo de texto
	    $this->generarXmlxFacultad($resultado);
  }
  
  public function generarXmlxFacultad(&$resultados){
	  /* Calculo eje x */
  	     $fecha = explode("-", date("Y-m-d"));
		 switch ($fecha[1]){
			case 10:
			case 11:
			case 12:
					$anio1 =   $fecha[0] - 1;
					$anio2 =   $fecha[0] ;
					$anio3 =   $fecha[0] + 1;
					break;
			default:
				    $anio1 =   $fecha[0] - 2;
					$anio2 =   $fecha[0] - 1;
					$anio3 =   $fecha[0];
					break;
		};
		  
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Evolucion Nuevos Inscriptos por Facultad');
		 $r->setAttribute('shownames', '1');
		 $r->setAttribute('showvalues', '1');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('numberPrefix', '');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 /* Crear nodo 'categories' y lo agrego dentro de chart*/
		 $cat = $doc->createElement( "categories" );
		 $r->appendChild( $cat );
		 
		 /* Crear nodos 'dataset' y lo agrego dentro de chart*/
		 $dat = $doc->createElement( "dataset" );
		 $dat->setAttribute('seriesName', $anio1);
		 $dat->setAttribute('color', 'AFD8F8');
		 $dat->setAttribute('showValues', '0');
		 $r->appendChild( $dat );
		 
		 $dat2 = $doc->createElement( "dataset" );
		 $dat2->setAttribute('seriesName', $anio2);
		 $dat2->setAttribute('color', 'F6BD0F');
		 $dat2->setAttribute('showValues', '0');
		 $r->appendChild( $dat2 );
		 
		 $dat3 = $doc->createElement( "dataset" );
		 $dat3->setAttribute('seriesName', $anio3);
		 $dat3->setAttribute('color', '8BBA00');
		 $dat3->setAttribute('showValues', '0');
		 $r->appendChild( $dat3 );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $facultad = "";
		 foreach( $resultados as $datos )
		 {
			
		 	if ($datos['facultad']!=$facultad) {
			 	
		         $c = $doc->createElement( "category" );
		         $c->setAttribute('label', $datos['facultad']);
                 $facultad = $datos['facultad'];
                 $cat->appendChild( $c );	 
			 }
		 } 
		 
		 // Creo variable xpath para buscar en el dom 
		 $xpath = new DOMXpath($doc);
		 
		 // Recorro resultados y los agrego al dataset correspondiente */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {

		         $dataset = $doc->getElementsByTagName("dataset")->item(0);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['primeranio']);
		         $dataset->appendChild($set);
		         	         
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(1);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['segundoanio']);
		         $dataset->appendChild($set);
		 	    	 	     
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(2);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['terceranio']);
		         $dataset->appendChild($set);		 	     
		 } 
		 
		 $doc->save('nifacultadperiodos.xml');
		 $doc->saveXML();
  }
  
  // Obtener Estadisticas Por Area de nuevos Inscriptos
  public function executeNuevosinscriptosxareagraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos ultimos 3 años agrupado por Area
      	$resultado = $oEstadistica->obtenerInscriptosxArea();
  	   	 	
        // Generar xml en archivo de texto
	    $this->generarXmlxArea($resultado);
  }
  
  public function generarXmlxArea(&$resultados){
	  /* Calculo eje x */
  	     $fecha = explode("-", date("Y-m-d"));
		 switch ($fecha[1]){
			case 10:
			case 11:
			case 12:
					$anio1 =   $fecha[0] - 1;
					$anio2 =   $fecha[0] ;
					$anio3 =   $fecha[0] + 1;
					break;
			default:
				    $anio1 =   $fecha[0] - 2;
					$anio2 =   $fecha[0] - 1;
					$anio3 =   $fecha[0];
					break;
		};
		  
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Evolucion Nuevos Inscriptos por Centro Regional');
		 $r->setAttribute('shownames', '1');
		 $r->setAttribute('showvalues', '1');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('numberPrefix', '');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 /* Crear nodo 'categories' y lo agrego dentro de chart*/
		 $cat = $doc->createElement( "categories" );
		 $r->appendChild( $cat );
		 
		 /* Crear nodos 'dataset' y lo agrego dentro de chart*/
		 $dat = $doc->createElement( "dataset" );
		 $dat->setAttribute('seriesName', $anio1);
		 $dat->setAttribute('color', 'AFD8F8');
		 $dat->setAttribute('showValues', '0');
		 $r->appendChild( $dat );
		 
		 $dat2 = $doc->createElement( "dataset" );
		 $dat2->setAttribute('seriesName', $anio2);
		 $dat2->setAttribute('color', 'F6BD0F');
		 $dat2->setAttribute('showValues', '0');
		 $r->appendChild( $dat2 );
		 
		 $dat3 = $doc->createElement( "dataset" );
		 $dat3->setAttribute('seriesName', $anio3);
		 $dat3->setAttribute('color', '8BBA00');
		 $dat3->setAttribute('showValues', '0');
		 $r->appendChild( $dat3 );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $area = "";
		 foreach( $resultados as $datos )
		 {
			
		 	if ($datos['area']!=$area) {
			 	
		         $c = $doc->createElement( "category" );
		         $c->setAttribute('label', $datos['area']);
                 $area = $datos['area'];
                 $cat->appendChild( $c );	 
			 
			 }
		 } 
		 
		 // Creo variable xpath para buscar en el dom 
		 $xpath = new DOMXpath($doc);
		 
		 // Recorro resultados y los agrego al dataset correspondiente */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {

		         $dataset = $doc->getElementsByTagName("dataset")->item(0);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['primeranio']);
		         $dataset->appendChild($set);
		         	         
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(1);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['segundoanio']);
		         $dataset->appendChild($set);
		 	    	 	     
		 	     $dataset = $doc->getElementsByTagName("dataset")->item(2);
		         $set = $doc->createElement("set");
		         $set->setAttribute('value', $datos['terceranio']);
		         $dataset->appendChild($set);		 	     
		 	   
		 } 
		 
		 $doc->save('niareaperiodos.xml');
		 $doc->saveXML();
  }
  
  // Modulo : Nuevos Inscriptos Seleccionando Carrera y agrupando por Lugar de Procedencia
  public function executeNicarreraxlugarprocedencia(sfWebRequest $request)
  {
  	 $oAreas = new Areas();
  	
	// con el metodo anulado no muestra sede central
  	 //$this->areas = $oAreas->obtenerAllAreas(); 
	$this->areas = $oAreas->getAreas();  	 
  }
  
 public function executeNicarreraxlugarprocedenciagraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos por lugar de procedencia 
       // agrupando por Carrera
      	$resultado = $oEstadistica->nixciudadresidenciaxcarrera( $request->getParameter('carrerasxsede'));
  	   		
        // Generar xml en archivo de texto
	    $this->generarXmlLugarProcedenciaxCarrera($resultado);
  }
  
  public function generarXmlLugarProcedenciaxcarrera(&$resultados){
	    
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Nuevos Inscriptos por Carrera (agrupado por Lugar de Procedencia)');
		 $r->setAttribute('xAxisName', 'Lugar de Procedencia');
		 $r->setAttribute('yAxisName', 'Cantidades');
		 $r->setAttribute('showValues', '0');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('formatNumberScale', '0');
		 $r->setAttribute('chartRightMargin', '30');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {
		         $c = $doc->createElement( "set" );
		         $c->setAttribute('label', $datos['descripcion']);
                 $c->setAttribute('value', $datos['activos']);
                 $r->appendChild( $c ); 
		 } 
		 
		 $doc->save('nilugarprocedencia.xml');
		 echo $doc->saveXML();
  }
  
  // Nuevos Inscriptos por franja etarea
  public function executeNifranjaetareaxcarrera(sfWebRequest $request)
  {
  	 $oAreas = new Areas();
  	
  	 $this->areas = $oAreas->getAreas(); 	 
  }
  
 public function executeNifranjaetareaxcarreragraf(sfWebRequest $request)
  {
      	$oEstadistica = new Estadisticas();
  	 	  	
       // Obtener estadisticas de nuevos incriptos por lugar de procedencia 
       // agrupando por Carrera
      	$resultado = $oEstadistica->nixfranjaetareaxcarrera( $request->getParameter('carrerasxsede'));
  	   		
        // Generar xml en archivo de texto
	    $this->generarXmlFranjaEtareaxCarrera($resultado);
  }
  
  public function generarXmlFranjaEtareaxCarrera(&$resultados){
	    
		 $doc = new DOMDocument();
		  
		 /*Especifico que el resultado tenga formato que incluye tabulaciones y espacios */
		 $doc->formatOutput = true;
		 
		 /* Creo el nodo 'chart con sus atributos' */
		 $r = $doc->createElement( "chart" );
		 $r->setAttribute('caption', 'Nuevos Inscriptos por Franja Etarea');
		 $r->setAttribute('xAxisName', 'Rango de Edades');
		 $r->setAttribute('yAxisName', 'Cantidades');
		 $r->setAttribute('showValues', '0');
		 $r->setAttribute('decimals', '0');
		 $r->setAttribute('formatNumberScale', '0');
		 $r->setAttribute('chartRightMargin', '30');
		  
		 /* Aniado el nodo 'chart' al documento */
		 $doc->appendChild( $r );
		 
		 // Recorro las distintas carreras y las agrego como nodos category */
		 $carrera = "";
		 foreach( $resultados as $datos )
		 {
		         $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Menos de 18");
                 $c->setAttribute('value', $datos['menos18']);
                 $r->appendChild( $c ); 
                 
                 $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Entre 18 y 21");
                 $c->setAttribute('value', $datos['e18a21']);
                 $r->appendChild( $c );
                 
                 $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Entre 22 y 25");
                 $c->setAttribute('value', $datos['e22a25']);
                 $r->appendChild( $c );
                 
                 $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Entre 26 y 30");
                 $c->setAttribute('value', $datos['e26a30']);
                 $r->appendChild( $c );
                 
                 $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Entre 31 y 35");
                 $c->setAttribute('value', $datos['e31a35']);
                 $r->appendChild( $c );
                 
                 $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Entre 36 y 40");
                 $c->setAttribute('value', $datos['e36a40']);
                 $r->appendChild( $c );
                 
                 $c = $doc->createElement( "set" );
		         $c->setAttribute('label', "Mas de 41");
                 $c->setAttribute('value', $datos['mas40']);
                 $r->appendChild( $c );
		 } 
		 
		 $doc->save('nifranjaetarea.xml');
		 echo $doc->saveXML();
  }
}
