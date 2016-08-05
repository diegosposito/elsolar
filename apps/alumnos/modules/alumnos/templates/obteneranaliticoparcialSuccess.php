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
<h1>Analítico</h1>
<?php
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL,'es_ES');
?>
<form name="form_<?php echo $plan['idcarrera']; ?>" method="post" action="<?php echo url_for('alumnos/imprimiranaliticoparcial' ) ?>">  
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
		<input type="submit" value="Imprimir" title="Imprimir Analítico" id="imprimir" class="form_consulta_enviar" name="Imprimir">
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
    				<td width="40%" class="hed">Tipo de Analitico:</td>
    				<td colspan="3">
						<select name="tipo" id="tipo">
							<option value="1" selected="selected">Parcial Sin Aplazos</option>
							<option value="0">Parcial Con Aplazos</option>
							<option value="2">Sin Aplazos (Titulo en Tramite)</option>
						</select>
    				</td>
    			</tr>    		
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
      <td align="center" colspan="11" class="hed">Encabezado</td>
    </tr> 
    <tr>
    <td align="center" colspan="11">
 		<TEXTAREA cols="107" rows="6" name="encabezado">CONSTE que <?php echo $datosanalit['apellido'] ?>, <?php echo $datosanalit['nombre'] ?>, <?php echo $datosanalit['tipodocumento'] ?> Nº <?php echo ($datosanalit['numerodoc']!="")?$datosanalit['numerodoc']:$datosanalit['nrodoc'] ?> alumno de la carrera <?php echo $datosanalit['nomcar'] ?>, que se dicta en la <?php echo $datosanalit['nomfac']; ?> perteneciente a la Universidad de Concepción del Uruguay, ha aprobado las asignaturas que a continuación se detallan:<?php echo "\n" ?></TEXTAREA>
	</td>
    </tr>
    <tr>
    <td align="center" colspan="11">
    	<div id="notas" align="center"></div>
    </td>
    </tr>
    <tr>
      <td align="center" colspan="11" class="hed">Observaciones</td>
    </tr>     
    <tr>
		<td align="center" colspan="11">
			<TEXTAREA cols="107" rows="4" name="observaciones"><?php echo ""; //aqui va codigo de obtener materias optativas, equvalencias y todo lo que se desea observar ?></TEXTAREA>
		</td>
    </tr>
    <tr>
		<td align="center" colspan="11" class="hed">Texto Pie</td>
    </tr>
    <tr>
		<td align="center" colspan="11">		
			<TEXTAREA cols="107" rows="4" name="textopie">A solicitud del interesado/a y al solo efecto de su presentación ante las autoridades que la requieran, se extiende la presente constancia en la ciudad de <?php echo $datosanalit['ciudadsede'];  ?>, a los <?php echo strftime("%d días del mes de %B de %Y"); ?>.<?php echo "\n" ?></TEXTAREA>
		</td>
    </tr>
   <?php } ?>    	
</table>
<br />
</div>
</form>
