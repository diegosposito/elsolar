<h1>Detalle horarioss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Orden</th>
      <th>Idlistahorarios</th>
      <th>Idcentro</th>
      <th>Idpersona</th>
      <th>Hdesde</th>
      <th>Hhasta</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle_horarioss as $detalle_horarios): ?>
    <tr>
      <td><a href="<?php echo url_for('detallehorarios/show?id='.$detalle_horarios->getId()) ?>"><?php echo $detalle_horarios->getId() ?></a></td>
      <td><?php echo $detalle_horarios->getNombre() ?></td>
      <td><?php echo $detalle_horarios->getOrden() ?></td>
      <td><?php echo $detalle_horarios->getIdlistahorarios() ?></td>
      <td><?php echo $detalle_horarios->getIdcentro() ?></td>
      <td><?php echo $detalle_horarios->getIdpersona() ?></td>
      <td><?php echo $detalle_horarios->getHdesde() ?></td>
      <td><?php echo $detalle_horarios->getHhasta() ?></td>
      <td><?php echo $detalle_horarios->getCreatedAt() ?></td>
      <td><?php echo $detalle_horarios->getUpdatedAt() ?></td>
      <td><?php echo $detalle_horarios->getCreatedBy() ?></td>
      <td><?php echo $detalle_horarios->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('detallehorarios/new') ?>">New</a>
