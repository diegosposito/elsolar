<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $historialpaciente->getId() ?></td>
    </tr>
    <tr>
      <th>Familiara:</th>
      <td><?php echo $historialpaciente->getFamiliara() ?></td>
    </tr>
    <tr>
      <th>Familiarb:</th>
      <td><?php echo $historialpaciente->getFamiliarb() ?></td>
    </tr>
    <tr>
      <th>Familiarc:</th>
      <td><?php echo $historialpaciente->getFamiliarc() ?></td>
    </tr>
    <tr>
      <th>Fecharegistro:</th>
      <td><?php echo $historialpaciente->getFecharegistro() ?></td>
    </tr>
    <tr>
      <th>Detalle:</th>
      <td><?php echo $historialpaciente->getDetalle() ?></td>
    </tr>
    <tr>
      <th>Activo:</th>
      <td><?php echo $historialpaciente->getActivo() ?></td>
    </tr>
    <tr>
      <th>Idmovimiento:</th>
      <td><?php echo $historialpaciente->getIdmovimiento() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $historialpaciente->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $historialpaciente->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $historialpaciente->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $historialpaciente->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('historialpaciente/edit?id='.$historialpaciente->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('historialpaciente/index') ?>">List</a>
