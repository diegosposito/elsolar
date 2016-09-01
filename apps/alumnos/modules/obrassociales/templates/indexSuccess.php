<h1>Obras socialess List</h1>

<table>
  <thead>
    <tr>
      <th>Idobrasocial</th>
      <th>Denominacion</th>
      <th>Abreviada</th>
      <th>Estado</th>
      <th>Fechaarancel</th>
      <th>Fechaultimoperiodo</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($obras_socialess as $obras_sociales): ?>
    <tr>
      <td><a href="<?php echo url_for('obrassociales/show?idobrasocial='.$obras_sociales->getIdobrasocial()) ?>"><?php echo $obras_sociales->getIdobrasocial() ?></a></td>
      <td><?php echo $obras_sociales->getDenominacion() ?></td>
      <td><?php echo $obras_sociales->getAbreviada() ?></td>
      <td><?php echo $obras_sociales->getEstado() ?></td>
      <td><?php echo $obras_sociales->getFechaarancel() ?></td>
      <td><?php echo $obras_sociales->getFechaultimoperiodo() ?></td>
      <td><?php echo $obras_sociales->getCreatedAt() ?></td>
      <td><?php echo $obras_sociales->getUpdatedAt() ?></td>
      <td><?php echo $obras_sociales->getCreatedBy() ?></td>
      <td><?php echo $obras_sociales->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('obrassociales/new') ?>">New</a>
