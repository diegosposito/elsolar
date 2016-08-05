<h1>Empleados</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('empleados/buscarpersona') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Empleado</td>
      <td width="30%" align="center" class="hed">Nro. de Documento</td>
      <td class="hed" align="center">Legajo</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($pager->getResults()) > 0) { ?>  
    <?php foreach ($pager->getResults() as $empleados): ?>
    <tr>
      <td align="center"><?php echo $empleados->getIdempleado() ?></td>
      <td><?php echo $empleados->getPersonas() ?></td>
      <td align="center"><?php echo $empleados->getPersonas()->getNrodoc() ?></td>
      <td align="center"><?php echo $empleados->getLegajo() ?></td>
      <td align="center">
        <form action="" method="post"> 
      		<input type="button" value="Editar" onclick="location.href='<?php echo url_for('empleados/edit?idempleado='.$empleados->getIdempleado()) ?>'">
      		<input type="button" value="Designaciones" onclick="location.href='<?php echo url_for('designacionesempleados/index?idempleado='.$empleados->getIdempleado()) ?>'">
		</form>	      
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen empleados.</td>
		</tr>	
	<?php } ?>     
  </tbody>
  <tfoot>
  	<tr>
  		<td colspan="5" class="hed">
			<?php if ($pager->haveToPaginate())  { ?>
				<div id="navv" align="center">
				<?php echo link_to('<<', 'empleados/index?page='.$pager->getFirstPage(),'class="pager"') ?>
				<?php echo link_to('<', 'empleados/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
				<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
				<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'empleados/index?page='.$page,'class="pager"') ;?>
				<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('>', 'empleados/index?page='.$pager->getNextPage(),'class="pager"') ?>
				<?php echo link_to('>>', 'empleados/index?page='.$pager->getLastPage(),'class="pager"') ?>
				</div>
			<?php } ?>  		
  		</td>
  	</tr>
  </tfoot>  
</table>
<br>
