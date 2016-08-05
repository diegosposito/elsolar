  <table width="30%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Id</td>
      <td class="hed">Nombre</td>
      <td class="hed">Tipo</td>
      <td class="hed">Fecha</td>    
      <td class="hed">Hora</td>        

    </tr>
  </thead>
  <tbody>
  <?php if (count($inscripcioness)==0) {?>
      <tr>
      <td colspan="6">No existen solicitudes de libre deuda pendientes.</td>
      </tr> 
  <?php } else { ?>
   	<?php 
   	foreach($inscripcioness as $inscripcion){
   	?>
   	  <tr>
      <td><?php echo $inscripcion['id'] ?></td>   	  
      <td><?php echo $inscripcion['materia'] ?></td>    
      <td><?php echo $inscripcion['tipo'] ?></td> 
      <td><?php echo $inscripcion['fecha'] ?></td>
      <td><?php echo $inscripcion['hora'] ?></td>
  
      </tr> 
      <div >
     </div>
  	<?php } ?>
  <?php } ?>
  </tbody>
  </table>