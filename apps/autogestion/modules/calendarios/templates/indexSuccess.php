<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Calendario Académico</h1>
	</td>
	</tr>
</table>
<br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="57%">Descripción</td>
      <td class="hed" align="center" width="5%">Año</td>
      <td class="hed" align="center" width="20%">Resolución</td>
      <td class="hed" align="center" width="7%">Activo</td>
      <td class="hed" align="center"></td>
    </tr>
 	<?php if (count($calendarioss) > 0) { ?>    
    <?php foreach ($calendarioss as $calendarios): ?>
    <tr>
      <td><?php echo $calendarios->getDescripcion() ?></td>
      <td align="center"><?php echo $calendarios->getAnio() ?></td>
      <td><?php echo $calendarios->getResolucion() ?></td>
      <td align="center"><?php echo ($calendarios->getActivo()) ? "Si" : "No"; ?></td>
	  <td  align="center">
		<input type="button" value="Ver" onclick="location.href='<?php echo url_for('calendarios/ver?idcalendario='.$calendarios->getIdcalendario()) ?>'">		
	  </td>      
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen calendarios.</td>
		</tr>	
	<?php } ?>    
</table>
