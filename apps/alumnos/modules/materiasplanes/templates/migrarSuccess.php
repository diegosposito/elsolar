<script>
$(document).ready(function(){    
	$('#tablaOrigen').tableScroll({height:200});
	$('#tablaDestino').tableScroll({height:200});
	$('#botonGuardar').click(function(){
		var arr = [];
		$("#tablaDestino tbody tr").each(function (index) {
		 	$(this).children("td").each(function (index2) {
		 		switch (index2) {
		 			case 0:
		 				 arr.push($(this).text());
						break;
				}
			});
		});
	    $.post("<?php echo url_for('materiasplanes/guardar'); ?>",
    	    { materiasplanes: arr, idplanestudio: <?php echo  $idplandestino; ?> },
    	    function(data){
        	   	alert(data);
        	}
        );		
	});	
});

function botonAgregar(Id){
	// Borra la fila 0 si existe
	$('#fila_0').remove();
	// Agrega la fila seleccionada en la otra tabla
	$('#tablaDestino').append($("#fila_"+Id).remove());	
	// Vacia la celda y agrega el boton que corresponde
	$('#fila_'+Id+'_boton').empty();
	$('#fila_'+Id+'_boton').html("<input type='button' value='Eliminar' onclick='botonEliminar("+Id+")'>");
	// Si la cantidad de fila es 0, agrega el mensaje
	if($('#tablaOrigen tr').length == 0){
		$('#tablaOrigen').append("<tr id='fila_0_boton'><td colspan='11' align='center'>No existen asignaturas designadas a este plan de estudios.</td></tr>");
	}		
}
function botonEliminar(Id){
	// Borra la fila 0 si existe
	$('#fila_0').remove();
	// Agrega la fila seleccionada en la otra tabla
	$('#tablaOrigen').append($("#fila_"+Id).remove());	
	// Vacia la celda y agrega el boton que corresponde	
	$("#fila_"+Id+"_boton").empty();
	$("#fila_"+Id+"_boton").append("<input type='button' value='Agregar' onclick='botonAgregar("+Id+")'>");
	// Si la cantidad de fila es 0, agrega el mensaje
	if($('#tablaDestino tr').length == 0){
		$('#tablaDestino').append("<tr id='fila_0_boton'><td colspan='11' align='center'>No existen asignaturas designadas a este plan de estudios.</td></tr>");
	}	
} 

</script>
<h1>Migrar Asignaturas por Plan de Estudios</h1>
<br>
<table width="100%" class="stats" cellspacing="0">
	<tr>
    	<td align="center">
			<input type="button" id="botonGuardar" value="Guardar">
    	</td>
    </tr>
    <tr>
    <td>
		<table id="tablaOrigen" width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		       <td class="hed" align="center">Id</td>
		       <td class="hed" align="center">Asignatura</td>
		       <td class="hed" align="center">Tipo</td>
		       <td class="hed" align="center">Carga horaria total</td>
		       <td class="hed" align="center">Carga horaria semanal</td>
		       <td class="hed" align="center">Orden</td>
		       <td class="hed" align="center">Año</td>
		       <td class="hed" align="center">Periodo</td>
		       <td class="hed" align="center">Tipo de cursada</td>       
		       <td class="hed" align="center">Codigo</td>
		       <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($materias_origen) > 0) { ?>
		    <?php foreach ($materias_origen as $materia_origen): ?>
		    <tr id="fila_<?php echo $materia_origen->getIdmateriaplan() ?>">
		      <td align="center"><?php echo $materia_origen->getIdmateriaplan() ?></td>
		      <td><?php echo $materia_origen->getMaterias() ?></td>
		      <td align="center"><?php echo $materia_origen->getTiposMaterias() ?></td>
			  <td align="center"><?php echo $materia_origen->getCargahorariatotal() ?></td>      
			  <td align="center"><?php echo $materia_origen->getCargahorariasemanal() ?></td>
		      <td align="center"><?php echo $materia_origen->getOrden() ?></td>
		      <td align="center"><?php echo $materia_origen->getAnodecursada() ?></td>
		      <td align="center"><?php echo $materia_origen->getPeriododecursada() ?></td>
		      <td><?php echo $materia_origen->getTiposCursadas() ?></td>
		      <td><?php echo $materia_origen->getCodmat() ?></td>    
		      <td align="center" id="fila_<?php echo $materia_origen->getIdmateriaplan() ?>_boton">
		      	<input type='button' value='Agregar' onclick='botonAgregar(<?php echo $materia_origen->getIdmateriaplan() ?>)'>
			  </td>         	
		    </tr>
		    <?php endforeach; ?>
			<?php } else { ?>
				<tr>
			      <td colspan="11" align="center">No existen asignaturas designadas a este plan de estudios.</td>
				</tr>	
			<?php } ?>      
		  </tbody>
		</table>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
		<table id="tablaDestino" width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		       <td class="hed" align="center">Id</td>
		       <td class="hed" align="center">Asignatura</td>
		       <td class="hed" align="center">Tipo</td>
		       <td class="hed" align="center">Carga horaria total</td>
		       <td class="hed" align="center">Carga horaria semanal</td>
		       <td class="hed" align="center">Orden</td>
		       <td class="hed" align="center">Año</td>
		       <td class="hed" align="center">Periodo</td>
		       <td class="hed" align="center">Tipo de cursada</td>       
		       <td class="hed" align="center">Codigo</td>
		       <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($materias_destino) > 0) { ?>
		    <?php foreach ($materias_destino as $materia_destino): ?>
		    <tr id="fila_<?php echo $materia_destino->getIdmateriaplan() ?>">
		      <td align="center"><?php echo $materia_destino->getIdmateriaplan() ?></td>
		      <td><?php echo $materia_destino->getMaterias() ?></td>
		      <td align="center"><?php echo $materia_destino->getTiposMaterias() ?></td>
			  <td align="center"><?php echo $materia_destino->getCargahorariatotal() ?></td>      
			  <td align="center"><?php echo $materia_destino->getCargahorariasemanal() ?></td>
		      <td align="center"><?php echo $materia_destino->getOrden() ?></td>
		      <td align="center"><?php echo $materia_destino->getAnodecursada() ?></td>
		      <td align="center"><?php echo $materia_destino->getPeriododecursada() ?></td>
		      <td><?php echo $materia_destino->getTiposCursadas() ?></td>
		      <td><?php echo $materia_destino->getCodmat() ?></td>   
		      <td align="center" id="fila_<?php echo $materia_destino->getIdmateriaplan() ?>_boton">
		      	<input type='button' value='Eliminar' onclick='botonEliminar(<?php echo $materia_destino->getIdmateriaplan() ?>)' >
			  </td>        	
		    </tr>
		    <?php endforeach; ?>
			<?php } else { ?>
				<tr id="fila_0">
			      <td colspan="11" align="center">No existen asignaturas designadas a este plan de estudios.</td>
				</tr>	
			<?php } ?>      
		  </tbody>
		</table>
	</td>
    </tr>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera) ?>'"></p>
<br>