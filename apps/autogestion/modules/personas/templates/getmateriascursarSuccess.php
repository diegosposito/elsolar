<br />
<h1>Inscripción a Cursada</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br />
<strong>Fecha Nacimiento:</strong> <?php echo $persona['fechaNac'] ?> <br />
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
      <td><a href="<?php echo url_for('personas/getmateriascursar?idc='.$plan['idCarrera'].'&ida='.$plan['idAl']); ?>">Visualizar</a></td>
      </tr> 
  <?php } ?>
  </table>
  <br>
<?php 
if ($materiascursar){ ?> 
  <h1>Materias</h1><br />	 
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
      <td class="hed">Nombre</td>
      <td class="hed">Curso</td>
      <td class="hed">Estado</td>
      <td class="hed"></td>
    </tr>
  </thead>
  <?php 
     foreach($materiascursar as $materia){ 
  ?>
      <tr>
      <td><?php echo $materia['nombre'] ?></td>
      <td><?php echo $materia['curso'] ?></td>
     <td><?php //echo $materia['estado'] ?></td>      
      <td>
      <?php if($materia['inscripto'] == "1") { 
          echo "<p class='resaltar_verde'>Inscripto</p>";
       } else { ?>
      	  <a href="<?php echo url_for('personas/inscribir?idm='.$materia['idDetallePlan'].'&ida='.$alumno['idAlumno'].'&idc='.$idcarrera.'&tipo=C') ?>">Inscribir</a>
      <?php } ?>      
      </td>
      </tr> 
  <?php 
   } 
   ?>
 </table>
 <?php
} ?> 
