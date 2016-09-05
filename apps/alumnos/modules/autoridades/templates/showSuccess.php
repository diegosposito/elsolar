<table>
  <tbody>
    <tr>
      <th>Idautoridad:</th>
      <td><?php echo $autoridades->getIdautoridad() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $autoridades->getNombre() ?></td>
    </tr>
    <tr>
      <th>Idcargoautoridad:</th>
      <td><?php echo $autoridades->getIdcargoautoridad() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $autoridades->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $autoridades->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $autoridades->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $autoridades->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('autoridades/edit?idautoridad='.$autoridades->getIdautoridad()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('autoridades/index') ?>">List</a>
