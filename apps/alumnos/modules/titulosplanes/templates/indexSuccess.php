<h1>Títulos por Plan de Estudios</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('titulosplanes/new?idplanestudio='.$idplanestudio) ?>'">
<input type="button" value="Nuevo título" onclick="location.href='<?php echo url_for('titulos/index') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Título</td>
      <td class="hed" align="center">Plan de estudio</td>
      <td class="hed" align="center">Modo de egreso</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>  
    <?php foreach ($pager->getResults() as $titulos_planes): ?>
    <tr>
      <td><?php echo $titulos_planes->getIdtituloplan() ?></td>
      <td><?php echo $titulos_planes->getTitulos()." (".$titulos_planes->getIdtitulo().")" ?></td>
      <td><?php echo $titulos_planes->getPlanesEstudios()." (".$titulos_planes->getIdplanestudio().")" ?></td>
      <td><?php echo $titulos_planes->getModosEgreso() ?></td>
      <td>
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('titulosplanes/edit?idtituloplan='.$titulos_planes->getIdtituloplan()) ?>'">
	  </td>        
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen títulos.</td>
		</tr>	
	<?php } ?>  
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="5" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'titulosplanes/index?page='.$pager->getFirstPage(),'class="pager"') ?>
				<?php echo link_to('<', 'titulosplanes/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'titulosplanes/index?page='.$page,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'titulosplanes/index?page='.$pager->getNextPage(),'class="pager"') ?>
				<?php echo link_to('>>', 'titulosplanes/index?page='.$pager->getLastPage(),'class="pager"') ?>
				</div>
			<?php } ?>
  		</td>
  	</tr>
  </tfoot>
  </table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera) ?>'"></p>
<br>