<h1>Designaciones</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('designaciones/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Catedra</td>
      <td class="hed" align="center">Profesor</td>
      <td class="hed" align="center">Tipo de Designación</td>
      <td class="hed" align="center">Inicio</td>
      <td class="hed" align="center">Fin</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($designacioness) > 0) { ?>
    <?php foreach ($designacioness as $designaciones): ?>
    <tr>
      <td align="center"><?php echo $designaciones->getIddesignacion() ?></td>
      <td><?php echo $designaciones->getCatedras()->getMateriasPlanes() ?></td>
      <td><?php echo $designaciones->getProfesores()->getPersonas() ?></td>
      <td align="center"><?php echo $designaciones->getTiposDesignaciones() ?></td>
      <td align="center"><?php echo $designaciones->getInicio() ?></td>
      <td align="center"><?php echo $designaciones->getFin() ?></td>
      <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('designaciones/edit?iddesignacion='.$designaciones->getIddesignacion()) ?>'">      
      </td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="7" align="center">No existen designaciones.</td>
		</tr>	
	<?php } ?>    
  </tbody>
</table>
<br>