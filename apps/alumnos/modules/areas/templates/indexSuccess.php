<h1>Areas</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('areas/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Tipo de area</td>
      <td class="hed" align="center">Area dependiente</td>
      <td class="hed" align="center">Descripcion</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($areass as $areas): ?>
    <tr>
      <td><?php echo $areas->getIdarea() ?></td>
      <td><?php echo $areas->getTiposAreas() ?></td>
      <td><?php echo $areas->getIdareadependiente() ?></td>
      <td><?php echo $areas->getDescripcion() ?></td>
	  <td align="center">
	  	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('areas/edit?idarea='.$areas->getIdarea()) ?>'">         
	  </td>      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>