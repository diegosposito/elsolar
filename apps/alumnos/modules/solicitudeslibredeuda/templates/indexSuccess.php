<script> 
$(document).ready(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function() {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function() {
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });    
	
	$(".botonVerAbiertas").click(function(){  
    	// Ver solicitudes de libredeuda abiertas
    	$(location).attr('href',"<?php echo url_for('solicitudeslibredeuda/index?estado=1'); ?>");
		return false;
	});   

	$(".botonVerCerradas").click(function(){  
    	// Ver solicitudes de libredeuda cerradas
    	$(location).attr('href',"<?php echo url_for('solicitudeslibredeuda/index?estado=0'); ?>");
		return false;
	});   

	$(".botonCerrarMultiple").click(function(){
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('solicitudeslibredeuda/cerrarmultiple'); ?>",
    		$('#formSolicitudes').serialize(),
    	    function(data){
    			alert(data);
    			$(location).attr('href',"<?php echo url_for('solicitudeslibredeuda/index?estado=1'); ?>");	    	     	    	
        	}
		);
		return false;
	});		

	$(".botonCerrar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");	
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('solicitudeslibredeuda/cerrar'); ?>",
    	    { id: Id },
    	    function(data){
    	    	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('solicitudeslibredeuda/index?estado=1'); ?>");	    	     	    	
        	}
		);
		return false;
	});		 	
});
</script>
<h1>Solicitudes de libredeuda</h1>
<form id="formSolicitudes" action="">
<table width="100%" class="stats" cellspacing="0">
 	<thead>
	<tr>
	  <td colspan="8" align="center">
		<?php if (!$estado) { ?>
			<input type="submit" class="botonVerAbiertas" value="Ver Abiertas" title="Ver Abiertas"  >			
		<?php } else { ?>
			<input type="submit" class="botonCerrarMultiple" value="Cerrar" title="Cerrar" >			
			<input type="submit" class="botonVerCerradas" value="Ver Cerradas" title="Ver Cerradas"  >
		<?php } ?>
	  </td>
	</tr>	
    <tr>
      <td align="center" class="hed"><input type="checkbox" id="selectall" /></td>		    
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Origen</td>
      <td class="hed" align="center">Alumno</td>
      <td class="hed" align="center">Sede</td>
      <td class="hed" align="center">Estado</td>
      <td class="hed" align="center">Fecha</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
    </thead>
    <tbody>
	<?php foreach ($pager->getResults() as $solicitudes_libredeuda): ?>	     
    <tr>
      <td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $solicitudes_libredeuda->getId() ?>" /></td>
      <td align="center"><?php echo $solicitudes_libredeuda->getId() ?></td>
      <td><?php $oUsuarioOrigen = Doctrine_Core::getTable('sfGuardUser')->find($solicitudes_libredeuda->getIdusuarioorigen()); ?>
      <?php echo $oUsuarioOrigen->getUsername() ?></td>
      <td align="center"><?php echo $solicitudes_libredeuda->getAlumnos()->getPersonas() ?></td>
      <td align="center"><?php echo $solicitudes_libredeuda->getAlumnos()->getSedes() ?></td>
      <td align="center"><?php echo $solicitudes_libredeuda->getEstadosSolicitudes() ?></td>
      <td align="center"><?php echo $solicitudes_libredeuda->getCreatedAt() ?></td>
	  <td align="center">
		<?php if ($estado) { ?>
	  		<input type="button" value="Responder" onclick="location.href='<?php echo url_for('solicitudeslibredeuda/responder?id='.$solicitudes_libredeuda->getId()) ?>'">
      		<input type="submit" class="botonCerrar" id="<?php echo $solicitudes_libredeuda->getId(); ?>" value="Cerrar" title="Cerrar" >
      	<?php } ?>
	  </td>     
    </tr>
    <?php endforeach; ?>
 </tbody>    
 <tfoot>
	  	<tr>
	  		<td colspan="8" class="hed">
				<?php if ($pager->haveToPaginate()) { ?>
					<div id="navv" align="center">
					<?php echo link_to('<<', 'solicitudeslibredeuda/index?page='.$pager->getFirstPage(),'class="pager"') ?>
					<?php echo link_to('<', 'solicitudeslibredeuda/index?page='.$pager->getPreviousPage(),'class="pager"') ?>
					<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
					<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'solicitudeslibredeuda/index?page='.$page,'class="pager"') ;?>
					<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
					<?php endforeach ?>
					<?php echo link_to('>', 'solicitudeslibredeuda/index?page='.$pager->getNextPage(),'class="pager"') ?>
					<?php echo link_to('>>', 'solicitudeslibredeuda/index?page='.$pager->getLastPage(),'class="pager"') ?>
					</div>					
				<?php } ?>  		
	  		</td>
	  	</tr>
	</tfoot>	     
</table>
</form>