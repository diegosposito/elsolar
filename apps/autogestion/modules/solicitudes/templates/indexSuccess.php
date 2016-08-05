<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Solicitudes</h1>
	</td>
	</tr>
</table>
<br>
<table width="100%" class="stats" cellspacing="0">
	<tr>
	  <td colspan="5" align="center">
	  	<input type="button" value="Nueva" onclick="location.href='<?php echo url_for('solicitudes/new') ?>'">
	  	<?php if ($resuelta==1){ ?>
		<input type="submit" value="Ver No Resueltas" onclick="location.href='<?php echo url_for('solicitudes/index?resuelta=0') ?>'">
		<?php } else { ?>
		<input type="submit" value="Ver Resueltas" onclick="location.href='<?php echo url_for('solicitudes/index?resuelta=1') ?>'">			
		<?php } ?>	
	  </td>
	</tr>
    <tr>
      <td class="hed" align="center" width="250px">Solicitud</td>
      <td class="hed" align="center" width="250px">Respuesta</td>
      <td class="hed" align="center" width="30px">Resuelta</td>
      <td class="hed" align="center" width="30px">Actualizada</td>
      <td class="hed" width="30px"></td>
    </tr>
    <?php if (count($solicitudess) > 0) { ?>    
		<?php foreach ($solicitudess as $solicitudes): ?>
		<tr>
		  <td width="250px"><?php echo substr(htmlspecialchars_decode($solicitudes->getDescripcion()),0, 50)."..." ?></td>
		  <td width="250px"><?php echo substr(htmlspecialchars_decode($solicitudes->getRespuesta()),0, 50)."..." ?></td>
		  <td width="30px" align="center"><?php echo ( $solicitudes->getResuelta() == 1 ) ? 'Si' : 'No'; ?></td>
		  <td width="30px"><?php echo $solicitudes->getUpdatedAt() ?></td>
	      <td width="30px" align="center">
	      	<input type="button" value="Ver" onclick="location.href='<?php echo url_for('solicitudes/show?id='.$solicitudes->getId()) ?>'">
	      </td>	
		</tr>
		<?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen solicitudes.</td>
		</tr>	
	<?php } ?>	
</table>
