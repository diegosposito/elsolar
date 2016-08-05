<h1>Tipos correlatividadess List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipocorrelatividad</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_correlatividadess as $tipos_correlatividades): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposcorrelatividades/edit?idtipocorrelatividad='.$tipos_correlatividades->getIdtipocorrelatividad()) ?>"><?php echo $tipos_correlatividades->getIdtipocorrelatividad() ?></a></td>
      <td><?php echo $tipos_correlatividades->getDescripcion() ?></td>
      <td><?php echo $tipos_correlatividades->getCreatedAt() ?></td>
      <td><?php echo $tipos_correlatividades->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposcorrelatividades/new') ?>">New</a>
