<h1>Informe de Egresados</h1>
<br>
<form name="formDescargar" method="post" action="<?php echo url_for('egresados/listadoegresadoscsv') ?>">  
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
		<td colspan="6"><b>Facultad: </b><?php echo $facultad; ?></td>
	</tr>	
	<tr>
		<td colspan="4"><b>Carrera: </b><?php echo $plan; ?></td>
		<td colspan="6"><b>Estado: </b><?php echo $estado; ?></td>
	</tr>	
  <tr> 
  	  <td class="hed" align="center" width="1%"></td>
      <td class="hed" align="center" width="4%">Id</td>
      <td class="hed" align="center" width="40%">Alumno</td>
      <td class="hed" align="center" width="10%">Egreso</td>
      <td class="hed" align="center" width="30%">Carrera</td>
      <td class="hed" align="center" width="5%">Facultad</td>
      <td class="hed" align="center" width="5%">Sede</td>
      <td class="hed" align="center" width="10%">Area</td>
      <td class="hed" align="center" width="2%">Adm</td>
      <td class="hed" align="center" width="2%">Bib</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($alumnos)>0) { ?>
  	<?php $i=1; ?>
    <?php foreach ($alumnos as $alumno):
    	$areaDestino = "";
    	$activo = 0;
    	if ($alumno['idexpediente']) {
			$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($alumno['idexpediente']);
			$oDerivacion = $oExpediente->obtenerUltimaDerivacion();
			$areaDestino = $oDerivacion->obtenerAreaDestino();
    	}
    ?>
    <tr>
      <td align="center"><?php echo $i ?></td>
      <td align="center"><?php echo $alumno['idalumno'] ?></td>
      <td><?php echo $alumno['nombre'] ?></td>
      <td align="center"><?php echo $alumno['fechaegreso'] ?></td>
      <td><?php echo $alumno['carrera'] ?></td>
      <td align="center"><?php echo $alumno['facultad'] ?></td>
      <td align="center"><?php echo $alumno['sede'] ?></td>
      <td align="center"><?php echo $areaDestino ?></td>
      <td align="center"><?php echo $alumno['adm'] ?></td>
      <td align="center"><?php echo $alumno['bib'] ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php } else { ?>
    <tr>
      <td colspan="10" align="center">No existen registros.</td>
    </tr>    
    <?php } ?>
  </tbody>
</table>
</div>	
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('egresados/buscaregresadosfiltrados') ?>'"></p>
<br>
