<h1>Carreras por Area</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('areascarrera/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Area</td>
      <td class="hed" align="center">Carrera</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($areas_carreras as $areas_carrera): ?>
    <tr>
      <td align="center"><?php echo $areas_carrera->getId() ?></td>
      <td><?php echo $areas_carrera->getAreas() ?></td>
      <td><?php echo $areas_carrera->getCarreras() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('areascarrera/edit?id='.$areas_carrera->getId()) ?>'">
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>