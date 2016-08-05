<h1>Informe de Bajas</h1>
<br>
<form name="formDescargar" method="post" action="<?php echo url_for('bajas/listadobajascsv') ?>">  
	<input type="hidden" name="idfacultad" value="<?php echo $idfacultad; ?>">
	<input type="hidden" name="idsede" value="<?php echo $idsede; ?>">
	<input type="hidden" name="idplanestudio" value="<?php echo $idplanestudio; ?>">
	<input type="hidden" name="ordencampo" value="<?php echo $ordencampo; ?>">
	<input type="hidden" name="ordenmetodo" value="<?php echo $ordenmetodo; ?>">
	<input type="submit" value="Descargar Informe" title="Descargar Informe" id="botonDescargar">
</form>	
<br>
<div align="center">
<table width="100%" class="stats" cellspacing="0">
  <thead>
	<tr>
		<td colspan="4"><b>Sede: </b><?php echo $sede; ?></td>
		<td colspan="5"><b>Facultad: </b><?php echo $facultad; ?></td>
	</tr>	
	<tr>
		<td colspan="9"><b>Carrera: </b><?php echo $plan; ?></td>
	</tr>	
  <tr> 
  	  <td class="hed" align="center" width="1%"></td>
      <td class="hed" align="center" width="4%">Id</td>
      <td class="hed" align="center" width="30%">Alumno</td>
      <td class="hed" align="center" width="10%">Ciclo lectivo</td>
      <td class="hed" align="center" width="10%">Fecha efectiva de baja</td>
      <td class="hed" align="center" width="30%">Carrera</td>
      <td class="hed" align="center" width="5%">Facultad</td>
      <td class="hed" align="center" width="5%">Sede</td>
      <td class="hed" align="center" width="10%">Fecha de registro</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($alumnos)>0) { ?>
  	<?php $i=1; ?>
    <?php foreach ($alumnos as $alumno): ?>
    <tr>
      <td align="center"><?php echo $i ?></td>
      <td align="center"><?php echo $alumno['idalumno'] ?></td>
      <td><?php echo $alumno['nombre'] ?></td>
      <td align="center"><?php echo $alumno['ciclo'] ?></td>
      <td align="center"><?php echo $alumno['fechabaja'] ?></td>
      <td><?php echo $alumno['carrera'] ?></td>
      <td align="center"><?php echo $alumno['facultad'] ?></td>
      <td align="center"><?php echo $alumno['sede'] ?></td>
      <td align="center">
      	<?php 
      	$fecha = explode(" ",$alumno['fecharegistro']);
      	echo $fecha[0]; 
      	?>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php } else { ?>
    <tr>
      <td colspan="9" align="center">No existen registros.</td>
    </tr>    
    <?php } ?>
  </tbody>
</table>
</div>	
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('bajas/buscarbajas') ?>'"></p>
<br>
