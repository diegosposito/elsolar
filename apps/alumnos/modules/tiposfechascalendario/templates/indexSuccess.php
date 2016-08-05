<h1>Tipos fechas calendarios List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipo</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_fechas_calendarios as $tipos_fechas_calendario): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposfechascalendario/edit?idtipo='.$tipos_fechas_calendario->getIdtipo()) ?>"><?php echo $tipos_fechas_calendario->getIdtipo() ?></a></td>
      <td><?php echo $tipos_fechas_calendario->getDescripcion() ?></td>
      <td><?php echo $tipos_fechas_calendario->getCreatedAt() ?></td>
      <td><?php echo $tipos_fechas_calendario->getUpdatedAt() ?></td>
      <td><?php echo $tipos_fechas_calendario->getCreatedBy() ?></td>
      <td><?php echo $tipos_fechas_calendario->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposfechascalendario/new') ?>">New</a>
