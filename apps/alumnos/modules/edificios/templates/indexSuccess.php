<h1>Edificios</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('edificios/new?idsede='.$idsede) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
    <td>Nombre: <b><?php echo $sede->getNombre(); ?></b></td>
    </tr>
    <tr>
    <td>Dirección: <?php echo $sede->getDireccion(); ?></td>
    </tr>
    <tr>
    <td>Telefono: <?php echo $sede->getTelefonos(); ?></td>
    </tr>        
    <tr>
    <td>
		<table width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		      <td class="hed" align="center">Id</td>
		      <td class="hed" align="center">Nombre</td>
		      <td class="hed" align="center">Telefono</td>
		      <td class="hed" align="center">Direccion</td>
		      <td class="hed" align="center">Ciudad</td>
		      <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>  
		  <tbody>
		  	<?php if (count($edificioss) > 0) { ?>
		    <?php foreach ($edificioss as $edificios): ?>
		    <tr>
		      <td align="center"><?php echo $edificios->getIdedificio() ?></td>
		      <td><?php echo $edificios->getNombre() ?></td>
		      <td align="center"><?php echo $edificios->getDireccion() ?></td>
		      <td align="center"><?php echo $edificios->getTelefono() ?></td>
		      <td align="center"><?php echo $edificios->getCiudades() ?></td>
		      <td align="center" width="21%">
		      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('edificios/edit?idedificio='.$edificios->getIdedificio()) ?>'">
		      	<input type="button" value="Ver aulas" onclick="location.href='<?php echo url_for('aulas/index?idedificio='.$edificios->getIdedificio()) ?>'">      
		      </td>
		    </tr>
		    <?php endforeach; ?>
			<?php } else { ?>
				<tr>
			      <td colspan="6" align="center">No existen edificios.</td>
				</tr>	
			<?php } ?>      
		  </tbody>
		</table>
	</td>
	</tr>
</table>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('sedes/index') ?>'"></p>
<br>