<h1>Calendarios</h1>

<table width="100%" class="stats" cellspacing="0">
	<tr>
	  <td colspan="5" align="center">
		<input type="submit" value="Nuevo" onclick="location.href='<?php echo url_for('calendarios/new') ?>'">
	  </td>
	</tr>
    <tr>
      <td class="hed" align="center" width="37%">Descripción</td>
      <td class="hed" align="center" width="5%">Año</td>
      <td class="hed" align="center" width="20%">Resolución</td>
      <td class="hed" align="center" width="7%">Activo</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
 	<?php if (count($calendarioss) > 0) { ?>    
    <?php foreach ($calendarioss as $calendarios): ?>
    <tr>
      <td><?php echo $calendarios->getDescripcion().'<br> ('.$calendarios->getFacultades()->getNombre().')'; ?></td>
      <td align="center"><?php echo $calendarios->getAnio() ?></td>
      <td><?php echo $calendarios->getResolucion() ?></td>
      <td align="center"><?php echo ($calendarios->getActivo()) ? "Si" : "No"; ?></td>
	  <td  align="center">
		<input type="button" value="Editar" onclick="location.href='<?php echo url_for('calendarios/edit?idcalendario='.$calendarios->getIdcalendario()) ?>'">
		<input type="button" value="Ver" onclick="location.href='<?php echo url_for('calendarios/ver?idcalendario='.$calendarios->getIdcalendario()) ?>'">
	  	<?php if ($calendarios->getActivo()==0){ ?>
		<input type="submit" value="Activar" onclick="location.href='<?php echo url_for('calendarios/activar?activo=1&idcalendario='.$calendarios->getIdcalendario()) ?>'">
		<?php } else { ?>
		<input type="submit" value="Desactivar" onclick="location.href='<?php echo url_for('calendarios/activar?activo=0&idcalendario='.$calendarios->getIdcalendario()) ?>'">			
		<?php } ?>				
	  </td>      
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen calendarios.</td>
		</tr>	
	<?php } ?>    
</table>
<br>
