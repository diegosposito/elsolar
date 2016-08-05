<h1>Aulas</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('aulas/new?idedificio='.$idedificio) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
    <td>Nombre: <b><?php echo $edificio->getNombre(); ?></b></td>
    </tr>
    <tr>
    <td>Dirección: <?php echo $edificio->getDireccion() ." - ".$edificio->getCiudades(); ?></td>
    </tr>
    <tr>
    <td>Telefono: <?php echo $edificio->getTelefono(); ?></td>
    </tr>        
    <tr>
    <td>
	<table width="100%" class="stats" cellspacing="0">
	  <thead>
	    <tr>
	      <td class="hed" align="center">Id</td>
	      <td class="hed" align="center">Nombre</td>
	      <td class="hed" align="center">Ubicación</td>
	      <td class="hed" align="center">Piso</td>
	      <td class="hed" align="center">Capacidad</td>
	      <td class="hed" align="center">Descripción</td>
	      <td class="hed" align="center">Tipo</td>
	      <td class="hed" align="center">Acciones</td>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php if (count($aulass) > 0) { ?>
	    <?php foreach ($aulass as $aulas): ?>
	    <tr>
	      <td align="center"><?php echo $aulas->getIdaula() ?></td>
	      <td><?php echo $aulas->getNombre() ?></td>
	      <td><?php echo $aulas->getUbicacion() ?></td>
	      <td  align="center"><?php echo $aulas->getPiso() ?></td>
	      <td align="center"><?php echo $aulas->getCapacidad() ?></td>
	      <td  align="center"><?php echo $aulas->getDescripcion() ?></td>
	      <td align="center"><?php echo $aulas->getTiposAulas() ?></td>
	      <td align="center">
	      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('aulas/edit?idaula='.$aulas->getIdaula()) ?>'">      
	      </td>
	    </tr>
	    <?php endforeach; ?>
		<?php } else { ?>
			<tr>
		      <td colspan="8" align="center">No existen aulas.</td>
			</tr>	
		<?php } ?>  	    
	  </tbody>
	</table>
	</td>
	</tr>
</table>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('edificios/index?idsede='.$edificio->getIdsede()) ?>'"></p>
<br>