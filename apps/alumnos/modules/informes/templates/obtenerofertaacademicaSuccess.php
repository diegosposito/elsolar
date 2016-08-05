<h1>Oferta Académico</h1>

<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="5%">UA</td>
      <td class="hed" align="center" width="30%">Carrera</td>
      <td class="hed" align="center" width="5%">Título</td>
      <td class="hed" align="center" width="5%">Nivel</td>
      <td class="hed" align="center" width="15%">Modalidad</td>
      <td class="hed" align="center" width="5%">Nº de Res. de Aprobación de CSU y HCD</td>
      <td class="hed" align="center" width="5%">Nº de Res. de Aprobación Ministerial</td>
      <td class="hed" align="center" width="5%">Nº de Res. de Acreditación de CONEAU</td>
      <td class="hed" align="center" width="5%">Año de Inicio</td>
      <td class="hed" align="center" width="5%">Plan de Estudio Vigente</td>
      <td class="hed" align="center" width="5%">Carga Horaria (hs. reloj)</td>
    </tr>
 	<?php if (count($carreras) > 0) { ?>    
    <?php foreach ($carreras as $carrera): 
    	$plan = $carrera->getCarreras()->obtenerPlanEstudioVigente();
    ?>
    <tr>
      <td align="center"><?php echo $carrera->getAreas()->getAbreviacion() ?></td>
      <td><?php echo $carrera->getCarreras()->getNombre() ?></td>
      <td><?php echo $carrera->getCarreras()->getTitulo() ?></td>
      <td align="center"><?php echo $carrera->getCarreras()->getTiposCarreras()->getAbreviacion() ?></td>
      <td align="center"><?php echo $carrera->getCarreras()->getModalidadesCarreras() ?></td>
      <td align="center"><?php echo $carrera->getCarreras()->getNroresolucioncsu()." ".$carrera->getCarreras()->getNroresolucionhcd() ?></td>
      <td align="center"><?php echo $carrera->getCarreras()->getNroresolucion() ?></td>
      <td align="center"><?php echo $carrera->getCarreras()->getNroresolucionconeau() ?></td>
      <td align="center"><?php echo $carrera->getCarreras()->getAnioinicio() ?></td>
      <td><?php echo $plan->getNombre() ?></td>
      <td align="center"><?php echo $plan->getHorastotales() ?></td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="11" align="center">No existen registros.</td>
		</tr>	
	<?php } ?>    
</table>
<br>