<script>
$(document).ready(function(){
	$('#botonAsociar').click(function(){
		// Crea las comisiones
    	$.post("<?php echo url_for('egresados/actualizaralumno'); ?>",
    		{idpersona: <?php echo $personas->getIdPersona(); ?>, idplanestudio: $("#idplanestudio").val(), idsede: $("#idsede").val(), idciclo: $("#idciclo").val()},
    	   	function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('egresados/buscar'); ?>");
        	}
		);
				
		return false;
	});    
});
</script>
<h1>Asociar Alumno a Carrera</h1>
<div align="center">
<form action="" method="post">
<table cellspacing="0" class="stats" width="100%">
<tr>
	<td width="5%"><b>Persona:</b></td>
	<td><?php echo $personas->getApellido().", ".$personas->getNombre(); ?></td>
</tr>
<tr>
	<td><b>Carrera:</b></td>
	<td>
		<SELECT name="idplanestudio" id="idplanestudio"> 
		<?php if (count($carreras) > 0) {
			//el bucle para cargar las opciones
			echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
			foreach ($carreras as $carrera){
				echo "<option value=".$carrera['idplanestudio'].">".$carrera['nombrecarrera']." - ".$carrera['nombreplan']."</option>";
			}
		} ?>
		</SELECT>		
	</td>
</tr>
<tr>
	<td><b>Sede:</b></td>
	<td>
		<SELECT name="idsede" id="idsede"> 
   		<?php foreach ($sedes as $sede ) { 
   			if ($sede->getNombre()!="") { ?>
     		<option value='<?php echo $sede->getIdsede() ?>'><?php echo $sede->getNombre() ?></option>";
        <?	} 
   		} ?> 
   		</SELECT>
	</td>
</tr>
<tr>
	<td><b>Ciclo lectivo:</b></td>
	<td>
		<SELECT name="idciclo" id="idciclo"> 
   		<?php foreach ($ciclos as $ciclo ) { 
   			if ($ciclo->getCiclo()!="") { ?>
     		<option value='<?php echo $ciclo->getId() ?>'><?php echo $ciclo->getCiclo() ?></option>";
        <?	} 
   		} ?> 
   		</SELECT>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="Asociar" title="Asociar" id="botonAsociar" >
	</td>
</tr>
</table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('egresados/buscar') ?>'"></p>
<br>
