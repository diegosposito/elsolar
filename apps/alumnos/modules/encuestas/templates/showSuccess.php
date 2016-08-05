<table>
  <tbody>
    <tr>
      <th>Idencuesta:</th>
      <td><?php echo $encuestas->getIdencuesta() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $encuestas->getNombre() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $encuestas->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $encuestas->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $encuestas->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $encuestas->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $encuestas->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('encuestas/edit?idencuesta='.$encuestas->getIdencuesta()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('encuestas/index') ?>">List</a>
