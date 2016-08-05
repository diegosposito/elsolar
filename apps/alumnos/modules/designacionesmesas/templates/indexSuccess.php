<h1>Designaciones mesass List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Idpersona</th>
      <th>Idmesaexamen</th>
      <th>Idtipodesignacionmesa</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($designaciones_mesass as $designaciones_mesas): ?>
    <tr>
      <td><a href="<?php echo url_for('designacionesmesas/edit?id='.$designaciones_mesas->getId()) ?>"><?php echo $designaciones_mesas->getId() ?></a></td>
      <td><?php echo $designaciones_mesas->getIdpersona() ?></td>
      <td><?php echo $designaciones_mesas->getIdmesaexamen() ?></td>
      <td><?php echo $designaciones_mesas->getIdtipodesignacionmesa() ?></td>
      <td><?php echo $designaciones_mesas->getCreatedAt() ?></td>
      <td><?php echo $designaciones_mesas->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('designacionesmesas/new') ?>">New</a>
