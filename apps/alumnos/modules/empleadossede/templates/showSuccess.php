<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $empleados_sede->getId() ?></td>
    </tr>
    <tr>
      <th>Empleado:</th>
      <td><?php echo $empleados_sede->getEmpleados() ?></td>
    </tr>
    <tr>
      <th>Sede:</th>
      <td><?php echo $empleados_sede->getSedes() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('empleadossede/edit?id='.$empleados_sede->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('empleadossede/index') ?>">List</a>
