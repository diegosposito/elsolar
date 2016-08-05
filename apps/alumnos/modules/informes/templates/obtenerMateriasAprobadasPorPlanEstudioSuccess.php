<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2" class="hed">Plan de estudios: <?php echo $planestudio; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="4%"></td>
		      <td class="hed" align="center" width="20%">Nombre</td>
		      <td class="hed" align="center" width="10%">Nro. Doc.</td>
		      <td class="hed" align="center" width="15%">Fecha Ingreso</td>
		      <td class="hed" align="center" width="4%">Ciclo</td>
		      <td class="hed" align="center" width="4%">Mat. Plan</td>
              <td class="hed" align="center" width="5%">Cant. 1ro</td>
		      <td class="hed" align="center" width="4%">Cant. 2do</td>
		      <td class="hed" align="center" width="4%">Cant. 3ro</td>
		      <td class="hed" align="center" width="4%">Cant. 4to</td>
		      <td class="hed" align="center" width="4%">Cant. 5to</td>
		      <td class="hed" align="center" width="4%">Total ap.</td>
		      <td class="hed" align="center" width="4%">Cursa</td>
		      <td class="hed" align="center" width="15%">Ultima Fecha</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($alumnos) > 0){ ?>
		    <?php foreach ($alumnos as $alumno): ?>
  		  <tr bgcolor="<?php 
			if($alumno['cantidad_materias_del_plan'] <= $alumno['total_aprobadas']) {echo '#D82020';}; 
			if(($alumno['cantidad_materias_del_plan'] > $alumno['total_aprobadas']) and (($alumno['cantidad_materias_del_plan']-3) < $alumno['total_aprobadas'])) {echo '#F9D32D';}; 
			?>">

		      <td align="center" > <?php echo $alumno['idalumno']; ?></td>
		      <td align="left"><?php echo $alumno['apellido'].", ".$alumno['nombre']; ?></td>
		      <td><?php echo $alumno['tipodoc']." ".$alumno['nrodoc']; ?></td>
		      <td align="center">
		      <?php 
				$arr = explode('-', $alumno['fechaingreso']);
		        echo $arr[2]."-".$arr[1]."-".$arr[0]; 
		      ?>
		      </td>
		      <td align="center"><?php echo $alumno['ciclo']; ?></td>
		      <td align="center"><?php echo $alumno['cantidad_materias_del_plan']; ?></td>
              <td align="center"><?php echo $alumno['materias_ap_primero']; ?></td>
		      <td align="center"><?php echo $alumno['materias_ap_segundo']; ?></td>
		      <td align="center"><?php echo $alumno['materias_ap_tercero']; ?></td>
		      <td align="center"><?php echo $alumno['materias_ap_cuarto']; ?></td>
		      <td align="center"><?php echo $alumno['materias_ap_quinto']; ?></td>
		      <td align="center"><?php echo $alumno['total_aprobadas']; ?></td>
		      <td align="center"><?php 
				
				$resultado = Doctrine_Core::getTable('AluMat')->getCantidadMateriasCursando($alumno['idalumno']);
				foreach($resultado as $valor){
				echo $valor['cantidad'];
				$ultimafecha=$valor['ultimafecha'];
				}
                    ?></td>
<?php 
				$arr1= array();
				$arr1 = explode('-', $ultimafecha);
		       
		      ?>
		      <td align="center" bgcolor="<?php if(trim($arr1[0])<'2014')  {echo '#D82020';}; ?>">
			<?php  if (count($arr1)>0) echo $arr1[2]."-".$arr1[1]."-".$arr1[0]; ?>
			</td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="10" align="center">No existen alumnos.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr> 
</table>
</div>
