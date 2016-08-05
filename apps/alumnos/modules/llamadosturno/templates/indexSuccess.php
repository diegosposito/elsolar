<h1>Llamados turnos List</h1>

<table>
  <thead>
    <tr>
      <th>Idllamado</th>
      <th>Idfecha</th>
      <th>Descripcion</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($llamados_turnos as $llamados_turno): ?>
    <tr>
      <td><a href="<?php echo url_for('llamadosturno/edit?idllamado='.$llamados_turno->getIdllamado()) ?>"><?php echo $llamados_turno->getIdllamado() ?></a></td>
      <td><?php echo $llamados_turno->getIdfecha() ?></td>
      <td><?php echo $llamados_turno->getDescripcion() ?></td>
      <td><?php echo $llamados_turno->getInicio() ?></td>
      <td><?php echo $llamados_turno->getFin() ?></td>
      <td><?php echo $llamados_turno->getCreatedAt() ?></td>
      <td><?php echo $llamados_turno->getUpdatedAt() ?></td>
      <td><?php echo $llamados_turno->getCreatedBy() ?></td>
      <td><?php echo $llamados_turno->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('llamadosturno/new') ?>">New</a>
