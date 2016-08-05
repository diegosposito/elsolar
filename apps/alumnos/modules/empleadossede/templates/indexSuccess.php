<h1>Empleados por sede</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('empleadossede/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Empleado</td>
      <td class="hed" align="center">Sede</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($empleados_sedes as $empleados_sede): ?>
    <tr>
      <td align="center"><a href="<?php echo url_for('empleadossede/show?id='.$empleados_sede->getId()) ?>"><?php echo $empleados_sede->getId() ?></a></td>
      <td align="center"><?php echo $empleados_sede->getEmpleados()->getPersonas() ?></td>
      <td align="center"><?php echo $empleados_sede->getSedes() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>