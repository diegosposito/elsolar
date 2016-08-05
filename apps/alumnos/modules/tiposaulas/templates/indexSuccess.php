<h1>Tipos de Aulas</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('tiposaulas/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Descripción</td>
      <td class="hed" align="center">Descripción reducida</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($tipos_aulass) > 0) { ?>
    <?php foreach ($tipos_aulass as $tipos_aulas): ?>
    <tr>
      <td><?php echo $tipos_aulas->getIdtipoaula() ?></td>
      <td><?php echo $tipos_aulas->getDescripcion() ?></td>
      <td><?php echo $tipos_aulas->getDescripcionreducido() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('tiposaulas/edit?idtipoaula='.$tipos_aulas->getIdtipoaula()) ?>'">      
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen tipos.</td>
		</tr>	
	<?php } ?>        
  </tbody>
</table>
<br>