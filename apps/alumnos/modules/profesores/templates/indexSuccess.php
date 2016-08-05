<h1>Profesores</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('profesores/buscarpersona') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Profesor</td>
      <td width="30%" align="center" class="hed">Nro. de Documento</td>
      <td class="hed" align="center">Facultad</td>
      <td class="hed" align="center">Legajo</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>
    <?php foreach ($pager->getResults() as $profesores): ?>
    <tr>
      <td align="center"><?php echo $profesores->getIdprofesor() ?></td>
      <td><?php echo $profesores->getPersonas() ?></td>
      <td align="center"><?php echo $profesores->getPersonas()->getNrodoc() ?></td>
      <td><?php echo $profesores->getFacultades() ?></td>
      <td align="center"><?php echo $profesores->getLegajo() ?></td>
      <td align="center">
        <form action="<?php echo url_for('profesores/modificar') ?>" method="post">  
        	<input type="hidden" id="idprofesor" name="idprofesor" value="<?php echo $profesores->getIdprofesor(); ?>">
			<input type="hidden" id="facultad" name="facultad" value="<?php echo $profesores->getIdfacultad(); ?>">
			<input type="hidden" id="idtipodocumento" name="idtipodocumento" value="<?php echo $profesores->getPersonas()->getIdtipodoc(); ?>">
			<input type="hidden" id="nrodocumento" name="nrodocumento" value="<?php echo $profesores->getPersonas()->getNumerodoc(); ?>">
      		<input type="submit" value="Editar" />
		</form>	      
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen profesores.</td>
		</tr>	
	<?php } ?>     
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="6" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'profesores/index?page='.$pager->getFirstPage(),'class="pager"') ?>
				<?php echo link_to('<', 'profesores/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'profesores/index?page='.$page,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'profesores/index?page='.$pager->getNextPage(),'class="pager"') ?>
				<?php echo link_to('>>', 'profesores/index?page='.$pager->getLastPage(),'class="pager"') ?>
				</div>
			<?php } ?>  		
  		</td>
  	</tr>
  </tfoot>  
</table>
<br>