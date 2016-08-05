<h1>Modos evaluacioness List</h1>

<table>
  <thead>
    <tr>
      <th>Idmodoevaluacion</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($modos_evaluacioness as $modos_evaluaciones): ?>
    <tr>
      <td><a href="<?php echo url_for('modosevaluaciones/edit?idmodoevaluacion='.$modos_evaluaciones->getIdmodoevaluacion()) ?>"><?php echo $modos_evaluaciones->getIdmodoevaluacion() ?></a></td>
      <td><?php echo $modos_evaluaciones->getDescripcion() ?></td>
      <td><?php echo $modos_evaluaciones->getCreatedAt() ?></td>
      <td><?php echo $modos_evaluaciones->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('modosevaluaciones/new') ?>">New</a>
