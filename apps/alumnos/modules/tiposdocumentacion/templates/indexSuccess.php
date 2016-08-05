<h1>Tipos de Documentación</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('tiposdocumentacion/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Nombre</td>
      <td class="hed" align="center">Nombre reducido</td>
      <td class="hed" align="center">Aplicable</td>
      <td class="hed" align="center">Orden</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php if (count($tipos_documentacions) > 0) { ?>
    <?php foreach ($tipos_documentacions as $tipos_documentacion): ?>
    <tr>
      <td align="center"><?php echo $tipos_documentacion->getIdtipodocumentacion() ?></td>
      <td><?php echo $tipos_documentacion->getNombre() ?></td>
      <td><?php echo $tipos_documentacion->getNombrereducido() ?></td>
      <td align="center"><?php echo $aplicable[$tipos_documentacion->getAplicable()] ?></td>
      <td align="center"><?php echo $tipos_documentacion->getOrden() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('tiposdocumentacion/edit?idtipodocumentacion='.$tipos_documentacion->getIdtipodocumentacion()) ?>'">      
      </td>      
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen tipos.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>
<br>
