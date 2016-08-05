<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2" class="hed">Plan de estudios: <?php echo $planestudio; $cantidadmaterias=$planestudio->getCantidadmaterias(); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">IDA</td>
		      <td class="hed" align="center" width="30%">Nombre</td>
		      <td class="hed" align="center" width="14%">Nro. Documento</td>
		      <td class="hed" align="center" width="13%">Fecha Ingreso</td>
		      <td class="hed" align="center" width="5%">Ciclo</td>
		      <td class="hed" align="center" width="5%">Máximo</td>
                      <td class="hed" align="center" width="5%">5to ap</td>
		      <td class="hed" align="center" width="5%">4to ap</td>
		      <td class="hed" align="center" width="5%">3to ap</td>
		      <td class="hed" align="center" width="5%">2to ap</td>
		      <td class="hed" align="center" width="5%">1to ap</td>
		      <td class="hed" align="center" width="5%">Estado</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($alumnos) > 0){ ?>
		    <?php foreach ($alumnos as $alumno): ?>


  		  <tr  bgcolor="<?php if($alumno['tieneaprobado']>0) {echo '#F7E99F';}; ?>">

		      <td align="center"><?php echo $alumno['idalumno']; ?></td>
		      <td align="left"><?php echo $alumno['apellido'].", ".$alumno['nombre']; ?></td>
		      <td><?php echo $alumno['tipodoc']." ".$alumno['nrodoc']; ?></td>
		      <td align="center">
		      <?php 
				$arr = explode('-', $alumno['fechaingreso']);
		        echo $arr[2]."-".$arr[1]."-".$arr[0]; 
		      ?>
		      </td>
		      <td align="center"><?php echo $alumno['ciclo']; ?></td>
		      <td align="center" bgcolor="<?php if($alumno['tieneaprobado']>0) {echo '#A9D322';}; ?>"><?php echo $alumno['tieneaprobado']; ?></td>
                       <td align="center" bgcolor="<?php if($alumno['quinto_aprobado']>0) {echo '#F9D32D';}; ?>"><?php echo $alumno['quinto_aprobado']; ?></td>
		      <td align="center" bgcolor="<?php if($alumno['cuarto_aprobado']>0) {echo '#F9D32D';}; ?>"><?php echo $alumno['cuarto_aprobado']; ?></td>
		      <td align="center" bgcolor="<?php if($alumno['tercero_aprobado']>0) {echo '#F9D32D';}; ?>"><?php echo $alumno['tercero_aprobado']; ?></td>
		      <td align="center" bgcolor="<?php if($alumno['segundo_aprobado']>0) {echo '#F9D32D';}; ?>"><?php echo $alumno['segundo_aprobado']; ?></td>
		      <td align="center" bgcolor="<?php if($alumno['primero_aprobado']>0) {echo '#F9D32D';}; ?>"><?php echo $alumno['primero_aprobado']; ?></td>
			<td align="center" bgcolor="<?php if($alumno['primero_aprobado']>0) {echo '#F9D32D';}; ?>"><?php 
				$oAlumno = Doctrine_Core::getTable('Alumnos')->find($alumno['idalumno']);
				
				echo $oAlumno->obtenerUltimoEstado()->getEstadosAlumno()->getDescripcion();
				?></td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="10" align="center">No existen alumnos.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr> 
</table>
</div>
