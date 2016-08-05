<h1>Detalle de Notas</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('detallenota/new?idescalanota='.$idescalanota) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Descripcion</td>
      <td class="hed" align="center">Resultado</td>
      <td class="hed" align="center">Valor Inferior</td>
      <td class="hed" align="center">Valor Superior</td>
      <td class="hed" align="center">Activo</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>
    <?php foreach ($pager->getResults() as $detalle_nota): ?>  
    <tr>
      <td align="center"><?php echo $detalle_nota->getIddetallenota() ?></td>
      <td><?php echo $detalle_nota->getDescripcion() ?></td>
      <td><?php echo $detalle_nota->getResultado() ?></td>
      <td align="center"><?php echo $detalle_nota->getValorinferior() ?></td>
      <td align="center"><?php echo $detalle_nota->getValorsuperior() ?></td>
      <td align="center"><?php echo $detalle_nota->getActivo() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('detallenota/edit?iddetallenota='.$detalle_nota->getIddetallenota()) ?>'">      
      </td>
    </tr>
    <?php endforeach; ?>
    <?php } else { ?>
    <tr>
      <td colspan="7" align="center">No existen notas.</td>
    </tr>    
    <?php } ?>
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="7" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'detallenota/index?page='.$pager->getFirstPage().'&idescalanota='.$idescalanota,'class="pager"') ?>
				<?php echo link_to('<', 'detallenota/index?page='.$pager->getPreviousPage().'&idescalanota='.$idescalanota,'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'detallenota/index?page='.$page.'&idescalanota='.$idescalanota,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'detallenota/index?page='.$pager->getNextPage().'&idescalanota='.$idescalanota,'class="pager"') ?>
				<?php echo link_to('>>', 'detallenota/index?page='.$pager->getLastPage().'&idescalanota='.$idescalanota,'class="pager"') ?>
				</div>
			<?php } ?>	
  		</td>
  	</tr>
  </tfoot>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('escalasnotas/index') ?>'"></p>
<br>