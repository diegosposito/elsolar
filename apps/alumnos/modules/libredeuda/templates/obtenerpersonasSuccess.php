<script>
$(document).ready(function(){
	$('.botonVerEstado').click(function() {
		var Id = $(this).attr("id");
        // cargar el estado de la persona seleccionada
    	$.post("<?php echo url_for('libredeuda/verestado'); ?>",{ idpersona: Id, nombre: $('#nombre_'+Id).val() },function(data){$('#personas').html(data);});
    	return false;
   	});	 	    
});
</script>

<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Persona</td>
      <td class="hed" align="center">Nro. de Documento</td>
      <td class="hed" align="center">Carrera</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
   <?php 
   foreach($personas as $persona){
   	  ?>
   	  <tr>
      <td><?php echo $persona['nombre'] ?></td>
      <td align="center"><?php echo $persona['ndni'] ?></td>
      <td><?php echo $persona['descripcion'] ?></td>
      <td align="center">
	      <form action="" id="formVerEstado"> 
			<input type="hidden" id="nombrepersona_<?php echo $persona['nombre']; ?>" value="<?php echo $persona['nombre']; ?>"> 
			<input type="hidden" id="idcp_<?php echo $persona['idcp']; ?>" value="<?php echo $persona['idcp']; ?>"> 
			<input type="hidden" id="nombre_<?php echo $persona['id']; ?>" value="<?php echo $persona['nombre']; ?>">
			<input type="submit" class="botonVerEstado" id="<?php echo $persona['idcp']; ?>"  value="Ver Estado" />
		  </form>
      </td>
      </tr> 
  <?php } ?>
</table>
<br>
