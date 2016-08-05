<script>
$(document).ready(function(){
	if($('#materias_genericas_idmateriaplan option').length==0) {
		$('#materias_genericas_idmateriaplan').attr('disabled',true);
		$('#materias_genericas_valormateria').attr('disabled',true);
		$('.botonAgregarOptativa').attr('disabled',true);
	}
    $('.botonEliminarOptativa').click(function() {
    	var Id = $(this).attr("id");
    	if(confirm("Esta seguro?")) { 
			// guardar la informacion de documentacion del aspirante ingresada
	   	    $.post("<?php echo url_for('materiasgenericas/eliminar'); ?>",
	   	    	{idmateria: Id},
	   			function(data){
		   	     	$.post("<?php echo url_for('materiasplanes/obtenermateriasoptativas'); ?>",
		   	     	    { idmateriaplan: $('#materias_planes_idmateriaplan').val() },
		   	     		function(data){
		   	     			$('#materiasOptativas').html(data);
		   	     		}
		   	     	);   
	   			}
	   	   	);
    	}
		return false;
   	}); 

    $('.botonAgregarOptativa').click(function() {
		// guardar la informacion de documentacion del aspirante ingresada
   	    $.post("<?php echo url_for('materiasgenericas/agregar'); ?>",
   	    	$('#formAgregarOptativa').serialize(),
   			function(data){
	   	     	$.post("<?php echo url_for('materiasplanes/obtenermateriasoptativas'); ?>",
	   	     	    { idmateriaplan: $('#materias_planes_idmateriaplan').val() },
	   	     		function(data){
	   	     			$('#materiasOptativas').html(data);
	   	     		}
	   	     	);   
   			}
   	   	);
		return false;
   	}); 
});
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
	<tr>
	<td>
		<?php include_partial('formGenerica', array('form' => $form)) ?>
	</td>
	</tr>
	<tr>
	<td>
		<table cellspacing="0" class="stats" width="100%">
			<thead>
				<tr>
					<td class="hed" width="5%" align="center">Id</td>
					<td class="hed" width="70%" align="center">Asignatura</td>
					<td class="hed" width="20%" align="center">Valor</td>
					<td class="hed" width="5%" align="center">Acciones</td>
				</tr>
			</thead>
			<tbody>
			<?php if (count($materiasoptativas) > 0) {?>
				<?php foreach ($materiasoptativas as $materia) { ?>
					<tr>
						<td align="center"><?php echo $materia->getIdmateriaplan() ?></td>
						<td><?php echo $materia->getMateriasComponentes() ?></td>
						<td align="center"><?php echo $materia->getValormateria() ?></td>
						<td align="center">
						<input type="submit" class="botonEliminarOptativa" id="<?php echo $materia->getId(); ?>"  value="Eliminar" />
						</td>
					</tr>	        	
				<?php } ?>
			<?php } else { ?>
					<tr>
						<td colspan="4" align="center">No existen asignaturas optativas cargadas.</td>
					</tr>	   	
			<?php } ?>	        	
			</tbody>
		</table>
	</td>
	</tr>
</table>
</div>