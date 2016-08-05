<script>
$(document).ready(function(){	  
	$(".botonEliminarVacia").click(function(){   
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Controla y cierra la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/eliminarmesa'); ?>",
    			{ idmesaexamen: Id },
    	    	function(data){
        	    	//$('#formBuscar').submit(); 
        	    	alert(data);
					// obtener la lista de estudios previos de la persona
					cargarMesasExamenesVacias(<?php echo $idplanestudio; ?>);	        	    	
        	    }
		);		
		return false;
	}); 	 	 	
});

//Cargar estudios previos
function cargarMesasExamenesVacias(id){
	// obtener la lista de estudios previos de la persona
	$.get("<?php echo url_for('mesasexamenes/obtenermesasvacias'); ?>",
	    { idplanestudio: id },
		function(data){
			$('#mesasexamenes').html(data);
		}
	);   	
} 
</script>
<table cellspacing="0" class="stats" width="100%">
  <thead>
    <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center">Materia</td>
      <td class="hed" align="center" width="15%">Fecha</td>
      <td class="hed" align="center">Condición</td>
      <td class="hed" align="center">Estado</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
	<?php if (count($mesasexamenesvacias)>0) {?>
		<?php foreach ($mesasexamenesvacias as $mesa): ?>
			<tr>
				<td align="center" width="5%"><?php echo $mesa->idmesaexamen ?></td>
				<td><?php echo $mesa->getCatedras()->getMateriasPlanes() ?></td>
				<td align="center"><?php echo $mesa->fecha." - ".$mesa->hora; ?></td>
				<td align="center"><?php echo $mesa->getCondicionesMesas() ?></td>
				<td align="center"><?php echo $mesa->getEstadosMesasExamenes() ?></td>
				<td align="center" width="5%">
			      	<form action="" id="formEliminar" >
			      		<input class="botonEliminarVacia" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Eliminar">
			      	</form>					
				</td>
			</tr>
		<?php endforeach; ?>
	<?php } else {?>
		<tr>
			<td colspan="7" align="center">No existen mesas de examenes.</td>
		</tr>		    
	<?php } ?>	    
  </tbody>
</table>