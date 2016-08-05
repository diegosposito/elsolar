<script>
$(document).ready(function(){
	$('#botonBuscar').attr('disabled',true);
	cantidadCarreras = parseInt($('#idplanestudio').length);
	if(cantidadCarreras==1) {
        // cargar las catedras del plan de plan y de la sede al combo
   	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
			{ idplanestudio:$('#idplanestudio').val(), idsede:$('#idsede').val() },
			function(data){
				if (data!=""){
					$('#idcatedra').html(data);
					cantidadCatedras = parseInt($('#idcatedra option').length);
					if(cantidadCatedras>=1){
						$('#idcatedra').attr('disabled',false);
						$('#idcatedra').html(data);
					}else{
						$('#idcatedra').attr('disabled',true);
						$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");						
					}
				}else{
					$('#idcatedra').attr('disabled',true);
					$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
				}
			}
		);		
   	 	$('#idcomision').attr('disabled',true);		
	} else {
		$('#idcatedra').attr('disabled',true);
		$('#idcomision').attr('disabled',true);
	}

    $('#idplanestudio').change(function(){
        cantidadCatedras=0;
    	$('#idcatedra').attr('disabled',false);
    	if($('#idplanestudio').val()!=0){
	        // cargar las materias de la carrera al combo
    	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
				{ idplanestudio:$('#idplanestudio').val(), idsede:$('#idsede').val() },
				function(data){
					if (data!=""){
						$('#idcatedra').html(data);
						cantidadCatedras = parseInt($('#idcatedra option').length);
						if(cantidadCatedras==1){
					   	 	$('#idcatedra').append("<option value='0' selected='selected'>----Seleccione----</option>");				
						}			
					}else{
						$('#idcatedra').attr('disabled',true);
						$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
						$('#idcomision').attr('disabled',true);
						$('#idcomision').html("<option value='0' selected='selected' >----NINGUNA----</option>");						
					}
					
				}
			);
        	$('#botonBuscar').attr('disabled',false);
    	}else{
        	$('#idcatedra').attr('disabled',true);
        	$('#idcomision').attr('disabled',true);
        }
    });
    $('#idcatedra').change(function(){    	
        // cargar las comisiones al combo
   	    $.post("<?php echo url_for('catedras/obtenercomisiones'); ?>",
			{ idcatedra:$('#idcatedra').val() },
			function(data){
				if (data!=""){
					$('#idcomision').html(data);
					cantidadComisiones = parseInt($('#idcomision').length);
					if(cantidadComisiones==0) {
						$('#idcomision').attr('disabled',true);
					} else {			
						$('#idcomision').attr('disabled',false);
						$('#botonBuscar').attr('disabled',false);
					}		
				}else{
					$('#idcomision').attr('disabled',true);
					$('#idcomision').html("<option value='0' selected='selected' >----NINGUNA----</option>");						
				}
			}
		);		
    });        
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('impresiones/'.$sf_request->getParameter('action')) ?>" method="post">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Buscar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>  
    <tbody>
	  <?php if ($mensaje) { ?>
	  <tr>
	  	<td colspan="2"><b><font color="red"><?php echo $mensaje; ?></font></b></td>
	  </tr>
  	  <?php } ?>    
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="10%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
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
        <td><b><?php echo $form['tipo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['tipo']->renderError() ?>
          <?php echo $form['tipo'] ?>
        </td>
      </tr>
    </tbody>  
  </table>
</form>
</div>
<br>