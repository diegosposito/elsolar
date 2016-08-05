<script>
$(document).ready(function(){
	$('#botonBuscar').attr('disabled',true);
	$('#carrera').append("<option value='0' selected='selected' >----Seleccione----</option>");	
	$('#materia').attr('disabled',true);
    $('#carrera').change(function(){
    	$('#materia').attr('disabled',false);
    	if($('#carrera').val()!=0){
	        // cargar las materias de la carrera al combo
    	    $.post("<?php echo url_for('planesestudios/obtenermaterias'); ?>",{ idplanestudio:$(this).val() },function(data){$("#materia").html(data);})
        	$('#botonBuscar').attr('disabled',false);
    	}else{
        	$('#materia').attr('disabled',true);
        }
    });

    $('#formBuscar').submit(function() {
        // cargar los alumnos cursando a la materia
    	$.post("<?php echo url_for('ciclolectivo/obteneralumnos'); ?>",{ iddetalleplan:$('#materia').val(), tipo: 2 },function(data){$('#alumnos').html(data);});
    	return false;
   	});	 	
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="center">
<form action="" id="formBuscar">
  <table cellspacing="0" class="stats">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" value="Buscar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
</div><br>
<div id="alumnos" align="center"></div>