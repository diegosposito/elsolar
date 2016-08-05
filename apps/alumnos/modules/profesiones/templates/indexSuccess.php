<h1>Profesioness List</h1>

<table>
  <thead>
    <tr>
      <th>Idprofesion</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($profesioness as $profesiones): ?>
    <tr>
      <td><a href="<?php echo url_for('profesiones/edit?idprofesion='.$profesiones->getIdprofesion()) ?>"><?php echo $profesiones->getIdprofesion() ?></a></td>
      <td><?php echo $profesiones->getDescripcion() ?></td>
      <td><?php echo $profesiones->getCreatedAt() ?></td>
      <td><?php echo $profesiones->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('profesiones/new') ?>">New</a>
