<h1>Transiciones entre Planes de Estudios</h1>
<br>
<input type="submit" value="Nuevo" onclick="location.href='<?php echo url_for('transicionesplanes/new') ?>'">
<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="4%">Id</td>
      <td class="hed" align="center" width="50%">Carrera</td>
      <td class="hed" align="center" width="15%">Origen</td>
      <td class="hed" align="center" width="15%">Destino</td>
      <td class="hed" align="center">Acciones</td>
    </tr>	
	<?php if (count($transiciones_planess) > 0) { ?>    
	<?php foreach ($transiciones_planess as $transiciones_planes): ?>
    <tr>
      <td align="center"><?php echo $transiciones_planes->getIdtransicionplan() ?></td>
      <td><?php echo $transiciones_planes->getCarrera() ?></td>
      <td align="center"><?php echo $transiciones_planes->getPlanOrigen()->getNombre()." - v".$transiciones_planes->getPlanOrigen()->getVersion() ?></td>
      <td align="center"><?php echo $transiciones_planes->getPlanDestino()->getNombre()." - v".$transiciones_planes->getPlanDestino()->getVersion() ?></td>
      <td align="center">
      <input type="button" value="Ver" onclick="location.href='<?php echo url_for('transicionesmaterias/index?idtransicionplan='.$transiciones_planes->getIdtransicionplan()) ?>'">
      <input type="button" value="Editar" onclick="location.href='<?php echo url_for('transicionesplanes/edit?idtransicionplan='.$transiciones_planes->getIdtransicionplan()) ?>'">
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen matrices de transición.</td>
		</tr>	
	<?php } ?>      
</table>
<br>