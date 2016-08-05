<h1>Títulos</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('titulos/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Título</td>
      <td class="hed" align="center">Nivel</td>
      <td class="hed" align="center">Tipo</td>
      <td class="hed" align="center">Fecha</td>
      <td class="hed" align="center">Nro.</td>
      <td class="hed" align="center">Duración</td>
      <td class="hed" align="center">Estado</td>
      <td class="hed" align="center"></td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>  
    <?php foreach ($pager->getResults() as $titulos): ?>
    <tr>
      <td><?php echo $titulos->getIdtitulo() ?></td>
      <td><?php echo $titulos->getNombre() ?></td>
      <td><?php echo $titulos->getTiposTitulos() ?></td>
      <td><?php echo (($titulos->getNiveltitulo() == 1) ? 'Final': 'Intermedio'); ?></td>
      <td><?php echo $titulos->getFechacreacion() ?></td>
      <td><?php echo $titulos->getNroresolucion() ?></td>
      <td><?php echo $titulos->getDuracion() ?></td>
      <td><?php echo $titulos->getIdestadotitulo() ?></td>
      <td>
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('titulos/edit?idtitulo='.$titulos->getIdtitulo()) ?>'">
	  </td>       
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="11" align="center">No existen títulos.</td>
		</tr>	
	<?php } ?>      
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="11" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'titulos/index?page='.$pager->getFirstPage(),'class="pager"') ?>
				<?php echo link_to('<', 'titulos/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'titulos/index?page='.$page,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'titulos/index?page='.$pager->getNextPage(),'class="pager"') ?>
				<?php echo link_to('>>', 'titulos/index?page='.$pager->getLastPage(),'class="pager"') ?>
				</div>
			<?php } ?>
  		</td>
  	</tr>
  </tfoot>
  </table>
  <br>