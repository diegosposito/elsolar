<h1>Condiciones mesass List</h1>

<table>
  <thead>
    <tr>
      <th>Idcondicion</th>
      <th>Condicion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($condiciones_mesass as $condiciones_mesass): ?>
    <tr>
      <td><a href="<?php echo url_for('condicionesmesas/edit?idcondicion='.$condiciones_mesas->getIdcondicion()) ?>"><?php echo $condiciones_mesas->getIdcondicion() ?></a></td>
      <td><?php echo $condiciones_mesas->getCondicion() ?></td>
      <td><?php echo $condiciones_mesas->getCreatedAt() ?></td>
      <td><?php echo $condiciones_mesas->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('condicionesmesas/new') ?>">New</a>
