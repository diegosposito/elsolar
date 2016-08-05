<h1>Ver Equivalencia</h1>
<br>
<div align="center">
  <table cellspacing="0" class="stats" width="80%">
  <tbody>
    <tr>
      <td width="22%"><b>Id:</b></td>
      <td><?php echo $equivalencias_alumnos->getIdequivalencia() ?></td>
    </tr>
    <tr>
      <td><b>Alumno:</b></td>
      <td><?php echo $equivalencias_alumnos->getAlumnos()->getPersonas() ?></td>
    </tr>
    <tr>
      <td><b>Fecha:</b></td>
      <td><?php echo $equivalencias_alumnos->getFecha() ?></td>
    </tr>
    <tr>
      <td><b>Fecha de resolución:</b></td>
      <td><?php echo $equivalencias_alumnos->getFecharesolucion() ?></td>
    </tr>
    <tr>
      <td><b>Nro. de resolución:</b></td>
      <td><?php echo $equivalencias_alumnos->getNroresolucion() ?></td>
    </tr>
    <tr>
      <td><b>Observaciones:</b></td>
      <td><?php echo $equivalencias_alumnos->getObservaciones() ?></td>
    </tr>
    <tr>
      <td colspan="2">
		<table width="100%" cellspacing="0" class="stats">
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="80%">Materia</td>
		      <td class="hed" align="center" width="7%">Curso</td>
		      <td class="hed" align="center" width="7%">Estado</td>
		    </tr>
		    <?php 
		    if (count($materias_equivalencias) > 0) { 
		    	foreach ($materias_equivalencias as $materia) {
		    ?>
		    <tr class="fila_">
		      <td align="center"><?php echo $materia->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia->getMateriasPlanes()->getAnodecursada(); ?></td>
		      <td><?php echo $materia->getEstadosEquivalencias(); ?></td>
		    </tr>
		    <?php 
				} 
			} else { 
			?>
		     <tr>
		      <td align="center" colspan="4">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		</table>      
      </td>
    </tr>    
  </tbody>
</table>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for($link) ?>'"></p>
<br>
