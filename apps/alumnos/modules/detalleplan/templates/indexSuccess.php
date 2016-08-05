<h1>Detalle plans List</h1>

<table>
  <thead>
    <tr>
      <th>Iddetalleplan</th>
      <th>Idmateria</th>
      <th>Idplanestudio</th>
      <th>Idtipomateria</th>
      <th>Horas</th>
      <th>Curso</th>
      <th>Codmat</th>
      <th>Idtipocursada</th>
      <th>Cursada</th>
      <th>Orden</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle_plans as $detalle_plan): ?>
    <tr>
      <td><a href="<?php echo url_for('detalleplan/edit?iddetalleplan='.$detalle_plan->getIddetalleplan()) ?>"><?php echo $detalle_plan->getIddetalleplan() ?></a></td>
      <td><?php echo $detalle_plan->getIdmateria() ?></td>
      <td><?php echo $detalle_plan->getIdplanestudio() ?></td>
      <td><?php echo $detalle_plan->getIdtipomateria() ?></td>
      <td><?php echo $detalle_plan->getHoras() ?></td>
      <td><?php echo $detalle_plan->getCurso() ?></td>
      <td><?php echo $detalle_plan->getCodmat() ?></td>
      <td><?php echo $detalle_plan->getIdtipocursada() ?></td>
      <td><?php echo $detalle_plan->getCursada() ?></td>
      <td><?php echo $detalle_plan->getOrden() ?></td>
      <td><?php echo $detalle_plan->getCreatedAt() ?></td>
      <td><?php echo $detalle_plan->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('detalleplan/new') ?>">New</a>
