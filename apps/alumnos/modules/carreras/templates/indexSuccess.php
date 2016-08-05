<h1>Carreras</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('carreras/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Nombre</td>
      <td class="hed" align="center">Termino</td>
      <td class="hed" align="center">Nro. Res.</td>
      <td class="hed" align="center">Nro. Exp.</td>
      <td class="hed" align="center">Estado</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>
    <?php foreach ($pager->getResults() as $carreras): ?>
    <tr>
      <td align="center"><?php echo $carreras->getIdcarrera() ?></td>
      <td><?php echo $carreras->getNombre() ?></td>
      <td align="center"><?php echo $carreras->getTermino() ?></td>
      <td align="center"><?php echo $carreras->getNroresolucion() ?></td>
      <td align="center"><?php echo $carreras->getNroexpediente() ?></td>
      <td align="center"><?php echo $carreras->getEstadosCarreras() ?></td>
	  <td align="center">
	<?php if ($sf_user->getGuardUser()->getIsSuperAdmin()) { ?>
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('carreras/edit?idcarrera='.$carreras->getIdcarrera()) ?>'">
		<input type="button" value="Ver planes" onclick="location.href='<?php echo url_for('planesestudios/index?idcarrera='.$carreras->getIdcarrera()) ?>'">	
		<input type="button" value="Ver sedes" onclick="location.href='<?php echo url_for('carrerassede/index?idcarrera='.$carreras->getIdcarrera()) ?>'">
	<?php } ?>  
	  </td>          
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen carreras.</td>
		</tr>	
	<?php } ?>      
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="7" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'carreras/index?page='.$pager->getFirstPage(),'class="pager"') ?>
				<?php echo link_to('<', 'carreras/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'carreras/index?page='.$page,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'carreras/index?page='.$pager->getNextPage(),'class="pager"') ?>
				<?php echo link_to('>>', 'carreras/index?page='.$pager->getLastPage(),'class="pager"') ?>
				</div>
			<?php } ?>  		
  		</td>
  	</tr>
  </tfoot>
  </table>
  <br>
