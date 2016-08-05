<h1>Fechas calendarios List</h1>

<table>
  <thead>
    <tr>
      <th>Idfecha</th>
      <th>Idcalendario</th>
      <th>Idtipo</th>
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
    <?php foreach ($fechas_calendarios as $fechas_calendario): ?>
    <tr>
      <td><a href="<?php echo url_for('fechascalendario/edit?idfecha='.$fechas_calendario->getIdfecha()) ?>"><?php echo $fechas_calendario->getIdfecha() ?></a></td>
      <td><?php echo $fechas_calendario->getIdcalendario() ?></td>
      <td><?php echo $fechas_calendario->getIdtipo() ?></td>
      <td><?php echo $fechas_calendario->getDescripcion() ?></td>
      <td><?php echo $fechas_calendario->getInicio() ?></td>
      <td><?php echo $fechas_calendario->getFin() ?></td>
      <td><?php echo $fechas_calendario->getCreatedAt() ?></td>
      <td><?php echo $fechas_calendario->getUpdatedAt() ?></td>
      <td><?php echo $fechas_calendario->getCreatedBy() ?></td>
      <td><?php echo $fechas_calendario->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('fechascalendario/new') ?>">New</a>
