<h1>Equivalencias</h1>
<br>
<input type="button" value="Solicitar Equivalencias" onclick="location.href='<?php echo url_for('equivalencias/buscaralumnos') ?>'">
<br><br>
<div align="center">
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
		<td class="hed" align="center" width="5%">Id</td>
		<td class="hed" align="center" width="45%">Alumno</td>
		<td class="hed" align="center" width="10%">Fecha</td>
		<td class="hed" align="center" width="10%">Nro. resolución</td>
		<td class="hed" align="center" width="10%">Fecha resolución</td>    
		<td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($equivalencias_alumnoss as $equivalencias_alumnos): ?>
    <tr>
      <td align="center"><?php echo $equivalencias_alumnos->getIdequivalencia() ?></td>
      <td><?php echo $equivalencias_alumnos->getAlumnos()->getPersonas() ?></td>
      <td align="center"><?php echo $equivalencias_alumnos->getFecha() ?></td>
      <td align="center"><?php echo $equivalencias_alumnos->getNroresolucion() ?></td>
      <td align="center"><?php echo $equivalencias_alumnos->getFecharesolucion() ?></td>
	  <td align="center">
	  	<?php if ($equivalencias_alumnos->tieneEquivalenciasPendientes()==1) { ?>
      	<input type="button" value="Controlar" onclick="location.href='<?php echo url_for('equivalencias/controlar?idequivalencia='.$equivalencias_alumnos->getIdequivalencia().'&link=2') ?>'">
      	<?php } ?>
		<input type="button" value="Ver" onclick="location.href='<?php echo url_for('equivalencias/show?idequivalencia='.$equivalencias_alumnos->getIdequivalencia().'&link=2') ?>'">	
	  </td>        
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>