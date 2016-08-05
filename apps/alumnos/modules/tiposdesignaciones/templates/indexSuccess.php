<h1>Tipos designacioness List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipodesignacion</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_designacioness as $tipos_designaciones): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposdesignaciones/edit?idtipodesignacion='.$tipos_designaciones->getIdtipodesignacion()) ?>"><?php echo $tipos_designaciones->getIdtipodesignacion() ?></a></td>
      <td><?php echo $tipos_designaciones->getDescripcion() ?></td>
      <td><?php echo $tipos_designaciones->getCreatedAt() ?></td>
      <td><?php echo $tipos_designaciones->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposdesignaciones/new') ?>">New</a>
