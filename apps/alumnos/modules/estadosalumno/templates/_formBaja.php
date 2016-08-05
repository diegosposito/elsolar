<script>
$(document).ready(function(){
	cant = <?php echo count($materiasinscriptas); ?>;

	$("#estados_alumno_historial_fecha").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot(); ?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});

	$('#botonImprimir').attr('disabled', 'disabled');
	$('#estados_alumno_historial_tiposolicitud').val('S');
	if(cant == 0){
		$('#estados_alumno_historial_tipobaja option[value="P"]').remove();
	}
	$('#selectall').attr('checked', 'checked');
	$('.case').attr('checked', 'checked');
    // Agrega multiple select / deselect funcionalidad
    $('#selectall').click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // Si todas son seleccionadas
    $('.case').click(function(){
        if($('.case').length == $('.case:checked').length) {
            $('#selectall').attr('checked', 'checked');
        } else {
            $('#selectall').removeAttr('checked');
            $('#estados_alumno_historial_tipobaja').val('P');
        }
    }); 

	$('#estados_alumno_historial_tiposolicitud').change(function() {
		if($('#estados_alumno_historial_tiposolicitud').val()=='O') {
			$('#estados_alumno_historial_tipobaja option[value="P"]').remove();
			$('#selectall').attr('checked', 'checked');
			$('.case').attr('checked', 'checked');
		} else {
			if (cant >0 ) {
				$('#estados_alumno_historial_tipobaja').append('<option value="P">Parcial</option>');
			}
		}
	});  

	$('#estados_alumno_historial_tipobaja').change(function() {
		if($('#estados_alumno_historial_tipobaja').val()=='T') {
			$('#selectall').attr('checked', 'checked');
			$('.case').attr('checked', 'checked');
		} else {
			$('#selectall').removeAttr('checked');
		}
	});  

	$("#estados_alumno_historial_fechabaja").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot(); ?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	
    $('#botonGuardar').click(function(){
    	$('#botonGuardar').attr('disabled', 'disabled');
    	var validado = validarFormBaja();
    	if(validado == true) {        
	        // Guarda la baja del alumno
    		$.post("<?php echo url_for('estadosalumno/guardaryenviarbaja'); ?>",
        		    $('#formGuardar').serialize(),
            	    function(data){
			    		if (data != "0") {
			    			$(location).attr('href','<?php echo url_for('estadosalumno/verbaja?idbaja='); ?>'+data);
		    	   		}else {        	   		
		            		alert("No se ha podido enviar la Solicitud de baja.\nCompruebe que las cuenta de correo remitente o destinataria funcionen correctamente.");
		            		$('#botonGuardar').removeAttr('disabled');
		            	}
            		}    	
            	);
    	}else {
			alert(validado);
			$('#botonGuardar').removeAttr('disabled');
        }
    	//window.setTimeout( function(){ $('#botonGuardar').removeAttr("disabled") }, 5000 );
    	return false;
   	});	  	
});

function validarFormBaja(){
	var regexpemail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	var regexfecha = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
	var resultado = true;

	if ($('#estados_alumno_historial_email').val()!='') {
		if (!regexpemail.test($('#estados_alumno_historial_email').val())) {
			resultado = "Debe ingresar una E-mail válido.";
		}	
	}
	if ($('#estados_alumno_historial_tipobaja').val()=='P') {
		if($(".case:checked").length < 1) {
			resultado = "Debe seleccionar al menos una materia.";
		}
	}


    var fecha = $("#estados_alumno_historial_fechabaja").val();
    
    if (fecha == null || fecha == "" || !regexfecha.test(fecha)) {
    	resultado = "Debe ingresar una Fecha de baja válida.";
    }

	return resultado;
} 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div align="center">
<form action="" id="formGuardar" method="post">
<table cellspacing="0" class="stats" width="100%">
  <tr>
	<td width="20%"><b><?php echo $form['fecha']->renderLabel() ?></b></td>
	<td width="20%"><b></b>
		<?php echo $form['fecha']->renderError() ?>
		<?php echo $form['fecha'] ?>
	</td>
	<td width="23%"><b>Fecha de registro:</b> <?php echo date('d-m-Y') ?></td> 	
	<td><b>Fecha de libre deuda:</b> <font <?php echo ($fechalibredeuda > date('Y-m-d') ? 'color="green"' : 'color="red"') ?>>
	<?php     	
		$arr = explode('-', $fechalibredeuda);
    	$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
    	echo $fecha; 
    ?></font></td>	
  </tr> 
  <tr>
    <td><b>Alumno:</b></td>
    <td colspan="3"><?php echo $alumno->getPersonas(); ?>(<?php echo $alumno->getIdalumno(); ?>)</td>
  </tr>
  <tr>
    <td><b>Nro. documento:</b></td>
    <td colspan="3"><?php echo $alumno->getPersonas()->getTiposDocumentos().": ".$alumno->getPersonas()->getNrodoc(); ?></td>
  </tr>  
  <tr>
    <td><b>Plan de estudios:</b></td>
    <td colspan="3"><?php echo $alumno->getPlanesEstudios(); ?></td>
  </tr>  
  <tr>
	<td><b><?php echo $form['tiposolicitud']->renderLabel() ?></b></td>
  	<td>
		<?php echo $form['tiposolicitud']->renderError() ?>
		<?php echo $form['tiposolicitud'] ?>
	</td>	  
	<td><b><?php echo $form['tipobaja']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['tipobaja']->renderError() ?>
		<?php echo $form['tipobaja'] ?>
	</td>
  </tr>  
  <tr>	
	<td><b><?php echo $form['fechabaja']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['fechabaja']->renderError() ?>
		<?php echo $form['fechabaja'] ?>
	</td>
	<td colspan="2"><b>Ultima fecha de actividad academica registrada:</b> <font color="green"><?php echo $ultimafecha; ?></font></td>
  </tr>  
  <tr>
	<td><b><?php echo $form['idmotivo']->renderLabel() ?></b></td>
	<td colspan="3">
		<?php echo $form['idmotivo']->renderError() ?>
		<?php echo $form['idmotivo'] ?>
	</td>
  </tr>
  <tr>
	<td><b><?php echo $form['otromotivo']->renderLabel() ?></b></td>
	<td colspan="3">
		<?php echo $form['otromotivo']->renderError() ?>
		<?php echo $form['otromotivo'] ?>
	</td>
  </tr>
  <tr>	
	<td><b><?php echo $form['nrotelefonofijo']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['areatelefonofijo'] ?> - <?php echo $form['nrotelefonofijo'] ?>
	</td>
	<td width="20%"><b><?php echo $form['nrotelefonomovil']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['areatelefonomovil'] ?> -	<?php echo $form['nrotelefonomovil'] ?>		
	</td>
  </tr>
  <tr>
	<td><b><?php echo $form['email']->renderLabel() ?></b></td>
	<td colspan="5">
		<?php echo $form['email']->renderError() ?>
		<?php echo $form['email'] ?>
	</td>
  </tr>        
  <tr>
    <td  colspan="4" class="hed">Materias cursantes:</td>
  </tr>
  <tr>
    <td colspan="4" align="center">
		<table width="100%" cellspacing="0" class="stats">
			<tr>
				<td align="center" colspan="6">
					<?php echo $form->renderHiddenFields(false) ?>
					<input type="submit" id="botonGuardar" class="botonGuardar" value="Guardar" >
				</td>
			</tr>
		    <tr>
      		  <td align="center" width="8%" class="hed"><input type="checkbox" id="selectall" /></td>		    
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="80%">Materia</td>
		      <td class="hed" align="center" width="7%">Curso</td>
		    </tr>
		    <?php if (count($materiasinscriptas) > 0) { ?>
		    <?php foreach ($materiasinscriptas as $materia_plan): ?>
		    <tr class="fila_">
		      <td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $materia_plan->getIdcomision() ?>" /></td>
		      <td align="center"><?php echo $materia_plan->getCatedras()->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia_plan->getCatedras()->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia_plan->getCatedras()->getMateriasPlanes()->getAnodecursada(); ?></td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else { ?>
		     <tr>
		      <td align="center" colspan="4">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		</table>
    </td>
  </tr>
</table>
</form>
</div>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('estadosalumno/index?idcarrera='.$alumno->getIdplanestudio().'&idalumno='.$alumno->getIdalumno()) ?>'"></p>
<br>