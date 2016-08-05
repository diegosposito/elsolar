<h1>Cargar Asignaturas de un Plan de Estudios</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('materiasplanes/new?idplanestudio='.$idplanestudio) ?>'">
<br><br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
	<tr>
		<td colspan="3"><b>Carga Horaria (<?php echo $planestudio->horastotales; ?>):</b> <?php echo $cargahorariatotal; ?> hs. cargadas</td>
	</tr>
	<tr>
		<td><b>Obligatorias (<?php echo $planestudio->cantidadcomunes; ?>):</b> <?php echo $cantobl; ?></td>
		<td><b>Preuniversitarias (<?php echo $planestudio->cantidadpreuniversitarias; ?>):</b> <?php echo $cantpre; ?></td>
		<td><b>Optativas (<?php echo $planestudio->cantidadoptativas; ?>):</b> <?php echo $cantopt; ?></td>
	</tr>
	<tr>
		<td><b>Extracurriculares (<?php echo $planestudio->cantidadextracurriculares; ?>):</b> <?php echo $cantext; ?></td>
		<td><b>Tesinas (<?php echo $planestudio->cantidadtesinas; ?>):</b> <?php echo $canttes; ?></td>
		<td><b>Trabajos finales (<?php echo $planestudio->cantidadtpfinal; ?>):</b> <?php echo $canttp; ?></td>
	</tr>	
	<tr>
	<td colspan="3">
		<table  width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		       <td class="hed" align="center">Id</td>
		       <td class="hed" align="center">Asignatura</td>
		       <td class="hed" align="center">Tipo</td>
		       <td class="hed" align="center">Carga horaria total</td>
		       <td class="hed" align="center">Carga horaria semanal</td>
		       <td class="hed" align="center">Orden</td>
		       <td class="hed" align="center">Año</td>
		       <td class="hed" align="center">Periodo</td>
		       <td class="hed" align="center">Tipo de cursada</td>       
		       <td class="hed" align="center">Codigo</td>
		       <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($pager->getResults()) > 0) { ?>
		    <?php foreach ($pager->getResults() as $materias_planes): ?>
		    <tr>
		      <td align="center"><?php echo $materias_planes->getIdmateriaplan() ?></td>
		      <td><?php echo $materias_planes->getMaterias() ?></td>
		      <td align="center"><?php echo $materias_planes->getTiposMaterias() ?></td>
			  <td align="center"><?php echo $materias_planes->getCargahorariatotal() ?></td>      
			  <td align="center"><?php echo $materias_planes->getCargahorariasemanal() ?></td>
		      <td align="center"><?php echo $materias_planes->getOrden() ?></td>
		      <td align="center"><?php echo $materias_planes->getAnodecursada() ?></td>
		      <td align="center"><?php echo $materias_planes->getPeriododecursada() ?></td>
		      <td><?php echo $materias_planes->getTiposCursadas() ?></td>
		      <td><?php echo $materias_planes->getCodmat() ?></td>
		      <td>
		      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('materiasplanes/edit?idmateriaplan='.$materias_planes->getIdmateriaplan()) ?>'">
			  </td>      	
		    </tr>
		    <?php endforeach; ?>
			<?php } else { ?>
				<tr>
			      <td colspan="11" align="center">No existen asignaturas designadas a este plan de estudios.</td>
				</tr>	
			<?php } ?>      
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td colspan="11" class="hed">
					<?php if ($pager->haveToPaginate())  { ?>
						<div id="navv" align="center">
						<?php echo link_to('<<', 'materiasplanes/index?page='.$pager->getFirstPage().'&idplanestudio='.$idplanestudio,'class="pager"') ?>
						<?php echo link_to('<', 'materiasplanes/index?page='.$pager->getPreviousPage().'&idplanestudio='.$idplanestudio,'class="pager"' ) ?>
						<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
						<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'materiasplanes/index?page='.$page.'&idplanestudio='.$idplanestudio,'class="pager"') ;?>
						<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
						<?php endforeach ?>
						<?php echo link_to('>', 'materiasplanes/index?page='.$pager->getNextPage().'&idplanestudio='.$idplanestudio,'class="pager"') ?>
						<?php echo link_to('>>', 'materiasplanes/index?page='.$pager->getLastPage().'&idplanestudio='.$idplanestudio,'class="pager"') ?>
						</div>
					<?php } ?>
		  		</td>
		  	</tr>
		  </tfoot>  
		</table>
	</td>
	</tr>
</table>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera) ?>'"></p>
<br>
