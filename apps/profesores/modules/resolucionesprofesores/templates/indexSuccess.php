<h1>Resoluciones profesoress List</h1>

<table>
  <thead>
    <tr>
      <th>Idresolucionprofesor</th>
      <th>Idsede</th>
      <th>Idfacultad</th>
      <th>Resolucion</th>
      <th>Fecha</th>
      <th>Is default</th>
      <th>Resolucion csu</th>
      <th>Activa</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resoluciones_profesoress as $resoluciones_profesores): ?>
    <tr>
      <td><a href="<?php echo url_for('resolucionesprofesores/edit?idresolucionprofesor='.$resoluciones_profesores->getIdresolucionprofesor()) ?>"><?php echo $resoluciones_profesores->getIdresolucionprofesor() ?></a></td>
      <td><?php echo $resoluciones_profesores->getIdsede() ?></td>
      <td><?php echo $resoluciones_profesores->getIdfacultad() ?></td>
      <td><?php echo $resoluciones_profesores->getResolucion() ?></td>
      <td><?php echo $resoluciones_profesores->getFecha() ?></td>
      <td><?php echo $resoluciones_profesores->getIsDefault() ?></td>
      <td><?php echo $resoluciones_profesores->getResolucionCsu() ?></td>
      <td><?php echo $resoluciones_profesores->getActiva() ?></td>
      <td><?php echo $resoluciones_profesores->getCreatedAt() ?></td>
      <td><?php echo $resoluciones_profesores->getUpdatedAt() ?></td>
      <td><?php echo $resoluciones_profesores->getCreatedBy() ?></td>
      <td><?php echo $resoluciones_profesores->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('resolucionesprofesores/new') ?>">New</a>
