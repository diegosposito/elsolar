<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $detalle_horarios->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $detalle_horarios->getNombre() ?></td>
    </tr>
    <tr>
      <th>Orden:</th>
      <td><?php echo $detalle_horarios->getOrden() ?></td>
    </tr>
    <tr>
      <th>Idlistahorarios:</th>
      <td><?php echo $detalle_horarios->getIdlistahorarios() ?></td>
    </tr>
    <tr>
      <th>Idcentro:</th>
      <td><?php echo $detalle_horarios->getIdcentro() ?></td>
    </tr>
    <tr>
      <th>Idpersona:</th>
      <td><?php echo $detalle_horarios->getIdpersona() ?></td>
    </tr>
    <tr>
      <th>Hdesde:</th>
      <td><?php echo $detalle_horarios->getHdesde() ?></td>
    </tr>
    <tr>
      <th>Hhasta:</th>
      <td><?php echo $detalle_horarios->getHhasta() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $detalle_horarios->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $detalle_horarios->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $detalle_horarios->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $detalle_horarios->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('detallehorarios/edit?id='.$detalle_horarios->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('detallehorarios/index') ?>">List</a>
