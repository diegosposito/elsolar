<h1>Tipos areass List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipoarea</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_areass as $tipos_areas): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposareas/edit?idtipoarea='.$tipos_areas->getIdtipoarea()) ?>"><?php echo $tipos_areas->getIdtipoarea() ?></a></td>
      <td><?php echo $tipos_areas->getDescripcion() ?></td>
      <td><?php echo $tipos_areas->getCreatedAt() ?></td>
      <td><?php echo $tipos_areas->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposareas/new') ?>">New</a>
