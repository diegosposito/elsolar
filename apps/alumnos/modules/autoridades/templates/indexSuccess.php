<h1>Autoridadess List</h1>

<table>
  <thead>
    <tr>
      <th>Idautoridad</th>
      <th>Nombre</th>
      <th>Idcargoautoridad</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($autoridadess as $autoridades): ?>
    <tr>
      <td><a href="<?php echo url_for('autoridades/show?idautoridad='.$autoridades->getIdautoridad()) ?>"><?php echo $autoridades->getIdautoridad() ?></a></td>
      <td><?php echo $autoridades->getNombre() ?></td>
      <td><?php echo $autoridades->getIdcargoautoridad() ?></td>
      <td><?php echo $autoridades->getCreatedAt() ?></td>
      <td><?php echo $autoridades->getUpdatedAt() ?></td>
      <td><?php echo $autoridades->getCreatedBy() ?></td>
      <td><?php echo $autoridades->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('autoridades/new') ?>">New</a>
