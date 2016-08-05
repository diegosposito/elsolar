<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Calendario Académico</h1>
	</td>
	</tr>
</table>
<br>
<table class="stats" width="100%">
    <tr>
      <td class="hed" align="center" colspan="4">CALENDARIO ACADEMICO</td>
    </tr>
    <tr>
      <td class="hed" align="center" width="40%">Descripción</td>
      <td class="hed" align="center" width="35%">Tipo</td>
      <td class="hed" align="center" width="10%">Inicio</td>
      <td class="hed" align="center" width="10%">Fin</td>
    </tr>
 	<?php if (count($fechass) > 0) { ?>    
	    <?php foreach ($fechass as $fecha) { ?>
			<?php
			$date = new DateTime($fecha->getFin());
			$fin=$date->format('d-m-Y');
			$date1 = new DateTime($fecha->getInicio());
			$inicio=$date1->format('d-m-Y');
			
			if (($fecha->getFin() >= date("Y-m-d")) or (($fecha->getFin() < date("Y-m-d")) and (!in_array($fecha->getIdtipo(), array(4,5,6,12))))) {
			?>
	    <tr bgcolor='<?php if ($fecha->getFin() < date("Y-m-d")) {echo "#e6e4e9";} else {echo "#F9D32D";};?>'>
	      <td><?php echo $fecha->getDescripcion() ?></td>
	      <td align="center"><?php echo $fecha->getTiposFechasCalendario() ?></td>
	      <td align="center"><?php echo $inicio ?></td>
	      <td align="center"><?php echo $fin ?></td>     
	    </tr>
		<?php }
		} ?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen fechas.</td>
		</tr>	
	<?php } ?>    
</table>
