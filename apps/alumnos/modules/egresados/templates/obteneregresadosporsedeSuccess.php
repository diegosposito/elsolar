<h1>Informe de Egresados por Sede</h1> 
<div align="center">
<table width="100%" class="stats" cellspacing="0">
  <thead>
	<tr>
		<td width="17%"><b>Sede:</b></td>
		<td colspan="3"><?php echo $sede->getNombre(); ?></td>
	</tr>
  <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center">Alumno</td>
      <td class="hed" align="center" width="10%">Fecha de egreso</td>
      <td class="hed" align="center" width="30%">Carrera</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($alumnos as $alumno): ?>
    <tr>
      <td><?php echo $alumno['idalumno'] ?></td>
      <td><?php echo $alumno['nombre'] ?></td>
      <td><?php echo $alumno['fechaegreso'] ?></td>
      <td><?php echo $alumno['carrera'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>		