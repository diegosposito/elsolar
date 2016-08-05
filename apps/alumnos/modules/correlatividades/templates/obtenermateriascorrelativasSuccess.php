<script>
$(document).ready(function(){
	<?php if($estado != 1){ ?>
	$('.botonEliminarCorrelativa').attr('disabled',true);
	<?php } ?>	
    $('.botonEliminarCorrelativa').click(function() {
    	var Id = $(this).attr("id");
    	if(confirm("Are you sure?")) { 
			// guardar la informacion de documentacion del aspirante ingresada
	   	    $.post("<?php echo url_for('correlatividades/eliminar'); ?>",
	   	    	{idcorrelativa: Id},
	   			function(data){
		   	     	$.post("<?php echo url_for('correlatividades/obtenermateriascorrelativas'); ?>",
		   	     		{ idplanestudio: <?php echo $idplanestudio; ?> },
		   	     		function(data){
		   	     			$('#materiasCorrelativas').html(data);
		   	     		}
		   	     	);   
	   			}
	   	   	);
    	}
		return false;
   	}); 
   	$('.botonPaginar').click(function() {
   	   	var Id = $(this).attr("id");
	    $.post("<?php echo url_for('correlatividades/obtenermateriascorrelativas'); ?>",
	   		{ idplanestudio: <?php echo $idplanestudio; ?> , page: Id },
	   		function(data){
	   			$('#materiasCorrelativas').html(data);
			}
		);
   	});    	  	   	
});
</script>
<table cellspacing="0" class="stats" width="100%">
	<thead>
		<tr>
			<td class="hed" align="center">Id</td>
			<td class="hed" align="center">Materia</td>
			<td class="hed" align="center">Situación</td>
			<td class="hed" align="center">Condición</td>
			<td class="hed" align="center">Correlativa</td>
			<td class="hed" width="5%" align="center">Acciones</td>
		</tr>
	</thead>
	<tbody>
	<?php if (count($pager->getResults() ) > 0) {?>
                <?php $i=0; ?>
		<?php foreach ($pager->getResults()  as $materia) { ?>
			<tr class="fila_<?php echo $i%2 ; ?>">
				<td align="center"><?php echo $materia->id ?></td>
				<td><?php echo $materia->nombre ?></td>
				<td align="center"><?php echo $materia->situacion ?></td>
				<td align="center"><?php echo $materia->condicion ?></td>
				<td><?php echo $materia->nombrec ?></td>
				<td align="center">
				<input type="submit" class="botonEliminarCorrelativa" id="<?php echo $materia->id; ?>"  value="Eliminar" />
				</td>
			</tr>
                    <?php $i++; ?>	        	
		<?php } ?>
	<?php } else { ?>
			<tr>
				<td colspan="6" align="center">No existen materias cargadas.</td>
			</tr>	   	
	<?php } ?>	        	
	</tbody>
	  <tfoot>
	  	<tr>
	  		<td colspan="6" class="hed">
				<?php if ($pager->haveToPaginate())  { ?>
					<div id="navv" align="center">
	 		 		<a class="botonPaginar" id="<?php echo $pager->getFirstPage(); ?>" href="javascript:void(0);"><<</a> 
			  		<a class="botonPaginar" id="<?php echo $pager->getPreviousPage(); ?>" href="javascript:void(0);"><</a> 
					<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
					<?php if ($page == $pager->getPage()){ ?>
						<?php echo $page; ?> 
					<?php } else { ?>
						<a class="botonPaginar" id="<?php echo $page; ?>" href="javascript:void(0);"><?php echo $page; ?></a>
					<?php } ?>
					<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
					<?php endforeach ?>
	 		 		<a class="botonPaginar" id="<?php echo $pager->getNextPage(); ?>" href="javascript:void(0);">></a> 
			  		<a class="botonPaginar" id="<?php echo $pager->getLastPage(); ?>" href="javascript:void(0);">>></a> 					
					</div>
				<?php } ?>  		
	  		</td>
	  	</tr>
	  </tfoot>			
</table>
