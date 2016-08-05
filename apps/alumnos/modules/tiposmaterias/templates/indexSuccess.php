<h1>Tipos materiass List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipomateria</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_materiass as $tipos_materias): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposmaterias/edit?idtipomateria='.$tipos_materias->getIdtipomateria()) ?>"><?php echo $tipos_materias->getIdtipomateria() ?></a></td>
      <td><?php echo $tipos_materias->getDescripcion() ?></td>
      <td><?php echo $tipos_materias->getCreatedAt() ?></td>
      <td><?php echo $tipos_materias->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposmaterias/new') ?>">New</a>
