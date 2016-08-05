<table width="50%" class="stats" cellspacing="0">
  <thead>

  </thead>

  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center">Alumno</td>
      <td class="hed" align="center">Carreras</td>
      <td class="hed" align="center">Permiso</td>
    </tr>
  </thead>
   <?php foreach($cuentas as $cuenta){ ?>
   	  <tr>
      <td><?php echo $cuenta['nombrepersona'] ?></td>
      <td><?php echo $cuenta['descripcion'] ?></td>
      <td>
      	<?php 
		if ($cuenta['libredeuda']>=date('Y-m-d')){ echo $cuenta['libredeuda']; } else { echo '<p class="resaltar_rojo">Consultar Administracion</p>'; };
		?>
	   </td>
      </tr> 
  <?php } ?>
  </table>
</table>  
<br>
