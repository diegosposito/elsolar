<script> 
$(document).ready(function(){ 
	$(".botonInscribir").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		var Idcomision = $("#idcomision_"+Id).val();

    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/controlarhorarios'); ?>",
    	    { idcomision: Idcomision, idalumno: <?php echo $alumno->getIdalumno(); ?> },
    	    function(data){
				var obj = jQuery.parseJSON(data);
				if(obj.inscripta) {
   	     	    	$('#mensaje').html("<p><font color='red'>Existen las siguientes superposiciones horarias entre las comisiones:</p><p>Materia a inscribir: "+obj.noinscripta+"</p><p>Materia inscripta: "+obj.inscripta+"</font></p>");
   	         	   	//$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
	   	    	} else {
		   	     	$.post("<?php echo url_for('inscripciones/inscribirmateria'); ?>",
		   	     	    { idcomision: Idcomision, idalumno: <?php echo $alumno->getIdalumno(); ?> },
		   	     	    function(data){
		   	     	    	$('#mensaje').html(data);
		   	         	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
		   	         	}
		   	 		);
	   	   	    }
    	    });
		return false;		
	});

	$(".botonEliminar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Elimina el profesor a dicha mesa de examen
    	$.post("<?php echo url_for('inscripciones/eliminarinscripcionmateria'); ?>",
    	    { idcomision: Id, idalumno: <?php echo $alumno->getIdalumno(); ?> },
    	    function(data){
    	    	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");
        	}
		);
		return false;
	});	

	$(".botonSolicitar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('inscripciones/solicitarlibredeuda'); ?>",
    			{ id: Id, idalumno: <?php echo $alumno->getIdalumno(); ?>, tipo: 1 },
    	    function(data){
    			$('#mensaje').html(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
        	}
		);
		return false;
	});			
});
</script>
<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Inscripción para cursar a Materias</h1>
	</td>
	</tr>
</table>
<blockquote>
<p style="font-size:12px">
	Alumno: <?php echo $alumno->getPersonas()->getApellido().", ".$alumno->getPersonas()->getNombre() ?><br>
	Id alumno: <?php echo $alumno->getIdalumno() ?><br>
	Nro. documento: <?php echo $alumno->getPersonas()->getNrodoc() ?><br>
</p>	
</blockquote>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
	<?php if (!$solicitudpermitida) { ?>
  <tr>
    <td colspan="2" class="hed"><b><font color=red>El alumno tiene solicitudes de Libre Deuda pendientes que debe responder Administración.</font></b></td>
  </tr>  	
  	<?php } ?>
	<?php if (!$estadolibredeuda) { ?>
  <tr>
    <td colspan="2" class="hed"><b><font color=red>Debe consultar en Administración por su Libre Deuda.</font></b></td>
  </tr>  	
  	<?php } ?>
	<?php if (!$activo) { ?>
  <tr>
    <td colspan="2" class="hed"><b><font color=red>Se debe inscribir al Ciclo Lectivo previamente.</font></b></td>
  </tr>  	
  	<?php } ?>  
	<?php if (!$documentacionhabilitada) { 	?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Debe consultar en Secretaría porque existe documentación pendiente.</font></b></div></td>
  </tr>  	
  	<?php } ?>    	
  	<?php if (!$estadodocumentacion) { ?>
  <tr>
    <td colspan="2" class="hed"><b><font color=red>El alumno debe presentar documentación pendiente.</font></b></td>
  </tr>
 	<?php } ?>  
  	<?php if (!$entregaencuesta) { ?>
  <tr>
    <td colspan="2" class="hed"><b><font color=red>El alumno debe presentar la encuesta de alumno pendiente.</font></b></td>
  </tr>  
  	<?php } ?>  
	<?php if (!$periodohabilitado) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Se debe inscribir en un periodo habilitado.</font></b></div></td>
  </tr>  
  	<?php } ?>     	  
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"></div></td>
  </tr>  	  	
  <tr>
    <td colspan="2" class="hed">Materias a cursar:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    	<form id="formInscribir" action=""> 
		<table width="100%" cellspacing="0" class="stats">
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Curso</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	     
		      <td class="hed" align="center" width="15%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php if (count($materiashabilitadas) > 0) { ?>
            <?php $i=0; ?>	
		    <?php 
		    foreach ($materiashabilitadas as $materia_plan): 
		    	$comisiones = $materia_plan->getMateriasPlanes()->obtenerComisiones($idsede);
		    ?>
		    <tr class="fila_<?php echo $i%2; ?>">
		      <td align="center"><?php echo $materia_plan->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia_plan->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia_plan->getMateriasPlanes()->getAnodecursada(); ?></td>
		      <td align="center">
		      <select id="idcomision_<?php echo $materia_plan->getIdmateriaplan(); ?>" name="comisiones[<?php echo $materia_plan->getIdmateriaplan(); ?>]">
		      <?php foreach ($comisiones as $comision) { ?>
				  <option value="<?php echo $comision->getIdcomision(); ?>"><?php echo $comision->getNombre(); ?></option>
		      <?php } ?>
		      </select>
		      </td>		      
			  <td align="center">
				<?php if($estadolibredeuda && $periodohabilitado && $activo && $documentacionhabilitada && $estadodocumentacion && $entregaencuesta) { ?>
						<input type="submit" class="botonInscribir" id="<?php echo $materia_plan['idmateriaplan']; ?>" value="Inscribir" title="Inscribir" >
				<?php } else { ?>
					<?php if (!$estadolibredeuda && $solicitudpermitida) { ?>
							<input type="submit" class="botonSolicitar" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" id="<?php echo $materia_plan['idmateriaplan']; ?>" >
					<?php } ?>		
				<?php } ?>
			  </td>
		    </tr>
			<?php
				$i++; 
			endforeach; 
		    } else { 
			?>
		     <tr>
		      <td align="center" colspan="5">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		  </tbody>
		</table>
		</form>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Materias inscriptas:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Curso</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	
		      <td class="hed" align="center" width="15%">Cupo</td>		      
		      <td class="hed" align="center" width="15%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($materiasinscriptas) > 0) { ?>
		    <?php foreach ($materiasinscriptas as $comision): ?>
		    <form id="formEliminar" action="">  
			    <tr>
			      <td align="center"><?php echo $comision->getCatedras()->getIdmateriaplan(); ?></td>
			      <td><?php echo $comision->getCatedras()->getMateriasPlanes(); ?></td>
			      <td align="center"><?php echo $comision->getCatedras()->getMateriasPlanes()->getAnodecursada(); ?></td>
			      <td align="center"><?php echo $comision; ?></td>
			      <td align="center"><?php echo $comision->obtenerCantidadInscriptos(); ?>/<?php echo $comision->getCapacidad(); ?></td>
			      <td align="center">
			      	<?php if(($periodohabilitado || $alumno->getIdplanestudio()==168) and ($comision->getCatedras()->getMateriasPlanes()->getPeriododecursada()==$periododecursada)){ ?>
        		    	<input type="hidden" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
						<input type="submit" class="botonEliminar" id="<?php echo $comision->getIdcomision(); ?>" value="Eliminar" title="Eliminar" >
					<?php } ?>
			      </td>
			    </tr>
		    </form>	
		    <?php endforeach; ?>
		    <?php } else { ?>
				<tr>
					<td align="center" colspan="6">No existen registros.</td>
				</tr>
		    <?php } ?>	
		    	<tr class="fila_importante">
		    		<td colspan="6" ><strong>Las inscripciones a materias pueden estar sujetas a cambios en caso de que personal administrativo considere necesario modificarlos. Agende el numero de tramite para consultar. Recordar que solo podrás borrarte en período de inscripciones para cursar.</strong></td>
		    	</tr>		    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>
