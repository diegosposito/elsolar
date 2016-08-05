<h1>Estados</h1>
<div align="center">
<table width="80%" class="stats" cellspacing="0">
<tr>
	<td width="17%"><b>Plan de estudio:</b></td>
	<td><?php echo $planestudio; ?></td>
</tr>
<tr>
	<td><b>Estado:</b></td>
	<td><?php echo $estado; ?></td>	
</tr>
<tr>
	<td><b>Periodo:</b></td>
	<td><b>Inicio: </b><?php echo $inicio; ?><br><b>Fin: </b><?php echo $fin; ?></td>	
</tr>
<tr>
	<td colspan="2" align="center">
		<table width="70%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center">Alumno</td>
		      <td class="hed" align="center" width="10%">Fecha</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php foreach ($alumnos as $alumno): 
		    $oAlumno = Doctrine_Core::getTable('Alumnos')->find($alumno['idalumno']);
		    ?>
		    <tr>
		      <td><?php echo $alumno['idalumno'] ?></td>
		      <td><?php echo $oAlumno->getPersonas() ?></td>
		      <td><?php echo $alumno['fecha'] ?></td>
		    </tr>
		    <?php endforeach; ?>
		  </tbody>
		</table>
	</td>
	</tr>
</table>
</div>		