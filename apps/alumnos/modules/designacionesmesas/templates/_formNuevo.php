<script>
$(document).ready(function(){
	$('#botonBuscar').attr('disabled',true);
	// Controla la cantidad de carreras
	cantidad = parseInt($('#designaciones_mesas_idcarrera').length);
	if(cantidad==1) {
        // Cargar las catedras de la carrera al combo
		cargarComboCatedras('#designaciones_mesas_idcatedra', $('#designaciones_mesas_idcarrera').val(), 0);
	} else {
		$('#designaciones_mesas_idcatedra').attr('disabled',true);
		$('#designaciones_mesas_idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
	}
	habilitarForm(true);
	
    $('#designaciones_mesas_idcarrera').change(function(){    
    	// Cargar las catedras de la carrera al combo
		cargarComboCatedras('#designaciones_mesas_idcatedra', $('#designaciones_mesas_idcarrera').val(), 0);
    });       

    $('#designaciones_mesas_idcatedra').change(function(){    	
    	// Cargar las catedras de la carrera al combo
		cargarComboMesasExamenes('#designaciones_mesas_idmesaexamen', $('#designaciones_mesas_idcatedra').val(), 0);
    	habilitarForm($('#designaciones_mesas_idmesaexamen').val()!=0);
    }); 

    $('#designaciones_mesas_idtipodesignacionmesa').change(function(){    	
   		$('#designaciones').html("");
    });
          
    $('#formBuscar').submit(function() {
        // Cargar las designaciones para dicha mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/obtenerdesignaciones'); ?>",
    	    { idmesaexamen: $('#designaciones_mesas_idmesaexamen').val(), idtipodesignacionmesa: $('#designaciones_mesas_idtipodesignacionmesa').val() },
    	    function(data){
        	    $('#designaciones').html(data);
        	}
        );
    	return false;
   	});
});

function habilitarForm(estado) {
	$('#botonBuscar').attr('disabled',estado);
	$('#designaciones_mesas_idmesaexamen').attr('disabled',estado);
	$('#designaciones_mesas_idtipodesignacionmesa').attr('disabled',estado);
}

//Cargar combo de catedras
function cargarComboCatedras(combo, id, idseleccionado) {
    // Cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
		{ idplanestudio: id },
		function(data){
			if (data!=""){
				$(combo).html(data);
				$(combo).attr('disabled',false);
				$(combo).val(idseleccionado);    
				cargarComboMesasExamenes('#designaciones_mesas_idmesaexamen', $(combo).val(), 0);
			}else{
				$(combo).attr('disabled',true);
				$(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
				$('#designaciones_mesas_idmesaexamen').attr('disabled',true);
				$('#designaciones_mesas_idmesaexamen').html("<option value='0' selected='selected' >----NINGUNA----</option>");				
			}
		}
	);
} 

//Cargar combo de mesas de examenes
function cargarComboMesasExamenes(combo, id, idseleccionado) {
    // Cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('catedras/obtenermesasexamenes'); ?>",
		{ idcatedra: id },
		function(data){
			if (data!=""){
				$(combo).html(data);
				$(combo).attr('disabled',false);
				$(combo).val(idseleccionado);	    	    	
				$('#designaciones_mesas_idtipodesignacionmesa').attr('disabled',false);
				$('#botonBuscar').attr('disabled',false);
			}else{
				$(combo).attr('disabled',true);
				$(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
} 
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" id="formBuscar" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Buscar" id="botonBuscar"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="20%"><b><?php echo $form['idcarrera']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcarrera']->renderError() ?>
          <?php echo $form['idcarrera'] ?>
        </td>
      </tr>               
      <tr>
        <td><b><?php echo $form['idcatedra']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcatedra']->renderError() ?>
          <?php echo $form['idcatedra'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['idmesaexamen']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idmesaexamen']->renderError() ?>
          <?php echo $form['idmesaexamen'] ?>
        </td>
      </tr>       
      <tr>
        <td><b><?php echo $form['idtipodesignacionmesa']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idtipodesignacionmesa']->renderError() ?>
          <?php echo $form['idtipodesignacionmesa'] ?>
        </td>
      </tr>                    
    </tbody>
  </table>
</form>
</div><br>
<div id="designaciones" align="center"></div>