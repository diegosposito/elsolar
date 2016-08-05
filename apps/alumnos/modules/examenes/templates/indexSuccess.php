<h1>Exameness List</h1>

<table>
  <thead>
    <tr>
      <th>Idexamen</th>
      <th>Idalumno</th>
      <th>Idmesaexamen</th>
      <th>Calificacion</th>
      <th>Idmodoevaluacion</th>
      <th>Anexo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($exameness as $examenes): ?>
    <tr>
      <td><a href="<?php echo url_for('examenes/edit?idexamen='.$examenes->getIdexamen()) ?>"><?php echo $examenes->getIdexamen() ?></a></td>
      <td><?php echo $examenes->getIdalumno() ?></td>
      <td><?php echo $examenes->getIdmesaexamen() ?></td>
      <td><?php echo $examenes->getCalificacion() ?></td>
      <td><?php echo $examenes->getIdmodoevaluacion() ?></td>
      <td><?php echo $examenes->getAnexo() ?></td>
      <td><?php echo $examenes->getCreatedAt() ?></td>
      <td><?php echo $examenes->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('examenes/new') ?>">New</a>
