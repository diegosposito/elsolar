<?php if(!$guardado) { ?>
<script type="text/javascript">
<!--
alert("La solicitud de inscripción debe confirmarse con mucho cuidado, ya que cualquier error que cometas, o dato confuso que dé lugar a una interpretación equivocada, se trasladará a la inscripción misma. Los datos de la solicitud se ingresan en el sistema informático, y de acuerdo con la información grabada el alumno podrá inscribirse a cursar y/o rendir las asignaturas correspondientes a la carrera seleccionada, como así también utilizar los servicios que la presente plataforma le brinda.");
// -->
</script>
<?php } ?>
<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Activación en Ciclo Lectivo</h1>
	</td>
	</tr>
</table>
<br>
<table width="100%" class="" cellspacing="0">
	<tr>
		<td width="18%"><strong>Alumno:</strong></td>
		<td><?php echo $persona['apellido'].", ".$persona['nombre'] ?></td>
	</tr>
	<tr>
		<td><strong>Fecha Nacimiento:</strong></td>
		<?php
		$fechaNac = date("d-m-Y", strtotime($persona['fechanac']));
		?>

		<td><?php echo $fechaNac ?></td>
	</tr>
	<tr>
		<td><strong>Nacionalidad:</strong></td>
		<td><?php echo $persona['idnacionalidad']==1?"Argentino":" ------- " ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="stats" width="100%">
			<thead>
				<tr>
					<td class="hed" align="center">Carrera</td>
					<td class="hed" align="center">Plan</td>
					<td class="hed" align="center">Ciclo lectivo</td>
					<td class="hed" align="center">Acción</td>
				</tr>
			</thead>
				<?php if(count($planes) > 0) { ?>
				<?php foreach ($planes as $plan): ?>
				<tr>
					<td><?php echo $plan['carrera'] ?></td>
					<td align="center"><?php echo $plan['plan'] ?></td>
					<td align="center"><?php echo $plan['ciclo'] ?></td>
					<td align="center">
					<?php if(!$plan['activo']) { ?> 
						<form name="form_<?php echo $plan['idcarrera'] ?>" method="post" action="<?php echo url_for('ciclo/inscribir' ); ?>">
							<input type="hidden" name="idcarrera" value="<?php echo $plan['idcarrera']; ?>">
							<input type="hidden" name="idalumno" value="<?php echo $plan['idalumno']; ?>">
							<input type="hidden" name="idciclo" value="<?php echo $plan['idciclo']; ?>">
							<input type="hidden" name="guardado" value='1'>
							<input type="submit" value="Activar" title="Activar Ciclo Lectivo" id="Activar" class="form_consulta_enviar" name="Activar">
						</form>
					<?php } else { ?>  
						<p align="center" class="resaltar_verde">Activo</p>
					<?php } ?> 
					</td>
				</tr> 
    				<?php endforeach; ?>		
				<?php } else { ?>
					<tr>
						<td align="center" colspan="4">No existen planes de estudios</td>
					</tr> 				
				<?php } ?>				
			</table>
		</td>
	</tr>
</table>
<br>
