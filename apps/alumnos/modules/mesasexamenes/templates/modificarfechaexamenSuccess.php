<script>
$(document).ready(function(){
	$('#hora').timepicker();	
	$('#fecha').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	$('#fecha').datepicker("setDate", "<?php echo $fecha; ?>");  
   	$('#fecha').datepicker( "option", "minDate", "<?php echo $inicio; ?>");
   	$('#fecha').datepicker( "option", "maxDate", "<?php echo $fin; ?>");

	$('#botonGuardar').click(function(){
    	var validado = validarFormFecha();
	    if(validado == true) {    			
			// Guarda el cambio de fecha en la mesa de examen
	    	$.post("<?php echo url_for('mesasexamenes/guardarfechaexamen'); ?>",
	    		{idmesaexamen: <?php echo $mesa->getIdmesaexamen(); ?>, fecha: $("#fecha").val(), hora: $("#hora").val()},
	    	   	function(data){
	        	   	alert(data);
	        	   	$(location).attr('href',"<?php echo url_for('mesasexamenes/buscar'); ?>");
	        	}
			);
		} else {
			alert(validado);
		}				
		return false;
	});    
});

//Valida el formulario
function validarFormFecha(){
	var regexpmesa = /^((?:0?[1-9])|(?:[12]\d)|(?:3[01]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:19|20)\d\d)$/;
	var resultado = true;
	
	if($('#hora').val()=="") {
		resultado = "Debe seleccionar una hora.";
	}
	if (!regexpmesa.test($('#fecha').val())) {
		resultado = "Debe ingresar una fecha válida.";
	} else {
		var dini = GetDate("<?php echo $inicio; ?>");
		var dfin = GetDate("<?php echo $fin; ?>");
		var d = GetDate($('#fecha').val());

		if ((d < dini) || (d > dfin)) {
		   resultado = "Debe ingresar una fecha dentro del llamado.\nFecha de inicio: <?php echo $inicio; ?>\nFecha de fin: <?php echo $fin; ?>";
		}		
	}

	return resultado;
} 

function GetDate(str){
    var arr = str.split("-");

    return new Date(parseInt(arr[2]), parseInt(arr[1]-1), parseInt(arr[0]));
}
</script>
<h1>Modificar fecha de Mesa de Examen</h1>
<div align="center">
<form action="" method="post" id="formModificar">
<table cellspacing="0" class="stats" width="100%">
<tr>
	<td width="15%"><b>Materia:</b></td>
	<td><?php echo $mesa->getCatedras()->getMateriasPlanes(); ?></td>
</tr>
<tr>
	<td width="15%"><b>Condición:</b></td>
	<td><?php echo $mesa->getCondicionesMesas(); ?></td>
</tr>
<tr>
	<td><b>Fecha:</b></td>
	<td>
		<input type="text" name="fecha" id="fecha" size="8">
	</td>
</tr>
<tr>
	<td><b>Hora:</b></td>
	<td>
		<input type="text" name="hora" id="hora" value="<?php echo $mesa->getHora(); ?>" size="6">
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Guardar" title="Guardar" id="botonGuardar"></td>
</tr>
</table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('mesasexamenes/buscar') ?>'"></p>
<br>