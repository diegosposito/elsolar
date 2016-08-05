<h1>Designaciones</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('designacionesempleados/new?idempleado='.$idempleado) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
    <td>Nombre: <b><?php echo $empleado->getPersonas(); ?></b></td>
    </tr>       
    <tr>
    <td>
		<table width="100%" class="stats" cellspacing="0">
		  <thead>
		    <tr>
		      <td class="hed" align="center">Id</td>
		      <td class="hed" align="center">Area</td>
		      <td class="hed" align="center">Tipo</td>
		      <td class="hed" align="center">Inicio</td>
		      <td class="hed" align="center">Fin</td>
		      <td class="hed" align="center">Título</td>
		      <td class="hed" align="center">Sede</td>
		      <td class="hed" align="center">Nro. Res.</td>
		      <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($pager->getResults()) > 0) { ?>  
		    <?php foreach ($pager->getResults() as $designaciones_empleados): ?>
		    <tr>
		      <td align="center"><?php echo $designaciones_empleados->getId() ?></td>
		      <td><?php echo $designaciones_empleados->getAreas() ?></td>
		      <td><?php echo $designaciones_empleados->getTiposCargos() ?></td>
		      <td align="center"><?php echo $designaciones_empleados->getInicio() ?></td>
		      <td align="center"><?php echo $designaciones_empleados->getFin() ?></td>
		      <td><?php echo $designaciones_empleados->getTitulo() ?></td>
		      <td><?php echo $designaciones_empleados->getSedes() ?></td>
		      <td align="center"><?php echo $designaciones_empleados->getNroresolucion() ?></td>
		      <td align="center">
		        <form action="<?php echo url_for('designacionesempleados/edit?id='.$designaciones_empleados->getId()) ?>" method="post"> 
		      		<input type="hidden" value="<?php echo $empleado->getIdempleado(); ?>" name="idempleado" />
		      		<input type="submit" class="botonEditar" value="Editar" title="Editar" >
				</form>	          
		      </td>
		    </tr>
		    <?php endforeach; ?>
			<?php } else { ?>
				<tr>
			      <td colspan="9" align="center">No existen designaciones.</td>
				</tr>	
			<?php } ?>  
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td colspan="9" class="hed">
					<?php if ($pager->haveToPaginate())  { ?>
						<div id="navv" align="center">
						<?php echo link_to('<<', 'designacionesempleados/index?page='.$pager->getFirstPage().'&idempleado='.$idempleado,'class="pager"') ?>
						<?php echo link_to('<', 'designacionesempleados/index?page='.$pager->getPreviousPage().'&idempleado='.$idempleado,'class="pager"' ) ?>
						<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
						<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'designacionesempleados/index?page='.$page.'&idempleado='.$idempleado,'class="pager"') ;?>
						<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
						<?php endforeach ?>
						<?php echo link_to('>', 'designacionesempleados/index?page='.$pager->getNextPage().'&idempleado='.$idempleado,'class="pager"') ?>
						<?php echo link_to('>>', 'designacionesempleados/index?page='.$pager->getLastPage().'&idempleado='.$idempleado,'class="pager"') ?>
						</div>
					<?php } ?>  		
		  		</td>
		  	</tr>
		  </tfoot>    
		</table>
	</td>
	</tr>
</table>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('empleados/index') ?>'"></p>
<br>