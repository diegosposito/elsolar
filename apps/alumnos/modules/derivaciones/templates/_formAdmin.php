<script>
$(document).ready(function(){
    $('#botonGuardar').click(function() {
    	if(($('input[name=expedientes_derivaciones[aprobado]]:checked').val()==1) && ($('#expedientes_derivaciones_nrorecibo1').val()=="")){
        	alert ("Debe ingresar el Nro. recibo.");
		} else {
	       	$.post("<?php echo url_for('derivaciones/guardaradministracion'); ?>",
       			$('#formGuardar').serialize(),
       			function(data){
		    	   	alert(data);
		    	   	$(location).attr('href',"<?php echo url_for('derivaciones/index'); ?>");	    	     	    	
	       		}
	       	);	 
		}
   	});  	
}); 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
  
<form action="" method="post" id="formGuardar" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="button" value="Guardar" id="botonGuardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="20%"><b><?php echo $form['observaciones']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>    
      <tr>
        <td width="20%"><b><?php echo $form['aprobado']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['aprobado']->renderError() ?>
          <?php echo $form['aprobado'] ?>
        </td>
      </tr>  
      <tr>
        <td width="20%"><b><?php echo $form['tipopago']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['tipopago']->renderError() ?>
          <?php echo $form['tipopago'] ?>
        </td>
      </tr>      
      <tr>
        <td width="20%"><b><?php echo $form['nrorecibo1']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['nrorecibo1']->renderError() ?>
          <?php echo $form['nrorecibo1'] ?>
        </td>
      </tr>            
    </tbody>    
  </table>
</form>