<h1>Historialpacientes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Familiara</th>
      <th>Familiarb</th>
      <th>Familiarc</th>
      <th>Fecharegistro</th>
      <th>Detalle</th>
      <th>Activo</th>
      <th>Idmovimiento</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($historialpacientes as $historialpaciente): ?>
    <tr>
      <td><a href="<?php echo url_for('historialpaciente/show?id='.$historialpaciente->getId()) ?>"><?php echo $historialpaciente->getId() ?></a></td>
      <td><?php echo $historialpaciente->getFamiliara() ?></td>
      <td><?php echo $historialpaciente->getFamiliarb() ?></td>
      <td><?php echo $historialpaciente->getFamiliarc() ?></td>
      <td><?php echo $historialpaciente->getFecharegistro() ?></td>
      <td><?php echo $historialpaciente->getDetalle() ?></td>
      <td><?php echo $historialpaciente->getActivo() ?></td>
      <td><?php echo $historialpaciente->getIdmovimiento() ?></td>
      <td><?php echo $historialpaciente->getCreatedAt() ?></td>
      <td><?php echo $historialpaciente->getUpdatedAt() ?></td>
      <td><?php echo $historialpaciente->getCreatedBy() ?></td>
      <td><?php echo $historialpaciente->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('historialpaciente/new') ?>">New</a>
