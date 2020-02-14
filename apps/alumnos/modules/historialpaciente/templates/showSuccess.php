<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $historialpaciente->getId() ?></td>
    </tr>
    <tr>
      <th>Detalle:</th>
      <td><?php echo $historialpaciente->getDetalle() ?></td>
    </tr>
    <tr>
      <th>Profesionales:</th>
      <td><?php echo $historialpaciente->getProfesionales() ?></td>
    </tr>
    <tr>
      <th>Fecha:</th>
      <td><?php echo $historialpaciente->getFecha() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('historialpaciente/edit?id='.$historialpaciente->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('historialpaciente/index') ?>">List</a>
