<h1>Estudioss List</h1>

<table>
  <thead>
    <tr>
      <th>Idestudio</th>
      <th>Idpersona</th>
      <th>Idnivelestudio</th>
      <th>Descripcion</th>
      <th>Establecimiento</th>
      <th>Idciudad</th>
      <th>Fecha</th>
      <th>Duracion</th>
      <th>Anioingreso</th>
      <th>Anioegreso</th>
      <th>Idunidadtiempo</th>
      <th>Cantmaterias</th>
      <th>Cantmatapro</th>
      <th>Promedio</th>
      <th>Concluyo</th>
      <th>Continua</th>
      <th>Idcategoriatitulo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($estudioss as $estudios): ?>
    <tr>
      <td><a href="<?php echo url_for('estudios/edit?idestudio='.$estudios->getIdestudio()) ?>"><?php echo $estudios->getIdestudio() ?></a></td>
      <td><?php echo $estudios->getIdpersona() ?></td>
      <td><?php echo $estudios->getIdnivelestudio() ?></td>
      <td><?php echo $estudios->getDescripcion() ?></td>
      <td><?php echo $estudios->getEstablecimiento() ?></td>
      <td><?php echo $estudios->getIdciudad() ?></td>
      <td><?php echo $estudios->getFecha() ?></td>
      <td><?php echo $estudios->getDuracion() ?></td>
      <td><?php echo $estudios->getAnioingreso() ?></td>
      <td><?php echo $estudios->getAnioegreso() ?></td>
      <td><?php echo $estudios->getIdunidadtiempo() ?></td>
      <td><?php echo $estudios->getCantmaterias() ?></td>
      <td><?php echo $estudios->getCantmatapro() ?></td>
      <td><?php echo $estudios->getPromedio() ?></td>
      <td><?php echo $estudios->getConcluyo() ?></td>
      <td><?php echo $estudios->getContinua() ?></td>
      <td><?php echo $estudios->getIdcategoriatitulo() ?></td>
      <td><?php echo $estudios->getCreatedAt() ?></td>
      <td><?php echo $estudios->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('estudios/new') ?>">New</a>
