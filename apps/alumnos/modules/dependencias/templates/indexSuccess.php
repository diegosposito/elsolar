<h1>Dependenciass List</h1>

<table>
  <thead>
    <tr>
      <th>Iddependencia</th>
      <th>Nombre</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dependenciass as $dependencias): ?>
    <tr>
      <td><a href="<?php echo url_for('dependencias/edit?iddependencia='.$dependencias->getIddependencia()) ?>"><?php echo $dependencias->getIddependencia() ?></a></td>
      <td><?php echo $dependencias->getNombre() ?></td>
      <td><?php echo $dependencias->getCreatedAt() ?></td>
      <td><?php echo $dependencias->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('dependencias/new') ?>">New</a>
