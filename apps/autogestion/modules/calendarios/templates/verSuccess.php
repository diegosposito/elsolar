<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1><?php echo $calendario->getDescripcion() ?>: Fechas del calendario</h1>
	</td>
	</tr>
</table>
<br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="5%">id</td>
      <td class="hed" align="center" width="40%">Descripción</td>
      <td class="hed" align="center" width="35%">Tipo</td>
      <td class="hed" align="center" width="10%">Inicio</td>
      <td class="hed" align="center" width="10%">Fin</td>
    </tr>
 	<?php if (count($fechass) > 0) { 
		$cantidad=0;
?>    
	    <?php foreach ($fechass as $fecha): ?>
		<?php
		$date = new DateTime($fecha->getFin());
		$fin=$date->format('d-m-Y');
		$date1 = new DateTime($fecha->getInicio());
		$inicio=$date1->format('d-m-Y');

		if($fecha->getFin() >= date("Y-m-d")){
			$cantidad++;
		?>
		    <tr bgcolor='<?php if ($fecha->getFin() >= date("Y-m-d")) {echo "#F8B784";} else {echo "#9A785D";};?>'>
		      <td align="center"><?php echo $fecha->getIdfecha() ?></td>
		      <td><?php echo $fecha->getDescripcion() ?></td>
		      <td align="center"><?php echo $fecha->getTiposFechasCalendario() ?></td>
		      <td align="center"><?php echo $inicio ?></td>
		      <td align="center"><?php echo $fin ?></td>     
		    </tr>

		<?php 
		}

		?>

	    <?php endforeach; 
		
		?>
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen fechas.</td>
		</tr>	
	<?php } ?>    
</table>
