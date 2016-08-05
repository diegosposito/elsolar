<h1>Encuestas entregadas</h1>
<br>
<input type="button" value="Registrar entrega" onclick="location.href='<?php echo url_for('encuestasalumnos/new?idalumno='.$alumno->getIdalumno()) ?>'">
<br><br>
<table cellspacing="0" class="stats" width="100%">
	<tr>
		<td colspan="4"><b>Alumno:</b> <?php echo $alumno->getPersonas() ?></td>
	</tr>
    <tr>
      <td class="hed" align="center" width="2%">Id</td>
      <td class="hed" align="center">Encuesta</td>
      <td class="hed" align="center" width="16%">Fecha de entrega</td>
      <td class="hed" align="center" width="10%">Acciones</td>
    </tr>
  	<?php if (count($encuestas_alumnoss)>0) { ?>
    <?php foreach ($encuestas_alumnoss as $encuestas_alumnos): ?>
    <tr>
      <td><?php echo $encuestas_alumnos->getId() ?></td>
      <td><?php echo $encuestas_alumnos->getEncuestas() ?></td>
      <td align="center">
		<?php 
			$arr = explode('-', $encuestas_alumnos->getFecha());
			$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
		?>	
      	<?php echo $fecha; ?>
      </td>
      <td align="center">
		<input type="button" value="Editar" onclick="location.href='<?php echo url_for('encuestasalumnos/edit?idalumno='.$encuestas_alumnos->getIdalumno().'&id='.$encuestas_alumnos->getId()) ?>'">
      </td>
    </tr>
    <?php endforeach; ?>
    <?php } else { ?>
    <tr>
      <td colspan="4" align="center">No existen encuestas.</td>
    </tr>    
    <?php } ?>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('encuestasalumnos/registrarencuesta') ?>'"></p>
<br>