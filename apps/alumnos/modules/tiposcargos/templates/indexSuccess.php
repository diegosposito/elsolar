<h1>Tipos cargoss List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipocargo</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_cargoss as $tipos_cargos): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposcargos/edit?idtipocargo='.$tipos_cargos->getIdtipocargo()) ?>"><?php echo $tipos_cargos->getIdtipocargo() ?></a></td>
      <td><?php echo $tipos_cargos->getDescripcion() ?></td>
      <td><?php echo $tipos_cargos->getCreatedAt() ?></td>
      <td><?php echo $tipos_cargos->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposcargos/new') ?>">New</a>
