<h1>Tipos designaciones mesass List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipodesignacionmesa</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_designaciones_mesass as $tipos_designaciones_mesas): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposdesignacionesmesas/edit?idtipodesignacionmesa='.$tipos_designaciones_mesas->getIdtipodesignacionmesa()) ?>"><?php echo $tipos_designaciones_mesas->getIdtipodesignacionmesa() ?></a></td>
      <td><?php echo $tipos_designaciones_mesas->getDescripcion() ?></td>
      <td><?php echo $tipos_designaciones_mesas->getCreatedAt() ?></td>
      <td><?php echo $tipos_designaciones_mesas->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposdesignacionesmesas/new') ?>">New</a>
