<h1>Asignacioness List</h1>

<table>
  <thead>
    <tr>
      <th>Idasignacion</th>
      <th>Dia</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Horainicio</th>
      <th>Horafin</th>
      <th>Observaciones</th>
      <th>Idaula</th>
      <th>Idtipoasignacion</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($asignacioness as $asignaciones): ?>
    <tr>
      <td><a href="<?php echo url_for('asignaciones/edit?idasignacion='.$asignaciones->getIdasignacion()) ?>"><?php echo $asignaciones->getIdasignacion() ?></a></td>
      <td><?php echo $asignaciones->getDia() ?></td>
      <td><?php echo $asignaciones->getInicio() ?></td>
      <td><?php echo $asignaciones->getFin() ?></td>
      <td><?php echo $asignaciones->getHorainicio() ?></td>
      <td><?php echo $asignaciones->getHorafin() ?></td>
      <td><?php echo $asignaciones->getObservaciones() ?></td>
      <td><?php echo $asignaciones->getIdaula() ?></td>
      <td><?php echo $asignaciones->getIdtipoasignacion() ?></td>
      <td><?php echo $asignaciones->getCreatedAt() ?></td>
      <td><?php echo $asignaciones->getUpdatedAt() ?></td>
      <td><?php echo $asignaciones->getCreatedBy() ?></td>
      <td><?php echo $asignaciones->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('asignaciones/new') ?>">New</a>
