<h1>Documentaciones</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('documentacion/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Descripción</td>
      <td class="hed" align="center">Tipo</td>
      <td class="hed" align="center">Orden</td>
      <td class="hed" align="center">Activo</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php if (count($documentacions) > 0) { ?>
    <?php foreach ($documentacions as $documentacion): ?>
    <tr>
      <td align="center"><?php echo $documentacion->getIddocumentacion() ?></td>
      <td><?php echo $documentacion->getDescripcion() ?></td>
      <td align="center"><?php echo $documentacion->getTiposDocumentacion() ?></td>
      <td align="center"><?php echo $documentacion->getOrden() ?></td>
      <td align="center"><?php echo $documentacion->getActivo() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('documentacion/edit?iddocumentacion='.$documentacion->getIddocumentacion()) ?>'">
	  </td>    
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen registros.</td>
		</tr>	
	<?php } ?>        
  </tbody>
</table>