<h1>Estados Comisiones</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('estadoscomisiones/new') ?>'">
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
  	<?php if (count($estados_comisioness) > 0) { ?>
    <?php foreach ($estados_comisioness as $estados_comisiones): ?>
    <tr>
      <td><?php echo $estados_comisiones->getIdestadocomision() ?></td>
      <td><?php echo $estados_comisiones->getDescripcion() ?></td>
	  <td align="center">
	   	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('estadoscomisiones/edit?idestadocomision='.$estados_comisiones->getIdestadocomision()) ?>'">
	  </td>    
    </tr>
    <?php endforeach; ?>
		<?php } else { ?>
			<tr>
		      <td colspan="3" align="center">No existen estados.</td>
			</tr>	
		<?php } ?>  
  </tbody>
</table>
<br>