<h1>Tipos exameness List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipoexamen</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_exameness as $tipos_examenes): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposexamenes/edit?idtipoexamen='.$tipos_examenes->getIdtipoexamen()) ?>"><?php echo $tipos_examenes->getIdtipoexamen() ?></a></td>
      <td><?php echo $tipos_examenes->getDescripcion() ?></td>
      <td><?php echo $tipos_examenes->getCreatedAt() ?></td>
      <td><?php echo $tipos_examenes->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposexamenes/new') ?>">New</a>
