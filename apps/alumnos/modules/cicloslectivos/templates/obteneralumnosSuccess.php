<script>
$(document).ready(function(){
	$('#fechacierre').datepicker({
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
	$('#fechacierre').datepicker( "setDate", new Date());
		
	$('#fechavencimiento').datepicker({
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
	$('#fechavencimiento').datepicker("setDate", new Date());  
		
	<?php if($tipo==3) { ?>
	$('#fechavencimiento').datepicker('disable'); 
	$('#idestadomateria').attr('disabled',true);	
    // Cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('catedras/obtenermesasexamenespromocion'); ?>",
		{ idcatedra: <?php echo $comision->getIdcatedra(); ?> },
		function(data){
			if (data!=""){
				$('#idmesaexamen').html(data);
				$('#idmesaexamen').attr('disabled',false);
				$('#botonCerrar').attr('disabled',false);
			}else{
				$('#idmesaexamen').attr('disabled',true);
				$('#idmesaexamen').html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
	<?php } else { ?>
	$('#idmesaexamen').attr('disabled',true);
	$('#idmesaexamen').html("<option value='0' selected='selected' >----NINGUNA----</option>");
	<?php } ?>

    $('#idmesaexamen').change(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenercupo'); ?>",
    	    { idmesaexamen:$('#idmesaexamen').val() },
    	    function(data){
        	    $('#mesaexamen').html(data);
        	}
        );
    });   

    $('#idmesaexamen').focus(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenercupo'); ?>",
    	    { idmesaexamen:$('#idmesaexamen').val() },
    	    function(data){
        	    $('#mesaexamen').html(data);
        	}
        );
    });   
    	
	$("#botonCerrar").click(function(){
		var validado = validarFormulario();
		if(validado == true) {
			// Cierra el ciclo lectivo con el estado seleccionado	
	    	$.post("<?php echo url_for('cicloslectivos/cerrar'); ?>",
	   			$("#formCerrar").serialize(),
				function(data) {
	     			alert(data);
	     			$("#formBuscar").submit();   		
		   		}       			 	
			);
		} else {
			alert(validado);
		}						
		return false;
	});		

	$(".botonSolicitar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('alumnos/solicitarlibredeuda'); ?>",
    			{ id: <?php echo $materiaplan->getIdmateriaplan(); ?>, idalumno: Id, tipo: 3 },
    	    function(data){
        	   	alert(data);   	     	    	
        	}
		);
		return false;
	});	

    // add multiple select / deselect functionality
    $("#selectall").click(function () {
        if ($(this).attr('checked')==true) {
			//$('.case').attr('checked', this.checked);
			$(".case").each(function(){
				if ($(this).attr('disabled')==true) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked", "cehcked");
				}
			});  
        }else{
        	$('.case').attr('checked', this.checked);
		}	                 
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    }); 	
});

$(function() {
	$("#fechacierre").validator({
		format: 'date',
		invalidEmpty: true
	});	
	$("#fechavencimiento").validator({
		format: 'date',
		invalidEmpty: true
	});		
});

function validarFormulario(){
	var resultado = true;

	if($("#idestadomateria").val()==3) { 
		var arr = $("#fechacierre").val().split('-');
		var begDT = new Date (arr[2], arr[1] - 1, arr[0]);
		var arr = $("#fechavencimiento").val().split('-');		
		var endDT = new Date (arr[2], arr[1] - 1, arr[0]);
		if (begDT >= endDT) {	
			resultado = "Cuando se selecciona el estado Regular, la fecha de vencimiento deber ser mayor que la fecha de cierre.";			 
		}
	} 

	if(($("#idestadomateria").val()==2)||($("#idestadomateria").val()==4)) {
		if($("#fechavencimiento").val() != $("#fechacierre").val()) {
			resultado = "Cuando se selecciona el estado Libre o Baja, la fecha de cierre y vencimiento deben ser iguales.";
		} 
	}
	
	if(!$('input:checkbox:checked').val()) {
		resultado = "Debe seleccionar al menos un alumno.";
	} 

	if(!$("#fechavencimiento").validator('validate')) {
		resultado = "Debe ingresar una fecha de vencimiento.";
	} 
	
	if(!$("#fechacierre").validator('validate')) {
		resultado = "Debe ingresar una fecha de cierre.";
	}   
    <?php if($tipo==3) { ?>
	if($('#idmesaexamen').is('[disabled]')) {
		resultado = "Debe disponer de una mesa de examen de tipo Promocion.";
	}             
    <?php } ?>
	return resultado;
} 
</script>
<br>
<form action="" id="formCerrar" >
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <?php if ($mensaje) { ?>
  <tr>
    <td colspan="2"><?php echo $mensaje; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2" class="hed">Materia: <?php echo $materiaplan; ?></td>
  </tr>
  <tr>
    <td colspan="2"><b>Comisión: <?php echo $comision; ?></b></td>
  </tr>
  <tr>
    <td>

    <table width="100%" cellspacing="0" class="stats">
      <tr>
        <td width="20%" ><?php echo $form['fechacierre']->renderLabel() ?></td>
        <td colspan="2">
          <?php echo $form['fechacierre']->renderError() ?>
          <?php echo $form['fechacierre'] ?>
        </td>
      </tr>
      <tr>
        <td width="20%"><?php echo $form['fechavencimiento']->renderLabel() ?></td>
        <td colspan="2">
          <?php echo $form['fechavencimiento']->renderError() ?>
          <?php echo $form['fechavencimiento'] ?>
        </td>
      </tr>		
      <tr>
        <td width="20%"><?php echo $form['idestadomateria']->renderLabel() ?></td>
        <td colspan="2">
          <?php echo $form['idestadomateria']->renderError() ?>
          <?php echo $form['idestadomateria'] ?>
        </td>
      </tr>		
      <?php if($tipo==3) { ?>
      <tr>
        <td width="20%"><?php echo $form['idmesaexamen']->renderLabel() ?></td>
        <td width="20%">
          <?php echo $form['idmesaexamen']->renderError() ?>
          <?php echo $form['idmesaexamen'] ?>  
        </td>
        <td>
			<div id="mesaexamen"></div>  
        </td>        
      </tr>	            
      <?php } ?>
	  <tr>
	      <td colspan="3" align="center">
	        <input type="hidden" value="<?php echo $tipo; ?>" name="tipo" id="tipo">
	        <input type="hidden" value="<?php echo $materiaplan->getIdmateriaplan(); ?>" name="idmateriaplan" id="idmateriaplan">
	        <input type="hidden" value="<?php echo $comision->getIdcomision(); ?>" name="idcomision" id="idcomision">
	        <input type="submit" id="botonCerrar" value="Cerrar" />
	      </td>
	  </tr>   
   </table>
   </td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Seleccione los alumnos a los cuales va a aplicar el cierre de ciclo lectivo:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td align="center" class="hed" width="3%"><input type="checkbox" id="selectall" /></td>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="5%">Legajo</td>
		  	  <td class="hed" align="center">Alumno</td>    
		      <td class="hed" align="center" width="25%">Nro. de Documento</td>
		      <td class="hed" align="center" width="10%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($alumnos) > 0){ ?>
            <?php $i=0; ?>
		    <?php foreach ($alumnos as $alumno) { 
		  		$fechalibredeuda = $administracion->obtenerlibredeudaalumno($alumno->getIdalumno(), $alumno->getPersonas()->getNrodoc()); 
		  		
		
				if(($fechalibredeuda >= date('Y-m-d')) && !(is_array($fechalibredeuda))) {
					$estadolibredeuda = true; 
				} else {
					$estadolibredeuda = false;
				}
				if($materiaplan->getIdplanestudio()==168) {
					$estadolibredeuda = true; 
				};
		    ?>
		    <tr class="fila_<?php echo $i%2 ; ?>">
		      <td align="center">
				<?php if(($estadolibredeuda==true) or ($tipo!=3)){ ?>
					<input type="checkbox" class="case" name="alumno[<?php echo $alumno->getIdalumno(); ?>]" value="<?php echo $alumno->getIdalumno(); ?>" <?php if ($observaciones[$alumno->getIdalumno()] !="") echo "DISABLED";?>>
				<?php } else { ?>
					<input type="checkbox" class="case" name="alumno[<?php echo $alumno->getIdalumno(); ?>]" value="<?php echo $alumno->getIdalumno(); ?>" DISABLED >
				<?php }  ?>
		      </td>				
		      <td align="center"><?php echo $alumno->getIdalumno(); ?></td>
		      <td align="center"><?php echo $alumno->getLegajo(); ?></td>
		      <td><?php echo $alumno->getPersonas(); ?></td>
		      <td align="center"><?php echo $alumno->getPersonas()->getNrodoc(); ?></td>
		      <td align="center">
				<?php if(($estadolibredeuda==false) and ($tipo==3)){ ?>
					<input type="submit" class="botonSolicitar" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" id="<?php echo $alumno->getIdalumno(); ?>" >
				<?php }  ?>
		      </td>	
		    </tr>
            <?php $i++; ?>	
		    <?php } ?>
		    <?php } else { ?>
		    <tr>
		      <td colspan="6" align="center">No existen alumnos cursando que puedan promocionar la materia.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>
</table>
</div>
</form>
