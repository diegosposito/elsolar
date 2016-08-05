<h1>Tipos de Asignaciones</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('tiposasignaciones/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Descripción</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($tipos_asignacioness) > 0) { ?>
    <?php foreach ($tipos_asignacioness as $tipos_asignaciones): ?>
    <tr>
      <td><?php echo $tipos_asignaciones->getIdtipoasignacion() ?></td>
      <td><?php echo $tipos_asignaciones->getDescripcion() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('tiposasignaciones/edit?idtipoasignacion='.$tipos_asignaciones->getIdtipoasignacion()) ?>'">      
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="3" align="center">No existen tipos.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>
<br>