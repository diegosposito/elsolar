<h1>Comisiones</h1>
<br>
<input type="button" value="Generar" onclick="location.href='<?php echo url_for('comisiones/generar') ?>'" <?php if ($cantidadComisiones > 0) { ?>disabled<?php } ?>>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('comisiones/new?idplanestudio='.$idplanestudio) ?>'" >
<br><br>
<table width="100%" class="stats" cellspacing="0">
<tr>
	<td width="28%"><b>Plan de estudio:</b></td>
	<td><?php echo $planestudio; ?></td>
</tr>
<tr>
	<td><b>Sede:</b></td>
	<td><?php echo $sede; ?></td>
</tr>
<tr>
	<td><b>Cantidad de catedras:</b></td>
	<td><?php echo $cantidadCatedras; ?></td></tr>
</tr>
<tr>
	<td><b>Cantidad de comisiones generadas:</b></td>
	<td><?php echo $cantidadComisiones; ?></td>
	
</tr>
<tr>
	<td colspan="2">
		<table width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
			  <td class="hed" align="center">Id</td>    
			  <td class="hed" align="center">Catedra</td>
			  <td class="hed" align="center">Nombre</td>
			  <td class="hed" align="center">Capacidad</td>
			  <td class="hed" align="center">Turno</td>
			  <td class="hed" align="center">Letras</td>
			  <td class="hed" align="center">Activo</td>
			  <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($pager->getResults()) > 0) { ?>  
		    <?php foreach ($pager->getResults() as $comision): ?>
		    <tr>
		      <td align="center"><?php echo $comision->getIdcomision() ?></td>
		      <td><?php echo $comision->getCatedras()->getMateriasPlanes()." (".$comision->getCatedras()->getMateriasPlanes()->getIdmateria().")"; ?></td>
		      <td width="15%"><?php echo $comision->getNombre() ?></td>
		      <td align="center"><?php echo $comision->getCapacidad() ?></td>
		      <td align="center"><?php echo $comision->getTurno() ?></td>
		      <td align="center"><?php echo $comision->getLetrainicio() ?>-<?php echo $comision->getLetrafin() ?></td>
			  <td align="center"><?php echo ($comision->getActivo() ? "Si" : "No"); ?></td>
			  <td align="center" width="19%">
			   	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('comisiones/edit?idcomision='.$comision->getIdcomision().'&idplanestudio='.$idplanestudio) ?>'">
			   	<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('comisiones/new?idcatedra='.$comision->getIdcatedra().'&idplanestudio='.$idplanestudio) ?>'">
			  </td>  
		    </tr>
		    <?php endforeach; ?>
				<?php } else { ?>
					<tr>
				      <td colspan="9" align="center">No existen comisiones.</td>
					</tr>	
				<?php } ?>  
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td colspan="9" class="hed">
					<?php if ($pager->haveToPaginate())  { ?>
						<div id="navv" align="center">
						<?php echo link_to('<<', 'comisiones/index?page='.$pager->getFirstPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ?>
						<?php echo link_to('<', 'comisiones/index?page='.$pager->getPreviousPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"' ) ?>
						<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
						<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'comisiones/index?page='.$page.'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ;?>
						<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
						<?php endforeach ?>
						<?php echo link_to('>', 'comisiones/index?page='.$pager->getNextPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ?>
						<?php echo link_to('>>', 'comisiones/index?page='.$pager->getLastPage().'&idplanestudio='.$idplanestudio.'&idsede='.$idsede,'class="pager"') ?>
						</div>
					<?php } ?>  		
		  		</td>
		  	</tr>
		  </tfoot>  
		</table>
	</td>
	</tr>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('comisiones/buscar') ?>'"></p>
<br>