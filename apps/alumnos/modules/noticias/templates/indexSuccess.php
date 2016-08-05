<script> 
$(document).ready(function(){
	$(".botonNueva").click(function(){   
		var Id = $(this).attr("id");	
    	// Nueva la noticia
    	$(location).attr('href',"<?php echo url_for('noticias/nueva'); ?>");	    	
		return false;
	});
	
	$(".botonVerActivas").click(function(){  
    	// Activar la noticia
    	$(location).attr('href',"<?php echo url_for('noticias/lista?activo=1'); ?>");
		return false;
	});   

	$(".botonVerDesactivas").click(function(){  
    	// Activar la noticia
    	$(location).attr('href',"<?php echo url_for('noticias/lista?activo=0'); ?>");
		return false;
	});   
			
	$(".botonEditar").click(function(){   
		var Id = $(this).attr("id");	
    	// Editar la noticia
    	$(location).attr('href',"<?php echo url_for('noticias/editar?idnoticia='); ?>"+Id);	    	
		return false;
	});
	
	$(".botonVer").click(function(){   
		var Id = $(this).attr("id");	
    	// Editar la noticia
    	$(location).attr('href',"<?php echo url_for('noticias/ver?idnoticia='); ?>"+Id);	    	
		return false;
	});
		 	
	$(".botonActivar").click(function(){   
		var Id = $(this).attr("id");	
    	// Activar la noticia
    	$.post("<?php echo url_for('noticias/activar'); ?>",
    			{ idnoticia: Id, activo: 1 },
    	    	function(data){
        	    	$("#formGestionarNoticia").submit(); 
        	    	alert(data);
        	    }
		);		
		return false;
	});   
	  
	$(".botonDesactivar").click(function(){   
		var Id = $(this).attr("id");	
    	// Desactivar la noticia
    	$.post("<?php echo url_for('noticias/activar'); ?>",
    			{ idnoticia: Id, activo: 0 },
    	    	function(data){
        	    	$("#formGestionarNoticia").submit(); 
        	    	alert(data);
        	    }
		);		
		return false;
	});   	 	
});
</script>
<h1>Noticias</h1>

<table cellspacing="0" class="stats" width="100%">
	<tr>
	  <td colspan="7" align="center">
		<form id="formNuevaNoticia" action="">
			<input type="hidden" name="activo" value="<?php echo $activo; ?>">
			<input type="submit" class="botonNueva" value="Nueva" title="Nueva" >
			<input type="submit" class="botonVerActivas" value="Ver Activas" title="Ver Activas"  >			
			<input type="submit" class="botonVerDesactivas" value="Ver No activas" title="Ver No activas"  >
		</form>
	  </td>
	</tr>
    <tr>
      <td class="hed" align="center" width="5%">Id</th>
      <td class="hed" align="left" width="40%">Título</th>
      <td class="hed" align="center" width="10%">Inicio</th>
      <td class="hed" align="center" width="10%">Fin</th>
      <td class="hed" align="center" width="5%">Activo</th>
      <td class="hed" align="center" width="5%">Orden</th>
      <td class="hed" align="center" width="20%"></td>
    </tr>
    <?php foreach ($noticiass as $noticias): ?>
    <tr>
      <td align="center"><?php echo $noticias['id']; ?></td>
      <td><?php echo $noticias['titulo']; ?></td>
      <td align="center"><?php echo $noticias['inicio']; ?></td>
      <td align="center"><?php echo $noticias['fin']; ?></td>
      <td align="center"><?php echo ($noticias['is_active']) ? "Si" : "No"; ?></td>
      <td align="center"><?php echo $noticias['orden']; ?></td>
      <td>
		<form id="formGestionarNoticia" action="">  
			<input type="hidden" name="idnoticia" value="<?php echo $noticias['id']; ?>">
   			<input class="botonEditar" id="<?php echo $noticias['id']; ?>" type="submit" value="Editar">	
   			<input class="botonVer" id="<?php echo $noticias['id']; ?>" type="submit" value="Ver">	   					
			<?php if($noticias['is_active'] == 1){ ?>
			<input class="botonDesactivar" id="<?php echo $noticias['id']; ?>" type="submit" value="Desactivar">
			<?php }else{?>
			<input class="botonActivar" id="<?php echo $noticias['id']; ?>" type="submit" value="Activar">
			<?php } ?>
		</form>		
	  </td>
    </tr>
    <?php endforeach; ?>
</table>
