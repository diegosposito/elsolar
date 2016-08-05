<h1>Tipos de Clases</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('tiposclases/new') ?>'">
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
	<?php if (count($tipos_clasess) > 0) { ?>  
    <?php foreach ($tipos_clasess as $tipos_clases): ?>
    <tr>
      <td align="center"><?php echo $tipos_clases->getIdtipoclase() ?></td>
      <td><?php echo $tipos_clases->getDescripcion() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('tiposclases/edit?idtipoclase='.$tipos_clases->getIdtipoclase()) ?>'">      
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