<script>
$(document).ready(function(){	  
	$('#fechaemision').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot(); ?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});   
 
    $('.botonModificarEstudio').click(function() {
    	var Id = $(this).attr("id");
		// modificar la documentacion laboral de la persona
   	    $.post("<?php echo url_for('personas/modificarestudioprevio'); ?>",
   	    	{ idestudio: Id },
   			function(data){
				$('#idestudio').val(Id);   	  
   	    		$('#titulo').val(data.titulo);
				$('#nivel').val(data.nivel);
				$('#categoria').val(data.categoria);
				$('#establecimiento').val(data.establecimiento);
				$('#provinciaestablecimiento').attr('disabled',false);
				$('#ciudadestablecimiento').attr('disabled',false);	
				$('#paisestablecimiento').val(data.paisestablecimiento);
		        // cargar las provincias de la carrera al combo
		        cargarComboProvincias('#provinciaestablecimiento', data.paisestablecimiento, data.provinciaestablecimiento);
				$('#provinciaestablecimiento').val(data.provinciaestablecimiento);
		        // cargar las ciudades de la carrera al combo
		        cargarComboCiudades('#ciudadestablecimiento', data.provinciaestablecimiento, data.ciudadestablecimiento);				
				$('#ciudadestablecimiento').val(data.ciudadestablecimiento);
				//$('#fechaemision').val(data.fechaemision);
				$('#duracion').val(data.duracion);
				$('#unidadtiempo').val(data.unidadtiempo);
				$('#concluyo_'+data.concluyo).attr("checked", "checked");	
				$('#continua_'+data.continua).attr("checked", "checked");
				//$('#formaciondocente').attr("checked", false);
				$('#formaciondocente').attr(data.formaciondocente, data.formaciondocente);		
				$('#numerototal').val(data.numerototal);
				$('#numeroaprobadas').val(data.numeroaprobadas);
				$('#anioingreso').val(data.anioingreso);
				$('#anioegreso').val(data.anioegreso);
				$('#promedio').val(data.promedio);
		
   			}, "json"
   	   	);
		return false;
   	});     
    $('.botonEliminarEstudio').click(function() {
    	var Id = $(this).attr("id");
		// eliminar el estudio previo de la persona
   	    $.post("<?php echo url_for('personas/eliminarestudioprevio'); ?>",
   	    	{ idestudio: Id },
   			function(data){
   	    		$('#mensajeEstudio').html("El estudio previo ha sido eliminado correctamente.");
				// obtener la lista de estudios previos de la persona
				cargarEstudiosPrevios($('#idpersona').val());					
   			}
   	   	);
		return false;
   	});   

});

//Valida el formulario
function validarEstudioPrevio(){
	var regexpfecha = /^((?:0?[1-9])|(?:[12]\d)|(?:3[01]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:19|20)\d\d)$/;
	var resultado = true;	

	//if (!regexpfecha.test($('#fechaemision').val())) {
	//	resultado = "Debe ingresar una Fecha de Emisión válida.";
	//}			
	//if (!$('#duracion').val()!="") {
	//	resultado = "Debe ingresar una Duración.";
	//}	 				
	if($('#ciudadestablecimiento').attr('disabled')) {
		resultado = "Debe seleccionar una Ciudad.";
	} 
	if(!$('#establecimiento').val()!="") {
		resultado = "Debe ingresar un Establecimiento.";
	}   
	if(!$('#titulo').val()!="") {
		resultado = "Debe ingresar un Título.";
	} 
  
	return resultado;
} 
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
	<thead>
		<tr>
			<td class="hed" align="center">Título</td>
			<td class="hed" align="center">Nivel</td>
			<td class="hed" align="center">Establecimiento</td>
			<td class="hed" width="23%" align="center">Acciones</td>
		</tr>
	</thead>
	<tbody>
	<?php if (count($estudiosprevios) > 0) {?>
		<?php foreach ($estudiosprevios as $estudio) { ?>
			<tr>
				<td><?php echo $estudio->getDescripcion() ?></td>
				<td align="center"><?php echo $estudio->getNivelesEstudios() ?></td>
				<td><?php echo $estudio->getEstablecimiento() ?></td>
				<td align="center">
				<input type="submit" class="botonModificarEstudio" id="<?php echo $estudio->getIdestudio(); ?>"  value="Modificar" />
				<input type="submit" class="botonEliminarEstudio" id="<?php echo $estudio->getIdestudio(); ?>"  value="Eliminar" />
				</td>
			</tr>	        	
		<?php } ?>
	<?php } else { ?>
			<tr>
				<td colspan="4" align="center">No existen estudios previos cargados.</td>
			</tr>	   	
	<?php } ?>	        	
	</tbody>
</table>
</div>
