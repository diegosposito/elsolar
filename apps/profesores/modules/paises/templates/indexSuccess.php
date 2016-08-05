<h1>Paisess List</h1>

<table>
  <thead>
    <tr>
      <th>Idpais</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($paisess as $paises): ?>
    <tr>
      <td><a href="<?php echo url_for('paises/edit?idpais='.$paises->getIdpais()) ?>"><?php echo $paises->getIdpais() ?></a></td>
      <td><?php echo $paises->getDescripcion() ?></td>
      <td><?php echo $paises->getCreatedAt() ?></td>
      <td><?php echo $paises->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('paises/new') ?>">New</a>
