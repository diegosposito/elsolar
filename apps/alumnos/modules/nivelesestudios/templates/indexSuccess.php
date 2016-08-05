<h1>Niveles estudioss List</h1>

<table>
  <thead>
    <tr>
      <th>Idnivelestudio</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($niveles_estudioss as $niveles_estudios): ?>
    <tr>
      <td><a href="<?php echo url_for('nivelesestudios/edit?idnivelestudio='.$niveles_estudios->getIdnivelestudio()) ?>"><?php echo $niveles_estudios->getIdnivelestudio() ?></a></td>
      <td><?php echo $niveles_estudios->getDescripcion() ?></td>
      <td><?php echo $niveles_estudios->getCreatedAt() ?></td>
      <td><?php echo $niveles_estudios->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('nivelesestudios/new') ?>">New</a>
