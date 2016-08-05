<script>
$(document).ready(function(){
	$('#botonCrear').attr('disabled',true);
	$('#mesas_examenes_hora').timepicker();
	cantidad = parseInt($('#mesas_examenes_idplanestudio').length);
	$('#mesas_examenes_idturno').append("<option value='0' selected='selected'>----Seleccione----</option>");

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

	$.post("<?php echo url_for('mesasexamenes/obteneralumnosencondiciones'); ?>",
		{ idmateriaplan: <?php echo $materiaplan->getIdmateriaplan(); ?> },
		function(data){
			$('#alumnos').html(data);
		}
	);	
	
	$.post("<?php echo url_for('planesestudios/obtenerturnosexamenes'); ?>",
		{ idplanestudio: <?php echo $materiaplan->getIdplanestudio(); ?> },
		function(data){
			$('#mesas_examenes_idturno').html(data);
		}
	);
	
    $('#mesas_examenes_idturno').change(function(){  
    	$('#mesas_examenes_idllamado').attr('disabled',false);
	    $.post("<?php echo url_for('planesestudios/obtenerllamadosexamenes'); ?>",{ idturno:$('#mesas_examenes_idturno').val() },function(data){$('#mesas_examenes_idllamado').html(data);});
	    $.post("<?php echo url_for('mesasexamenes/obtenerllamado'); ?>",
	    	{ idllamado:$('#mesas_examenes_idllamado').val() },
	    	function(data){
    	    	var obj = jQuery.parseJSON(data);
        	    $('#llamados').html('Intervalo: '+obj.inicio+" hasta "+obj.fin);
            	$( "#mesas_examenes_fecha" ).datepicker( "option", "minDate", obj.inicio );
            	$( "#mesas_examenes_fecha" ).datepicker( "option", "maxDate", obj.fin );        	    
	    	}
    	);
    });
          
    $('#mesas_examenes_idturno').focus(function(){  
    	$('#mesas_examenes_idllamado').attr('disabled',false);
	    $.post("<?php echo url_for('planesestudios/obtenerllamadosexamenes'); ?>",{ idturno:$('#mesas_examenes_idturno').val() },function(data){$('#mesas_examenes_idllamado').html(data);});
    });  
    
    $('#mesas_examenes_idllamado').change(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenerllamado'); ?>",
    	    { idllamado:$('#mesas_examenes_idllamado').val() },
    	    function(data){
    	    	var obj = jQuery.parseJSON(data);
        	    $('#llamados').html('Intervalo: '+obj.inicio+" hasta "+obj.fin);
            	$( "#mesas_examenes_fecha" ).datepicker( "option", "minDate", obj.inicio );
            	$( "#mesas_examenes_fecha" ).datepicker( "option", "maxDate", obj.fin ); 
            	$('#botonCrear').attr('disabled',false);       	    
        	}
        );
    });   

    $('#mesas_examenes_idllamado').focus(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenerllamado'); ?>",
			{ idllamado:$('#mesas_examenes_idllamado').val() },
			function(data){
				var obj = jQuery.parseJSON(data);
				$('#llamados').html('Intervalo: '+obj.inicio+" hasta "+obj.fin);
                $( "#mesas_examenes_fecha" ).datepicker( "option", "minDate", obj.inicio );
                $( "#mesas_examenes_fecha" ).datepicker( "option", "maxDate", obj.fin ); 
                $('#botonCrear').attr('disabled',false);       	    
			}
		);
     });     
    
    $('#botonCrear').click(function() {
    	var validado = validarFormFecha();
		//validado = true;
    	if(validado == true) {
    		var arrMesaExamen = {}; 
    	    arrMesaExamen.idmateriaplan = $('#mesas_examenes_idmateriaplan').val();
    	    arrMesaExamen.idsede = $('#mesas_examenes_idsede').val();
    	    arrMesaExamen.idcondicion = $('#mesas_examenes_idcondicion').val();
    	    arrMesaExamen.idturno = $('#mesas_examenes_idturno').val();
    	    arrMesaExamen.idllamado = $('#mesas_examenes_idllamado').val();
    	    arrMesaExamen.fecha = $('#mesas_examenes_fecha').val();
    	    arrMesaExamen.hora = $('#mesas_examenes_hora').val();

    	    var arrAlumnos = $('#tablaAlumnos tbody tr').map(function() {
				// $(this) is used more than once; cache it for performance.
				var $row = $(this);
    			 
				// For each row that's "mapped", return an object that
				//  describes the first and second <td> in the row.
				return {
					id: $row.find(':nth-child(1)').text(),
					notaescrita: $row.find(':nth-child(4)').text(),
					notaoral: $row.find(':nth-child(5)').text(),
					promedio: $row.find(':nth-child(6)').text()
				};
			}).get();
			   		        	
            // guardar la informacion personal del aspirante ingresada
    	    $.post("<?php echo url_for('mesasexamenes/creargenerica'); ?>", 
				{ mesasexamenes: arrMesaExamen , alumnos: arrAlumnos},
    			function(data){
					alert(data);
					$(location).attr('href',"<?php echo url_for('mesasexamenes/buscargenerica') ?>");
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
		resultado = "Debe seleccionar una Hora.";
	}
	if($('#mesas_examenes_hora_hour').val()=="") {
		resultado = "Debe seleccionar una Hora.";
	} 
	if (!regexpmesa.test($('#mesas_examenes_fecha').val())) {
		resultado = "Debe ingresar una Fecha válida.";
	}	
	if(($('#mesas_examenes_idllamado').attr('disabled')) || ($('#mesas_examenes_idllamado').val() ==0)) {
		resultado = "Debe seleccionar un Llamado.";
	} 
	return resultado;
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
        <td width="10%"><b>Materia:</b></td>
        <td colspan="3"><b><?php echo $materiaplan ?></b>
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
        </td colspan="2">
        <td><div id="llamados"></div></td>       
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
<div id="alumnos" align="center"></div>
<br>