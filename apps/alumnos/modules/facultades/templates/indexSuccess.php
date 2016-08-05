<h1>Facultades</h1>
<br>
<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('facultades/new') ?>'">
<input type="button" value="Registrar" onclick="location.href='<?php echo url_for('facultades/registrar') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center" width="75%">Nombre</th>
      <td class="hed" align="center">Acciones</td>
    </tr>
 	<?php if (count($facultadess) > 0) { ?>    
    <?php foreach ($facultadess as $facultades): ?>
    <tr>
      <td align="center"><?php echo $facultades->getIdfacultad() ?></td>
      <td><?php echo $facultades->getNombre() ?></td>
	  <td  align="center">
		<input type="button" value="Editar" onclick="location.href='<?php echo url_for('facultades/edit?idfacultad='.$facultades->getIdfacultad()) ?>'">
	  </td>         
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="3" align="center">No existen facultades.</td>
		</tr>	
	<?php } ?>      
</table>
<br>