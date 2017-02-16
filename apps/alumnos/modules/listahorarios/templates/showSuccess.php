<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $lista_horarios->getId() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $lista_horarios->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Activa:</th>
      <td><?php echo $lista_horarios->getActiva() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $lista_horarios->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $lista_horarios->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $lista_horarios->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $lista_horarios->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('listahorarios/edit?id='.$lista_horarios->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('listahorarios/index') ?>">List</a>
