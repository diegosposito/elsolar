<h1>Libros actass List</h1>

<table>
  <thead>
    <tr>
      <th>Idlibroacta</th>
      <th>Descripcion</th>
      <th>Idarea</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($libros_actass as $libros_actas): ?>
    <tr>
      <td><a href="<?php echo url_for('librosactas/edit?idlibroacta='.$libros_actas->getIdlibroacta()) ?>"><?php echo $libros_actas->getIdlibroacta() ?></a></td>
      <td><?php echo $libros_actas->getDescripcion() ?></td>
      <td><?php echo $libros_actas->getIdarea() ?></td>
      <td><?php echo $libros_actas->getCreatedAt() ?></td>
      <td><?php echo $libros_actas->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('librosactas/new') ?>">New</a>
