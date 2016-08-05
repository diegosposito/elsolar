<h1>Expedientes</h1>
<br>
<input type="button" value="Solicitar Diploma" onclick="location.href='<?php echo url_for('expedientes/buscar') ?>'">
<br><br>
<table cellspacing="0" class="stats" width="100%">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Alumno</td>
      <td class="hed" align="center">Nro. de Documento</td>
      <td class="hed" align="center">Fecha Solicitud</td>
      <td class="hed" align="center">Sede</td>
      <td class="hed" align="center">Título</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($expedientess) > 0) { ?>    
    <?php foreach ($expedientess as $expediente) { ?>
    <tr>
      <?php 
      $color="";
      if ($errores[$expediente->getIdexpediente()]==4) {
      	$color = 'bgcolor="yellow"';
      } elseif($errores[$expediente->getIdexpediente()]==7) {
      	$color = 'bgcolor="blue"';
      } elseif($errores[$expediente->getIdexpediente()]==0) {
      	$color = '';    
      } elseif($errores[$expediente->getIdexpediente()]==5) {
      	$color = 'bgcolor="orange"';    
      } elseif($errores[$expediente->getIdexpediente()]==6 or $errores[$expediente->getIdexpediente()]==10) {
      	$color = 'bgcolor="olive"';    
      } elseif($errores[$expediente->getIdexpediente()]==8) {
      	$color = 'bgcolor="indigo"';  
 	  } elseif($errores[$expediente->getIdexpediente()]==9) {
      	$color = 'bgcolor="saddlebrown"';          	     	    	      	   	
      } else {
      	$color = 'bgcolor="green"';
      } ?>
      <td <?php echo $color; ?> align="center"><?php echo $expediente->getIdexpediente() ?></td>
      <td><?php echo $expediente->getAlumnos()->getPersonas() ?></td>
      <td align="center"><?php echo $expediente->getAlumnos()->getPersonas()->getTiposDocumentos()." ".$expediente->getAlumnos()->getPersonas()->getNrodoc() ?></td>
      <td align="center">
		<?php 
		$arr = explode('-', $expediente->getFechaSolicitud());
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fecha; 
		?>	      
      </td>
      <td align="center"><?php echo $expediente->getSedes()->getAbreviacion() ?></td>
      <td align="center"><?php echo $expediente->getTitulos() ?></td>
      <td align="center">
      <form id="formExpediente_<?php echo $expediente->getIdexpediente(); ?>" action="">
      	<input type="button" value="Ver" onclick="location.href='<?php echo url_for('expedientes/ver?idexpediente='.$expediente->getIdexpediente().'&credencial=facultad') ?>'">
    	<?php if (($errores[$expediente->getIdexpediente()]==0) or ($errores[$expediente->getIdexpediente()]==5)) { ?>
    		<?php if ($expediente->getIdsede()==1) { ?>
    		<input type="button" value="Imprimir" onclick="location.href='<?php echo url_for('expedientes/imprimirsegundaparte?idexpediente='.$expediente->getIdexpediente()) ?>'">
    		<?php } ?>
    		<input type="button" value="Derivar" onclick="location.href='<?php echo url_for('derivaciones/derivar?idexpediente='.$expediente->getIdexpediente().'&credencial=facultad') ?>'">
    	<?php } elseif (($errores[$expediente->getIdexpediente()]==1) or ($errores[$expediente->getIdexpediente()]==2) or ($errores[$expediente->getIdexpediente()]==3)) { ?>
			<input type="button" value="Imprimir" onclick="alert('<?php echo $mensajes[$errores[$expediente->getIdexpediente()]] ?>');">    	
    	<?php } elseif ($errores[$expediente->getIdexpediente()]==6) { ?>
    		<input type="button" value="Archivar" onclick="location.href='<?php echo url_for('derivaciones/archivar?idexpediente='.$expediente->getIdexpediente().'&credencial=facultad') ?>'">
    	<?php } elseif ($errores[$expediente->getIdexpediente()]==10) { ?>
    		<input type="button" value="Archivar" onclick="alert('<?php echo $mensajes[$errores[$expediente->getIdexpediente()]] ?>');">
    		<input type="button" value="Derivar" onclick="location.href='<?php echo url_for('derivaciones/derivar?idexpediente='.$expediente->getIdexpediente().'&credencial=facultad') ?>'">			    	
    	<?php } else { ?>
    		<input type="button" value="Derivar" onclick="alert('<?php echo $mensajes[$errores[$expediente->getIdexpediente()]] ?>');">
    	<?php } ?>
      </form>
	  </td>      
    </tr>
    <?php } ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen expedientes.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>
<br><b>ACLARACIÓN:</b><br>
El color en le primera columna indica:<br>
<font color="yellow"><b>AMARILLO:</b></font> El alumno no tiene estudios previos cargados.<br>
<font color="orange"><b>NARANJA:</b></font> Hay observaciones de Auditoría Academica.<br>
<font color="olive"><b>OLIVA:</b></font> Hay observaciones de Legalización de Títulos.<br>
<font color="blue"><b>AZUL:</b></font> No existe el nro. de resolucion cargada.<br>
<font color="green"><b>VERDE:</b></font> No se recibieron las aprobaciones de Biblioteca y Administración Central.<br>
<font color="indigo"><b>VIOLETA:</b></font> Hay observaciones de Biblioteca o Administración Central.<br>
<font color="saddlebrown"><b>MARRON:</b></font> El expediente ha sido reenviado a Administración Central para su evaluación.