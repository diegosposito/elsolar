<table>
  <tbody>
    <tr>
      <th>Idcargoautoridad:</th>
      <td><?php echo $cargo_autoridades->getIdcargoautoridad() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $cargo_autoridades->getNombre() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $cargo_autoridades->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $cargo_autoridades->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $cargo_autoridades->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $cargo_autoridades->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('cargoautoridades/edit?idcargoautoridad='.$cargo_autoridades->getIdcargoautoridad()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('cargoautoridades/index') ?>">List</a>
