<h1>Ciclos lectivos</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('cicloslectivos/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Ciclo</td>
      <td class="hed" align="center">Inicio</td>
      <td class="hed" align="center">Fin</td>
      <td class="hed" align="center">Activo</td>
      <td class="hed" align="center">Acciones</td>    
    </tr>
  </thead>
  <tbody>
	<?php if (count($ciclos_lectivoss) > 0) { ?>  
    <?php foreach ($ciclos_lectivoss as $ciclos_lectivos): ?>
    <tr>
      <td align="center"><?php echo $ciclos_lectivos->getId() ?></td>
      <td><?php echo $ciclos_lectivos->getCiclo() ?></td>
      <td align="center"><?php echo $ciclos_lectivos->getInicio() ?></td>
      <td align="center"><?php echo $ciclos_lectivos->getFin() ?></td>
      <td align="center"><?php echo ($ciclos_lectivos->getActivo()) ? "Si" : "No"; ?></td>      
	  <td align="center">
      	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('cicloslectivos/edit?id='.$ciclos_lectivos->getId()) ?>'">
	  </td>  
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen ciclos lectivos.</td>
		</tr>	
	<?php } ?>   
  </tbody>
</table>
 <br>