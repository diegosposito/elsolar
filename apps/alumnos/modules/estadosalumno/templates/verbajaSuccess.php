<h1>Ver Baja</h1>
<br>
	<input type="button" value="Imprimir" onclick="location.href='<?php echo url_for('estadosalumno/imprimirbaja?idbaja='.$baja->getIdbaja()) ?>'">
<br><br>
<div align="center">
  <table cellspacing="0" class="stats" width="80%">
		<tr>
			<td width="19%"><b>Fecha:</b></td>
			<td>
	      	<?php 
				$arr = explode('-', $baja->getFecha());
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
			?>
  			<?php echo $fecha; ?>		
  			</td>	
		</tr>		
		<tr>
		    <td><b>Alumno:</b></td>
		    <td><?php echo $alumno->getPersonas(); ?>(<?php echo $alumno->getIdalumno(); ?>)</td>
		</tr>
		<tr>
		    <td><b>Nro. documento:</b></td>
		    <td><?php echo $alumno->getPersonas()->getTiposDocumentos().": ".$alumno->getPersonas()->getNrodoc(); ?></td>
		</tr>  
		<tr>
		    <td><b>Plan de estudio:</b></td>
		    <td><?php echo $alumno->getPlanesEstudios(); ?></td>
		</tr>  		
		<tr>
			<td><b>Tipo de solicitud:</b></td>
			<td><?php echo $tiposolicitud; ?></td>
		</tr>		
		<tr>
			<td><b>Tipo de baja:</b></td>
			<td><?php echo $tipobaja; ?></td>
		</tr>
		<tr>
			<td width="14%"><b>Fecha de baja:</b></td>
			<td>
	      	<?php 
				$arr = explode('-', $baja->getFechabaja());
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
			?>
  			<?php echo $fecha; ?>		
  			</td>	
		</tr>	
		<tr>
			<td><b>Motivos:</b></td>
			<td>
			<?php if (count($motivos) > 0 ) { 
				foreach($motivos as $motivo) {
					echo $motivo->getMotivos()." ";
				} 
			} ?>
			</td>
		</tr>												
		<tr>
			<td><b>Especificar:</b></td>
			<td><?php echo $baja->getOtromotivo(); ?></td>
		</tr>	
		<tr>
			<td><b>Teléfono:</b></td>
			<td><?php echo $contacto->getTelefonofijocar()."-".$contacto->getTelefonofijonum(); ?></td>
		</tr>	
		<tr>
			<td><b>Celular:</b></td>
			<td><?php echo $contacto->getCelularcar()."-".$contacto->getCelularnum(); ?></td>
		</tr>	
		<tr>
			<td><b>E-mail:</b></td>
			<td><?php echo $contacto->getEmail(); ?></td>
		</tr>			
		<tr>
			<td colspan="2" align="center">
  				<table cellspacing="0" class="stats" width="80%">
					<tr>
						<td width="3%" class="hed" align="center"><b>Id</b></td>
						<td width="87%" class="hed" align="center"><b>Materia</b></td>
						<td width="10%" class="hed" align="center"><b>Año</b></td>			
					</tr>
				<?php if (count($materias)>0) { ?>
					<?php foreach($materias as $materia) { ?>
					<tr>
						<td align="center"><?php echo $materia->getIdmateriaplan() ?></td>
						<td><?php echo $materia->getMateriasPlanes() ?></td>
						<td align="center"><?php echo $materia->getMateriasPlanes()->getAnodecursada() ?></td>			
					</tr>
					<?php } ?>
				<?php } else { ?>
					<tr>
						<td colspan="3" align="center">No existen registros.</td>
					</tr>				
				<?php } ?>					
				</table>			
			</td>
		</tr>			
			
  </table>
</div>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('estadosalumno/index?idcarrera='.$alumno->getIdplanestudio().'&idalumno='.$alumno->getIdalumno()) ?>'"></p>
<br>