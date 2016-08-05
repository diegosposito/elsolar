<script>
$(document).ready(function(){
	$('#botonBuscar').attr('disabled',true);
	cantidad = parseInt($('#idplanestudio').length);
	if(cantidad==1) {
        // cargar las catedras del plan de plan y de la sede al combo
   	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
			{ idplanestudio:$('#idplanestudio').val(), idsede:$('#idsede').val() },
			function(data){
				if (data!=""){
					$('#idcatedra').attr('disabled',false);
					$('#idcatedra').html(data);
				}else{
					$('#idcatedra').attr('disabled',true);
					$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
				}
			}
		);		
   	 	$('#idcomision').attr('disabled',true);	
	} else {
		//$('#idcatedra').attr('disabled',true);
		$('#idcomision').attr('disabled',true);
	}
	
    $('#idplanestudio').change(function(){
    	$('#alumnos').html("");
    	$('#idcatedra').attr('disabled',false);
	$('#idcatedra').attr('visible',false);
    	if($('#idplanestudio').val()!=0){
	        // cargar las materias de la carrera al combo
    	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
				{ idplanestudio: $(this).val(), idsede:$('#idsede').val() },
				function(data){
					if (data!=""){
						$('#idcatedra').attr('disabled',false);
						$('#idcatedra').attr('visible',false);
						$('#idcatedra').html(data);
					}else{
						$('#idcatedra').attr('disabled',true);
						$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
					}
				}
			);
        	$('#botonBuscar').attr('disabled',false);
    	}else{
        	$('#idcatedra').attr('disabled',true);
        	$('#idcomision').attr('disabled',true);
        }
    });
/*
    $('#idcatedra').change(function(){  
    	$('#alumnos').html("");  	
        // cargar las comisiones al combo
   	    $.post("<?php echo url_for('catedras/obtenercomisiones'); ?>",
			{ idcatedra:$('#idcatedra').val() },
			function(data){
				$('#idcomision').html(data);
				cantidad = parseInt($('#idcomision').length);
				if(cantidad==0) {
					$('#idcomision').attr('disabled',true);
				} else {		
					//$('#idcomision').attr('disabled',false);
					$('#botonBuscar').attr('disabled',false);
				}
			}
		);		
    });     
    */
    $('#idcatedra').change(function(){  
    	$('#alumnos').html("");  	
        // cargar las comisiones al combo
   	    $.post("<?php echo url_for('catedras/obtenerllamados'); ?>",
			{ idcatedra:$('#idcatedra').val() },
			function(data){
				$('#idllamado').html(data);
				cantidad = parseInt($('#idllamado').length);
				if(cantidad==0) {
					$('#idllamado').attr('disabled',true);
				} else {		
					$('#botonBuscar').attr('disabled',false);
				}
			}
		);	
   	    $.post("<?php echo url_for('catedras/obtenercomisiones'); ?>",
			{ idcatedra:$('#idcatedra').val() },
			function(data){
				$('#idcomision').html(data);
				cantidad = parseInt($('#idcomision').length);
				if(cantidad==0) {
					$('#idcomision').attr('disabled',true);
				} else {		
					//$('#idcomision').attr('disabled',false);
					
					$('#botonBuscar').attr('disabled',false);
				}
			}
		);	
    });   
    $('#formBuscar').submit(function() {
        // cargar los alumnos cursando a la materia
    	$.post("<?php echo url_for('autogestion/obteneralumnos'); ?>",
			{ idcomision: $('#idcomision').val(),  idcatedra: $('#idcatedra').val(),idllamado: $('#idllamado').val(), tipo: $('#tipo').val() },
			function(data){
				$('#alumnos').html(data);
			}
		);
    	return false;
   	});	 	
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="center">
<form action="" id="formBuscar">
  <table cellspacing="0" width="100%" class="stats">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Buscar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>   
      <tr>
        <td width="15%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
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
        <td width="10%"><b><?php echo $form['idcomision']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcomision']->renderError() ?>
          <?php echo $form['idcomision'] ?>
        </td>
      </tr> 
      <tr>        
        <td width="10%"><b><?php echo $form['idllamado']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idllamado']->renderError() ?>
          <?php echo $form['idllamado'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
</div><br>
<div id="alumnos" align="center"></div>
