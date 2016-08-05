<script>
$(document).ready(function(){
	$('#botonBuscar').click(function() {
        // cargar los alumnos cursando a la materia
    	$.post("<?php echo url_for('libredeuda/obtenerpersonas'); ?>",{ apellido:$('#apellido').val(), dni: $('#dni').val() },function(data){$('#personas').html(data);});
    	return false;
   	});	 	    
});
</script>
<div align="center">
  <table class="stats" cellspacing="0" width="50%">
    <tr>
        <td colspan="2" align="center">
			 <form action="" id="formBuscar">
			 <table class="stats" cellspacing="0" width="50%">
			    <tfoot>
			      <tr>
			        <td colspan="2" align="center">
			          <input style="width:120px" type="submit" value="Buscar" id="botonBuscar" />
			        </td>
			      </tr>
			    </tfoot>
			    <tbody>
			      <?php echo $form ?>
			    </tbody> 
			  </table>
			</form>  
        </td>
    </tr>    
    <tr>
        <td colspan="2" align="center">
        	<form action="<?php echo url_for('libredeuda/verhistorico') ?>" method="post">
          		<input type="submit" value="Ver Historico" />
			</form>          		
        </td>
    </tr>    
  </table>

</div>
<br />
<div id="personas" align="center"></div>