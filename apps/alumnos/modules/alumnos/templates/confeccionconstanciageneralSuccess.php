<script>
$(document).ready(function(){
	$.post("<?php echo url_for('alumnos/obtenernotas'); ?>",
		{ idalumno:<?php echo $alumno['idalumno']; ?>, tipo: $("#tipo").val() },
		function(data){
			$('#notas').html(data);
		}
	);        

	$("#tipo").change(function() {
		$.post("<?php echo url_for('alumnos/obtenernotas'); ?>",
			{ idalumno:<?php echo $alumno['idalumno']; ?>, tipo: $("#tipo").val() },
			function(data){
				$('#notas').html(data);
			}
		);        
	});     
});
</script>

<h1>Constancia General</h1>
<?php
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL,'es_ES');
?>

<form name="form_<?php echo $plan['idcarrera']; ?>" method="post" action="<?php echo url_for('alumnos/imprimirconstanciageneral' ) ?>">  
	<table width="100%" class="stats" cellspacing="0">
		<tr>
			<td align="center" class="hed">Id</td>
			<td align="center" class="hed">Carrera</td>
			<td align="center" class="hed">Sede</td>
			<td align="center" class="hed">Acciones</td>
		</tr>
    <?php if (count($datosanalitico) > 0) { ?>
		<tr>
			<td><?php echo $alumno->getPlanesEstudios()->getIdcarrera() ?></td>
			<td><?php echo $alumno->getPlanesEstudios() ?></td>
			<td><?php echo $alumno->getSedes() ?></td>
			<td align="center">
				<input type="hidden" name="ida" value="<?php echo $alumno['idalumno']; ?>">
				<input type="submit" value="Imprimir" title="Imprimir Constancia" id="imprimir" class="form_consulta_enviar" name="Imprimir">
			</td>
		</tr>     
    <?php } else { ?>
		<tr>
			<td colspan="4" align="center">No existen datos para mostrar en el Analítico Parcial.</td>
		</tr>     
	<?php } ?>
	</table>

	<br />
	<div align="center">
	<table class="stats" width="100%" border="1px">
	<?php foreach($datosanalitico as $datosanalit) { ?>   
		<tr>
			<td colspan="11">
				<table width="100%" class="stats" cellspacing="0">
					<tr>
						<td width="40%" class="hed">Lugar:</td>
						<td width="40%" ><INPUT type="text" name="lugar" size="66" value="<?php echo  $datosanalit['ciudadsede']  ?>"></td>
						<td width="10%" class="hed">Fecha:</td>
						<td width="10%" ><INPUT type="text" name="fecha" size="8" value="<?php echo date('d/m/Y'); ?>"></td>
					</tr>
				</table>            
			</td>
		</tr>
		<tr>
			<td align="center" colspan="11" class="hed">Texto de Constancia</td>
		</tr>     
		<tr>
			<td align="center" colspan="11">
				<TEXTAREA cols="107" rows="4" name="observaciones"><?php echo ""; //aqui va codigo de obtener materias optativas, equvalencias y todo lo que se desea observar ?></TEXTAREA>
			</td>
		</tr>
	<?php } ?>            
	</table>
	<br />
	</div>
</form>