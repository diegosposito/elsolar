<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <thead>
    <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center" width="60%">Materia</td>
      <td class="hed" align="center" width="23%">Alumnos en condiciones</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
	<?php if (count($materiasgenericas)>0) {?>
		<?php foreach ($materiasgenericas as $materia): ?>
			<tr>
				<td align="center" width="5%"><?php echo $materia->idmateriaplan ?></td>
				<td><?php echo $materia->nombre ?></td>
				<td align="center"><?php echo $alumnosencondiciones[$materia->idmateriaplan] ?></td>
				<td align="center" width="5%">
					<?php if ($alumnosencondiciones[$materia->idmateriaplan] > 0) {?>
			      	<form action="<?php echo url_for('mesasexamenes/nuevogenerica'); ?>" >
			      		<input type="hidden" id="idmateriaplan" name="idmateriaplan" value="<?php echo $materia->idmateriaplan; ?>">
			      		<input class="botonCrear"  type="submit" value="Crear">
			      	</form>		
			      	<?php }else{ ?>
			      	No hay alumnos.
			      	<?php } ?>			
				</td>
			</tr>
		<?php endforeach; ?>
	<?php } else {?>
		<tr>
			<td colspan="4" align="center">No existen materias genericas.</td>
		</tr>		    
	<?php } ?>	    
  </tbody>
</table>
</div>
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('mesasexamenes/cerrar') ?>'"></p>
<br>