<h1>Ciudadess List</h1>

<table>
  <thead>
    <tr>
      <th>Idciudad</th>
      <th>Iddepartamento</th>
      <th>Idprovincia</th>
      <th>Descripcion</th>
      <th>Codpostal</th>
      <th>Chequeada</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ciudadess as $ciudades): ?>
    <tr>
      <td><a href="<?php echo url_for('ciudades/edit?idciudad='.$ciudades->getIdciudad()) ?>"><?php echo $ciudades->getIdciudad() ?></a></td>
      <td><?php echo $ciudades->getIddepartamento() ?></td>
      <td><?php echo $ciudades->getIdprovincia() ?></td>
      <td><?php echo $ciudades->getDescripcion() ?></td>
      <td><?php echo $ciudades->getCodpostal() ?></td>
      <td><?php echo $ciudades->getChequeada() ?></td>
      <td><?php echo $ciudades->getCreatedAt() ?></td>
      <td><?php echo $ciudades->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('ciudades/new') ?>">New</a>
