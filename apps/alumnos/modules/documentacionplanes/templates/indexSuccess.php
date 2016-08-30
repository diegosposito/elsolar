<h1>Documentación por Plan de Estudios</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('documentacionplanes/new') ?>'">
<input type="button" value="Aplicar Tipo" onclick="location.href='<?php echo url_for('documentacionplanes/aplicar') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Carrera</td>
      <td class="hed" align="center">Documentación</td>
      <td class="hed" align="center">Activo</td>
      <td class="hed" align="center">Obligatorio</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php if (count($documentacion_planes_estudioss) > 0) { ?>
    <?php foreach ($documentacion_planes_estudioss as $documentacion_planes_estudios): ?>
    <tr>
      <td align="center"><?php echo $documentacion_planes_estudios->getId() ?></td>
      <td><?php echo $documentacion_planes_estudios->getPlanesEstudios()." (".$documentacion_planes_estudios->getIdplanestudio().")" ?></td>
      <td><?php echo $documentacion_planes_estudios->getDocumentacion() ?></td>
      <td align="center"><?php echo $documentacion_planes_estudios->getActivo() ?></td>
      <td align="center"><?php echo $documentacion_planes_estudios->getObligatorio() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('documentacionplanes/edit?id='.$documentacion_planes_estudios->getId()) ?>'">
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
