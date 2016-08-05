<script>
$(document).ready(function(){    
	$(".botonInscribir").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/inscribirmateria'); ?>",
    	    { idcomision: Id, idalumno: <?php echo $alumno->getIdalumno(); ?> },
    	    function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriaspreuniversitario?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
        	}
		);
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
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriaspreuniversitario?idalumno='.$alumno->getIdalumno()); ?>");
        	}
		);
		return false;
	});		
});
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2" class="hed">Alumno: <?php echo $alumno->getPersonas(); ?></td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Materias a cursar:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    	<form id="formInscribir" action=""> 
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Curso</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	 
		      <td class="hed" align="center" width="15%">Cupo</td>    
		      <td class="hed" align="center" width="15%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php if (count($materiashabilitadas) > 0) { ?>	
		    <?php foreach ($materiashabilitadas as $materia_plan):
		    	$comisiones = $materia_plan->obtenerComisiones($alumno->getIdsede());
	    
				foreach($comisiones as $comision):		
					if ($comision->getActivo()) {    
		    ?>
		    <tr>
		      <td><?php echo $materia_plan; ?></td>
		      <td align="center"><?php echo $materia_plan->getAnodecursada(); ?></td>
		   	  <form id="formInscribir_<?php echo $materia_plan->getIdmateria(); ?>" action=""> 
		        <td align="center"><?php echo $comision->getDescripcion(); ?></td>		      
	            <td align="center"><?php echo $comision->obtenerCantidadInscriptos(); ?>/<?php echo $comision->getCapacidad(); ?></td>	
			    <td align="center" width="30%">
					<input type="hidden" id="idalumno" value="<?php echo $alumno->idalumno; ?>"  >					
					<input type="submit" class="botonInscribir" id="<?php echo $comision->getIdcomision(); ?>" value="Inscribir" title="Inscribir" >									    
				</td>
			  </form>	
		    </tr>
		    <?php 
					}
		    	endforeach;
		    endforeach;   
		    } else { ?>
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
		      <!--	
		      <td class="hed" align="center" width="5%">Id</td>
		      -->
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Curso</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	
		      <td class="hed" align="center" width="15%">Cupo</td>		      
		      <td class="hed" width="15%"></td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($materiasinscriptas) > 0) { ?>
		    <?php foreach ($materiasinscriptas as $comision): ?>
		    <form id="formEliminar" action="">  
			    <tr>
			      <!--	
			      <td align="center"><?php echo $comision->getIdcatedra(); ?></td>
			      -->
			      <td><?php echo $comision->getCatedras()->getMateriasPlanes(); ?></td>
			      <td align="center"><?php echo $comision->getCatedras()->getMateriasPlanes()->getAnodecursada(); ?></td>
			      <td align="center"><?php echo $comision->getDescripcion(); ?></td>
			      <td align="center"><?php echo $comision->obtenerCantidadInscriptos(); ?>/<?php echo $comision->getCapacidad(); ?></td>
			      <td align="center">
			      	<input type="hidden" id="idalumnopre" value="<?php echo $alumnopre->getIdalumno(); ?>"  >
        		    <input type="hidden" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
					<input type="submit" class="botonEliminar" id="<?php echo $comision->getIdcomision(); ?>" value="Eliminar" title="Eliminar" >
			      </td>
			    </tr>
		    </form>	
		    <?php endforeach; ?>
		    <?php } else { ?>
		     <tr>
		      <td align="center" colspan="6">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>