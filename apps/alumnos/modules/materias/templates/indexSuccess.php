<h1>Materias</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('materias/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Nombre</td>
      <td class="hed" align="center">Nombre reducido</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>
    <?php foreach ($pager->getResults() as $materias): ?>
    <tr>
      <td><?php echo $materias->getIdmateria() ?></td>
      <td><?php echo $materias->getNombre() ?></td>
      <td><?php echo $materias->getNombrereducido() ?></td>
      <td>
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('materias/edit?idmateria='.$materias->getIdmateria()) ?>'">
	  </td>           
    </tr>
    <?php endforeach; ?>
    <?php } else { ?>
    <tr>
      <td colspan="4" align="center">No existen materias.</td>
    </tr>    
    <?php } ?>    
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="4" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'materias/index?page='.$pager->getFirstPage(),'class="pager"') ?>
				<?php echo link_to('<', 'materias/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'materias/index?page='.$page,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'materias/index?page='.$pager->getNextPage(),'class="pager"') ?>
				<?php echo link_to('>>', 'materias/index?page='.$pager->getLastPage(),'class="pager"') ?>
				</div>
			<?php } ?>	
  		</td>
  	</tr>
  </tfoot>  
</table>
<br>