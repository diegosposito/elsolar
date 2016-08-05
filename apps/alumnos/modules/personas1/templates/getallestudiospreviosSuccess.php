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
   	    $.post("<?php echo url_for('aspirante/modificarestudioprevio'); ?>",
   	    	{ idestudio: Id },
   			function(data){
				$('#idestudio').val(Id);   	  
   	    		$('#titulo').val(data.titulo);
				
				$('#categoria').val('1');
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
                
                cargarNivelesEstudios('#nivel', data.formaciondocente, data.nivel);
				//$('#nivel').val(data.nivel-1);
				$('#fechaemision').val(data.fechaemision);
				$('#duracion').val(data.duracion);
				$('#unidadtiempo').val(data.unidadtiempo);
				//$('#concluyo_'+data.concluyo).attr("checked", "checked");	
				//$('#continua_'+data.continua).attr("checked", "checked");
				$('#concluyo').attr('checked', data.concluyo==1 ? true :false);
				$('#continua').attr('checked', data.continua==1 ? true :false);	
				$('#numerototal').val(data.numerototal);
				$('#numeroaprobadas').val(data.numeroaprobadas);
				$('#anioingreso').val(data.anioingreso);
				$('#anioegreso').val(data.anioegreso);
				$('#promedio').val(data.promedio);
				$('#formaciondocente').attr('checked', data.formaciondocente);

				if(data.concluyo==1){  
			    	$('#idanioingreso').hide();
			    	$('#idanioegreso').show();
		        } else {
			        $('#idanioingreso').show();
			        $('#idanioegreso').hide();
       			 }

			//	$('.myCheckbox').attr('checked', true);
		
   			}, "json"
   	   	);
		return false;
   	});     
    $('.botonEliminarEstudio').click(function() {
    	var Id = $(this).attr("id");
		// eliminar el estudio previo de la persona
   	    $.post("<?php echo url_for('aspirante/eliminarestudioprevio'); ?>",
   	    	{ idestudio: Id },
   			function(data){
   	    		$('#mensajeEstudio').html("El estudio previo ha sido eliminado correctamente.");
				// obtener la lista de estudios previos de la persona
				cargarEstudiosPrevios($('#idpersona').val());					
   			}
   	   	);
		return false;
   	});   

    $('.botonAsociarEstudio').click(function() {
    	var Id = $(this).attr("id");
		// eliminar el estudio previo de la persona
   	    $.post("<?php echo url_for('aspirante/asociarestudioprevio'); ?>",
   	    	{ idestudio: Id, idpersona: $('#idpersona').val() },
   			function(data){
   	    		$('#mensajeEstudio').html("El estudio previo ha sido asociado correctamente.");
				// obtener la lista de estudios previos de la persona
				cargarEstudiosPrevios($('#idpersona').val());					
   			}
   	   	);
		return false;
   	});     	   	  	    	
});

//Valida el formulario
function validarEstudioPrevio(){
	var resultado = true;	

	/*var year = $("#anioingreso").val();
    var currdate = new Date();
    if ((currdate.getFullYear() - year) > 0){
        resultado = "El año seleccionado no puede superar el año actual!!";
    }*/
   
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
// Cargar combo de niveles estudios
function cargarNivelesEstudios(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('nivelesestudios/obtenerniveles'); ?>",
    	    { formaciondocente: id },
    	    function(data){
	    	    $(combo).html(data);
	    	    $(combo).attr('disabled',false);
	    	    $(combo).val(idseleccionado);
    	    }
	); 	
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
				<td colspan="4" align="center">No existen estudios cargados previamente.</td>
			</tr>	   	
	<?php } ?>	        	
	</tbody>
</table>
</div>
