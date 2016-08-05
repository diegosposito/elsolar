<script>
$(document).ready(function(){
	$('#fechaegreso').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	$('#fechaegreso').datepicker("setDate", "<?php echo $fecha; ?>");  
	
	$('#botonActualizar').click(function(){
		// Crea las comisiones
    	$.post("<?php echo url_for('egresados/actualizaregresado'); ?>",
    		{idalumno: <?php echo $alumno->getIdalumno(); ?>, idplanestudio: <?php echo $alumno->getIdplanestudio(); ?>, fechaegreso: $("#fechaegreso").val()},
    	   	function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('egresados/buscar'); ?>");
        	}
		);
		return false;
	});    
});
</script>
<h1>Registro de Egresados por Carrera</h1>
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
	<td><b>Fecha Egreso:</b></td>
	<td>
		<input type="text" name="fechaegreso" id="fechaegreso" size="8">
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Actualizar a egresado" title="Actualizar a egresado" id="botonActualizar"></td>
</tr>
</table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('egresados/buscar') ?>'"></p>
<br>