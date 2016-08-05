<h1>Sedes</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('sedes/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
	  <td class="hed" align="center">Id</td>    
	  <td class="hed" align="center">Nombre</td>
	  <td class="hed" align="center">Dirección</td>
	  <td class="hed" align="center">Telefono</td>
	  <td class="hed" align="center">E-mail</td>
	  <td class="hed" align="center">Tipo</td>
	  <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($sedess) > 0) { ?>
    <?php foreach ($sedess as $sedes): ?>
    <tr>
      <td><?php echo $sedes->getIdsede() ?></td>
      <td><?php echo $sedes->getNombre() ?></td>
      <td><?php echo $sedes->getDireccion() ?></td>
      <td><?php echo $sedes->getTelefonos() ?></td>
      <td><?php echo $sedes->getEmail() ?></td>
      <td><?php echo $sedes->getTiposSedes() ?></td>
	  <td align="center">
	   	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('sedes/edit?idsede='.$sedes->getIdsede()) ?>'">
	   	<input type="button" value="Ver edificios" onclick="location.href='<?php echo url_for('edificios/index?idsede='.$sedes->getIdsede()) ?>'">      
	  </td>      
    </tr>
    <?php endforeach; ?>
		<?php } else { ?>
			<tr>
		      <td colspan="7" align="center">No existen sedes.</td>
			</tr>	
		<?php } ?>      
  </tbody>
</table>
<br>