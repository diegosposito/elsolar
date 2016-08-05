<h1>Visualizar Mesa de Examen</h1>
<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2"><b>Carrera: <?php echo $carrera; ?></b></td>
  </tr>
  <tr>
    <td colspan="2"><b>Asignatura: <?php echo $materia; ?></b></td>
  </tr>
  <tr>
    <td>Condición: <?php echo $condicion; ?></td>
    <td>Fecha: <?php echo $mesa; ?></td>
  </tr>
    <tr>
    <td>Libro: <?php echo $libro; ?></td>
    <td>Folio: <?php echo $folio; ?></td>
  </tr>  
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Legajo</td>
		      <td class="hed" align="center" width="15%">Nro. de Documento</td>
		      <td class="hed" align="center" width="35%">Alumno</td>
		      <td class="hed" align="center" width="15%">Nota escrito</td>
		      <td class="hed" align="center" width="15%">Nota oral</td>
		      <td class="hed" align="center" width="15%">Promedio</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php foreach ($alumnos as $alumno): ?>
		    <tr>
		      <td align="center">
		      	<?php echo $alumno->getLegajo(); ?>
		      	<input type="hidden" value="<?php echo $alumno->getIdAlumno(); ?>" name="alumnos[<?php echo $alumno->getIdAlumno(); ?>]" />
		      </td>
		      <td align="center"><?php echo $alumno->getPersonas()->getTiposDocumentos()." ".$alumno->getPersonas()->getNumerodoc(); ?></td>
		      <td><?php echo $alumno->getPersonas(); ?></td>
		      <td align="center"><?php echo $notaEscrita[$alumno->getIdAlumno()]; ?></td>
		      <td align="center"><?php echo $notaOral[$alumno->getIdAlumno()]; ?></td>
		      <td align="center"><?php echo $notaPromedio[$alumno->getIdAlumno()]; ?></td>
		    </tr>
		    <?php endforeach; ?>		  
		  </tbody>
		</table>
    </td>
  </tr>
</table>
</div>
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('mesasexamenes/index?&idplanestudio='.$materiaplan->getIdplanestudio().'&idestado='.$idestado.'&idsede='.$idsede) ?>'"></p>
<br>
