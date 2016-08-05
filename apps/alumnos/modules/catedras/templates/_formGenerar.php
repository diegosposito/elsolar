<script>
$(document).ready(function(){
	$('#botonGenerar').click(function(){
		var validado = validarFormGenerar();

		if(validado == true) {
			// Desactivar el boton por unos segundos
			$('#botonGenerar').attr("disabled","disabled");			
			// Crea las comisiones
	    	$.post("<?php echo url_for('comisiones/crear'); ?>",
	    		$('#formGenerar').serialize(),
	    	   	function(data){
	        	   	alert(data);
	        	   	$(location).attr('href',"<?php echo url_for('comisiones/index'); ?>?idplanestudio="+$('#idplanestudio').val()+"&idsede="+$('#idsede').val());	    	     	    	
	        	}
			);
		} else {
			alert(validado);
		}	
				
		return false;
	});    
});

function validarFormGenerar(){
	var resultado = true;
	parseInt("10")
	if(!Number($("#capacidad").val()) > 0) {
		resultado = "La capacidad debe ser un numero.";
	} 
	
	if(!Number($("#cantidad").val()) > 0) {
		resultado = "La cantidad debe ser un numero.";
	} 
			
	return resultado;
} 
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" id="formGenerar" method="post">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
        	<?php echo $form->renderHiddenFields(false) ?>
        	<input type="button" id="botonGenerar" value="Generar" />
        </td>
      </tr>
    </tfoot>
    <tbody>  
      <tr>
        <td><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>
      <tr>
        <td width="23%"><b><?php echo $form['cantidad']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['cantidad']->renderError() ?>
          <?php echo $form['cantidad'] ?>
        </td>
      </tr>   
      <tr>
        <td><b><?php echo $form['capacidad']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['capacidad']->renderError() ?>
          <?php echo $form['capacidad'] ?>
        </td>
      </tr>   
      <tr>
        <td><b><?php echo $form['turno']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['turno']->renderError() ?>
          <?php echo $form['turno'] ?>
        </td>
      </tr>   
      <tr>
        <td><b><?php echo $form['inscripcionhabilitada']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['inscripcionhabilitada']->renderError() ?>
          <?php echo $form['inscripcionhabilitada'] ?>
        </td>
      </tr>   	                             
    </tbody>
  </table>
</form>
</div><br>