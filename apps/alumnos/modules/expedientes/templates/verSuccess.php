<script>
$(document).ready(function(){
	$("#oculto").attr('value', '1');
    $('#botonVer').click(function() {
		var oculto = $("#oculto").val();
        if(oculto ==1){
        	$.post("<?php echo url_for('derivaciones/ver'); ?>",
        			{ idexpediente:<?php echo $expediente->getIdexpediente(); ?> },
        			function(data){
        				$('#derivaciones').html(data);
        			}
        		);	 
        	$("#botonVer").attr('value', 'Ocultar');
        	$("#oculto").attr('value', '0');
        } else {
        	$('#derivaciones').html("");
        	$("#botonVer").attr('value', 'Ver Derivaciones');
        	$("#oculto").attr('value', '1');
		}
   	});  	
  
});
</script>
<h1>Expedientes</h1>
<table cellspacing="0" class="stats" width="100%">
    <tr>
		<td width="17%"><b>Nro. expediente:</b></td>
		<td><?php echo $expediente->getIdexpediente() ?></td>
	</tr>
    <tr>
		<td><b>Alumno:</b></td>
		<td><?php echo $expediente->getAlumnos()->getPersonas() ?></td>
	</tr>
    <tr>
		<td><b>Diploma que solicita:</b></td>
		<td><?php echo $expediente->getAlumnos()->getPlanesEstudios()->getCarreras() ?></td>
	</tr>	
    <tr>
		<td><b>Fecha de egreso:</b></td>
		<td><?php 
		$arr = explode('-', $expediente->getFechaegreso());
		$fechaegreso = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fechaegreso;
		?></td>
	</tr>
    <tr>
		<td><b>Fecha de solicitud:</b></td>
		<td><?php 
		$arr = explode('-', $expediente->getFechasolicitud());
		$fechasolicitud = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fechasolicitud; 
		?></td>		
	</tr>
    <tr>
		<td><b>Sede:</b></td>
		<td><?php echo $expediente->getSedes() ?></td>		
	</tr>	
    <tr>
		<td><b>Observaciones:</b></td>
		<td><?php echo $expediente->getObservaciones() ?></td>
	</tr>
	<?php if (($derivacionbiblio!="") and ($derivacionadmin!="")) { ?>
	<tr>
		<td colspan="2"></td>
	</tr>	
	<?php } ?>
	<tr>
		<td colspan="2" align="center">
		<input type="button" value="Imprimir Informes" onclick="location.href='<?php echo url_for('expedientes/imprimirsegundaparte?idexpediente='.$expediente->getIdexpediente()) ?>'">
		</td>
	</tr>				
	<tr>
		<td colspan="2"><b><h2>INFORME DE BIBLIOTECA:</h2></b></td>
	</tr>	
	<?php if ($derivacionbiblio!="") { ?>	
	<tr>
		<td><b>Lector n°:</b></td>
		<td><?php echo $expediente->getAlumnos()->getPersonas()->getNrolector() ?></td>
	</tr>
	<tr>
		<td><b>Observaciones:</b></td>
		<td><?php echo $derivacionbiblio->getObservaciones() ?></td>
	</tr>
	<tr>
		<td><b>Fecha:</b></td>
		<td><?php 
		$arr = explode('-', substr ($derivacionbiblio->getCreatedAt(), 0, 10));
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fecha; 
		?></td>	
	</tr>		
	<?php } ?>
	<tr>
		<td colspan="2"></td>
	</tr>				
	<tr>
		<td colspan="2"><b><h2>INFORME DE CONTADURIA:</h2></b></td>
	</tr>	
	<?php if ($derivacionadmin!="") { ?>	
	<tr>
		<td><b>Recibo n°:</b></td>
		<td><?php echo $expediente->getNrorecibo1() ?></td>
	</tr>
	<tr>
		<td><b>Tipo de pago:</b></td>
		<td><?php echo $tipopago ?></td>
	</tr>	
	<tr>
		<td><b>Observaciones:</b></td>
		<td><?php echo $derivacionadmin->getObservaciones() ?></td>
	</tr>
	<tr>
		<td><b>Fecha:</b></td>
		<td><?php 
		$arr = explode('-', substr ( $expediente->getCreatedAt() , 0, 10 ));
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fecha; 
		?></td>	
	</tr>	
	<?php } ?>		
      <tr>
        <td colspan="2" align="center">
        	<input type="hidden" name="oculto" value="" id="oculto">
        	<input type="button" value="Ver Derivaciones" id="botonVer">
        </td>
      </tr>   
      <tr>
        <td colspan="2" align="center"><div id="derivaciones" align="center"></div></td>
      </tr> 	
</table>
<?php if ($credencial=="auditoria") { ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/indexauditoria') ?>'"></p>
<?php } elseif ($credencial=="general") { ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/index') ?>'"></p>
<?php } elseif ($credencial=="titulos") { ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/indextitulos') ?>'"></p>
<?php } elseif ($credencial=="sede") { ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/indexsede') ?>'"></p>
<?php } else { ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/indexfacultad') ?>'"></p>
<?php } ?>
<br>	