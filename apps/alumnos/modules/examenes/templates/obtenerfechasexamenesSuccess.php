<h1>Inscripción a Examen</h1>

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br />
<strong>Fecha  Nacimiento:</strong> <?php echo $persona['fechanac'] ?> <br />
<strong>Nacionalidad:</strong> <?php echo $persona['idnacionalidad']==1?"Argentino":"Uruguayo" ?></p>

<?php
if ($mesasexamenes){ ?> 
<br>
  <h1>Mesas Examenes</h1>
  
  <table width="40%" class="stats" cellspacing="0">
  <thead>
  	<?php if($mensaje) { ?>
      <tr>
      <td colspan="5" class="hed"><?php echo $mensaje ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td class="hed">Id</td>
      <td class="hed">Asignatura</td>      
      <td class="hed">Condición</td>
      <td class="hed">Fecha</td>
      <td class="hed">Hora</td>      
      <td class="hed" width="100" align="center">Estado</td>
    </tr>
  </thead>
  <?php 
     foreach($mesasexamenes as $mesas){ 
  ?>
      <tr>
      <td><?php echo $mesas['idmesaexamen'] ?></td>
      <td><?php echo $mesas['nombre'] ?></td>
 	  <td align="center"><?php echo $mesas['condicion'] ?></td>    
 	  <td><?php echo $mesas['fecha'] ?></td>
      <td><?php echo $mesas['hora'] ?></td>
      <td width="100" align="center">
      <?php if($mesas['inscripto'] == "1") { 
          echo "<p align='center' class='resaltar_verde'>Inscripto</p>";
       } elseif($mesas['inscripto'] == "0" ) { ?>
                 <form class="button" name="form_<?php echo $plan['idcarrera']; ?>" method="post" action="<?php echo url_for('examenes/inscribir' ) ?>">  
                     <input type="hidden" name="idcarrera" value="<?php echo $alumno['idplanestudio']; ?>">
                     <input type="hidden" name="idalumno" value="<?php echo $alumno['idalumno']; ?>">
                     <input type="hidden" name="idmesaexamen" value="<?php echo $mesas['idmesaexamen']; ?>">                     
                     <input type="submit" value="Inscribir" title="Inscribirse a Mesa de Exámen" id="Inscribir" class="form_consulta_enviar" name="Inscribir">
                </form>         
      <?php } ?>
      </td>
      </tr> 
  <?php 
   } ?>
 </table>
 <?php
} ?> 
