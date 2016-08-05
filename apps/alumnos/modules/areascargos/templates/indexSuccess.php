<h1>Cargos por Area</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('areascargos/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Tipo de Area</td>
      <td class="hed" align="center">Tipo de Cargo</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($areas_cargoss as $areas_cargos): ?>
    <tr>
      <td align="center"><?php echo $areas_cargos->getId() ?></td>
      <td><?php echo $areas_cargos->getTiposAreas() ?></td>
      <td><?php echo $areas_cargos->getTiposCargos() ?></td>
	  <td align="center" width="21%">
		   	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('areascargos/edit?id='.$areas_cargos->getId()) ?>'">
	  </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>