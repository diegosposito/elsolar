<script>
$(document).ready(function(){
	// por defecto deshabilitar el formulario
	deshabilitarFormulario(true);
    $('.botonModificarProfesion').click(function() {
    	var Id = $(this).attr("id");
		// modificar la documentacion laboral de la persona
   	    $.post("<?php echo url_for('personas/modificardocumentacionlaboral'); ?>",
   	    	{ iddoclaboral: Id },
   			function(data){
   	    		deshabilitarFormulario(false);
   	    		$('#trabaja').val(2);
				$('#profesion').val(data.profesion);
				$('#dedicacion').val(data.dedicacion);
				$('#lugar').val(data.lugar);
				$('#certificado_'+data.certificado).attr("checked", "checked");	
				$('#iddoclaboral').val(Id);
				
   			}, "json"
   	   	);
		return false;
   	});   
    $('.botonELiminarProfesion').click(function() {
    	var Id = $(this).attr("id");
		// eliminar la documentacion laboral de la persona
   	    $.post("<?php echo url_for('personas/eliminardocumentacionlaboral'); ?>",
   	    	{ iddoclaboral: Id },
   			function(data){
				alert("La documentación laboral ha sido eliminada correctamente.");
				// obtener la lista de documentacion laboral previos de la persona
				cargarDocumentacionesLaborales($('#idpersona').val());					
   			}
   	   	);
		return false;
   	});     	   	 
    $('#trabaja_1').change(function(){
        // habilitar el formulario
    	deshabilitarFormulario(true);
    });	
    $('#trabaja_2').change(function(){
        // habilitar el formulario
    	deshabilitarFormulario(false);
    });	      	 	    	
});

//Cargar estudios previos
function deshabilitarFormulario(estado){
	$('#profesion').attr('disabled', estado);
	$('#dedicacion').attr('disabled', estado);
	$('#lugar').attr('disabled', estado);
	$('#certificado_1').attr('disabled', estado);
	$('#certificado_2').attr('disabled', estado);	
	$('.botonAgregarProfesion').attr('disabled', estado);
} 
</script>
<div align="center">
<table cellspacing="0" class="stats" width="90%">
	<thead>
		<tr>
	        <td class="hed">Profesión</td>
	        <td class="hed">Dedicación</td>
	        <td class="hed">Lugar de Trabajo</td>
	        <td class="hed">Comprobante</td>
	        <td class="hed" width="5%"></td>
		</tr>
	</thead>
	<tbody>
	<?php if (count($documentacioneslaborales) > 0) {?>
       	<?php foreach ($documentacioneslaborales as $documentacion) { ?>
			<tr>
        		<td><?php echo $documentacion->getProfesiones() ?></td>
        		<td><?php echo $documentacion->getHoras() ?></td>
        		<td><?php echo $documentacion->getLugar() ?></td>
        		<td><?php if ($documentacion->getCertificado()==1) { echo "No"; } else { echo "Si"; } ?></td>
        		<td>
        		<input type="submit" class="botonModificarProfesion" id="<?php echo $documentacion->getIddoclaboral(); ?>"  value="Modificar" />
        		<input type="submit" class="botonEliminarProfesion" id="<?php echo $documentacion->getIddoclaboral(); ?>"  value="Eliminar" />
        		</td>
			</tr>	        	
		<?php } ?>
	<?php } else { ?>
			<tr>
				<td colspan="5" align="center">No existen documentacion laboral previos cargado.</td>
			</tr>	   	
	<?php } ?>	        	
	</tbody>
</table>
</div>