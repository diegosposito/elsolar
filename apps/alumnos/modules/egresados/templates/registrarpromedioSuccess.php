<script>
$(document).ready(function(){
	
	$('#botonGuardar').click(function(){
		// Crea las comisiones
    	$.post("<?php echo url_for('egresados/actualizarpromedio'); ?>",
    		{idalumno: <?php echo $alumno->getIdalumno(); ?>, promedio: $("#promedio").val()},
    	   	function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('egresados/buscaregresados'); ?>");
        	}
		);
		return false;
	});    
});
</script>
<h1>Registro de Promedio de un Egresado</h1>
<div align="center">
<form action="" method="post">
<table cellspacing="0" class="stats" width="100%">
<tr>
	<td width="15%"><b>Persona:</b></td>
	<td><?php echo $alumno->getPersonas()->getApellido().", ".$alumno->getPersonas()->getNombre(); ?></td>
</tr>
<tr>
	<td width="15%"><b>Carrera:</b></td>
	<td><?php echo $alumno->getPlanesEstudios()->getCarreras(); ?></td>
</tr>
<tr>
	<td><b>Promedio:</b></td>
	<td>
		<input type="text" name="promedio" id="promedio" size="5" value="<?php echo $alumno->getPromedio(); ?>">
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Guardar" title="Guardar" id="botonGuardar"></td>
</tr>
</table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('egresados/buscaregresados') ?>'"></p>
<br>