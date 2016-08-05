<h1>Estados materias List</h1>

<table>
  <thead>
    <tr>
      <th>Idestadomateria</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($estados_materias as $estados_materia): ?>
    <tr>
      <td><a href="<?php echo url_for('estadosmateria/edit?idestadomateria='.$estados_materia->getIdestadomateria()) ?>"><?php echo $estados_materia->getIdestadomateria() ?></a></td>
      <td><?php echo $estados_materia->getDescripcion() ?></td>
      <td><?php echo $estados_materia->getCreatedAt() ?></td>
      <td><?php echo $estados_materia->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('estadosmateria/new') ?>">New</a>
