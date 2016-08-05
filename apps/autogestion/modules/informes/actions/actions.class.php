<?php

/**
 * inscripciones actions.
 *
 * @package    sig
 * @subpackage inscripciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class informesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

	public function executePlanesestudios(sfWebRequest $request)	{	
    	$this->mensaje = "";	
		$this->form = new BuscarCarrerasActivasAlumnosForm(array(
		    'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
		));	
	
	}	


	public function executeCorrelatividades(sfWebRequest $request)	{	
    	$this->mensaje = "";	
		$this->form = new BuscarCarrerasActivasAlumnosForm(array(
		    'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
		));	
	
	}	

		
	public function executeMostrarcorrelatividades(sfWebRequest $request)	{	
		// Busca el alumno		
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));


		$config = sfTCPDFPluginConfigHandler::loadConfig();

		$salto = 48;
		$idplanestudio =$this->alumno->getIdplanestudio();

		$oPlanCorrelatividades = Doctrine_Core::getTable('Correlatividades')->getPlanCorrelatividades($idplanestudio);

		// Obtener carrera
		$oCarrera = Doctrine_Core::getTable('Carreras')->find($idplanestudio);
		// Muestra el texto del primer parrafo de la constancia
		$carrera = strtr(strtoupper($oCarrera),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
		
		// pdf object
		$pdf = new PDF();

    		// settings
		$pdf->SetFont("Times", "", 9);
		// sentencias para retirar encabezados y pie por defecto
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false); 
 
        	// add a page
		$pdf->AddPage();

				
		$encabezado = '
			<div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
			style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/CabeceraSIG-UCU.jpg" width="550px">
			PLAN DE CORRELATIVIDADES: '.$carrera.'</div>';        

		$pdf->writeHTML($encabezado, true, false, true, false, '');   
		
		$y = 45;
		$pdf->SetXY(10,$y);
		$pdf->Cell(10,5,'ID',0,0,'C');    
		$pdf->SetXY(20,$y);
		$pdf->Cell(80,5,'MATERIA',0,0,'C');    
		$pdf->SetXY(100,$y);
		$pdf->Cell(50,5,'CURSAR',0,0,'C');    
   		$pdf->SetXY(150,$y);
		$pdf->Cell(50,5,'RENDIR',0,0,'C');
		$pdf->Line(10,$y+5,199,$y+5);
		$pdf->SetXY(100,$y+5);
		$pdf->Cell(25,5,'Regular',0,0,'C');   
		$pdf->Cell(25,5,'Aprobada',0,0,'C');  
		$pdf->Cell(25,5,'Regular',0,0,'C');  
		$pdf->Cell(25,5,'Aprobada',0,0,'C');   	
						
		$y = $y + 5;		
		$contador = 1;
		$contadoranios = 1;
		$idaniocursadaant = 0;
		$idaniocursadaactual = 0;
		
		$pdf->Line(10,$y+5,199,$y+5);
		
	    foreach ($oPlanCorrelatividades as $materia){	
		    			    		
		    	$idaniocursadaactual=$materia['anodecursada'];
				// verifico si cambia de año para mostrar encabezado
			if ($idaniocursadaactual!=$idaniocursadaant) {
				//lineas del rotulo
				$pdf->Line(10,$y+5,199,$y+5);
				//$pdf->Line(10,$y+7,199,$y+7);   
	             
				$y = $y + 5;	
				$contadoranios++;
					
                   	$pdf->SetXY(0,$y-5);
                   	$anioDesc = '';
                   	switch ($idaniocursadaactual) {
					    case 1:
					        $anioDesc='Primer Año';
					        break;
					    case 2:
					        $anioDesc='Segundo Año';
					        break;
					    case 3:
					        $anioDesc='Tercer Año';
					        break;
					    case 4:
					        $anioDesc='Cuarto Año';
					        break;
					    case 5:
					        $anioDesc='Quinto Año';
					        break;
					    case 6:
					        $anioDesc='Sexto Año';
					        break;
					}
                   	$pdf->Cell(100,5,$anioDesc,0,0,'C');	
                   	    																			
	    	    } 
		    	    	    	       	    
		        $pdf->SetXY(10,$y);
		        $pdf->Cell(10,5,$materia['idmateriaplan'],0,0,'L');
		        $pdf->SetXY(20,$y);        
		        $pdf->Cell(80,5,SUBSTR($materia['nombre'],0,60),0,0,'L');        
		        $pdf->SetXY(100,$y);  

		        $pdf->SetFont("Times", "", 8); 
		        $maximalongitud = max(strlen($materia['para_cursar_tener_regular']), strlen($materia['para_cursar_tener_aprobada']), strlen($materia['para_rendir_tener_regular']), strlen($materia['para_rendir_tener_aprobada']));
		        if ($maximalongitud<16){
		        	$pdf->Cell(25,5,$materia['para_cursar_tener_regular']=='' ? '-' : $materia['para_cursar_tener_regular'],0,0,'C');
		        	$pdf->SetXY(125,$y);
		        	$pdf->Cell(25,5,$materia['para_cursar_tener_aprobada']=='' ? '-' : $materia['para_cursar_tener_aprobada'],0,0,'C');
		        	$pdf->SetXY(150,$y);
		        	$pdf->Cell(25,5,$materia['para_rendir_tener_regular']=='' ? '-' : $materia['para_rendir_tener_regular'],0,0,'C');
		        	$pdf->SetXY(175,$y);
		        	$pdf->Cell(25,5,$materia['para_rendir_tener_aprobada']=='' ? '-' : $materia['para_rendir_tener_aprobada'],0,0,'C');
		        }elseif($maximalongitud<45){
		        	$pdf->MultiCell(25,10,$materia['para_cursar_tener_regular']=='' ? '-' : $materia['para_cursar_tener_regular'],0,'C');
		        	$pdf->SetXY(125,$y);
		        	$pdf->MultiCell(25,10,$materia['para_cursar_tener_aprobada']=='' ? '-' : $materia['para_cursar_tener_aprobada'],0,'C');
		        	$pdf->SetXY(150,$y);
		        	$pdf->MultiCell(25,10,$materia['para_rendir_tener_regular']=='' ? '-' : $materia['para_rendir_tener_regular'],0,'C');
		        	$pdf->SetXY(175,$y);
		        	$pdf->MultiCell(25,10,$materia['para_rendir_tener_aprobada']=='' ? '-' : $materia['para_rendir_tener_aprobada'],0,'C');
		        	$y=$y+5;
		        }else{
		        	$pdf->MultiCell(25,15,$materia['para_cursar_tener_regular']=='' ? '-' : $materia['para_cursar_tener_regular'],0,'C');
		        	$pdf->SetXY(125,$y);
		        	$pdf->MultiCell(25,15,$materia['para_cursar_tener_aprobada']=='' ? '-' : $materia['para_cursar_tener_aprobada'],0,'C');
		        	$pdf->SetXY(150,$y);
		        	$pdf->MultiCell(25,15,$materia['para_rendir_tener_regular']=='' ? '-' : $materia['para_rendir_tener_regular'],0,'C');
		        	$pdf->SetXY(175,$y);
		        	$pdf->MultiCell(25,15,$materia['para_rendir_tener_aprobada']=='' ? '-' : $materia['para_rendir_tener_aprobada'],0,'C');
		        	$y=$y+10;		        	
		        }
				
                $pdf->SetFont("Times", "", 9);
    	    
				$y=$y+5; $contador++; $idaniocursadaant=$idaniocursadaactual;
				if (($contador+$contadoranios == $salto) or ($pdf->GetY()>250)){				            
					// add a page
			    	$pdf->AddPage();
			    	
					$encabezado = '
					<div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
					style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/CabeceraSIG-UCU.jpg" width="550px">
					PLAN DE CORRELATIVIDADES: '.$carrera.'</div>';         

					$pdf->writeHTML($encabezado, true, false, true, false, '');   
		
					$y = 40;
					$pdf->SetXY(10,$y);
					$pdf->Cell(10,5,'ID',0,0,'C');    
					$pdf->SetXY(20,$y);
					$pdf->Cell(80,5,'MATERIA',0,0,'C');    
					$pdf->SetXY(100,$y);
					$pdf->Cell(50,5,'CURSAR',0,0,'C');    
			   		$pdf->SetXY(150,$y);
					$pdf->Cell(50,5,'RENDIR',0,0,'C');
					$pdf->Line(10,$y+5,199,$y+5);
					$pdf->SetXY(100,$y+5);
					$pdf->Cell(25,5,'Regular',0,0,'C');   
					$pdf->Cell(25,5,'Aprobada',0,0,'C');  
					$pdf->Cell(25,5,'Regular',0,0,'C');  
					$pdf->Cell(25,5,'Aprobada',0,0,'C');  

					$y = $y + 5;
					$contador = 1;
					$contadoranios = 1;
					
					$pdf->Line(10,$y+5,199,$y+5);				
										
					$y = $y + 5;							
				}
				if(strlen($materia['para_rendir_tener_aprobada'])>100) $y=$y+50;		
				$pdf->Line(10,$y,199,$y);
 
	
		    } // fin (foreach)	

			/*if($request->getParameter('idplanestudio')==18){

								$aclaraciones="Para Cursar 3ro. debe tener todo 1ro. Aprobado en alumnos inscriptos al ciclo 2012 en adelante.";
						$pdf->writeHTML($aclaraciones, true, false, true, false, '');  
								$aclaraciones="Para Cursar 4to. debe tener todo 2do. Aprobado en alumnos inscriptos al ciclo 2012 en adelante.";
						$pdf->writeHTML($aclaraciones, true, false, true, false, '');  
			}*/
$pdf->SetXY(10,$y+5);
$aclaraciones="NOTA: Consultar por existencia de equivalencias especificas del plan, Optativas, Subespacios, Propedéuticos o Correlativas de Años completos. ";
						$pdf->writeHTML($aclaraciones, true, false, true, false, '');  
		$pdf->Output('planilla.pdf', 'I');
 
		// stop symfony process
		throw new sfStopException();
				
		return sfView::NONE;
	}

		
	public function executeMostrarplanesestudios(sfWebRequest $request)	{	
		// Busca el alumno		
		$this->alumno = Doctrine_Core::getTable('Alumnos')->find($request->getParameter('idalumno'));


		$config = sfTCPDFPluginConfigHandler::loadConfig();

		$salto = 48;
		$idplanestudio =$this->alumno->getIdplanestudio();

		//$oMateriasPlanes = Doctrine_Core::getTable('MateriasPlanes')->findByIdplanestudio($idplanestudio)->OrderByOrden('ASC');
		$oMateriasPlanes = Doctrine_Core::getTable('MateriasPlanes')->obtenerMateriasObligatoriasPlanAlumno($request->getParameter('idalumno'));


		// Obtener carrera
		$oCarrera = Doctrine_Core::getTable('Carreras')->find($idplanestudio);
		// Muestra el texto del primer parrafo de la constancia
		$carrera = strtr(strtoupper($oCarrera),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
		
		// pdf object
		$pdf = new PDF();

    		// settings
		$pdf->SetFont("Times", "", 9);
		// sentencias para retirar encabezados y pie por defecto
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false); 
 
        	// add a page
		$pdf->AddPage();

				
		$encabezado = '
			<div style="text-align: center; font-family: Times New Roman,Times,serif;"><span
			style="font-size: 12;"><img src="'.$request->getRelativeUrlRoot().'/images/CabeceraSIG-UCU.jpg" width="550px">
			PLAN DE ESTUDIO: '.$carrera.'</div>';        

		$pdf->writeHTML($encabezado, true, false, true, false, '');   
		
		$y = 45;
		$pdf->SetXY(10,$y);
		$pdf->Cell(10,5,'ID',0,0,'C');    
		$pdf->SetXY(20,$y);
		$pdf->Cell(80,5,'MATERIA',0,0,'C');    
		$pdf->SetXY(20,$y);
		$pdf->Cell(250,5,'ORDEN',0,0,'C'); 
		$y = $y + 5;		
		$contador = 1;
		$contadoranios = 1;
		$idaniocursadaant = -1;
		$idaniocursadaactual = 0;
		
		$pdf->Line(10,$y+5,199,$y+5);
		
	    foreach ($oMateriasPlanes as $materia){
		if($y==255){	
			// add a page
			$pdf->AddPage(); 
			$pdf->writeHTML($encabezado, true, false, true, false, '');   
		
			$y = 45;
			$pdf->SetXY(10,$y);
			$pdf->Cell(10,5,'ID',0,0,'C');    
			$pdf->SetXY(20,$y);
			$pdf->Cell(80,5,'MATERIA',0,0,'C');    
			$pdf->SetXY(20,$y);
			$pdf->Cell(250,5,'ORDEN',0,0,'C'); 
			$y = $y + 5;		
			$contador = 1;
			$contadoranios = 1;
			$idaniocursadaant = -1;
			$idaniocursadaactual = 0;
		
			$pdf->Line(10,$y+5,199,$y+5);			   	
		}
	
		    $idaniocursadaactual=$materia['anodecursada'];
				// verifico si cambia de año para mostrar encabezado
			if ($idaniocursadaactual!=$idaniocursadaant) {
				//lineas del rotulo
				$pdf->Line(10,$y+5,199,$y+5);
				//$pdf->Line(10,$y+7,199,$y+7);   
	             
				$y = $y + 5;	
				$contadoranios++;
					
                   	$pdf->SetXY(0,$y-5);
                   	$anioDesc = '';
                   	switch ($idaniocursadaactual) {
					    case 0:
					        $anioDesc='Preuniversitario/Propedeutico';
					        break;
					    case 1:
					        $anioDesc='Primer Año';
					        break;
					    case 2:
					        $anioDesc='Segundo Año';
					        break;
					    case 3:
					        $anioDesc='Tercer Año';
					        break;
					    case 4:
					        $anioDesc='Cuarto Año';
					        break;
					    case 5:
					        $anioDesc='Quinto Año';
					        break;
					    case 6:
					        $anioDesc='Sexto Año';
					        break;
					}
				$y = $y + 5;
			$pdf->SetXY(0,$y-5);
                   	$pdf->Cell(200,5,$anioDesc,0,0,'C');	
				$pdf->Line(10,$y,199,$y);
                   	   $idaniocursadaant=$idaniocursadaactual; 																			
	    	    } 

		    		  $y = $y + 5;  	    	       	    
		        $pdf->SetXY(10,$y);
		        $pdf->Cell(10,5,$materia['idmateriaplan'],0,0,'L');
		        $pdf->SetXY(20,$y);        
		        $pdf->Cell(80,5,SUBSTR($materia->getMaterias()->getNombre(),0,60),0,0,'L');        
		        $pdf->SetXY(150,$y); 
		        $pdf->Cell(10,5,$materia['orden'],0,0,'L'); 
		        $pdf->SetXY(155,$y); 
		        $pdf->Cell(10,5,$materia->getTiposCursadas(),0,0,'L'); 
		        $pdf->SetXY(175,$y); 
		        $pdf->Cell(10,5,$materia->getTiposMaterias(),0,0,'L'); 
		        $pdf->SetXY(195,$y); 
		        $pdf->Cell(10,5,$materia->getObligatoria(),0,0,'L'); 

 
	
		    } // fin (foreach)	

			 
		$pdf->Output('planilla.pdf', 'I');
 
		// stop symfony process
		throw new sfStopException();
				
		return sfView::NONE;
	}

}
