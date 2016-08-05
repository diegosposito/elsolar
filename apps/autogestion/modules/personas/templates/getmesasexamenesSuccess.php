<br />
<h1>Inscripción a Examen</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br />
<strong>Fecha  Nacimiento:</strong> <?php echo $persona['fechaNac'] ?> <br />
<strong>Nacionalidad:</strong> <?php echo $persona['idNacionalidad']==1?"Argentino":"Uruguayo" ?></p>

  <br />
  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Carrera</td>
      <td class="hed">Plan</td>
      <td class="hed">Titulo</td>
      <td class="hed">Acción</td>
    </tr>
  </thead>
   <?php 
   foreach($planes as $plan){
   	  ?>
   	  <tr>
      <td><?php echo $plan['nombre'] ?></td>
      <td><?php echo $plan['plan'] ?></td>
      <td><?php echo $plan['titulo'] ?></td>
      <td><a href="<?php echo url_for('personas/getmesasexamenes?idc='.$plan['idCarrera']) ?>">Visualizar</a></td>
      </tr> 
  <?php } ?>
  </table>
  <br>
 
<?php
if ($mesasexamenes){ ?> 
  <h1>Mesas Examenes</h1>
  <p><?php echo "Fecha actual libre deuda: <b>".$libredeuda."</b>"; ?></p> 
  <br />	
  
  <table width="40%" class="stats" cellspacing="0">
  <thead>
  	<?php if($mensaje) { ?>
      <tr>
      <td colspan="5" class="hed"><?php echo $mensaje ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td class="hed">Fecha</td>
      <td class="hed">Hora</td>
      <td class="hed">Nombre</td>
      <td class="hed">Estado</td>
    </tr>
  </thead>
  <?php 
     foreach($mesasexamenes as $mesas){ 
  ?>
      <tr>
      <td><?php echo $mesas['fecha'] ?></td>
      <td><?php echo $mesas['hora'] ?></td>
      <td><?php echo $mesas['nombre'] ?></td>
      <td>
      <?php if($mesas['inscripto'] == "1") { 
          echo "<p class='resaltar_verde'>Inscripto</p>";
       } elseif($mesas['inscripto'] == "0" && ($mesas['fecha'] > $libredeuda)) { 
      	   echo "<p class='resaltar_naranja'>No habilitado</p>";
       } elseif($mesas['inscripto'] == "0" && ($mesas['fecha'] <= $libredeuda)) { ?>
      	  <a href="<?php echo url_for('personas/inscribir?ide='.$mesas['idFechaExamen'].'&ida='.$alumno['idAlumno'].'&idc='.$idcarrera.'&fe='.$mesas['fecha'].'&he='.$mesas['hora'].'&tipo=R') ?>">Inscribir</a>
      <?php } ?>
      </td>
      </tr> 
  <?php 
   } ?>
 </table>
 <?php
} ?> 
