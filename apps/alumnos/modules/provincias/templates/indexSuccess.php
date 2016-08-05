<h1>Provinciass List</h1>

<table>
  <thead>
    <tr>
      <th>Idprovincia</th>
      <th>Idpais</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($provinciass as $provincias): ?>
    <tr>
      <td><a href="<?php echo url_for('provincias/edit?idprovincia='.$provincias->getIdprovincia()) ?>"><?php echo $provincias->getIdprovincia() ?></a></td>
      <td><?php echo $provincias->getIdpais() ?></td>
      <td><?php echo $provincias->getDescripcion() ?></td>
      <td><?php echo $provincias->getCreatedAt() ?></td>
      <td><?php echo $provincias->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('provincias/new') ?>">New</a>
