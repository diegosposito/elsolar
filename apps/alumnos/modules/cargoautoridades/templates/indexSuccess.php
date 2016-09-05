<h1>Cargo autoridadess List</h1>

<table>
  <thead>
    <tr>
      <th>Idcargoautoridad</th>
      <th>Nombre</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cargo_autoridadess as $cargo_autoridades): ?>
    <tr>
      <td><a href="<?php echo url_for('cargoautoridades/show?idcargoautoridad='.$cargo_autoridades->getIdcargoautoridad()) ?>"><?php echo $cargo_autoridades->getIdcargoautoridad() ?></a></td>
      <td><?php echo $cargo_autoridades->getNombre() ?></td>
      <td><?php echo $cargo_autoridades->getCreatedAt() ?></td>
      <td><?php echo $cargo_autoridades->getUpdatedAt() ?></td>
      <td><?php echo $cargo_autoridades->getCreatedBy() ?></td>
      <td><?php echo $cargo_autoridades->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('cargoautoridades/new') ?>">New</a>
