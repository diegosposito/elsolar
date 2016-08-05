<script>
$(document).ready(function(){
	$('#botonBuscar').attr('disabled',true);
	cantidad = parseInt($('#idplanestudio').length);
	if(cantidad==1) {
        // cargar las catedras del plan de plan y de la sede al combo
   	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
			{ idplanestudio:$('#idplanestudio').val(), idsede:$('#idsede').val() },
			function(data){
				$('#idcatedra').html(data);
			}
		);
   	 	$('#idcomision').attr('disabled',true);				
	} else {
		$('#idcatedra').attr('disabled',true);
		$('#idcomision').attr('disabled',true);
	}

    $('#idplanestudio').change(function(){    	
    	$('#idcatedra').attr('disabled',false);
        // cargar las catedras del plan de plan y de la sede al combo
   	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
			{ idplanestudio:$('#idplanestudio').val(), idsede:$('#idsede').val() },
			function(data){
				$('#idcatedra').html(data);
				cantidad = parseInt($('#idcatedra').length);
				if(cantidad==1) {
					// cargar las comisiones al combo
			   	    $.post("<?php echo url_for('catedras/obtenercomisiones'); ?>",
			   	    	{ idcatedra:$('#idcatedra').val() },
						function(data){
			   	    		$('#idcomision').html(data);
			   	    		$('#idcomision').attr('disabled',false);
			   	    		$('#botonBuscar').attr('disabled',false);
						}
					);
				}
			}
		);		
    });       

    $('#idcatedra').change(function(){    	
        // cargar las comisiones al combo
   	    $.post("<?php echo url_for('catedras/obtenercomisiones'); ?>",
			{ idcatedra:$('#idcatedra').val() },
			function(data){
				$('#idcomision').html(data);
				cantidad = parseInt($("#idcomision").length);
				if(cantidad==0) {
					$('#idcomision').attr('disabled',true);
				} else {
					$('#idcomision').attr('disabled',false);
					$('#botonBuscar').attr('disabled',false);
				}
			}
		);		
    });    
});
</script>

<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('asignacionesclases/index'); ?>" method="post" >
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
      <tr>
        <td width="20%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
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
        <td><b><?php echo $form['idcomision']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcomision']->renderError() ?>
          <?php echo $form['idcomision'] ?>
        </td>
      </tr>       
      <tr>
        <td><b><?php echo $form['idciclolectivo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idciclolectivo']->renderError() ?>
          <?php echo $form['idciclolectivo'] ?>
        </td>
      </tr>                    
    </tbody>
  </table>
</form>
</div><br>