<h1>Ver Egresado</h1>
<br>
<?php if ($estado == 1) { ?>
	<input type="button" value="Solicitar Diploma" onclick="location.href='<?php echo url_for('expedientes/solicitardiploma?idalumno='.$alumno->getIdalumno().'&idtitulo='.$titulo->getIdtitulo()) ?>'">
<?php } elseif ($estado == 2) { ?>
	<input type="button" value="Imprimir Diploma" onclick="location.href='<?php echo url_for('expedientes/imprimirsolicituddiploma?idexpediente='.$expediente->getIdexpediente()) ?>'">
<?php } ?>
<br><br>

<div align="center">
  <table cellspacing="0" class="stats" width="80%">
  		<?php if($contacto =="") { ?>
	   	<tr>
	   	  <td colspan="2" >No existen datos de contactos para mostrar en el Analítico Final.</td>
	    </tr>    		
  		<?php } ?>
		<tr>
			<td width="40%"><b>Alumno:</b></td>
			<td><?php echo $alumno->getPersonas(); ?></td>
		</tr>
		<tr>
			<td><b>Nacionalidad:</b></td>
			<td><?php echo $nacionalidad; ?></td>
		</tr>		
		<tr>
			<td><b>Documento:</b></td>
			<td><?php echo $persona->getTiposDocumentos() .": ".$persona->getNrodoc(); ?></td>
		</tr>
		<tr>
			<td><b>Fecha de nacimiento:</b></td>
			<td>
	      	<?php 
				$arr = explode('-', $persona->getFechanac());
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
			?>
  			<?php echo $fecha; ?>
			</td>
		</tr>
		<tr>
			<td><b>Lugar de nacimiento:</b></td>
			<td><?php echo $ciudadnac; ?></td>
		</tr>			
		<?php if($contacto !="") { ?>											
		<tr>
			<td><b>Domicilio:</b></td>
			<td><?php echo $contacto->getCallee()." ".$contacto->getNumeroe(); ?></td>
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
			<td><b>Correo electrónico:</b></td>
			<td><?php echo $contacto->getEmail(); ?></td>
		</tr>	
		<tr>
			<td><b>Nro. Lector de biblioteca:</b></td>
			<td><?php echo $alumno->getPersonas()->getNrolector(); ?></td>
		</tr>	
		<?php } ?>
		<tr>
			<td><b>Fecha de aprobación de la última materia:</b></td>
			<td><?php echo $ultimafecha; ?></td>
		</tr>	
		<tr>
			<td><b>Diploma que solicita:</b></td>
			<td>
			<?php 
			if ($persona->getIdsexo()==1) {
				echo $titulo->getNombre();	
			} else {
				echo $titulo->getNombrefemenino();
			}
			?></td>
		</tr>			
  </table>
</div>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/buscar') ?>'"></p>
<br>
