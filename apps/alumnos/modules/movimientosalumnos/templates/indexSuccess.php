<h1>Movimientos alumnoss List</h1>

<table>
  <thead>
    <tr>
      <th>Idmovimiento</th>
      <th>Idestado</th>
      <th>Fecha</th>
      <th>Fechavencimiento</th>
      <th>Idalumno</th>
      <th>Idresponsable</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($movimientos_alumnoss as $movimientos_alumnos): ?>
    <tr>
      <td><a href="<?php echo url_for('movimientosalumnos/edit?idmovimiento='.$movimientos_alumnos->getIdmovimiento()) ?>"><?php echo $movimientos_alumnos->getIdmovimiento() ?></a></td>
      <td><?php echo $movimientos_alumnos->getIdestado() ?></td>
      <td><?php echo $movimientos_alumnos->getFecha() ?></td>
      <td><?php echo $movimientos_alumnos->getFechavencimiento() ?></td>
      <td><?php echo $movimientos_alumnos->getIdalumno() ?></td>
      <td><?php echo $movimientos_alumnos->getIdresponsable() ?></td>
      <td><?php echo $movimientos_alumnos->getCreatedAt() ?></td>
      <td><?php echo $movimientos_alumnos->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('movimientosalumnos/new') ?>">New</a>
