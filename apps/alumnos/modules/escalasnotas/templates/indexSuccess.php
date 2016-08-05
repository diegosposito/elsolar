<h1>Escalas de Notas</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('escalasnotas/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Nombre</td>
      <td class="hed" align="center">Activo</td>
      <td class="hed" align="center" width="25%">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($escalas_notass) > 0) { ?>  
    <?php foreach ($escalas_notass as $escalas_notas): ?>
    <tr>
      <td align="center"><?php echo $escalas_notas->getIdescalanota() ?></td>
      <td><?php echo $escalas_notas->getNombre() ?></td>
      <td align="center"><?php echo $escalas_notas->getActivo() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('escalasnotas/edit?idescalanota='.$escalas_notas->getIdescalanota()) ?>'">
		<input type="button" value="Ver notas" onclick="location.href='<?php echo url_for('detallenota/index?idescalanota='.$escalas_notas->getIdescalanota()) ?>'">	
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen escalas de notas.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>
<br>