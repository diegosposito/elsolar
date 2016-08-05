<h1><?php echo $calendario->getDescripcion() ?>: Fechas del calendario</h1>

<table width="100%" class="stats" cellspacing="0">
	<tr>
	  <td colspan="5" align="center">
		<input type="submit" value="Nuevo" onclick="location.href='<?php echo url_for('fechascalendario/new?id='.$calendario->getIdcalendario()) ?>'">
	  </td>
	</tr>
    <tr>
      <td class="hed" align="center" width="60%">Descripción</td>
      <td class="hed" align="center" width="15%">Tipo</td>
      <td class="hed" align="center" width="5%">Inicio</td>
      <td class="hed" align="center" width="5%">Fin</td>
      <td class="hed" align="center"></td>
    </tr>
 	<?php if (count($fechass) > 0) { ?>    
    <?php foreach ($fechass as $fecha): ?>
    <tr>
      <td><?php echo $fecha->getDescripcion() ?></td>
      <td align="center"><?php echo $fecha->getTiposFechasCalendario() ?>
		<?php if ($fecha->getIdTipo()==7) { ?>
			(<?php echo count($fecha->obtenerLlamados()); ?>)
		<?php } elseif ($fecha->getIdTipo()==6) { ?>	  	
			<?php $ciclo = $fecha->obtenerCicloLectivo(); ?>
			(<?php echo $ciclo['ciclo']; ?>)
		<?php } elseif ($fecha->getIdTipo()==4) { ?> 
			<?php if ($fecha->obtenerPeriodoCursada()) { ?>
				(<?php echo $fecha->obtenerPeriodoCursada()->getPeriododecursada(); ?>)	  	
			<?php } ?>	  	
		<?php } ?>      
      </td>
      <td align="center"><?php echo $fecha->getInicio() ?></td>
      <td align="center"><?php echo $fecha->getFin() ?></td>
	  <td  align="center">
		<input type="button" value="Editar" onclick="location.href='<?php echo url_for('fechascalendario/edit?idfecha='.$fecha->getIdfecha()) ?>'">
	  	<?php if ($fecha->getIdTipo()==7) { ?>
	  	<input type="button" value="Agregar Llamado" onclick="location.href='<?php echo url_for('llamadosturno/new?idfecha='.$fecha->getIdfecha()) ?>'">
	  	<?php } elseif ($fecha->getIdTipo()==6) { ?>
	  	<input type="button" value="Asociar Ciclo" onclick="location.href='<?php echo url_for('periodosciclos/edit?idfecha='.$fecha->getIdfecha()) ?>'">
	  	<?php } elseif ($fecha->getIdTipo()==4) { ?>
	  	<input type="button" value="Asociar Cuatrimestre" onclick="location.href='<?php echo url_for('periodoscursadas/edit?idfecha='.$fecha->getIdfecha()) ?>'">
	  	<?php } ?>
	  </td>      
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen fechas.</td>
		</tr>	
	<?php } ?>    
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('calendarios/index') ?>'"></p>
<br>
