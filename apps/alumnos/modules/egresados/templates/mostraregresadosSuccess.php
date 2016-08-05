<script>
$(document).ready(function(){
	$("#inicio").datepicker();
	$("#fin").datepicker();
});
</script>
<h1>Obtener Egresados</h1>
<br>
<div align="center">
<form action="<?php echo url_for('egresados/obtenerdetalleegresados') ?>" method="post">
<table cellspacing="0" class="stats" width="100%">
<tr>
	<td width="20%"><b>Fecha Egreso (desde):</b></td>
	<td><input type="text" name="inicio" id="inicio"></td>
</tr>
<tr>
	<td width="20%"><b>Fecha Egreso (hasta):</b></td>
	<td><input type="text" name="fin" id="fin"></td>
</tr>
<tr>
	<td><b>Tipo de reporte:</b></td>
	<td>
		<SELECT name="idreporte" id="idreporte"> 
   		<?php
			echo "<option value='0' selected='selected' >----SELECCIONAR REPORTE----</option>";
     		echo "<option value=1>Obtener Detalle de Egresados</option>";
     		echo "<option value=2>Obtener Totales de Egresados</option>";
        ?> 
   		</SELECT>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="Obtener reporte" title="Obtener reporte" id="botonObtener" >
	</td>
</tr>
</table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('egresados/buscar') ?>'"></p>
<br>