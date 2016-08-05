<script>  
$(document).ready(function(){ 
	$(".botonInscribir").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		var Idcomision = $("#idcomision_"+Id).val();
		var Idalumno = $("#idalumno_"+Id).val();

    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/inscribirmateria'); ?>",
    	    { idcomision: Idcomision, idalumno: Idalumno },
    	    function(data){
    	    	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriaspreuniversitario?idalumno='.$idalumno); ?>");	    	     	    	
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
	Id alumno: <?php echo $idalumno ?><br>
	Nro. documento: <?php echo $alumno->getPersonas()->getNrodoc() ?><br>
</p>
</blockquote>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
<?php if (!$habilitado) { ?>
  <tr>
    <td colspan="2" ><font color="red">No esta habilitada la inscripción al preuniversitario.</font></td>
  </tr>
<?php } ?> 	
	<?php if (!$activo) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Se debe inscribir al Ciclo Lectivo previamente.</font></b></div></td>
  </tr>  	
  	<?php } ?>
  <tr>
    <td colspan="2" class="hed">Materias Pre-Universitario:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    	<form id="formInscribir" action=""> 
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	     
		      <td class="hed" align="center" width="15%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php if (count($materiashabilitadas) > 0) { ?>
            <?php $i=0; $j=0;?>	
		    <?php 
		    foreach ($materiashabilitadas as $materia_plan): 
		    	$comisiones = $materia_plan->obtenerComisiones($alumno->getIdsede());
		    	foreach($comisiones as $comision):
		    		if ($comision->getInscripcionhabilitada() and ($comision->getCatedras()->getActiva()) and ($comision->getCatedras()->getIdsede()==$alumno->getIdsede())) {
		    ?>
		    <tr class="fila_<?php echo $i%2; ?>">
		      <td><?php echo $materia_plan->getMaterias()->getNombre(); ?></td>
		      <td align="center"><?php echo $comision->getNombre(); ?></td>		      
			    <td align="center" width="30%">
			      	<?php echo button_to('Ver Horarios', 'calendar', array('popup' => array('Window title', ''))) ?>	
					<input type="hidden" name="idcomision" id="idcomision_<?php echo $comision->getIdcomision(); ?>" value="<?php echo $comision->getIdcomision(); ?>"   >
					<input type="hidden" name="idmateria" id="idmateria" value="<?php echo $materia_plan->getIdmateria(); ?>"   >
					<input type="hidden" name="idalumno" id="idalumno_<?php echo $comision->getIdcomision(); ?>" value="<?php echo $idalumnos[$materia_plan->getIdmateriaplan()]; ?>"   >
					<input type="submit" class="botonInscribir" id="<?php echo $comision->getIdcomision(); ?>" value="Inscribir" title="Inscribir" <?php echo ( ($habilitado) ? '' : 'disabled="disabled"'); ?> >									    
				</td>
		    </tr>
			<?php
					$j++;
					}
				endforeach;
				$i++; 
			endforeach; 
			if ($j==0){
			?>
		     <tr>
		      <td align="center" colspan="3">No existen registros.</td>
		     </tr>			
			<?php 
			}
		    } else { 
			?>
		     <tr>
		      <td align="center" colspan="3">No existen registros.</td>
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
		      <td class="hed" align="center" width="50%">Materia</td>
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
			      <td><?php echo $comision->getCatedras()->getMateriasPlanes(); ?></td>
			      <td align="center"><?php echo $comision; ?></td>
			      <td align="center"><?php echo $comision->obtenerCantidadInscriptos(); ?>/<?php echo $comision->getCapacidad(); ?></td>
			      <td align="center">
			      <?php echo button_to('Ver Horarios', 'calendar', array('popup' => array('Window title', ''))) ?>
			      </td>
			    </tr>
		    </form>	
		    <?php endforeach; ?>
		    <?php } else { ?>
				<tr>
					<td align="center" colspan="4">No existen registros.</td>
				</tr>
		    <?php } ?>		    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>