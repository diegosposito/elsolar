<h1>Planes de estudios dependientes</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('planesdependientes/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Plan de estudios</td>
      <td class="hed" align="center">Plan de estudios dependiente</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($planes_dependientess as $planes_dependientes): ?>
    <tr>
      <td align="center"><?php echo $planes_dependientes->getIdgrupo() ?></td>
      <td><?php echo $planes_dependientes->getPlanesEstudios() ?></td>
      <td><?php echo $planes_dependientes->getPlanesEstudiosDependiente() ?></td>
      <td align="center">
         	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('planesdependientes/edit?idgrupo='.$planes_dependientes->getIdgrupo()) ?>'">      
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br>