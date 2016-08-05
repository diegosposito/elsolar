<h1>Estados</h1>
<?php if ($ultimoestado['idestadoalumno'] == 1) { ?>
<br>
	<input type="button" value="Solicitar Baja" onclick="location.href='<?php echo url_for('estadosalumno/solicitarbaja?idalumno='.$alumno->getIdalumno()) ?>'">
	<input type="button" value="Solicitar Fin de Cursada" onclick="location.href='<?php echo url_for('estadosalumno/solicitarfindecursada?idalumno='.$alumno->getIdalumno()) ?>'">
	<input type="button" value="Registrar Egreso" onclick="location.href='<?php echo url_for('estadosalumno/registraregreso?idalumno='.$alumno->getIdalumno()) ?>'">
	<input type="button" value="Registrar Enmienda" onclick="location.href='<?php echo url_for('estadosalumno/registrarenmienda?idalumno='.$alumno->getIdalumno()) ?>'">
<?php } else if ($ultimoestado['idestadoalumno'] == 2) { ?>
	<input type="button" value="Ver Baja" onclick="location.href='<?php echo url_for('bajas/index?idalumno='.$alumno->getIdalumno()) ?>'">
	<input type="button" value="Analitico" onclick="location.href='<?php echo url_for('alumnos/obteneranaliticoparcial?idalumno='.$alumno->getIdalumno()) ?>'">
<?php } ?>
<?php if (($ultimoestado['idestadoalumno'] != 1) && ($sf_user->getGuardUser()->getIsSuperAdmin())) { ?>
	<input type="button" value="Registrar Alta" onclick="location.href='<?php echo url_for('estadosalumno/registraralta?idalumno='.$alumno->getIdalumno()) ?>'">
<?php } ?> 
<div align="center">
<table width="80%" class="stats" cellspacing="0">
	<tr>
		<td width="19%"><b>Plan de estudio:</b></td>
		<td><?php echo $planestudio; ?></td>
	</tr>
	<tr>
	    <td><b>Alumno:</b></td>
	    <td><?php echo $alumno->getPersonas(); ?>(<?php echo $alumno->getIdalumno(); ?>)</td>
	</tr>
	<tr>
	    <td><b>Nro. documento:</b></td>
	    <td><?php echo $alumno->getPersonas()->getTiposDocumentos().": ".$alumno->getPersonas()->getNrodoc(); ?></td>
	</tr>  
	<?php if ($contacto) { ?>
	<tr>
		<td><b>Teléfono:</b></td>
		<td><?php echo $contacto->getTelefonofijocar()."-".$contacto->getTelefonofijonum(); ?></td>
	</tr>	
	<tr>
		<td><b>Celular:</b></td>
		<td><?php echo $contacto->getCelularcar()."-".$contacto->getCelularnum(); ?></td>
	</tr>	
	<tr>
		<td><b>E-mail:</b></td>
		<td><?php echo $contacto->getEmail(); ?></td>
	</tr>	
	<?php } else { ?>
	<tr>
		<td colspan="2">No existen datos de contactos cargados.</td>
	</tr>	
	<?php } ?>
	<tr>
		<td colspan="2" align="center">
			<table width="90%" class="stats" cellspacing="0">
			  <thead>
			    <tr>
			      <td class="hed" align="center" width="5%">Id</td>
			      <td class="hed" align="center" width="10%">Estado</td>
			      <td class="hed" align="center" width="20%">Fecha</td>
			      <td class="hed" align="center" width="40%">Observaciones</td>
			      <td class="hed" align="center" width="20%">Autor</td>
			    </tr>
			  </thead>
			  <tbody>
			    <?php foreach ($estados_alumnos as $estados_alumno): ?>
			    <tr>
			      <td><?php echo $estados_alumno->getId() ?></td>
			      <td><?php echo $estados_alumno->getEstadosAlumno()->getDescripcion() ?></td>
			      <td>
			      	<?php 
						$arr = explode('-', $estados_alumno->getFecha());
						$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
					?>
			    	<?php echo $fecha ?>
			      </td>
			      <td><?php echo $estados_alumno->getObservaciones() ?></td>
				<td><?php 
				
				echo $estados_alumno->getCreatedBy() ?></td>
			    </tr>
			    <?php endforeach; ?>
			  </tbody>
			</table>
		</td>
	</tr>
</table>
</div>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('estadosalumno/buscar') ?>'"></p>
<br>	
