<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $horarios->getId() ?></td>
    </tr>
    <tr>
      <th>Idpersona:</th>
      <td><?php echo $horarios->getIdpersona() ?></td>
    </tr>
    <tr>
      <th>Anulado:</th>
      <td><?php echo $horarios->getAnulado() ?></td>
    </tr>
    <tr>
      <th>Tiporegistro:</th>
      <td><?php echo $horarios->getTiporegistro() ?></td>
    </tr>
    <tr>
      <th>Observaciones:</th>
      <td><?php echo $horarios->getObservaciones() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $horarios->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $horarios->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $horarios->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $horarios->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('horarios/edit?id='.$horarios->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('horarios/index') ?>">List</a>
