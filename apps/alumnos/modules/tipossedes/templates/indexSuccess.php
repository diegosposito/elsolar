<h1>Tipos de Sedes</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('tipossedes/new') ?>'">
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
  	<?php if (count($tipos_sedess) > 0) { ?>
    <?php foreach ($tipos_sedess as $tipos_sedes): ?>
    <tr>
      <td><?php echo $tipos_sedes->getIdtiposede() ?></td>
      <td><?php echo $tipos_sedes->getDescripcion() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('tipossedes/edit?idtiposede='.$tipos_sedes->getIdtiposede()) ?>'">      
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