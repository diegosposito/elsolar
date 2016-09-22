<h1>Horarioss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Idpersona</th>
      <th>Anulado</th>
      <th>Tiporegistro</th>
      <th>Observaciones</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($horarioss as $horarios): ?>
    <tr>
      <td><a href="<?php echo url_for('horarios/show?id='.$horarios->getId()) ?>"><?php echo $horarios->getId() ?></a></td>
      <td><?php echo $horarios->getIdpersona() ?></td>
      <td><?php echo $horarios->getAnulado() ?></td>
      <td><?php echo $horarios->getTiporegistro() ?></td>
      <td><?php echo $horarios->getObservaciones() ?></td>
      <td><?php echo $horarios->getCreatedAt() ?></td>
      <td><?php echo $horarios->getUpdatedAt() ?></td>
      <td><?php echo $horarios->getCreatedBy() ?></td>
      <td><?php echo $horarios->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('horarios/new') ?>">New</a>
