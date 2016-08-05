<h1>Sedes por Carrera</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('carrerassede/new?idcarrera='.$idcarrera) ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Sede</td>
      <td class="hed" align="center">Carrera</td>
      <td class="hed" align="center">Exploratoria?</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($carreras_sedes) > 0) { ?> 
    <?php foreach ($carreras_sedes as $carreras_sede): ?>
    <tr>
      <td align="center"><?php echo $carreras_sede->getId() ?></td>
      <td><?php echo $carreras_sede->getSedes() ?></td>
      <td ><?php echo $carreras_sede->getCarreras() ?></td>
      <td align="center"><?php echo (($carreras_sede->getExploratoria()) ? 'Si': 'No') ?></td>
      <td align="center" width="5%">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('carrerassede/edit?id='.$carreras_sede->getId()) ?>'">
	  </td>   
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen sedes.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('carreras/index') ?>'"></p>
<br>