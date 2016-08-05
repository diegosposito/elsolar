<h1>Clasess List</h1>

<table>
  <thead>
    <tr>
      <th>Idclase</th>
      <th>Idasignacion</th>
      <th>Fecha</th>
      <th>Tema</th>
      <th>Temaplanificado</th>
      <th>Horasdictadas</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($clasess as $clases): ?>
    <tr>
      <td><a href="<?php echo url_for('clases/edit?idclase='.$clases->getIdclase()) ?>"><?php echo $clases->getIdclase() ?></a></td>
      <td><?php echo $clases->getIdasignacion() ?></td>
      <td><?php echo $clases->getFecha() ?></td>
      <td><?php echo $clases->getTema() ?></td>
      <td><?php echo $clases->getTemaplanificado() ?></td>
      <td><?php echo $clases->getHorasdictadas() ?></td>
      <td><?php echo $clases->getActivo() ?></td>
      <td><?php echo $clases->getCreatedAt() ?></td>
      <td><?php echo $clases->getUpdatedAt() ?></td>
      <td><?php echo $clases->getCreatedBy() ?></td>
      <td><?php echo $clases->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('clases/new') ?>">New</a>
