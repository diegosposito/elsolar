<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $profesionalesasociado->getId() ?></td>
    </tr>
    <tr>
      <th>Familiara:</th>
      <td><?php echo $profesionalesasociado->getFamiliara() ?></td>
    </tr>
    <tr>
      <th>Familiarb:</th>
      <td><?php echo $profesionalesasociado->getFamiliarb() ?></td>
    </tr>
    <tr>
      <th>Familiarc:</th>
      <td><?php echo $profesionalesasociado->getFamiliarc() ?></td>
    </tr>
    <tr>
      <th>Fecharegistro:</th>
      <td><?php echo $profesionalesasociado->getFecharegistro() ?></td>
    </tr>
    <tr>
      <th>Detalle:</th>
      <td><?php echo $profesionalesasociado->getDetalle() ?></td>
    </tr>
    <tr>
      <th>Idmovimiento:</th>
      <td><?php echo $profesionalesasociado->getIdmovimiento() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $profesionalesasociado->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $profesionalesasociado->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $profesionalesasociado->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $profesionalesasociado->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('profesionalesasociado/edit?id='.$profesionalesasociado->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('profesionalesasociado/index') ?>">List</a>
