<script>
$(document).ready(function(){
	$('#botonCrear').attr('disabled',true);
	$('#mesas_examenes_hora').timepicker();
	cantidad = parseInt($('#mesas_examenes_idplanestudio').length);
	$('#mesas_examenes_idturno').append("<option value='0' selected='selected'>----Seleccione----</option>");
	if(cantidad==1) {
   	 	$('#mesas_examenes_idplanestudio').append("<option value='0' selected='selected'>----Seleccione----</option>");				
	}	
	habilitarForm(true);	

	<?php if ($idplanestudio) { ?>
	$.post("<?php echo url_for('planesestudios/obtenermaterias'); ?>",
		{ idplanestudio: <?php echo $idplanestudio ?> },
		function(data){
			$('#fechas_examenes_idmateriaplan').html(data);
		}
	);
	$.post("<?php echo url_for('mesasexamenes/obtenermesasvacias'); ?>",
		{ idplanestudio:<?php echo $idplanestudio; ?> },
		function(data){
			$('#mesasexamenes').html(data);
		}
	);	
	<?php } ?>
	$('#mesas_examenes_fecha').datepicker({
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

    $('#mesas_examenes_idplanestudio').change(function(){
        habilitarForm(false);
        $('#mesas_examenes_idllamado').attr('disabled',true);
    	$('#botonCrear').attr('disabled',false);
    	if($('#mesas_examenes_idplanestudio').val()!=0){
    		$.post("<?php echo url_for('mesasexamenes/permitemodalidadlibre'); ?>",
    			{ idplanestudio: $('#mesas_examenes_idplanestudio').val() },
    			function(data){
    				if(data){
        				if ($("#mesas_examenes_idcondicion option[value='2']").length == 0){      				         			
    						$("#mesas_examenes_idcondicion").append('<option value="2">Libre</option>');
        				}
        			}else{
    					$("#mesas_examenes_idcondicion option[value='2']").remove();				
        			}
    			}
    		);	
			        	
	        // cargar las materias de la carrera al combo
    	    $.post("<?php echo url_for('planesestudios/obtenermaterias'); ?>",
    	    	{ idplanestudio: $('#mesas_examenes_idplanestudio').val() },
    	    	function(data){
        	    	$('#mesas_examenes_idmateriaplan').html(data);
        	    }
        	);
    	    $.post("<?php echo url_for('planesestudios/obtenerturnosexamenes'); ?>",
				{ idplanestudio: $('#mesas_examenes_idplanestudio').val() },
				function(data){
					$('#mesas_examenes_idturno').html(data);
				}
			);
    	    $.post("<?php echo url_for('mesasexamenes/obtenermesasvacias'); ?>",
				{ idplanestudio: $('#mesas_examenes_idplanestudio').val() },
				function(data){
					$('#mesasexamenes').html(data);
				}
			);
        }else{
            habilitarForm(true);
            $('#mesasexamenes').html("");
        }
    });
    
    $('#mesas_examenes_idturno').change(function(){  
    	$('#mesas_examenes_idllamado').attr('disabled',false);
	    $.post("<?php echo url_for('planesestudios/obtenerllamadosexamenes'); ?>",
			{ idturno: $('#mesas_examenes_idturno').val() },
			function(data){
				$('#mesas_examenes_idllamado').html(data);
				
			  	if ($('#mesas_examenes_idllamado').val() != null) {
					$.post("<?php echo url_for('mesasexamenes/obtenerllamado'); ?>",
					   	{ idllamado: $('#mesas_examenes_idllamado option:first').val() },
					  	function(data){
					   		cantidad = parseInt($('#mesas_examenes_idllamado').length);
					   		if (cantidad > 0) {
					        	var obj = jQuery.parseJSON(data);
					       	    $('#llamados').html('Intervalo: '+obj.inicio+" hasta "+obj.fin);
					           	$( "#mesas_examenes_fecha" ).datepicker( "option", "minDate", obj.inicio );
					           	$( "#mesas_examenes_fecha" ).datepicker( "option", "maxDate", obj.fin );
				            	$( "#mesas_examenes_fechamin" ).val(obj.inicio);            	        	    
				            	$( "#mesas_examenes_fechamax" ).val(obj.fin);	
				            	$('#botonCrear').attr('disabled',false);
					   		}else{
						  		$('#mesas_examenes_idllamado').append("<option value='0' selected='selected'>----Seleccione----</option>");
						  		$('#llamados').html("");
						  		//$('#botonCrear').attr('disabled',true);
						  		$('#mesas_examenes_idllamado').attr('disabled',true);
							}
					   	}
				    );		    				
			  	} else {
			  		$('#mesas_examenes_idllamado').append("<option value='0' selected='selected'>----Seleccione----</option>");
			  		$('#llamados').html("");
			  		//$('#botonCrear').attr('disabled',true);
			  		$('#mesas_examenes_idllamado').attr('disabled',true);
				}
			 }
		);
    });      

    $('#mesas_examenes_idturno').focus(function(){  
    	$('#mesas_examenes_idllamado').attr('disabled',false);
	    $.post("<?php echo url_for('planesestudios/obtenerllamadosexamenes'); ?>",
			{ idturno: $('#mesas_examenes_idturno').val() },
			function(data){
				$('#mesas_examenes_idllamado').html(data);

			  	if ($('#mesas_examenes_idllamado').val() != null) {				
					$.post("<?php echo url_for('mesasexamenes/obtenerllamado'); ?>",
						   	{ idllamado: $('#mesas_examenes_idllamado option:first').val() },
						  	function(data){
						   		cantidad = parseInt($('#mesas_examenes_idllamado').length);
						   		if (cantidad > 0) {						  	
						        	var obj = jQuery.parseJSON(data);
						       	    $('#llamados').html('Intervalo: '+obj.inicio+" hasta "+obj.fin);
						           	$( "#mesas_examenes_fecha" ).datepicker( "option", "minDate", obj.inicio );
						           	$( "#mesas_examenes_fecha" ).datepicker( "option", "maxDate", obj.fin );
					            	$( "#mesas_examenes_fechamin" ).val(obj.inicio);            	        	    
					            	$( "#mesas_examenes_fechamax" ).val(obj.fin);	
						   		}else{
							  		$('#mesas_examenes_idllamado').append("<option value='0' selected='selected'>----Seleccione----</option>");
							  		$('#llamados').html("");
							  		//$('#botonCrear').attr('disabled',true);
							  		$('#mesas_examenes_idllamado').attr('disabled',true);
								}				            				           	        	    
						   	}
					    );		
			  	} else {
			  		$('#mesas_examenes_idllamado').append("<option value='0' selected='selected'>----Seleccione----</option>");
			  		$('#llamados').html("");
			  		//$('#botonCrear').attr('disabled',true);
			  		$('#mesas_examenes_idllamado').attr('disabled',true);
				}				    	
			}
		);
    }); 
     
    $('#mesas_examenes_idllamado').change(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenerllamado'); ?>",
    	    { idllamado:$('#mesas_examenes_idllamado').val() },
    	    function(data){
    	    	var obj = jQuery.parseJSON(data);
        	    $('#llamados').html('Intervalo: '+obj.inicio+" hasta "+obj.fin);
            	$( "#mesas_examenes_fecha" ).datepicker( "option", "minDate", obj.inicio );
            	$( "#mesas_examenes_fecha" ).datepicker( "option", "maxDate", obj.fin );
            	$( "#mesas_examenes_fechamin" ).val(obj.inicio);            	        	    
            	$( "#mesas_examenes_fechamax" ).val(obj.fin);
        	}
        );
    });   
    
    $('#botonCrear').click(function() {
    	var validado = validarFormFecha();
		//validado = true;
    	if(validado == true) {
            // guardar la informacion personal del aspirante ingresada
    	    $.post("<?php echo url_for('mesasexamenes/crear'); ?>", 
				$('#formCrear').serialize(),
    			function(data){
					alert(data);
				}				
			);
    	    $.post("<?php echo url_for('mesasexamenes/obtenermesasvacias'); ?>",
    			{ idplanestudio: $('#mesas_examenes_idplanestudio').val() },
    			function(data){
    				$('#mesasexamenes').html(data);
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
	
	if($('#mesas_examenes_hora_minute').val()=="") {
		resultado = "Debe seleccionar una hora.";
	}
	if($('#mesas_examenes_hora_hour').val()=="") {
		resultado = "Debe seleccionar una hora.";
	} 
	if ($('#mesas_examenes_idcondicion').val() !=5) {
		if (!regexpmesa.test($('#mesas_examenes_fecha').val())) {
			resultado = "Debe ingresar una fecha válida.";
		} else {
			var dini = GetDate($('#mesas_examenes_fechamin').val());
			var dfin = GetDate($('#mesas_examenes_fechamax').val());
			var d = GetDate($('#mesas_examenes_fecha').val());
	
			if ((d < dini) || (d > dfin)) {
			   resultado = "Debe ingresar una fecha dentro del llamado.";
			}		
		}
	}
	if($('#mesas_examenes_idllamado').attr('disabled')) {
		resultado = "Debe seleccionar un llamado.";
	} 
	return resultado;
} 

function GetDate(str){
    var arr = str.split("-");

    return new Date(parseInt(arr[2]), parseInt(arr[1]-1), parseInt(arr[0]));
}

function habilitarForm(estado)
{
	$('#mesas_examenes_idmateriaplan').attr('disabled',estado);
	$('#mesas_examenes_idcondicion').attr('disabled',estado);
	$('#mesas_examenes_idturno').attr('disabled',estado);
	$('#mesas_examenes_idllamado').attr('disabled',estado);
	$('#mesas_examenes_fecha').attr('disabled',estado);
	$('#mesas_examenes_hora_hour').attr('disabled',estado);
	$('#mesas_examenes_hora_minute').attr('disabled',estado);
}
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post" id="formCrear" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="submit" value="Crear" id="botonCrear" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="17%"><?php echo $form['idplanestudio']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idmateriaplan']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idmateriaplan']->renderError() ?>
          <?php echo $form['idmateriaplan'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idcondicion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idcondicion']->renderError() ?>
          <?php echo $form['idcondicion'] ?>
        </td>
      </tr>
      <tr>        
        <td><?php echo $form['idturno']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idturno']->renderError() ?>
          <?php echo $form['idturno'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idllamado']->renderLabel() ?></td>
        <td width="10%">
          <?php echo $form['idllamado']->renderError() ?>
          <?php echo $form['idllamado'] ?>
        </td>
        <td colspan="2"><div id="llamados"></div></td>       
      </tr>
      <tr>        
        <td><?php echo $form['fecha']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['hora']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['hora']->renderError() ?>
          <?php echo $form['hora'] ?>
        </td>
      </tr>   
    </tbody>      
  </table>
</form>
</div><br>
<div id="mesasexamenes" align="center"></div>
<br>
