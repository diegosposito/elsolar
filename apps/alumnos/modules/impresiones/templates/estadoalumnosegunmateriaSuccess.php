<h1>Alumnos cursando y estado de correlatividades relacionadas</h1> 

<?php include_partial('formAlumnosSegunMateria', array('form' => $form, 'mensaje' => $mensaje)) ?>

<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td class="hed">Carrera: <?php echo isset($oCarrera) ? $oCarrera->getNombre() : ''; ?></td>
  </tr>
  <tr>
    <td class="hed">Materia: <?php echo $nombre_materia; ?></td>
  </tr>
  <tr>
    <td>Alumnos cursando:</td>
  </tr>
  <tr>
    <td align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center">Id</td>
		      <td class="hed" align="center">Apellido</td>
		      <td class="hed" align="center">Nombre</td>
		      <td class="hed" align="center">Total Correlativas</td>
		      <td class="hed" align="center">Materias Corr. Aprobadas</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($alumnos) > 0){ ?>
		    <?php foreach ($alumnos as $alumno): ?>
		    <tr bgcolor="<?php if($alumno['total'] == $alumno['materias_corr_aprobadas']) {echo '#fcdb1c';}; ?>">

		      <td align="center"><?php echo $alumno['idpersona']; ?></td>
		      <td align="center"><?php echo $alumno['apellido']; ?></td>
		      <td align="center"><?php echo $alumno['nombre']; ?></td>
		      <td align="center"><?php echo $alumno['total']; ?></td>
		      <td align="center"><?php echo $alumno['materias_corr_aprobadas']; ?></td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="6" align="center">Resultados.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>
</table>
</div>
