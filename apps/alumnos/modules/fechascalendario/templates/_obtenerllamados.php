<script>
$(document).ready(function(){
   	$('.botonEliminar').click(function() {
   	   	var Id = $(this).attr("id");
	    $.post("<?php echo url_for('llamadosturno/delete'); ?>",
	   		{ idllamado: Id },
	   		function(data){
    	    	alert(data);
    	    	$(location).attr('href','<?php echo url_for('fechascalendario/edit?idfecha='.$idfecha); ?>');
			}
		);
   	});    	  	   	
   	$('.botonGenerar').click(function() {
   	   	var Id = $(this).attr("id");
	    $.post("<?php echo url_for('fechascalendario/generarmesas'); ?>",
	   		{ idllamado: Id },
	   		function(data){
    	    	alert(data);
    	    	$(location).attr('href','<?php echo url_for('fechascalendario/edit?idfecha='.$idfecha); ?>');
			}
		);
   	});
   	$('.botonEditarLLamado').click(function() {
   	   	var Id = $(this).attr("id");
	    $.post("<?php echo url_for('llamadosturno/edit'); ?>",
	   		{ idllamado: Id },
	   		function(data){
    	    	alert(data);
    	    	$(location).attr('href','<?php echo url_for('fechascalendario/edit?idfecha='.$idfecha); ?>');
			}
		);
   	});    	  	   	
});
</script>
<div align="center">
<table width="80%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center" width="55%">Descripción</td>
      <td class="hed" align="center" width="5%">Inicio</td>
      <td class="hed" align="center" width="5%">Fin</td>
      <td class="hed" align="center" width="30%"></td>
    </tr>
 	<?php if (count($llamados) > 0) { ?>    
    <?php foreach ($llamados as $llamado): ?>
    <tr>
      <td><?php echo $llamado->getIdllamado() ?></td>
      <td><?php echo $llamado->getDescripcion() ?></td>
      <td align="center"><?php echo $llamado->getInicio() ?></td>
      <td align="center"><?php echo $llamado->getFin() ?></td>
	  <td  align="center">
	    <?php echo button_to('Ver mesas', 'fechascalendario/vermesas?idllamado='.$llamado->getIdllamado(), array('popup' => array('popupWindow', 'width=400,height=400,left=320,top=0,scrollbars=yes'))) ?>
		<input type="button" class="botonEliminar" id="<?php echo $llamado->getIdllamado() ?>" value="Eliminar">
																																																																																																																																																																																																																																																																																																																																																																																																																																													
<?php /*
<input type="button" class="botonEditarLLamado" id="<?php echo $llamado->getIdllamado() ?>" value="Editar LLamado">
 */ ?>
	  </td>      
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen llamados.</td>
		</tr>	
	<?php } ?>    
</table>
<input type="button" value="Agregar Llamado" onclick="location.href='<?php echo url_for('llamadosturno/new?idfecha='.$idfecha) ?>'">
<br><br>
</div>
