<h1>Personal No Docente</h1>

<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td class="hed" align="center" width="5%">UA</td>
      <td class="hed" align="center" width="30%">Nombre</td>
      <td class="hed" align="center" width="5%">Sexo</td>
      <td class="hed" align="center" width="5%">Edad</td>
      <td class="hed" align="center" width="15%">Cargo</td>
      <td class="hed" align="center" width="15%">Nivel Educativo</td>
      <td class="hed" align="center" width="15%">Títulos</td>
    </tr>
 	<?php if (count($autoridades) > 0) { ?>    
    <?php foreach ($autoridades as $autoridad): ?>
    <tr>
      <td align="center"><?php echo $autoridad->getAreas()->getAbreviacion() ?></td>
      <td><?php echo $autoridad->getEmpleados()->getPersonas() ?></td>
      <td align="center">
      	<?php 
      	$sexo = $autoridad->getEmpleados()->getPersonas()->getSexo()->getNombre();
      	echo $sexo[0]; 
      	?>
      </td>
      <td align="center"><?php echo $autoridad->getEmpleados()->getPersonas()->getEdad() ?></td>
	  <td align="center"><?php echo $autoridad->getTiposCargos() ?></td>  
	  	<?php 
	  	$estudio = $autoridad->getEmpleados()->getPersonas()->getEstudioPrevio(2); 
	  	if ($estudio) {
			if ($estudio->getConcluyo()==1) {
				$concluyo = "(En curso)";
			} else {
				$concluyo = "(Aprobado)";
			} 
	  		$niveleducativo = $estudio->getNivelesEstudios()." ".$concluyo;
	  		$titulo = $estudio->getDescripcion();
	  	} else {
			$niveleducativo = "-";
			$titulo = "-";
	  	}
	  	?>	      
	  <td align="center"><?php echo $niveleducativo ?></td>
	  <td align="center"><?php echo $titulo ?></td>
    </tr>
    <?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="7" align="center">No existe personal no-docente registrado.</td>
		</tr>	
	<?php } ?>    
</table>
<br>