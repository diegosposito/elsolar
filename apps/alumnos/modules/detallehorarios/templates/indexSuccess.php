<h1>Detalle horarioss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Centro</th>
      <th>Profesional</th>
      <th>Hdesde</th>
      <th>Hhasta</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle_horarioss as $detalle_horarios): ?>
    <tr>
      <td><a href="<?php echo url_for('detallehorarios/show?id='.$detalle_horarios['id']) ?>"><?php echo $detalle_horarios['id'] ?></a></td>
      <td><?php echo $detalle_horarios['centro'] ?></td>
      <td><?php echo $detalle_horarios['profesional'] ?></td>
      <td><?php echo $detalle_horarios['hdesde'] ?></td>
      <td><?php echo $detalle_horarios['hhasta'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('detallehorarios/new?idlistahorario='.$idlistahorario) ?>">New</a>
