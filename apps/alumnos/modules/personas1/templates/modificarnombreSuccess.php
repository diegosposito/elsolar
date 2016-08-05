<script>
$(document).ready(function(){
    $('#botonGuardar').click(function(){
    	$('#botonGuardar').attr("disabled", "disabled");
        // Guarda la modificacion de nombre del alumno
        if(validarForm()){  
	    	$.post("<?php echo url_for('personas/guardarnombre'); ?>",
	    	    $('#formGuardar').serialize() ,
	    	    function(data){
	    	    	alert(data);
	    	    	$(location).attr('href','<?php echo url_for('personas/buscarpersonas'); ?>');
	        	}
	        );
	    	return false;
        }
   	});		
});

function validarForm(){
    // Campos de texto
    if($("#nombre").val() == ""){
        alert("El campo Nombre no puede estar vacío.");
        $("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#apellido").val() == ""){
        alert("El campo Apellido no puede estar vacío.");
        $("#apellido").focus();
        return false;
    }
 
    return true; // Si todo está correcto
}
</script>
<h1>Modificar de Datos Personales</h1>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="center">
	<form action="" id="formGuardar" method="post">
	  <table cellspacing="0" class="stats" width="35%">
	    <tfoot>
	      <tr>
	        <td colspan="2" align="center">
				<?php echo $form['idpersona']->render() ?>
	          <input type="submit" value="Guardar" id="botonGuardar" />
	        </td>
	      </tr>
	    </tfoot>
	    <tbody>    
	      <tr>
	        <td><b><?php echo $form['nombre']->renderLabel() ?></b></td>
	        <td>
	        	<?php echo $form['nombre']->render() ?>
	        </td>
	      </tr>	      
	      <tr>
	        <td width="10%"><b><?php echo $form['apellido']->renderLabel() ?></b></td>
	        <td >
	        	<?php echo $form['apellido']->render() ?>
	        </td>
	       </tr>
	    </tbody>
	  </table>	
	</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('personas/buscarpersonas') ?>'"></p>
<br>