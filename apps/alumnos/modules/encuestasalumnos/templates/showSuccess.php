<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $encuestas_alumnos->getId() ?></td>
    </tr>
    <tr>
      <th>Idencuesta:</th>
      <td><?php echo $encuestas_alumnos->getIdencuesta() ?></td>
    </tr>
    <tr>
      <th>Idalumno:</th>
      <td><?php echo $encuestas_alumnos->getIdalumno() ?></td>
    </tr>
    <tr>
      <th>Fecha:</th>
      <td><?php echo $encuestas_alumnos->getFecha() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $encuestas_alumnos->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $encuestas_alumnos->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $encuestas_alumnos->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $encuestas_alumnos->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('encuestasalumnos/edit?id='.$encuestas_alumnos->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('encuestasalumnos/index') ?>">List</a>
