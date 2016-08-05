<h1>Asignar horarios a Comisiones</h1> 
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('asignacionesclases/new?idcomision='.$comision->getIdcomision()) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
<tr>
	<td width="15%"><b>Plan de estudio:</b></td>
	<td width="45%"><?php echo $planestudio; ?></td>
	<td width="11%"><b>Sede:</b></td>
	<td><?php echo $sede; ?></td>	
</tr>
<tr>
	<td><b>Catedra:</b></td>
	<td><?php echo $comision->getCatedras()->getMateriasPlanes(); ?></td>
	<td><b>Comisión:</b></td>
	<td><?php echo $comision; ?></td>
</tr>
<tr>
	<td colspan="4">
		<table width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		      <td class="hed" align="center">Id</td>
		      <td class="hed" align="center">Aula</td>
		      <td class="hed" align="center">Día</td>
		      <td class="hed" align="center">Inicio</td>
		      <td class="hed" align="center">Fin</td>
		      <td class="hed" align="center">Hora inicio</td>
		      <td class="hed" align="center">Hora fin</td>
		      <td class="hed" align="center">Periodicidad</td>
		      <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($asignaciones_clasess) > 0) { ?>
		    <?php foreach ($asignaciones_clasess as $asignaciones_clases): ?>
		    <tr>
		      <td align="center"><?php echo $asignaciones_clases->getIdasignacion() ?></td>
		      <td width="20%"><?php echo $asignaciones_clases->getAulas()->getEdificios()." - ".$asignaciones_clases->getAulas() ?></td>
		      <td align="center"><?php echo $asignaciones_clases->getNombreDia() ?></td>
		      <td align="center"><?php echo $asignaciones_clases->getInicio() ?></td>
		      <td align="center"><?php echo $asignaciones_clases->getFin() ?></td>
		      <td align="center"><?php echo $asignaciones_clases->getHorainicio() ?></td>
		      <td align="center"><?php echo $asignaciones_clases->getHorafin() ?></td>
		      <td align="center"><?php echo $asignaciones_clases->getNombrePeriodicidad() ?></td>
		      <td align="center">
		      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('asignacionesclases/edit?idasignacion='.$asignaciones_clases->getIdasignacion()) ?>'">
		      </td>
		    </tr>
		    <?php endforeach; ?>
			<?php } else { ?>
				<tr>
			      <td colspan="11" align="center">No existen asignaciones.</td>
				</tr>	
			<?php } ?>  		    
		  </tbody>
		</table>
	</td>
	</tr>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('asignacionesclases/buscar') ?>'"></p>
<br>