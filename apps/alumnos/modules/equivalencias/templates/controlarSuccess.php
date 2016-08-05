<script>
$(document).ready(function(){
   $(".botonAprobar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");	 
    	// Controla y aproba la equivalencia pendiente
    	$.post("<?php echo url_for('equivalencias/aprobar'); ?>",
    		{ idmateriaequivalencia: Id },
    	    function(data){
        	   alert(data);
         	   $(location).attr('href',"<?php echo url_for('equivalencias/controlar?idequivalencia='.$equivalencias_alumnos->getIdequivalencia()); ?>");
        	}
		);		
    	return false;
   	});	  	
}); 

</script>
<h1>Controlar Equivalencias Pendientes</h1>
<br>
<div align="center">
  <table cellspacing="0" class="stats" width="80%">
  <tbody>
    <tr>
      <td width="22%"><b>Id:</b></td>
      <td><?php echo $equivalencias_alumnos->getIdequivalencia() ?></td>
    </tr>
    <tr>
      <td><b>Alumno:</b></td>
      <td><?php echo $equivalencias_alumnos->getAlumnos()->getPersonas() ?></td>
    </tr>
    <tr>
      <td><b>Fecha:</b></td>
      <td><?php echo $equivalencias_alumnos->getFecha() ?></td>
    </tr>
    <tr>
      <td><b>Fecha de resolución:</b></td>
      <td><?php echo $equivalencias_alumnos->getFecharesolucion() ?></td>
    </tr>
    <tr>
      <td><b>Nro. de resolución:</b></td>
      <td><?php echo $equivalencias_alumnos->getNroresolucion() ?></td>
    </tr>
    <tr>
      <td><b>Observaciones:</b></td>
      <td><?php echo $equivalencias_alumnos->getObservaciones() ?></td>
    </tr>
    <tr>
      <td colspan="2">
		<table width="100%" cellspacing="0" class="stats">
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="80%">Materia</td>
		      <td class="hed" align="center" width="7%">Curso</td>
		      <td class="hed" align="center" width="7%">Estado</td>
		      <td class="hed" align="center" width="7%">Acciones</td>
		    </tr>
		    <?php 
		    if (count($materias_equivalencias) > 0) { 
				$materias_habi = $equivalencias_alumnos->getAlumnos()->obtenerMateriasHabilitadas('R','L');
				foreach($materias_habi as $materia_h) {
					$materias_habilitadas[$materia_h['idmateriaplan']] = $materia_h['idmateriaplan'];
				}
		    	foreach ($materias_equivalencias as $materia) {
					$resultado = 0;
					if (in_array((int)$materia->getIdmateriaplan(), $materias_habilitadas)) {
						if($materia->getIdestadoequivalencia()==2) {
							$color = "bgcolor='green'";
							$resultado = 1;
						} else {
							$color = "bgcolor='red'";
						}
					} else {
						$color ="";
					}
		    ?>
		    <tr class="fila_" <?php echo $color; ?>>
		      <td align="center"><?php echo $materia->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia->getMateriasPlanes()->getAnodecursada(); ?></td>
		      <td><?php echo $materia->getEstadosEquivalencias(); ?></td>
		      <td align="center">
			      <?php if ($resultado==1) { ?>
					<form id="formAprobar">	
						<input class="botonAprobar" id="<?php echo $materia->getId(); ?>" type="submit" value="Aprobar">
					</form> 		 			      
			      <?php } ?>
		      </td>		      
		    </tr>
		    <?php 
				} 
			} else { 
			?>
		     <tr>
		      <td align="center" colspan="5">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		</table>      
      </td>
    </tr>    
  </tbody>
</table>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for($link) ?>'"></p>
<br>
