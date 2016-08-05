<script>
$(document).ready(function(){
    $('.botonEliminar').click(function() {
    	var Id = $(this).attr("id");
    	if(confirm("Are you sure?")) { 
	   	    $.post("<?php echo url_for('transicionesmaterias/eliminar'); ?>",
	   	    	{idtransicionmateria: Id},
	   			function(data){
	   	    		$(location).attr('href',"<?php echo url_for('transicionesmaterias/index?idtransicionplan='.$idtransicionplan); ?>");
	   			}
	   	   	);
    	}
		return false;
   	}); 
}); 
</script>
<h1>Matriz de Transicion</h1>
<br>
<input type="submit" value="Nuevo" onclick="location.href='<?php echo url_for('transicionesmaterias/new?idtransicionplan='.$idtransicionplan) ?>'">
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center" width="30%">Origen</td>
      <td class="hed" align="center" width="30%">Destino</td>
      <td class="hed" align="center" width="15%">Valor</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>
    <?php foreach ($pager->getResults() as $transiciones_materias): ?>
    <tr>
      <td align="center"><?php echo $transiciones_materias->getIdtransicionmateria() ?></td>
      <td><?php echo $transiciones_materias->getMateriaOrigen() ?></td>
      <td><?php echo $transiciones_materias->getMateriaDestino() ?></td>
      <td align="center"><?php echo $transiciones_materias->getValormateria() ?></td>
      <td align="center">
      	<input type="submit" class="botonEliminar" id="<?php echo $transiciones_materias->getIdtransicionmateria(); ?>"  value="Eliminar" />
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen materias.</td>
		</tr>	
	<?php } ?>      
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="5" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'transicionesmaterias/index?page='.$pager->getFirstPage().'&idtransicionplan='.$idtransicionplan,'class="pager"') ?>
				<?php echo link_to('<', 'transicionesmaterias/index?page='.$pager->getPreviousPage().'&idtransicionplan='.$idtransicionplan,'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'transicionesmaterias/index?page='.$page.'&idtransicionplan='.$idtransicionplan,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'transicionesmaterias/index?page='.$pager->getNextPage().'&idtransicionplan='.$idtransicionplan,'class="pager"') ?>
				<?php echo link_to('>>', 'transicionesmaterias/index?page='.$pager->getLastPage().'&idtransicionplan='.$idtransicionplan,'class="pager"') ?>
				</div>
			<?php } ?>	
  		</td>
  	</tr>
  </tfoot>  
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('transicionesplanes/index?idtransicionplan='.$idtransicionplan) ?>'"></p>
