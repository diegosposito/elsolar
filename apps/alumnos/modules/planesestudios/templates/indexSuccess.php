<script>
$(document).ready(function(){    
	$('.botonActivar').click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		if (confirm('Esta seguro que desea activar este Plan de estudios?')) {
			// Activa el plan de estudio
	    	$.post("<?php echo url_for('planesestudios/activar'); ?>",
	    	    	{ idplanestudio: Id },
	    	    	function(data){
	        	    	alert(data);
	        	    	$(location).attr('href',"<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera); ?>");	    	     	    	
	        	    }
			);
		}
		return false;
	});
	$('.botonCrearVersion').click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		if (confirm('Esta seguro que desea crear una nueva versión de este Plan de estudios?')) {
	    	// Activa el plan de estudio
	    	$.post("<?php echo url_for('planesestudios/crearversion'); ?>",
	    	    	{ idplanestudio: Id },
	    	    	function(data){
	    	    		var obj = jQuery.parseJSON(data);
	    	    		alert(data);
	    	    		$(location).attr('href',"<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera); ?>");	    	     	    	
	        	    }
			);
		}
		return false;
	});	

	$('.botonMigrarMaterias').click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
		if (confirm('Esta seguro que desea migrar las materias de este Plan de estudios?')) {
    		$(location).attr('href',"<?php echo url_for('materiasplanes/migrar?idplanestudio='); ?>"+Id);
		}
		return false;
	});		
	$('.botonSolicitarmodificacion').click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Activa el plan de estudio
    	$.post("<?php echo url_for('planesestudios/solicitarmodificacion'); ?>",
    	    	{ idplanestudio: Id },
    	    	function(data){
        	    	alert(data);
        	    	$(location).attr('href',"<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera); ?>");	    	     	    	
        	    }
		);
		return false;
	});
});
</script>
<h1>Planes de Estudios</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('planesestudios/new?idcarrera='.$idcarrera) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center" width="15%">Nombre</td>
      <td class="hed" align="center" width="10%">Duración</td>
      <td class="hed" align="center" width="10%">C.H.T.</td>
      <td class="hed" align="center" width="10%">Letra</td>
      <td class="hed" align="center" width="15%">Estado</td>
      <td class="hed" align="center" width="30%">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>
    <?php foreach ($pager->getResults() as $planes_estudios): ?>
    <tr>
      <td align="center"><?php echo $planes_estudios->getIdplanestudio() ?></td>
	  <td align="center"><?php echo $planes_estudios->getNombre() ?></td>
	  <td align="center"><?php echo $planes_estudios->getDuracionnumerica() ?></td>
      <td align="center"><?php echo $planes_estudios->getHorastotales() ?></td>
      <td align="center"><?php echo $planes_estudios->getLetra() ?></td>
      <td align="center"><?php echo $planes_estudios->getEstadosPlanes() ?></td>
      <td align="center">
	<?php if ($sf_user->getGuardUser()->getIsSuperAdmin()) { ?>
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('planesestudios/edit?idplanestudio='.$planes_estudios->getIdplanestudio()) ?>'">
		<input type="button" value="Ver títulos" onclick="location.href='<?php echo url_for('titulosplanes/index?idplanestudio='.$planes_estudios->getIdplanestudio()) ?>'">
      	<?php if ($planes_estudios->getIdestadoplan() == 1) { ?>
      	<input type="button" class="botonActivar" id="<?php echo $planes_estudios->getIdplanestudio() ?>" value="Activar">
      	<?php } ?>
      	<?php if (($planes_estudios->getIdestadoplan() == 1) or ($planes_estudios->getIdestadoplan() == 2)) { ?>
      	<input type="button" class="botonCrearVersion" id="<?php echo $planes_estudios->getIdplanestudio() ?>" value="Crear versión">
      	<?php } ?>
      	<?php if (($planes_estudios->getIdestadoplan() == 1) and ($planes_estudios->getIdplananterior() != 0)) { ?>
      	<input type="button" class="botonMigrarMaterias" id="<?php echo $planes_estudios->getIdplanestudio() ?>" value="Migrar asignaturas">
      	<?php } ?>
      	<input type="button" value="Cargar asignaturas" onclick="location.href='<?php echo url_for('planesestudios/cargarmaterias?idplanestudio='.$planes_estudios->getIdplanestudio()) ?>'" >
    <?php } ?>
	  </td>      	
    </tr>
    <?php endforeach; ?>
    <?php } else { ?>
    <tr>
      <td colspan="7" align="center">No existen planes de estudios.</td>
    </tr>    
    <?php } ?>
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="7" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'planesestudios/index?page='.$pager->getFirstPage().'&idcarrera='.$idcarrera,'class="pager"') ?>
				<?php echo link_to('<', 'planesestudios/index?page='.$pager->getPreviousPage().'&idcarrera='.$idcarrera,'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'planesestudios/index?page='.$page.'&idcarrera='.$idcarrera,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'planesestudios/index?page='.$pager->getNextPage().'&idcarrera='.$idcarrera,'class="pager"') ?>
				<?php echo link_to('>>', 'planesestudios/index?page='.$pager->getLastPage().'&idcarrera='.$idcarrera,'class="pager"') ?>
				</div>
			<?php } ?>	
  		</td>
  	</tr>
  </tfoot>
  </table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('carreras/index') ?>'"></p>
<br>
