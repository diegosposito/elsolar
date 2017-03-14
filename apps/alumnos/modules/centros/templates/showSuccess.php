<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $centros->getId() ?></td>
    </tr>
    <tr>
      <th>Activo:</th>
      <td><?php echo $centros->getActivo() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $centros->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $centros->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $centros->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $centros->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $centros->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('centros/edit?id='.$centros->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('centros/index') ?>">List</a>
