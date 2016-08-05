<h1>Consulta de Materias por Alumno</h1>

<table width="100%" class="stats" cellspacing="0">
	<tr>
		<td colspan="6"><b>Alumno:</b> <?php echo $alumno->getPersonas() ?></td>
	</tr>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Materia</td>
      <td class="hed" align="center">Fecha</td>
      <td class="hed" align="center">Fecha de Vencimiento</td>
      <td class="hed" align="center">Estado</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
    <?php $i=0; ?>
    <?php foreach ($alu_mats as $alu_mat): ?>
    <tr class="fila_<?php echo $i%2 ; ?>">
		<?php 
		$fechaActual = date('Y-m-d');
		$fechaVence = date("Y-m-d", strtotime($alu_mat->getFechavencimiento()));
		
		if (($fechaActual > $fechaVence) and ($alu_mat->getIdestadomateria()==3)) {
			$color = "red"; 
		} else {
			$color = "black";
		}
		$arr = explode('-', $alu_mat->getFecha());
		$fechaRegistro = $arr[2]."-".$arr[1]."-".$arr[0];
		
		$arr = explode('-', $alu_mat->getFechavencimiento());
		$fechaVencimiento = $arr[2]."-".$arr[1]."-".$arr[0];
		?>
      <td width="5%" align="center"><?php echo $alu_mat->getId() ?></td>
      <td width="35%"><?php echo $alu_mat->getCatedras()->getMateriasPlanes()." (".$alu_mat->getCatedras()->getIdmateriaplan().")" ?></td>
      <td width="10%" align="center"><?php echo $fechaRegistro ?></td>
      <td width="10%" align="center"><font color="<?php echo $color ?>"><?php echo $fechaVencimiento ?></font></td>
      <td width="20%" align="center"><?php echo $alu_mat->getEstadosMateria() ?></td>
      <td width="20%" align="center">
      <?php 
      		if (($fechaActual > $fechaVence) and ($alu_mat->getIdestadomateria()==3) and ($permiterevalida==1)) {
      			$ultimoEstado = Doctrine_Core::getTable('AluMat')->getUltimoEstado($alu_mat->getIdalumno(),$alu_mat->getIdcatedra());
      			if ($ultimoEstado->getIdestadomateria()==3) { 
      ?>
        	<input type="button" value="Revalidar" onclick="location.href='<?php echo url_for('alumat/revalidar?id='.$alu_mat->getId().'&idalumno='.$alu_mat->getIdalumno()) ?>'">
	  <?php } 
		} 
	  ?>
	  <?php if ($sf_user->getGuardUser()->getIsSuperAdmin()) { ?>
        	<input type="button" value="Eliminar" onclick="location.href='<?php echo url_for('alumat/delete?id='.$alu_mat->getId().'&idalumno='.$alu_mat->getIdalumno()) ?>'">
	  <?php } ?>
      </td>      
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>
