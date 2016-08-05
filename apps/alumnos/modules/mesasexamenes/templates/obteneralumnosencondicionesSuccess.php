<script>
$(document).ready(function(){
	cantidadAlumnos = parseInt($('#tablaAlumnos tr').length) - 1;
	$('#cantidadAlumnos').html(cantidadAlumnos);
	if (cantidadAlumnos > 25) {
		$('#botonCrear').attr('disabled',true);
	} else {
		$('#botonCrear').attr('disabled',false);
	}
});

function botonEliminar(Id){
	// Elimina la fila seleccionada
	$("#fila_"+Id).remove();	
	cantidadAlumnos = parseInt($('#tablaAlumnos tr').length)-1;
	if(cantidadAlumnos == 0){
		$('#tablaAlumnos').append("<tr id='fila_0_boton'><td colspan='11' align='center'>No hay alumnos.</td></tr>");
	}		
	$('#cantidadAlumnos').html(cantidadAlumnos);
} 
</script>
<table cellspacing="0" class="stats" width="100%">
<tr>
	<td width="18%"><b>Cantidad de Alumnos:</b></td>
	<td><div id="cantidadAlumnos"></div></td>
</tr>
<tr>
<td colspan="2">
	<table cellspacing="0" class="stats" width="100%" id="tablaAlumnos">
	  <thead>
	    <tr>
	      <td class="hed" align="center" width="5%">Id</td>
	      <td class="hed" align="center">Alumno</td>
	      <td class="hed" align="center" width="17%">Nro. de Documento</td>
	      <td class="hed" align="center" width="12%">Nota escrita</td>
	      <td class="hed" align="center" width="10%">Nota oral</td>
	      <td class="hed" align="center" width="10%">Promedio</td>
	      <td class="hed" align="center" width="10%">Acciones</td>
	    </tr>
	  </thead>
	  <tbody>
		<?php if (count($alumnosencondiciones)>0) {?>
			<?php foreach ($alumnosencondiciones as $alumno) { 
			$oAlumno = Doctrine_Core::getTable('Alumnos')->find($alumno['idalumno']);
			?>
				<tr id="fila_<?php echo $oAlumno->getIdalumno(); ?>">
					<td align="center" width="5%"><?php echo $oAlumno->getIdalumno(); ?></td>
					<td><?php echo $oAlumno->getPersonas(); ?></td>
					<td align="center"><?php echo $oAlumno->getPersonas()->getNrodoc(); ?></td>
					<td align="center"><?php echo $alumno['notaescrita']; ?></td>
					<td align="center"><?php echo $alumno['notaoral']; ?></td>
					<td align="center"><?php echo $alumno['promedio']; ?></td>
					<td align="center" width="5%" id="fila_<?php echo $oAlumno->getIdalumno(); ?>_boton">
	   			      	<input type='button' value='Eliminar' onclick='botonEliminar(<?php echo $oAlumno->getIdalumno(); ?>)' >		      	
					</td>
				</tr>
			<?php } ?>
		<?php } else {?>
			<tr>
				<td colspan="7" align="center">No existen alumnos.</td>
			</tr>		    
		<?php } ?>	    
	  </tbody>
	</table>
</td>
</tr>
</table>
