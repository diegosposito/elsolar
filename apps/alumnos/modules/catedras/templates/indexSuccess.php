<script>
$(document).ready(function(){	 
	$('.botonActivar').click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		if (confirm('Esta seguro que desea activar esta catedra?')) {
			// Activa el plan de estudio
	    	$.post("<?php echo url_for('catedras/activar'); ?>",
	    	    { idcatedra: Id },
	    	    function(data){
	        	   	alert(data);
	        	   	$(location).attr('href',"<?php echo url_for('catedras/index?idplanestudio='.$idplanestudio.'&idsede='.$idsede); ?>");	    	     	    	
	        	}
			);
		}
		return false;
	});

	$('.botonDesactivar').click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		if (confirm('Esta seguro que desea desactivar esta catedra?')) {
			// Activa el plan de estudio
	    	$.post("<?php echo url_for('catedras/activar'); ?>",
	    	    { idcatedra: Id },
	    	    function(data){
	        	   	alert(data);
	        	   	$(location).attr('href',"<?php echo url_for('catedras/index?idplanestudio='.$idplanestudio.'&idsede='.$idsede); ?>");	    	     	    	
	        	}
			);
		}
		return false;
	});	
		
	$("#botonGenerar").click(function(){   
    	// Generar catedras
    	$.post("<?php echo url_for('catedras/generar'); ?>",
    		$("#formGenerar").serialize(), 
    		function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('catedras/index?idplanestudio='.$idplanestudio.'&idsede='.$idsede) ?>"); 
        	}
		);
		return false;
	});  	   	  	    	
});
</script>
<h1>Catedras</h1>
<br>
<form action="" id="formGenerar" >
<input type="hidden" value="<?php echo $idplanestudio; ?>" name="idplanestudio" />
<input type="hidden" value="<?php echo $idsede; ?>" name="idsede" />
<input id="botonGenerar" type="submit" value="Generar">
</form>
<br>
<table width="100%" class="stats" cellspacing="0">
<tr>
	<td width="27%"><b>Plan de estudio:</b></td>
	<td><?php echo $planestudio; ?></td>
</tr>
<tr>
	<td><b>Sede:</b></td>
	<td><?php echo $sede; ?></td>
</tr>
<tr>
	<td><b>Cantidad de materias:</b></td>
	<td><?php echo $cantidadMaterias; ?></td></tr>
</tr>
<tr>
	<td><b>Cantidad de catedras generadas:</b></td>
	<td><?php echo $cantidadCatedras; ?></td>
	
</tr>
<tr>
	<td colspan="4">
		<table width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
			  <td width="5%" class="hed" align="center">Id</td>    
			  <td class="hed" align="center">Nombre</td>
			  <td class="hed" align="center">Activo</td>
			  <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($pager->getResults()) > 0) { ?>  
		    <?php foreach ($pager->getResults() as $catedra): ?>
		    <tr>
		      <td align="center"><?php echo $catedra->getIdcatedra() ?></td>
		      <td><?php echo $catedra->getMateriasPlanes() ?></td>
			  <td align="center"><?php echo ($catedra->getActiva() ? "Si" : "No"); ?></td>
		      <td align="center">
		      	<?php if ($catedra->getActiva() == 1) { ?>
		      	<input type="button" class="botonDesactivar" id="<?php echo $catedra->getIdcatedra() ?>" value="Desactivar">
		      	<?php } else { ?>
		      	<input type="button" class="botonActivar" id="<?php echo $catedra->getIdcatedra() ?>" value="Activar">
		      	<?php } ?>		      
			  </td>   			  
		    </tr>
		    <?php endforeach; ?>
				<?php } else { ?>
					<tr>
				      <td colspan="4" align="center">No existen catedras.</td>
					</tr>	
				<?php } ?>  
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td colspan="4" class="hed">
					<?php if ($pager->haveToPaginate())  { ?>
						<div id="navv" align="center">
						<?php echo link_to('<<', 'catedras/index?page='.$pager->getFirstPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ?>
						<?php echo link_to('<', 'catedras/index?page='.$pager->getPreviousPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"' ) ?>
						<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
						<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'catedras/index?page='.$page.'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ;?>
						<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
						<?php endforeach ?>
						<?php echo link_to('>', 'catedras/index?page='.$pager->getNextPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ?>
						<?php echo link_to('>>', 'catedras/index?page='.$pager->getLastPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ?>
						</div>
					<?php } ?>  		
		  		</td>
		  	</tr>
		  </tfoot>  
		</table>
	</td>
	</tr>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('catedras/buscar') ?>'"></p>
<br>
