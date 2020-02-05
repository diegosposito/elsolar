<h1>Profesionalesasociados List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Familiara</th>
      <th>Familiarb</th>
      <th>Familiarc</th>
      <th>Fecharegistro</th>
      <th>Detalle</th>
      <th>Idmovimiento</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($profesionalesasociados as $profesionalesasociado): ?>
    <tr>
      <td><a href="<?php echo url_for('profesionalesasociado/show?id='.$profesionalesasociado->getId()) ?>"><?php echo $profesionalesasociado->getId() ?></a></td>
      <td><?php echo $profesionalesasociado->getFamiliara() ?></td>
      <td><?php echo $profesionalesasociado->getFamiliarb() ?></td>
      <td><?php echo $profesionalesasociado->getFamiliarc() ?></td>
      <td><?php echo $profesionalesasociado->getFecharegistro() ?></td>
      <td><?php echo $profesionalesasociado->getDetalle() ?></td>
      <td><?php echo $profesionalesasociado->getIdmovimiento() ?></td>
      <td><?php echo $profesionalesasociado->getCreatedAt() ?></td>
      <td><?php echo $profesionalesasociado->getUpdatedAt() ?></td>
      <td><?php echo $profesionalesasociado->getCreatedBy() ?></td>
      <td><?php echo $profesionalesasociado->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('profesionalesasociado/new') ?>">New</a>
